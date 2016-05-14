/*
 * Nome: script.js
 * Desenvolvido por: Rafael Damasio (Intrepido 53)
 * Data da Criação: 01-02-2015
 * Copyright (c) 2015 - Construpaver
 */

$(document).ready(function(){
	
	$("#overflow-loading").height($(window).height());
	
	fechaLoading = function(){
		$("#overflow-loading").fadeOut();
		$("#loading").fadeOut();
	}
	
	carregaLoading = function(){
		$("#overflow-loading").height($(window).height());
		$("#overflow-loading").fadeIn(100);
		$("#loading").fadeIn(100);
	}
	
	calulaItensPort = function(largJanela, itensHor){
		divide = function(){
			var largItem = parseInt(largJanela)/parseInt(itensHor);
			return largItem;
		}
		$(".min-projeto").width(divide());
		$(".min-projeto div").height($(".min-projeto").height());

		$(".inf-projeto a").height($(".inf-projeto a").width());
		marginTopLink = (parseFloat($(".inf-projeto a").height())/2)*(-1);
		marginLeftLink = (parseFloat($(".inf-projeto a").width())/2)*(-1);
		$(".inf-projeto a").css({
			"top":"50%",
			"margin-top":marginTopLink,
			"left":"50%",
			"margin-left":marginLeftLink
		});
	}
	
	animateMenu = function(height){
		$(".menu ul").animate({
			height: height
		}, 200, function(){
			if(height == 0){
				$(this).css("margin-top", "0");
			}
		});
	}
	
	$(".bt-menu-toggle").on("click", function(e){
		var $this = $(this);
		e.stopPropagation();
		e.preventDefault();
		verHeight = $(".menu ul").height();
		if(parseInt(verHeight) == 0){
			verHeight = 228;
			$(".menu ul").css("margin-top", "60px");
			animateMenu(verHeight);
		} else {
			verHeight = 0;
			animateMenu(verHeight);
		}
	});
	
	fechaProjeto = function(){
		$(".content-animate-portfolio").animate({
			height: 0
		}, 400, function(){
			$(".content-item-portfolio").html("");
		});
	}
	
	ajaxProjeto = function(idProjeto){
		$.ajax({
			type: "POST",
			url: "chama-portfolio.php",
			data: "idProjeto="+idProjeto,
			success: function(dados){
				$(".content-item-portfolio").html(dados);
			},
			complete: function(){
				abreProjeto($(".content-item-portfolio").height());
			}
		});
	}
	
	chamaProjeto = function(){
		$(".link-projeto").on("click", function(e){
			e.preventDefault();
			e.stopPropagation();
			carregaLoading();
			var $this 		= $(this),
			idThisProjeto 	= $this.attr("id"),
			projetoAberto 	= $(".content-item-portfolio").attr("id");
			if(projetoAberto == undefined || projetoAberto == ""){
				$(".content-item-portfolio").attr("id", idThisProjeto);
				ajaxProjeto(idThisProjeto);
			} else if(projetoAberto != idThisProjeto){
				$(".content-item-portfolio").attr("id", idThisProjeto);
				fechaProjeto();
				setTimeout(function(){
					ajaxProjeto(idThisProjeto);
				}, 600);
			} else {
				fechaLoading();
				return false;
			}
		});
	}
	
	chamaProjeto();
	
	$(".bt-fecha-projeto a").on("click", function(e){
		e.preventDefault();
		e.stopPropagation();
		$(".content-item-portfolio").attr("id", "");
		fechaProjeto();
	});
	
	scrollMenu = function(scrollTop){
		if(scrollTop > 114){
			$(".header-alternative").addClass("header-visible");
		} else {
			$(".header-alternative").removeClass("header-visible");
		}
	}
	
	$(window).scroll(function(){
		var $this = $(this),
		scrollTop = $this.scrollTop();
		scrollMenu(scrollTop);
	});
	
	$(".bt-scroll").on("click", function(e){
		e.preventDefault();
		e.stopPropagation();
		var $this = $(this),
		thisTop = $this.attr("href");
		topPage = parseInt($(thisTop).offset().top);
		if(thisTop != "#topo"){
			topPage = parseInt(topPage)-parseInt($(".header-alternative").height());
		}
		$("html, body").animate({
			scrollTop: topPage
		}, 1000);
	});
	
	resetaForm = function(idForm){
		$(idForm).each(function(){
            var $this = $(this);
			$this.find("input").val("");
			$this.find("textarea").val("");
        });
	}
	
	resetaForm("#fale-conosco");
	
	//VALIDACAO E ENVIO DO FORMULÁRIO DE CONTATO
	$("#fale-conosco").validate({
		elementError: "span",
		rules: {
			nome: "required",
			email: {
				required: true,
				email: true
			},
			mensagem: "required"
		},
		messages: {
			nome: "Por favor preencha o campo corretamente!",
			email: "Por favor preencha o campo corretamente!",
			mensagem: "à Por favor preencha o campo corretamente!"
		},
		submitHandler: function(form){
			var dados = $("#fale-conosco").serialize();
			$.ajax({
				type: "POST",
				url: "fale-conosco-envia.php",
				data: dados,
				beforeSend: function(){
					carregaLoading();
				},
				success: function(data){
					if(data == "sucesso"){
						alert("E-mail enviado com sucesso");
						resetaForm("#fale-conosco");
						fechaLoading();
					} else {
						alert(data);
						fechaLoading();
					}
				}
			});
		}
	});
	
	setListaPortfolio();
	
	fechaLoading();

});
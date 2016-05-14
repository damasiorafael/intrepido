$(document).ready(function(){
	$(".label-danger").on("click", function(){
		var conf = confirm("Deseja marcar essa mensagem como lida?");
		if (conf == true) {
			var $this = $(this);
			var id = $this.attr("rel");
			$.ajax({
				type: "POST",
				url: "contato-envia.php",
				data: "&id="+id,
				success: function(data){
					if(data == "sucesso"){
						alert("Mensagem lida com sucesso!");
						window.location.href=window.location.href;
					} else {
						alert(data);
					}
				}
			});
		} else {
			return false;
		}
	});
	
	var elCheckeds = [];
	var elCheckedsPort = [];
	
	$(".check-item").on("click", function(){
		var $this = $(this);
		if($this.is(":checked")){
			elCheckeds.push($this.val());
			if(elCheckeds.length > 0){
				$(".deleteItens").removeClass("bt-disable");
			}
		} else {
			var a = elCheckeds.indexOf($this.val());
			elCheckeds.splice(a, 1);
			if(elCheckeds.length <= 0){
				$(".deleteItens").addClass("bt-disable");
			}
		}
	});

	$(".check-item-port").on("click", function(){
		var $this = $(this);
		if($this.is(":checked")){
			elCheckedsPort.push($this.val());
			if(elCheckedsPort.length > 0){
				$(".deleteItensPortfolio").removeClass("bt-disable");
			}
		} else {
			var a = elCheckedsPort.indexOf($this.val());
			elCheckedsPort.splice(a, 1);
			if(elCheckedsPort.length <= 0){
				$(".deleteItensPortfolio").addClass("bt-disable");
			}
		}
	});
	
	$(".deleteItens").on("click", function(){
		var $this = $(this);
		if(!$this.hasClass("bt-disable")){
			//AQUI DELETA OS ITENS
			var conf = confirm("Deseja excluir os itens selecionados?");
			if(conf == true){
				$.ajax({
					type: "POST",
					url: "contato-envia.php",
					data: "&arrayItens="+elCheckeds,
					success: function(data){
						if(data == "sucesso"){
							alert("Contatos excluídos com sucesso!");
							window.location.href=window.location.href;
						} else {
							alert(data);
						}
					}
				});
			} else {
				return false;
			}
		} else {
			return false;//AQUI NAO FAZ NADA
		}
	});
	
	$(".deleteItensPortfolio").on("click", function(){
		var $this = $(this);
		if(!$this.hasClass("bt-disable")){
			//AQUI DELETA OS ITENS
			var conf = confirm("Deseja excluir os itens selecionados?");
			if(conf == true){
				$.ajax({
					type: "POST",
					url: "portfolio-envia.php",
					data: "&arrayItens="+elCheckedsPort+"&acao=excluir",
					success: function(data){
						if(data == "sucesso"){
							alert("Portfólios excluídos com sucesso!");
							window.location.href=window.location.href;
						} else {
							alert(data);
						}
					}
				});
			} else {
				return false;
			}
		} else {
			return false;//AQUI NAO FAZ NADA
		}
	});
	
	$(".btn-edit-port").on("click", function(){
		var $this = $(this);
		checkRel = $this.attr("rel");
		trPrint = $("tr[rel="+checkRel+"]");
		trPrint.find(".mostra").attr("style", "display: none!important");
		trPrint.find(".esconde").attr("style", "display: block!important");
		trPrint.find(".btn-edit-port").attr("style", "display: none!important");
		trPrint.find(".btn-salva-port").attr("style", "display: block!important");
		trPrint.find(".btn-canc-port").attr("style", "display: block!important");
		trPrint.find(".listImagensPortfolio li").css("float", "none");
		trPrint.find(".btn-delete-port").attr("style", "display: block!important");
	});
	
	$(".btn-canc-port").on("click", function(){
		var $this = $(this);
		checkRel = $this.attr("rel");
		trPrint = $("tr[rel="+checkRel+"]");
		trPrint.find(".mostra").attr("style", "display: ;");
		trPrint.find(".esconde").attr("style", "display: none!important");
		trPrint.find(".btn-edit-port").attr("style", "display: ;");
		trPrint.find(".btn-salva-port").attr("style", "display: none!important");
		trPrint.find(".btn-canc-port").attr("style", "display: none!important");
		trPrint.find(".listImagensPortfolio li").css("float", "left");
		trPrint.find(".btn-delete-port").attr("style", "display: none!important");
	});
	
	$(".btn-salva-port").on("click", function(){
		var $this = $(this);
		var checkRel = $this.attr("rel");
		var edit_tit = $("#edit_tit_portfolio_"+checkRel).val();
		var edit_tx = $("#edit_tx_portfolio_"+checkRel).val();
		$.ajax({
			type: "POST",
			url: "portfolio-envia.php",
			data: "acao=edit_portfolio&id_portfolio="+checkRel+"&tit_portfolio="+edit_tit+"&tx_portfolio="+edit_tx,
			success: function(dados){
				if(dados == "sucesso"){
					alert("Portfólio editado com sucesso!");
					window.location.href=window.location.href;
				} else {
					alert(dados);
				}
			}
		});
	});
	
	$(".img_teste").on("change", function(){
		var $this = $(this);
		var relThis = $this.attr("alt");
		$this.parent().parent().parent().parent().parent().find(".btn-canc-port").attr("style", "display: none!important");
		$("#port_teste_"+relThis).ajaxForm({
			target: '#nova-imagem-'+relThis // o callback será no elemento com o id #visualizar
		}).submit();
	});
	
	$(".btn-delete-port").on("click", function(){
		var conf = confirm("Tem certeza que deseja excluir esta imagem?");
		if (conf == true) {
			var $this = $(this);
			var relThis = $this.attr("rel");
			$this.parent().parent().parent().parent().parent().find(".btn-canc-port").attr("style", "display: none!important");
			$.ajax({
				type: "POST",
				url: "portfolio-envia.php",
				data: "acao=deleta_imagem&id_imagem="+relThis,
				success: function(dados){
					if(dados == "sucesso"){
						alert("Imagem excluída com sucesso!");
						$(".listImagensPortfolio li[rel='"+relThis+"']").remove();
					} else {
						alert(dados);
					}
				}
			});
		} else {
			return false;
		}
	});
	var numNovasImagens = 0;
	$(".inc-mais-imagem").on("click", function(){
		var $this = $(this);
		var relThis = $this.attr("rel");
		trPrint = $("tr[rel="+checkRel+"]");
		trPrint.find(".btn-canc-port").attr("style", "display: none!important");
		var idPortNovaImagem = $this.parent().parent().attr("rel");
		$this.parent().find(".listImagensPortfolio").each(function(){
			var $this = $(this);
			var liNova = $this.find("li");
			if(liNova.hasClass("liNovaImagem")){
				numNovasImagens++;
			}
		});
		var formNovaImagem = "<li class='liNovaImagem novaImagem_"+numNovasImagens+"' style='float: none;'>";
		formNovaImagem += "<div class='nova-imagem-edit' id='nova-imagem-added_"+numNovasImagens+"'></div>";
		formNovaImagem += "<form class='add-img-portfolio_"+numNovasImagens+"' action='portfolio-envia.php' enctype='multipart/form-data' method='post' novalidate>";
		//?acao=add_nova_image&id_controle="+numNovasImagens+"&id_portfolio="+idPortNovaImagem+"
		formNovaImagem += "<input type='hidden' name='acao' value='add_nova_image' />";
		formNovaImagem += "<input type='hidden' name='id_controle' value='"+numNovasImagens+"' />";
		formNovaImagem += "<input type='hidden' name='id_portfolio' value='"+idPortNovaImagem+"' />";
		formNovaImagem += "<input type='file' id='add_nova_image_"+numNovasImagens+"' name='add_nova_image_"+numNovasImagens+"' class='add_nova_image' />";
		formNovaImagem += "</form></li>";
		$this.parent().find(".listImagensPortfolio").append(formNovaImagem);
		$("#add_nova_image_"+numNovasImagens).on("change", function(){
			var $this = $(this);
			var relThis = $this.attr("rel");
			$this.parent().parent().parent().parent().parent().find(".btn-canc-port").attr("style", "display: none!important");
			$(".add-img-portfolio_"+numNovasImagens).ajaxForm({
				target: '#nova-imagem-added_'+numNovasImagens // o callback será no elemento com o id #visualizar
			}).submit();
		});
	});
	
	function checkAll(){
		var boxes = document.getElementsByTagName("input");
		//alert(boxes.length)
		for(var x=0;x<boxes.length;x++){	
			var obj = boxes[x];
			if (obj.type == "checkbox"){
				obj.checked = true;
				if(obj.name!="checkAll"){
					elCheckeds.push(obj.value);
				}
			}
		}
		$(".deleteItens").removeClass("bt-disable");
		return elCheckeds;
	}
	
	function disCheckAll(){
		var boxes = document.getElementsByTagName("input");
		//alert(boxes.length)
		for(var x=0;x<boxes.length;x++){	
			var obj = boxes[x];
			if (obj.type == "checkbox"){
				obj.checked = false;
				if(obj.name!="checkAll"){
					elCheckeds = [];
				}
			}
		}
		$(".deleteItens").addClass("bt-disable");
		return elCheckeds;
	}
	
	$(".check-all").on("click", function(e){
		var $this = $(this);
		if(!$this.is(":checked")){
			disCheckAll();
		} else {
			checkAll();
		}
	});
	
	$('#example2').dataTable({
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": false,
		"bSort": false,
		"bInfo": true,
		"bAutoWidth": true
	});

	//bootstrap WYSIHTML5 - text editor
	$(".textarea").wysihtml5({
		"font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
		"emphasis": true, //Italics, bold, etc. Default true
		"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
		"html": false, //Button which allows you to edit the generated HTML. Default false
		"link": true, //Button to insert a link. Default true
		"image": false, //Button to insert an image. Default true,
		"color": false //Button to change color of font
	});
	
	//VALIDACAO E ENVIO DO FORMULÁRIO DE CONTATO
	$("#portfolio").validate({
		elementError: "span",
		rules: {
			tit_portfolio: "required",
			tx_portfolio: "required",
			"img_destaque[]": "required"
		},
		messages: {
			tit_portfolio: "Por favor preencha o campo corretamente!",
			tx_portfolio: "Por favor preencha o campo corretamente!",
			"img_destaque[]": "Por favor preencha o campo corretamente!"
		},
		submitHandler: function(form){
			//var fileInput = document.getElementById("img_destaque").files;
			//console.log(fileInput.length);
			//return false;
			$('#portfolio').ajaxForm({
				//target:'#visualizar' // o callback será no elemento com o id #visualizar
			}).submit();
			return false;
		}
	});
});
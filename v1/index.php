<?php
	include("inc/config.php");
	header("Content-Type: text/html; charset=iso-8859-1",true);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
<?php include("inc/head.php"); ?>
<title>Intr&eacute;pido 53 - Design Inteligente</title>
</head>
<body id="topo">
<div id="overflow-loading"></div>
<div id="loading"></div>
<!-- FACEBOOK SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=1561052164142480&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- FACEBOOK SDK -->

<!-- Header Section -->
<header class="header">
	<section class="content-header content-responsive">
    	<h1>
        	<a href="#topo" title="Home" class="logo-topo bt-scroll">
        		<span>home</span>
            </a>
        </h1>
		<nav class="menu">
        	<a href="#menu" class="bt-menu-toggle"><i class="fa fa-bars"></i></a>
        	<ul>
            	<li>
                	<a href="#sobre-nos" class="bt-scroll">sobre n&oacute;s</a>
                </li>
                <li>
                	<a href="#portfolio" class="bt-scroll">portf&oacute;lio</a>
                </li>
                <li>
                	<a href="#contato" class="bt-scroll">contato</a>
                </li>
            </ul>
        </nav>
    </section>
</header>
<!-- Header Section -->

<!-- Header Section Alternative -->
<header class="header header-alternative">
	<section class="content-header content-responsive">
    	<h1>
        	<a href="#topo" title="Home" class="logo-topo bt-scroll">
        		<span>home</span>
            </a>
        </h1>
		<nav class="menu">
        	<a href="#menu" class="bt-menu-toggle"><i class="fa fa-bars"></i></a>
        	<ul>
            	<li>
                	<a href="#sobre-nos" class="bt-scroll">sobre n&oacute;s</a>
                </li>
                <li>
                	<a href="#portfolio" class="bt-scroll">portf&oacute;lio</a>
                </li>
                <li>
                	<a href="#contato" class="bt-scroll">contato</a>
                </li>
            </ul>
        </nav>
    </section>
</header>
<!-- Header Section Alternative -->

<!-- Body Section -->
<section class="body-section">
	<section class="portfolio" id="portfolio">
    	<div class="content-animate-portfolio">
        	<div class="bt-fecha-projeto">
                <a href="#">
                    <span>fecha</span>
                </a>
            </div>
            <div class="content-item-portfolio"></div>
        </div>
    	<ul class="lista-portfolio">
        	<?php
                $sqlConsulta 	= "SELECT * FROM portfolio";
                $resultConsulta = consulta_db($sqlConsulta);
                $num_rows 		= mysql_num_rows($resultConsulta);
                while($consulta = mysql_fetch_object($resultConsulta)){
			?>
        	<li class="min-projeto">
                <div class="inf-projeto">
                   	<span class="tit-projeto"><?php echo $consulta->tit_portfolio; ?></span>
                    <a href="#projeto-1" title="<?php echo utf8_encode($consulta->tit_portfolio); ?>" class="link-projeto bt-scroll-projeto" id="<?php echo $consulta->id_portfolio; ?>">
                    	<span>mais</span>
                    </a>
                </div>
                <?php
					$sqlConsultaImagens		= "SELECT * FROM portfolio_imagens WHERE id_portfolio = $consulta->id_portfolio ORDER by id_imagem ASC LIMIT 1";
					$resultConsultaImagens 	= consulta_db($sqlConsultaImagens);
					$num_rows_imagens 		= mysql_num_rows($resultConsultaImagens);
					while($consultaImagens = mysql_fetch_object($resultConsultaImagens)){
				?>
                	<img src="uploads/<?php echo $consultaImagens->imagem; ?>" alt="" class="img-projeto" />
                <?php } ?>
            </li>
            <?php
            	}
				echo "<script type='text/javascript'>
					var script 	= document.createElement('script');
					script.src 	= 'js/script.js';
					script.type	= 'text/javascript';
					var mBody = document.getElementsByTagName('body')[0];
					mBody.appendChild(script);
            	</script>";
			?>
        </ul>
    </section>
    <section class="sobre-nos" id="sobre-nos">
    	<section class="content-sobre-nos content-responsive">
            <div class="content-interno content-left">
                <h2><span class="tit-page tit-black">//sobre n&oacute;s</span> <span class="tit-page tit-white">about us</span></h2>
                <p class="tx-page tx-sobre-nos">
                    A Intr&eacute;pido 53 &eacute; formada por profissionais que compartilham as experi&ecirc;ncias e valores para a execu&ccedil;&atilde;o de um projeto consistente.<br /><br /><br />
                    Acreditamos no poder do design na transforma&ccedil;&atilde;o de vidas e marcas.
                </p>
                <p class="frase-sobre-nos"><span class="first-text">"somos pequenos,</span><span class="second-text">pensamos grande"</span></p>
            </div>
            <div class="content-interno content-right">
                <h2><span class="tit-page tit-black">//alguns </span> <span class="tit-page tit-white">clientes</span></h2>
                <ul class="lista-clientes">
                    <?php
                        for($i=1; $i<=12; $i++){
                    ?>
                            <li>
                                <img src="img/cliente-<?php echo $i; ?>.png" />
                            </li>
                    <?php } ?>
                </ul>
            </div>
        </section>
    </section>
    <section class="o-que-fazemos" id="o-que-fazemos">
    	<section class="content-o-que-fazemos content-responsive">
            <h2><span class="tit-page tit-yellow">//o que fazemos</span> <span class="tit-page tit-white">what we do</span></h2>
            <ul>
                <li class="item-what-we-do">
                    <img src="img/img-what-1.png" class="img-what" alt="branding" />
                    <h3 class="tit-item-what">branding</h3>
                    <p class="tx-what">Estrat&eacute;gia, cria&ccedil;&atilde;o de marca, sistema de identidade visual de empresas, produtos, servi&ccedil;os e eventos.</p>
                </li>
                <li class="item-what-we-do">
                    <img src="img/img-what-2.png" class="img-what" alt="design gr&aacute;fico" />
                    <h3 class="tit-item-what">design gr&aacute;fico</h3>
                    <p class="tx-what">Editorial, perfil Institucional, relat&oacute;rio anual, apresenta&ccedil;&atilde;o corporativa, embalagens e ilustra&ccedil;&atilde;o.</p>
                </li>
                <li class="item-what-we-do">
                    <img src="img/img-what-3.png" class="img-what" alt="projetos interativos" />
                    <h3 class="tit-item-what">projetos interativos</h3>
                    <p class="tx-what">Sites, portais, games, arquitetura da informa&ccedil;&atilde;o, campanhas online, aplicativo mobile.</p>
                </li>
            </ul>
        </section>
    </section>
    <section class="contato" id="contato">
        <div class="box-contato content-responsive">
        	<h2><span class="tit-page tit-black">//fale conosco</span> <span class="tit-page tit-white">contact us</span></h2>
            <form role="form" name="fale-conosco" id="fale-conosco" class="fale-conosco" novalidate>
                <div class="content-form">
                	<div class="form-group-1">
                        <div class="form-group">
                            <label for="nome">Seu nome*</label>
                            <input type="text" class="form-control" id="nome" name="nome" />
                        </div>
                        <div class="form-group">
                            <label for="email">Seu e-mail*</label>
                            <input type="text" class="form-control" id="email" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="assunto">Assunto</label>
                            <input type="text" class="form-control" id="assunto" name="assunto" />
                        </div>
                    </div>
                    <div class="form-group-2">
                        <div class="form-group form-group-right">
                            <label for="mensagem">Digite sua mensagem*</label>
                            <textarea id="mensagem" name="mensagem"></textarea>
                        </div>
                        <div class="form-group form-group-right">
                            <button type="submit" class="btn btn-default">enviar mensagem</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="btn-topo">
                <a href="#topo" class="link-btn-topo bt-scroll">
                    <span class="tx-bt-topo">topo</span>
                </a>
            </div>
        </div>
    </section>
</section>
<!-- Body Section -->

<!-- Footer Section -->
<footer class="footer">
	<div class="content-footer content-responsive">
        <div class="pull-left">
            <div class="pg-social-face">
                <div class="fb-like-box" data-href="https://www.facebook.com/intrepido53" data-width="486" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
            </div>
        </div>
        <div class="pull-right">
            <div class="contact">
                <div class="tel">
                    <span class="tel-1">
                        <span class="ddd">43</span>
                        <span class="phone-number">
                        	<a href="tel:+554330171746" title="(43) 3017-1746">3017-1746</a> |
                        </span>
                    </span>
                    <span class="tel-2">
                        <span class="ddd">43</span>
                        <span class="phone-number">
                        	<a href="tel:+554399378427" title="(43) 9937-8427">9937-8427</a>
                        </span>
                    </span>
                </div>
                <div class="email">
                    <span class="email-address">
                    	<a href="mailto:contato@intrepido53.com.br" title="contato@intrepido53.com.br">contato@intrepido53.com.br
                    </span>
                </div>
            </div>
        </div>
        <div class="copyright-author">
            <p class="copyright">&copy; Copyright 2013-2015 Intr&eacute;pido 53 - Todos os direitos reservados</p>
        </div>
    </div>
</footer>
<!-- Footer Section -->

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	ga('create', 'UA-58717564-2', 'auto');
	ga('send', 'pageview');

</script>

<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>

<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>

<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		setListaPortfolio = function(){
			largJanela = $(window).width();
			if(parseInt(largJanela) > 1366){
				itensHor = 5;
			} else if(parseInt(largJanela) > 1024 && parseInt(largJanela) <= 1366){
				itensHor = 4;
			} else if(parseInt(largJanela) > 800 && parseInt(largJanela) <= 1024){
				itensHor = 3;
			} else if(parseInt(largJanela) > 400 && parseInt(largJanela) <= 800){
				itensHor = 2;
			} else if(parseInt(largJanela) <= 400){
				itensHor = 1;
			}
			calulaItensPort(largJanela, itensHor);
		}
		
		abreProjeto = function(){
			setTimeout(function(){
				$(".content-animate-portfolio").animate({
					height: $(".content-item-portfolio").height()
				}, 1000, function(){
					topPage = parseInt($("#portfolio").offset().top)-parseInt($(".header-alternative").height());
					$("html, body").animate({
						scrollTop: topPage
					}, 900, function(){
						fechaLoading();
					});
				});
			}, 1000);
		}
		
		$(window).resize(function(){
			var itensPortHeight = $(".content-item-portfolio").height();
			$(".content-animate-portfolio").animate({
				height: itensPortHeight
			}, 100, function(){
				//
			});
			setListaPortfolio();
			ajustaTamContent();
		});
		
		trocaImagemPortfolio = function(){
			$(".list-imagens-item li img").on("click", function(e){
				e.preventDefault();
				e.stopPropagation();
				var $this = $(this);
				var novaImagemDestaque = $this.attr("src");
				var imagemDestaque = $(".content-item-portfolio .item-foto ul li img").attr("src");
				$(".content-item-portfolio .item-foto ul li img").attr("src", novaImagemDestaque);
			});
		}
		
		var target = document.querySelector(".content-item-portfolio");
		var observer = new MutationObserver( handleMutationObserver );
		var config = {childList: true, subtree: true, attributes: true, characterData: true, attributeOldValue: true, characterDataOldValue: true, attributeFilter: ["id", "dir"]};
		function handleMutationObserver( mutations ) {
			mutations.forEach(function(mutation) {
				trocaImagemPortfolio();
			});
		}
		observer.observe( target, config );
	});
</script>
</body>
</html>
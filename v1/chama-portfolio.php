<?php

header("Content-Type: text/html; charset=utf8",true);
include_once("inc/config.php");

$idProjeto = $_REQUEST['idProjeto'];
				
$returnItem = "";

$sqlConsulta 	= "SELECT * FROM portfolio WHERE id_portfolio = $idProjeto";
$resultConsulta = consulta_db($sqlConsulta);
$num_rows 		= mysql_num_rows($resultConsulta);
while($consulta = mysql_fetch_object($resultConsulta)){

	$returnItem .= "<div class='item-foto pull-left'>
		<ul id='slideshow'>
			<li>";
				$sqlConsultaImagem		= "SELECT * FROM portfolio_imagens WHERE id_portfolio = $consulta->id_portfolio ORDER by id_imagem ASC LIMIT 1";
				$resultConsultaImagem 	= consulta_db($sqlConsultaImagem);
				$num_rows_imagem 		= mysql_num_rows($resultConsultaImagem);
				while($consultaImagem = mysql_fetch_object($resultConsultaImagem)){
					$returnItem .= "<img src='uploads/$consultaImagem->imagem' alt='".utf8_encode($consulta->tit_portfolio)."' />";
				}
			$returnItem .= "</li>
		</ul>
	</div>
	<div class='item-conteudo pull-right'>
		<h4>".utf8_encode($consulta->tit_portfolio)."</h4>
		<p>
			".utf8_encode($consulta->tx_portfolio)."
		</p>
		<ul class='list-imagens-item'>";
			$sqlConsultaImagens		= "SELECT * FROM portfolio_imagens WHERE id_portfolio = $consulta->id_portfolio ORDER by id_imagem ASC";
			$resultConsultaImagens 	= consulta_db($sqlConsultaImagens);
			$num_rows_imagens 		= mysql_num_rows($resultConsultaImagens);
			while($consultaImagens = mysql_fetch_object($resultConsultaImagens)){
				$returnItem .= 	"<li>
				<img src='uploads/$consultaImagens->imagem' alt='".utf8_encode($consulta->tit_portfolio)."' />
			</li>";
			}
		$returnItem .= "</ul>
	</div>";
}

echo $returnItem;
?>
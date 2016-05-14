<?php
	include("../inc/config.php");
	
	$acao	= $_REQUEST['acao'];
	$id		= $_REQUEST['id'];
	
	$arrayItens = $_REQUEST['arrayItens'];
	
	echo $tit_portfolio	= utf8_decode($_REQUEST['tit_portfolio']);
	echo $tx_portfolio	= utf8_decode($_REQUEST['tx_portfolio']);
	
	$arrayImagens	= $_FILES['img_destaque'];

	//echo count($arrayImagens['type'])."<br />";

	exit();

	/*echo "<pre>";
	print_r($arrayImagens);
	echo "</pre>";

	exit();*/
	
	function selectUltimo(){
		$sqlUltimo	= "SELECT MAX(id_portfolio) as ultimo_id FROM portfolio";
		$resultConsulta	= consulta_db($sqlUltimo);
		while($consulta	= mysql_fetch_object($resultConsulta)){
			return $consulta->ultimo_id;
		}
	}
	
	function inserePortfolio($tit_portfolio, $tx_portfolio){
		$sqlInserePortfolio = "INSERT INTO portfolio (tit_portfolio, tx_portfolio) VALUES ('$tit_portfolio', '$tx_portfolio');";
		return insert_db($sqlInserePortfolio);
	}
	
	function inserePortfolioImagens($id_portfolio, $imagem){
		$sqlInserePortfolioImagens = "INSERT INTO portfolio_imagens (id_portfolio, imagem) VALUES ($id_portfolio, '$imagem');";
		//echo $sqlInserePortfolioImagens."<br />";
		//exit();
		return insert_db($sqlInserePortfolioImagens);
	}
	
	function deletePortfolio($id){
		$sqlDelete = "DELETE FROM `portfolio` WHERE `id_portfolio` = $id";
		if(deleta_db($sqlDelete)){
			$sqlDeleteImagens = "DELETE FROM `portfolio_imagens` WHERE `id_portfolio` = $id";
			$sqlDelete 				= "DELETE FROM `portfolio_imagens` WHERE `id_imagem` = $id_imagem";
			
			$sqlConsultaImagens		= "SELECT `imagem` FROM `portfolio_imagens` WHERE `id_portfolio` = $id";
			$resultConsultaImagens 	= consulta_db($sqlConsultaImagens);
			while($consultaImagens = mysql_fetch_object($resultConsultaImagens)){
				$arquivo = "../uploads/".$consultaImagens->imagem;
			}
			if(deleta_db($sqlDeleteImagens)){
				if (unlink($arquivo)){
					//echo "sucesso";
				} else {
					//echo ("Erro ao deletar $arquivo");
				}
			}
		} else {
			//echo "erro";
		}
	}
	
	function uploadImg($arrayImagens, $ultimoId){

		$pasta = "../uploads/";
    
		/* formatos de imagem permitidos */
		$permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");

		//FAZ O UPLOAD DAS IMAGENS ENQUANTO EXISTIREM
		for($qt=0; $qt < count($arrayImagens['type']); $qt++){
			
			$nome_imagem    = $arrayImagens['name'][$qt];
			$tamanho_imagem = $arrayImagens['size'][$qt];

			/* pega a extensão do arquivo */
			$ext = strtolower(strrchr($nome_imagem,"."));
			
			/*  verifica se a extensão está entre as extensões permitidas */
			if(in_array($ext,$permitidos)){
				/* converte o tamanho para KB */
				$tamanho = round($tamanho_imagem / 1024);
				//echo $tamanho."<br />";
				if($tamanho < 4096){ //se imagem for até 1MB envia
					$nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
					$tmp = $arrayImagens['tmp_name'][$qt]; //caminho temporário da imagem

					//echo $nome_atual."<br />";
					
					/* se enviar a foto, insere o nome da foto no banco de dados */
					if(move_uploaded_file($tmp,$pasta.$nome_atual)){
						//echo $nome_atual."<br />";
						//mysql_query("INSERT INTO fotos (foto) VALUES (".$nome_atual.")");
						inserePortfolioImagens($ultimoId, $nome_atual);
					} else {
						//echo "Falha ao enviar";
						echo "<script type='text/javascript'>alert('Falha ao enviar!'); history.back();</script>";
					}
				} else {
					//echo "A imagem deve ser de no máximo 2MB";
					echo "<script type='text/javascript'>alert('A imagem deve ser de no máximo 2MB!'); history.back();</script>";
				}
			} /*else {
				//echo "Somente são aceitos arquivos do tipo Imagem";
				echo "<script type='text/javascript'>alert('Somente são aceitos arquivos do tipo Imagem!'); //history.back();</script>";
			}*/
		}
		//exit();
		echo "<script type='text/javascript'>alert('Cadastro efetuado com sucesso!'); window.location = 'portfolios.php';</script>";
	}
	
	if($acao == ""){
		if(inserePortfolio($tit_portfolio, $tx_portfolio)){
			$ultimoId = selectUltimo();
			//exit();
			uploadImg($arrayImagens, $ultimoId);
		}
	} else if($acao == "excluir"){
		$arrayData = montaArray($arrayItens, ",");
		$t = sizeof($arrayData);
		for($i=0; $i<$t; $i++){
			$arrayData[$i];
			deletePortfolio($arrayData[$i]);
		}
		echo "sucesso";
	} else if($acao == "edit_portfolio"){
		$id_portfolio = $_REQUEST["id_portfolio"];
		
		$sqlEdit = "UPDATE portfolio SET tit_portfolio='$tit_portfolio', tx_portfolio='$tx_portfolio' WHERE id_portfolio=$id_portfolio";
		if(edita_db($sqlEdit)){
			echo "sucesso";
		}
	} else if($acao == "edit_image"){
		$id_imagem 		= $_REQUEST["id_imagem"];
		$tmp			= $_FILES['img_teste_'.$id_imagem]['tmp_name'];
		$nome_imagem 	= $_FILES['img_teste_'.$id_imagem]['name'];
		$tamanho_imagem = $_FILES['img_teste_'.$id_imagem]['size'];
		
		$pasta = "../uploads/";
		
		/* formatos de imagem permitidos */
		$permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
		
		/* pega a extensão do arquivo */
		$ext = strtolower(strrchr($nome_imagem,"."));
		
		/*  verifica se a extensão está entre as extensões permitidas */
		if(in_array($ext,$permitidos)){
			/* converte o tamanho para KB */
			$tamanho = round($tamanho_imagem / 2048);
			if($tamanho < 2048){ //se imagem for até 1MB envia
				$nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
				
				/* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp,$pasta.$nome_atual)){
					$sqlEdit = "UPDATE portfolio_imagens SET imagem='$nome_atual' WHERE id_imagem=$id_imagem";
					if(edita_db($sqlEdit)){
						echo "<img width='80' rel='57' src='../uploads/$nome_atual'>";
					}
					//inserePortfolioImagens($ultimoId, $nome_atual);
				} else {
					//echo "Falha ao enviar";
					echo "<script type='text/javascript'>alert('Falha ao enviar!'); history.back();</script>";
				}
			} else {
				//echo "A imagem deve ser de no máximo 2MB";
				echo "<script type='text/javascript'>alert('A imagem deve ser de no máximo 2MB!'); history.back();</script>";
			}
		}
	} else if($acao == "deleta_imagem"){
		$id_imagem 				= $_REQUEST["id_imagem"];
		$sqlDelete 				= "DELETE FROM `portfolio_imagens` WHERE `id_imagem` = $id_imagem";
		$sqlConsultaImagens		= "SELECT `imagem` FROM `portfolio_imagens` WHERE `id_imagem` = $id_imagem";
		$resultConsultaImagens 	= consulta_db($sqlConsultaImagens);
		while($consultaImagens = mysql_fetch_object($resultConsultaImagens)){
			$arquivo = "../uploads/".$consultaImagens->imagem;
		}
		if(deleta_db($sqlDelete)){
			if (unlink($arquivo)){
				echo "sucesso";
			} else {
				echo ("Erro ao deletar $arquivo");
			}
		}
	} else if($acao == "add_nova_image"){
		$id_portfolio		= $_REQUEST["id_portfolio"];
		$id_controle		= $_REQUEST["id_controle"];
		$tmp				= $_FILES["add_nova_image_".$id_controle]["tmp_name"];
		$nome_imagem 		= $_FILES["add_nova_image_".$id_controle]["name"];
		$tamanho_imagem 	= $_FILES["add_nova_image_".$id_controle]["size"];
		
		$pasta = "../uploads/";
		
		/* formatos de imagem permitidos */
		$permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
		
		/* pega a extensão do arquivo */
		$ext = strtolower(strrchr($nome_imagem,"."));
		
		/*  verifica se a extensão está entre as extensões permitidas */
		if(in_array($ext,$permitidos)){
			/* converte o tamanho para KB */
			$tamanho = round($tamanho_imagem / 2048);
			if($tamanho < 2048){ //se imagem for até 1MB envia
				$nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
				
				/* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp,$pasta.$nome_atual)){
					$sqlEdit = "INSERT INTO portfolio_imagens (id_portfolio, imagem) VALUES ($id_portfolio, '$nome_atual');";
					if(edita_db($sqlEdit)){
						echo "<img width='80' rel='57' src='../uploads/$nome_atual'>";
					}
					//inserePortfolioImagens($ultimoId, $nome_atual);
				} else {
					//echo "Falha ao enviar";
					echo "<script type='text/javascript'>alert('Falha ao enviar!'); history.back();</script>";
				}
			} else {
				//echo "A imagem deve ser de no máximo 2MB";
				echo "<script type='text/javascript'>alert('A imagem deve ser de no máximo 2MB!'); history.back();</script>";
			}
		}
	}
?>
<?php
	include("../inc/config.php");
	$id			= $_REQUEST['id'];
	$arrayItens = $_REQUEST['arrayItens'];
	
	function deleteContato($id){
		$sqlDelete = "DELETE FROM `contato` WHERE `id_contato` = $id";
		if(deleta_db($sqlDelete)){
			//echo "sucesso";
		} else {
			//echo "erro";
		}
	}
	
	if($id != ""){
		function lerMensagem($id){
			$sqlLerMensagem = "UPDATE contato SET status='1' WHERE id_contato='$id';";
			return insert_db($sqlLerMensagem);
		}
		
		if(lerMensagem($id)){
			echo "sucesso";
		}
	} else {
		$arrayData = montaArray($arrayItens, ",");
		$t = sizeof($arrayData);
		for($i=0; $i<$t; $i++){
			$arrayData[$i];
			deleteContato($arrayData[$i]);
		}
		echo "sucesso";
	}
?>
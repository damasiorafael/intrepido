<?php
//header("Content-Type: text/html; charset=utf8",true);
session_start();
//error_reporting(E_ALL);
error_reporting(E_ERROR);
/*$host 	= "dbmy0044.whservidor.com";
$user	= "construpav";
$pass	= "@construp";
$bd		= "construpav";*/
if($_SERVER['SERVER_NAME'] == "localhost"){
	$host 	= "localhost";
	$user	= "root";
	$pass	= "";
	$bd		= "intrepido";
} else {
	/*
	$host 	= "localhost";
	$user	= "intrepYC2unLmXBH";
	$pass	= "6sk9pdjvuT8n23l";
	$bd		= "intrepido53_com_br";
	*/

	$host 	= "localhost";
	$user	= "intrephisSfTQHkc";
	$pass	= "9WGaiuv8DAd1hYK";
	$bd		= "intrepido53_com_br";
}

//$con = mysql_pconnect('localhost','root','');
//$db = mysql_select_db('construpaver');

$con = mysql_connect($host,$user,$pass);
$db = mysql_select_db($bd);

function protecao($string){

  // Passando a primeira letra pra Maiúsculo e o restante pra minúsculo 
  //$string = strtolower($string);
  
  // Verificando alguns elementos que não podem ser passado por POST e nem por GET, e trocando eles por vazio... 
  $string = str_replace("select", "", $string);
  $string = str_replace("delete", "", $string);
  $string = str_replace("create", "", $string);
  $string = str_replace("drop", "", $string);
  $string = str_replace("update", "", $string);
  $string = str_replace("drop table", "", $string);
  $string = str_replace("show table", "", $string);
  $string = str_replace("applet", "", $string);
  $string = str_replace("object", "", $string);
  $string = str_replace("'", "", $string);
  $string = str_replace("#", "", $string);
  $string = str_replace("=", "", $string);
  $string = str_replace("--", "", $string);
  $string = str_replace("-", "", $string);
  $string = str_replace(";", "", $string);
  $string = str_replace("*", "", $string);
  $string = strip_tags($string);
 
  return $string;
}

function consulta_db($sql){
	return mysql_query($sql);
}

function insert_db($sql){
	return mysql_query($sql);
}

function edita_db($sql){
	return mysql_query($sql);
}

function deleta_db($sql){
	return mysql_query($sql);
}

function formata_data($data){
	$data = explode(" ", $data);

	$data1 = $data[0]; // DATA (xxxx-xx-xx)
	$data2 = $data[1]; // HORA (xx:xx:xx)
	
	$data1 = explode("-", $data1);
	$dia = $data1[2]; // Retorna o dia
	$mes = $data1[1]; // Retorna o mês
	$ano = $data1[0]; // Retorna o ano
	
	$data = $dia . "/" . $mes . "/" . $ano . " às " . $data2;
	return $data;
}

function montaArray($data, $separador){
	$data = explode($separador, $data);
	return $data;
}

?>
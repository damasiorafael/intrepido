<?php

header("Content-Type: text/html; charset=utf8",true);
include_once("inc/config.php");

$destinatarios	= "formulario@intrepido53.com.br";
$destinatario 	= utf8_decode("Intrépido 53");
$usuario 		= "formulario@intrepido53.com.br";
$senha 			= "@intrepido2015";
//$usuario 		= "damasio.rafael@gmail.com";
//$senha 			= "Damasio.8560";

/*abaixo as veriaveis principais, que devem conter em seu formulario*/
$nome 			= protecao(utf8_decode($_REQUEST['nome']));
$email 			= protecao(utf8_decode($_REQUEST['email']));
$assunto		= protecao(utf8_decode($_REQUEST['assunto']));
$mensagem		= protecao(utf8_decode($_REQUEST['mensagem']));

function data_contato(){
	return date("Y-m-d H:i:s");
}

function insereContato($nome, $email, $assunto, $mensagem){
	$sqlInsereContato = "INSERT INTO contato (nome, email, assunto, mensagem, data_contato) VALUES ('$nome', '$email', '$assunto', '$mensagem', '".data_contato()."');";
	
	return insert_db($sqlInsereContato);
}

//exit();

/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/
include_once("inc/phpmailer/class.phpmailer.php");

$To = $destinatarios;
$Subject = utf8_decode("Mensagem através do site");
$bodyMensagem = "";
$bodyMensagem .= "<strong>Nome:</strong> ".utf8_encode($nome)." <br />";
$bodyMensagem .= "<strong>E-mail:</strong> $email <br />";
if(isset($assunto)) $bodyMensagem .= "<strong>Assunto:</strong> ".utf8_encode($assunto)." <br />";
$bodyMensagem .= "<strong>Mensagem:</strong> ".utf8_encode($mensagem);
$Message = $bodyMensagem;

$Host = "smtp.gmail.com";
$Username = $usuario;
$Password = $senha;
$Port = "587";

$mail = new PHPMailer();
$body = $Message;
//$mail->IsHtml(); // telling the class to use HTML
$mail->Host = $Host; // SMTP server
//$mail->SMTPDebug = 1; // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "tls";	// SSL REQUERIDO pelo GMail
$mail->Port = $Port; // set the SMTP port for the service server
$mail->Username = $Username; // account username
$mail->Password = $Password; // account password

$mail->SetFrom($usuario, $destinatario);
$mail->Subject = $Subject;
$mail->MsgHTML($body);
$mail->AddAddress($To);

//echo $body;

if(insereContato($nome, $email, $assunto, $mensagem)){
	if(!$mail->Send()) {
		echo 'Erro ao enviar e-mail: '. print($mail->ErrorInfo);
	} else {
		echo 'sucesso';
	}
}
?>
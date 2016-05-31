<?php
    echo sha1("Admin@Intrepido2016");
	include("../inc/config.php");
	if((isset($_SESSION['username']) == true) and (isset($_SESSION['senha']) == true)) header('Location: index.php');//CRIAR REDIRECIONAMENTO PRA INDEX
	if((isset($_POST['username']) == true) and (isset($_POST['senha']) == true)){
		$username 	= protecao($_POST['username']);
		$senha		= protecao($_POST['senha']);
		
		$msgErroUser			= "Usuário não encontrado!";
		$msgErroSenha			= "Senha incorreta!";
		$msgErroSenhaCaractere	= "Sua senha não deve conter caracteres como: ' # = -- - ; *";
		
		$sqlUser 			= "SELECT username FROM usuarios WHERE username = '$username' AND ativo = '1'";
		$resultConsultaUser = consulta_db($sqlUser);
		$numRowsUser		= mysql_num_rows($resultConsultaUser);
		$consultaUser	 	= mysql_fetch_object($resultConsultaUser);
		if($numRowsUser > 0){
			$_SESSION['username'] 	= $consultaUser->username;
			$sqlSenha 				= "SELECT senha FROM usuarios WHERE username = '".$_SESSION['username']."' AND senha = '".SHA1($senha)."'";
			$resultConsultaSenha 	= consulta_db($sqlSenha);
			$numRowsSenha			= mysql_num_rows($resultConsultaSenha);
			$consultaSenha	 		= mysql_fetch_object($resultConsultaUser);
			if($numRowsSenha > 0){
				$_SESSION['senha'] = $consultaSenha->senha;
				header('Location: index.php');
			} else {
				echo "<script type='text/javascript'>alert('".$msgErroSenha."');</script>";
			}
		} else {
			unset($_SESSION['username']);
			echo "<script type='text/javascript'>alert('".$msgErroUser."');</script>";
		}
	} else {
		unset($_SESSION['username']);
		unset($_SESSION['senha']);
	}
?>
<!DOCTYPE html>
<html class="bg-gray">
    <head>
        <meta charset="UTF-8">
        <title>Admin - Intrépido 53 | Login</title>
        <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="../img/favicon.ico" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-gray">
        <div class="form-box" id="login-box">
            <div class="header">
                <div class="container-logo">
                    <a href="index.php" title="home" class="logo-home">
                        <span>home</span>
                    </a>
                </div>
            </div>
            <form action="login.php" method="post">
                <div class="body bg-gray-2">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Usuário (e-mail)" value="<?php if((isset($_SESSION['username']) == true)) echo $_SESSION['username']; ?>" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="senha" class="form-control" placeholder="Senha" value="" />
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-red btn-block">Entrar</button>
                </div>
            </form>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>

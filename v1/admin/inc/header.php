<!-- header logo: style can be found in header.less -->
<header class="header">
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <div class="container-logo container-logo-internas">
                    <a href="index.php" title="home" class="logo-home">
                        <span>home</span>
                    </a>
                </div>
                <div class="container-menu-itens">
                    <ul class="nav-menu menu-admin">
                        <li class="user user-menu menu-right">
                            <a href="index.php" class="dropdown-toggle">
                                <i class="fa fa-envelope"></i>
                                <span>Contatos</span>
                            </a>
                        </li>
                        <li class="user user-menu menu-right">
                            <a href="portfolios.php" class="dropdown-toggle">
                                <i class="fa fa-th"></i>
                                <span>Portfólios</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <?php
                    $sqlConsultaStatus 		= "SELECT * FROM contato WHERE status = '0'";
                    $resultConsultaStatus 	= consulta_db($sqlConsultaStatus);
                    $numRowsStatus 			= mysql_num_rows($resultConsultaStatus);
                ?>
                <li class="dropdown messages-menu">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                        <span class="label label-success"><?php echo $numRowsStatus; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">
                            <a href="index.php" class="link-no-efeito">Você tem <?php echo $numRowsStatus; ?> mensagens não lidas</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>Admin <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="img/avatar5.png" class="img-circle" alt="User Image" />
                            <p>
                                Bem vindo!
                                <small>Admin</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="logout.php" class="btn btn-default btn-flat">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
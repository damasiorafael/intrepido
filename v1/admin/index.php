<?php
header("Content-Type: text/html; charset=utf8",true);
include("../inc/config.php");

if((!isset($_SESSION['username']) == true) and (!isset($_SESSION['senha']) == true)) header('Location: login.php');
//CRIAR REDIRECIONAMENTO PRA INDEX

?>
<!DOCTYPE html>
<html>
    <?php include("inc/head.php"); ?>
    <body class="skin-blue">
        <?php include("inc/header.php"); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside>
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Admin
                        <small>Painel de controle</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><i class="fa fa-envelope"></i> Contatos</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Main row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Contatos</h3>
                                    <span class="deleteItens button label bt-disable" type="button" rel="">Excluir itens selecionados</span>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table id="example2" class="table table-hover">
                                        <thead>
                                            <tr>
                                            	<th>
                                                	<div class="checkbox checkbox-select-all">
                                                        <label>
                                                            <input class="check-all" type="checkbox" name="checkAll" />
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>E-mail</th>
                                                <th>Assunto</th>
                                                <th>Mensagem</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
												$sqlConsulta 	= "SELECT * FROM contato";
												$resultConsulta = consulta_db($sqlConsulta);
												$num_rows 		= mysql_num_rows($resultConsulta);
												while($consulta = mysql_fetch_object($resultConsulta)){
											?>
                                            <tr>
                                            	<td>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input class="check-item" type="checkbox" value="<?php echo $consulta->id_contato; ?>">
                                                        </label>
                                                    </div>
                                                </td>
                                            	<td><?php echo $consulta->id_contato; ?></td>
                                                <td><?php echo utf8_encode($consulta->nome); ?></td>
                                                <td><?php echo $consulta->email; ?></td>
                                                <td><?php echo utf8_encode($consulta->assunto); ?></td>
                                                <td><?php echo utf8_encode($consulta->mensagem); ?></td>
                                                <td><?php echo formata_data($consulta->data_contato); ?></td>
                                                <td>
                                                	<?php if($consulta->status == 0){ ?>
                                                		<span class="button label label-danger" rel="<?php echo $consulta->id_contato; ?>">Não lido</span>
                                                    <?php } else { ?>
                                                    	<span class="button label label-success" rel="<?php echo $consulta->id_contato; ?>">Lido</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <?php
											if($num_rows > 1){
										?>
                                        <tfoot>
                                            <tr>
                                            	<th>
                                                	<div class="checkbox checkbox-select-all">
                                                        <label>
                                                            <input class="check-all" type="checkbox" name="checkAll" />
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>E-mail</th>
                                                <th>Assunto</th>
                                                <th>Mensagem</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                        <?php } ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <?php include("inc/footer.php"); ?>

    </body>
</html>
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
        <?php /*?><li style="float: none;" class="liNovaImagem novaImagem_0">
        	<div id="nova-imagem-added_0" class="nova-imagem-edit"></div>
            <form enctype="multipart/form-data" action="portfolio-envia.php" class="add-img-portfolio_0" method="post" novalidate>
            	<input type="hidden" value="add_nova_image" name="acao"><input type="hidden" value="0" name="id_controle">
                <input type="hidden" value="20" name="id_portfolio">
                <input type="file" class="add_nova_image" name="add_nova_image_0" id="add_nova_image_0">
            </form>
        </li><?php */?>
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
                        <li class="active"><i class="fa fa-th"></i> Portfólios</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Main row -->
                    <div class="row">
                    <!-- left column -->
                        <div class="col-md-4">
                            <!-- general form elements -->
                            <div class="box box-primary box-form">
                                <div class="box-header">
                                    <h3 class="box-title">Cadastrar portfólio</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form name="portfolio" id="portfolio" class="portfolio" enctype="multipart/form-data" action="portfolio-envia.php" method="post" novalidate>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="tit_portfolio">Título</label>
                                            <input type="text" class="form-control" id="tit_portfolio" name="tit_portfolio" placeholder="Título" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tx_portfolio">Descrição</label>
                                            <textarea class="form-control textarea" id="tx_portfolio" name="tx_portfolio"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="img_destaque">Imagens <span class="text-orange" style="font-size: 12px; font-weight: lighter;">(A primeira imagem será o destaque)</span></label>
                                            <input type="file" id="img_destaque" name="img_destaque[]" multiple />
                                            <p class="help-block text-orange">Imagens com proporção de 1024x575px</p>
                                            <div id="visualizar"></div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                        <div class="col-xs-8">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Portfólios</h3>
                                    <span class="deleteItensPortfolio button label bt-disable" type="button" rel="">Excluir itens selecionados</span>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table id="example2" class="table table-hover">
                                        <thead>
                                            <tr>
                                            	<th>&nbsp;</th>
                                                <th>ID</th>
                                                <th>Título</th>
                                                <th>Descrição</th>
                                                <th>Imagens</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
												$sqlConsulta 	= "SELECT * FROM portfolio";
												$resultConsulta = consulta_db($sqlConsulta);
												$num_rows 		= mysql_num_rows($resultConsulta);
												while($consulta = mysql_fetch_object($resultConsulta)){
											?>
                                            <tr rel="<?php echo $consulta->id_portfolio; ?>">
                                            	<td class="td-checkbox">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input class="check-item-port" type="checkbox" value="<?php echo $consulta->id_portfolio; ?>">
                                                        </label>
                                                    </div>
                                                </td>
                                            	<td class="td-id-portfolio"><?php echo $consulta->id_portfolio; ?></td>
                                                <td class="td-tit-portfolio">
													<span class="mostra"><?php echo utf8_encode($consulta->tit_portfolio); ?></span>
                                                    <div class="form-group esconde">
                                                        <input type="text" class="form-control edit_tit_portfolio" id="edit_tit_portfolio_<?php echo $consulta->id_portfolio; ?>" name="edit_tit_portfolio_<?php echo $consulta->id_portfolio; ?>" value="<?php echo utf8_encode($consulta->tit_portfolio); ?>" />
                                                    </div>
                                                </td>
                                                <td class="td-tx-portfolio">
													<span class="mostra"><?php echo utf8_encode($consulta->tx_portfolio); ?></span>
                                                    <div class="form-group esconde">
                                                        <textarea class="form-control edit_tx_portfolio textarea" id="edit_tx_portfolio_<?php echo $consulta->id_portfolio; ?>" name="edit_tx_portfolio_<?php echo $consulta->id_portfolio; ?>"><?php echo utf8_encode($consulta->tx_portfolio); ?></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                	<?php
														$sqlConsultaImagens		= "SELECT * FROM portfolio_imagens WHERE id_portfolio = $consulta->id_portfolio ORDER by id_imagem ASC";
														$resultConsultaImagens 	= consulta_db($sqlConsultaImagens);
														$num_rows_imagens 		= mysql_num_rows($resultConsultaImagens);
														if($num_rows_imagens > 0){
													?>
                                                    		<ul class="listImagensPortfolio">
                                                    <?php
															while($consultaImagens = mysql_fetch_object($resultConsultaImagens)){
													?>
                                                    			<li rel="<?php echo $consultaImagens->id_imagem; ?>">
                                                                    <div id="nova-imagem-<?php echo $consultaImagens->id_imagem; ?>">
                                                                		<img src="../uploads/<?php echo $consultaImagens->imagem; ?>" width="80" alt="<?php echo utf8_encode($consulta->tit_portfolio); ?>" title="<?php echo utf8_encode($consulta->tit_portfolio); ?>" rel="<?php echo $consultaImagens->id_imagem; ?>" />
                                                                    </div>
                                                                    <span class="btn-delete-port fa fa-times" alt="Deletar" title="Deletar" rel="<?php echo $consultaImagens->id_imagem; ?>"></span>
                                                                    <form name="port_teste_<?php echo $consultaImagens->id_imagem; ?>" id="port_teste_<?php echo $consultaImagens->id_imagem; ?>" class="port_teste" enctype="multipart/form-data" action="portfolio-envia.php" method="post" novalidate>
                                                                        <input type="hidden" name="acao" value="edit_image" />
                                                                        <input type="hidden" name="id_imagem" value="<?php echo $consultaImagens->id_imagem; ?>" />
                                                                        <input type="file" id="img_teste_<?php echo $consultaImagens->id_imagem; ?>" name="img_teste_<?php echo $consultaImagens->id_imagem; ?>" class="img_teste esconde" alt="<?php echo $consultaImagens->id_imagem; ?>" />
                                                                    </form>
                                                                </li>
                                                    <?php
                                                    		}
													?>
                                                    		</ul>
													<?php 
														} else {
													?>
                                                    	<span class="inc-mais-imagem" rel="<?php echo $consulta->id_portfolio; ?>"><i class="fa fa-plus"></i> Imagem</span>
                                                    <?php } ?>
                                                    <span class="inc-mais-imagem esconde" rel="<?php echo $consulta->id_portfolio; ?>"><i class="fa fa-plus"></i> Imagem</span>
                                                </td>
                                                <td>
                                                	<span class="btn-edit-port fa fa-pencil-square-o" alt="Editar" title="Editar" rel="<?php echo $consulta->id_portfolio; ?>"></span>
                                                    <span class="btn-salva-port fa fa-check-square-o" alt="Salvar" title="Salvar" rel="<?php echo $consulta->id_portfolio; ?>"></span>
                                                    <span class="btn-canc-port fa fa-power-off" alt="Cancelar" title="Cancelar" rel="<?php echo $consulta->id_portfolio; ?>"></span>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <?php
											if($num_rows > 1){
										?>
                                        <tfoot>
                                            <tr>
                                            	<th>&nbsp;</th>
                                                <th>ID</th>
                                                <th>Título</th>
                                                <th>Descrição</th>
                                                <th>Imagens</th>
                                                <th>&nbsp;</th>
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
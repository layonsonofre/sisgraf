<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Cadastrar Ordem de Serviço</title>
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/font.css" rel="stylesheet">
        <link href="css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
    	<?php
    		include 'header.php';
    	?>
        <div id="help" class="modal">
            <div class="modal-content">
                <h4>Cadastrar Ordem de Serviço</h4>
                <p>Tela para cadastro de uma nova Ordem de Serviço.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class=" modal-action modal-close waves-effect waves-green btn-flat">Entendi</a>
            </div>
        </div>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <?php
                        if(isset($_GET['at']) && $_GET['at'] == 'ok')
                            echo "<div id='msg' class='card-panel green lighten-2 white-text'>Pessoa atualizada com sucesso!<i class='material-icons right' id='close'>close</i></div>";
                        if(isset($_GET['at']) && $_GET['at'] == 'no')
                            echo "<div id='msg' class='card-panel red lighten-2 white-text'>Dados não atualizados no sistema, tente novamente.<i class='material-icons right' id='close'>close</i></div>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row valign-wrapper">
                    <div class="col s12 l10">
                        <?php
                        $idOrdemDeServico = isset($_GET['idOS']) ? $_GET['idOS'] : '';
                        if($idOrdemDeServico != '') {
                            echo "<h4>Atualizar OS</h4>";
                            $sql = "select * from OrdemDeServico, Pessoa_OrdemDeServico, OrdemDeServiço_TipoServico, Acab_OS_TS, Cor_OrdemDeServico_TipoServico  where OrdemDeServico.idOrdemDeServico=" . $idOrdemDeServico . ";";
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
                        }
                        else {
                            echo "<h4>Cadastrar Ordem de Serviço</h4>";
                        }
                        ?>
                    </div>
                    <div class="col s12 l2 valign">
                        <a class="waves-effect waves-light modal-trigger" href="#help"><i class="material-icons">info</i></a>
                    </div>
                </div>
                <?php
                ?>
                <div class="row">
                    <form class="col s12" role="form" method="POST" action="control/material.php">
                        <div class="row">
						
							<div class="col s12">
                                <p>
									<?php
									echo "É um Orçamento?";
									?>
                                    <input name="isOrcamento" type="radio" id="orcsim" value="true">
                                    <label for="orcsim">Sim&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <input name="isOrcamento" type="radio" id="orcnao" value="false">
                                    <label for="orcnao">Não</label>
                                </p>
                            </div>
							
                            <div class="input-field col s7">
                                <input name="dataEntrada" maxlength="10" id="dataEntrada" type="text" class="validate" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['dataEntrada']."'"; ?>>
                                <label for="dataEntrada" class="active">Data de Entrada</label>
                            </div>
                            <div class="input-field col s7">
                                <input name="dataPrevistaSaida" maxlength="10" id="dataPrevistaSaida" type="text" class="validate" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['dataPrevistaSaida']."'"; ?>>
                                <label for="dataPrevistaSaida" class="active">Data Prevista de Saída</label>
                            </div>
							<?php
							if($idOrdemDeServico != '') {
							?>
								<div class="input-field col s7">
									<input name="dataSaida" maxlength="10" id="dataSaida" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['dataSaida']."'"; ?>>
									<label for="dataSaida" class="active">Data de Saída</label>
								</div>
							<?php
							}
							?>
							
							
							
							<div class="input-field col s10">
								<input name="valorTotal" id="valorTotal" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['valorTotal']."'"; ?>>
								<label for="valorTotal" class="active">Valor Total (R$)</label>
							</div>
							
                        </div>
                        
						<div class="row">
							<div class="input-field col s12">
								<input name="status" id="status" length="24" maxlength="24" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['status']."'"; ?>>
								<label for="status" class="active">Status</label>
							</div>
							
							<div class="input-field col s12">
								<input name="observacoes" maxlength="10" id="observacoes" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['observacoes']."'"; ?>>
								<label for="observacoes" class="active">Observações</label>
							</div>
						
						</div>
						
                        <div class="row">
                            <div class="input-field col s11">
                                <select id="pessoa" name="pessoa[]" multiple>
                                    <option value="" disabled>Selecione o Cliente</option>
                                <?php
                                $sql = "select * from Pessoa;";
                                $query = mysql_query($sql);
                                while($Pessoa = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                    echo "<option value='" . $pessoa['idPessoa'] . "'>" . $pessoa['nome'] . "</option>";
                                }
                                ?>
                                </select>
                                <label>Clientes</label>
                            </div>
                        </div>
						
                        <div id="categoria">
                            <div class="row">
                                <div class="input-field col s11">
                                    <select id="ts" name="ts[]" multiple>
                                        <option value="" disabled>Selecione os tipos de serviço</option>
                                    <?php
                                    $sql = "select * from TipoServico;";
                                    $query = mysql_query($sql);
                                    while($ts = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='".$ts['idTipoServico']."' ";
                                        if(isset($_GET['idPessoa'])) {
                                            $sql2 = "select * from OrdemDeServico_TipoServico where idTipoServico=".$ts['idTipoServico']." and idOrdemDeServico=".$idOrdemDeServico.";";
                                            $query2 = mysql_query($sql2);
                                            if( mysql_num_rows($query2) == 1) {
                                                echo "selected";
                                            }
                                        }
                                        echo ">".$ts['nome']." (" .$ts['descricao'].")</option>";
										
                                    }
                                    ?>
                                    </select>
                                    <label>Tipos de Serviço</label>
                                </div>
                                <div class="col s1">
                                    <a id="incluirCategoria" href="#modalCategoria" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($_GET['idMaterial']))
                            echo "<a class=\"btn waves-effect waves-light red accent-4\" name=\"exlcuir\" onclick=\"document.forms['excluir'].submit()\">Excluir<i class=\"material-icons right\">delete</i></a>";
                            echo "<input type=\"hidden\" name=\"acao\" value=\"incluir\" />";
                            echo "<input type=\"hidden\" name=\"idMaterial\" value=\"" . $idMaterial . "\" />";
                        ?>
                        <button class="btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right">send</i></button>
                        <input type="hidden" name="acao" value="inserir" />
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" />
                    </form>
                    <form role="form" method="POST" name="excluir" action="control/material.php">
                        <input type="hidden" name="acao" value="excluir" />
                        <input type="hidden" name="idMaterial" value="<?php echo $idMaterial; ?>" />
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" />
                    </form>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/jasny-bootstrap.min.js"></script>
        <script src="control/cep/js/cep.js"></script>
    </body>
</html>

<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Incluir Arquivo</title>
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
                <h4>Incluir Arquivo</h4>
                <p>Página para cadastro de arquivos referentes à serviços em execução ou já executados.</p>
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
                            echo "<div class='card-panel green lighten-2 white-text'>Dados atualizados com sucesso!<i class='material-icons right'>close</i></div>";
                        if(isset($_GET['at']) && $_GET['at'] == 'no')
                            echo "<div class='card-panel red lighten-2 white-text'>Dados não atualizados no sistema, tente novamente.<i class='material-icons right'>close</i></div>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row valign-wrapper">
                    <div class="col s12 l10">
                        <?php
						$idArquivo = isset($_GET['idArquivo']) ? $_GET['idArquivo'] : '';
                        if($idArquivo != '') {
                            echo "<h4>Atualizar Arquivo</h4>";
                            $sql = "select * from Arquivo where Arquivo.idArquivo=" . $idArquivo . ";";
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
                        }
                        else {
                            echo "<h4>Cadastrar Arquivo</h4>";
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
                    <form class="col s12" role="form" method="POST" action="control/arquivo.php">
                        <div class="row">
                            <div class="input-field col s5">
                                <input name="nome" id="nome" type="text" class="validate" <?php if(isset($_GET['idArquivo'])) echo "value='".$resultado['nome']."'"; ?>>
                                <label for="nome" class="active">Nome</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="data" id="data" type="text" class="validate right-align" <?php if(isset($_GET['idArquivo'])) echo "value='".$resultado['data']."'"; ?>>
                                <label for="data" class="active">Data</label>
                            </div>
                        </div>
                        <div class="row">
    						<div class="input-field col s11">
                                <select id="OS" name="OS">
                                    <option value="" disabled>Selecione</option>
                                    <?php
                                    $sql = "select * from OrdemDeServico;";
                                    $query = mysql_query($sql);
                                    while($OrdemDeServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='" . $OrdemDeServico['idOrdemDeServico'] . "'>" . $OrdemDeServico['observacoes'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label>Ordem de Serviço</label>
                            </div>
                        </div>
                        <div id="arquivoModelo">
                            <div class="row">
                                <div class="col s12">
                                    <h4>Modelo</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s11">
                                    <input name="urlModelo" id="url" type="text" class="validate" <?php if(isset($_GET['idArquivoModelo'])) echo "value='".$resultado['urlModelo']."'"; ?>>
                                    <label for="urlModelo" class="active">Insira o local em que o arquivo está armazenado</label>
                                </div>
                                <div class="col s1">
                                    <a id="addModelo" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                        </div>
                        <div id="ArquivoMatriz">
                            <div class="row">
                                <div class="col s12">
                                    <h4>Matriz</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s11">
                                    <input name="urlMatriz" id="urlMatriz" type="text" class="validate" <?php if(isset($_GET['idArquivoMatriz'])) echo "value='".$resultado['urlMatriz']."'"; ?>>
                                    <label for="urlMatriz" class="active">URL</label>
                                </div>
                                <div class="col s1">
                                    <a id="addMatriz" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input name="utilizacoes" id="utilizacoes" type="text" class="validate right-align" <?php if(isset($_GET['idArquivoMatriz'])) echo "value='".$resultado['utilizacoes']."'"; ?>>
                                    <label for="utilizacoes" class="active">Utilizações</label>
                                </div>
                                <div class="input-field col s6">
                                    <input name="idChapa" id="idChapa" type="text" class="validate right-align" <?php if(isset($_GET['idArquivoMatriz'])) echo "value='".$resultado['idChapa']."'"; ?>>
                                    <label for="idChapa" class="active">ID da Chapa</label>
                                </div>
                            </div>
                        </div>
                       
                        <?php
                        if(isset($_GET['idArquivo']))
                            echo "<a class=\"btn waves-effect waves-light red accent-4\" name=\"excluir\" onclick=\"document.forms['excluir'].submit()\">Excluir<i class=\"material-icons right\">delete</i></a>";
                            echo "<input type=\"hidden\" name=\"acao\" value=\"incluir\" />";
                            echo "<input type=\"hidden\" name=\"idMaterial\" value=\"" . $idArquivo . "\" />";
                        ?>
                        <button class="btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right"></i></button>
                        <input type="hidden" name="acao" value="<?php echo isset($_GET['idArquivo']) ? 'atualizar' : 'inserir';  ?>" />
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" />
                    </form>
                    <form role="form" method="POST" name="excluir" action="control/arquivo.php">
                        <input type="hidden" name="acao" value="excluir" />
                        <input type="hidden" name="idArquivo" value="<?php echo $idArquivo; ?>" />
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" />
                    </form>
                </div>
            </div>
        </main>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/materialize.js" type="text/javascript"></script>
        <script src="js/init.js" type="text/javascript"></script>
        <script src="js/cadastro.js" type="text/javascript"></script>
    </body>
</html>
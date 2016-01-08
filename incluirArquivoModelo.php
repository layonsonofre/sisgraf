<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Incluir Arquivo Modelo</title>
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
                <h4>Incluir Arquivo Modelo</h4>
                <p>Página para cadastro de arquivos modelo referentes à serviços em execução ou já executados.</p>
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
						$idArquivoModelo = isset($_GET['idArquivoModelo']) ? $_GET['idArquivoModelo'] : '';
                        if($idArquivoModelo != '') {
                            echo "<h4>Atualizar Arquivo Modelo</h4>";
                            $sql = "select * from ArquivoModelo where ArquivoModelo.idArquivoModelo=" . $idArquivoModelo . ";";
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
                        }
                        else {
                            echo "<h4>Cadastrar Arquivo Modelo</h4>";
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
                    <form class="col s12" role="form" method="POST" action="control/arquivomodelo.php">
                        <div class="row">
                            <div class="input-field col s8">
                                <input name="url" id="url" type="text" class="validate" <?php if(isset($_GET['idArquivoModelo'])) echo "value='".$resultado['url']."'"; ?>>
                                <label for="url" class="active">url</label>
                            </div>
                        
						
						<div class="input-field col s8">
                                <select id="Arquivo" name="Arquivo">
                                    <option value="" disabled>Selecione</option>
                                    <?php
                                    $sql = "select * from Arquivo;";
                                    $query = mysql_query($sql);
                                    while($Arquivo = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='" . $Arquivo['idArquivo'] . "'>" . $Arquivo['nome'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label>Arquivo</label>
                            </div>
                        </div>
				</div>
                       
                        <?php
                        if(isset($_GET['idArquivoModelo']))
                            echo "<a class=\"btn waves-effect waves-light red accent-4\" name=\"excluir\" onclick=\"document.forms['excluir'].submit()\">Excluir<i class=\"material-icons right\">delete</i></a>";
                            echo "<input type=\"hidden\" name=\"acao\" value=\"incluir\" />";
                            echo "<input type=\"hidden\" name=\"idArquivoModelo\" value=\"" . $idArquivoModelo . "\" />";
                        ?>
                        <button class="btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right"></i></button>
                        <input type="hidden" name="acao" value="inserir" />
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" />
                    </form>
                    <form role="form" method="POST" name="excluir" action="control/arquivomodelo.php">
                        <input type="hidden" name="acao" value="excluir" />
                        <input type="hidden" name="idArquivoModelo" value="<?php echo $idArquivoModelo; ?>" />
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

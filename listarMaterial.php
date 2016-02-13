<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Listar Materiais</title>
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/font.css" rel="stylesheet">
        <link href="css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
        <div id="help" class="modal">
            <div class="modal-content">
                <h4>Buscar Material</h4>
                <p>Insira os parâmetros de pesquisa e clique no botão "Buscar" para realizar a busca.</p>
                <p>Caso o campo de busca esteja em branco, ao clicar no botão "Buscar" todos os campos registrados serão mostrados.</p>
                <p>Selecionando as opções abaixo do campo de parâmetros e clicando no botão "Buscar" na sequência, os resultados serão filtrados utilizando as opções selecionadas.</p>
                <p>Cada registro encontrado tem um link para realizar alterações ou ver mais detalhes do registro em questão.</p>
                <p>Mais abaixo encontram-se os botões de paginação para ver mais detalhes.</p>
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
            <!-- </div>
            <div class="container"> -->
                <div class="row valign-wrapper">
                    <div class="col s12 l10">
                        <?php
                        if($_GET['tipo'] == 'material') {
                            echo "<h4>Buscar Materiais</h4>";
                        } else if($_GET['tipo'] == 'papel') {
                            echo "<h4>Buscar Papel</h4>";
                        }
                        ?>
                    </div>
                    <div class="col s12 l2 valign">
                        <a class="waves-effect waves-light modal-trigger" href="#help"><i class="material-icons">info</i></a>
                    </div>
                </div>
                <div class="row">
                	<form class="col s12" role="form" method="POST" action="control/material.php" id="buscarMaterial">
                		<div class="row">
	                    	<?php
	                        if($_GET['tipo'] == 'papel') {
                        	?>
	                        	<div class="input-field col s9">
	                                <input name="consulta" id="consulta" type="text" class="validate" length="15" maxlength="15">
	                                <label for="consulta" class="active">Pesquise por tipo de papel ou gramatura</label>
	                            </div>
                        	<?php
	                        } else if($_GET['tipo'] == 'material') {
                            ?>
                                <div class="input-field col s9">
                                    <input name="consulta" id="consulta" type="text" class="validate" length="20" maxlength="20">
                                    <label for="consulta" class="active">Pesquise pela categoria ou descricao do material</label>
                                </div>
                            <?php   
                            }
	                        ?>
	                        <div class="col s3">
                            	<button class="btn waves-effect waves-light green accent-4" type="submit" name="buscar">Buscar<i class="material-icons right">send</i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <label>Opções</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="opc[]" id="emFalta" type="checkbox" value="emFalta">
                                <label for="emFalta">Materiais em falta</label>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" id="pagina" name="pagina" value="">
	                        <input type="hidden" name="acao" value="listar">
                            <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>">
                		</div>
                	</form>
                	<div id="resultadoBuscaMaterial"></div>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/jasny-bootstrap.min.js"></script>
        <script src="js/ajax/buscarMaterial.js"></script>
        <script src="js/paginacao.js"></script>
        <?php
        include 'header.php';
        ?>
    </body>
</html>
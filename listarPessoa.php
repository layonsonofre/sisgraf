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
                <h4>Buscar Pessoa</h4>
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
                            echo "<div id='msg' class='card-panel green lighten-2 white-text'>Dados atualizados com sucesso!<i class='material-icons right'>close</i></div>";
                        if(isset($_GET['at']) && $_GET['at'] == 'no')
                            echo "<div id='msg' class='card-panel red lighten-2 white-text'>Dados não atualizados no sistema, tente novamente.<i class='material-icons right'>close</i></div>";
                        ?>
                    </div>
                </div>
            <!-- </div>
            <div class="container"> -->
                <div class="row valign-wrapper">
                    <div class="col s12 l10">
                        <?php
                        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
                        if($tipo == 'cliente') {
                            echo "<h4>Buscar Clientes</h4>";
                        } else if($_GET['tipo'] == 'fornecedor') {
                            echo "<h4>Buscar Fornecedores</h4>";
                        } else if($_GET['tipo'] == 'funcionario') {
                            echo "<h4>Buscar Funcionários</h4>";
                        }
                        ?>
                    </div>
                    <div class="col s12 l2 valign">
                        <a class="waves-effect waves-light modal-trigger" href="#help"><i class="material-icons">info</i></a>
                    </div>
                </div>
                <div class="row">
                	<form class="col s12" role="form" method="POST" action="control/pessoa.php" id="buscarPessoa">
                		<div class="row">
	                    	<?php
	                        if($_GET['tipo'] != 'fornecedor') {
                        	?>
	                        	<div class="input-field col s9">
	                                <input name="consulta" id="consulta" type="text" class="validate" length="15" maxlength="15">
	                                <label for="consulta" class="active">Pesquise, por exemplo, utilizando o nome, endereço, cidade etc.</label>
	                            </div>
                        	<?php
	                        } else {
                                ?>
                                <div class="input-field col s9">
                                    <input name="consulta" id="consulta" type="text" class="validate" length="15" maxlength="15">
                                    <label for="consulta" class="active">Pesquise utilizando o nome, endereço etc. ou pela categoria de material fornecida</label>
                                </div>
                                <?php
                            }
                            ?>
	                        <div class="col s3">
                            	<button class="btn waves-effect waves-light green accent-4" type="submit" name="buscar">Buscar<i class="material-icons right">send</i></button>
                            </div>
                        </div>
                        <?php
                        if($tipo != 'funcionario') {
                        ?>
                        <div class="row">
                            <div class="col s12">
                                <label>Opções</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="opc[]" id="isPessoa" type="radio" value="isPessoa">
                                <label for="isPessoa">Física/Juridica</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="opc[]" id="isPessoaFisica" type="radio" value="isPessoaFisica">
                                <label for="isPessoaFisica">Pessoa Física</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="opc[]" id="isPessoaJuridica" type="radio" value="isPessoaJuridica">
                                <label for="isPessoaJuridica">Pessoa Juridica</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="opc[]" id="inativo" type="checkbox" value="inativo">
                                <label for="inativo">Inativo</label>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="row">
                            <input type="hidden" id="pagina" name="pagina" value="">
	                        <input type="hidden" name="acao" value="listar">
                            <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>">
                		</div>
                	</form>
                	<div id="resultadoBuscaPessoa"></div>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/jasny-bootstrap.min.js"></script>
        <script src="js/ajax/buscarPessoa.js"></script>
        <script src="js/paginacao.js"></script>
        <?php
        include 'header.php';
        ?>
    </body>
</html>
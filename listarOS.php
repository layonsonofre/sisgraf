<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Listar Ordem de Serviços</title>
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/font.css" rel="stylesheet">
        <link href="css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
        <div id="help" class="modal">
            <div class="modal-content">
                <h4>Buscar Ordem de Serviço</h4>
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
                        // $tipo = $_GET['tipo'];
                        // if($tipo == 'modelo') {
                             echo "<h4>Buscar Ordem de Serviço</h4>";
                        // } else if($tipo == 'matriz') {
                        //     echo "<h4>Buscar Arquivo Matriz</h4>";
                        // }
                        ?>
                    </div>
                    <div class="col s12 l2 valign">
                        <a class="waves-effect waves-light modal-trigger" href="#help"><i class="material-icons">info</i></a>
                    </div>
                </div>
                <div class="row">
                    <form class="col s12" role="form" method="POST" action="control/ordemDeServico.php" id="buscarOS">
                        <div class="row">
                            <div class="input-field col s9">
                                <input name="consulta" id="consulta" type="text" class="validate" length="15" maxlength="15">
                                <label for="consulta" class="active">Pesquise pelo nome do arquivo ou número da chapa</label>
                            </div>
                            <div class="col s3">
                                <button class="btn waves-effect waves-light green accent-4" type="submit" name="buscar">Buscar<i class="material-icons right">send</i></button>
                            </div>
                        </div>
                        <div class="row">
                                <!-- 
                                <div class="input-field col s4">
                                    <select id="status" name="status[]" multiple class="browser-default">
                                        <option value="todos" selected>Todos</option>
                                        <option value="cadastro">Cadastro</option>
                                        <option value="desenvolvimento">Desenvolvimento</option>
                                        <option value="aprovacao">Aprovação</option>
                                        <option value="impressao">Imprimindo</option>
                                        <option value="acabamento">Acabamento</option>
                                        <option value="pronto">Pronto</option>
                                        <option value="entregue">Entregue</option>
                                        <option value="cancelada">Cancelada</option>
                                    </select>
                                    <label>Status</label>
                                </div> -->
                            <div class="input-field col s2">
                                <select id="mes" name="mes">
                                    <option selected>Todos</option>
                                    <option value="01">Jan.</option>
                                    <option value="02">Fev.</option>
                                    <option value="03">Mar.</option>
                                    <option value="04">Abr.</option>
                                    <option value="05">Mai.</option>
                                    <option value="06">Jun.</option>
                                    <option value="07">Jul.</option>
                                    <option value="08">Ago.</option>
                                    <option value="09">Set.</option>
                                    <option value="10">Out.</option>
                                    <option value="11">Nov.</option>
                                    <option value="12">Dez.</option>
                                </select>
                                <label>Mês</label>
                            </div>
                            <div class="input-field col s2">
                                <select id="ano" name="ano">
                                    <option selected>Todos</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                </select>
                                <label>Ano</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="opc[]" id="decrescente" type="radio" value="decrescente" checked>
                                <label for="decrescente">Mais atual - antiga</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="opc[]" id="crescente" type="radio" value="ascendente">
                                <label for="crescente">Mais antiga - atual</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <label>Status</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="radio" name="status[]" value="todos" id="todos">
                                <label for="todos">Todos</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="radio" name="status[]" value="cadastro" id="cadastro">
                                <label for="cadastro">Cadastro</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="radio" name="status[]" value="desenvolvimento" id="desenvolvimento">
                                <label for="desenvolvimento">Desenv.</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="radio" name="status[]" value="aprovacao" id="aprovacao">
                                <label for="aprovacao">Aprovação</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="radio" name="status[]" value="impressao" id="impressao">
                                <label for="impressao">Imprimindo</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="radio" name="status[]" value="acabamento" id="acabamento">
                                <label for="acabamento">Acabamento</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="radio" name="status[]" value="pronto" id="pronto">
                                <label for="pronto">Pronto</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="radio" name="status[]" value="entregue" id="entregue">
                                <label for="entregue">Entregue</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="radio" name="status[]" value="cancelada" id="cancelada">
                                <label for="cancelada">Cancelada</label>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" id="pagina" name="pagina" value="">
                            <input type="hidden" name="acao" value="listar">
                        </div>
                    </form>
                    <div id="resultadoBuscaOS"></div>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/jasny-bootstrap.min.js"></script>
        <script src="js/ajax/buscarOS.js"></script>
        <script src="js/paginacao.js"></script>
        <?php
            include 'header.php';
        ?>
    </body>
</html>
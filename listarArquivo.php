<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Listar Arquivos</title>
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/font.css" rel="stylesheet">
        <link href="css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
        <div id="help" class="modal">
            <div class="modal-content">
                <h4>Modal Header</h4>
                <p>A bunch of text</p>
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
                             echo "<h4>Buscar Arquivo</h4>";
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
                    <form class="col s12" role="form" method="POST" action="control/arquivo.php" id="buscarArquivo">
                        <div class="row">
                            <div class="input-field col s9">
                                <input name="consulta" id="consulta" type="text" class="validate" length="15" maxlength="15">
                                <label for="consulta" class="active">Pesquise pelo nome do arquivo ou número da chapa</label>
                            </div>
                            <div class="col s3">
                                <button class="btn waves-effect waves-light green accent-4" type="submit" name="buscar">Buscar<i class="material-icons right">send</i></button>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col s12">
                                <label>Opções</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="opc[]" id="excluido" type="checkbox" value="excluido">
                                <label for="excluido">Fora de produção</label>
                            </div>
                        </div> -->
                        <div class="row">
                            <input type="hidden" id="pagina" name="pagina" value="">
                            <input type="hidden" name="acao" value="listar">
                        </div>
                    </form>
                    <div id="resultadoBuscaArquivo"></div>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/jasny-bootstrap.min.js"></script>
        <script src="js/ajax/buscarArquivo.js"></script>
        <script src="js/paginacao.js"></script>
        <?php
            include 'header.php';
        ?>
    </body>
</html>
<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Atualizar Arquivo</title>
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="all" />
		<link href="css/font.css" rel="stylesheet">
    </head>
    <body>
        <div id="help" class="modal">
            <div class="modal-content">
                <h4>Incluir Arquivo</h4>
                <p>Página para cadastro de arquivos referentes à serviços em execução ou já executados.</p>
                <p>Insira o nome base do arquivo, a data de criação e a ordem de serviço à que ele se refere. Clique no botão com uma lupa para ver detalhes da Ordem de Serviço.</p>
                <p>O arquivo pode estar presente em várias matrizes, registre-as nos campos abaixos do título "Matriz". No "Local de Armazenamento" insira o local em que a matriz está guardada.</p>
                <p>Para cadastrar um modelo insira no campo específico o diretório e o nome do arquivo com a extensão. Por exemplo: D:/Arquivos/Gráfica/Mercado/Modelos/modelo panfleto fevereiro 2016.png</p>
                <p>Clique no botão "+" para adicionar mais um campo de interesse. Clique no botão "-" para remover um campo adicionado.</p>
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
                        $idOS = isset($_GET['idOS']) ? $_GET['idOS'] : '';
                        if($idArquivo != '') {
                            echo "<h4>Atualizar Arquivo</h4>";
                            $sql = "SELECT * FROM Arquivo WHERE Arquivo.idArquivo={$idArquivo}";
                        }
                        else {
                            if($idOS)
                                $sql = "SELECT * FROM Arquivo WHERE idOrdemDeServico={$idOS}";
                            echo "<h4>Cadastrar Arquivo</h4>";
                        }
                        if($idArquivo || $idOS) {
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
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
                    <form class="col s12" role="form" method="POST" enctype="multipart/form-data" action="control/arquivo.php">
                        <p class="light" style="color: red;">* Campo obrigatório</p>
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="nome" id="nome" type="text" class="validate" <?php if($idArquivo) echo "value='".$resultado['nome']."'"; ?> length="64" maxlength="64" required>
                                <label for="nome" class="active">Nome <p class="help-block">*</p></label>
                            </div>
                            <div class="input-field col s3">
                                <input name="data" id="data" type="date" class="validate datepicker" <?php if ($idArquivo) echo "value='{$resultado['data']}'"; ?> required>
                                <label for="data" class="active">Data <p class="help-block">*</p></label>
                            </div>
    						<div class="input-field col s2">
                                <select id="selectOrdemDeServico" name="selectOrdemDeServico" required>
                                    <option value="" disabled <?php if(!$idArquivo && !$idOS) echo "selected"; ?>>Selecione</option>
                                    <?php
                                    $sql = "SELECT * FROM OrdemDeServico";
                                    $query = mysql_query($sql);
                                    while($OrdemDeServico = mysql_fetch_assoc($query)) {
                                        echo "<option value='{$OrdemDeServico['idOrdemDeServico']}' ";
                                        if($idArquivo || $idOS) {
                                            if($OrdemDeServico['idOrdemDeServico'] == $resultado['idOrdemDeServico'] || $OrdemDeServico['idOrdemDeServico'] == $idOS) {
                                                echo "selected";
                                            }
                                        }
                                        echo ">{$OrdemDeServico['idOrdemDeServico']}</option>";
                                    }
                                    ?>
                                </select>
                                <label>Ordem de Serviço <p class="help-block">*</p></label>
                            </div>
                            <div class="col s1">
                                <a id="detalhesOS" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">zoom_in</i></a>
                            </div>
                        </div>
                        <div id="arquivoModelo">
                            <div class="row">
                                <div class="col s12">
                                    <h4>Modelo</h4>
                                </div>
                            </div>
                            <?php
                            if($idArquivo) {
                                $sql = "SELECT * FROM ArquivoModelo WHERE idArquivo = {$idArquivo}";
                                $query = mysql_query($sql);
                                while($temp = mysql_fetch_assoc($query)) {
                                    echo "<div class='row'>";
                                        echo "<div class='input-field col s8'>";
                                            echo "<input name='urlModeloAntigo[]' id='urlModeloAntigo' type='text' class='validate' length='256' maxlength='256' value='{$temp['url']}'>";
                                            echo "<label>Local</label>";
                                        echo "</div>";
                                        echo "<div class='input-field col s3'>";
                                            echo "<select name='statusAntigo[]' id='status'>";
                                                if($temp['status'] == 'desenvolvimento') echo "<option value='desenvolvimento' selected>Em Desenvolvimento</option>";
                                                else echo "<option value='desenvolvimento'>Em Desenvolvimento</option>";
                                                if($temp['status'] == 'aguardando') echo "<option value='aguardando' selected>Aguardando Cliente</option>";
                                                else echo "<option value='aguardando'>Aguardando Cliente</option>";
                                                if($temp['status'] == 'aprovado') echo "<option value='aprovado' selected>Aprovado</option>";
                                                else echo "<option value='aprovado'>Aprovado</option>";
                                            echo "</select>";
                                            echo "<label>Status</label>";
                                        echo "</div>";
                                        echo "<div class='col s1'>";
                                            echo "<a idArquivoModeloAntigo='{$temp['idArquivoModelo']}' idArquivo='{$idArquivo}' id='remModelo' class='waves-effect waves-light red accent-4 btn-floating'><i class='material-icons left'>delete</i></a>";
                                        echo "</div>";
                                    echo "</div>";
                                    echo "<input type='hidden' name='idArquivoModeloAntigo' value='{$temp['idArquivoModelo']}'>";
                                }
                            }
                            ?>
                            <div class="row">
                                <!-- <div class="file-field input-field col s8">
                                    <div class="btn">
                                        <span>Arquivo</span>
                                        <input type="file" class="modelo" name="urlModeloNovo[]" id="urlModeloNovo">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validade" type="text" placeholder="Selecione o modelo">
                                    </div> -->
                                    <!-- <input multiple name="urlModelo[]" id="url" type="file" class="validate" <?php if(isset($_GET['idArquivoModelo'])) echo "value='".$resultado['urlModelo']."'"; ?>>
                                    <label for="urlModelo" class="active">Insira o local em que o arquivo está armazenado</label> -->
                                <!-- </div> -->
                                <div class="input-field col s8">
                                    <input name='urlModeloNovo[]' id='urlModeloNovo' type='text' class='validate' length='256' maxlength='256' required>
                                    <label for="urlModeloNovo">Local <p class="help-block">*</p></label>
                                </div>
                                <div class="input-field col s3">
                                    <select name="statusNovo[]" id="status" required>
                                        <option value="desenvolvimento" selected>Desenvolvimento</option>
                                        <option value="aguardando">Aguardando Cliente</option>
                                        <option value="aprovado">Aprovado</option>
                                    </select>
                                    <label>Status <p class="help-block">*</p></label>
                                </div>
                                <div class="col s1">
                                    <a id="addModelo" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                            <!-- <div id="thumbnais" class="row">
                                <div class="col s6">
                                    <div class="card small">
                                        <div class="card-image">
                                            <img id="thumbModeloNovo" src="" alt="Imagem modelo" />
                                            <span class="card-title" id="thumbModeloNovoTitulo"></span>
                                        </div>
                                        <div class="card-action">
                                            <a href="#">Excluir</a>
                                            <a href="#">Atualizar</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div id="arquivoMatriz">
                            <div class="row">
                                <div class="col s12">
                                    <h4>Matriz</h4>
                                </div>
                            </div>
                            <?php
                            if($idArquivo){
                                $sql = "SELECT * FROM ArquivoMatriz
                                INNER JOIN Arquivo_ArquivoMatriz ON ArquivoMatriz.idArquivoMatriz = Arquivo_ArquivoMatriz.idArquivoMatriz
                                WHERE Arquivo_ArquivoMatriz.idArquivo = {$idArquivo}";
                                $query = mysql_query($sql);
                                while($temp = mysql_fetch_assoc($query)) {
                                    echo "<div class='row'>";
                                        echo "<div class='input-field col s3'>";
                                            echo "<input name='idChapaAntiga[]' id='idChapa{$temp['idChapa']}' type='text' class='validate right-align' data-mask='9?999999' value='{$temp['idChapa']}'>";
                                            echo "<label for='idChapa' class='active'>Nº da Chapa</label>";
                                        echo "</div>";
                                        echo "<div class='input-field col s6'>";
                                            echo "<input name='urlMatrizAntiga[]' id='urlMatriz{$temp['idChapa']}' type='text' class='validate' length='256' maxlength='256' value='{$temp['url']}'>";
                                            echo "<label for='urlMatriz{$temp['idChapa']}' class='active'>Local Armazenamento</label>";
                                        echo "</div>";
                                        echo "<div class='input-field col s2'>";
                                            echo "<input name='utilizacoesAntiga[]' id='utilizacoes{$temp['idChapa']}' type='text' class='validate right-align' data-mask='9?999999' value='{$temp['utilizacoes']}'>";
                                            echo "<label for='utilizacoes{$temp['idChapa']}' class='active'>Utilizações</label>";
                                        echo "</div>";
                                        echo "<div class='col s1'>";
                                            echo "<a idArquivoMatriz='{$temp['idArquivoMatriz']}' idArquivo='{$idArquivo}' id='remMatriz' class='waves-effect waves-light red accent-4 btn-floating'><i class='material-icons left'>delete</i></a>";
                                        echo "</div>";
                                    echo "</div>";
                                    echo "<input type='hidden' name='idArquivoMatrizAntigo' value='{$temp['idArquivoMatriz']}'>";
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="input-field col s3">
                                    <input name="idChapaNovo[]" id="idChapaNovo" type="text" class="validate right-align" data-mask='9?999999'>
                                    <label for="idChapaNovo" class="active">Nº da Chapa</label>
                                </div>
                                <div class="input-field col s6">
                                    <input name="urlMatrizNovo[]" id="urlMatrizNovo" type="text" class="validate" length="256" maxlength="256" >
                                    <label for="urlMatrizNovo" class="active">Local Armazenamento</label>
                                </div>
                                <div class="input-field col s2">
                                    <input name="utilizacoesNovo" id="utilizacoesNovo" type="text" class="validate right-align" data-mask='9?999999'>
                                    <label for="utilizacoesNovo" class="active">Utilizações</label>
                                </div>
                                <div class="col s1">
                                    <a id="addMatriz" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                        </div>
                       
                        <?php
                        if(isset($_GET['idArquivo']))
                            echo "<a class=\"btn waves-effect waves-light red accent-4\" name=\"excluir\" onclick=\"document.forms['excluir'].submit()\">Excluir<i class=\"material-icons right\">delete</i></a>";
                        ?>
                        <input type="hidden" name="idArquivo" value="<?php echo $idArquivo; ?>" />
                        <button class="btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right">send</i></button>
                        <input type="hidden" name="acao" value="<?php echo ($idArquivo) ? 'atualizar' : 'inserir';  ?>" />
                    </form>
                    <form role="form" method="POST" name="excluir" action="control/arquivo.php">
                        <input type="hidden" name="acao" value="excluir" />
                        <input type="hidden" name="idArquivo" value="<?php echo $idArquivo; ?>" />
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" />
                    </form>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/ajax/arquivo.js"></script>
        <script>
            var $input = $('.datepicker').pickadate();
            var picker = $input.pickadate('picker');
            picker.set('select', new Date());
        </script>
        <?php
            include 'header.php';
        ?>
    </body>
</html>

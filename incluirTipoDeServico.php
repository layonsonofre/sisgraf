<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
if(isset($_GET['logout'])) {
    unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
    header("Location: login.php");
}
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Atualizar Tipo de Serviço</title>
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
                        $idTS = isset($_GET['idTS']) ? $_GET['idTS'] : '';
                        if($idTS != '') {
                            if($_GET['tipo'] == 'carimbo') {
                                echo "<h4>Atualizar Carimbo</h4>";
                            } else if($_GET['tipo'] == 'nota') {
                                echo "<h4>Atualizar Nota Fiscal</h4>";
                            } else if($_GET['tipo'] == 'outro') {
                                echo "<h4>Atualizar Tipo de Serviço</h4>";
                            }
                            $sql = "select * from TipoServico, Carimbo, NotaFiscal, ModeloNotaFiscal where TipoServico.idTipoServico=" . $idTS . ";";
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
                        }
                        else {
                            if($_GET['tipo'] == 'carimbo') {
                                echo "<h4>Cadastrar Carimbo</h4>";
                            } else if($_GET['tipo'] == 'nota') {
                                echo "<h4>Cadastrar Nota Fiscal</h4>";
                            } else if($_GET['tipo'] == 'outro') {
                                echo "<h4>Cadastrar Tipo de Serviço</h4>";
                            }
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
                            <div class="input-field col s3">
                                <input name="nome" id="nome" type="text" class="validate" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['nome']."'"; if($_GET['tipo'] == 'carimbo') echo "value='Carimbo' disabled"; if($_GET['tipo'] == 'nota') echo "value='Nota Fiscal' disabled"; ?>>
                                <label for="nome" class="active">Nome</label>
                            </div>
                            <div class="input-field col s7">
                                <input name="descricao" id="descricao" type="text" class="validate" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['descricao']."'"; if($_GET['tipo'] == 'carimbo') echo "value='Material auxiliar de uso diverso' disabled"; if($_GET['tipo'] == 'nota') echo "value='Tipo de impresso usado como documento fiscal' disabled"; ?>>
                                <label for="descricao" class="active">Descrição</label>
                            </div>
                            <div class="input-field col s2">
                                <input name="valorUnitario" id="valorUnitario" type="text" class="validate right-align" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['valor']."'"; ?>>
                                <label for="valorUnitario" class="active">Valor (R$)</label>
                            </div>
                        </div>
                        <?php
                        if($_GET['tipo'] == 'carimbo') {
                        ?>
                            <div class="row">
                                <div class="col s12">
                                    <h5>Dados do Carimbo</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s2">
                                    <select id="isAutomatico" name="isAutomatico">
                                        <option value="true" <?php if(isset($_GET['idTS'])) { if($resultado['isAutomatico'] == 'TRUE') echo "selected"; } ?> >Automático</option>
                                        <option value="false" <?php if(isset($_GET['idTS'])) { if($resultado['isAutomatico'] == 'FALSE') echo "selected"; } ?> >Madeira</option>
                                    </select>
                                    <label for="isAutomatico" class="active">Tipo</label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="nomeCarimbo" id="nomeCarimbo" type="text" class="validate" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['nomeCarimbo']."'"; ?> length="10" maxlength="10">
                                    <label for="nomeCarimbo" class="active">Nome</label>
                                </div>
                                <div class="input-field col s3">
                                    <input name="base" id="base" type="text" class="validate right-align" data-mask="9?99"<?php if(isset($_GET['idTS'])) echo "value='".$resultado['base']."'"; ?>>
                                    <label for="base" class="active">Base (mm)</label>
                                </div>
                                <div class="input-field col s3">
                                    <input name="altura" id="altura" type="text" class="validate right-align" data-mask="9?99" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['altura']."'"; ?>>
                                    <label for="altura" class="active">Altura (mm)</label>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if($_GET['tipo'] == 'nota'){
                        ?>
                            <div class="row">
                                <div class="col s12">
                                    <h5>Dados da Nota Fiscal</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s11">
                                    <select id="selectModeloNotaFiscal" name="selectModeloNotaFiscal">
                                        <option value="" disabled>Selecione</option>
                                        <?php
                                        $sql = "select * from ModeloNotaFiscal;";
                                        $query = mysql_query($sql);
                                        while($modeloNotaFiscal = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                            echo "<option value='" . $modeloNotaFiscal['idModeloNotaFiscal'] . "'>" . $modeloNotaFiscal['modelo'] . "(" . $modeloNotaFiscal['descricao'] . ") </option>";
                                        }
                                        ?>
                                    </select>
                                    <label>Modelo</label>
                                </div>
                                <div class="col s1">
                                    <a href="#modalModeloNotaFiscal" id="addModeloNotaFiscal" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                            <!--
                            //
                            Mais detalhes sobre as as notas fiscais
                            //
                            -->
                        <?php
                        }
                        ?>
                        <?php
                        $temp = isset($_GET['tipo']) ? $_GET['tipo'] : '';
                        if( $temp != '' && $temp != 'carimbo')
                        {
                        ?>
                            <div class="row">
                                <div class="col s12">
                                    <h5>Dados do Tipo de Serviço</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s11">
                                    <select id="selectFormato" name="selectFormato[]" multiple>
                                        <?php
                                        echo "<option value='' disabled>Selecione os formatos que este serviço pode ser feito</option>";
                                        $sql = "SELECT * FROM `Formato`;";
                                        $query = mysql_query($sql);
                                        while($forms = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                            echo "<option value='".$forms['idFormato']."' ";
                                            if($idTS != NULL) {
                                                $sql2 = "select * from TipoServico_Formato where idFormato=".$forms['idFormato']." and idTipoServico=".$idTS.";";
                                                $query2 = mysql_query($sql2);
                                                if( mysql_num_rows($query2) == 1) {
                                                    echo "selected";
                                                }
                                            }
                                            echo ">" . $forms['formato'] . " (".$forms['base']." x ".$forms['altura']." <i>mm</i>)</option>";
                                        }
                                        ?>
                                    </select>
                                    <label>Formato</label>
                                </div>
                                <div class="col s1">
                                    <a href="#modalFormato" id="addFormato" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s11">
                                    <select id="selectAcabamento" name="selectAcabamento[]" multiple>
                                    <?php
                                        echo "<option value='' disabled>Selecione os acabamentos disponíveis para o serviço</option>";
                                        $sql = "SELECT * FROM 'Acabamento';";
                                        $query = mysql_query($sql);
                                        while($acabs = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                            echo "<option value='".$acabs['idAcabamento']."' ";
                                            if($idTS != '') {
                                                $sql2 = "select * from TipoServico_Acabamento where idAcabamento=".$acabs['idAcabamento']." and idTipoServico=".$idTS.";";
                                                $query2 = mysql_query($sql2);
                                                if( mysql_num_rows($query2) == 1) {
                                                    echo "selected";
                                                }
                                            }
                                            echo ">".$acabs['nome']." (" .$acabs['descricao']." - Local: " .$acabs['local'].")</option>";
                                        }
                                        ?>
                                    </select>
                                    <label>Acabamento</label>
                                </div>
                                <div class="col s1">
                                    <a href="#modalAcabamento" id="addAcabamento" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if(isset($_GET['idTS']))
                            echo "<a class=\"btn waves-effect waves-light red accent-4\" name=\"exlcuir\" onclick=\"document.forms['excluir'].submit()\">Excluir<i class=\"material-icons right\">delete</i></a>";
                            echo "<input type=\"hidden\" name=\"acao\" value=\"incluir\" />";
                            echo "<input type=\"hidden\" name=\"idTS\" value=\"" . $idTS . "\" />";
                        ?>
                        <button class="btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right">send</i></button>
                        <input type="hidden" name="acao" value="<?php echo isset($_GET['idTS']) ? 'atualizar' : 'inserir';  ?>" />
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" />
                    </form>
                    <form role="form" method="POST" name="excluir" action="control/material.php">
                        <input type="hidden" name="acao" value="excluir" />
                        <input type="hidden" name="idTipoDeServico" value="<?php echo $idTS; ?>" />
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
        
        <?php
        include 'modal/acabamento.php';
        include 'modal/formato.php';
        ?>
    </body>
</html>

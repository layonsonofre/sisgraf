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
            include 'modal/categorias.php';
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
                        $idTipoDeServico = isset($_GET['idTS']) ? $_GET['idTS'] : '';
                        if($idTipoDeServico != '') {
                            if($_GET['tipo'] == 'carimbo') {
                                echo "<h4>Atualizar Carimbo</h4>";
                            } else if($_GET['tipo'] == 'nota') {
                                echo "<h4>Atualizar Nota Fiscal</h4>";
                            }
                            $sql = "select * from TipoServico, Carimbo, NotaFiscal, ModeloNotaFiscal where TipoServico.idTipoServico=" . $idTipoServico . ";";
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
                        }
                        else {
                            if($_GET['tipo'] == 'carimbo') {
                                echo "<h4>Cadastrar Carimbo</h4>";
                            } else if($_GET['tipo'] == 'nota') {
                                echo "<h4>Cadastrar Nota Fiscal</h4>";
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
                                <h5>Dados do Carimbo</h5>
                                <div class="input-field col s2">
                                    <input name="isAutomatico" id="isAutomatico" type="text" class="validate" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['isAutomatico']."'"; ?>>
                                    <label for="isAutomatico" class="active">Auto./Mad.</label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="nomeCarimbo" id="nomeCarimbo" type="text" class="validate" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['nomeCarimbo']."'"; ?>>
                                    <label for="nomeCarimbo" class="active">Nome</label>
                                </div>
                                <div class="input-field col s2">
                                    <input name="base" id="base" type="text" class="validate right-align" data-mask="9?99"<?php if(isset($_GET['idMaterial']))echo "value='".$resultado['base']."'"; ?>>
                                    <label for="base" class="active">Base (mm)</label>
                                </div>
                                <div class="input-field col s2">
                                    <input name="altura" id="altura" type="text" class="validate right-align" data-mask="9?99" <?php if(isset($_GET['idMaterial']))echo "value='".$resultado['altura']."'"; ?>>
                                    <label for="altura" class="active">Altura (mm)</label>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if($_GET['tipo'] == 'nota') {
                        ?>
                            <div class="row">
                                <div class="input-field col s5">
                                    <input name="tipoPapel" id="tipoPapel" type="text" class="validate" <?php if(isset($_GET['idMaterial']))echo "value='".$resultado['tipo']."'"; ?>>
                                    <label for="tipoPapel" class="active">Descricao do Papel</label>
                                </div>
                                <div class="input-field col s2">
                                    <input name="base" id="base" type="text" class="validate right-align" data-mask="99?99"<?php if(isset($_GET['idMaterial']))echo "value='".$resultado['base']."'"; ?>>
                                    <label for="base" class="active">Base (mm)</label>
                                </div>
                                <div class="input-field col s2">
                                    <input name="altura" id="altura" type="text" class="validate right-align" data-mask="99?99" <?php if(isset($_GET['idMaterial']))echo "value='".$resultado['altura']."'"; ?>>
                                    <label for="altura" class="active">Altura (mm)</label>
                                </div>
                                <div class="input-field col s2">
                                <select id="gramatura" name="gramatura">
                                    <option value="" disabled>Selecione</option>
                                    <?php
                                    $sql = "select * from GramaturaPapel;";
                                    $query = mysql_query($sql);
                                    while($gramatura = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='" . $gramatura['idGramaturaPapel'] . "'>" . $gramatura['gramatura'] . " <i>(g/m<sup>2</sup>)</i></option>";
                                    }
                                    ?>
                                </select>
                                <label>Gramatura</label>
                            </div>
                                <div class="col s1">
                                    <a id="addGramatura" href="#modalGramatura" class="waves-effect modal-trigger waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row">
                            <div class="input-field col s11">
                                <select id="cor" name="cor[]" multiple>
                                    <option value="" disabled>Selecione as cores do material</option>
                                <?php
                                $sql = "select * from Cor;";
                                $query = mysql_query($sql);
                                while($cores = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                    echo "<option value='" . $cores['idCor'] . "'>" . $cores['nome'] . "</option>";
                                }
                                ?>
                                </select>
                                <label>Cores</label>
                            </div>
                            <div class="col s1">
                                <a id="incluirCor" href="#modalCor" class="waves-effect modal-trigger waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                            </div>
                        </div>
                        <div id="categorias">
                            <div class="row">
                                <div class="input-field col s11">
                                    <select id="categoria" name="categoria[]" multiple>
                                        <option value="" disabled>Selecione as categorias de materiais fornecidos</option>
                                    <?php
                                    $sql = "select * from Categoria;";
                                    $query = mysql_query($sql);
                                    while($categorias = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='".$categorias['idCategoria']."' ";
                                        if(isset($_GET['idPessoa'])) {
                                            $sql2 = "select * from Categoria_Material where idCategoria=".$categorias['idCategoria']." and idMaterial=".$idMaterial.";";
                                            $query2 = mysql_query($sql2);
                                            if( mysql_num_rows($query2) == 1) {
                                                echo "selected";
                                            }
                                        }
                                        echo ">".$categorias['nome']." (" .$categorias['descricao'].")</option>";
                                    }
                                    ?>
                                    </select>
                                    <label>Materiais Fornecidos</label>
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

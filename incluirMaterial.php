<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Incluir Material</title>
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
                        $idMaterial = isset($_GET['idMaterial']) ? $_GET['idMaterial'] : '';
                        if($idMaterial != '') {
                            if($_GET['tipo'] == 'material') {
                                echo "<h4>Atualizar Material</h4>";
                            } else if($_GET['tipo'] == 'papel') {
                                echo "<h4>Atualizar Papel</h4>";
                            $sql = "select * from Material, Papel where Material.idMaterial=" . $idMaterial . ";";
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
                            }
                        }
                        else {
                            if($_GET['tipo'] == 'material') {
                                echo "<h4>Cadastrar Material</h4>";
                            } else if($_GET['tipo'] == 'papel') {
                                echo "<h4>Cadastrar Papel</h4>";
                            }
                        }
                        ?>
                    </div>
                    <div class="col s12 l2 valign">
                        <a class="waves-effect waves-light modal-trigger" href="#help"><i class="material-icons">info</i></a>
                    </div>
                </div>
                <div class="row">
                    <form class="col s12" role="form" method="POST" action="control/material.php">
                        <div class="row">
                            <div class="input-field col s8">
                                <input name="descricao" id="descricao" type="text" class="validate" <?php if(isset($_GET['idMaterial'])) echo "value='".$resultado['descricao']."'"; if($_GET['tipo'] == 'papel') echo "value='Papel' readonly" ?> length="20" maxlength="20">
                                <label for="descricao" class="active">Descrição</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="valorUnitario" id="valorUnitario" type="text" class="validate right-align" <?php if(isset($_GET['idMaterial'])) echo "value='".$resultado['valorUnitario']."'"; ?> length="10" maxlength="10">
                                <label for="valorUnitario" class="active">Valor Unitário (R$)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input name="quantidade" id="quantidade" type="text" class="validate right-align" <?php if(isset($_GET['idMaterial'])) echo "value='".$resultado['quantidade']."'"; ?>>
                                <label for="quantidade" class="active">Quantidade</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="quantidadeMinima" id="quantidadeMinima" type="text" class="validate right-align" <?php if(isset($_GET['idMaterial'])) echo "value='".$resultado['quantidadeMinima']."'"; ?>>
                                <label for="quantidadeMinima" class="active">Quantidade Mínima</label>
                            </div>
                            <div class="input-field col s3">
                                <select id="selectUnidade" name="selectUnidade">
                                    <option value="" disabled>Selecione</option>
                                    <?php
                                    $sql = "select * from MaterialUnidade;";
                                    $query = mysql_query($sql);
                                    while($materialUnidade = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='" . $materialUnidade['idMaterialUnidade'] . "'>" . $materialUnidade['descricao'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label>Unidade de Medida</label>
                            </div>
                            <div class="col s1">
                                <a href="#modalUnidadeDeMedida" id="addUnidade" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                            </div>
                        </div>
                        <?php
                        if($_GET['tipo'] == 'papel') {
                        ?>
                            <div class="row">
                                <div class="input-field col s5">
                                    <input name="tipoPapel" id="tipoPapel" type="text" class="validate" <?php if(isset($_GET['idMaterial']))echo "value='".$resultado['tipo']."'"; ?> length="15" maxlength="15">
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
                                <select id="selectGramatura" name="selectGramatura">
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
                                <select id="selectCor" name="selectCor[]" multiple>
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
                                    <select id="selectCategoria" name="selectCategoria[]" multiple>
                                        <option value="" disabled>Selecione as categorias que o material pertence</option>
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
                        <input type="hidden" name="acao" value="<?php echo isset($_GET['idMaterial']) ? 'atualizar' : 'inserir';  ?>" />
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
        <?php
        include 'modal/unidadeDeMedida.php';
        include 'modal/cor.php';
        include 'modal/gramatura.php';
        include 'modal/categorias.php';
        ?>
    </body>
</html>
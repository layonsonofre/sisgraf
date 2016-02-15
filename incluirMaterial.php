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
                <h4>Incluir Material</h4>
                <p>Aqui é onde você atualiza um material no sistema. Insira uma descrição, valor pago, a quantidade em estoque atual e uma quantidade mínima deste material.</p>
                <p>Caso a unidade de medida não esteja cadastrada, clique no botão "+" ao lado para cadastrar.</p>
                <p>Selecione também as cores disponíveis desse material, para cadastrar mais de um campo selecione segurando o botão do teclado "Control".</p>
                <p>Selecione as categorias que este material pertence, se não estiver cadastrado clique no "+" ao lado para incluir.</p>
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
                            echo "<div id='msg' class='card-panel green lighten-2 white-text'>Dados atualizados com sucesso!<i class='material-icons right'>close</i></div>";
                        if(isset($_GET['at']) && $_GET['at'] == 'no')
                            echo "<div id='msg' class='card-panel red lighten-2 white-text'>Dados não atualizados no sistema, talvez este material esteja sendo utilizado e não pode ser excluído.<i class='material-icons right'>close</i></div>";
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
                                $sql = "SELECT * FROM Material
                                        WHERE Material.idMaterial={$idMaterial}";
                            } else if($_GET['tipo'] == 'papel') {
                                echo "<h4>Atualizar Papel</h4>";
                                $sql = "SELECT * FROM Material
                                        INNER JOIN Papel ON Material.idMaterial = Papel.idMaterial
                                        WHERE Material.idMaterial={$idMaterial}";
                            }
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
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
                        <p class="light" style="color: red;">* Campo obrigatório</p>
                        <div class="row">
                            <div class="input-field col s8">
                                <input name="descricao" id="descricao" type="text" class="validate" <?php if(isset($_GET['idMaterial'])) echo "value='".$resultado['descricao']."'"; if($_GET['tipo'] == 'papel') echo "value='Papel' readonly" ?> length="20" maxlength="20">
                                <label for="descricao" class="active">Descrição <p class="help-block">*</p></label>
                            </div>
                            <div class="input-field col s4">
                                <input name="valorUnitario" id="valorUnitario" type="text" class="valor validate right-align" <?php if(isset($_GET['idMaterial'])) echo "value='".$resultado['valorUnitario']."'"; ?> length="10" maxlength="10">
                                <label for="valorUnitario" class="active">Valor Unitário (R$) <p class="help-block">*</p></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input name="quantidade" id="quantidade" type="text" class="validate right-align" <?php if(isset($_GET['idMaterial'])) echo "value='".$resultado['quantidade']."'"; ?>>
                                <label for="quantidade" class="active">Quantidade <p class="help-block">*</p></label>
                            </div>
                            <div class="input-field col s4">
                                <input name="quantidadeMinima" id="quantidadeMinima" type="text" class="validate right-align" <?php if(isset($_GET['idMaterial'])) echo "value='".$resultado['quantidadeMinima']."'"; ?>>
                                <label for="quantidadeMinima" class="active">Quantidade Mínima <p class="help-block">*</p></label>
                            </div>
                            <div class="input-field col s3">
                                <select id="selectUnidade" name="selectUnidade">
                                    <option value="" disabled>Selecione</option>
                                    <?php
                                    $sql = "select * from MaterialUnidade;";
                                    $query = mysql_query($sql);
                                    while($materialUnidade = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='{$materialUnidade['idMaterialUnidade']}'";
                                        if($idMaterial != '') if($materialUnidade['idMaterialUnidade'] == $resultado['idMaterialUnidade']) echo "selected";
                                        echo ">{$materialUnidade['descricao']}</option>";
                                    }
                                    ?>
                                </select>
                                <label>Unidade de Medida <p class="help-block">*</p></label>
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
                                    <label for="tipoPapel" class="active">Descricao do Papel <p class="help-block">*</p></label>
                                </div>
                                <div class="input-field col s2">
                                    <input name="base" id="base" type="text" class="validate right-align" data-mask="99?99"<?php if(isset($_GET['idMaterial']))echo "value='".$resultado['base']."'"; ?>>
                                    <label for="base" class="active">Base (mm) <p class="help-block">*</p></label>
                                </div>
                                <div class="input-field col s2">
                                    <input name="altura" id="altura" type="text" class="validate right-align" data-mask="99?99" <?php if(isset($_GET['idMaterial']))echo "value='".$resultado['altura']."'"; ?>>
                                    <label for="altura" class="active">Altura (mm) <p class="help-block">*</p></label>
                                </div>
                                <div class="input-field col s2">
                                <select id="selectGramatura" name="selectGramatura">
                                    <option value="" disabled>Selecione</option>
                                    <?php
                                    $sql = "select * from GramaturaPapel;";
                                    $query = mysql_query($sql);
                                    while($gramatura = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='{$gramatura['idGramaturaPapel']}' ";
                                        if($idMaterial != '') if($gramatura['idGramaturaPapel'] == $resultado['idGramaturaPapel']) echo "selected ";
                                        echo ">{$gramatura['gramatura']} <i>(g/m<sup>2</sup>)</i></option>";
                                    }
                                    ?>
                                </select>
                                <label>Gramatura <p class="help-block">*</p></label>
                            </div>
                                <div class="col s1">
                                    <a id="addGramatura" href="#modalGramatura" class="waves-effect modal-trigger waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col s11">
                                <label>Cores <p class="help-block">*</p></label>
                                <select id="selectCor" name="selectCor[]" multiple class="browser-default">
                                    <option value="" disabled>Selecione as cores do material</option>
                                    <?php
                                    $sql = "SELECT * FROM Cor ORDER BY nome";
                                    $query = mysql_query($sql);
                                    while($cores = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='{$cores['idCor']}' ";
                                        if($idMaterial != '') {
                                            $sql2 = "SELECT * FROM Cor_Material WHERE idCor='{$cores['idCor']}' AND idMaterial='{$idMaterial}'";
                                            $query2 = mysql_query($sql2);
                                            if(mysql_num_rows($query2) == 1) {
                                                echo "selected";
                                            }
                                        }
                                        echo ">{$cores['nome']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col s1">
                                <a id="incluirCor" href="#modalCor" class="waves-effect modal-trigger waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s11">
                                <label>Categorias <p class="help-block">*</p></label>
                                <select id="selectCategoria" name="selectCategoria[]" multiple class="browser-default">
                                    <option value="" disabled>Selecione as categorias que o material pertence</option>
                                <?php
                                $sql = "select * from Categoria order by nome;";
                                $query = mysql_query($sql);
                                $cat = [];
                                $cat[] = "<p>";
                                while($categorias = mysql_fetch_assoc($query)) {
                                    echo "<option value='{$categorias['idCategoria']}' ";
                                    if($idMaterial != '') {
                                        $sql2 = "SELECT * FROM Categoria_Material WHERE idCategoria='{$categorias['idCategoria']}' AND idMaterial='{$idMaterial}'";
                                        $query2 = mysql_query($sql2);
                                        if( mysql_num_rows($query2) == 1) {
                                            echo "selected";
                                            $cat[] = "{$categorias['nome']} ({$categorias['descricao']})<br>";
                                        }
                                    }
                                    echo ">{$categorias['nome']} ({$categorias['descricao']})</option>";
                                }
                                $cat[] = "</p>"
                                ?>
                                </select>
                            </div>
                            <div class="col s1">
                                <a id="incluirCategoria" href="#modalCategoria" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
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
        <script src="js/autoNumeric-min.js"></script>
        <script src="js/valor.js"></script>
        <?php
        include 'modal/unidadeDeMedida.php';
        include 'modal/cor.php';
        include 'modal/gramatura.php';
        include 'modal/categorias.php';
        ?>
    </body>
</html>
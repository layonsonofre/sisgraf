<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
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
        <div id="help" class="modal">
            <div class="modal-content">
                <h4>Atualizar Tipo de Serviço</h4>
                <p>Insira o nome, descrição e valor do tipo de serviço. Selecione também o papel que este serviço pode ser feito.</p>
                <p>Segure o botão "Control" para selecionar vários campos.</p>
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
                            } else if($_GET['tipo'] == 'outro') {
                                echo "<h4>Atualizar Tipo de Serviço</h4>";
                            }
                            $sql = "select * from TipoServico, Carimbo where TipoServico.idTipoServico=" . $idTS . ";";
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
                        }
                        else {
                            if($_GET['tipo'] == 'carimbo') {
                                echo "<h4>Cadastrar Carimbo</h4>";
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
                    <form class="col s12" role="form" method="POST" action="control/tipoDeServico.php">
                        <p class="light" style="color: red;">* Campo obrigatório</p>
                        <div class="row">
                            <div class="input-field col s3">
                                <input name="nome" id="nome" type="text" class="validate" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['nome']."'"; if($_GET['tipo'] == 'carimbo') echo "value='Carimbo' readonly"; if($_GET['tipo'] == 'nota') echo "value='Nota Fiscal' readonly"; ?> length="24" maxlength="24">
                                <label for="nome" class="active">Nome <p class="help-block">*</p></label>
                            </div>
                            <div class="input-field col s6">
                                <input name="descricao" id="descricao" type="text" class="validate" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['descricao']."'"; if($_GET['tipo'] == 'carimbo') echo "value='Material auxiliar de uso diverso' readonly"; if($_GET['tipo'] == 'nota') echo "value='Tipo de impresso usado como documento fiscal' readonly"; ?> length="64" maxlength="64">
                                <label for="descricao" class="active">Descrição <p class="help-block">*</p></label>
                            </div>
                            <div class="input-field col s2">
                                <input name="valorUnitario" id="valorUnitario" type="text" class="valor validate right-align" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['valor']."'"; ?> length="10" maxlength="10">
                                <label for="valorUnitario" class="active">Valor (R$) <p class="help-block">*</p></label>
                            </div>
                            <div class="input-field col s1">
                                <input name="status" id="status" type="checkbox" value="ativo" <?php if($idTS)  { if($resultado['status'] == 'ativo') echo "checked"; } else echo "checked"; ?>>
                                <label for="status">Ativo</label>
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
                                        <option value="1" <?php if(isset($_GET['idTS'])) { if($resultado['isAutomatico'] == '1') echo "selected"; } ?> >Automático</option>
                                        <option value="0" <?php if(isset($_GET['idTS'])) { if($resultado['isAutomatico'] == '0') echo "selected"; } ?> >Madeira</option>
                                    </select>
                                    <label for="isAutomatico" class="active">Tipo <p class="help-block">*</p></label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="nomeCarimbo" id="nomeCarimbo" type="text" class="validate" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['nomeCarimbo']."'"; ?> length="10" maxlength="10">
                                    <label for="nomeCarimbo" class="active">Nome <p class="help-block">*</p></label>
                                </div>
                                <div class="input-field col s3">
                                    <input name="baseCarimbo" id="baseCarimbo" type="text" class="validate right-align" data-mask="9?99"<?php if(isset($_GET['idTS'])) echo "value='".$resultado['base']."'"; ?>>
                                    <label for="baseCarimbo" class="active">Base (mm) <p class="help-block">*</p></label>
                                </div>
                                <div class="input-field col s3">
                                    <input name="alturaCarimbo" id="alturaCarimbo" type="text" class="validate right-align" data-mask="9?99" <?php if(isset($_GET['idTS'])) echo "value='".$resultado['altura']."'"; ?>>
                                    <label for="alturaCarimbo" class="active">Altura (mm) <p class="help-block">*</p></label>
                                </div>
                            </div>
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
                                <div class="input-field col s8">
                                    <select id="selectPapel" name="selectPapel">
                                        <?php
                                        echo "<option value='' disabled>Selecione os papéis em que pode ser impresso</option>";
                                        $sql = "SELECT * FROM `Papel`;";
                                        $query = mysql_query($sql);
                                        $valorPapel = 0;
                                        while($papel = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                            echo "<option value='".$papel['idMaterial']."' ";
                                            if($idTS != NULL) {
                                                $sql2 = "select COUNT(*) as total, Material_TipoServico.* from Material_TipoServico where idMaterial=".$papel['idMaterial']." and idTipoServico=".$idTS.";";
                                                $query2 = mysql_query($sql2);
                                                while($temp = mysql_fetch_assoc($query2)) {
                                                    if($temp['total'] == 1) {
                                                        echo "selected";
                                                        $valorPapel = $temp['valor'];
                                                    }
                                                }
                                            }
                                            $sql2 = "select gramatura from GramaturaPapel where idGramaturaPapel = {$papel['idGramaturaPapel']}";
                                            $query2 = mysql_query($sql2);
                                            $gram = mysql_fetch_assoc($query2);
                                            echo ">{$papel['tipo']} {$gram['gramatura']} <i>g/m^2</i></option>";
                                        }
                                        ?>
                                    </select>
                                    <label>Papel <p class="help-block">*</p></label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="valorPapel" id="valorPapel" type="text" class="valor validate right-align" value="<?php echo $valorPapel; ?>" length="10" maxlength="10">
                                    <label for="valorPapel" class="active">Valor (R$) <p class="help-block">*</p></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s11">
                                    <label>Formato <p class="help-block">*</p></label>
                                    <select id="selectFormato" name="selectFormato[]" multiple class="browser-default">
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
                                </div>
                                <div class="col s1">
                                    <a href="#modalFormato" id="addFormato" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s11">
                                    <label>Acabamento <p class="help-block">*</p></label>
                                    <select id="selectAcabamento" name="selectAcabamento[]" multiple class="browser-default">
                                    <?php
                                        echo "<option value='' disabled>Selecione os acabamentos disponíveis para o serviço</option>";
                                        $sql = "SELECT * FROM Acabamento;";
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
                        ?>
                        <input type="hidden" name="idTS" value="<?php echo $idTS; ?>">
                        <button class="btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right">send</i></button>
                        <input type="hidden" name="acao" value="<?php echo isset($_GET['idTS']) ? 'atualizar' : 'inserir';  ?>" />
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" />
                    </form>
                    <form role="form" method="POST" name="excluir" action="control/tipoDeServico.php">
                        <input type="hidden" name="acao" value="excluir" />
                        <input type="hidden" name="idTS" value="<?php echo $idTS; ?>" />
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
        include 'header.php';
        include 'modal/acabamento.php';
        include 'modal/formato.php';
        ?>

        <script>
            $(document.body).on("hidden.modal", function() {
                $("#modal").removeData(".modal");
            });
        </script>
    </body>
</html>

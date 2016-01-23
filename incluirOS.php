<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Incluir Ordem de Serviço</title>
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
                        $idOS = isset($_GET['idOS']) ? $_GET['idOS'] : '';
                        if($idOS != '') {
                            //if($_GET['tipo'] == 'material') {
                                echo "<h4>Atualizar Ordem de Serviço</h4>";
                            //} else if($_GET['tipo'] == 'papel') {
                                //echo "<h4>Atualizar Papel</h4>";
                            //$sql = "select * from Material, Papel where Material.idMaterial=" . $idMaterial . ";";
                            //$query = mysql_query($sql);
                            //$resultado = mysql_fetch_assoc($query);
                            //}
                        }
                        else {
                            //if($_GET['tipo'] == 'material') {
                                echo "<h4>Cadastrar Ordem de Serviço</h4>";
                            //} else if($_GET['tipo'] == 'papel') {
                                //echo "<h4>Cadastrar Papel</h4>";
                            //}
                        }
                        ?>
                    </div>
                    <div class="col s12 l2 valign">
                        <a class="waves-effect waves-light modal-trigger" href="#help"><i class="material-icons">info</i></a>
                    </div>
                </div>
                <div class="row">
                    <form class="col s12" role="form" method="POST" action="control/ordemdeservico.php">
                        <div class="row">
                            <div class="col s12">
                                <p>
                                    <input name="isOrcamento" type="radio" id="isOS" value="true" checked>
                                    <label for="isOS">Ordem de Serviço&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <input name="isOrcamento" type="radio" id="isOrc" value="false">
                                    <label for="isOrc">Orçamento</label>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <input name="dataEntrada" id="dataEntrada" type="date" class="validate datepicker" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['dataEntrada']."'"; ?>>
                                <label for="dataEntrada" class="active">Data de Entrada</label>
                            </div>
                            <?php
                            if($idOS != '') {
                            ?>
                            <div class="input-field col s3">
                                <input name="dataSaida" id="dataSaida" type="date" class="validate datepicker" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['dataSaida']."'"; ?>>
                                <label for="dataSaida" class="active">Data de Saída</label>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="input-field col s3">
                                <input name="status" id="status" type="text" class="validate" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['status']."'"; ?>>
                                <label for="status" class="active">Status</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="valorTotal" id="valorTotal" type="text" class="validate right-align" <?php if(isset($_GET['idMaterial'])) echo "value='".$resultado['valorTotal']."'"; ?> length="10" maxlength="10">
                                <label for="valorTotal" class="active">Valor Total (R$)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s11">
                                <select id="selectCliente" name="selectCliente[]" multiple>
                                    <option value="" disabled selected>Selecione os clientes</option>
                                <?php
                                $sql = "select * from Pessoa order by nome, nomeFantasia;";
                                $query = mysql_query($sql);
                                while($pessoa = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                    echo "<option value='".$pessoa['idPessoa']."' ";
                                    if($idOS != '') {
                                        $sql2 = "select * from Pessoa_OrdemDeServico where idPessoa=".$pessoa['idPessoa']." and idOrdemDeServico=".$idOS.";";
                                        $query2 = mysql_query($sql2);
                                        if( mysql_num_rows($query2) == 1) {
                                            echo "selected";
                                        }
                                    }
                                    if($pessoa['isPessoaFisica'] == 'FALSE') {
                                        echo ">{$pessoa['nomeFantasia']} ({$pessoa['nomeRua']}, {$pessoa['numero']} - {$pessoa['cidade']})</option>";
                                    } else {
                                        echo ">{$pessoa['nome']} ({$pessoa['nomeRua']}, {$pessoa['numero']} - {$pessoa['cidade']})</option>";
                                    }
                                }
                                ?>
                                </select>
                                <label>Clientes</label>
                            </div>
                            <div class="col s1">
                                <a href="incluirPessoa.php?tipo=cliente" target="_blank" id="addCliente" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                            </div>
                        </div>
                        <div class="row" id="selecionarTipo">
                            <div class="col s3"><a class="waves-effect waves-light btn-flat" id="diverso">Diverso</a></div>
                            <div class="col s3"><a class="waves-effect waves-light btn-flat" id="externo">Externo</a></div>
                            <div class="col s3"><a class="waves-effect waves-light btn-flat" id="nota">Nota Fiscal</a></div>
                            <div class="col s3"><a class="waves-effect waves-light btn-flat" id="carimbo">Carimbo</a></div>
                        </div>
                        <div id="servico">
                            <div class="row">
                                <div class="col s12">
                                    <h5 id="titulo">Adicionar</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s7">
                                    <select id="selectTipoServico" name="selectTipoServico">
                                        <option value="" disabled selected>Selecione</option>
                                        <?php
                                        $sql = "select * from TipoServico order by nome;";
                                        $query = mysql_query($sql);
                                        while($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                            echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nome']} ({$tipoServico['descricao']})</option>";
                                        }
                                        ?>
                                    </select>
                                    <label>Tipo De Serviço</label>
                                </div>
                                <div class="col s1">
                                    <a href="incluirTipoDeServico.php?tipo=outro" target="_blank" id="addTipoDeServico" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                                </div>
                                <div class="input-field col s4">
                                    <input name="quantidade" id="quantidade" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['quantidade']."'"; ?>>
                                    <label for="quantidade" class="active">Quantidade</label>
                                </div>
                            </div>
                            <div id="detalhesServico">
                                <div class="row">
                                    <div class="input-field col s7">
                                        <select id="selectFormaImpressao" name="selectFormaImpressao">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from FormaImpressao order by nome;";
                                            $query = mysql_query($sql);
                                            while($formaImpressao = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$formaImpressao['idFormaImpressao']}'>{$formaImpressao['nome']} ({$formaImpressao['descricao']})</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Forma de Impressão</label>
                                    </div>
                                    <div class="col s1">
                                        <a href="#modalFormaImpressao" id="addFormaImpressao" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                    </div>

                                    <div class="input-field col s3">
                                        <select id="selectQuantidadeCores" name="selectQuantidadeCores">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from QuantidadeCores;";
                                            $query = mysql_query($sql);
                                            while($quantidadeCores = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$quantidadeCores['idQuantidadeCores']}'>{$quantidadeCores['descricao']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Quantidade de Cores</label>
                                    </div>
                                    <div class="col s1">
                                        <a href="#modalQuantidadeCores" id="addQuantidadeCores" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                    </div>
                                </div>

                                <div class="row" id="cores">
                                    <div class="input-field col s2">
                                        <select id="cf1" name="coresFrente">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Frente #1</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cf2" name="coresFrente">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Frente #2</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cf3" name="coresFrente">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Frente #3</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cv1" name="coresVerso">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Verso #1</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cv2" name="coresVerso">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Verso #2</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cv3" name="coresVerso">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Verso #3</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <select id="selectFormato" name="selectFormato">
                                            <option value='' disabled>Selecione primeiro o tipo de serviço</option>
                                        </select>
                                        <label>Formato</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <select id="selectAcabamento" name="selectAcabamento">
                                            <option value='' disabled>Selecione primeiro o tipo de serviço</option>
                                        </select>
                                        <label>Acabamento</label>
                                    </div>
                                </div>
                            </div>
                            <div id="fornecedor">
                                <div class="row">
                                    <div class="input-field col s11">
                                        <select id="selectFornecedor" name="selectFornecedor">
                                            <option value="" disabled selected>Selecione quem vai imprimir o serviço</option>
                                        <?php
                                        $sql = "select * from Pessoa order by nome, nomeFantasia;";
                                        $query = mysql_query($sql);
                                        while($pessoa = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                            echo "<option value='".$pessoa['idPessoa']."' ";
                                            // if($idOS != '') {
                                            //     $sql2 = "select * from Pessoa_OrdemDeServico where idPessoa=".$pessoa['idPessoa']." and idOrdemDeServico=".$idOS.";";
                                            //     $query2 = mysql_query($sql2);
                                            //     if( mysql_num_rows($query2) == 1) {
                                            //         echo "selected";
                                            //     }
                                            // }
                                            if($pessoa['isPessoaFisica'] == 'FALSE') {
                                                echo ">{$pessoa['nomeFantasia']} ({$pessoa['nomeRua']}, {$pessoa['numero']} - {$pessoa['cidade']})</option>";
                                            } else {
                                                echo ">{$pessoa['nome']} ({$pessoa['nomeRua']}, {$pessoa['numero']} - {$pessoa['cidade']})</option>";
                                            }
                                        }
                                        ?>
                                        </select>
                                        <label>Fornecedor</label>
                                    </div>
                                    <div class="col s1">
                                        <a href="incluirPessoa.php?tipo=fornecedor" target="_blank" id="addFornecedor" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="detalhesNota">
                                <div class="row">
                                    <div class="input-field col s5">
                                        <select id="selectModeloNotaFiscal" name="selectModeloNotaFiscal">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from ModeloNotaFiscal order by modelo;";
                                            $query = mysql_query($sql);
                                            while($modelo = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$modelo['idModeloNotaFiscal']}'>{$modelo['descricao']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Modelo de Nota</label>
                                    </div>
                                    <div class="col s1">
                                        <a href="#modalModeloNotaFiscal" id="addModeloNota" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                    </div>
                                    <div class="input-field col s6">
                                        <input name="aidf" id="aidf" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['AIDF']."'"; ?> data-mask="9?999">
                                        <label for="aidf" class="active">AIDF</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <input name="numeracaoInicial" id="numeracaoInicial" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['AIDF']."'"; ?> data-mask="9?999">
                                        <label for="numeracaoInicial" class="active">Num. Inicial</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="numeracaoFinal" id="numeracaoFinal" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['AIDF']."'"; ?> data-mask="9?999">
                                        <label for="numeracaoFinal" class="active">Num. Final</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="numeroTalao" id="numeroTalao" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['AIDF']."'"; ?> data-mask="9?999">
                                        <label for="numeroTalao" class="active">Num. Talão</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="folhasBloco" id="folhasBloco" type="text" class="validate right-align" <?php if(isset($_GET['idOS'])) echo "value='".$resultado['AIDF']."'"; ?> data-mask="9?999">
                                        <label for="folhasBloco" class="active">Folhas por Bloco</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="observacoes" class="materialize-textarea" length="2000" maxlength="2000"></textarea>
                                        <label for="observacoes">Observações</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($_GET['idOS']))
                            echo "<a class=\"btn waves-effect waves-light red accent-4\" name=\"exlcuir\" onclick=\"document.forms['excluir'].submit()\">Excluir<i class=\"material-icons right\">delete</i></a>";
                            echo "<input type=\"hidden\" name=\"acao\" value=\"incluir\" />";
                            echo "<input type=\"hidden\" name=\"idMaterial\" value=\"" . $idOS . "\" />";
                        ?>
                        <button class="btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right">send</i></button>
                        <input type="hidden" name="acao" value="<?php echo isset($_GET['idOS']) ? 'atualizar' : 'inserir';  ?>" />
                    </form>
                    <form role="form" method="POST" name="excluir" action="control/material.php">
                        <input type="hidden" name="acao" value="excluir" />
                        <input type="hidden" name="idOS" value="<?php echo $idOS; ?>" />
                    </form>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/jasny-bootstrap.min.js"></script>
        <script src="js/ajax/ordemDeServico.js"></script>
        <script src="js/ordemDeServico/quantidadeCores.js"></script>
        <script src="js/ordemDeServico/selecionarTipoServico.js"></script>
        <script>
            var $input = $('.datepicker').pickadate();
            var picker = $input.pickadate('picker');
            picker.set('select', new Date());
        </script>
        <?php
        include 'modal/formaImpressao.php';
        include 'modal/quantidadeCores.php';
        include 'modal/modeloNotaFiscal.php';
        ?>
    </body>
</html>
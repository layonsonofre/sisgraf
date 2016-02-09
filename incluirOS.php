<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

unset($_SESSION['idOS']);
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
                        if (isset($_GET['at']) && $_GET['at'] == 'ok')
                            echo "<div class='card-panel green lighten-2 white-text'>Dados atualizados com sucesso!<i class='material-icons right'>close</i></div>";
                        if (isset($_GET['at']) && $_GET['at'] == 'no')
                            echo "<div class='card-panel red lighten-2 white-text'>Dados não atualizados no sistema, tente novamente.<i class='material-icons right'>close</i></div>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row valign-wrapper">
                    <div class="col s12 l10">
                        <?php
                        $idOS = isset($_SESSION['idOS']) ? $_SESSION['idOS'] : '';
                        if($idOS == '') $idOS = isset($_GET['idOS']) ? $_GET['idOS'] : '';
                        echo "<h1>{$idOS}</h1>";
                        if ($idOS != '') {
                            //if($_GET['tipo'] == 'material') {
                            echo "<h4>Atualizar Ordem de Serviço</h4>";
                            //} else if($_GET['tipo'] == 'papel') {
                            //echo "<h4>Atualizar Papel</h4>";
                            $sql = "SELECT * FROM OrdemDeServico WHERE idOrdemDeServico={$idOS}";
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
                            //}
                        } else {
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
                    <form class="col s12" role="form" id="formOS" method="POST" action="control/ordemdeservico.php">
                        <div class="row">
                            <div class="col s12">
                                <p>
                                    <input name="isOrcamento" type="radio" id="isOS" value="0" checked>
                                    <label for="isOS">Ordem de Serviço&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <input name="isOrcamento" type="radio" id="isOrc" value="1">
                                    <label for="isOrc">Orçamento</label>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <input name="dataEntrada" id="dataEntrada" type="date" class="validate datepicker" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['dataEntrada'] . "'"; ?>>
                                <label for="dataEntrada" class="active">Data de Entrada</label>
                            </div>
                            <?php
                            if ($idOS != '') {
                            ?>
                            <div class="input-field col s3">
                                <input name="dataSaida" id="dataSaida" type="date" class="validate datepicker" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['dataSaida'] . "'"; ?>>
                                <label for="dataSaida" class="active">Data de Saída</label>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="input-field col s3">
                                <input name="valorTotal" id="valorTotal" type="text" class="validate right-align" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['valorTotal'] . "'"; ?> length="10" maxlength="10">
                                <label for="valorTotal" class="active">Valor Total (R$)</label>
                            </div>
                            <div class="input-field col s3">
                                <select id="status" name="status">
                                    <option value="cadastro" <?php if($idOS) if($resultado['status'] == 'cadastro') echo 'selected';?>>Cadastro</option>
                                    <option value="desenvolvimento" <?php if($idOS) if($resultado['status'] == 'desenvolvimento') echo 'selected';?>>Desenvolvimento</option>
                                    <option value="aprovacao" <?php if($idOS) if($resultado['status'] == 'aprovacao') echo 'selected';?>>Aprovação</option>
                                    <option value="impressao" <?php if($idOS) if($resultado['status'] == 'impressao') echo 'selected';?>>Imprimindo</option>
                                    <option value="acabamento" <?php if($idOS) if($resultado['status'] == 'acabamento') echo 'selected';?>>Acabamento</option>
                                    <option value="pronto" <?php if($idOS) if($resultado['status'] == 'pronto') echo 'selected';?>>Pronto</option>
                                    <option value="entregue" <?php if($idOS) if($resultado['status'] == 'entregue') echo 'selected';?>>Entregue</option>
                                    <option value="cancelada" <?php if($idOS) if($resultado['status'] == 'cancelada') echo 'selected';?>>Cancelada</option>
                                </select>
                                <label>Status</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s11">
                                <select id="selectCliente" name="selectCliente[]" multiple>
                                    <option value="" disabled selected>Selecione os clientes</option>
                                    <?php
                                    $sql = "select * from Pessoa order by nome, nomeFantasia;";
                                    $query = mysql_query($sql);
                                    while ($pessoa = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='" . $pessoa['idPessoa'] . "' ";
                                        if ($idOS != '') {
                                            $sql2 = "select * from Pessoa_OrdemDeServico where idPessoa=" . $pessoa['idPessoa'] . " and idOrdemDeServico=" . $idOS . ";";
                                            $query2 = mysql_query($sql2);
                                            if (mysql_num_rows($query2) == 1) {
                                                echo "selected";
                                            }
                                        }
                                        if ($pessoa['isPessoaFisica'] == 'FALSE') {
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

                            <div id="detalhesNota">
                                <div class="row">
                                    <div class="input-field col s3">
                                        <input name="nomeNota" id="nomeNota" type="text" value="Nota Fiscal" readonly>
                                        <label for="nomeNota" class="active">Nome</label>
                                    </div>
                                    <div class="input-field col s7">
                                        <input name="descricaoNota" id="descricaoNota" type="text" value="Impresso utilizado como documento fiscal" readonly>
                                        <label for="descricaoNota" class="active">Descrição</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <input name="valorNota" id="valorNota" type="text" class="validate right-align" length="10" maxlength="10">
                                        <label for="valorNota" class="active">Valor (R$)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <input name="quantidade" id="quantidade" type="text" class="validate right-align" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['quantidade'] . "'"; ?>>
                                        <label for="quantidade" class="active">Quantidade</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <select id="selectModeloNotaFiscal" name="selectModeloNotaFiscal">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from ModeloNotaFiscal order by modelo;";
                                            $query = mysql_query($sql);
                                            while ($modelo = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$modelo['idModeloNotaFiscal']}'>{$modelo['modelo']} ({$modelo['descricao']})</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Modelo de Nota</label>
                                    </div>
                                    <div class="col s1">
                                        <a href="#modalModeloNotaFiscal" id="addModeloNota" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="aidf" id="aidf" type="text" class="validate right-align" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['AIDF'] . "'"; ?> data-mask="9?999">
                                        <label for="aidf" class="active">AIDF</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <input name="numeracaoInicial" id="numeracaoInicial" type="text" class="validate right-align" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['AIDF'] . "'"; ?> data-mask="9?999">
                                        <label for="numeracaoInicial" class="active">Num. Inicial</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="numeracaoFinal" id="numeracaoFinal" type="text" class="validate right-align" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['AIDF'] . "'"; ?> data-mask="9?999">
                                        <label for="numeracaoFinal" class="active">Num. Final</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="numeroTalao" id="numeroTalao" type="text" class="validate right-align" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['AIDF'] . "'"; ?> data-mask="9?999">
                                        <label for="numeroTalao" class="active">Num. Talão</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="folhasBloco" id="folhasBloco" type="text" class="validate right-align" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['AIDF'] . "'"; ?> data-mask="9?999">
                                        <label for="folhasBloco" class="active">Folhas por Bloco</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s5">
                                        <select id="selectFormato" name="selectFormato[]" multiple>
                                            <?php
                                            echo "<option value='' disabled>Selecione os formatos que este serviço pode ser feito</option>";
                                            $sql = "SELECT * FROM `Formato`;";
                                            $query = mysql_query($sql);
                                            while ($forms = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='" . $forms['idFormato'] . "'>" . $forms['formato'] . " (" . $forms['base'] . " x " . $forms['altura'] . " <i>mm</i>)</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Formato</label>
                                    </div>
                                    <div class="col s1">
                                        <a href="#modalFormato" id="addFormato" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                    </div>
                                    <div class="input-field col s5">
                                        <select id="selectVias" name="selectVias">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Vias;";
                                            $query = mysql_query($sql);
                                            while ($vias = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$vias['idVias']}'>{$vias['quantidade']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Número de Vias</label>
                                    </div>
                                    <div class="col s1">
                                        <a href="#modalVias" id="addVias" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                    </div>
                                </div>
                                <div id="material_vias">
                                    <div class="row" id="material_vias1">
                                        <div class="input-field col s3">
                                            <select id="papel1" name="selectPapel">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                $sql = "select Papel.* from Papel INNER JOIN Material ON Material.idMaterial=Papel.idMaterial;";
                                                $query = mysql_query($sql);
                                                while ($mat = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                    echo "<option value='{$mat['idMaterial']}'>{$mat['tipo']}</option>";
                                                }
                                                ?>
                                            </select>
                                            <label>Papel</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="gramatura1" name="selectGramatura">
                                                <option value="" disabled selected>Selecione</option>
                                            </select>
                                            <label>Gramatura</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="cor1" name="selectCor">
                                                <option value="" disabled selected>Selecione</option>
                                            </select>
                                            <label>Cor</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="acabamento1" name="selectAcabamentoVia">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                $sql = "select * from Acabamento;";
                                                $query = mysql_query($sql);
                                                while ($acabs = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                    echo "<option value='{$acabs['idAcabamento']}'>{$acabs['nome']} ({$acabs['descricao']} - Local: {$acabs['local']})</option>";
                                                }
                                                ?>
                                            </select>
                                            <label>Acabamento</label>
                                        </div>
                                    </div>
                                    <div class="row" id="material_vias2">
                                        <div class="input-field col s3">
                                            <select id="papel2" name="selectPapel">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                $sql = "select Papel.* from Papel INNER JOIN Material ON Material.idMaterial=Papel.idMaterial;";
                                                $query = mysql_query($sql);
                                                while ($mat = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                    echo "<option value='{$mat['idMaterial']}'>{$mat['tipo']}</option>";
                                                }
                                                ?>
                                            </select>
                                            <label>Papel</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="gramatura2" name="selectGramatura">
                                                <option value="" disabled selected>Selecione</option>
                                            </select>
                                            <label>Gramatura</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="cor2" name="selectCor">
                                                <option value="" disabled selected>Selecione</option>
                                            </select>
                                            <label>Cor</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="acabamento2" name="selectAcabamentoVia">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                $sql = "select * from Acabamento;";
                                                $query = mysql_query($sql);
                                                while ($acabs = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                    echo "<option value='{$acabs['idAcabamento']}'>{$acabs['nome']} ({$acabs['descricao']} - Local: {$acabs['local']})</option>";
                                                }
                                                ?>
                                            </select>
                                            <label>Acabamento</label>
                                        </div>
                                    </div>
                                    <div class="row" id="material_vias3">
                                        <div class="input-field col s3">
                                            <select id="papel3" name="selectPapel">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                $sql = "select Papel.* from Papel INNER JOIN Material ON Material.idMaterial=Papel.idMaterial;";
                                                $query = mysql_query($sql);
                                                while ($mat = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                    echo "<option value='{$mat['idMaterial']}'>{$mat['tipo']}</option>";
                                                }
                                                ?>
                                            </select>
                                            <label>Papel</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="gramatura3" name="selectGramatura">
                                                <option value="" disabled selected>Selecione</option>
                                            </select>
                                            <label>Gramatura</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="cor3" name="selectCor">
                                                <option value="" disabled selected>Selecione</option>
                                            </select>
                                            <label>Cor</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="acabamento3" name="selectAcabamentoVia">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                $sql = "select * from Acabamento;";
                                                $query = mysql_query($sql);
                                                while ($acabs = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                    echo "<option value='{$acabs['idAcabamento']}'>{$acabs['nome']} ({$acabs['descricao']} - Local: {$acabs['local']})</option>";
                                                }
                                                ?>
                                            </select>
                                            <label>Acabamento</label>
                                        </div>
                                    </div>
                                    <div class="row" id="material_vias4">
                                        <div class="input-field col s3">
                                            <select id="papel4" name="selectPapel">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                $sql = "select Papel.* from Papel INNER JOIN Material ON Material.idMaterial=Papel.idMaterial;";
                                                $query = mysql_query($sql);
                                                while ($mat = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                    echo "<option value='{$mat['idMaterial']}'>{$mat['tipo']}</option>";
                                                }
                                                ?>
                                            </select>
                                            <label>Papel</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="gramatura4" name="selectGramatura">
                                                <option value="" disabled selected>Selecione</option>
                                            </select>
                                            <label>Gramatura</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="cor4" name="selectCor">
                                                <option value="" disabled selected>Selecione</option>
                                            </select>
                                            <label>Cor</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <select id="acabamento4" name="selectAcabamentoVia">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                $sql = "select * from Acabamento;";
                                                $query = mysql_query($sql);
                                                while ($acabs = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                    echo "<option value='{$acabs['idAcabamento']}'>{$acabs['nome']} ({$acabs['descricao']} - Local: {$acabs['local']})</option>";
                                                }
                                                ?>
                                            </select>
                                            <label>Acabamento</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tipoServico_quantidade">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select id="selectTipoServico" name="selectTipoServico">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from TipoServico order by nome;";
                                            $query = mysql_query($sql);
                                            while ($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nome']} ({$tipoServico['descricao']})</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Tipo De Serviço</label>
                                    </div>
                                    <div class="col s1">
                                        <a href="incluirTipoDeServico.php?tipo=outro" target="_blank" id="addTipoDeServico" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">add</i></a>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="quantidade" id="quantidade" type="text" class="validate right-align" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['quantidade'] . "'"; ?>>
                                        <label for="quantidade" class="active">Quantidade</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <input name="valor" id="valor" type="text" class="validate right-align" <?php if (isset($_GET['idOS'])) echo "value='" . $resultado['valorTotal'] . "'"; ?>>
                                        <label for="valor" class="active">Valor (R$)</label>
                                    </div>
                                </div>
                            </div>
                            <div id="detalhesServico">
                                <div id="formaimpressao_quantidadeCores">
                                    <div class="row">
                                        <div class="input-field col s7">
                                            <select id="selectFormaImpressao" name="selectFormaImpressao">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                $sql = "select * from FormaImpressao order by nome;";
                                                $query = mysql_query($sql);
                                                while ($formaImpressao = mysql_fetch_array($query, MYSQL_ASSOC)) {
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
                                                while ($quantidadeCores = mysql_fetch_array($query, MYSQL_ASSOC)) {
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
                                </div>
                                <div class="row" id="cores">
                                    <div class="input-field col s2">
                                        <select id="cf1" name="cf1">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while ($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Frente #1</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cf2" name="cf2">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while ($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Frente #2</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cf3" name="coresFrente[]">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while ($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Frente #3</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cv1" name="cv1">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while ($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Verso #1</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cv2" name="cv2">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while ($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Verso #2</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select id="cv3" name="cv3">
                                            <option value="" disabled selected>Selecione</option>
                                            <?php
                                            $sql = "select * from Cor order by nome;";
                                            $query = mysql_query($sql);
                                            while ($cor = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='{$cor['idCor']}'>{$cor['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Cor Verso #3</label>
                                    </div>
                                </div>
                                <div id="formato_acabamento">
                                    <div class="row">
                                        <div class="input-field col s4">
                                            <select id="selectPapel" name="selectPapel">
                                                <option value='' disabled>Selecione primeiro o tipo de serviço</option>
                                            </select>
                                            <label>Papel</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <select id="selectFormato1" name="selectFormato1">
                                                <option value='' disabled>Selecione primeiro o tipo de serviço</option>
                                            </select>
                                            <label>Formato</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <select id="selectAcabamento" name="selectAcabamento[]" multiple>
                                                <option value='' disabled>Selecione primeiro o tipo de serviço</option>
                                            </select>
                                            <label>Acabamento</label>
                                        </div>
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
                                            while ($pessoa = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                                echo "<option value='" . $pessoa['idPessoa'] . "' ";
                                                // if($idOS != '') {
                                                //     $sql2 = "select * from Pessoa_OrdemDeServico where idPessoa=".$pessoa['idPessoa']." and idOrdemDeServico=".$idOS.";";
                                                //     $query2 = mysql_query($sql2);
                                                //     if( mysql_num_rows($query2) == 1) {
                                                //         echo "selected";
                                                //     }
                                                // }
                                                if ($pessoa['isPessoaFisica'] == 'FALSE') {
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
                            <div class="row">
                                <div class="col s4"><button class="btn waves-effect waves-light amber accent-4" name="adicionar" id="adicionar">Adicionar<i class="material-icons left">add</i></button></div>
                                <div class="col s4 right-align"><a class="btn waves-effect waves-light yellow accent-4" name="mostrar" id="mostrar">Serviços<i class="material-icons left">list</i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="observacoes" class="materialize-textarea" length="2000" maxlength="2000"></textarea>
                            <label for="observacoes">Observações</label>
                        </div>
                    </div>
                    <div id="items"></div>
                    <input type="hidden" name="primeiraVez" id="primeiraVez" value="1">
                    <input type="hidden" name="idOS" id="idOS" value="<?php echo $idOS; ?>" >
                    <input type="hidden" name="acao" id="acao" value="<?php echo isset($_GET['idOS']) ? 'atualizar' : 'inserir'; ?>" />
                    <input type="hidden" name="tipo" id="tipo">
                </form>
                <div class="row">
                    <a type="hidden" target="_blank" id="incluirArquivo"></a>
                    <div class="col s4 left-align"><a class="btn waves-effect waves-light blue accent-4" name="arquivo" id="arquivo">Arquivo<i class="material-icons right">description</i></a></div>
                    <div class="col s4 center-align"><a class="btn waves-effect waves-light green accent-4" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></a></div>
                    <div class="col s4 right-align"><a class="btn waves-effect waves-light red accent-4" name="cancelar" id="cancelar">Cancelar O.S.<i class="material-icons right">delete</i></a></div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/jquery.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src="js/cadastro.js"></script>
    <script src="js/jasny-bootstrap.min.js"></script>
    <script src="js/ordemDeServico/ordemDeServico.js"></script>
    <script src="js/ordemDeServico/quantidadeCores.js"></script>
    <script src="js/ordemDeServico/selecionarTipoServico.js"></script>
    <script src="js/ordemDeServico/materialVias.js"></script>
    <script src="js/ordemDeServico/adicionar.js"></script>
    <script>
        var $input = $('.datepicker').pickadate();
        var picker = $input.pickadate('picker');
        picker.set('select', new Date());

        $(function() {
            $(document).on('click', '.paginacao', function(event) {
                event.preventDefault();
                var pagina = $(this).attr("pagina");
                $("#pagina").attr("value", pagina);    
                //$("form:eq(0)").submit();
            });
        });
        var idOS = $("#idOS").val();
        if(idOS !== '') {
            window.onload = function() {
                console.log(idOS);
                var request;
                if (request) {
                    request.abort();
                }
                var temp = $("#idOS").val();
                if(temp === '') {
                    temp = -1;
                }
                var $form = $("#formOS");
                var $inputs = $form.find("input, select, button, textarea");
                $inputs.prop("disabled", true);
                request = $.ajax({
                    url: "control/ordemDeServico.php",
                    type: "post",
                    data: "acao=listarServicos&idOS=" + idOS
                });
                request.done(function (response, textStatus, jqXHR){
                    console.log(response);
                    $('#items').empty().append(response);
                });
                request.fail(function (jqXHR, textStatus, errorThrown){
                    console.error(
                        "The following error occurred: "+
                        textStatus, errorThrown
                    );
                });
                request.always(function () {
                    $inputs.prop("disabled", false);
                });
            };
        }
    </script>
    <?php
    include 'header.php';
    include 'modal/formaImpressao.php';
    include 'modal/quantidadeCores.php';
    include 'modal/modeloNotaFiscal.php';
    ?>
</body>
</html>
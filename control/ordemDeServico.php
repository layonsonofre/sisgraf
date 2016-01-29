<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';
$idMaterial = isset($_POST['idMaterial']) ? $_POST['idMaterial'] : '';
$idOS = isset($_POST['idOS']) ? $_POST['idOS'] : '';
$idTS = isset($_POST['idTS']) ? $_POST['idTS'] : '';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$valor = isset($_POST['valor']) ? $_POST['valor'] : '';

$dataEntrada = isset($_POST['dataEntrada']) ? $_POST['dataEntrada'] : '';
$dataSaida = isset($_POST['dataSaida']) ? $_POST['dataSaida'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$isOrcamento = isset($_POST['isOrcamento']) ? $_POST['isOrcamento'] : '';
$valorTotal = isset($_POST['valorTotal']) ? $_POST['valorTotal'] : '';
$observacoes = isset($_POST['observacoes']) ? $_POST['observacoes'] : '';

$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
$valor = isset($_POST['valor']) ? $_POST['valor'] : '';
$formaImpressao = isset($_POST['selectFormaImpressao']) ? $_POST['selectFormaImpressao'] : '';
$quantidadeCores = isset($_POST['selectQuantidadeCores']) ? $_POST['selectQuantidadeCores'] : '';
$acabamento = isset($_POST['selectAcabamento']) ? $_POST['selectAcabamento'] : '';
$formato = isset($_POST['selectFormato']) ? $_POST['selectFormato'] : '';

$cliente = isset($_POST['selectCliente']) ? $_POST['selectCliente'] : '';
$fornecedor = isset($_POST['selectFornecedor']) ? $_POST['selectFornecedor'] : '';

$idTipoServico = isset($_POST['selectTipoServico']) ? $_POST['selectTipoServico'] : '';
$cf1 = isset($_POST['cf1']) ? $_POST['cf1'] : '';
$cf2 = isset($_POST['cf2']) ? $_POST['cf2'] : '';
$cf3 = isset($_POST['cf3']) ? $_POST['cf3'] : '';
$cv1 = isset($_POST['cv1']) ? $_POST['cv1'] : '';
$cv2 = isset($_POST['cv2']) ? $_POST['cv2'] : '';
$cv3 = isset($_POST['cv3']) ? $_POST['cv3'] : '';

$nomeNota = isset($_POST['nomeNota']) ? $_POST['nomeNota'] : '';
$descricaoNota = isset($_POST['descricaoNota']) ? $_POST['descricaoNota'] : '';
$modeloNota = isset($_POST['selectModeloNota']) ? $_POST['selectModeloNota'] : '';
$aidf = isset($_POST['aidf']) ? $_POST['aidf'] : '';
$numeracaoInicial = isset($_POST['numeracaoInicial']) ? $_POST['numeracaoFinal'] : '';
$numeracaoFinal = isset($_POST['numeracaoFinal']) ? $_POST['numeracaoFinal'] : '';
$numeroTalao = isset($_POST['numeroTalao']) ? $_POST['numeroTalao'] : '';
$folhasBloco = isset($_POST['folhasBloco']) ? $_POST['folhasBloco'] : '';
$vias = isset($_POST['selectVias']) ? $_POST['selectVias'] : '';
$valorNota = isset($_POST['valorNota']) ? $_POST['valorNota'] : '';


$primeiraVez = isset($_POST['primeiraVez']) ? $_POST['primeiraVez'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';

if($acao == '') {
	//header('Location: ../incluirTipoDeServico.php?at=no&tipo='.$tipo);
    echo var_dump($_POST);
} else if($acao == 'adicionar') {
    if($primeiraVez == '1') {
        $sql = "INSERT INTO `OrdemDeServico` (`idOrdemDeServico`,`dataEntrada`,`dataSaida`,`status`,`isOrcamento`,`valorTotal`,`observacoes`) VALUES (NULL,'{$dataEntrada}','{$dataSaida}','{$status}','{$isOrcamento}','{$valorTotal}','{$observacoes}')";
        $query = mysql_query($sql);
        $idOS = mysql_insert_id();
        $_SESSION['idOS'] = $idOS;
    }
    echo $_SESSION['idOS'];
    $sql = "INSERT INTO `OrdemDeServico_TipoServico` (`idTipoServico`,`idOrdemDeServico`,`quantidade`,`valor`,`idFormaImpressao`,`idQuantidadeCores`,`idFormato`) VALUES ('{$idTipoServico}','{$idOS}','{$quantidade}','{$valor}','{$formaImpressao}','{$quantidadeCores}','{$formato}')";
    $query = mysql_query($sql);
    if($cliente != '') {
        foreach($cliente as $temp) {
            $sql = "INSERT INTO `Pessoa_OrdemDeServico` (`idOrdemDeServico`,`idPessoa`,`data`) VALUES ('{$idOS}','{$temp}','{$dataEntrada}')";
            $query = mysql_query($sql);
        }
    }
    if($tipo != 'carimbo') {
        if($cf1 != '') {
            $sql = "INSERT INTO `Cor_OrdemDeServico_TipoServico` (`idCor`,`idTipoServico`,`idOrdemDeServico`,`isFrente`) VALUES ('{$cf1}','{$idTipoServico}','{$idOS}','1')";
            $query = mysql_query($sql);
        }
        if($cf2 != '') {
            $sql = "INSERT INTO `Cor_OrdemDeServico_TipoServico` (`idCor`,`idTipoServico`,`idOrdemDeServico`,`isFrente`) VALUES ('{$cf2}','{$idTipoServico}','{$idOS}','1')";
            $query = mysql_query($sql);
        }
        if($cf3 != '') {
            $sql = "INSERT INTO `Cor_OrdemDeServico_TipoServico` (`idCor`,`idTipoServico`,`idOrdemDeServico`,`isFrente`) VALUES ('{$cf3}','{$idTipoServico}','{$idOS}','1')";
            $query = mysql_query($sql);
        }
        if($cv1 != '') {
            $sql = "INSERT INTO `Cor_OrdemDeServico_TipoServico` (`idCor`,`idTipoServico`,`idOrdemDeServico`,`isFrente`) VALUES ('{$cv1}','{$idTipoServico}','{$idOS}','1')";
            $query = mysql_query($sql);
        }
        if($cv2 != '') {
            $sql = "INSERT INTO `Cor_OrdemDeServico_TipoServico` (`idCor`,`idTipoServico`,`idOrdemDeServico`,`isFrente`) VALUES ('{$cv2}','{$idTipoServico}','{$idOS}','1')";
            $query = mysql_query($sql);
        }
        if($cv3 != '') {
            $sql = "INSERT INTO `Cor_OrdemDeServico_TipoServico` (`idCor`,`idTipoServico`,`idOrdemDeServico`,`isFrente`) VALUES ('{$cv3}','{$idTipoServico}','{$idOS}','1')";
            $query = mysql_query($sql);
        }
        if($acabamento != '') {
            foreach($acabamento as $temp) {
                $sql = "INSERT INTO `Acab_OS_TS` (`idAcab_OS_TS`,`idTipoServico`,`idOrdemDeServico`,`idAcabamento`) VALUES (NULL,'{$idTipoServico}','{$idOS}','{$temp}')";
                $query = mysql_query($sql);
            }
        }
    }

    if($tipo == 'externo') {
        foreach($fornecedor as $temp) {
            $sql = "INSERT INTO `ServicoExterno` (`idTipoServico`,`idPessoa`) VALUES ('{$idTipoServico}','{$temp}')";
            $query = mysql_query($sql);
        }
    } else if($tipo == 'nota') {
        $sql = "INSERT INTO `TipoServico` (`idTipoServico`,`nome`,`descricao`,`valor`) VALUES (NULL,'{$$nomeNota}','{$descricaoNota}','{$valorNota}');";
        $query = mysql_query($sql);
        $idTSInserido = mysql_insert_id();

        $sql = "INSERT INTO `NotaFiscal` (`idTipoServico`,`idVias`,`numeracaoInicial`,`numeracaoFinal`,`numeroTalao`,`folhasBloco`,`aidf`,`idModeloNotaFiscal`) VALUES ('{$idTSInserido}','{$vias}','{$numeracaoInicial}','{$numeracaoFinal}','{$numeroTalao}','{$folhasBloco}','{$aidf}','{$modeloNota}')";
        $query = mysql_query($sql);
    }
} else if($acao == 'listarServicos') {
    $por_pagina = 1;
    if($idOS == '-1') {
        $condicoes = '1';
    } else {
        $condicoes = "OrdemDeServico_TipoServico.idOrdemDeServico LIKE '{$idOS}'";
    }
    $sql = "SELECT COUNT(*) AS total FROM OrdemDeServico_TipoServico WHERE {$condicoes}";
    $query = mysql_query($sql);
    $total = mysql_result($query, 0, 'total');
    $paginas = (($total % $por_pagina) > 0) ? (int)($total / $por_pagina) + 1 : ($total / $por_pagina);

    if(isset($_POST['pagina'])) {
        $pagina = (int)$_POST['pagina'];
    } else {
        $pagina = 1;
    }
    $pagina = max(min($paginas, $pagina), 1);
    $offset = ($pagina - 1) * $por_pagina;

    $sql = "SELECT OrdemDeServico_TipoServico.idOrdemDeServico as idOrdemDeServico, OrdemDeServico_TipoServico.idTipoServico as idTipoServico,
            OrdemDeServico_TipoServico.quantidade as quantidade, OrdemDeServico_TipoServico.valor as valor,
            FormaImpressao.nome as formaImpressaoNome, QuantidadeCores.descricao as quantidadeCoresDescricao, 
            TipoServico.nome as tipoServico
            FROM OrdemDeServico_TipoServico
            INNER JOIN FormaImpressao ON OrdemDeServico_TipoServico.idFormaImpressao = FormaImpressao.idFormaImpressao
            INNER JOIN QuantidadeCores ON OrdemDeServico_TipoServico.idQuantidadeCores = QuantidadeCores.idQuantidadeCores
            INNER JOIN TipoServico ON OrdemDeServico_TipoServico.idTipoServico = TipoServico.idTipoServico
            WHERE {$condicoes} ORDER BY TipoServico.nome DESC LIMIT {$offset}, {$por_pagina}";
    $query = mysql_query($sql);
    // echo "<p>Resultados ".min($total, ($offset + 1))." - ".min($total, ($offset + $por_pagina))." de ".$total." resultados encontrados para '".$_POST['consulta']."'</p>";
    while ($resultado = mysql_fetch_assoc($query)) {
        echo "<div class='card'>";
            echo "<div class='card-content'>";
                echo "<span class='card-title'><b>{$resultado['tipoServico']}</b></span>";
                //echo "<p>Id: {$resultado['idTipoServico']} ({$resultado['idOrdemDeServico']})</p>";
                echo "<p>Quantidade: <b>{$resultado['quantidade']}</b></p>";
                echo "<p>Valor: <b>R$ {$resultado['valor']}</b></p>";
                echo "<p>Quantidade de Cores: <b>{$resultado['quantidadeCoresDescricao']}</b>";
                echo " - Cores: <b>";
                $tempIdTS = $resultado['idTipoServico'];
                $tempIdOS = $resultado['idOrdemDeServico'];
                $sql2 = "SELECT Cor.nome FROM Cor
                        INNER JOIN Cor_OrdemDeServico_TipoServico on Cor.idCor = Cor_OrdemDeServico_TipoServico.idCor
                        WHERE Cor_OrdemDeServico_TipoServico.idTipoServico = {$resultado['idTipoServico']} AND
                        Cor_OrdemDeServico_TipoServico.idOrdemDeServico = {$resultado['idOrdemDeServico']}
                        ORDER BY Cor.nome";
                $query2 = mysql_query($sql2);
                while($result = mysql_fetch_assoc($query2)) {
                    echo $result['nome'] . " ";
                }
                echo "</b></p>";
                echo "<p>Acabamento: ";
                $sql2 = "SELECT Acabamento.nome as nome FROM Acab_OS_TS
                        INNER JOIN Acabamento ON Acabamento.idAcabamento = Acab_OS_TS.idAcabamento
                        WHERE Acab_OS_TS.idTipoServico = {$resultado['idTipoServico']} AND
                        Acab_OS_TS.idOrdemDeServico = {$resultado['idOrdemDeServico']}";
                $query2 = mysql_query($sql2);
                while($result = mysql_fetch_assoc($query2)) {
                    echo $result['nome'] + " ";
                }
                echo "</p>";
                echo "<p>Forma de Impressão: <b>{$resultado['formaImpressaoNome']}</b></p>";
            echo "</div>";
            echo "<div class='card-action'>";
                echo "<a href='#'>Editar</a>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
    echo "<br><ul class=\"pagination\">";
        if($pagina > 1) {
            echo "<li class=\"waves-effect\"><a class=\"paginacao\" href=\"#\" pagina=\"".($pagina-1)."\"><i class=\"material-icons\">chevron_left</i></a></li>";
        }
        for($i = 1; $i < $paginas + 1; $i++) {
            $ativo = ($i == $pagina) ? TRUE : FALSE;
            echo "<li class=\"";
            if($ativo) echo "active\">";
            else echo "waves-effect\">";
            echo "<a class=\"paginacao\" href=\"#\" pagina=\"".$i."\">".$i."</a></li>";
        }
        if($pagina < $paginas) {
            echo "<li class=\"waves-effect\"><a class=\"paginacao\" href=\"#\" pagina=\"".($pagina+1)."\"><i class=\"material-icons\">chevron_right</i></a></li>";
        }
    echo "</ul>";
} else if($acao == 'adddiverso') {
    echo "<option value='' disabled selected>Selecione o tipo de serviço desejado</option>";
    $sql = "SELECT * FROM TipoServico WHERE nome NOT LIKE '%nota%' AND nome NOT LIKE '%carimbo%' AND nome NOT LIKE '%externo%' ORDER BY nome;";
    $query = mysql_query($sql);
    while($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nome']} ({$tipoServico['descricao']})</option>";
    }
} else if($acao == 'addexterno') {
    echo "<option value='' disabled selected>Selecione o tipo de serviço desejado</option>";
    $sql = "SELECT * FROM TipoServico WHERE nome NOT LIKE '%carimbo%' AND nome NOT LIKE '%nota%' ORDER BY nome;";
    $query = mysql_query($sql);
    while($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nome']} ({$tipoServico['descricao']})</option>";
    }
} else if($acao == 'addnota') {
    echo "<option value='' disabled selected>Selecione o tipo de serviço desejado</option>";
    $sql = "SELECT * FROM TipoServico WHERE nome LIKE '%nota%' ORDER BY nome;";
    $query = mysql_query($sql);
    while($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nome']} ({$tipoServico['descricao']})</option>";
    }
} else if($acao == 'addcarimbo') {
    echo "<option value='' disabled selected>Selecione o tipo de serviço desejado</option>";
    $sql = "SELECT Carimbo.* FROM Carimbo INNER JOIN TipoServico ON Carimbo.idTipoServico = TipoServico.idTipoServico WHERE TipoServico.nome LIKE '%carimbo%' ORDER BY Carimbo.nomeCarimbo;";
    $query = mysql_query($sql);
    while($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
        if($tipoServico['isAutomatico'])
        echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nomeCarimbo']} ({$tipoServico['base']} x {$tipoServico['altura']} mm)</option>";
    }
} else if($acao == 'listarFormatosOS') {
	echo "<option value='' disabled selected>Selecione o formato desejado para este serviço</option>";
    $sql = "SELECT Formato.* FROM TipoServico_Formato INNER JOIN Formato ON TipoServico_Formato.idFormato=Formato.idFormato WHERE TipoServico_Formato.idTipoServico={$idTS};";
    $query = mysql_query($sql);
    while($forms = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$forms['idFormato']}'>{$forms['formato']} ({$forms['base']} x {$forms['altura']}<i>mm</i>)</option>";
    }
} else if($acao == 'listarAcabamentosOS') {
    echo "<option value='' disabled selected>Selecione o acabamento desejado para este serviço</option>";
    $sql = "SELECT Acabamento.* FROM TipoServico_Acabamento INNER JOIN Acabamento ON TipoServico_Acabamento.idAcabamento=Acabamento.idAcabamento WHERE TipoServico_Acabamento.idTipoServico={$idTS};";
    $query = mysql_query($sql);
    while($acabs = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$acabs['idAcabamento']}'>{$acabs['nome']} ({$acabs['descricao']} - Local: {$acabs['local']})</option>";
    }
} else if($acao == 'listarPapeisOS') {
    echo "<option value='' disabled selected>Selecione o papel para este serviço</option>";
    $sql = "SELECT Papel.idMaterial as idMaterial, Papel.tipo as tipo, GramaturaPapel.gramatura as gramatura FROM Material_TipoServico INNER JOIN Material ON Material_TipoServico.idMaterial = Material.idMaterial INNER JOIN Papel ON Material.idMaterial = Papel.idMaterial INNER JOIN GramaturaPapel ON GramaturaPapel.idGramaturaPapel=Papel.idGramaturaPapel WHERE Material_TipoServico.idTipoServico={$idTS};";
    $query = mysql_query($sql);
    while($paps = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$paps['idMaterial']}'>{$paps['tipo']} {$paps['gramatura']} <i>g/m^2</i></option>";
    }
} else if($acao == 'inserirModeloNotaFiscal') {
    $sql = "INSERT INTO `ModeloNotaFiscal` (`idModeloNotaFiscal`,`modelo`,`descricao`,`valor`) VALUES (NULL,'{$modelo}','{$descricao}','{$valor}')";
    $query = mysql_query($sql);
    // }
    // atualiza o conteúdo no select
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT * FROM `ModeloNotaFiscal` ORDER BY modelo;";
    $query = mysql_query($sql);
    while($modelo = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$modelo['idModeloNotaFiscal']}'>{$modelo['modelo']} ({$modelo['descricao']})</option>";
    }
} else if($acao == 'papel1_gramatura') {
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT * FROM GramaturaPapel INNER JOIN Papel ON Papel.idGramaturaPapel = GramaturaPapel.idGramaturaPapel ORDER BY gramatura;";
    $query = mysql_query($sql);
    while($temp = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$temp['idGramaturaPapel']}'>{$temp['gramatura']}</option>";
    }
} else if($acao == 'papel1_cor') {
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT Cor.* FROM Cor INNER JOIN Cor_Material ON Cor.idCor=Cor_Material.idCor WHERE Cor_Material.idMaterial={$idMaterial} ORDER BY Cor.nome;";
    $query = mysql_query($sql);
    while($temp = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$temp['idCor']}'>{$temp['nome']}</option>";
    }
} else if($acao == 'papel2_gramatura') {
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT * FROM GramaturaPapel INNER JOIN Papel ON Papel.idGramaturaPapel = GramaturaPapel.idGramaturaPapel ORDER BY gramatura;";
    $query = mysql_query($sql);
    while($temp = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$temp['idGramaturaPapel']}'>{$temp['gramatura']}</option>";
    }
} else if($acao == 'papel2_cor') {
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT Cor.* FROM Cor INNER JOIN Cor_Material ON Cor.idCor=Cor_Material.idCor WHERE Cor_Material.idMaterial={$idMaterial} ORDER BY Cor.nome;";
    $query = mysql_query($sql);
    while($temp = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$temp['idCor']}'>{$temp['nome']}</option>";
    }
} else if($acao == 'papel3_gramatura') {
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT * FROM GramaturaPapel INNER JOIN Papel ON Papel.idGramaturaPapel = GramaturaPapel.idGramaturaPapel ORDER BY gramatura;";
    $query = mysql_query($sql);
    while($temp = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$temp['idGramaturaPapel']}'>{$temp['gramatura']}</option>";
    }
} else if($acao == 'papel3_cor') {
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT Cor.* FROM Cor INNER JOIN Cor_Material ON Cor.idCor=Cor_Material.idCor WHERE Cor_Material.idMaterial={$idMaterial} ORDER BY Cor.nome;";
    $query = mysql_query($sql);
    while($temp = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$temp['idCor']}'>{$temp['nome']}</option>";
    }
} else if($acao == 'papel4_gramatura') {
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT * FROM GramaturaPapel INNER JOIN Papel ON Papel.idGramaturaPapel = GramaturaPapel.idGramaturaPapel ORDER BY gramatura;";
    $query = mysql_query($sql);
    while($temp = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$temp['idGramaturaPapel']}'>{$temp['gramatura']}</option>";
    }
} else if($acao == 'papel4_cor') {
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT Cor.* FROM Cor INNER JOIN Cor_Material ON Cor.idCor=Cor_Material.idCor WHERE Cor_Material.idMaterial={$idMaterial} ORDER BY Cor.nome;";
    $query = mysql_query($sql);
    while($temp = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$temp['idCor']}'>{$temp['nome']}</option>";
    }
}
?>
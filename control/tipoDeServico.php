<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idTS = isset($_POST['idTS']) ? $_POST['idTS'] : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$valorUnitario = isset($_POST['valorUnitario']) ? $_POST['valorUnitario'] : '';
$valor = isset($_POST['valor']) ? $_POST['valor'] : '';
$formatos = isset($_POST['selectFormato']) ? $_POST['selectFormato'] : '';
$formato = isset($_POST['formato']) ? $_POST['formato'] : '';
$acabamentos = isset($_POST['selectAcabamento']) ? $_POST['selectAcabamento'] : '';
$local = isset($_POST['local']) ? $_POST['local'] : '';
$isAutomatico = isset($_POST['isAutomatico']) ? $_POST['isAutomatico'] : '';
$nomeCarimbo = isset($_POST['nomeCarimbo']) ? $_POST['nomeCarimbo'] : '';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$idVias = isset($_POST['idVias']) ? $_POST['idVias'] : '';
$baseCarimbo = isset($_POST['baseCarimbo']) ? $_POST['baseCarimbo'] : '';
$alturaCarimbo = isset($_POST['alturaCarimbo']) ? $_POST['alturaCarimbo'] : '';
$baseFormato = isset($_POST['baseFormato']) ? $_POST['baseFormato'] : '';
$alturaFormato = isset($_POST['alturaFormato']) ? $_POST['alturaFormato'] : '';
$nomeAcabamento = isset($_POST['nomeAcabamento']) ? $_POST['nomeAcabamento'] : '';
$descricaoAcabamento = isset($_POST['localAcabamento']) ? $_POST['descricaoAcabamento'] : '';
$valorAcabamento = isset($_POST['valorAcabamento']) ? $_POST['valorAcabamento'] : '';
$localAcabamento = isset($_POST['localAcabamento']) ? $_POST['localAcabamento'] : '';
$idOS = isset($_POST['idOS']) ? $_POST['idOS'] : '';

$papel = isset($_POST['selectPapel']) ? $_POST['selectPapel'] : '';
$valorPapel = isset($_POST['valorPapel']) ? $_POST['valorPapel'] : '';

if($acao == '') {
	header('Location: ../incluirTipoDeServico.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `TipoServico` (`idTipoServico`,`nome`,`descricao`,`valor`, `status`) VALUES (NULL,\"".$nome."\",\"".$descricao."\",\"".$valor."\", \"ativo\");";
	$query = mysql_query($sql);
	$idTSInserido = mysql_insert_id();
	if($tipo == 'carimbo') {
		$sql = "INSERT INTO `Carimbo` (`idTipoServico`,`isAutomatico`,`nomeCarimbo`,`base`,`altura`) VALUES ('{$idTSInserido}','{$isAutomatico}','{$nomeCarimbo}','{$baseCarimbo}','{$alturaCarimbo}');";
		$query = mysql_query($sql);
	}
	if($formatos != NULL) {
		foreach($formatos as $f) {
			$sql = "INSERT INTO `TipoServico_Formato` (`idFormato`,`idTipoServico`) VALUES (\"".$f."\",\"".$idTSInserido."\")";
			$query = mysql_query($sql);
		}
	}
	if($acabamentos != NULL) {
		foreach($acabamentos as $a) {
			$sql = "INSERT INTO `TipoServico_Acabamento` (`idAcabamento`,`idTipoServico`) VALUES (\"".$a."\",\"".$idTSInserido."\")";
			$query = mysql_query($sql);
		}
	}
    if($papel != NULL) {
        $sql = "INSERT INTO `Material_TipoServico` (`idTipoServico`,`idMaterial`,`valor`) VALUES ('{$idTSInserido}', '{$papel}', '{$valorPapel}')";
        $query = mysql_query($sql);
    }
	header('Location: ../incluirTipoDeServico.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirFormato') {
	// if($descricao != null || $nome != null) {
		// header('Location: ../incluirMaterial.php');
		// insere os campos no banco
		$sql = "INSERT INTO `Formato` (`idFormato`,`formato`,`valor`,`base`,`altura`) VALUES (NULL,\"".$formato."\",\"".$valorFormato."\",\"".$baseFormato."\",\"".$alturaFormato."\");";
		$query = mysql_query($sql);
	// }
	// atualiza o conteúdo no select
	echo "<option value='' disabled>Selecione os formatos que esse serviço pode ser feito</option>";
    $sql = "SELECT * FROM `Formato`;";
    $query = mysql_query($sql);
    while($forms = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='".$forms['idFormato']."' ";
        if($idTS != '') {
            $sql2 = "select * from TipoServico_Formato where idFormato=".$forms['idFormato']." and idTipoServico=".$idTS.";";
            $query2 = mysql_query($sql2);
            if( mysql_num_rows($query2) == 1) {
                echo "selected";
            }
        }
        echo ">" . $forms['formato'] . " (".$forms['base']." x ".$forms['altura']." <i>mm</i>)</option>";
    }
	// header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirAcabamento') {
	// if($descricao != null || $nome != null) {
		// header('Location: ../incluirMaterial.php');
		// insere os campos no banco
		$sql = "INSERT INTO `Acabamento` (`idAcabamento`,`nome`,`descricao`,`valor`,`local`) VALUES (NULL,\"".$nomeAcabamento."\",\"".$descricaoAcabamento."\",\"".$valorAcabamento."\",\"".$localAcabamento."\");";
		$query = mysql_query($sql);
	// }
	// atualiza o conteúdo no select
	echo "<option value='' disabled>Selecione os acabamentos disponíveis para o serviço</option>";
    $sql = "SELECT * FROM `Acabamento`;";
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
	// header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirFormaImpressao') {
	$sql = "INSERT INTO `FormaImpressao` (`idFormaImpressao`,`nome`,`descricao`,`valor`) VALUES (NULL,\"{$nome}\",\"{$descricao}\",\"{$valor}\");";
	$query = mysql_query($sql);

	echo "<option value='' disabled>Selecione as formas de impressão do serviço</option>";
    $sql = "SELECT * FROM `FormaImpressao`;";
    $query = mysql_query($sql);
    while($forms = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='".$forms['idFormaImpressao']."' ";
        if($idTS != '' && $idOS != '') {
            $sql2 = "select * from OrdemDeServico_TipoServico where idFormaImpressao=".$forms['idFormaImpressao']." and idTipoServico=".$idTS." and idOrdemDeServico={$idOS};";
            $query2 = mysql_query($sql2);
            if( mysql_num_rows($query2) == 1) {
                echo "selected";
            }
        }
        echo ">{$forms['nome']} ({$forms['descricao']})</option>";
    }
}
else if($acao == 'inserirQuantidadeCores') {
	$sql = "INSERT INTO `QuantidadeCores` (`idQuantidadeCores`,`descricao`,`valor`) VALUES (NULL,\"{$descricao}\",\"{$valor}\");";
	$query = mysql_query($sql);

	echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT * FROM `QuantidadeCores`;";
    $query = mysql_query($sql);
    while($quantidadeCores = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='".$quantidadeCores['idQuantidadeCores']."' ";
        if($idTS != '' && $idOS != '') {
            $sql2 = "select * from OrdemDeServico_TipoServico where idQuantidadeCores=".$quantidadeCores['idQuantidadeCores']." and idTipoServico=".$idTS." and idOrdemDeServico={$idOS};";
            $query2 = mysql_query($sql2);
            if( mysql_num_rows($query2) == 1) {
                echo "selected";
            }
        }
        echo ">{$quantidadeCores['descricao']}</option>";
    }
} else if($acao == 'listar') {
    $busca  = mysql_real_escape_string($_POST['consulta']);
    $opc = isset($_POST['opc']) ? $_POST['opc'] : array();
    // registros por página
    $por_pagina = 10;
    // monta a consulta sql para saber quantos registros serão encontrados
    if($busca != '') {
        if($tipo == 'carimbo') {
            $condicoes = "nomeCarimbo LIKE '%{$busca}%' OR base LIKE '%{$busca}%' OR altura '%{$busca}%'";
        } else if($tipo == 'outro') {
            $condicoes = "nome LIKE '%{$busca}' OR descricao LIKE '%{$busca}'";
        }
    } else {
        if($tipo == 'carimbo') {
            $condicoes = "1 AND nome LIKE '%carimbo%'";
        } else if($tipo == 'outro') {
            $condicoes = "1 AND nome NOT LIKE '%carimbo%' AND nome NOT LIKE '%nota%'";
        }
    }
    $flag = 1;
    foreach($opc as $o) {
        if($o == 'excluido') {
            $condicoes = "{$condicoes} AND TipoServico.status LIKE 'excluido'";
            $flag = 0;
        }
    }
    if($flag) {
        $condicoes = "{$condicoes} AND TipoServico.status like 'ativo'";
    }
    echo $condicoes . "<br>";
    if($tipo == 'carimbo') {
        $sql = "SELECT COUNT(*) AS total FROM TipoServico
                INNER JOIN Carimbo ON Carimbo.idTipoServico = TipoServico.idTipoServico
                WHERE {$condicoes}";
    } else if($tipo == 'outro') {
        $sql = "SELECT COUNT(*) AS total FROM TipoServico
                WHERE {$condicoes}";
    }
    echo $sql . "<br>";
    // executa a consulta
    $query = mysql_query($sql);
    // salva o valor da coluna 'total', do primeiro registro encontrado pela consulta
    $total = mysql_result($query, 0, 'total');
    // calcula o máximo de páginas
    $paginas = (($total % $por_pagina) > 0) ? (int)($total / $por_pagina) + 1 : ($total / $por_pagina);

    if(isset($_POST['pagina'])) {
        $pagina = (int)$_POST['pagina'];
    } else {
        $pagina = 1;
    }
    $pagina = max(min($paginas, $pagina), 1);
    $offset = ($pagina - 1) * $por_pagina;

    // monta outra consulta, agora que fará a busca com paginação
    if($tipo == 'carimbo') {
        $sql = "SELECT TipoServico.*, Carimbo.*
                FROM TipoServico
                INNER JOIN Carimbo ON Carimbo.idTipoServico = TipoServico.idTipoServico
                WHERE {$condicoes} ORDER BY nomeCarimbo DESC LIMIT {$offset}, {$por_pagina}";
        $query = mysql_query($sql);
    } else if($tipo == 'outro') {
        $sql = "SELECT TipoServico.*
                FROM TipoServico
                WHERE {$condicoes}
                ORDER BY nome DESC LIMIT {$offset}, {$por_pagina}";
        $query = mysql_query($sql);
    }
    echo $sql . "<br>";
    // executa a query acima
    
    if($busca == '') {
        echo "<div class='row'><div class='col s12'><p>Mostrando todos os registros salvos</p></div></div>";
    } else {
        echo "<div class='row'><div class='col s12'><p>Resultados ".min($total, ($offset + 1))." - ".min($total, ($offset + $por_pagina))." de ".$total." resultados encontrados para '".$_POST['consulta']."'</p></div></div>";
    }
    echo "<div class='row'>";
    while ($resultado = mysql_fetch_assoc($query)) {
        $tempId = $resultado['idTipoServico'];
        echo "<div class='col s12'>";
            echo "<div class='card'>";
                echo "<div class='card-content'>";
                    if($tipo == 'carimbo') {
                        echo "<span class='card-title'>{$resultado['nomeCarimbo']}</span>";
                        echo "<p>Tamanho: <b>{$resultado['base']}</b> x <b>{$resultado['base']}</b> <i>mm</i> - Valor: </b>R$ {$resultado['valor']}</b></p>";
                    } else {
                        echo "<span class='card-title'>{$resultado['nome']}</span>";
                        echo "<p>{$resultado['descricao']}</p>";
                        echo "<p>Valor: <b>R$ {$resultado['valor']}</b></p>";
                        $sql2 = "SELECT * FROM Formato
                                INNER JOIN TipoServico_Formato ON Formato.idFormato LIKE TipoServico_Formato.idFormato
                                WHERE TipoServico_Formato.idTipoServico LIKE {$tempId}";
                        $query2 = mysql_query($sql2);
                        echo "<p>Formatos: ";
                        while($temp = mysql_fetch_assoc($query2)) {
                            echo "<b>{$temp['formato']} ({$temp['base']} x {$temp['altura']})</b><br>";
                        }

                        $sql2 = "SELECT * FROM Acabamento
                                INNER JOIN TipoServico_Acabamento ON Acabamento.idAcabamento LIKE TipoServico_Acabamento.idAcabamento
                                WHERE TipoServico_Acabamento.idTipoServico LIKE {$tempId}";
                        $query2 = mysql_query($sql2);
                        echo "<p>Acabamentos: ";
                        while($temp = mysql_fetch_assoc($query2)) {
                            echo "<b>{$temp['nome']} ({$temp['descricao']} - Local: {$temp['local']})</b><br>";
                        }
                        $sql2 = "SELECT Papel.tipo, GramaturaPapel.gramatura
                                FROM Material_TipoServico
                                INNER JOIN Material ON Material_TipoServico.idMaterial LIKE Material.idMaterial
                                INNER JOIN Papel ON Material.idMaterial LIKE Papel.idMaterial
                                INNER JOIN GramaturaPapel ON Papel.idGramaturaPapel LIKE GramaturaPapel.idGramaturaPapel
                                WHERE Material_TipoServico.idTipoServico LIKE {$tempId}";
                        $query2 = mysql_query($sql2);
                        echo "<p>Papéis: ";
                        while($temp = mysql_fetch_assoc($query2)) {
                            echo "<b>{$temp['tipo']} {$temp['gramatura']} g/m^2</b><br>";
                        }
                        echo "</p>";
                    }
                echo "</div>";
                echo "<div class='card-action'>";
                    echo "<a id='editar' href='incluirTipoDeServico.php?idTS={$tempId}&tipo={$tipo}'><i class='material-icons'>description</i>Editar</a>";
                    // echo "<a id='remover' href='' idMaterial={$tempId} tipo={$tipo}><i class='material-icons'>delete</i>Excluir</a>";
                    // echo "<a id='orcamento' href='orcamento.php?idMaterial={$tempId}&tipo={$tipo}'><i class='material-icons'>shopping_cart</i>Orçamento</a>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
    echo "</div>";
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
} else if($acao == 'atualizar') {
    $sql = "UPDATE `TipoServico`
            SET `nome`='{$nome}', `descricao`='{$descricao}',`valor`='{$valorUnitario}'
            WHERE `idTipoServico`='{$idTS}'";
    echo $sql . "<br>";
    $query = mysql_query($sql);
    if($tipo == 'carimbo') {
        $sql = "UPDATE Carimbo
                SET nomeCarimbo='{$nomeCarimbo}', isAutomatico = '{$isAutomatico}',
                base='{$baseCarimbo}', altura='{$alturaCarimbo}'
                WHERE idTipoServico='{$idTS}'";
        $query = mysql_query($sql);
        echo $sql . "<br>";
    } else {
        $sql = "DELETE FROM Material_TipoServico WHERE idTipoServico='{$idTS}'";
        $query = mysql_query($sql);
        echo $sql . "<br>";
        $sql = "INSERT INTO `Material_TipoServico` (`idTipoServico`, `idMaterial`, `valor`) VALUES ('{$idTS}', '{$papel}','{$valorPapel}')";
        $query = mysql_query($sql);
        echo $sql . "<br>";
    }
    if($formatos != NULL) {
        $sql = "DELETE FROM TipoServico_Formato WHERE idTipoServico LIKE '{$idTS}'";
        $query = mysql_query($sql);
        echo $sql . "<br>";
        foreach($formatos as $temp) {
            $sql2 = "INSERT INTO `TipoServico_Formato` (`idTipoServico`,`idFormato`) VALUES ('{$idTS}','{$temp}')";
            $query2 = mysql_query($sql2);
            echo $sql2 . "<br>";
        }
    }
    if($acabamentos != NULL) {
        $sql = "DELETE FROM TipoServico_Acabamento WHERE idTipoServico LIKE '{$idTS}'";
        $query = mysql_query($sql);
        echo $sql . "<br>";
        foreach($acabamentos as $temp) {
            $sql2 = "INSERT INTO `TipoServico_Acabamento` (`idTipoServico`,`idAcabamento`) VALUES ('{$idTS}','{$temp}')";
            $query2 = mysql_query($sql2);
            echo $sql2 . "<br>";
        }
    }
    header('Location: ../incluirTipoDeServico.php?idTS='.$idTS.'&tipo='.$tipo.'&at=ok');
} else if($acao == 'excluir') {
    if($idTS == null) {
        header('Location: ../listarTipoDeServico.php?at=no&tipo='.$tipo);
    }
    $sql = "UPDATE TipoServico SET status='excluido' WHERE idTipoServico LIKE '{$idTS}'";
    $query = mysql_query($sql);
    echo $sql;
}
?>
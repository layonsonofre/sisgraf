<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idArquivo = isset($_POST['idArquivo']) ? $_POST['idArquivo'] : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$data = isset($_POST['data']) ? $_POST['data'] : '';
$idOrdemDeServico = isset($_POST['selectOrdemDeServico']) ? $_POST['selectOrdemDeServico'] : '';

$idArquivoMatrizAntigo = isset($_POST['idArquivoModeloAntigo']) ? $_POST['idArquivoModeloAntigo'] : array();
$idChapaAntiga = isset($_POST['idChapaAntiga']) ? $_POST['idChapaAntiga'] : array();
$urlMatrizAntiga = isset($_POST['urlMatrizAntiga']) ? $_POST['urlMatrizAntiga'] : array();
$utilizacoesAntiga = isset($_POST['utilizacoesAntiga']) ? $_POST['utilizacoesAntiga'] : array();

$idChapaNovo = isset($_POST['idChapaNovo']) ? $_POST['idChapaNovo'] : array();
$urlMatrizNovo = isset($_POST['urlMatrizNovo']) ? $_POST['urlMatrizNovo'] : array();
$utilizacoesNovo = isset($_POST['utilizacoesNovo']) ? $_POST['utilizacoesNovo'] : array();


$idArquivoModeloAntigo = isset($_POST['idArquivoModeloAntigo']) ? $_POST['idArquivoModeloAntigo'] : array();
$urlModeloAntigo = isset($_POST['urlModeloAntigo']) ? $_POST['urlModeloAntigo'] : array();
$statusAntigo = isset($_POST['statusAntigo']) ? $_POST['statusAntigo'] : array();

$urlModeloNovo = isset($_POST['urlModeloNovo']) ? $_POST['urlModeloNovo'] : array();
$statusNovo = isset($_POST['statusNovo']) ? $_POST['statusNovo'] : array();

//remover
$idArquivoMatriz = isset($_POST['idArquivoMatriz']) ? $_POST['idArquivoMatriz'] : '';
$idArquivoModelo = isset($_POST['idArquivoModelo']) ? $_POST['idArquivoModelo'] : '';


if($acao == '') {
	header('Location: ../incluirArquivo.php?at=no');
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `Arquivo` (`idArquivo`,`nome`,`data`,`idOrdemDeServico`)
			VALUES (NULL,'{$nome}','{$data}','{$idOrdemDeServico}')";
	$query = mysql_query($sql);
	$idArquivoInserido = mysql_insert_id();
	echo $sql . "<br><br>";

	if($urlModeloNovo) {
		$i = 0;
		for($i = 0; $i < count($urlModeloNovo); $i++) {
			$sql = "INSERT INTO ArquivoModelo (`idArquivoModelo`, `url`, `idArquivo`, `status`)
					VALUES (NULL, '{$urlModeloNovo[$i]}', '{$idArquivoInserido}', '{$statusNovo[$i]}')";
			$query = mysql_query($sql);
			echo $sql . "<br><br>";
		}
	}
	if($urlMatrizNovo) {
		$i = 0;
		for($i = 0; $i < count($urlMatrizNovo); $i++) {
			$sql = "INSERT INTO ArquivoMatriz (`idArquivoMatriz`, `url`, `utilizacoes`, `idChapa`)
					VALUES (NULL, '{$urlMatrizNovo[$i]}', '{$utilizacoesNovo[$i]}', '{$idChapaNovo[$i]}')";
			$query = mysql_query($sql);
			echo $sql . "<br><br>";
			$idArquivoMatrizInserido = mysql_insert_id();
			$sql = "INSERT INTO Arquivo_ArquivoMatriz (`idArquivo`, `idArquivoMatriz`)
					VALUES ('{$idArquivoInserido}', '{$idArquivoMatrizInserido}')";
			$query = mysql_query($sql);
			echo $sql . "<br><br>";
		}
	}
	header('Location: ../incluirArquivo.php?at=ok');
} else if($acao == 'atualizar') {
	$sql = "UPDATE Arquivo SET nome='{$nome}', idOrdemDeServico='{$idOrdemDeServico}' WHERE idArquivo = {$idArquivo}";
	$query = mysql_query($sql);

	if($idArquivoMatrizAntigo) {
		for($i = 0; $i < count($idArquivoMatrizAntigo); $i++) {
			if($urlMatrizAntiga[$i] == '' || $utilizacoesAntiga[$i] == '' || $idChapaAntiga == '') continue;
			$sql = "UPDATE ArquivoMatriz SET url='{$urlMatrizAntiga[$i]}', utilizacoes='{$utilizacoesAntiga[$i]}',
					idChapa='{$idChapaAntiga[$i]}' WHERE idArquivoMatriz={$idArquivoMatrizAntigo[$i]}";
			$query = mysql_query($sql);
		}
	}
	if($urlMatrizNovo) {
		for($i = 0; $i < count($urlMatrizNovo); $i++) {
			if($urlMatrizNovo[$i] == '' || $utilizacoesNovo[$i] == '' || $idChapaNovo == '') continue;
			$sql = "INSERT INTO ArquivoMatriz (`idArquivoMatriz`, `url`, `utilizacoes`, `idChapa`)
					VALUES (NULL, '{$urlMatrizNovo[$i]}', '{$utilizacoesNovo[$i]}', '{$idChapaNovo[$i]}')";
			$query = mysql_query($sql);
			$idArquivoMatrizInserido = mysql_insert_id();
			$sql = "INSERT INTO Arquivo_ArquivoMatriz (`idArquivo`, `idArquivoMatriz`)
					VALUES ('{$idArquivo}', '{$idArquivoMatrizInserido}')";
			$query = mysql_query($sql);
		}
	}

	if($idArquivoModeloAntigo) {
		for($i = 0; $i < count($idArquivoModeloAntigo); $i++) {
			if($urlModeloAntigo[$i] == '' || $statusAntigo[$i] == '') continue;
			$sql = "UPDATE ArquivoModelo SET url='{$urlModeloAntigo[$i]}', status='{$statusAntigo[$i]}'
					WHERE idArquivoModelo={$idArquivoModeloAntigo[$i]}";
			$query = mysql_query($sql);
		}
	}
	if($urlModeloNovo) {
		$i = 0;
		for($i = 0; $i < count($urlModeloNovo); $i++) {
			if($urlModeloNovo[$i] == '' || $statusNovo[$i] == '') continue;
			$sql = "INSERT INTO ArquivoModelo (`idArquivoModelo`, `url`, `idArquivo`, `status`)
					VALUES (NULL, '{$urlModeloNovo[$i]}', '{$idArquivo}', '{$statusNovo[$i]}')";
			$query = mysql_query($sql);
			echo $sql . "<br><br>";
		}
	}
	header('Location: ../incluirArquivo.php?at=ok&idArquivo='.$idArquivo);
} else if($acao == 'excluirModelo'){
	$sql = "DELETE FROM ArquivoModelo WHERE idArquivo={$idArquivo} AND idArquivoModelo={$idArquivoModelo}";
	$query = mysql_query($sql);
	echo $sql;
	echo $query;
} else if($acao == 'excluirMatriz') {
	$sql = "DELETE FROM Arquivo_ArquivoMatriz WHERE idArquivo={$idArquivo} AND idArquivoMatriz={$idArquivoMatriz}";
	$query = mysql_query($sql);
	echo $sql;
	$sql = "DELETE FROM ArquivoMatriz WHERE idArquivoMatriz={$idArquivoMatriz}";
	$query = mysql_query($sql);
	echo $sql;
} else if($acao == 'excluir') {
	if($idArquivo == null) {
	   header('Location: ../incluirArquivo.php?at=no');
	}
	$sql = "DELETE Arquivo_ArquivoMatriz, ArquivoMatriz FROM Arquivo_ArquivoMatriz
            INNER JOIN ArquivoMatriz ON ArquivoMatriz.idArquivoMatriz = Arquivo_ArquivoMatriz.idArquivoMatriz
            WHERE Arquivo_ArquivoMatriz.idArquivo = {$idArquivo}";
    $query = mysql_query($sql);
    echo $sql;
    echo $query;
	$sql = "DELETE FROM ArquivoModelo WHERE idArquivo={$idArquivo}";
    $query = mysql_query($sql);
    echo $sql;
    echo $query;
    $sql = "DELETE FROM Arquivo WHERE idArquivo={$idArquivo}";
	$query = mysql_query($sql);
    echo $sql;
    echo $query;
    header('Location: ../incluirArquivo.php?at=ok');
} else if($acao == 'listar') {
	$busca  = mysql_real_escape_string($_POST['consulta']);
    $opc = isset($_POST['opc']) ? $_POST['opc'] : array();
    $por_pagina = 10;
    if($busca != '') {
        $condicoes = "nome LIKE '%{$busca}%' OR ArquivoModelo.url LIKE '%{$busca}%'
        			OR ArquivoMatriz.url LIKE '%{$busca}%' OR idChapa LIKE '{$busca}'";
    } else {
    	$condicoes = "1";
    }
    foreach($opc as $o) {
        if($o == 'aprovado') {
            $condicoes = "{$condicoes} AND status LIKE 'aprovado'";
        }
    }
    $sql = "SELECT COUNT(*) AS total FROM Arquivo
            LEFT JOIN ArquivoModelo ON Arquivo.idArquivo = ArquivoModelo.idArquivo
            LEFT JOIN Arquivo_ArquivoMatriz ON Arquivo.idArquivo = Arquivo_ArquivoMatriz.idArquivo
            LEFT JOIN ArquivoMatriz ON Arquivo_ArquivoMatriz.idArquivoMatriz = ArquivoMatriz.idArquivoMatriz
            WHERE {$condicoes}";
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
    $sql = "SELECT *, Arquivo.idArquivo as idArquivo
    		FROM Arquivo
            LEFT JOIN ArquivoModelo ON Arquivo.idArquivo = ArquivoModelo.idArquivo
            LEFT JOIN Arquivo_ArquivoMatriz ON Arquivo.idArquivo = Arquivo_ArquivoMatriz.idArquivo
            LEFT JOIN ArquivoMatriz ON Arquivo_ArquivoMatriz.idArquivoMatriz = ArquivoMatriz.idArquivoMatriz
            WHERE {$condicoes} ORDER BY Arquivo.idArquivo DESC LIMIT {$offset}, {$por_pagina}";
    $query = mysql_query($sql);
    // executa a query acima
    
    if($busca == '') {
        echo "<div class='row'><div class='col s12'><p>Mostrando todos os registros salvos</p></div></div>";
    } else {
        echo "<div class='row'><div class='col s12'><p>Resultados ".min($total, ($offset + 1))." - ".min($total, ($offset + $por_pagina))." de ".$total." resultados encontrados para '".$_POST['consulta']."'</p></div></div>";
    }
    echo "<div class='row'>";
    while ($resultado = mysql_fetch_assoc($query)) {
        $tempId = $resultado['idArquivo'];
        echo "<div class='col s12'>";
            echo "<div class='card'>";
                echo "<div class='card-content'>";
                        echo "<span class='card-title'>{$resultado['nome']}</span>";
                        echo "<p>Data de Criação: <b>{$resultado['data']}</b></p>";
                        $sql2 = "SELECT * FROM ArquivoModelo WHERE idArquivo={$tempId}";
                        $query2 = mysql_query($sql2);
                        echo "<p>Modelos: <br>";
                        while($temp = mysql_fetch_assoc($query2)) {
                        	echo "<b>{$temp['url']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            echo "Status: <b>" . strtoupper($temp['status']) ."</b><br>";
                        }
                        echo "</p><br>";

                        $sql2 = "SELECT * FROM ArquivoMatriz
                        INNER JOIN Arquivo_ArquivoMatriz ON ArquivoMatriz.idArquivoMatriz = Arquivo_ArquivoMatriz.idArquivoMatriz
                        WHERE Arquivo_ArquivoMatriz.idArquivo={$tempId}";
                        $query2 = mysql_query($sql2);
                        echo "<p>Matriz: <br>";
                        while($temp = mysql_fetch_assoc($query2)) {
                        	echo "Chapa: <b>{$temp['idChapa']}</b> (Local: <b>{$temp['url']}</b>)</b><br>";
                        }
                        echo "</p><br>";

                        $sql2 = "SELECT OrdemDeServico.dataEntrada as data, OrdemDeServico.idOrdemDeServico as id,
                        OrdemDeServico_TipoServico.quantidade as qtde, TipoServico.nome as servico
                        FROM OrdemDeServico
                        INNER JOIN OrdemDeServico_TipoServico ON OrdemDeServico.idOrdemDeServico = OrdemDeServico_TipoServico.idOrdemDeServico
                        INNER JOIN TipoServico ON OrdemDeServico_TipoServico.idTipoServico = TipoServico.idTipoServico
                        INNER JOIN Arquivo ON Arquivo.idOrdemDeServico = OrdemDeServico.idOrdemDeServico
                        WHERE Arquivo.idOrdemDeServico = {$tempId}";
                        $query2 = mysql_query($sql2);
                        echo "<p>Ordem de Serviço: <br>";
                        while($temp = mysql_fetch_assoc($query2)) {
                            echo "Data: <b>{$temp['data']}</b> - Tipo: <b>{$temp['servico']}</b> - Quantidade: <b>{$temp['qtde']}</b> - Valor: <b>R$ {$temp['valor']}</b><br>";
                        }
                        echo "</p>";
                echo "</div>";
                echo "<div class='card-action'>";
                    echo "<a id='editar' href='incluirArquivo.php?idArquivo={$tempId}'><i class='material-icons'>description</i>Editar</a>";
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
}

?>
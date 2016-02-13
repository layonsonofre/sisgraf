<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idMaterial = isset($_POST['idMaterial']) ? $_POST['idMaterial'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$valorUnitario = isset($_POST['valorUnitario']) ? $_POST['valorUnitario'] : '';
$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
$quantidadeMinima = isset($_POST['quantidadeMinima']) ? $_POST['quantidadeMinima'] : '';
$unidade = isset($_POST['selectUnidade']) ? $_POST['selectUnidade'] : '';
$tipoPapel = isset($_POST['tipoPapel']) ? $_POST['tipoPapel'] : '';
$base = isset($_POST['base']) ? $_POST['base'] : '';
$altura = isset($_POST['altura']) ? $_POST['altura'] : '';
$gramatura = isset($_POST['selectGramatura']) ? $_POST['selectGramatura'] : '';
$cor = isset($_POST['selectCor']) ? $_POST['selectCor'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$categoria = isset($_POST['selectCategoria']) ? $_POST['selectCategoria'] : '';

$idCategoria = isset($_POST['idCategoria']) ? $_POST['idCategoria'] : '';
$nomeCategoria = isset($_POST['nomeCategoria']) ? $_POST['nomeCategoria'] : '';
$descricaoCategoria = isset($_POST['descricaoCategoria']) ? $_POST['descricaoCategoria'] : '';

$idCor = isset($_POST['idCor']) ? $_POST['idCor'] : '';
$nomeCor = isset($_POST['cor']) ? $_POST['cor'] : '';

$idMaterialUnidade = isset($_POST['idUnidade']) ? $_POST['idUnidade'] : '';
$descricaoUnidade = isset($_POST['descricaoUnidade']) ? $_POST['descricaoUnidade'] : '';

$idGramatura = isset($_POST['idGramatura']) ? $_POST['idGramatura'] : '';
$gramatura2 = isset($_POST['gramatura']) ? $_POST['gramatura'] : '';

function listarCategoria() {
	// atualiza o conteúdo no select
	echo "<option value='' disabled>Selecione as categorias que o material pertence</option>";
    $sql = "select * from Categoria;";
    $query = mysql_query($sql);
    global $idMaterial;
    while($categorias = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='".$categorias['idCategoria']."' ";
        if($idMaterial != NULL) {
            $sql2 = "select * from Categoria_Material where idCategoria=".$categorias['idCategoria']." and idMaterial=".$idMaterial.";";
            $query2 = mysql_query($sql2);
            if( mysql_num_rows($query2) == 1) {
                echo "selected";
            }
        }
        echo ">".$categorias['nome']." (" .$categorias['descricao'].")</option>";
    }
}

function listarCor() {
	// atualiza os campos no select
    $sql = "SELECT * FROM Cor ORDER BY nome";
    $query = mysql_query($sql);
    echo "<option value='' disabled>Selecione as cores do material</option>";
    while($cores = mysql_fetch_assoc($query)) {
        echo "<option value='{$cores['idCor']}'>{$cores['nome']}</option>";
    }
}
function listarUnidade() {
	// atualiza o conteúdo no select
	$sql = "select * from MaterialUnidade;";
    $query = mysql_query($sql);
    echo "<option value='' disabled>Selecione</option>";
    while($materialUnidade = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='" . $materialUnidade['idMaterialUnidade'] . "'>" . $materialUnidade['descricao'] . "</option>";
    }
}

function listarGramatura() {
	$sql = "SELECT * FROM `GramaturaPapel`;";
    $query = mysql_query($sql);
    echo "<option value='' disabled>Selecione</option>";
    while($gramatura = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='" . $gramatura['idGramaturaPapel'] . "'>" . $gramatura['gramatura'] . " <i>(g/m<sup>2</sup>)</i></option>";
    }
}

if($acao == '') {
	header('Location: ../incluirMaterial.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `Material` " .
	"(`idMaterial`,`descricao`,`valorUnitario`,`quantidade`,`quantidadeMinima`,`idMaterialUnidade`)".
	"VALUES (NULL,\"".$descricao."\",\"".$valorUnitario."\",\"".$quantidade."\",\"".$quantidadeMinima."\",\"".$unidade."\")";
	$query = mysql_query($sql);
	$idMaterialInserido = mysql_insert_id();
	if($tipo == "papel") {
		$sql = "INSERT INTO `Papel` (`idMaterial`,`tipo`,`idGramaturaPapel`,`base`,`altura`) VALUES (\"".$idMaterialInserido."\",\"".$tipoPapel."\",\"".$gramatura."\",\"".$base."\",\"".$altura."\")";
		$query = mysql_query($sql);
	}
	if($categoria != NULL) {
		foreach($categoria as $c) {
			$sql = "INSERT INTO `Categoria_Material` (`idMaterial`,`idCategoria`) VALUES (\"".$idMaterialInserido."\",\"".$c."\")";
			$query = mysql_query($sql);
		}
	}
	if($cor != NULL) {
		foreach($cor as $c) {
			$sql = "INSERT INTO `Cor_Material` (`idMaterial`,`idCor`) VALUES (\"".$idMaterialInserido."\",\"".$c."\")";
			$query = mysql_query($sql);
		}
	}
	header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'atualizar') {
	$sql = "UPDATE `Material`
			SET `descricao`='{$descricao}',`valorUnitario`='{$valorUnitario}',`quantidade`='{$quantidade}',
			`quantidadeMinima`='{$quantidadeMinima}',`idMaterialUnidade`='{$unidade}'
			WHERE `idMaterial`='{$idMaterial}'";
	$query = mysql_query($sql);
	if($tipo == 'papel') {
		$sql = "UPDATE Papel
				SET tipo='{$tipoPapel}', idGramaturaPapel='{$gramatura}', base='{$base}', altura='{$altura}'
				WHERE idMaterial='{$idMaterial}'";
		$query = mysql_query($sql);
		echo var_dump($query);
	}
	if($categoria != NULL) {
		$sql = "DELETE FROM Categoria_Material WHERE idMaterial LIKE '{$idMaterial}'";
		$query = mysql_query($sql);
		echo var_dump($query);
		foreach($categoria as $temp) {
			$sql2 = "INSERT INTO `Categoria_Material` (`idMaterial`,`idCategoria`) VALUES ('{$idMaterial}','{$temp}')";
			$query2 = mysql_query($sql2);
			echo var_dump($query);
		}
	}
	if($cor != NULL) {
		$sql = "DELETE FROM Cor_Material WHERE idMaterial LIKE '{$idMaterial}'";
		$query = mysql_query($sql);
		echo var_dump($query);
		foreach($cor as $temp) {
			$sql2 = "INSERT INTO `Cor_Material` (`idMaterial`,`idCor`) VALUES ('{$idMaterial}','{$temp}')";
			$query2 = mysql_query($sql2);
			echo var_dump($query);
		}
	}
	header('Location: ../incluirMaterial.php?idMaterial='.$idMaterial.'&tipo='.$tipo.'&at=ok');
} else if($acao == 'excluir') {
	if($idMaterial == null) {
		header('Location: ../incluirMaterial.php?at=no&tipo='.$tipo);
	}
	$sql = "DELETE Papel, Cor_Material, Material, Categoria_Material
			FROM Material
			INNER JOIN Papel ON Material.idMaterial = Papel.idMaterial
			INNER JOIN Cor_Material ON Material.idMaterial = Cor_Material.idMaterial
			INNER JOIN Categoria_Material ON Material.idMaterial = Categoria_Material.idMaterial
			WHERE Material.idMaterial LIKE {$idMaterial}";
	$query = mysql_query($sql);
	if($query) {
		header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
	} else {
		header('Location: ../incluirMaterial.php?idMaterial={$idMaterial}&at=no&tipo='.$tipo);
	}
} else if($acao == 'inserirCor') {
	if($idCor == '') {
		$sql = "INSERT INTO `Cor` (`idCor`,`nome`) VALUES (NULL,'{$nomeCor}')";
		$query = mysql_query($sql);
	} else {
		$sql = "UPDATE Cor SET nome='{$nomeCor}' WHERE idCor={$idCor}";
		$query = mysql_query($sql);
	}
	listarCor();
} else if($acao == 'excluirCor') {
    if($idCategoria != '') {
        $sql = "DELETE FROM Cor WHERE idCor='{$idCor}'";
        $query = mysql_query($sql);
    }
    listarCor();
} else if($acao == 'verCores') {
    $sql = "SELECT * FROM Cor ORDER BY nome ASC";
    $query = mysql_query($sql);
    echo "<table class='responsive-table highlight'>";
        echo "<thead><tr>";
            echo "<th data-field='nome'>Cor</th>";
            echo "<th>Editar</th>";
            echo "<th>Excluir</th>";
        echo "</tr></thead>";
        echo "<tbody>";
    while($temp = mysql_fetch_assoc($query)) {
        echo "<tr>";
            echo "<td>{$temp['nome']}</td>";
            echo "<td><a href='#' class='editarCor waves-effect waves-light' idCor='{$temp['idCor']}'><i class='material-icons right'>settings</i></a></td>";
            echo "<td><a href='#' class='excluirCor waves-effect waves-light' idCor='{$temp['idCor']}'><i class='material-icons right'>delete</i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else if($acao == 'getCor') {
	$sql = "SELECT * FROM Cor WHERE idCor = {$idCor}";
    $query = mysql_query($sql);
    $return = array();
    if($temp = mysql_fetch_assoc($query)) {
        $return["idCor"] = $temp['idCor'];
        $return["nome"] = $temp['nome'];
    }
    echo json_encode($return);
} else if($acao == 'inserirGramatura') {
	if($idGramatura == '') {
		$sql = "INSERT INTO `GramaturaPapel` (`idGramaturaPapel`,`gramatura`) VALUES (NULL,'{$gramatura2}')";
	} else {
		$sql = "UPDATE GramaturaPapel SET gramatura='{$gramatura2}' WHERE idGramaturaPapel={$idGramatura}";
	}
	$query = mysql_query($sql);
	listarGramatura();

} else if($acao == 'excluirGramatura') {
    if($idGramatura != '') {
        $sql = "DELETE FROM GramaturaPapel WHERE idGramaturaPapel='{$idGramatura}'";
        $query = mysql_query($sql);
    }
    listarGramatura();
} else if($acao == 'verGramaturas') {
    $sql = "SELECT * FROM GramaturaPapel ORDER BY gramatura ASC";
    $query = mysql_query($sql);
    echo "<table class='responsive-table highlight'>";
        echo "<thead><tr>";
            echo "<th data-field='gramatura'>Gramatura</th>";
            echo "<th>Editar</th>";
            echo "<th>Excluir</th>";
        echo "</tr></thead>";
        echo "<tbody>";
    while($temp = mysql_fetch_assoc($query)) {
        echo "<tr>";
            echo "<td>{$temp['gramatura']}</td>";
            echo "<td><a href='#' class='editarGramatura waves-effect waves-light' idGramatura='{$temp['idGramaturaPapel']}'><i class='material-icons right'>settings</i></a></td>";
            echo "<td><a href='#' class='excluirGramatura waves-effect waves-light' idGramatura='{$temp['idGramaturaPapel']}'><i class='material-icons right'>delete</i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else if($acao == 'getGramatura') {
	$sql = "SELECT * FROM GramaturaPapel WHERE idGramaturaPapel = {$idGramatura}";
    $query = mysql_query($sql);
    $return = array();
    if($temp = mysql_fetch_assoc($query)) {
        $return["idGramatura"] = $temp['idGramaturaPapel'];
        $return["gramatura"] = $temp['gramatura'];
    }
    echo json_encode($return);
} else if($acao == 'inserirUnidadeDeMedida') {
	if($idMaterialUnidade == '') {
		$sql = "INSERT INTO `MaterialUnidade` (`idMaterialUnidade`,`descricao`) VALUES (NULL,'{$descricaoUnidade}')";
	} else {
		$sql = "UPDATE MaterialUnidade SET descricao='{$descricaoUnidade}' WHERE idMaterialUnidade={$idMaterialUnidade}";
	}
	$query = mysql_query($sql);
	listarUnidade();
} else if($acao == 'excluirUnidade') {
    if($idMaterialUnidade != '') {
        $sql = "DELETE FROM MaterialUnidade WHERE idMaterialUnidade='{$idMaterialUnidade}'";
        $query = mysql_query($sql);
    }
    listarUnidade();
} else if($acao == 'verUnidades') {
    $sql = "SELECT * FROM MaterialUnidade ORDER BY descricao ASC";
    $query = mysql_query($sql);
    echo "<table class='responsive-table highlight'>";
        echo "<thead><tr>";
            echo "<th data-field='descricao'>Descrição</th>";
            echo "<th>Editar</th>";
            echo "<th>Excluir</th>";
        echo "</tr></thead>";
        echo "<tbody>";
    while($temp = mysql_fetch_assoc($query)) {
        echo "<tr>";
            echo "<td>{$temp['descricao']}</td>";
            echo "<td><a href='#' class='editarUnidade waves-effect waves-light' idUnidade='{$temp['idMaterialUnidade']}'><i class='material-icons right'>settings</i></a></td>";
            echo "<td><a href='#' class='excluirUnidade waves-effect waves-light' idUnidade='{$temp['idMaterialUnidade']}'><i class='material-icons right'>delete</i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else if($acao == 'getUnidade') {
	$sql = "SELECT * FROM MaterialUnidade WHERE idMaterialUnidade = {$idMaterialUnidade}";
    $query = mysql_query($sql);
    $return = array();
    if($temp = mysql_fetch_assoc($query)) {
        $return["idUnidade"] = $temp['idMaterialUnidade'];
        $return["descricao"] = $temp['descricao'];
    }
    echo json_encode($return);
} else if($acao == 'inserirCategoria') {
	if($idCategoria == '') {
		$sql = "INSERT INTO Categoria (`idCategoria`,`nome`,`descricao`) VALUES
				(NULL,'{$nomeCategoria}','{$descricaoCategoria}')";
		$query = mysql_query($sql);
	} else {
		$sql = "UPDATE Categoria SET nome='{$nomeCategoria}', descricao='{$descricaoCategoria}'
				WHERE idCategoria='{$idCategoria}'";
		$query = mysql_query($sql);
	}
	listarCategoria();
} else if($acao == 'excluirCategoria') {
    if($idCategoria != '') {
        $sql = "DELETE FROM Categoria WHERE idCategoria='{$idCategoria}'";
        $query = mysql_query($sql);
    }
    listarCategoria();
} else if($acao == 'verCategorias') {
    $sql = "SELECT * FROM Categoria ORDER BY nome ASC";
    $query = mysql_query($sql);
    echo "<table class='responsive-table highlight'>";
        echo "<thead><tr>";
            echo "<th data-field='nome'>Nome</th>";
            echo "<th data-field='descricao'>Descricao</th>";
            echo "<th>Editar</th>";
            echo "<th>Excluir</th>";
        echo "</tr></thead>";
        echo "<tbody>";
    while($temp = mysql_fetch_assoc($query)) {
        echo "<tr>";
            echo "<td>{$temp['nome']}</td>";
            echo "<td>{$temp['descricao']}</td>";
            echo "<td><a href='#' class='editarCategoria waves-effect waves-light' idCategoria='{$temp['idCategoria']}'><i class='material-icons right'>settings</i></a></td>";
            echo "<td><a href='#' class='excluirCategoria waves-effect waves-light' idCategoria='{$temp['idCategoria']}'><i class='material-icons right'>delete</i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else if($acao == 'getCategoria') {
	$sql = "SELECT * FROM Categoria WHERE idCategoria = {$idCategoria}";
    $query = mysql_query($sql);
    $return = array();
    if($temp = mysql_fetch_assoc($query)) {
        $return["idCategoria"] = $temp['idCategoria'];
        $return["nome"] = $temp['nome'];
        $return["descricao"] = $temp['descricao'];
    }
    echo json_encode($return);
} else if($acao == 'listar') {
	$busca  = mysql_real_escape_string($_POST['consulta']);
	$opc = isset($_POST['opc']) ? $_POST['opc'] : array();
	// registros por página
	$por_pagina = 10;
	// monta a consulta sql para saber quantos registros serão encontrados
	if($busca != '') {
		if($tipo == 'papel') {
			$condicoes = "`tipo` LIKE '%{$busca}%' OR `gramatura` LIKE '%{$busca}%'";
		} else if($tipo == 'material') {
			$condicoes = "Categoria.nome LIKE '%{$busca}' OR Categoria.descricao LIKE '%{$busca}' OR Material.descricao LIKE '%{$busca}'";
		}
	} else {
		$condicoes = "1";
	}
	foreach($opc as $o) {
		if($o == 'emFalta') {
			$condicoes = "{$condicoes} AND Material.quantidade < Material.quantidadeMinima";
		}
	}
	if($tipo == 'papel') {
		$sql = "SELECT COUNT(*) AS total FROM Material
				INNER JOIN MaterialUnidade ON Material.idMaterialUnidade = MaterialUnidade.idMaterialUnidade
				INNER JOIN Papel ON Material.idMaterial = Papel.idMaterial
				INNER JOIN GramaturaPapel ON Papel.idGramaturaPapel = GramaturaPapel.idGramaturaPapel
				WHERE {$condicoes}";
	} else if($tipo == 'material') {
		$sql = "SELECT COUNT(*) AS total FROM Material
				INNER JOIN MaterialUnidade ON Material.idMaterialUnidade = MaterialUnidade.idMaterialUnidade
				INNER JOIN Categoria_Material ON Material.idMaterial = Categoria_Material.idMaterial
				INNER JOIN Categoria ON Categoria_Material.idCategoria = Categoria.idCategoria
				WHERE {$condicoes}";
	}
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
	if($tipo == 'papel') {
		$sql = "SELECT Material.idMaterial as idMaterial, Material.descricao as descricao, Material.quantidade as quantidade,
				Material.quantidadeMinima as quantidadeMinima, Papel.tipo as tipo, Papel.base as base, Papel.altura as altura,
				GramaturaPapel.gramatura as gramatura, MaterialUnidade.descricao as unidade
				FROM Material
				INNER JOIN Papel ON Material.idMaterial = Papel.idMaterial
				INNER JOIN GramaturaPapel ON Papel.idGramaturaPapel = GramaturaPapel.idGramaturaPapel
				INNER JOIN MaterialUnidade ON Material.idMaterialUnidade = MaterialUnidade.idMaterialUnidade
			  	WHERE {$condicoes} ORDER BY Papel.tipo DESC LIMIT {$offset}, {$por_pagina}";
		$query = mysql_query($sql);
	} else if($tipo == 'material') {
		$sql = "SELECT Material.idMaterial as idMaterial, Material.descricao as descricao, Material.quantidade as quantidade,
				Material.quantidadeMinima as quantidadeMinima, MaterialUnidade.descricao as unidade
				FROM Material
				INNER JOIN MaterialUnidade ON Material.idMaterialUnidade = MaterialUnidade.idMaterialUnidade
			  	WHERE {$condicoes} AND Material.descricao NOT LIKE '%papel%'
			  	ORDER BY Material.descricao DESC LIMIT {$offset}, {$por_pagina}";
		$query = mysql_query($sql);
	}
	// executa a query acima
	
	if($busca == '') {
		echo "<div class='row'><div class='col s12'><p>Mostrando todos os registros salvos</p></div></div>";
	} else {
		echo "<div class='row'><div class='col s12'><p>Resultados ".min($total, ($offset + 1))." - ".min($total, ($offset + $por_pagina))." de ".$total." resultados encontrados para '".$_POST['consulta']."'</p></div></div>";
	}
	// echo "<h5><i class='material-icons'>search</i>&nbsp;&nbsp;&nbsp;Resultados da busca por: '{$_POST['consulta']}'</h5>";
	//echo "<ul id='pag'>";
	// while ($resultado = mysql_fetch_assoc($query)) {
	// 	echo "<li>";
	// 	echo $resultado['descricao'] . " - ";
	// 	echo $resultado['quantidade'] . " - ";
	// 	echo $resultado['tipo'] . " - ";
	// 	echo $resultado['gramatura'];
	// 	echo "</li>";
	// }
	//echo "</ul>";
	echo "<div class='row'>";
	while ($resultado = mysql_fetch_assoc($query)) {
		echo "<div class='col s12'>";
			echo "<div class='card'>";
		 		echo "<div class='card-content'>";
		 			if($tipo == 'papel') {
		 				echo "<span class='card-title'>{$resultado['tipo']}</span>";
		 			} else {
		 				echo "<span class='card-title'>{$resultado['descricao']}</span>";
		 			}
		 			echo "<p>Estoque: <b>{$resultado['quantidade']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		 			echo "Estoque Mínimo: <b>{$resultado['quantidadeMinima']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		 			echo "Unidade de Medida: <b>{$resultado['unidade']}</b></p>";
		 			if($tipo == 'papel') {
		 				echo "<p>Gramatura: <b>{$resultado['gramatura']}</b> g/m^2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		 				echo "Tamanho: <b>{$resultado['base']} x {$resultado['altura']}</b> mm</p>";
		 			}
		 			$tempId = $resultado['idMaterial'];
		 			$sql2 = "SELECT Cor.nome as cor FROM Cor
		 					INNER JOIN Cor_Material on Cor.idCor = Cor_Material.idCor
		 					INNER JOIN Material on Material.idMaterial = Cor_Material.idMaterial
		 					WHERE Material.idMaterial = {$tempId}
		 					ORDER BY Cor.nome";
					$query2 = mysql_query($sql2);
					echo "<p>Cor: ";
					while($result = mysql_fetch_assoc($query2)) {
						echo "<b>{$result['cor']}</b> ";
					}
					echo "</p>";
	 				$categorias = [];
	 				$sql2 = "SELECT Categoria.nome as nome, Categoria.descricao as descricao, Categoria.idCategoria as idCategoria
	 						FROM Categoria
		 					INNER JOIN Categoria_Material ON Categoria.idCategoria = Categoria_Material.idCategoria
		 					WHERE Categoria_Material.idMaterial = {$tempId}
		 					ORDER BY Categoria.nome";
					$query2 = mysql_query($sql2);
					echo "<p>Categoria: ";
					while($result = mysql_fetch_assoc($query2)) {
						echo "<b>{$result['nome']}</b>&nbsp;&nbsp;&nbsp;";
						$categorias[] = $result['idCategoria'];
					}
					echo "</b></p>";
					foreach($categorias as $c) {
			 			$sql2 = "SELECT * FROM Pessoa
			 			INNER JOIN Fornecedor_Categoria ON Pessoa.idPessoa = Fornecedor_Categoria.idPessoa
			 			WHERE Fornecedor_Categoria.idCategoria LIKE {$c} AND
			 			Pessoa.status NOT LIKE '%Inativo'
			 			ORDER BY nome, nomeFantasia";
						$query2 = mysql_query($sql2);
						echo "<p>Fornecedores: <br>";
						while($pessoa = mysql_fetch_assoc($query2)) {
							if ($pessoa['isPessoaFisica'] == 'FALSE') {
	                            echo "<b>{$pessoa['nomeFantasia']}</b> <!-- ({$pessoa['nomeRua']}, {$pessoa['numero']} - {$pessoa['cidade']})-->";
	                        } else {
	                            echo "<b>{$pessoa['nome']}</b><!-- ({$pessoa['nomeRua']}, {$pessoa['numero']} - {$pessoa['cidade']})-->";
	                        }
	                        echo "&nbsp;&nbsp;&nbsp;";
	                        $sql3 = "SELECT * FROM Telefone WHERE Telefone.idPessoa LIKE '{$pessoa['idPessoa']}'";
	                        $query3 = mysql_query($sql3);
	                        while($temp = mysql_fetch_assoc($query3)) {
	                        	echo "{$temp['numero']}&nbsp;&nbsp;&nbsp;";
	                        }
	                        $sql3 = "SELECT * FROM Email WHERE Email.idPessoa LIKE '{$pessoa['idPessoa']}'";
	                        $query3 = mysql_query($sql3);
	                        while($temp = mysql_fetch_assoc($query3)) {
	                        	echo "<a href='mailto:{$temp['endereco']}'>{$temp['endereco']}</a>&nbsp;&nbsp;&nbsp;";
	                        }
	                        echo "<br>";
						}
						echo "</p>";
					}
		 		echo "</div>";
		 		echo "<div class='card-action'>";
		 			echo "<a id='editar' href='incluirMaterial.php?idMaterial={$tempId}&tipo={$tipo}'><i class='material-icons'>description</i>Editar</a>";
		 			// echo "<a id='remover' href='' idMaterial={$tempId} tipo={$tipo}><i class='material-icons'>delete</i>Excluir</a>";
		 			// echo "<a id='orcamento' href='orcamento.php?idMaterial={$tempId}&tipo={$tipo}'><i class='material-icons'>shopping_cart</i>Orçamento</a>";
		 		echo "</div>";
		 	echo "</div>";
	 	echo "</div>";
	}
	echo "</div>";

	// echo "<table class='highlight responsive-table'>";
	// echo "<thead>";
	// 	echo "<tr>";
	// 		echo "<th data-field='idMaterial' hidden>ID</th>";
	// 		echo "<th data-field='descricao'>Descrição</th>";
	// 		echo "<th data-field='tipo'>Tipo</th>";
	// 		echo "<th data-field='quantidade'>Quantidade</th>";
	// 	echo "</tr>";
	// echo "</thead>";
	// echo "<tbody>";
	// while ($resultado = mysql_fetch_assoc($query)) {
	// 	echo "<tr>";
	// 		echo "<td hidden>{$resultado['idMaterial']}</td>";
	// 		echo "<td>{$resultado['descricao']}</td>";
	// 		echo "<td>{$resultado['tipo']}</td>";
	// 		echo "<td>{$resultado['quantidade']}</td>";
	// 	echo "</tr>";
	// }
	// echo "</tbody>";
	// echo "</table>";

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
    // echo "<br>Mostrando dos registros ".min($total, ($offset + 1))." ao ".min($total, ($offset + $por_pagina))." do total de ".$total." resultados encontrados para a consulta especificada.";
}
?>
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
$rg = isset($_POST['altura']) ? $_POST['altura'] : '';
$gramatura = isset($_POST['selectGramatura']) ? $_POST['selectGramatura'] : '';
$cor = isset($_POST['selectCor']) ? $_POST['selectCor'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$categoria = isset($_POST['selectCategoria']) ? $_POST['selectCategoria'] : '';

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
} else if($acao == 'excluir') {
	if($idPessoa == null) {
		header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
	}
	$sql = "delete * from Papel where idMaterial=".$idMaterial.";" .
	"delete * from Cor_Material where idMaterial=".$idMaterial.";" .
	"delete * from Material where idMaterial=".$idMaterial.";" .
	"delete * from Fornecedor_Categoria where idPessoa=".$idPessoa.";";
	$query = mysql_query($sql);
} else if($acao == 'inserirCor') {
	if($cor != null) {
		// header('Location: ../incluirMaterial.php');
		// insere os campos no banco
		$sql = "INSERT INTO `Cor` (`idCor`,`nome`) VALUES (NULL,\"".$cor."\");";
		$query = mysql_query($sql);
	}
	// atualiza os campos no select
    $sql = "SELECT * FROM `Cor`;";
    $query = mysql_query($sql);
    echo "<option value='' disabled>Selecione as cores do material</option>";
    while($cores = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='" . $cores['idCor'] . "'>" . $cores['nome'] . "</option>";
    }
	//header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirGramatura') {
	if($gramatura != null) {
		// header('Location: ../incluirMaterial.php');
		// insere os campos no banco
		$sql = "INSERT INTO `GramaturaPapel` (`idGramaturaPapel`,`gramatura`) VALUES (NULL,\"".$gramatura."\");";
		$query = mysql_query($sql);
	}
	// atualiza o conteúdo no select
	$sql = "SELECT * FROM `GramaturaPapel`;";
    $query = mysql_query($sql);
    echo "<option value='' disabled>Selecione</option>";
    while($gramatura = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='" . $gramatura['idGramaturaPapel'] . "'>" . $gramatura['gramatura'] . " <i>(g/m<sup>2</sup>)</i></option>";
    }
	//header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirUnidadeDeMedida') {
	if($descricao != null) {
		// header('Location: ../incluirMaterial.php');
		// insere os campos no banco
		$sql = "INSERT INTO `MaterialUnidade` (`idMaterialUnidade`,`descricao`) VALUES (NULL,\"".$descricao."\");";
		$query = mysql_query($sql);
	}
	// atualiza o conteúdo no select
	$sql = "select * from MaterialUnidade;";
    $query = mysql_query($sql);
    echo "<option value='' disabled>Selecione</option>";
    while($materialUnidade = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='" . $materialUnidade['idMaterialUnidade'] . "'>" . $materialUnidade['descricao'] . "</option>";
    }
	//header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirCategoria') {
	if($descricao != null || $nome != null) {
		// header('Location: ../incluirMaterial.php');
		// insere os campos no banco
		$sql = "INSERT INTO `Categoria` (`idCategoria`,`nome`,`descricao`) VALUES (NULL,\"".$nome."\",\"".$descricao."\");";
		$query = mysql_query($sql);
	}
	// atualiza o conteúdo no select
	echo "<option value='' disabled>Selecione as categorias que o material pertence</option>";
    $sql = "select * from Categoria;";
    $query = mysql_query($sql);
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
	// header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'listar') {
	$busca  = mysql_real_escape_string($_POST['consulta']);
	// registros por página
	$por_pagina = 10;
	// monta a consulta sql para saber quantos registros serão encontrados
	if($tipo == 'papel') {
		$condicoes = "((`tipo` LIKE '%{$busca}') OR (`gramatura` LIKE '%{$busca}')) AND (Material.idMaterial = Papel.idMaterial AND MaterialUnidade.idMaterialUnidade = Material.idMaterialUnidade AND Papel.idGramaturaPapel = GramaturaPapel.idGramaturaPapel)";
		$sql = "SELECT COUNT(*) AS total FROM `Material`, `MaterialUnidade`, `Papel`, `GramaturaPapel` WHERE {$condicoes}";
	} else if($tipo == 'material') {
		$condicoes = "((Categoria.nome LIKE '%{$busca}') OR (Categoria.descricao LIKE '%{$busca}') OR (Material.descricao LIKE '%{$busca}')) AND (MaterialUnidade.idMaterialUnidade = Material.idMaterialUnidade AND Categoria.idCategoria = Categoria_Material.idCategoria AND Categoria_Material.idMaterial = Material.idMaterial)";
		$sql = "SELECT COUNT(*) AS total FROM `Material`, `MaterialUnidade`, `Categoria`, `Categoria_Material` WHERE {$condicoes}";
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
		// $sql = "SELECT Material.idMaterial as idMaterial, Material.descricao as descricao, Material.quantidade as quantidade, Papel.tipo as tipo, GramaturaPapel.gramatura as gramatura FROM `Material`, `MaterialUnidade`, `Papel`, `GramaturaPapel` WHERE {$condicoes} ORDER BY Papel.tipo DESC LIMIT {$offset}, {$por_pagina}";
		// $sql = "SELECT * FROM `Material`, `MaterialUnidade`, `Papel`, `GramaturaPapel` WHERE {$condicoes} ORDER BY Papel.tipo DESC LIMIT {$offset}, {$por_pagina}";
		$sql = "SELECT Material.idMaterial as idMaterial, Material.descricao as descricao, Material.quantidade as quantidade, Material.quantidadeMinima as quantidadeMinima, Papel.tipo as tipo, Papel.base as base, Papel.altura as altura,
				GramaturaPapel.gramatura as gramatura, MaterialUnidade.descricao as unidade
				FROM Material
				INNER JOIN Papel ON Material.idMaterial = Papel.idMaterial
				INNER JOIN GramaturaPapel ON Papel.idGramaturaPapel = GramaturaPapel.idGramaturaPapel
				INNER JOIN MaterialUnidade ON Material.idMaterialUnidade = MaterialUnidade.idMaterialUnidade
			  	WHERE {$condicoes} ORDER BY Papel.tipo DESC LIMIT {$offset}, {$por_pagina}";
		$query = mysql_query($sql);
	} else if($tipo == 'material') {
		$sql = "SELECT Material.idMaterial as idMaterial, Material.descricao as descricao, Material.quantidade as quantidade, MaterialUnidade.descricao as unidade FROM `Material`, `MaterialUnidade`, `Categoria`, `Categoria_material` WHERE {$condicoes} ORDER BY Material.descricao DESC LIMIT {$offset}, {$por_pagina}";
		$query = mysql_query($sql);
	}
	// executa a query acima
	

	echo "<p>Resultados ".min($total, ($offset + 1))." - ".min($total, ($offset + $por_pagina))." de ".$total." resultados encontrados para '".$_POST['consulta']."'</p>";
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

	while ($resultado = mysql_fetch_assoc($query)) {
		echo "<div class='card'>";
	 		echo "<div class='card-content'>";
	 			echo "<span class='card-title'>{$resultado['descricao']}</span>";
 				echo "<p>Id: {$resultado['idMaterial']}</p>";
	 			echo "<p>Quantidade Atual: {$resultado['quantidade']} - Quantidade Mínima: {$resultado['quantidadeMinima']} - Unidade de Medida: {$resultado['unidade']}</p>";
	 			echo "<p>{$resultado['tipo']} - Gramatura: {$resultado['gramatura']} g/cm^2 - Tamanho: {$resultado['base']} x {$resultado['altura']} mm</p>";

	 			$tempId = $resultado['idMaterial'];
	 			$sql2 = "SELECT Cor.nome FROM Cor
	 					INNER JOIN Cor_Material on Cor.idCor = Cor_Material.idCor
	 					INNER JOIN Material on Material.idMaterial = Cor_Material.idMaterial
	 					WHERE Material.idMaterial = {$tempId}
	 					ORDER BY Cor.nome";
				$query2 = mysql_query($sql2);
				echo "<p>" . print_r($query2) . "</p>";
	 		echo "</div>";
	 		echo "<div class='card-action'>";
	 			echo "<a href='#'>Editar</a>";
	 			echo "</div>";
	 		echo "</div>";
	 	echo "</div>";
	}

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
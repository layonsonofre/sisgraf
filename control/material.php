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
		$sql = "INSERT INTO `Papel` (`idMaterial`,`tipo`,`idGramaturaPapel`,`base`,`altura`) VALUES (\"".$idMaterialInserido."\",\"".$tipo."\",\"".$gramatura."\",\"".$base."\",\"".$altura."\")";
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
}
?>
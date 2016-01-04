<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idMaterial = isset($_POST['idMaterial']) ? $_POST['idMaterial'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$valorUnitario = isset($_POST['valorUnitario']) ? $_POST['valorUnitario'] : '';
$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
$quantidadeMinima = isset($_POST['quantidadeMinima']) ? $_POST['quantidadeMinima'] : '';
$unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
$tipoPapel = isset($_POST['tipoPapel']) ? $_POST['tipoPapel'] : '';
$base = isset($_POST['base']) ? $_POST['base'] : '';
$rg = isset($_POST['altura']) ? $_POST['altura'] : '';
$gramatura = isset($_POST['gramatura']) ? $_POST['gramatura'] : '';
$cor = isset($_POST['cor']) ? $_POST['cor'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';

if($acao == '') {
	header('Location: ../incluirMaterial.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `Material` " .
	"(`idMaterial`,`descricao`,`valorUnitario`,`quantidade`,`quantidadeMinima`,`idMaterialUnidade`)".
	"VALUES (NULL,\"".$descricao."\",\"".$valorUnitario."\",\"".$quantidade."\",\"".$quantidadeMinima."\",\"".$idMaterialUnidade."\")";
	$query = mysql_query($sql);
	$idMaterialInserido = mysql_insert_id();
	if($tipo == "papel") {
		$sql = "INSERT INTO `Papel` (`idMaterial`,`tipo`,`idGramaturaPapel`,`base`,`altura`) VALUES (\"".$idMaterialInserido."\",\"".$tipo."\",\"".$gramatura."\",\"".$base."\",\"".$altura."\")";
		$query = mysql_query($sql);
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
	if($cor == null) {
		header('Location: ../incluirMaterial.php');
	}
	$sql = "INSERT INTO `Cor` (`idCor`,`nome`) VALUES (NULL,\"".$cor."\");";
	$query = mysql_query($sql);
	header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirGramatura') {
	if($gramatura == null) {
		header('Location: ../incluirMaterial.php');
	}
	$sql = "INSERT INTO `GramaturaPapel` (`idGramaturaPapel`,`gramatura`) VALUES (NULL,\"".$gramatura."\");";
	$query = mysql_query($sql);
	header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirUnidadeDeMedida') {
	if($descricao == null) {
		header('Location: ../incluirMaterial.php');
	}
	$sql = "INSERT INTO `MaterialUnidade` (`idMaterialUnidade`,`descricao`) VALUES (NULL,\"".$descricao."\");";
	$query = mysql_query($sql);
	header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirCategoria') {
	if($descricao == null || $nome == null) {
		header('Location: ../incluirMaterial.php');
	}
	$sql = "INSERT INTO `Categoria` (`idCategoria`,`nome`,`descricao`) VALUES (NULL,\"".$nome."\",\"".$descricao."\");";
	$query = mysql_query($sql);
	header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
}
?>
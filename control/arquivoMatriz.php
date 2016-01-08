<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idArquivo = isset($_POST['idArquivoMatriz']) ? $_POST['idArquivoMatriz'] : '';
$modelos = isset($_POST['nome']) ? $_POST['nome'] : '';
$idChapa = isset($_POST['data']) ? $_POST['data'] : '';
$utilizacoes = isset($_POST['idOrdemDeServico']) ? $_POST['idOrdemDeServico'] : '';

if($acao == '') {
	header('Location: ../incluirArquivoMatriz.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `ArquivoMatriz` " .
	"(`idArquivoMatriz`,`url`,`utilizacoes`,`idChapa`)".
	"VALUES (NULL,\"".$url."\",\"".$utilizacoes."\",\"".$idChapa."\")";
	$query = mysql_query($sql);
	$idArquivoMatrizInserido = mysql_insert_id();

	header('Location: ../incluirArquivoMatriz.php?at=ok&tipo='.$tipo);
} else if($acao == 'excluir') {
	if($idArquivoMatriz == null) {
		header('Location: ../incluirArquivoMatriz.php?at=ok&tipo='.$tipo);
	}
	$sql = "delete * from ArquivoMatriz where idArquivoMatriz=".$idArquivoMatriz.";";
	$query = mysql_query($sql);
	
}
?>
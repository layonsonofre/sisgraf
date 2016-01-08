<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idArquivoModelo = isset($_POST['idArquivoModelo']) ? $_POST['idArquivoModelo'] : '';
$modelos = isset($_POST['url']) ? $_POST['url'] : '';
$utilizacoes = isset($_POST['idArquivo']) ? $_POST['idArquivo'] : '';

if($acao == '') {
	header('Location: ../incluirArquivoModelo.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `ArquivoModelo` " .
	"(`idArquivoModelo`,`url`,`idArquivo`)".
	"VALUES (NULL,\"".$url."\",\"".$idArquivo."\")";
	$query = mysql_query($sql);
	$idArquivoInserido = mysql_insert_id();
	
	header('Location: ../incluirArquivoModelo.php?at=ok&tipo='.$tipo);
} else if($acao == 'excluir') {
	if($idArquivoModelo == null) {
		header('Location: ../incluirArquivoModelo.php?at=ok&tipo='.$tipo);
	}
	$sql = "delete * from ArquivoModelo where idArquivoModelo=".$idArquivoModelo.";";
	$query = mysql_query($sql);
	
}
?>
<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idArquivo = isset($_POST['idArquivo']) ? $_POST['idArquivo'] : '';
$modelos = isset($_POST['nome']) ? $_POST['nome'] : '';
$idChapa = isset($_POST['data']) ? $_POST['data'] : '';
$utilizacoes = isset($_POST['idOrdemDeServico']) ? $_POST['idOrdemDeServico'] : '';

if($acao == '') {
	header('Location: ../incluirArquivo.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `Arquivo` " .
	"(`idArquivo`,`nome`,`data`,`idOrdemDeServico`)".
	"VALUES (NULL,\"".$nome."\",\"".$data."\",\"".$idOrdemDeServico."\")";
	$query = mysql_query($sql);
	$idArquivoInserido = mysql_insert_id();
	if($ArquivoMatriz != NULL) {
		foreach($ArquivoMatriz as $am) {
			$sql = "INSERT INTO `Arquivo_ArquivoMatriz` (`idArquivo`,`idArquivoMatriz`) VALUES (\"".$idArquivoInserido."\",\"".$am."\")";
			$query = mysql_query($sql);
		}
	}
	header('Location: ../incluirArquivo.php?at=ok&tipo='.$tipo);
} else if($acao == 'excluir') {
	if($idArquivo == null) {
		header('Location: ../incluirArquivo.php?at=ok&tipo='.$tipo);
	}
	$sql = "delete * from Arquivo where idArquivo=".$idArquivo.";"
	"delete * from Arquivo_ArquivoMatriz where idArquivo=".$idArquivo.";";
	$query = mysql_query($sql);
	
}
?>
<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idArquivo = isset($_POST['idArquivo']) ? $_POST['idArquivo'] : '';
$idArquivoMatriz = isset($_POST['idArquivoMatriz']) ? $_POST['idArquivoMatriz'] : '';
$idArquivoModelo = isset($_POST['idArquivoModelo']) ? $_POST['idArquivoModelo'] : '';
$modelos = isset($_POST['nome']) ? $_POST['nome'] : '';
$idChapa = isset($_POST['data']) ? $_POST['data'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$utilizacoes = isset($_POST['idArquivo']) ? $_POST['idArquivo'] : '';
$utilizacoes = isset($_POST['idOrdemDeServico']) ? $_POST['idOrdemDeServico'] : '';

if($acao == '') {
	header('Location: ../incluirArquivo.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `Arquivo` " .
	"(`idArquivo`,`nome`,`data`,`idOrdemDeServico`)".
	"VALUES (NULL,\"".$nome."\",\"".$data."\",\"".$idOrdemDeServico."\")";
	$query = mysql_query($sql);
	$idArquivoInserido = mysql_insert_id();

	$sql = "INSERT INTO `ArquivoModelo` " .
	"(`idArquivoModelo`,`url`,`idArquivo`)".
	"VALUES (NULL,\"".$url."\",\"".$idArquivo."\")";
	$query = mysql_query($sql);
	$idArquivoModeloInserido = mysql_insert_id();
	
	header('Location: ../incluirArquivo.php?at=ok&tipo='.$tipo);
	
}else if($acao == 'inserirmatriz'){
	$sql = "INSERT INTO `ArquivoMatriz` " .
	"(`idArquivoMatriz`,`url`,`utilizacoes`,`idChapa`)".
	"VALUES (NULL,\"".$url."\",\"".$utilizacoes."\",\"".$idChapa."\")";
	$query = mysql_query($sql);
	$idArquivoMatrizInserido = mysql_insert_id();
	
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
	"delete * from Arquivo_ArquivoMatriz where idArquivo=".$idArquivo.";"
	"delete * from ArquivoModelo where idArquivo=".$idArquivo.";";
	$query = mysql_query($sql);
}

?>
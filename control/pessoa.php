<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idPessoa = isset($_POST['idPessoa']) ? $_POST['idPessoa'] : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$isPessoaFisica = isset($_POST['isPessoaFisica']) ? $_POST['isPessoaFisica'] : '';
if($isPessoaFisica != 'true') $isPessoaFisica = false;
else $isPesoaFisica = true;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
$rg = isset($_POST['rg']) ? $_POST['rg'] : '';
$cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : '';
$inscricaoEstadual = isset($_POST['inscricaoEstadual']) ? $_POST['inscricaoEstadual'] : '';
$inscricaoMunicipal = isset($_POST['inscricaoMunicipal']) ? $_POST['inscricaoMunicipal'] : '';
$razaoSocial = isset($_POST['razaoSocial']) ? $_POST['razaoSocial'] : '';
$nomeFantasia = isset($_POST['nomeFantasia']) ? $_POST['nomeFantasia'] : '';
$nomeRua = isset($_POST['nomeRua']) ? $_POST['nomeRua'] : '';
$numero = isset($_POST['numero']) ? $_POST['numero'] : '';
$complemento = isset($_POST['complemento']) ? $_POST['complemento'] : '';
$cep = isset($_POST['cep']) ? $_POST['cep'] : '';
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
$orgaoExpedidor = isset($_POST['orgaoExpedidor']) ? $_POST['orgaoExpedidor'] : '';

$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
$senha = md5($senha);
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$tipoFuncionario = "padrao";

$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$idTelefone = isset($_POST['idTelefone']) ? $_POST['idTelefone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$idEmail = isset($_POST['idEmail']) ? $_POST['idEmail'] : '';

$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';

$tipo = $_POST['tipo'];

if($acao == '') {
	header('Location: ../incluirPessoa.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `Pessoa` " .
	"(`idPessoa`,`nome`,`status`,`isPessoaFisica`,`cpf`,`rg`,`cnpj`,".
	"`inscricaoEstadual`,`inscricaoMunicipal`,`razaoSocial`,`nomeFantasia`,".
	"`nomeRua`,`numero`,`complemento`,`cep`,`bairro`,`estado`,`cidade`,`orgaoExpedidor`)".
	"VALUES (NULL,\"".$nome."\",\"".$status."\",\"".$isPessoaFisica."\",\"".$cpf."\",\"".$rg."\",\"".$cnpj."\",".
		"\"".$inscricaoEstadual."\",\"".$inscricaoMunicipal."\",\"".$razaoSocial."\",\"".$nomeFantasia."\",".
		"\"".$nomeRua."\",\"".$numero."\",\"".$complemento."\",\"".$cep."\",\"".$bairro."\",\"".$estado."\",\"".$cidade."\",\"".$orgaoExpedidor."\")";
	$query = mysql_query($sql);
	$idPessoaInserida = mysql_insert_id();
	if($tipo == "funcionario") {
		$sql = "INSERT INTO `Funcionario` (`idPessoa`,`usuario`,`senha`,`tipoFuncionario`) VALUES (\"".$idPessoaInserida."\",\"".$usuario."\",\"".$senha."\",\"".$tipoFuncionario."\")";
		$query = mysql_query($sql);
	} else if($tipo == "fornecedor") {
		if($categoria != NULL) {
			foreach($categoria as $c) {
				$sql = "INSERT INTO `Fornecedor_Categoria` (`idPessoa`,`idCategoria`) VALUES (\"".$idPessoaInserida."\",\"".$c."\")";
				$query = mysql_query($sql);
			}
		}
	}
	foreach($telefone as $t) {
		$sql = "INSERT INTO `Telefone` (`idTelefone`,`idPessoa`,`numero`) VALUES (NULL,\"".$idPessoaInserida."\",\"".$t."\");";
		$query = mysql_query($sql);
	}
	foreach($email as $e) {
		$sql = "INSERT INTO `Email` (`idEmail`,`idPessoa`,`endereco`) VALUES (NULL,\"".$idPessoaInserida."\",\"".$e."\");";
		$query = mysql_query($sql);
	}
	header('Location: ../incluirPessoa.php?at=ok&tipo='.$tipo);
} else if($acao == 'excluir') {
	if($idPessoa == null) {
		header('Location: ../listarPessoa.php?at=no&tipo='.$tipo);
	}
	$sql = "update `Pessoa` set `status`='".$_GET['tipo']."Inativo' where `idPessoa`='".$idPessoa."';";
	$query = mysql_query($sql);
	// $sql = "delete from `Fornecedor_Categoria` where `idPessoa=`".$idPessoa.";" .
	// "delete from `Telefone` where `idPessoa`=".$idPessoa.";" .
	// "delete from `Email` where `idPessoa`=".$idPessoa.";" .
	// "delete from `Funcionario` where `idPessoa`=".$idPessoa.";" .
	// "delete from `Pessoa` where `idPessoa`=".$idPessoa.";";
	// $query = mysql_query($sql);
	//header('Location: ../listarPessoa.php?at=no&tipo='.$tipo);
} else if($acao == 'atualizar') {
	if($idPessoa == null ) {
		header('Location: ../incluirPessoa.php?at=no&tipo='.$tipo);
	}
	$sql = "UPDATE `Pessoa` SET `nome`='". $nome."',`status`='".$status."',`isPessoaFisica`='".$isPessoaFisica."',`cpf`='".$cpf.
	"',`rg`='".$rg."',`cnpj`='".$cnpj."',`inscricaoEstadual`='".$inscricaoEstadual."',`inscricaoMunicipal`='".$inscricaoMunicipal.
	"',`razaoSocial`='".$razaoSocial."',`nomeFantasia`='".$nomeFantasia."',`nomeRua`='".$nomeRua."',`numero`='".$numero.
	"',`complemento`='".$complemento."',`cep`='".$cep."',`bairro`='".$bairro."',`estado`='".$estado."',`cidade`='".$cidade.
	"',`orgaoExpedidor`='".$orgaoExpedidor."' WHERE `idPessoa`='".$idPessoa."';";
	$query = mysql_query($sql);
	// atualizando telefones já existentes e inserindo novos
	for($i = 0, $size = count($idTelefone); $i < $size; $i++) {
		$sql = "UPDATE `Telefone` SET `numero`='".$telefone[$i]."' WHERE `idTelefone`='".$idTelefone[$i]."'; ";
		$query = mysql_query($sql);
	}
	for($i = count($idTelefone), $size = count($telefone); $i < $size; $i++) {
		if($telefone[$i] == NULL) continue;
		$sql = "INSERT INTO `Telefone` (`idTelefone`, `idPessoa`, `numero`) VALUES (NULL,'".$idPessoa."', '".$telefone[$i]."'); ";
		$query = mysql_query($sql);
	}

	// atualizando emails já existentes e inserindo novos
	echo var_dump($idEmail);
	echo "aloualou";
	echo var_dump($email);
	for($i = 0, $size = count($idEmail); $i < $size; $i++) {
		//$sql = "UPDATE `Email` SET `endereco`='".$email[$i]."' WHERE `idEmail`='".$idEmail[$i]."'; ";
		//$query = mysql_query($sql);
		echo $idEmail[$i] ."->".$email[$i];
	}
	for($i = count($idEmail), $size = count($email); $i < $size; $i++) {
		if($email[$i] == NULL) continue;
		//$sql = "INSERT INTO `Email` (`idEmail`, `idPessoa`, `endereco`) VALUES (NULL,'".$idPessoa."', '".$email[$i]."'); ";
		//$query = mysql_query($sql);
		echo $email[$i];
	}

	// atualizando categorias de materiais
	if($tipo == "fornecedor") {
		if($categoria != NULL) {
			foreach($categoria as $c) {
				$sql = "INSERT INTO `Fornecedor_Categoria` (`idPessoa`,`idCategoria`) VALUES (\"".$idPessoa."\",\"".$c."\")";
				$query = mysql_query($sql);
			}
		}
	}
	//header('Location: ../incluirPessoa.php?idPessoa='.$idPessoa.'&at=ok&tipo='.$tipo);
} else if($acao == 'excluirTelefone') {
	$sql = "DELETE FROM `Telefone` WHERE `idTelefone`=".$idTelefone." AND `idPessoa`=".$idPessoa.";";
	$query = mysql_query($sql);
} else if($acao == 'excluirEmail') {
	$sql = "DELETE FROM `Email` WHERE `idEmail`=".$idEmail." AND `idPessoa`=".$idPessoa.";";
	$query = mysql_query($sql);
}
?>
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

$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
$senha = md5($senha);
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$tipoFuncionario = "padrao";

$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';

$tP = $_POST['tP'];

if($acao == '') {
	header('Location: ../index.php');
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `Pessoa` " .
	"(`idPessoa`,`nome`,`status`,`isPessoaFisica`,`cpf`,`rg`,`cnpj`,".
	"`inscricaoEstadual`,`inscricaoMunicipal`,`razaoSocial`,`nomeFantasia`,".
	"`nomeRua`,`numero`,`complemento`,`cep`,`bairro`,`estado`,`cidade`)".
	"VALUES (NULL,\"".$nome."\",\"".$status."\",\"".$isPessoaFisica."\",\"".$cpf."\",\"".$rg."\",\"".$cnpj."\",".
		"\"".$inscricaoEstadual."\",\"".$inscricaoMunicipal."\",\"".$razaoSocial."\",\"".$nomeFantasia."\",".
		"\"".$nomeRua."\",\"".$numero."\",\"".$complemento."\",\"".$cep."\",\"".$bairro."\",\"".$estado."\",\"".$cidade."\")";
	$query = mysql_query($sql);
	$idPessoaInserida = mysql_insert_id();
	if($tP == "funcionario") {
		$sql = "INSERT INTO `Funcionario` (`idPessoa`,`usuario`,`senha`,`tipoFuncionario`) VALUES (\"".$idPessoaInserida."\",\"".$usuario."\",\"".$senha."\",\"".$tipoFuncionario."\")";
		$query = mysql_query($sql);
	} else if($tP == "fornecedor") {
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
	header('Location: ../index.php?aP=ok');
}
?>
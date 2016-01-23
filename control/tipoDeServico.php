<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idTS = isset($_POST['idTS']) ? $_POST['idTS'] : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$valorUnitario = isset($_POST['valorUnitario']) ? $_POST['valorUnitario'] : '';
$valor = isset($_POST['valor']) ? $_POST['valor'] : '';
$formatos = isset($_POST['selectFormato']) ? $_POST['selectFormato'] : '';
$formato = isset($_POST['formato']) ? $_POST['formato'] : '';
$acabamentos = isset($_POST['selectAcabamento']) ? $_POST['selectAcabamento'] : '';
$local = isset($_POST['local']) ? $_POST['local'] : '';
$isAutomatico = isset($_POST['isAutomatico']) ? $_POST['isAutomatico'] : '';
$nomeCarimbo = isset($_POST['nomeCarimbo']) ? $_POST['nomeCarimbo'] : '';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$idVias = isset($_POST['idVias']) ? $_POST['idVias'] : '';
$baseCarimbo = isset($_POST['baseCarimbo']) ? $_POST['baseCarimbo'] : '';
$alturaCarimbo = isset($_POST['alturaCarimbo']) ? $_POST['alturaCarimbo'] : '';
$baseFormato = isset($_POST['baseFormato']) ? $_POST['baseFormato'] : '';
$alturaFormato = isset($_POST['alturaFormato']) ? $_POST['alturaFormato'] : '';
$nomeAcabamento = isset($_POST['nomeAcabamento']) ? $_POST['nomeAcabamento'] : '';
$descricaoAcabamento = isset($_POST['localAcabamento']) ? $_POST['descricaoAcabamento'] : '';
$valorAcabamento = isset($_POST['valorAcabamento']) ? $_POST['valorAcabamento'] : '';
$localAcabamento = isset($_POST['localAcabamento']) ? $_POST['localAcabamento'] : '';
$idOS = isset($_POST['idOS']) ? $_POST['idOS'] : '';

if($acao == '') {
	header('Location: ../incluirTipoDeServico.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `TipoServico` (`idTipoServico`,`nome`,`descricao`,`valor`) VALUES (NULL,\"".$nome."\",\"".$descricao."\",\"".$valor."\");";
	$query = mysql_query($sql);
	$idTSInserido = mysql_insert_id();
	if($tipo == 'carimbo') {
		$sql = "INSERT INTO `Carimbo` (`idTipoServico`,`isAutomatico`,`nomeCarimbo`,`base`,`altura`) VALUES ('{$idTSInserido}','{$isAutomatico}','{$nomeCarimbo}','{$baseCarimbo}','{$alturaCarimbo}');";
		$query = mysql_query($sql);
	}
	if($formatos != NULL) {
		foreach($formatos as $f) {
			$sql = "INSERT INTO `TipoServico_Formato` (`idFormato`,`idTipoServico`) VALUES (\"".$f."\",\"".$idTSInserido."\")";
			$query = mysql_query($sql);
		}
	}
	if($acabamentos != NULL) {
		foreach($acabamentos as $a) {
			$sql = "INSERT INTO `TipoServico_Acabamento` (`idAcabamento`,`idTipoServico`) VALUES (\"".$a."\",\"".$idTSInserido."\")";
			$query = mysql_query($sql);
		}
	}
	header('Location: ../incluirTipoDeServico.php?at=ok&tipo='.$tipo);
} else if($acao == 'excluir') {
	if($idTS == null) {
		header('Location: ../incluirTipoDeServico.php?at=ok&tipo='.$tipo);
	}
} else if($acao == 'inserirFormato') {
	// if($descricao != null || $nome != null) {
		// header('Location: ../incluirMaterial.php');
		// insere os campos no banco
		$sql = "INSERT INTO `Formato` (`idFormato`,`formato`,`valor`,`base`,`altura`) VALUES (NULL,\"".$formato."\",\"".$valorFormato."\",\"".$baseFormato."\",\"".$alturaFormato."\");";
		$query = mysql_query($sql);
	// }
	// atualiza o conteúdo no select
	echo "<option value='' disabled>Selecione os formatos que esse serviço pode ser feito</option>";
    $sql = "SELECT * FROM `Formato`;";
    $query = mysql_query($sql);
    while($forms = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='".$forms['idFormato']."' ";
        if($idTS != '') {
            $sql2 = "select * from TipoServico_Formato where idFormato=".$forms['idFormato']." and idTipoServico=".$idTS.";";
            $query2 = mysql_query($sql2);
            if( mysql_num_rows($query2) == 1) {
                echo "selected";
            }
        }
        echo ">" . $forms['formato'] . " (".$forms['base']." x ".$forms['altura']." <i>mm</i>)</option>";
    }
	// header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirAcabamento') {
	// if($descricao != null || $nome != null) {
		// header('Location: ../incluirMaterial.php');
		// insere os campos no banco
		$sql = "INSERT INTO `Acabamento` (`idAcabamento`,`nome`,`descricao`,`valor`,`local`) VALUES (NULL,\"".$nomeAcabamento."\",\"".$descricaoAcabamento."\",\"".$valorAcabamento."\",\"".$localAcabamento."\");";
		$query = mysql_query($sql);
	// }
	// atualiza o conteúdo no select
	echo "<option value='' disabled>Selecione os acabamentos disponíveis para o serviço</option>";
    $sql = "SELECT * FROM `Acabamento`;";
    $query = mysql_query($sql);
    while($acabs = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='".$acabs['idAcabamento']."' ";
        if($idTS != '') {
            $sql2 = "select * from TipoServico_Acabamento where idAcabamento=".$acabs['idAcabamento']." and idTipoServico=".$idTS.";";
            $query2 = mysql_query($sql2);
            if( mysql_num_rows($query2) == 1) {
                echo "selected";
            }
        }
        echo ">".$acabs['nome']." (" .$acabs['descricao']." - Local: " .$acabs['local'].")</option>";
    }
	// header('Location: ../incluirMaterial.php?at=ok&tipo='.$tipo);
} else if($acao == 'inserirFormaImpressao') {
	$sql = "INSERT INTO `FormaImpressao` (`idFormaImpressao`,`nome`,`descricao`,`valor`) VALUES (NULL,\"{$nome}\",\"{$descricao}\",\"{$valor}\");";
	$query = mysql_query($sql);

	echo "<option value='' disabled>Selecione as formas de impressão do serviço</option>";
    $sql = "SELECT * FROM `FormaImpressao`;";
    $query = mysql_query($sql);
    while($forms = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='".$forms['idFormaImpressao']."' ";
        if($idTS != '' && $idOS != '') {
            $sql2 = "select * from OrdemDeServico_TipoServico where idFormaImpressao=".$forms['idFormaImpressao']." and idTipoServico=".$idTS." and idOrdemDeServico={$idOS};";
            $query2 = mysql_query($sql2);
            if( mysql_num_rows($query2) == 1) {
                echo "selected";
            }
        }
        echo ">{$forms['nome']} ({$forms['descricao']})</option>";
    }
}
else if($acao == 'inserirQuantidadeCores') {
	$sql = "INSERT INTO `QuantidadeCores` (`idQuantidadeCores`,`descricao`,`valor`) VALUES (NULL,\"{$descricao}\",\"{$valor}\");";
	$query = mysql_query($sql);

	echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT * FROM `QuantidadeCores`;";
    $query = mysql_query($sql);
    while($quantidadeCores = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='".$quantidadeCores['idQuantidadeCores']."' ";
        if($idTS != '' && $idOS != '') {
            $sql2 = "select * from OrdemDeServico_TipoServico where idQuantidadeCores=".$quantidadeCores['idQuantidadeCores']." and idTipoServico=".$idTS." and idOrdemDeServico={$idOS};";
            $query2 = mysql_query($sql2);
            if( mysql_num_rows($query2) == 1) {
                echo "selected";
            }
        }
        echo ">{$quantidadeCores['descricao']}</option>";
    }
}
?>
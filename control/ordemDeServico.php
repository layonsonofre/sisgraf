<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idOS = isset($_POST['idOS']) ? $_POST['idOS'] : '';
$idTS = isset($_POST['idTS']) ? $_POST['idTS'] : '';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$valor = isset($_POST['valor']) ? $_POST['valor'] : '';


if($acao == '') {
	header('Location: ../incluirTipoDeServico.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	$sql = "INSERT INTO `TipoServico` (`idTipoServico`,`nome`,`descricao`,`valor`) VALUES (NULL,\"".$nome."\",\"".$descricao."\",\"".$valor."\");";
	$query = mysql_query($sql);
	$idTSInserido = mysql_insert_id();
	if($tipo == 'carimbo') {
		if($isAutomatico == 'automatico') $isAutomatico = 'TRUE';
		else $isAutomatico = 'FALSE';
		$sql = "INSERT INTO `Carimbo` (`idTipoServico`,`isAutomatico`,`nomeCarimbo`,`base`,`altura`) VALUES (\"".$idTSInserido."\",\"".$isAutomatico."\",\"".$nomeCarimbo."\",\"".$baseCarimbo."\",\"".$alturaCarimbo."\");";
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
} else if($acao == 'adddiverso') {
    echo "<option value='' disabled selected>Selecione o tipo de serviço desejado</option>";
    $sql = "SELECT * FROM TipoServico WHERE nome NOT LIKE '%nota%' AND nome NOT LIKE '%carimbo%' AND nome NOT LIKE '%externo%' ORDER BY nome;";
    $query = mysql_query($sql);
    while($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nome']} ({$tipoServico['descricao']})</option>";
    }
} else if($acao == 'addexterno') {
    echo "<option value='' disabled selected>Selecione o tipo de serviço desejado</option>";
    $sql = "SELECT * FROM TipoServico WHERE nome NOT LIKE '%carimbo%' AND nome NOT LIKE '%nota%' ORDER BY nome;";
    $query = mysql_query($sql);
    while($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nome']} ({$tipoServico['descricao']})</option>";
    }
} else if($acao == 'addnota') {
    echo "<option value='' disabled selected>Selecione o tipo de serviço desejado</option>";
    $sql = "SELECT * FROM TipoServico WHERE nome LIKE '%nota%' ORDER BY nome;";
    $query = mysql_query($sql);
    while($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nome']} ({$tipoServico['descricao']})</option>";
    }
} else if($acao == 'addcarimbo') {
    echo "<option value='' disabled selected>Selecione o tipo de serviço desejado</option>";
    $sql = "SELECT Carimbo.* FROM Carimbo INNER JOIN TipoServico ON Carimbo.idTipoServico = TipoServico.idTipoServico WHERE TipoServico.nome LIKE '%carimbo%' ORDER BY Carimbo.nomeCarimbo;";
    $query = mysql_query($sql);
    while($tipoServico = mysql_fetch_array($query, MYSQL_ASSOC)) {
        if($tipoServico['isAutomatico'])
        echo "<option value='{$tipoServico['idTipoServico']}'>{$tipoServico['nomeCarimbo']} ({$tipoServico['base']} x {$tipoServico['altura']} mm)</option>";
    }
} else if($acao == 'listarFormatosOS') {
	echo "<option value='' disabled selected>Selecione o formato desejado para este serviço</option>";
    $sql = "SELECT Formato.* FROM TipoServico_Formato INNER JOIN Formato ON TipoServico_Formato.idFormato=Formato.idFormato WHERE TipoServico_Formato.idTipoServico={$idTS};";
    $query = mysql_query($sql);
    while($forms = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$forms['idFormato']}'>{$forms['formato']} ({$forms['base']} x {$forms['altura']}<i>mm</i>)</option>";
    }
} else if($acao == 'listarAcabamentosOS') {
    echo "<option value='' disabled selected>Selecione o acabamento desejado para este serviço</option>";
    $sql = "SELECT Acabamento.* FROM TipoServico_Acabamento INNER JOIN Acabamento ON TipoServico_Acabamento.idAcabamento=Acabamento.idAcabamento WHERE TipoServico_Acabamento.idTipoServico={$idTS};";
    $query = mysql_query($sql);
    while($acabs = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$acabs['idAcabamento']}'>{$acabs['nome']} ({$acabs['descricao']} - Local: {$acabs['local']})</option>";
    }
} else if($acao == 'inserirModeloNotaFiscal') {
    $sql = "INSERT INTO `ModeloNotaFiscal` (`idModeloNotaFiscal`,`modelo`,`descricao`,`valor`) VALUES (NULL,'{$modelo}','{$descricao}','{$valor}')";
    $query = mysql_query($sql);
    // }
    // atualiza o conteúdo no select
    echo "<option value='' disabled>Selecione</option>";
    $sql = "SELECT * FROM `ModeloNotaFiscal`;";
    $query = mysql_query($sql);
    while($modelo = mysql_fetch_array($query, MYSQL_ASSOC)) {
        echo "<option value='{$modelo['idModeloNotaFiscal']}'>{$modelo['modelo']}({$modelo['descricao']})</option>";
    }
}
?>
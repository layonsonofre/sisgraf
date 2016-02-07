<?php
require_once("seguranca.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$idPessoa = isset($_POST['idPessoa']) ? $_POST['idPessoa'] : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$isPessoaFisica = isset($_POST['isPessoaFisica']) ? $_POST['isPessoaFisica'] : '';
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

$telefoneAntigo = isset($_POST['telefoneAntigo']) ? $_POST['telefoneAntigo'] : '';
$idTelefoneAntigo = isset($_POST['idTelefoneAntigo']) ? $_POST['idTelefoneAntigo'] : '';
$telefoneNovo = isset($_POST['telefoneNovo']) ? $_POST['telefoneNovo'] : '';
$emailAntigo = isset($_POST['emailAntigo']) ? $_POST['emailAntigo'] : '';
$idEmailAntigo = isset($_POST['idEmailAntigo']) ? $_POST['idEmailAntigo'] : '';
$emailNovo = isset($_POST['emailNovo']) ? $_POST['emailNovo'] : '';

$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';

$tipo = $_POST['tipo'];

if($acao == '') {
	header('Location: ../incluirPessoa.php?at=no&tipo='.$tipo);
} else if($acao == 'inserir') {
	if($isPessoaFisica == '1') {
		$cnpj = NULL;
		$inscricaoEstadual = NULL;
		$inscricaoMunicipal = NULL;
		$razaoSocial = NULL;
		$nomeFantasia = NULL;
	} else {
		$cpf = NULL;
		$rg = NULL;
	}
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
	if($telefoneNovo) {
		foreach($telefoneNovo as $t) {
			if($t == '') continue;
			$sql = "INSERT INTO `Telefone` (`idTelefone`,`idPessoa`,`numero`) VALUES (NULL,\"".$idPessoaInserida."\",\"".$t."\");";
			$query = mysql_query($sql);
		}
	}
	if($emailNovo){
		foreach($emailNovo as $e) {
			if($e == '') continue;
			$sql = "INSERT INTO `Email` (`idEmail`,`idPessoa`,`endereco`) VALUES (NULL,\"".$idPessoaInserida."\",\"".$e."\");";
			$query = mysql_query($sql);
		}
	}
	header('Location: ../incluirPessoa.php?at=ok&tipo='.$tipo);
} else if($acao == 'excluir') {
	if($idPessoa == null) {
		header('Location: ../listarPessoa.php?at=no&tipo='.$tipo);
	}
	$sql = "UPDATE Pessoa SET status='{$tipo}Inativo' WHERE idPessoa='{$idPessoa}'";
	$query = mysql_query($sql);
	header('Location: ../incluirPessoa.php?at=ok&tipo='.$tipo);
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

	if($telefoneAntigo) {
		for($i = 0; $i < count($telefoneAntigo); $i++) {
			if($telefoneAntigo[$i] != '') {
				$sql = "UPDATE Telefone SET numero='{$telefoneAntigo[$i]}' WHERE idTelefone={$idTelefoneAntigo[$i]}";
				$query = mysql_query($sql);
			}
		}
	}
	if($telefoneNovo) {
		foreach($telefoneNovo as $t) {
			if($t != '') {
				$sql = "INSERT INTO Telefone (idTelefone, idPessoa, numero) VALUES (NULL, {$idPessoa}, '{$t}')";
				$query = mysql_query($sql);
			}
		}
	}
	if($emailAntigo) {
		for($i = 0; $i < count($emailAntigo); $i++) {
			if($emailAntigo[$i] != '') {
				$sql = "UPDATE Email SET endereco='{$emailAntigo[$i]}' WHERE idEmail={$idEmailAntigo[$i]}";
				$query = mysql_query($sql);
			}
		}
	}
	if($emailNovo) {
		foreach($emailNovo as $t) {
			if($t != '') {
				$sql = "INSERT INTO Email (idEmail, idPessoa, endereco) VALUES (NULL, {$idPessoa}, '{$t}')";
				$query = mysql_query($sql);
			}
		}
	}
	// atualizando categorias de materiais
	if($tipo == "fornecedor") {
		if($categoria != NULL) {
			$sql = "DELETE FROM Fornecedor_Categoria WHERE idPessoa LIKE '{$idPessoa}'";
			$query = mysql_query($sql);
			echo var_dump($query);
			foreach($categoria as $temp) {
				$sql2 = "INSERT INTO `Fornecedor_Categoria` (`idPessoa`,`idCategoria`) VALUES ('{$idPessoa}','{$temp}')";
				$query2 = mysql_query($sql2);
				echo var_dump($query);
			}
		}
	}
	header('Location: ../incluirPessoa.php?idPessoa='.$idPessoa.'&at=ok&tipo='.$tipo);
} else if($acao == 'excluirTelefone') {
	$sql = "DELETE FROM `Telefone` WHERE `idTelefone`=".$idTelefone." AND `idPessoa`=".$idPessoa.";";
	$query = mysql_query($sql);
} else if($acao == 'excluirEmail') {
	$sql = "DELETE FROM `Email` WHERE `idEmail`=".$idEmail." AND `idPessoa`=".$idPessoa.";";
	$query = mysql_query($sql);
} else if($acao == 'listar') {
	$busca  = mysql_real_escape_string($_POST['consulta']);
	$opc = isset($_POST['opc']) ? $_POST['opc'] : array();
	// registros por página
	$por_pagina = 10;
	// monta a consulta sql para saber quantos registros serão encontrados
	if($busca != '') {
		$condicoes = "Pessoa.nome LIKE '%{$busca}%' OR Pessoa.cpf LIKE '%{$busca}%' OR
					Pessoa.rg LIKE '%{$busca}%' OR Pessoa.cnpj LIKE '%{$busca}%' OR
					Pessoa.inscricaoEstadual LIKE '%{$busca}%' OR Pessoa.inscricaoMunicipal LIKE '%{$busca}%' OR
					Pessoa.razaoSocial LIKE '%{$busca}%' OR Pessoa.nomeFantasia LIKE '%{$busca}%' OR
					Pessoa.cep LIKE '%{$busca}%' OR Pessoa.cidade LIKE '%{$busca}%' OR Pessoa.estado LIKE '%{$busca}%'";
	} else {
		$condicoes = "1";
	}
	$condicoes = "{$condicoes} AND Pessoa.status LIKE '{$tipo}%'";
	$flag = 1;
	foreach($opc as $o) {
		if($o == 'isPessoaFisica') {
			$condicoes = "{$condicoes} AND Pessoa.isPessoaFisica LIKE 1";
		}
		if($o == 'isPessoaJuridica') {
			$condicoes = "{$condicoes} AND Pessoa.isPessoaFisica LIKE 0";
		}
		if($o == 'inativo') {
			$condicoes = "{$condicoes} AND Pessoa.status LIKE '%Inativo'";
			$flag = 0;
		}
	}
	if($flag) {
		$condicoes = "{$condicoes} AND Pessoa.status NOT LIKE '%Inativo'";
	}
	$sql = "SELECT COUNT(*) AS total FROM Pessoa
			WHERE {$condicoes}";
	// executa a consulta
	$query = mysql_query($sql);
	// salva o valor da coluna 'total', do primeiro registro encontrado pela consulta
	$total = mysql_result($query, 0, 'total');
	// calcula o máximo de páginas
	$paginas = (($total % $por_pagina) > 0) ? (int)($total / $por_pagina) + 1 : ($total / $por_pagina);

	if(isset($_POST['pagina'])) {
		$pagina = (int)$_POST['pagina'];
	} else {
		$pagina = 1;
	}
	$pagina = max(min($paginas, $pagina), 1);
	$offset = ($pagina - 1) * $por_pagina;

	// monta outra consulta, agora que fará a busca com paginação
	// if($tipo == 'cliente') {
		$sql = "SELECT Pessoa.* FROM Pessoa
			  	WHERE {$condicoes} ORDER BY Pessoa.nome, Pessoa.nomeFantasia DESC LIMIT {$offset}, {$por_pagina}";
		$query = mysql_query($sql);
	// }
	// executa a query acima
	
	if($busca == '') {
		echo "<div class='row'><div class='col s12'><p>Mostrando todos os registros salvos</p></div></div>";
	} else {
		echo "<div class='row'><div class='col s12'><p>Resultados ".min($total, ($offset + 1))." - ".min($total, ($offset + $por_pagina))." de ".$total." resultados encontrados para '".$_POST['consulta']."'</p></div></div>";
	}
	echo "<div class='row'>";
	while ($pessoa = mysql_fetch_assoc($query)) {
		echo "<div class='col s12'>";
			echo "<div class='card'>";
		 		echo "<div class='card-content'>";
		 			if($pessoa['isPessoaFisica'] == '1') {
		 				echo "<span class='card-title'>{$pessoa['nome']}</span>";
		 			} else {
		 				echo "<span class='card-title'>{$pessoa['nomeFantasia']} [{$pessoa['razaoSocial']}]</span>";
		 			}
		 			$tempId = $pessoa['idPessoa'];
		 			if($tipo == 'funcionario') {
		 				$sql2 = "SELECT usuario FROM Funcionario
		 						WHERE idPessoa LIKE '{$tempId}'";
		 				$query2 = mysql_query($sql2);
		 				$func = mysql_fetch_array($query2);
		 				echo "<p>Usuário: <b>{$func['usuario']}</b></p>";
		 			}
	 				echo "<p>Contato: ";
		 			$sql2 = "SELECT * FROM Telefone WHERE Telefone.idPessoa LIKE '{$pessoa['idPessoa']}'";
                    $query2 = mysql_query($sql2);
                    while($temp = mysql_fetch_assoc($query2)) {
                    	echo "<b>{$temp['numero']}</b>&nbsp;&nbsp;&nbsp;";
                    }
                    $sql2 = "SELECT * FROM Email WHERE Email.idPessoa LIKE '{$pessoa['idPessoa']}'";
                    $query2 = mysql_query($sql2);
                    while($temp = mysql_fetch_assoc($query2)) {
                    	echo "<a href='mailto:{$temp['endereco']}'><b>{$temp['endereco']}</b></a>&nbsp;&nbsp;&nbsp;";
                    }
                    echo "<p>Endereço: <b>{$pessoa['nomeRua']}, {$pessoa['numero']} - {$pessoa['complemento']} -
                		CEP {$pessoa['cep']} - {$pessoa['bairro']} - {$pessoa['cidade']} - {$pessoa['estado']}</b></p>";
            		if($pessoa['isPessoaFisica'] == '1') {
            			echo "<p>RG/RNE: <b>{$pessoa['rg']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            			echo "CPF: <b>{$pessoa['cpf']}</b></p>";
            		} else {
            			echo "<p>CNPJ: <b>{$pessoa['cnpj']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            			echo "Insc. Est.: <b>{$pessoa['inscricaoEstadual']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
            			echo "Insc. Mun.: <b>{$pessoa['inscricaoMunicipal']}</b></p>";
            		}
            		if($tipo == 'fornecedor') {
		 			 	$sql2 = "SELECT Categoria.nome as nome, Categoria.descricao as descricao, Categoria.idCategoria as idCategoria
		 			 			FROM Categoria
			 		 			INNER JOIN Fornecedor_Categoria ON Categoria.idCategoria = Fornecedor_Categoria.idCategoria
			 		 			WHERE Fornecedor_Categoria.idPessoa LIKE {$tempId}
			 		 			ORDER BY Categoria.nome";
						$query2 = mysql_query($sql2);
						echo "<p>Categoria: ";
						while($result = mysql_fetch_assoc($query2)) {
							echo "<b>{$result['nome']}</b>&nbsp;&nbsp;&nbsp;";
						}
					}
					if($tipo == 'cliente') {
						echo "<p>Últimos pedidos: <br>";
						$sql2 = "SELECT Pessoa_OrdemDeServico.data as data, OrdemDeServico.valorTotal as valor,
				                OrdemDeServico_TipoServico.quantidade, TipoServico.nome as servico
				                FROM Pessoa_OrdemDeServico
				                INNER JOIN OrdemDeServico ON Pessoa_OrdemDeServico.idOrdemDeServico LIKE OrdemDeServico.idOrdemDeServico
				                LEFT JOIN OrdemDeServico_TipoServico ON OrdemDeServico.idOrdemDeServico LIKE OrdemDeServico_TipoServico.idOrdemDeServico
				                LEFT JOIN TipoServico ON OrdemDeServico_TipoServico.idTipoServico LIKE TipoServico.idTipoServico
				                WHERE Pessoa_OrdemDeServico.idPessoa LIKE {$pessoa['idPessoa']}
				                ORDER BY data DESC LIMIT 0, 5";
						$query2 = mysql_query($sql2);
						while($temp = mysql_fetch_assoc($query2)) {
							$q = str_pad($temp['quantidade'], 4, '0', STR_PAD_LEFT);
							echo "Data: <b>{$temp['data']}</b> - Qtde: <b>{$q}</b> - ";
							echo "Serviço: <b>{$temp['servico']}</b> &nbsp;&nbsp;(R$ <b>{$temp['valor']}</b>)<br>";
						}
						echo "</p>";
					}
		 		echo "</div>";
		 		echo "<div class='card-action'>";
		 			echo "<a id='editar' href='incluirPessoa.php?idPessoa={$tempId}&tipo={$tipo}'><i class='material-icons'>description</i>Editar</a>";
		 			//echo "<a id='remover' href='' idMaterial={$tempId} tipo={$tipo}><i class='material-icons'>delete</i>Excluir</a>";
		 			//echo "<a id='orcamento' href='orcamento.php?idMaterial={$tempId}&tipo={$tipo}'><i class='material-icons'>shopping_cart</i>Orçamento</a>";
		 		echo "</div>";
		 	echo "</div>";
	 	echo "</div>";
	}
	echo "</div>";
	echo "<br><ul class=\"pagination\">";
		if($pagina > 1) {
	        echo "<li class=\"waves-effect\"><a class=\"paginacao\" href=\"#\" pagina=\"".($pagina-1)."\"><i class=\"material-icons\">chevron_left</i></a></li>";
	    }
	    for($i = 1; $i < $paginas + 1; $i++) {
	        $ativo = ($i == $pagina) ? TRUE : FALSE;
	        echo "<li class=\"";
	        if($ativo) echo "active\">";
	        else echo "waves-effect\">";
	        echo "<a class=\"paginacao\" href=\"#\" pagina=\"".$i."\">".$i."</a></li>";
	    }
	    if($pagina < $paginas) {
	        echo "<li class=\"waves-effect\"><a class=\"paginacao\" href=\"#\" pagina=\"".($pagina+1)."\"><i class=\"material-icons\">chevron_right</i></a></li>";
	    }
    echo "</ul>";
    // echo "<br>Mostrando dos registros ".min($total, ($offset + 1))." ao ".min($total, ($offset + $por_pagina))." do total de ".$total." resultados encontrados para a consulta especificada.";
}
?>
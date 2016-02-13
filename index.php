<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF</title>
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/font.css" rel="stylesheet">
        <link href="css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
		<main>
			<div class="container">
                <div class="row">
                    <div class="col s12">
                        <h3>Visão Geral</h3>
                    </div>
                </div>
                <div class="section">
                    <div class="row">
                        <div class="col s12">
                            <?php
                                $now = new \Datetime('now');
                                $month = $now->format('m');
                                $year = $now->format('Y');
                                $sql = "SELECT COUNT(*) as total FROM OrdemDeServico WHERE dataEntrada LIKE '%/{$month}/{$year}'";
                                $query = mysql_query($sql);
                                $result = mysql_fetch_assoc($query);
                            ?>
                            <div class="icon-block">
                                <h2 class="center"><i class="material-icons">shopping</i></h2>
                                <h4 class="center"><?php echo $result['total']; ?></h4>
                                <p class="light center">Ordens de serviço neste mês</p>
                                <p class="light right-align"><a href="listarOS.php">Ver Mais</a></p>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <?php
                            $sql = "SELECT COUNT(*) as total FROM OrdemDeServico WHERE dataEntrada LIKE '%/{$month}/{$year}' AND status LIKE 'cadastro'";
                            $query = mysql_query($sql);
                            $cadastro = mysql_fetch_assoc($query);

                            $sql = "SELECT COUNT(*) as total FROM OrdemDeServico WHERE dataEntrada LIKE '%/{$month}/{$year}' AND status LIKE 'desenvolvimento'";
                            $query = mysql_query($sql);
                            $desenvolvimento = mysql_fetch_assoc($query);

                            $sql = "SELECT COUNT(*) as total FROM OrdemDeServico WHERE dataEntrada LIKE '%/{$month}/{$year}' AND status LIKE 'aprovacao'";
                            $query = mysql_query($sql);
                            $aprovacao = mysql_fetch_assoc($query);

                            $sql = "SELECT COUNT(*) as total FROM OrdemDeServico WHERE dataEntrada LIKE '%/{$month}/{$year}' AND status LIKE 'impressao'";
                            $query = mysql_query($sql);
                            $impressao = mysql_fetch_assoc($query);

                            $sql = "SELECT COUNT(*) as total FROM OrdemDeServico WHERE dataEntrada LIKE '%/{$month}/{$year}' AND status LIKE 'acabamento'";
                            $query = mysql_query($sql);
                            $acabamento = mysql_fetch_assoc($query);

                            $sql = "SELECT COUNT(*) as total FROM OrdemDeServico WHERE dataEntrada LIKE '%/{$month}/{$year}' AND status LIKE 'pronto'";
                            $query = mysql_query($sql);
                            $pronto = mysql_fetch_assoc($query);

                            $sql = "SELECT COUNT(*) as total FROM OrdemDeServico WHERE dataEntrada LIKE '%/{$month}/{$year}' AND status LIKE 'entregue'";
                            $query = mysql_query($sql);
                            $entregue = mysql_fetch_assoc($query);

                            $sql = "SELECT COUNT(*) as total FROM OrdemDeServico WHERE dataEntrada LIKE '%/{$month}/{$year}' AND status LIKE 'cancelada'";
                            $query = mysql_query($sql);
                            $cancelada = mysql_fetch_assoc($query);
                            ?>
                            <label>Serviços por status</label>
                            <table class="responsive-table highlight">
                                <thead>
                                    <tr>
                                        <th data-field="status">Status</th>
                                        <th data-field="total">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>Cadastro</td><td><b><?php echo $cadastro['total']; ?></b></td></tr>
                                    <tr><td>Desenvolvimento</td><td><b><?php echo $desenvolvimento['total']; ?></b></td></tr>
                                    <tr><td>Aprovação</td><td><b><?php echo $aprovacao['total']; ?></b></td></tr>
                                    <tr><td>Impressão</td><td><b><?php echo $impressao['total']; ?></b></td></tr>
                                    <tr><td>Acabamento</td><td><b><?php echo $acabamento['total']; ?></b></td></tr>
                                    <tr><td>Pronto</td><td><b><?php echo $pronto['total']; ?></b></td></tr>
                                    <tr><td>Entregue</td><td><b><?php echo $entregue['total']; ?></b></td></tr>
                                    <tr><td>Cancelada</td><td><b><?php echo $cancelada['total']; ?></b></td></tr>
                                </tbody>
                            </table>
                            <p class="light right-align"><a href="listarOS.php">Ver Mais</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label>Serviços Prontos</label>
                            <?php
                            $sql = "SELECT * FROM OrdemDeServico WHERE status LIKE 'pronto'
                                    ORDER BY idOrdemDeServico DESC";
                            $query = mysql_query($sql);
                            echo "<ul class='collection'>";
                            while ($resultado = mysql_fetch_assoc($query)) {
                                $tempId = $resultado['idOrdemDeServico'];
                                echo "<li class='collection-item'>";
                                    $sql2 = "SELECT * FROM Pessoa
                                            INNER JOIN Pessoa_OrdemDeServico ON Pessoa_OrdemDeServico.idPessoa = Pessoa.idPessoa
                                            WHERE Pessoa_OrdemDeServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Cliente: ";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        if($temp['isPessoaFisica'] == '1') {
                                            echo "<b>{$temp['nome']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        } else {
                                            echo "<b>{$temp['nomeFantasia']} ({$temp['razaoSocial']})</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        }
                                    }
                                    echo "</p>";
                                    $sql2 = "SELECT OrdemDeServico_TipoServico.quantidade as qtde, TipoServico.nome as servico,
                                            OrdemDeServico_TipoServico.valor as valor
                                            FROM OrdemDeServico_TipoServico
                                            INNER JOIN TipoServico ON OrdemDeServico_TipoServico.idTipoServico = TipoServico.idTipoServico
                                            WHERE OrdemDeServico_TipoServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Serviços: <br>";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        echo "> Tipo: <b>{$temp['servico']}</b> - Quantidade: <b>{$temp['qtde']}</b> - Valor: <b>R$ {$temp['valor']}</b><br>";
                                    }
                                    echo "</p>";
                                    echo "<p>Entrada: <b>{$resultado['dataEntrada']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Saída: <b>{$resultado['dataSaida']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Valor: <b> " . "R$ " . strtoupper($resultado['valorTotal']) . "</b></p>";
                                    echo "<p>Observações: {$resultado['observacoes']}</p>";
                                    echo "<a id='editar' href='incluirOS.php?idOS={$tempId}'><i class='material-icons'>description</i>Editar</a>";
                                echo "</li>";
                            }
                            echo "</ul>";
                            ?>
                            <p class="light right-align"><a href="listarOS.php">Ver Mais</a></p>
                        </div>
                        <div class="col s6">
                            <label>Serviços em Acabamento</label>
                            <?php
                            $sql = "SELECT * FROM OrdemDeServico WHERE status LIKE 'acabamento'
                                    ORDER BY idOrdemDeServico DESC";
                            $query = mysql_query($sql);
                            echo "<ul class='collection'>";
                            while ($resultado = mysql_fetch_assoc($query)) {
                                $tempId = $resultado['idOrdemDeServico'];
                                echo "<li class='collection-item'>";
                                    $sql2 = "SELECT * FROM Pessoa
                                            INNER JOIN Pessoa_OrdemDeServico ON Pessoa_OrdemDeServico.idPessoa = Pessoa.idPessoa
                                            WHERE Pessoa_OrdemDeServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Cliente: ";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        if($temp['isPessoaFisica'] == '1') {
                                            echo "<b>{$temp['nome']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        } else {
                                            echo "<b>{$temp['nomeFantasia']} ({$temp['razaoSocial']})</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        }
                                    }
                                    echo "</p>";
                                    $sql2 = "SELECT OrdemDeServico_TipoServico.quantidade as qtde, TipoServico.nome as servico,
                                            OrdemDeServico_TipoServico.valor as valor
                                            FROM OrdemDeServico_TipoServico
                                            INNER JOIN TipoServico ON OrdemDeServico_TipoServico.idTipoServico = TipoServico.idTipoServico
                                            WHERE OrdemDeServico_TipoServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Serviços: <br>";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        echo "> Tipo: <b>{$temp['servico']}</b> - Quantidade: <b>{$temp['qtde']}</b> - Valor: <b>R$ {$temp['valor']}</b><br>";
                                    }
                                    echo "</p>";
                                    echo "<p>Entrada: <b>{$resultado['dataEntrada']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Saída: <b>{$resultado['dataSaida']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Valor: <b> " . "R$ " . strtoupper($resultado['valorTotal']) . "</b></p>";
                                    echo "<p>Observações: {$resultado['observacoes']}</p>";
                                    echo "<a id='editar' href='incluirOS.php?idOS={$tempId}'><i class='material-icons'>description</i>Editar</a>";
                                echo "</li>";
                            }
                            echo "</ul>";
                            ?>
                            <p class="light right-align"><a href="listarOS.php">Ver Mais</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label>Serviços em Impressão</label>
                            <?php
                            $sql = "SELECT * FROM OrdemDeServico WHERE status LIKE 'impressao'
                                    ORDER BY idOrdemDeServico DESC";
                            $query = mysql_query($sql);
                            echo "<ul class='collection'>";
                            while ($resultado = mysql_fetch_assoc($query)) {
                                $tempId = $resultado['idOrdemDeServico'];
                                echo "<li class='collection-item'>";
                                    $sql2 = "SELECT * FROM Pessoa
                                            INNER JOIN Pessoa_OrdemDeServico ON Pessoa_OrdemDeServico.idPessoa = Pessoa.idPessoa
                                            WHERE Pessoa_OrdemDeServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Cliente: ";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        if($temp['isPessoaFisica'] == '1') {
                                            echo "<b>{$temp['nome']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        } else {
                                            echo "<b>{$temp['nomeFantasia']} ({$temp['razaoSocial']})</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        }
                                    }
                                    echo "</p>";
                                    $sql2 = "SELECT OrdemDeServico_TipoServico.quantidade as qtde, TipoServico.nome as servico,
                                            OrdemDeServico_TipoServico.valor as valor
                                            FROM OrdemDeServico_TipoServico
                                            INNER JOIN TipoServico ON OrdemDeServico_TipoServico.idTipoServico = TipoServico.idTipoServico
                                            WHERE OrdemDeServico_TipoServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Serviços: <br>";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        echo "> Tipo: <b>{$temp['servico']}</b> - Quantidade: <b>{$temp['qtde']}</b> - Valor: <b>R$ {$temp['valor']}</b><br>";
                                    }
                                    echo "</p>";
                                    echo "<p>Entrada: <b>{$resultado['dataEntrada']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Saída: <b>{$resultado['dataSaida']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Valor: <b> " . "R$ " . strtoupper($resultado['valorTotal']) . "</b></p>";
                                    echo "<p>Observações: {$resultado['observacoes']}</p>";
                                    echo "<a id='editar' href='incluirOS.php?idOS={$tempId}'><i class='material-icons'>description</i>Editar</a>";
                                echo "</li>";
                            }
                            echo "</ul>";
                            ?>
                            <p class="light right-align"><a href="listarOS.php">Ver Mais</a></p>
                        </div>
                        <div class="col s6">
                            <label>Serviços em Aprovação</label>
                            <?php
                            $sql = "SELECT * FROM OrdemDeServico WHERE status LIKE 'aprovacao'
                                    ORDER BY idOrdemDeServico DESC";
                            $query = mysql_query($sql);
                            echo "<ul class='collection'>";
                            while ($resultado = mysql_fetch_assoc($query)) {
                                $tempId = $resultado['idOrdemDeServico'];
                                echo "<li class='collection-item'>";
                                    $sql2 = "SELECT * FROM Pessoa
                                            INNER JOIN Pessoa_OrdemDeServico ON Pessoa_OrdemDeServico.idPessoa = Pessoa.idPessoa
                                            WHERE Pessoa_OrdemDeServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Cliente: ";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        if($temp['isPessoaFisica'] == '1') {
                                            echo "<b>{$temp['nome']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        } else {
                                            echo "<b>{$temp['nomeFantasia']} ({$temp['razaoSocial']})</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        }
                                    }
                                    echo "</p>";
                                    $sql2 = "SELECT OrdemDeServico_TipoServico.quantidade as qtde, TipoServico.nome as servico,
                                            OrdemDeServico_TipoServico.valor as valor
                                            FROM OrdemDeServico_TipoServico
                                            INNER JOIN TipoServico ON OrdemDeServico_TipoServico.idTipoServico = TipoServico.idTipoServico
                                            WHERE OrdemDeServico_TipoServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Serviços: <br>";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        echo "> Tipo: <b>{$temp['servico']}</b> - Quantidade: <b>{$temp['qtde']}</b> - Valor: <b>R$ {$temp['valor']}</b><br>";
                                    }
                                    echo "</p>";
                                    echo "<p>Entrada: <b>{$resultado['dataEntrada']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Saída: <b>{$resultado['dataSaida']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Valor: <b> " . "R$ " . strtoupper($resultado['valorTotal']) . "</b></p>";
                                    echo "<p>Observações: {$resultado['observacoes']}</p>";
                                    echo "<a id='editar' href='incluirOS.php?idOS={$tempId}'><i class='material-icons'>description</i>Editar</a>";
                                echo "</li>";
                            }
                            echo "</ul>";
                            ?>
                            <p class="light right-align"><a href="listarOS.php">Ver Mais</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label>Serviços em Desenvolvimento</label>
                            <?php
                            $sql = "SELECT * FROM OrdemDeServico WHERE status LIKE 'desenvolvimento'
                                    ORDER BY idOrdemDeServico DESC";
                            $query = mysql_query($sql);
                            echo "<ul class='collection'>";
                            while ($resultado = mysql_fetch_assoc($query)) {
                                $tempId = $resultado['idOrdemDeServico'];
                                echo "<li class='collection-item'>";
                                    $sql2 = "SELECT * FROM Pessoa
                                            INNER JOIN Pessoa_OrdemDeServico ON Pessoa_OrdemDeServico.idPessoa = Pessoa.idPessoa
                                            WHERE Pessoa_OrdemDeServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Cliente: ";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        if($temp['isPessoaFisica'] == '1') {
                                            echo "<b>{$temp['nome']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        } else {
                                            echo "<b>{$temp['nomeFantasia']} ({$temp['razaoSocial']})</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        }
                                    }
                                    echo "</p>";
                                    $sql2 = "SELECT OrdemDeServico_TipoServico.quantidade as qtde, TipoServico.nome as servico,
                                            OrdemDeServico_TipoServico.valor as valor
                                            FROM OrdemDeServico_TipoServico
                                            INNER JOIN TipoServico ON OrdemDeServico_TipoServico.idTipoServico = TipoServico.idTipoServico
                                            WHERE OrdemDeServico_TipoServico.idOrdemDeServico = {$tempId}";
                                    $query2 = mysql_query($sql2);
                                    echo "<p>Serviços: <br>";
                                    while($temp = mysql_fetch_assoc($query2)) {
                                        echo "> Tipo: <b>{$temp['servico']}</b> - Quantidade: <b>{$temp['qtde']}</b> - Valor: <b>R$ {$temp['valor']}</b><br>";
                                    }
                                    echo "</p>";
                                    echo "<p>Entrada: <b>{$resultado['dataEntrada']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Saída: <b>{$resultado['dataSaida']}</b>&nbsp;&nbsp;&nbsp;";
                                    echo "Valor: <b> " . "R$ " . strtoupper($resultado['valorTotal']) . "</b></p>";
                                    echo "<p>Observações: {$resultado['observacoes']}</p>";
                                    echo "<a id='editar' href='incluirOS.php?idOS={$tempId}'><i class='material-icons'>description</i>Editar</a>";
                                echo "</li>";
                            }
                            echo "</ul>";
                            ?>
                            <p class="light right-align"><a href="listarOS.php">Ver Mais</a></p>
                        </div>
                    </div>
                </div>
                <div class="section">
                    <div class="row">
                        <div class="col s12">
                            <label>Materiais em Falta</label>
                            <?php
                            $sql = "SELECT Material.idMaterial as idMaterial, Material.descricao as descricao, Material.quantidade as quantidade,
                                    Material.quantidadeMinima as quantidadeMinima, Papel.tipo as tipo, Papel.base as base, Papel.altura as altura,
                                    GramaturaPapel.gramatura as gramatura, MaterialUnidade.descricao as unidade
                                    FROM Material
                                    LEFT JOIN Papel ON Material.idMaterial = Papel.idMaterial
                                    LEFT JOIN GramaturaPapel ON Papel.idGramaturaPapel = GramaturaPapel.idGramaturaPapel
                                    INNER JOIN MaterialUnidade ON Material.idMaterialUnidade = MaterialUnidade.idMaterialUnidade
                                    WHERE quantidade < quantidadeMinima";
                            $query = mysql_query($sql);
                            echo "<ul class='collection'>";
                            while ($resultado = mysql_fetch_assoc($query)) {
                                $tempId = $resultado['idMaterial'];
                                echo "<li class='collection-item'>";
                                    echo "<p>Material: <b>{$resultado['descricao']}</b> - Quantidade: <b>{$resultado['quantidade']}</b> - Quantidade Mínima: <b>{$resultado['quantidadeMinima']}</b> - Unidade de Medida: <b>{$resultado['unidade']}</b><br>";
                                    if($resultado['tipo'] != '' || $resultado['gramatura'] != '') echo "Papel: <b>{$resultado['tipo']} {$resultado['gramatura']} g/m2</b>";
                                    echo "</p>";
                                    if($resultado['tipo'] != '' || $resultado['gramatura'] != ''){
                                        echo "<a id='editar' href='incluirMaterial.php?idMaterial={$tempId}&tipo=papel'><i class='material-icons'>description</i>Editar</a>";
                                    }
                                    else {
                                        echo "<a id='editar' href='incluirMaterial.php?idMaterial={$tempId}'><i class='material-icons'>description</i>Editar</a>";
                                    }

                                echo "</li>";
                            }
                            echo "</ul>";
                            ?>
                            <p class="light right-align"><a href="listarArquivo.php">Ver Mais</a></p>
                        </div>
                    </div>
                </div>
			</div>
		</main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <?php
        include 'header.php';
        ?>
    </body>
</html>

<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
if(isset($_GET['logout'])) {
    unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
    header("Location: login.php");
}
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Listar Materiais em Falta</title>
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/font.css" rel="stylesheet">
        <link href="css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
    	<?php
    		include 'header.php';
    	?>
        <div id="help" class="modal">
            <div class="modal-content">
                <h4>Relatório de Materiais em Falta</h4>
                <p>Essa lista mostra os materias que se encontram abaixo da quantidade mínima definida para cada tipo de produto e o email do fornecedor referente ao produto em questão.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class=" modal-action modal-close waves-effect waves-green btn-flat">Entendi</a>
            </div>
        </div>

        <main>
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <?php
                        if(isset($_GET['at']) && $_GET['at'] == 'ok')
                            echo "<div class='card-panel green lighten-2 white-text'>Dados atualizados com sucesso!<i class='material-icons right'>close</i></div>";
                        if(isset($_GET['at']) && $_GET['at'] == 'no')
                            echo "<div class='card-panel red lighten-2 white-text'>Dados não atualizados no sistema, tente novamente.<i class='material-icons right'>close</i></div>";
                        ?>
                    </div>
                </div>
            <!-- </div>
            <div class="container"> -->
                <div class="row valign-wrapper">
                    <div class="col s12 l10">
                        <?php
                        echo "<h4>Listar Materiais em Falta</h4>";
                        ?>
                    </div>
                    <div class="col s12 l2 valign">
                        <a class="waves-effect waves-light modal-trigger" href="#help"><i class="material-icons">info</i></a>
                    </div>
                </div>
                <div class="row">
                	<form class="col s12" role="form" method="POST" action="control/material.php" id="buscarMaterial">
                		<div class="row">
                			<?php
								$sql = "select * from Material where quantidadeMinima > quantidade;";
								$query = mysql_query($sql);
								while ($resultado = mysql_fetch_assoc($query)) {
									echo "<li>";
									echo $resultado['descricao'] . " - ";
									echo $resultado['quantidadeMinima'] . " - ";
									echo $resultado['quantidade'] . " - ";
									
									// Selecionar o fornecedor do Material.
									$sql = "select * from Pessoa where Pessoa.idPessoa = (select idPessoa from Fornecedor_Categoria where idCategoria = (select idCategoria from Categoria_Material where idMaterial = ".$resultado['idMaterial'].";";
									$query = mysql_query($sql);
									while ($resultado2 = mysql_fetch_assoc($query)) {
										echo $resultado2['Nome'] . " - ";
										$sql = "select * from Email where ".$resultado2['idPessoa']." = Email.idPessoa;";
										$query = mysql_query($sql);
										while ($resultado3 = mysql_fetch_assoc($query)){
											echo $resultado3['endereco'];											
										}
									}	
									echo "<\li>";	
								}
	                        ?>
                		</div>
                	</form>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/jasny-bootstrap.min.js"></script>
        <script src="js/paginacao.js"></script>
    </body>
</html>
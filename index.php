<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
if(isset($_GET['logout'])) {
	unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
	header("Location: login.php");
}
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

    	<?php
			include 'header.php';
		?>
		<main>
			<div class="container">
				<div class="row">
					<div class="col s12">
						<?php
						if(isset($_GET['aP']) && $_GET['aP'] == 'ok')
							echo "<div class='card-panel green lighten-2 white-text'>Pessoa atualizada com sucesso!<i class='material-icons'>close</i></div>";
						?>
					</div>
				</div>
			</div>
		</main>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/materialize.js" type="text/javascript"></script>
        <script src="js/init.js" type="text/javascript"></script>
    </body>
</html>

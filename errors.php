<?php
include("control/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE php>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>SISGRAF - Erro</title>
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/font.css" rel="stylesheet">
        <link href="css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col s12">
                    	<img src="img/erro.png" alt="Aconteceu um erro" />
                        <?php
						$status = $_SERVER['REDIRECT_STATUS'];
						$codes = array(
							400 => array('400 Requisição Inválida', 'A requisição não pode ser completada devido à sintáxe não funcional.'),
							403 => array('403 Não Autorizado', 'O servidor negou completar a sua requisição.'),
							404 => array('404 Não Encontrado', 'A página que você tentou acessar não foi encontrada no sistema.'),
							405 => array('405 Método Não Permitido', 'Método não permitido na requisição f0i enviado.'),
							408 => array('408 Tempo de Requisição Esgotou', 'Seu navegador falhou enviar uma requisição em tempo permitido pelo servidor.'),
							500 => array('500 Erro Interno do Servidor', 'A requisição foi sem sucesso pois uma condição inesperada foi encontrada no servidor.'),
							502 => array('502 Bad Gateway', 'O servidor recebeu uma resposta inválida enquanto tentava encaminhar a requisição.'),
							504 => array('504 Gateway Timeout', 'O servidor falhou enviar uma requisição no tempo permitido pelo servidor.'),
						);

						$title = $codes[$status][0];
						$message = $codes[$status][1];
						if ($title == false || strlen($status) != 3) {
							$message = 'Por favor, forneça um código de status HTTP válido.';
						}
						echo '<h3>Ooops, foi detectado o Erro '.$title.' :(</h3>
						<p>'.$message.'.</p>
						<p>Caso este problema persistir, entre em contato com os desenvolvedores que eles resolvem pra você!.</p>'
						?>
                    </div>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/jasny-bootstrap.min.js"></script>
        
        <?php
        include 'header.php';
        ?>
    </body>
</html>
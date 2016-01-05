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
    <body style="background-color: #212121;">
        <div class="container">
            <div class="row">
                <div id="result">
                    &nbsp;
                </div>
            </div>
            <div class="row">
                <div class="col l3">&nbsp;</div>
                <form class="col l6" role="form" method="POST" action="control/valida.php">
                    <div class="card center-align">
                        <div class="card-content">
                            <span class="card-title">Efetuar Login</span>
                            <div class="row">
                                <div class="input-field col l12">
                                    <input id="usuario" name="usuario" type="text" autofocus>
                                    <label for="usuario" class="active">Nome de Usuário</label>
                                </div>
                                <div class="input-field col l12">
                                    <input id="senha" name="senha" type="password">
                                    <label for="senha">Senha</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn waves-effect waves-light green" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col l3"></div>
                <div class="col l6"></div>
                <div class="col l3"></div>
		</div>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/materialize.js" type="text/javascript"></script>
        <script src="js/init.js" type="text/javascript"></script>
    </body>
</html>

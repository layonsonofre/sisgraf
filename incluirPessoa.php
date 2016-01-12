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
        <title>SISGRAF - Atualizar Pessoa</title>
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/font.css" rel="stylesheet">
        <link href="css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
    	<?php
    		include 'header.php';
            include 'modal/categorias.php';
    	?>
        <div id="help" class="modal">
            <div class="modal-content">
                <h4>Modal Header</h4>
                <p>A bunch of text</p>
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
                            echo "<div id='msg' class='card-panel green lighten-2 white-text'>Pessoa atualizada com sucesso!<i class='material-icons right' id='close'>close</i></div>";
                        if(isset($_GET['at']) && $_GET['at'] == 'no')
                            echo "<div id='msg' class='card-panel red lighten-2 white-text'>Dados não atualizados no sistema, tente novamente.<i class='material-icons right' id='close'>close</i></div>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="container" >
                <div class="row valign-wrapper">
                    <div class="col s12 l10">
                        <?php
                        $idPessoa = isset($_GET['idPessoa']) ? $_GET['idPessoa'] : '';
                        if($idPessoa != '') {
                            $sql = "select * from Pessoa where idPessoa=" . $idPessoa . ";";
                            if($_GET['tipo'] == 'cliente') {
                                echo "<h4>Atualizar Cliente</h4>";
                            } else if($_GET['tipo'] == 'fornecedor') {
                                echo "<h4>Atualizar Fornecedor</h4>";
                            } else if($_GET['tipo'] == 'funcionario') {
                                $sql = "select * from Funcionario, Pessoa where Funcionario.idPessoa=" . $idPessoa . " and Funcionario.idPessoa = Pessoa.idPessoa;";
                                echo "<h4>Atualizar Funcionário</h4>";
                            }
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_assoc($query);
                        }
                        else {
                            if($_GET['tipo'] == 'cliente') {
                                echo "<h4>Cadastrar Cliente</h4>";
                            } else if($_GET['tipo'] == 'fornecedor') {
                                echo "<h4>Cadastrar Fornecedor</h4>";
                            } else if($_GET['tipo'] == 'funcionario') {
                                echo "<h4>Cadastrar Funcionário</h4>";
                            }
                        }
                        ?>
                    </div>
                    <div class="col s12 l2 valign">
                        <a class="waves-effect waves-light modal-trigger" href="#help"><i class="material-icons">info</i></a>
                    </div>
                </div>
                <?php
                ?>
                <div class="row">
                    <form class="col s12" role="form" method="POST" action="control/pessoa.php">
                        <?php
                        if(isset($_GET['tipo']) && $_GET['tipo'] != 'funcionario') {
                        ?>
                            <div class="row">
                                <div class="col s12">
                                    <p>
                                        <input name="tipoPessoa" type="radio" id="pFisica" value="pFisica" checked>
                                        <label for="pFisica">Pessoa Física&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <input name="tipoPessoa" type="radio" id="pJuridica" value="pJuridica">
                                        <label for="pJuridica">Pessoa Juridica</label>
                                    </p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row" id="pessoaFisica">
                            <div class="input-field col s4">
                                <input name="nome" id="nome" type="text" class="validate" <?php if(isset($_GET['idPessoa'])) echo "value='".$resultado['nome']."'"; ?>>
                                <label for="nome" class="active">Nome</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="cpf" id="cpf" type="text" class="validate" data-mask="999.999.999-99" <?php if(isset($_GET['idPessoa'])) echo "value='".$resultado['cpf']."'"; ?>>
                                <label for="cpf" class="active">CPF</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="rg" id="rg" type="text" class="validate" <?php if(isset($_GET['idPessoa'])) echo "value='".$resultado['rg']."'"; ?>>
                                <label for="rg" class="active">RG ou RNE</label>
                            </div>
                            <div class="input-field col s2">
                                <input name="orgaoExpedidor" id="orgaoExpedidor" type="text" class="validate" data-mask="www/ww" <?php if(isset($_GET['idPessoa'])) echo "value='".$resultado['orgaoExpedidor']."'"; ?>>
                                <label for="orgaoExpedidor" class="active">Órgão Expedidor/UF</label>
                            </div>
                        </div>
                        <?php
                        if($_GET['tipo'] != 'funcionario') {
                        ?>
                            <div id="pessoaJuridica" >
                                <div class="row">
                                    <div class="input-field col s5">
                                        <input name="nomeFantasia" id="nomeFantasia" type="text" class="validate" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['nomeFantasia']."'"; ?>>
                                        <label for="nomeFantasia" class="active">Nome Fantasia</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input name="razaoSocial" id="razaoSocial" type="text" class="validate" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['razaoSocial']."'"; ?>>
                                        <label for="razaoSocial" class="active">Razão Social</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="contato" id="contato" type="text" class="validate" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['nome']."'"; ?>>
                                        <label for="contato" class="active">Contato</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <input name="cnpj" id="cnpj" type="text" class="validate" data-mask="99.999.999/9999-99" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['cnpj']."'"; ?>>
                                        <label for="cnpj" class="active">CNPJ</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input name="inscricaoEstadual" id="inscricaoEstadual" type="text" class="validate" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['inscricaoEstadual']."'"; ?>>
                                        <label for="inscricaoEstadual" class="active">Inscrição Estadual</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input name="inscricaoMunicipal" id="inscricaoMunicipal" type="text" class="validate" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['inscricaoMunicipal']."'"; ?>>
                                        <label for="inscricaoMunicipal" class="active">Inscrição Municipal</label>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div>
                            <div class="row">
                                <div id="incluirTelefone">
                                    <?php
                                    if(isset($_GET['idPessoa'])) {
                                        $sql = "select * from Telefone where idPessoa=" . $idPessoa . ";";
                                        $query = mysql_query($sql);
                                        while($telefones = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                            echo "<div><div class=\"input-field col s5\">" .
                                                    "<input name=\"telefone[]\" id=\"telefone\" type=\"text\" class=\"validate\"  data-mask=\"(99) 9999-9999?9\" value=\"".$telefones['numero']."\" >".
                                                    "<label for=\"telefone\" class=\"active\">Telefone</label>".
                                                    "<input name=\"idTelefone[]\" id=\"idTelefone\" type=\"hidden\" value=\"".$telefones['idTelefone']."\">".
                                                "</div>".
                                                "<div class=\"col s1\">".
                                                    "<a idtelefone=\"".$telefones['idTelefone']."\" idpessoa=\"".$idPessoa."\"tipo=\"".$_GET['tipo']."\" id=\"remTelefone\" class=\"waves-effect waves-light red accent-4 btn-floating\"><i class=\"material-icons left\">phone</i></a>".
                                                "</div></div>";
                                        }
                                    }
                                    ?>
                                    <div class="input-field col s5">
                                        <input name="telefone[]" id="telefone" type="text" class="validate" data-mask="(99) 9999-9999?9">
                                        <label for="telefone">Telefone</label>
                                    </div>
                                    <div class="col s1">
                                        <a id="addTelefone" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">phone</i></a>
                                    </div>
                                </div>
                                <div id="incluirEmail">
                                    <?php
                                    if(isset($_GET['idPessoa'])) {
                                        $sql = "select * from Email where idPessoa=" . $idPessoa . ";";
                                        $query = mysql_query($sql);
                                        while($emails = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                            echo "<div><div class=\"input-field col s5\">" .
                                                    "<input name=\"email[]\" id=\"email\" type=\"email\" class=\"validate\" value=\"".$emails['endereco']."\" >".
                                                    "<label for=\"email\" class=\"active\">Email</label>".
                                                    "<input name=\"idEmail[]\" id=\"idEmail\" type=\"hidden\" value=\"".$emails['idEmail']."\">".
                                                "</div>".
                                                "<div class=\"col s1\">".
                                                    "<a idemail=\"".$emails['idEmail']."\" idpessoa=\"".$idPessoa."\"tipo=\"".$_GET['tipo']."\"  id=\"remEmail\" class=\"waves-effect waves-light red accent-4 btn-floating\"><i class=\"material-icons left\">mail</i></a>".
                                                "</div></div>";
                                        }
                                    }
                                    ?>
                                    <div class="input-field col s5">
                                        <input name="email[]" id="email" type="email" class="validate">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col s1">
                                        <a id="addEmail" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">mail</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($_GET['tipo']) && $_GET['tipo'] == 'funcionario') {
                        ?>
                        <div id="usuario">
                            <div class="row">
                                <div class="input-field col s4">
                                    <input name="usuario" id="usuario" type="text" class="validate" <?php if(isset($_GET['idPessoa'])) echo "value='".$resultado['usuario']."'"; ?>>
                                    <label for="usuario" class="active">Nome de Usuário</label>
                                    <p class="help-block" id="help-usuario"></p>
                                </div>
                                <div class="input-field col s4">
                                    <input name="senha" id="senha" type="password" class="validate" <?php if(isset($_GET['idPessoa'])) echo "disabled"; ?>>
                                    <label for="senha" class="active">Senha</label>
                                    <p class="help-block" id="help-senha"></p>
                                </div>
                                <div class="input-field col s4">
                                    <input id="confirmacaosenha" type="password" class="validate" <?php if(isset($_GET['idPessoa'])) echo "disabled"; ?>>
                                    <label for="confirmacaosenha" class="active">Confirme sua senha</label>
                                    <p class="help-block" id="help-confirmacaosenha"></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div id="endereco">
                            <div class="row">
                                <div class="input-field col s2">
                                    <input name="cep" id="cep" type="text" class="validate" data-mask="99999-999" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['cep']."'"; ?>>
                                    <label for="cep" class="active">CEP</label>
                                </div>
                                <div class="input-field col s5">
                                    <input name="nomeRua" id="nomeRua" type="text" class="validate" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['nomeRua']."'"; ?>>
                                    <label for="nomeRua" class="active">Logradouro</label>
                                </div>
                                <div class="input-field col s1">
                                    <input name="numero" id="numero" type="text" class="validate right-align" data-mask="9?99999999" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['numero']."'"; ?>>
                                    <label for="numero" class="active">Número</label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="complemento" id="complemento" type="text" class="validate" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['complemento']."'"; ?>>
                                    <label for="complemento" class="active">Complemento</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s5">
                                    <input name="cidade" id="cidade" type="text" class="validate" <?php if(isset($_GET['idPessoa']))echo "value='".$resultado['cidade']."'"; ?>>
                                    <label for="cidade" class="active">Cidade</label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="bairro" id="bairro" type="text" class="validate" <?php if(isset($_GET['idPessoa'])) echo "value='".$resultado['bairro']."'"; ?>>
                                    <label for="bairro" class="active">Bairro</label>
                                </div>
                                <div class="input-field col s3">
                                    <select id="estado" name="estado">
                                        <option value="" disabled selected>Selecione o estado</option>
                                        <option value="AC" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'AC') echo "selected"; ?> >Acre</option>
                                        <option value="AL" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'AL') echo "selected"; ?> >Alagoas</option>
                                        <option value="AP" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'AP') echo "selected"; ?> >Amapá</option>
                                        <option value="AM" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'AM') echo "selected"; ?> >Amazonas</option>
                                        <option value="BA" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'BA') echo "selected"; ?> >Bahia</option>
                                        <option value="CE" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'CE') echo "selected"; ?> >Ceará</option>
                                        <option value="DF" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'DF') echo "selected"; ?> >Distrito Federal</option>
                                        <option value="ES" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'ES') echo "selected"; ?> >Espírito Santo</option>
                                        <option value="GO" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'GO') echo "selected"; ?> >Goiás</option>
                                        <option value="MA" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'MA') echo "selected"; ?> >Maranhão</option>
                                        <option value="MT" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'MT') echo "selected"; ?> >Mato Grosso</option>
                                        <option value="MS" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'MS') echo "selected"; ?> >Mato Grosso do Sul</option>
                                        <option value="MG" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'MG') echo "selected"; ?> >Minas Gerais</option>
                                        <option value="PA" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'PA') echo "selected"; ?> >Pará</option>
                                        <option value="PB" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'PB') echo "selected"; ?> >Paraíba</option>
                                        <option value="PR" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'PR') echo "selected"; ?> >Paraná</option>
                                        <option value="PE" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'PE') echo "selected"; ?> >Pernambuco</option>
                                        <option value="PI" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'PI') echo "selected"; ?> >Piauí</option>
                                        <option value="RJ" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'RJ') echo "selected"; ?> >Rio de Janeiro</option>
                                        <option value="RN" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'RN') echo "selected"; ?> >Rio Grande do Norte</option>
                                        <option value="RS" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'RS') echo "selected"; ?> >Rio Grande do Sul</option>
                                        <option value="RO" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'RO') echo "selected"; ?> >Rondônia</option>
                                        <option value="RR" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'RR') echo "selected"; ?> >Roraima</option>
                                        <option value="SC" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'SC') echo "selected"; ?> >Santa Catarina</option>
                                        <option value="SP" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'SP') echo "selected"; ?> >São Paulo</option>
                                        <option value="SE" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'SE') echo "selected"; ?> >Sergipe</option>
                                        <option value="TO" <?php if(isset($_GET['idPessoa'])) if($resultado['estado'] == 'TO') echo "selected"; ?> >Tocantins</option>
                                    </select>
                                    <label>Estado</label>
                                </div>
                            </div>
                        </div>

                        <?php
                        if(isset($_GET['tipo']) && $_GET['tipo'] == 'fornecedor') {
                        ?>
                        <br />
                        <div id="categorias">
                            <div class="row">
                                <div class="input-field col s11">
                                    <select id="categoria" name="categoria[]" multiple>
                                        <option value="" disabled>Selecione as categorias de materiais fornecidos</option>
                                    <?php
                                    $sql = "select * from Categoria;";
                                    $query = mysql_query($sql);
                                    while($categorias = mysql_fetch_array($query, MYSQL_ASSOC)) {
                                        echo "<option value='".$categorias['idCategoria']."' ";
                                        if(isset($_GET['idPessoa'])) {
                                            $sql2 = "select * from Fornecedor_Categoria where idCategoria=".$categorias['idCategoria']." and idPessoa=".$idPessoa.";";
                                            $query2 = mysql_query($sql2);
                                            if( mysql_num_rows($query2) == 1) {
                                                echo "selected";
                                            }
                                        }
                                        echo ">".$categorias['nome']." (" .$categorias['descricao'].")</option>";
                                    }
                                    ?>
                                    </select>
                                    <label>Materiais Fornecidos</label>
                                </div>
                                <div class="col s1">
                                    <a id="incluirCategoria" href="#modalCategoria" class="waves-effect waves-light blue accent-4 btn-floating modal-trigger"><i class="material-icons left">add</i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        if(isset($_GET['idPessoa']))
                            echo "<a class=\"btn waves-effect waves-light red accent-4\" name=\"exlcuir\" onclick=\"document.forms['excluir'].submit()\">Excluir<i class=\"material-icons right\">delete</i></a>";
                            echo "<input type=\"hidden\" name=\"acao\" value=\"incluir\" />";
                            echo "<input type=\"hidden\" name=\"idPessoa\" value=\"" . $idPessoa . "\" />";
                        ?>
                        <button class="btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right">send</i></button>

                        <input type="hidden" name="isPessoaFisica" value="true" /> 
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>"/>
                        <input type="hidden" name="status" value="<?php echo $_GET['tipo'].'Ativo'; ?>"/>
                        <input type="hidden" name="acao" value="<?php echo isset($_GET['idPessoa']) ? 'atualizar' : 'inserir';  ?>" />
                    </form>
                    <form role="form" method="POST" name="excluir" action="control/pessoa.php">
                        <input type="hidden" name="acao" value="excluir" />
                        <input type="hidden" name="idPessoa" value="<?php echo $idPessoa; ?>" />
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" />
                    </form>
                </div>
            </div>
        </main>
        <script src="js/jquery.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/cadastro.js"></script>
        <script src="js/jasny-bootstrap.min.js"></script>
    </body>
</html>

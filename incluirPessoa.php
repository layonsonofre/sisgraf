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
        <div id="help" class="modal">
            <div class="modal-content">
                <h4>Atualizar Pessoa</h4>
                <p>Insira todos os campos necessários para atualizar uma pessoa no sistema.</p>
                <p>Clique no botão com o ícone do telefone para adicionar ou remover um número, e no botão contendo um envelope para adicionar ou remover um endereço de email.</p>
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
                        if(isset($_GET['at']) && $_GET['at'] == 'in')
                            echo "<div id='msg' class='card-panel red lighten-2 white-text'>A pessoa que tentou atualizar foi excluída do sistema.<i class='material-icons right' id='close'>close</i></div>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="container" >
                <div class="row valign-wrapper">
                    <div class="col s12 l10">
                        <?php
                        $idPessoa = isset($_GET['idPessoa']) ? $_GET['idPessoa'] : '';
                        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
                        if($idPessoa != '') {
                            $sql = "SELECT * FROM Pessoa WHERE idPessoa={$idPessoa}";

                            if($_GET['tipo'] == 'cliente') {
                                echo "<h4>Atualizar Cliente</h4>";
                            } else if($_GET['tipo'] == 'fornecedor') {
                                echo "<h4>Atualizar Fornecedor</h4>";
                            } else if($_GET['tipo'] == 'funcionario') {
                                $sql = "select * from Funcionario, Pessoa where Funcionario.idPessoa={$idPessoa} AND Funcionario.idPessoa = Pessoa.idPessoa;";
                                echo "<h4>Atualizar Funcionário</h4>";
                            }
                            $query = mysql_query($sql);
                            $resultado = mysql_fetch_array($query);
                        }
                        else {
                            if($tipo == 'cliente') {
                                echo "<h4>Cadastrar Cliente</h4>";
                            } else if($tipo == 'fornecedor') {
                                echo "<h4>Cadastrar Fornecedor</h4>";
                            } else if($tipo == 'funcionario') {
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
                    <form class="col s12" role="form" method="POST" action="control/pessoa.php" id="formPessoa">
                        <?php
                        if($tipo != 'funcionario') {
                            $flag = 0;
                        ?>
                            <div class="row">
                                <div class="col s12">
                                    <p>
                                        <input name="tipoPessoa" type="radio" id="pFisica" value="1" <?php if($idPessoa) { if($resultado['isPessoaFisica'] == '1') { echo "checked"; $flag = 1; } } else { echo "checked"; } ?>>
                                        <label for="pFisica">Pessoa Física&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <input name="tipoPessoa" type="radio" id="pJuridica" value="0" <?php if($idPessoa) { if($resultado['isPessoaFisica'] == '0') { echo "checked"; $flag = 2; } } ?>>
                                        <label for="pJuridica">Pessoa Juridica</label>
                                    </p>
                                </div>
                            </div>
                        <?php
                            if($flag == 1) {
                                echo "<script>$('#pFisica').click();</script>";
                            } else if ($flag == 2) {
                                echo "<script>$('#pJuridica').click();</script>";
                            }
                        }
                        ?>
                        <div class="row" id="pessoaFisica">
                            <div class="input-field col s4">
                                <input name="nome" id="nome" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['nome']."'"; ?> length="64" maxlength="64">
                                <label for="nome" class="active">Nome</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="cpf" id="cpf" type="text" class="validate" data-mask="999.999.999-99" <?php if($idPessoa) echo "value='".$resultado['cpf']."'"; ?>>
                                <label for="cpf" class="active">CPF</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="rg" id="rg" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['rg']."'"; ?> length="12" maxlength="12">
                                <label for="rg" class="active">RG ou RNE</label>
                            </div>
                            <div class="input-field col s2">
                                <input name="orgaoExpedidor" id="orgaoExpedidor" type="text" class="validate" data-mask="www/ww" <?php if($idPessoa) echo "value='".$resultado['orgaoExpedidor']."'"; ?>>
                                <label for="orgaoExpedidor" class="active">Órgão Exp./UF</label>
                            </div>
                        </div>
                        <?php
                        if($tipo != 'funcionario') {
                        ?>
                            <div id="pessoaJuridica" >
                                <div class="row">
                                    <div class="input-field col s5">
                                        <input name="nomeFantasia" id="nomeFantasia" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['nomeFantasia']."'"; ?> length="64" maxlength="64">
                                        <label for="nomeFantasia" class="active">Nome Fantasia</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input name="razaoSocial" id="razaoSocial" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['razaoSocial']."'"; ?> length="64" maxlength="64">
                                        <label for="razaoSocial" class="active">Razão Social</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input name="contato" id="contato" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['nome']."'"; ?> length="64" maxlength="64">
                                        <label for="contato" class="active">Contato</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <input name="cnpj" id="cnpj" type="text" class="validate" data-mask="99.999.999/9999-99" <?php if($idPessoa) echo "value='".$resultado['cnpj']."'"; ?>>
                                        <label for="cnpj" class="active">CNPJ</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input name="inscricaoEstadual" id="inscricaoEstadual" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['inscricaoEstadual']."'"; ?> length="24" maxlength="24">
                                        <label for="inscricaoEstadual" class="active">Inscrição Estadual</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input name="inscricaoMunicipal" id="inscricaoMunicipal" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['inscricaoMunicipal']."'"; ?> length="24" maxlength="24">
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
                                    if($idPessoa) {
                                        $sql = "SELECT * FROM Telefone WHERE idPessoa={$idPessoa}";
                                        $query = mysql_query($sql);
                                        while($telefones = mysql_fetch_assoc($query)) {
                                            echo "<div>".
                                                    "<div class='input-field col s5'>" .
                                                        "<input name='telefoneAntigo[]' id='telefone{$telefones['idTelefone']}' type='text' class='validate'  data-mask='(99) 9999-9999?9' value='{$telefones['numero']}' >".
                                                        "<label for='telefone{$telefones['idTelefone']}' class='active'>Telefone</label>".
                                                        "<input name='idTelefoneAntigo[]' id='idTelefone' type='hidden' value='{$telefones['idTelefone']}'>".
                                                    "</div>".
                                                    "<div class='col s1'>".
                                                        "<a idtelefone='{$telefones['idTelefone']}' idpessoa='{$idPessoa}' tipo='{$_GET['tipo']}' id='remTelefone' class='waves-effect waves-light red accent-4 btn-floating'><i class='material-icons left'>phone</i></a>".
                                                    "</div>".
                                                "</div>";
                                        }
                                    }
                                    ?>
                                    <div class="input-field col s5">
                                        <input name="telefoneNovo[]" id="telefoneNovo" type="text" class="validate" data-mask="(99) 9999-9999?9">
                                        <label for="telefone">Telefone</label>
                                    </div>
                                    <div class="col s1">
                                        <a id="addTelefone" class="waves-effect waves-light blue accent-4 btn-floating"><i class="material-icons left">phone</i></a>
                                    </div>
                                </div>
                                <div id="incluirEmail">
                                    <?php
                                    if($idPessoa) {
                                        $sql = "SELECT * FROM Email WHERE idPessoa={$idPessoa}";
                                        $query = mysql_query($sql);
                                        while($emails = mysql_fetch_assoc($query)) {
                                            echo "<div>".
                                                    "<div class='input-field col s5'>" .
                                                        "<input name='emailAntigo[]' id='emailAntigo{$emails['idEmail']}' type='email' class='validate' value='{$emails['endereco']}' length='42' maxlength='42'>".
                                                        "<label for='emailAntigo{$emails['idEmail']}' class='active'>Email</label>".
                                                        "<input name='idEmailAntigo[]' id='idEmail' type='hidden' value='{$emails['idEmail']}'>".
                                                    "</div>".
                                                    "<div class='col s1'>".
                                                        "<a idemail='{$emails['idEmail']}' idpessoa='{$idPessoa}' tipo='{$tipo}' id='remEmail' class='waves-effect waves-light red accent-4 btn-floating'><i class='material-icons left'>mail</i></a>".
                                                    "</div>".
                                                "</div>";
                                        }
                                    }
                                    ?>
                                    <div class="input-field col s5">
                                        <input name="emailNovo[]" id="emailNovo" type="email" class="validate">
                                        <label for="emailNovo">Email</label>
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
                                    <input name="usuario" id="usuario" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['usuario']."'"; ?> length="32" maxlength="32">
                                    <label for="usuario" class="active">Nome de Usuário</label>
                                    <p class="help-block" id="help-usuario"></p>
                                </div>
                                <div class="input-field col s4">
                                    <input name="senha" id="senha" type="password" class="validate" <?php if($idPessoa) echo "disabled"; ?>>
                                    <label for="senha" class="active">Senha</label>
                                    <p class="help-block" id="help-senha"></p>
                                </div>
                                <div class="input-field col s4">
                                    <input id="confirmacaosenha" type="password" class="validate" <?php if($idPessoa) echo "disabled"; ?>>
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
                                    <input name="cep" id="cep" type="text" class="validate" data-mask="99999-999" <?php if($idPessoa) echo "value='".$resultado['cep']."'"; ?>>
                                    <label for="cep" class="active">CEP</label>
                                </div>
                                <div class="input-field col s5">
                                    <input name="nomeRua" id="nomeRua" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['nomeRua']."'"; ?> length="50" maxlength="50">
                                    <label for="nomeRua" class="active">Logradouro</label>
                                </div>
                                <div class="input-field col s1">
                                    <input name="numero" id="numero" type="text" class="validate right-align" data-mask="9?99999999" <?php if($idPessoa) echo "value='".$resultado['numero']."'"; ?>>
                                    <label for="numero" class="active">Número</label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="complemento" id="complemento" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['complemento']."'"; ?> length="32" maxlength="32">
                                    <label for="complemento" class="active">Complemento</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s5">
                                    <input name="cidade" id="cidade" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['cidade']."'"; ?> length="32" maxlength="32">
                                    <label for="cidade" class="active">Cidade</label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="bairro" id="bairro" type="text" class="validate" <?php if($idPessoa) echo "value='".$resultado['bairro']."'"; ?> length="24" maxlength="24">
                                    <label for="bairro" class="active">Bairro</label>
                                </div>
                                <div class="input-field col s3">
                                    <select id="estado" name="estado" class="browser-default">
                                        <option value="" disabled selected>Selecione o estado</option>
                                        <option value="AC" <?php if($idPessoa) if($resultado['estado'] == 'AC') echo "selected"; ?> >Acre</option>
                                        <option value="AL" <?php if($idPessoa) if($resultado['estado'] == 'AL') echo "selected"; ?> >Alagoas</option>
                                        <option value="AP" <?php if($idPessoa) if($resultado['estado'] == 'AP') echo "selected"; ?> >Amapá</option>
                                        <option value="AM" <?php if($idPessoa) if($resultado['estado'] == 'AM') echo "selected"; ?> >Amazonas</option>
                                        <option value="BA" <?php if($idPessoa) if($resultado['estado'] == 'BA') echo "selected"; ?> >Bahia</option>
                                        <option value="CE" <?php if($idPessoa) if($resultado['estado'] == 'CE') echo "selected"; ?> >Ceará</option>
                                        <option value="DF" <?php if($idPessoa) if($resultado['estado'] == 'DF') echo "selected"; ?> >Distrito Federal</option>
                                        <option value="ES" <?php if($idPessoa) if($resultado['estado'] == 'ES') echo "selected"; ?> >Espírito Santo</option>
                                        <option value="GO" <?php if($idPessoa) if($resultado['estado'] == 'GO') echo "selected"; ?> >Goiás</option>
                                        <option value="MA" <?php if($idPessoa) if($resultado['estado'] == 'MA') echo "selected"; ?> >Maranhão</option>
                                        <option value="MT" <?php if($idPessoa) if($resultado['estado'] == 'MT') echo "selected"; ?> >Mato Grosso</option>
                                        <option value="MS" <?php if($idPessoa) if($resultado['estado'] == 'MS') echo "selected"; ?> >Mato Grosso do Sul</option>
                                        <option value="MG" <?php if($idPessoa) if($resultado['estado'] == 'MG') echo "selected"; ?> >Minas Gerais</option>
                                        <option value="PA" <?php if($idPessoa) if($resultado['estado'] == 'PA') echo "selected"; ?> >Pará</option>
                                        <option value="PB" <?php if($idPessoa) if($resultado['estado'] == 'PB') echo "selected"; ?> >Paraíba</option>
                                        <option value="PR" <?php if($idPessoa) if($resultado['estado'] == 'PR') echo "selected"; ?> >Paraná</option>
                                        <option value="PE" <?php if($idPessoa) if($resultado['estado'] == 'PE') echo "selected"; ?> >Pernambuco</option>
                                        <option value="PI" <?php if($idPessoa) if($resultado['estado'] == 'PI') echo "selected"; ?> >Piauí</option>
                                        <option value="RJ" <?php if($idPessoa) if($resultado['estado'] == 'RJ') echo "selected"; ?> >Rio de Janeiro</option>
                                        <option value="RN" <?php if($idPessoa) if($resultado['estado'] == 'RN') echo "selected"; ?> >Rio Grande do Norte</option>
                                        <option value="RS" <?php if($idPessoa) if($resultado['estado'] == 'RS') echo "selected"; ?> >Rio Grande do Sul</option>
                                        <option value="RO" <?php if($idPessoa) if($resultado['estado'] == 'RO') echo "selected"; ?> >Rondônia</option>
                                        <option value="RR" <?php if($idPessoa) if($resultado['estado'] == 'RR') echo "selected"; ?> >Roraima</option>
                                        <option value="SC" <?php if($idPessoa) if($resultado['estado'] == 'SC') echo "selected"; ?> >Santa Catarina</option>
                                        <option value="SP" <?php if($idPessoa) if($resultado['estado'] == 'SP') echo "selected"; ?> >São Paulo</option>
                                        <option value="SE" <?php if($idPessoa) if($resultado['estado'] == 'SE') echo "selected"; ?> >Sergipe</option>
                                        <option value="TO" <?php if($idPessoa) if($resultado['estado'] == 'TO') echo "selected"; ?> >Tocantins</option>
                                    </select>
                                    <label>Estado</label>
                                </div>
                            </div>
                        </div>

                        <?php
                        if($tipo == 'fornecedor') {
                        ?>
                        <br />
                        <div id="categorias">
                            <div class="row">
                                <div class="col s11">
                                    <label>Materiais Fornecidos</label>
                                    <select id="categoria" name="categoria[]" multiple class="browser-default">
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
                        if($idPessoa)
                            echo "<a class=\"btn waves-effect waves-light red accent-4\" name=\"exlcuir\" onclick=\"document.forms['excluir'].submit()\">Excluir<i class=\"material-icons right\">delete</i></a>";
                        ?>
                        <button class="btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right">send</i></button>
                        <input type="hidden" name="idPessoa" value="<?php echo $idPessoa; ?>" />
                        <input type="hidden" name="isPessoaFisica" value="1" /> 
                        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>"/>
                        <input type="hidden" name="status" value="<?php echo $_GET['tipo'].'Ativo'; ?>"/>
                        <input type="hidden" name="acao" value="<?php echo isset($_GET['idPessoa']) ? 'atualizar' : 'inserir';  ?>" />
                    </form>
                    <form role="form" method="POST" name="excluir" action="control/pessoa.php">
                        <input type="hidden" name="acao" value="excluir" />
                        <input type="hidden" name="idPessoa" value="<?php echo $idPessoa; ?>" />
                        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" />
                    </form>
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
            include 'modal/categorias.php';
        ?>
    </body>
</html>

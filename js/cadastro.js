$(function(){
    $('input[name=isPessoaFisica]').val('1');
    $('#pessoaFisica').show();
    $('#pFisica').attr("checked", "checked");
    $('#pessoaJuridica').hide();
    $('input[name="tipoPessoa"]').click(function () {
        if ($(this).attr('id')==='pFisica') {
            $('#pessoaFisica').show();
            $('#pessoaJuridica').hide();
            $('input[name=isPessoaFisica]').val('1');
        }

        else {
            $('#pessoaFisica').hide();
            $('#pessoaJuridica').show();
            $('input[name=isPessoaFisica]').val('0');
        }
    });

    var wrapperTel=$("#incluirTelefone");
    var add_buttonTel=$("#addTelefone");
    var xTel=1;
    $(add_buttonTel).click(function (e) {
        e.preventDefault();
        xTel++;
        $(wrapperTel).append('<div>'+
            '<div class=\"input-field col s5\">'+
            '<input name=\"telefoneNovo[]\" id=\"telefoneNovo' + xTel + '\" type=\"text\" class=\"validate\">'+
            '<label for=\"telefoneNovo' + xTel + '\">Telefone #' + xTel + '</label>'+
            '</div>'+
            '<div class=\"col s1\">'+
            '<a id=\"remTelefone\" class=\"waves-effect waves-light red accent-4 btn-floating\"><i class=\"material-icons left\">phone</i></a>'+
            '</div></div>');
    });

    $(wrapperTel).on("click", "#remTelefone", function (e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
        xTel--;
        var idTelefone = $(this).attr('idtelefone');
        var idPessoa = $(this).attr('idpessoa');
        var tipo = $(this).attr('tipo');
        $.ajax({
            type: 'POST',
            url: 'control/pessoa.php',
            data: 'idTelefone='+idTelefone+"&idPessoa="+idPessoa+"&acao=excluirTelefone&tipo="+tipo,
            success: function(data) {
                if(data) {
                    console.log('Falha removendo o telefone');
                } else {
                    console.log(idTelefone + " " + idPessoa + " " + tipo);
                }
            }
        });
    });

    var wrapperEmail = $('#incluirEmail');
    var add_buttonEmail = $("#addEmail");
    var xEmail = 1;
    $(add_buttonEmail).click(function (e) {
        e.preventDefault();
        xEmail++;
        $(wrapperEmail).append('<div>' +
            '<div class=\"input-field col s5\">' +
            '<input name=\"emailNovo[]\" id=\"emailNovo' + xEmail + '\" type=\"text\" class=\"validate\">' +
            '<label for=\"emailNovo' + xEmail + '\">Email #' + xEmail + '</label>' +
            '</div>' +
            '<div class=\"col s1\">' +
            '<a id=\"remEmail\" class=\"waves-effect waves-light red accent-4 btn-floating\"><i class=\"material-icons left\">mail</i></a>' +
            '</div></div>');
    });

    $(wrapperEmail).on("click", "#remEmail", function (e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
        xEmail--;
        var idEmail = $(this).attr('idemail');
        var idPessoa = $(this).attr('idpessoa');
        var tipo = $(this).attr('tipo');
        $.ajax({
            type: 'POST',
            url: 'control/pessoa.php',
            data: 'idEmail='+idEmail+"&idPessoa="+idPessoa+"&acao=excluirEmail&tipo="+tipo,
            success: function(data) {
                if(data) {
                    console.log('Falha removendo o telefone');
                } else {
                    console.log(idEmail + " " + idPessoa + " " + tipo);
                }
            }
        });
    });

    $('#confirmacaosenha').on("focusin", function() {
        if($('#senha').val().length < 8) {
            $('#senha').val("").focus();
            $('#help-senha').text('Tenha certeza de inserir ao menos 8 dígitos.');
        } else {
            $('#help-senha').text('');
        }
    });
    
    $('#confirmacaosenha').on("focusout", function(){
        if($('#senha').val()!==$('#confirmacaosenha').val()){
            $('#confirmacaosenha').val("");
            $('#senha').val("").focus();
            $('#help-senha').text('Tenha certeza de inserir ao menos 8 dígitos.');
            $('#help-confirmacaosenha').text('As senhas devem ser iguais.');
        } else {
            $('#help-confirmacaosenha').text('');
        }
    });

    setTimeout(function() {
        if($("#msg").length>0) {
            $("#msg").remove();
        }
    }, 3000);

    $("#msg").on("click", "#close", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
    });

    function soNumero(x) {
        var z = document.getElementById(x).value;
        if(/\D/.test(z)) {
            alert("Insira somente números (0-9) no campo " + x);
        }
    }
}); // end of document ready
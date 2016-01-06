$(function(){
    $('input[name=isPessoaFisica]').value('true');
    alert("debug");
    $('#pessoaFisica').show();
    $('#pessoaJuridica').hide();
    $('input[name="tipoPessoa"]').click(function () {
        if ($(this).attr('id')==='pFisica') {
            $('#pessoaFisica').show();
            $('#pessoaJuridica').hide();
            $('input[name=isPessoaFisica]').value('true');
        }

        else {
            $('#pessoaFisica').hide();
            $('#pessoaJuridica').show();
            $('input[name=isPessoaFisica]').value('false');
        }
    });

    var max_fields=9;

    // var wrapperTel=$('#incluirTelefone');
    // var add_buttonTel=$("#addTelefone")
    var wrapperTel=document.getElementById("incluirTelefone");
    var add_buttonTel=document.getElementById("addTelefone");
    var xTel=1;
    $(add_buttonTel).click(function (e) {
        alert(location.hostname);
        e.preventDefault();
        if (xTel<=max_fields) {
            xTel++;
            $(wrapperTel).append('<div>'+
                    '<div class=\"input-field col s5\">'+
            		'<input id=\"telefone\" type=\"text\" class=\"validate\">'+
                    '<label for=\"telefone\">Telefone #' + xTel + '</label>'+
                    '</div>'+
                    '<div class=\"col s1\">'+
            		'<a id=\"remTelefone\" class=\"waves-effect waves-light red accent-4 btn-floating\"><i class=\"material-icons left\">phone</i></a>'+
                    '</div></div>');
        }
    });

    $(wrapperTel).on("click", document.getElementById("remTelefone"), function (e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
        xTel--;
    });

    var wrapperEmail = $('#incluirEmail');
    var add_buttonEmail = $("#addEmail");
    var xEmail = 1;
    $(add_buttonEmail).click(function (e) {
        e.preventDefault();
        if (xEmail <= max_fields) {
            xEmail++;
            $(wrapperEmail).append('<div>' +
                    '<div class=\"input-field col s5\">' +
            		'<input id=\"email\" type=\"text\" class=\"validate\">' +
                    '<label for=\"email\">Email #' + xEmail + '</label>' +
                    '</div>' +
                    '<div class=\"col s1\">' +
            		'<a id=\"remEmail\" class=\"waves-effect waves-light red accent-4 btn-floating\"><i class=\"material-icons left\">mail</i></a>' +
                    '</div></div>');
        }
    });

    $(wrapperEmail).on("click", "#remEmail", function (e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
        xEmail--;
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
    }, 5000);

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
$(function() {
    var request;
    $("#formAcabamento").submit(function(event){
        if (request) {request.abort();}
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            data: serializedData
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#selectAcabamento').empty().append(response);
            $('select').material_select();
            $("#verAcabamentos")[0].click();
            $('#modalAcabamento .cancelar').click();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        request.always(function () {
            $inputs.prop("disabled", false);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .editarAcabamento", function(event) {
        if (request) {request.abort();}
        var idAcabamento = $(this).attr("idAcabamento");
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            dataType: "json",
            data: "acao=getAcabamento&idAcabamento="+idAcabamento
        });
        request.done(function (response, textStatus, jqXHR){
            $("#idAcabamento").val(response.idAcabamento);
            $("#nomeAcabamento").val(response.nome);
            $("#descricaoAcabamento").val(response.descricao);
            $("#descricaoAcabamento").focus();
            $("#localAcabamento").val(response.local);
            $("#localAcabamento").focus();
            $("#valorAcabamento").val(response.valor);
            $("#valorAcabamento").focus();
            $("#nomeAcabamento").focus();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .excluirAcabamento", function(event) {
        if (request) {request.abort();}
        if(confirm("Tem certeza que deseja excluir?")) {
            var idAcabamento = $(this).attr("idAcabamento");
            request = $.ajax({
                url: "control/tipoDeServico.php",
                type: "post",
                data: "acao=excluirAcabamento&idAcabamento="+idAcabamento
            });
            request.done(function (response, textStatus, jqXHR){
                console.log(response);
                $('#selectAcabamento').empty().append(response);
                $('select').material_select();
                $("#verAcabamentos").click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error("The following error occurred: "+textStatus, errorThrown);
            });
        }
        event.preventDefault();
    });

    $("#verAcabamentos").click(function(event){
        if (request) {request.abort();}
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            data: "acao=verAcabamentos"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#listaAcabamentos').empty().append(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });
});
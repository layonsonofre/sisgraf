$(function() {
    var request;
    $("#formCor").submit(function(event){
        if (request) {request.abort();}
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            data: serializedData
        });
        console.log(serializedData);
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#selectCor').empty().append(response);
            $('select').material_select();
            $("#verCores")[0].click();
            $('#modalCor .cancelar').click();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        request.always(function () {
            $inputs.prop("disabled", false);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .editarCor", function(event) {
        if (request) {
            request.abort();
        }
        var idCor = $(this).attr("idCor");
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            dataType: "json",
            data: "acao=getCor&idCor="+idCor
        });
        request.done(function (response, textStatus, jqXHR){
            $("#idCor").val(response.idCor);
            $("#cor").val(response.nome);
            $("#cor").focus();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .excluirCor", function(event) {
        if (request) {
            request.abort();
        }
        if(confirm("Tem certeza que deseja excluir?")) {
            var idCor = $(this).attr("idCor");
            request = $.ajax({
                url: "control/material.php",
                type: "post",
                data: "acao=excluirCor&idCor="+idCor
            });
            request.done(function (response, textStatus, jqXHR){
                console.log(response);
                $('#selectCor').empty().append(response);
                $('select').material_select();
                $("#verUnidades")[0].click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error("The following error occurred: "+textStatus, errorThrown);
            });
        }
        event.preventDefault();
    });

    $("#verCores").click(function(event){
        if (request) {
            request.abort();
        }
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            data: "acao=verCores"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#listaCores').empty().append(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });
});
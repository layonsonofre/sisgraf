$(function() {
    var request;
    $("#formUnidadeDeMedida").submit(function(event){
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
            $('#selectUnidade').empty().append(response);
            $('select').material_select();
            $("#verUnidades")[0].click();
            $('#modalUnidadeDeMedida .cancelar').click();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        request.always(function () {$inputs.prop("disabled", false);});
        event.preventDefault();
    });

    $(document.body).on("click", "table td .editarUnidade", function(event) {
        if (request) {request.abort();}
        var idUnidade = $(this).attr("idUnidade");
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            dataType: "json",
            data: "acao=getUnidade&idUnidade="+idUnidade
        });
        request.done(function (response, textStatus, jqXHR){
            $("#idUnidade").val(response.idUnidade);
            $("#descricaoUnidade").val(response.descricao);
            $("#descricaoUnidade").focus();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .excluirUnidade", function(event) {
        if (request) {request.abort();}
        if(confirm("Tem certeza que deseja excluir?")) {
            var idUnidade = $(this).attr("idUnidade");
            request = $.ajax({
                url: "control/material.php",
                type: "post",
                data: "acao=excluirUnidade&idUnidade="+idCor
            });
            request.done(function (response, textStatus, jqXHR){
                console.log(response);
                $('#selectUnidade').empty().append(response);
                $('select').material_select();
                $("#verCores").click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error("The following error occurred: "+textStatus, errorThrown);
            });
        }
        event.preventDefault();
    });

    $("#verUnidades").click(function(event){
        if (request) {request.abort();}
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            data: "acao=verUnidades"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#listaUnidades').empty().append(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });
});
$(function() {
    var request;
    $("#formGramatura").submit(function(event){
        if (request) {
            request.abort();
        }
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            data: serializedData
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#selectGramatura').empty().append(response);
            $('select').material_select();
            $("#verGramaturas")[0].click();
            $('#modalGramatura .cancelar').click();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        request.always(function () {$inputs.prop("disabled", false);});
        event.preventDefault();
    });

    $(document.body).on("click", "table td .editarGramatura", function(event) {
        if (request) {request.abort();}
        var idGramatura = $(this).attr("idGramatura");
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            dataType: "json",
            data: "acao=getGramatura&idGramatura="+idGramatura
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $("#idGramatura").val(response.idGramatura);
            $("#gramatura").val(response.gramatura);
            $("#gramatura").focus();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .excluirGramatura", function(event) {
        if (request) {request.abort();}
        if(confirm("Tem certeza que deseja excluir?")) {
            var idGramatura = $(this).attr("idGramatura");
            request = $.ajax({
                url: "control/material.php",
                type: "post",
                data: "acao=excluirGramatura&idGramatura="+idGramatura
            });
            request.done(function (response, textStatus, jqXHR){
                console.log(response);
                $('#selectGramatura').empty().append(response);
                $('select').material_select();
                //$('#modalFormato .cancelar').click();
                $("#verGramaturas").click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error("The following error occurred: "+textStatus, errorThrown);
            });
        }
        event.preventDefault();
    });

    $("#verGramaturas").click(function(event){
        if (request) {request.abort();}
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            data: "acao=verGramaturas"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#listaGramaturas').empty().append(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });
});
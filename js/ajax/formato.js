$(function() {
    var request;
    $("#formFormato").submit(function(event){
        if (request) {request.abort();}
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);
        console.log(serializedData);
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            data: serializedData
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#selectFormato').empty().append(response);
            $('select').material_select();
            $("#verFormatos")[0].click();
            $('#modalFormato .cancelar').click();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
        request.always(function () {
            $inputs.prop("disabled", false);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .editarFormato", function(event) {
        if (request) {request.abort();}
        var idFormato = $(this).attr("idFormato");
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            dataType: "json",
            data: "acao=getFormato&idFormatoModal="+idFormato
        });
        request.done(function (response, textStatus, jqXHR){
            $("#idFormatoModal").val(response.idFormato);
            $("#formatoModal").val(response.formato);
            $("#baseFormatoModal").val(response.base);
            $("#baseFormatoModal").focus();
            $("#alturaFormatoModal").val(response.altura);
            $("#alturaFormatoModal").focus();
            $("#valorFormatoModal").val(response.valor);
            $("#valorFormatoModal").focus();
            $("#formatoModal").focus();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .excluirFormato", function(event) {
        if (request) {request.abort();}
        if(confirm("Tem certeza que deseja excluir?")) {
            var idFormato = $(this).attr("idFormato");
            request = $.ajax({
                url: "control/tipoDeServico.php",
                type: "post",
                data: "acao=excluirFormato&idFormatoModal="+idFormato
            });
            request.done(function (response, textStatus, jqXHR){
                console.log(response);
                $('#selectFormato').empty().append(response);
                $('select').material_select();
                //$('#modalFormato .cancelar').click();
                $("#verFormatos").click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error("The following error occurred: "+textStatus, errorThrown);
            });
        }
        event.preventDefault();
    });

    $("#verFormatos").click(function(event){
        if (request) {request.abort();}
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            data: "acao=verFormatos"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#listaFormatos').empty().append(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });
});
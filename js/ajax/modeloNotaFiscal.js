$(function() {
    var request;
    $("#formModeloNotaFiscal").submit(function(event){
        event.preventDefault();
        if (request) {request.abort();}
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);
        console.log(serializedData);
        request = $.ajax({
            url: "control/ordemDeServico.php",
            type: "post",
            data: serializedData
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#selectModeloNotaFiscal').empty().append(response);
            $('select').material_select();
            $("#verModelos")[0].click();
            $('#modalModeloNotaFiscal .cancelar').click();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        request.always(function () {
            $inputs.prop("disabled", false);
        });
    });

    $(document.body).on("click", "table td .editarModelo", function(event) {
        if (request) {request.abort();}
        var idModelo = $(this).attr("idModelo");
        request = $.ajax({
            url: "control/ordemDeServico.php",
            type: "post",
            dataType: "json",
            data: "acao=getModelo&idModeloModal="+idModelo
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $("#idModeloModal").val(response.idModelo);
            $("#modeloNotaModal").val(response.modeloNota);
            $("#descricaoNotaModal").val(response.descricaoNota);
            $("#descricaoNotaModal").focus();
            $("#valorNotaModal").val(response.valorNota);
            $("#valorNotaModal").focus();
            $("#modeloNotaModal").focus();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .excluirModelo", function(event) {
        if (request) {request.abort();}
        if(confirm("Tem certeza que deseja excluir?")) {
            var idModelo = $(this).attr("idModelo");
            request = $.ajax({
                url: "control/ordemDeServico.php",
                type: "post",
                data: "acao=excluirModelo&idModeloModal="+idModelo
            });
            request.done(function (response, textStatus, jqXHR){
                console.log(response);
                $('#selectModeloNotaFiscal').empty().append(response);
                $('select').material_select();
                //$('#modalFormato .cancelar').click();
                $("#verModelos").click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error("The following error occurred: "+textStatus, errorThrown);
            });
        }
        event.preventDefault();
    });

    $("#verModelos").click(function(event){
        if (request) {request.abort();}
        request = $.ajax({
            url: "control/ordemDeServico.php",
            type: "post",
            data: "acao=verModelos"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#listaModelos').empty().append(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });
});
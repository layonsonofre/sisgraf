$(function() {
    var request;
    $("#formQuantidadeCores").submit(function(event){
        event.preventDefault();
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
            $('#selectQuantidadeCores').empty().append(response);
            $('select').material_select();
            $("#verQC")[0].click();
            $('#modalQuantidadeCores .cancelar').click();
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
    });

    $(document.body).on("click", "table td .editarQC", function(event) {
        if (request) {request.abort();}
        var idQC = $(this).attr("idQC");
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            dataType: "json",
            data: "acao=getQC&idQC="+idQC
        });
        request.done(function (response, textStatus, jqXHR){
            $("#idQC").val(response.idQC);
            $("#descricaoQC").val(response.descricaoQC);
            $("#descricaoQC").focus();
            $("#valorQC").val(response.valorQC);
            $("#valorQC").focus();
            $("#formatoModal").focus();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .excluirQC", function(event) {
        if (request) {request.abort();}
        if(confirm("Tem certeza que deseja excluir?")) {
            var idQC = $(this).attr("idQC");
            request = $.ajax({
                url: "control/tipoDeServico.php",
                type: "post",
                data: "acao=excluirQC&idQC="+idQC
            });
            request.done(function (response, textStatus, jqXHR){
                console.log(response);
                $('#selectQuantidadeCores').empty().append(response);
                $('select').material_select();
                //$('#modalFormato .cancelar').click();
                $("#verQC").click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error("The following error occurred: "+textStatus, errorThrown);
            });
        }
        event.preventDefault();
    });

    $("#verQC").click(function(event){
        if (request) {request.abort();}
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            data: "acao=verQC"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#listaQC').empty().append(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });
});
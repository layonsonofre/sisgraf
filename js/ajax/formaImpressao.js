$(function() {
    var request;
    $("#formFormaImpressao").submit(function(event){
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
            $('#selectFormaImpressao').empty().append(response);
            $('select').material_select();
            $("#verFI")[0].click();
            $('#modalFormaImpressao .cancelar').click();
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

    $(document.body).on("click", "table td .editarFI", function(event) {
        if (request) {request.abort();}
        var idFI = $(this).attr("idFI");
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            dataType: "json",
            data: "acao=getFI&idFI="+idFI
        });
        request.done(function (response, textStatus, jqXHR){
            $("#idFI").val(response.idFI);
            $("#nomeFI").val(response.nomeFI);
            $("#descricaoFI").val(response.descricaoFI);
            $("#descricaoFI").focus();
            $("#valorFI").val(response.valorFI);
            $("#valorFI").focus();
            $("#nomeFI").focus();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .excluirFI", function(event) {
        if (request) {request.abort();}
        if(confirm("Tem certeza que deseja excluir?")) {
            var idFI = $(this).attr("idFI");
            request = $.ajax({
                url: "control/tipoDeServico.php",
                type: "post",
                data: "acao=excluirFI&idFI="+idFI
            });
            request.done(function (response, textStatus, jqXHR){
                console.log(response);
                $('#selectFormaImpressao').empty().append(response);
                $('select').material_select();
                //$('#modalFormato .cancelar').click();
                $("#verFI").click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error("The following error occurred: "+textStatus, errorThrown);
            });
        }
        event.preventDefault();
    });

    $("#verFI").click(function(event){
        if (request) {request.abort();}
        request = $.ajax({
            url: "control/tipoDeServico.php",
            type: "post",
            data: "acao=verFI"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#listaFI').empty().append(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });
});
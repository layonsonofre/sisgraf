$(function() {
    var request;
    $("#formCategoria").submit(function(event){
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
            $('#selectCategoria').empty().append(response);
            $('select').material_select();
            $("#verCategorias")[0].click();
            $('#modalCategoria .cancelar').click();
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

    $(document.body).on("click", "table td .editarCategoria", function(event) {
        if (request) { request.abort(); }
        var idCategoria = $(this).attr("idCategoria");
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            dataType: "json",
            data: "acao=getCategoria&idCategoria="+idCategoria
        });
        request.done(function (response, textStatus, jqXHR){
            $("#idCategoria").val(response.idCategoria);
            $("#nomeCategoria").val(response.nome);
            $("#descricaoCategoria").val(response.descricao);
            $("#descricaoCategoria").focus();
            $("#nomeCategoria").focus();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });

    $(document.body).on("click", "table td .excluirCategoria", function(event) {
        if (request) { request.abort(); }
        if(confirm("Tem certeza que deseja excluir?")) {
            var idCategoria = $(this).attr("idCategoria");
            request = $.ajax({
                url: "control/material.php",
                type: "post",
                data: "acao=excluirCategoria&idCategoria="+idCategoria
            });
            request.done(function (response, textStatus, jqXHR){
                console.log(response);
                $('#selectCategoria').empty().append(response);
                $('#categoria').empty().append(response);
                $('select').material_select();
                $("#verCategorias").click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error("The following error occurred: "+textStatus, errorThrown);
            });
        }
        event.preventDefault();
    });

    $("#verCategorias").click(function(event){
        if (request) { request.abort(); }
        request = $.ajax({
            url: "control/material.php",
            type: "post",
            data: "acao=verCategorias"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#listaCategorias').empty().append(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error("The following error occurred: "+textStatus, errorThrown);
        });
        event.preventDefault();
    });
});
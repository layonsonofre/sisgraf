$(function() {
    $("#selectTipoServico").change(function(event){
        var request;
        if (request) {
            request.abort();
        }
        var temp = $(this).children("option").filter(":selected");
        var idTS = temp.val();
        var descricao = temp.text();
        request = $.ajax({
            url: "control/ordemDeServico.php",
            type: "post",
            data: "idTS=" + idTS + "&acao=listarAcabamentosOS"
        });
        request.done(function (response, textStatus, jqXHR){
            $('#selectAcabamento').empty().append(response);
            $('#selectAcabamento').material_select();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
        request = $.ajax({
            url: "control/ordemDeServico.php",
            type: "post",
            data: "idTS=" + idTS + "&acao=listarFormatosOS"
        });
        request.done(function (response, textStatus, jqXHR){
            $('#selectFormato1').empty().append(response);
            $('#selectFormato1').material_select();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });

        request = $.ajax({
            url: "control/ordemDeServico.php",
            type: "post",
            data: "idTS=" + idTS + "&acao=listarPapeisOS"
        });
        request.done(function (response, textStatus, jqXHR){
            $('#selectPapel').empty().append(response);
            $('#selectPapel').material_select();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
        request.always(function () {
        });
        event.preventDefault();
    });
    
    $(document).on("click", "#cancelar", function(event) {
        var request;
        if (request) {
            request.abort();
        }
        var idOS = $("#idOS").val();
        if(confirm('Tem certeza que deseja excluir esta Ordem de Serviço?')) {
            if(idOS === '') {
                window.location.replace("index.php");
            } else {
                request = $.ajax({
                    url: "control/ordemDeServico.php",
                    type: "post",
                    data: "acao=cancelar&idOS="+idOS
                });
                request.done(function (response, textStatus, jqXHR) {
                    console.log(response);
                    window.location.replace("incluirOS.php");
                });
                request.fail(function (jqXHR, textStatus, errorThrown){
                    console.error(
                        "The following error occurred: "+
                        textStatus, errorThrown
                    );
                });
            }
        }
    });

    $(document).on("click", "#salvar", function(event) {
        event.preventDefault();
        var request;
        if (request) {
            request.abort();
        }
        var idOS = $("#idOS").val();
        if(idOS === '') {
            alert("Erro ao tentar salvar as alterações. Por favor, tente novamente.");
        } else {
            var $form = $("#formOS");
            // Let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");
            // Serialize the data in the form
            var serializedData = $form.serialize();
            request = $.ajax({
                url: "control/ordemDeServico.php",
                type: "POST",
                data: serializedData + "&acao=salvar"
            });
            request.done(function (response, textStatus, jqXHR) {
                console.log(response);
                window.location.replace("incluirOS.php?idOS="+idOS);
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            });
        }
    });
    
    $(document).on("click", "#arquivo", function(event) {
        // var idOS = $("#idOS").val();
        // $("#incluirArquivo").attr("href", "incluirArquivo.php?idOS=" + idOS);
        // console.log($("#incluirArquivo").attr("href"));
        // $("#incluirArquivo")[0].click();
        event.preventDefault();
        var request;
        if (request) {
            request.abort();
        }
        var idOS = $("#idOS").val();
        if(idOS === '') {
            alert("Erro ao tentar salvar as alterações. Por favor, tente novamente.");
        } else {
            request = $.ajax({
                url: "control/ordemDeServico.php",
                type: "POST",
                data: "acao=listarArquivos&idOS="+idOS
            });
            request.done(function (response, textStatus, jqXHR) {
                console.log(response);
                $("#arquivos").empty().append(response);
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            });
        }
    })
});
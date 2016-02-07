$(function() {
    // Variable to hold request
    var request;
    $("#buscarPessoa").submit(function(event){
        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var $form = $(this);
        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");
        // Serialize the data in the form
        var serializedData = $form.serialize();
        console.log(serializedData);
        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);
        // Fire off the request to /form.php
        request = $.ajax({
            url: "control/pessoa.php",
            type: "post",
            data: serializedData
        });
        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            //console.log("Hooray, it worked!");
            console.log(response);
            $('#resultadoBuscaPessoa').empty().append(response);
        });
        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });
        // Prevent default posting of form
        event.preventDefault();
    });

    $(document).on("click", "#remover",function(event) {
        var request;
        if (request) {
            request.abort();
        }
        var idMaterial = $(this).attr('idPessoa');
        if(confirm('Tem certeza que deseja excluir esta pessoa?')) {
            request = $.ajax({
                url: "control/pessoa.php",
                type: "post",
                data: "acao=excluir&idPessoa="+idPessoa
            });
            request.done(function (response, textStatus, jqXHR) {
                console.log(response);
                $("#buscarPessoa")[0].click();
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            });
        }
        event.preventDefault();
    });
});
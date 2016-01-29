/*$(function() {
    $(document).on('change', '#selectTipoServico', function(event) {
        var idTS = $(this).val();
        alert('oi');
    });
});*/

// Variable to hold request
var request;
$("#selectTipoServico").change(function(event){
    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var temp = $(this).children("option").filter(":selected");
    var idTS = temp.val();
    var descricao = temp.text();
    // var idTS = $(this).val();
    // Let's select and cache all the fields
    // var $inputs = $form.find("input, select, button, textarea");
    // Serialize the data in the form
    // var serializedData = $form.serialize();
    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    // $inputs.prop("disabled", true);
    // Fire off the request to /form.php
    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "idTS=" + idTS + "&acao=listarAcabamentosOS"
    });
    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        //console.log("Hooray, it worked!");
        $('#selectAcabamento').empty().append(response);
        $('#selectAcabamento').material_select();
        // $('#modalAcabamento a').click();
    });
    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
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
        console.log(response);
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
        console.log(response);
        $('#selectPapel').empty().append(response);
        $('#selectPapel').material_select();
    });
    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });
    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        //$inputs.prop("disabled", false);
    });
    // Prevent default posting of form
    event.preventDefault();
});
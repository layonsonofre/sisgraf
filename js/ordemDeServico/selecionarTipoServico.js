$("#servico").hide();
var prevElement = '';
$("#selecionarTipo").click(function(event){
    var element = event.target;
    if(element.id === prevElement.id) {
        $("#servico").toggle();
    } else {
        $("#servico").show();
        prevElement = event.target;
    }

    $("#detalhesServico").show("slow");
    $("#fornecedor").hide("slow");
    $("#detalhesNota").hide("slow");
    if(element.id === 'diverso') {
        $("#titulo").text("Adicionar Diverso");
        
        $("#diverso").toggleClass("amber");
        $("#externo").removeClass("amber");
        $("#nota").removeClass("amber");
        $("#carimbo").removeClass("amber");

    } else if(element.id === 'externo') {
        $("#titulo").text("Adicionar Externo");
        $("#fornecedor").show();

        $("#diverso").removeClass("amber");
        $("#externo").toggleClass("amber");
        $("#nota").removeClass("amber");
        $("#carimbo").removeClass("amber");
    } if(element.id === 'nota') {
        $("#titulo").text("Adicionar Nota Fiscal");
        $("#detalhesNota").show("slow");

        $("#diverso").removeClass("amber");
        $("#externo").removeClass("amber");
        $("#nota").toggleClass("amber");
        $("#carimbo").removeClass("amber");
    } else if(element.id === 'carimbo') {
        $("#titulo").text("Adicionar Carimbo");
        $("#detalhesServico").hide();

        $("#diverso").removeClass("amber");
        $("#externo").removeClass("amber");
        $("#nota").removeClass("amber");
        $("#carimbo").toggleClass("amber");
    }

    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "acao=add" + element.id
    });
    request.done(function (response, textStatus, jqXHR) {
        $("#selectTipoServico").empty().append(response);
        $('select').material_select();
    });
});
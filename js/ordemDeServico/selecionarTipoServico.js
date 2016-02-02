$("#servico").hide();
var prevElement = '';
$("#selecionarTipo").click(function(event){
    var element = event.target;
    if(element.id === prevElement.id) {
        $("#servico").toggle();
    } else {
        $("#servico").show("slow");
        prevElement = event.target;
    }

    $("#detalhesServico").show("slow");
    $("#fornecedor").hide("slow");
    $("#detalhesNota").hide("slow");
    $("#baseTipoServico").show("slow");
    
    if(element.id === 'diverso') {
        $("#titulo").text("Adicionar Diverso");
        $("#tipo").val('diverso');

        $("#detalhesNota").hide("slow");
        $("#baseTipoServico").show("slow");
        $("#tipoServico_quantidade").show("slow");
        $("#formato_acabamento").show("slow");
        $("#material_vias").hide("slow");

        $("#diverso").toggleClass("amber");
        $("#externo").removeClass("amber");
        $("#nota").removeClass("amber");
        $("#carimbo").removeClass("amber");

    } else if(element.id === 'externo') {
        $("#titulo").text("Adicionar Externo");
        $("#tipo").val('externo');
        $("#baseTipoServico").show("slow");
        $("#tipoServico_quantidade").show("slow");
        $("#formato_acabamento").show("slow");
        $("#fornecedor").show();
        $("#detalhesNota").hide("slow");
        $("#material_vias").hide("slow");

        $("#diverso").removeClass("amber");
        $("#externo").toggleClass("amber");
        $("#nota").removeClass("amber");
        $("#carimbo").removeClass("amber");
    } if(element.id === 'nota') {
        $("#titulo").text("Adicionar Nota Fiscal");
        $('#tipo').val('nota');
        $("#detalhesNota").show("slow");
        $("#baseTipoServico").hide("slow");
        $("#tipoServico_quantidade").hide("slow");
        $("#formato_acabamento").hide("slow");
        $("#material_vias").show("slow");

        $("#diverso").removeClass("amber");
        $("#externo").removeClass("amber");
        $("#nota").toggleClass("amber");
        $("#carimbo").removeClass("amber");
    } else if(element.id === 'carimbo') {
        $("#titulo").text("Adicionar Carimbo");
        $("#tipo").val('carimbo');
        $("#detalhesServico").hide("slow");
        $("#detalhesNota").hide("slow");
        $("#baseTipoServico").hide("slow");
        $("#tipoServico_quantidade").show("slow");
        $("#formato_acabamento").hide("slow");
        $("#material_vias").hide("slow");

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
    request.done(function (response, textStatus, jqXHR){
        $("#selectTipoServico").empty().append(response);
        $('#selectTipoServico').material_select();
    });
});
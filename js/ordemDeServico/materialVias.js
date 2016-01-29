$("#material_vias1").hide();
$("#material_vias2").hide();
$("#material_vias3").hide();
$("#material_vias4").hide();
$("#selectVias").change(function(event){
    var temp = $(this).children("option").filter(":selected");
    var quantidade = temp.text();
    if(/^1/.test(quantidade)) {
        $("#material_vias1").show("slow");
        $("#material_vias2").hide("slow");
        $("#material_vias3").hide("slow");
        $("#material_vias4").hide("slow");
    } else if(/^2/.test(quantidade)) {
        $("#material_vias1").show("slow");
        $("#material_vias2").show("slow");
        $("#material_vias3").hide("slow");
        $("#material_vias4").hide("slow");
    } else if(/^3/.test(quantidade)) {
        $("#material_vias1").show("slow");
        $("#material_vias2").show("slow");
        $("#material_vias3").show("slow");
        $("#material_vias4").hide("slow");
    } else if(/^4/.test(quantidade)) {
        $("#material_vias1").show("slow");
        $("#material_vias2").show("slow");
        $("#material_vias3").show("slow");
        $("#material_vias4").show("slow");
    }
    $("#selectVias").material_select();
});

$("#papel1").change(function(event) {
    var temp = $(this).children("option").filter(":selected");
    var idMaterial = temp.val();
    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "acao=papel1_gramatura&idMaterial="+idMaterial
    });
    request.done(function (response, textStatus, jqXHR) {
        $("#gramatura1").empty().append(response);
        $('#gramatura1').material_select();
    });
    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "acao=papel1_cor&idMaterial="+idMaterial
    });
    request.done(function (response, textStatus, jqXHR){
        $("#cor1").empty().append(response);
        $('#cor1').material_select();
    });
});

$("#papel2").change(function(event) {
    var temp = $(this).children("option").filter(":selected");
    var idMaterial = temp.val();
    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "acao=papel2_gramatura&idMaterial="+idMaterial
    });
    request.done(function (response, textStatus, jqXHR) {
        $("#gramatura2").empty().append(response);
        $('#gramatura2').material_select();
    });
    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "acao=papel2_cor&idMaterial="+idMaterial
    });
    request.done(function (response, textStatus, jqXHR){
        $("#cor2").empty().append(response);
        $('#cor2').material_select();
    });
});
$("#papel3").change(function(event) {
    var temp = $(this).children("option").filter(":selected");
    var idMaterial = temp.val();
    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "acao=papel3_gramatura&idMaterial="+idMaterial
    });
    request.done(function (response, textStatus, jqXHR) {
        $("#gramatura3").empty().append(response);
        $('#gramatura3').material_select();
    });
    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "acao=papel3_cor&idMaterial="+idMaterial
    });
    request.done(function (response, textStatus, jqXHR){
        $("#cor3").empty().append(response);
        $('#cor3').material_select();
    });
});
$("#papel4").change(function(event) {
    var temp = $(this).children("option").filter(":selected");
    var idMaterial = temp.val();
    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "acao=papel4_gramatura&idMaterial="+idMaterial
    });
    request.done(function (response, textStatus, jqXHR){
        $("#gramatura4").empty().append(response);
        $('#gramatura4').material_select();
    });
    request = $.ajax({
        url: "control/ordemDeServico.php",
        type: "post",
        data: "acao=papel4_cor&idMaterial="+idMaterial
    });
    request.done(function (response, textStatus, jqXHR){
        $("#cor4").empty().append(response);
        $('#cor4').material_select();
    });
});
$("#cores").hide();
$("#selectQuantidadeCores").change(function(event){
    $("#cores").show();
    $("#cf1").prop("disabled", true);
    $("#cf2").prop("disabled", true);
    $("#cf3").prop("disabled", true);
    $("#cv1").prop("disabled", true);
    $("#cv2").prop("disabled", true);
    $("#cv3").prop("disabled", true);
    var temp = $(this).children("option").filter(":selected");
    var quantidade = temp.text();
    if(/^1/.test(quantidade)) {
        $("#cf1").prop("disabled", false);
    } else if(/^2/.test(quantidade)) {
        $("#cf1").prop("disabled", false);
        $("#cf2").prop("disabled", false);
    } else if(/^3/.test(quantidade)) {
        $("#cf1").prop("disabled", false);
        $("#cf2").prop("disabled", false);
        $("#cf3").prop("disabled", false);
    }
    if(/1$/.test(quantidade)) {
        $("#cv1").prop("disabled", false);
    } else if(/2$/.test(quantidade)) {
        $("#cv1").prop("disabled", false);
        $("#cv2").prop("disabled", false);
    } else if(/3$/.test(quantidade)) {
        $("#cv1").prop("disabled", false);
        $("#cv2").prop("disabled", false);
        $("#cv3").prop("disabled", false);
    }
    $("select").material_select();
});
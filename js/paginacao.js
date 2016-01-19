$(function() {
	$(document).on('click', '.paginacao', function(event) {
	    event.preventDefault();
	    var pagina = $(this).attr("pagina");
	    $("#pagina").attr("value", pagina);    
	    $("form:eq(0)").submit();
	});
});
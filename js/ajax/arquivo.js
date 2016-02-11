$(function() {
	var wrapperModelo=$("#arquivoModelo");
    var add_buttonModelo=$("#addModelo");
    var xModelo=1;
    $(add_buttonModelo).click(function (e) {
        e.preventDefault();
        xModelo++;
        $(wrapperModelo).append('' +
        	'<div class="row">' +
                '<div class="input-field col s8">' +
                    '<input name="urlModeloNovo[]" id="urlModeloNovo'+xModelo+'" type="text" class="validate" length="256" maxlength="256">' +
                    '<label for="urlModeloNovo'+xModelo+'">Local</label>' +
                '</div>' +
                '<div class="input-field col s3">' +
                    '<select name="statusNovo[]" id="status'+xModelo+'">' +
                        '<option value="desenvolvimento" selected>Desenvolvimento</option>' +
                        '<option value="aguardando">Aguardando Cliente</option>' +
                        '<option value="aprovado">Aprovado</option>' +
                    '</select>' +
                    '<label>Status</label>' +
                '</div>' +
                '<div class="col s1">' +
                    '<a id="remModelo" class="waves-effect waves-light red accent-4 btn-floating"><i class="material-icons left">delete</i></a>' +
                '</div>' +
            '</div>' +
            '<script>$("#status'+xModelo+'").material_select();</script>'
    	);
	});

    $(wrapperModelo).on("click", "#remModelo", function (e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
        xModelo--;
        var idModelo = $(this).attr('idArquivoModelo');
        var idArquivo = $(this).attr('idArquivo');
        var request;
        request = $.ajax({
            type: 'POST',
            url: 'control/arquivo.php',
            data: 'idArquivoModelo='+idModelo+"&idArquivo="+idArquivo+"&acao=excluirModelo"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
        });
    });


    var wrapperMatriz=$("#arquivoMatriz");
    var add_buttonMatriz=$("#addMatriz");
    var xMatriz=1;
    $(add_buttonMatriz).click(function (e) {
        e.preventDefault();
        xMatriz++;
        $(wrapperMatriz).append("" +
        	"<div class='row'>" +
                "<div class='input-field col s3'>" +
                    "<input name='idChapaAntiga[]' id='idChapa"+xMatriz+"' type='text' class='validate right-align' data-mask='9?999999' >" +
                    "<label for='idChapa' class='active'>Nº da Chapa</label>" +
                "</div>" +
                "<div class='input-field col s6'>" +
                    "<input name='urlMatrizAntiga[]' id='urlMatriz"+xMatriz+"' type='text' class='validate' length='256' maxlength='256'>" +
                    "<label for='urlMatriz{$temp['idChapa']}' class='active'>Local Armazenamento</label>" +
                "</div>" +
                "<div class='input-field col s2'>" +
                    "<input name='utilizacoesAntiga[]' id='utilizacoes"+xMatriz+"' type='text' class='validate right-align' data-mask='9?999999'>" +
                    "<label for='utilizacoes"+xMatriz+"' class='active'>Utilizações</label>" +
                "</div>" +
                "<div class='col s1'>" +
                    "<a id='remMatriz' class='waves-effect waves-light red accent-4 btn-floating'><i class='material-icons left'>delete</i></a>" +
                "</div>" +
            "</div>"
        );
	});

    $(wrapperMatriz).on("click", "#remMatriz", function (e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
        xMatriz--;
        var idMatriz = $(this).attr('idArquivoMatriz');
        var idArquivo = $(this).attr('idArquivo');
        var request;
        request = $.ajax({
            type: 'POST',
            url: 'control/arquivo.php',
            data: 'idArquivoMatriz='+idMatriz+"&idArquivo="+idArquivo+"&acao=excluirMatriz"
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
        });
    });

    $("#detalhesOS").click(function(e) {
    	var idOS = $("#selectOrdemDeServico").val();
        if(idOS === null) {
    	   $(this).attr("href", "incluirOS.php");
        }
        else {
            $(this).attr("href", "incluirOS.php?idOS=" + idOS);
        }
    });

	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#thumbModeloNovo').attr('src', e.target.result);
	            $('#thumbModeloNovoTitulo').text(e.name);
	        };
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(".modelo").change(function(){
	    readURL(this);
	});
});
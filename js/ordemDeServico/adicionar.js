$(function() {

	var mostrar = function() {
		var request;
		if (request) {
			request.abort();
		}
		var temp = $("#idOS").val();
		if(temp === '') {
			temp = -1;
		}
		var $form = $("#formOS");
		var $inputs = $form.find("input, select, button, textarea");
		$inputs.prop("disabled", true);
		request = $.ajax({
			url: "control/ordemDeServico.php",
			type: "post",
			data: "acao=listarServicos"
		});
		request.done(function (response, textStatus, jqXHR){
			console.log(response);
			$('#items').empty().append(response);
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
	};

	$(document).on("click", "#mostrar", function(event) {
		mostrar();
	});

	$(document).on("click", "#adicionar",function(event) {
		var request;
		if (request) {
			request.abort();
		}
		$("#acao").val('adicionar');
		var $form = $("#formOS");
		var $inputs = $form.find("input, select, button, textarea");
		var serializedData = $form.serialize();
		$inputs.prop("disabled", true);

		request = $.ajax({
			url: "control/ordemDeServico.php",
			type: "post",
			data: serializedData
		});
		request.done(function (response, textStatus, jqXHR){
			console.log(response);
			//$('#items').empty().append(response);
			$("#idOS").val(response);
			mostrar();
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
	    if($("#primeiraVez").val() === "1") {
			$("#primeiraVez").val('0');
		}
	    event.preventDefault();
	    // setTimeout(function(){
	    // 	location.reload();
	    // }, 002);
	});

	$(document).on("click", "#remover",function(event) {
		var request;
		if (request) {
			request.abort();
		}
		var idOS = $(this).attr('idOS');
		var idTS = $(this).attr('idTS');
		if(confirm('Tem certeza que deseja excluir este produto desta Ordem de Serviço?')) {
			request = $.ajax({
				url: "control/ordemDeServico.php",
				type: "post",
				data: "acao=removerProduto&idOS="+idOS+"&idTS="+idTS
			});
			request.done(function (response, textStatus, jqXHR) {
				console.log(response);
				mostrar();
			});
			request.fail(function (jqXHR, textStatus, errorThrown){
		        console.error(
		            "The following error occurred: "+
		            textStatus, errorThrown
		        );
		    });
		}
		//var $form = $("#formOS");
		//var $inputs = $form.find("input, select, button, textarea");
		//var serializedData = $form.serialize();
		//$inputs.prop("disabled", true);

		// request = $.ajax({
		// 	url: "control/ordemDeServico.php",
		// 	type: "post",
		// 	data: serializedData
		// });
		// request.done(function (response, textStatus, jqXHR){
		// 	console.log(response);
		// 	//$('#items').empty().append(response);
		// 	mostrar();
		// });
		// request.fail(function (jqXHR, textStatus, errorThrown){
	 //        console.error(
	 //            "The following error occurred: "+
	 //            textStatus, errorThrown
	 //        );
	 //    });
	 //    request.always(function () {
	 //        $inputs.prop("disabled", false);
	 //    });
	 //    event.preventDefault();
	});
});
$(document).ready(function($){
    $('.button-collapse').sideNav('show');
	$(".dropdown-button").dropdown();
    $('.parallax').parallax();
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
    $('select').material_select();
    //$('input#usuario').setFocus();
    $('.tooltipped').tooltip({delay: 50});
    $('.datepicker').pickadate({
    	selectMonths: true,
    	selectYears: 5
    });
}); // end of jQuery name space
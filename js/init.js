$(document).ready(function($){
    $('.button-collapse').sideNav('show');
	$(".dropdown-button").dropdown();
    $('.parallax').parallax();
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
    $('select').material_select();
    //$('input#usuario').setFocus();
}); // end of jQuery name space
$(document).ready(function($){
    $('.button-collapse').sideNav("show");
	$('.dropdown-button').dropdown();
    $('.parallax').parallax();
    $('.modal-trigger').leanModal();
    $('select').material_select();
    $('.tooltipped').tooltip({delay: 50});
    $('.datepicker').pickadate({
    	selectMonths: true,
    	selectYears: 5
    });
});
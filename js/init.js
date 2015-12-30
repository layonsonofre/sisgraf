(function($){
  $(function(){

    $('.button-collapse').sideNav('show');

	$(".dropdown-button").dropdown();
        
    $('.parallax').parallax();
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();

    $('select').material_select();

  }); // end of document ready
})(jQuery); // end of jQuery name space
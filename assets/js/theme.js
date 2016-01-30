jQuery( document ).ready( function($) {

	/* === FitVids === */
	$('#content,.entry-content,.entry-summary,.widget').fitVids();

	/* === Menu Toggle === */
	$( "#menu-toggle-primary a" ).click( function(e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$( "#menu-primary" ).fadeToggle();
	});

});
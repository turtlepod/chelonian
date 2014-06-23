jQuery( document ).ready( function($) {
	/* Menu */
	$( "#menu-toggle-primary a" ).click( function(e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$( "#menu-primary" ).fadeToggle();
	});
});
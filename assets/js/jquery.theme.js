jQuery( document ).ready( function($) {

	/* === FitVids === */
	$('#content,.entry-content,.entry-summary,.widget').fitVids();

	/* === Accessibility === */

	/* == Mobile Browser Detection == */

	/* = Using Mobile = */
	if( navigator.userAgent.match(/Mobile/i)
		|| navigator.userAgent.match(/Android/i)
		|| navigator.userAgent.match(/Silk/i)
		|| navigator.userAgent.match(/Kindle/i)
		|| navigator.userAgent.match(/BlackBerry/i)
		|| navigator.userAgent.match(/Opera Mini/i)
		|| navigator.userAgent.match(/Opera Mobi/i) ){
		$("body").removeClass("wp-is-not-mobile").addClass("wp-is-mobile");
	}
	/* = Using desktop = */
	else {
		$( "body" ).removeClass( "wp-is-mobile" ).addClass( "wp-is-not-mobile" );
	}

	/* === Menu Toggle === */
	$( ".menu-toggle a" ).click( function(e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$( "#menu-primary" ).fadeToggle();
	});

});
( function( $ ) {

	/* Primary Color */
	wp.customize( 'color_primary', function( value ) {
		value.bind( function( to ) {
			var color_primary = '';
			color_primary += 'a{color:' +  to + '}';
			color_primary += ".button, button, input[type='button'], input[type='reset'], input[type='submit'],a.comments-link,span.comments-link a,#comments .comment-meta,#reply-title,.navigation.pagination .page-numbers{ background:" +  to + "}";
			color_primary += '#header{ background:' +  to + '}';
			color_primary += '.menu-container li a .menu-item-wrap{ background:' +  to + '}';
			color_primary += '.singular.entry-title, .entry-title a{ background:' +  to + '}';
			$( '#chelonian-color-primary-css' ).html( color_primary );
		} );
	} );

	/* Secondary Color */
	wp.customize( 'color_secondary', function( value ) {
		value.bind( function( to ) {
			var color_secondary = '';
			color_secondary += '.entry-byline .entry-author a:hover { color:' +  to + '}';
			color_secondary += ".button:hover, button:hover, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover,#menu-toggle-primary a.active,#menu-toggle-primary a:hover,a.comments-link:hover,span.comments-link a:hover,#comments .comment-reply-link:hover,#respond #cancel-comment-reply-link:hover,.navigation.pagination a.page-numbers:hover{ background:" +  to + "}";
			color_secondary += '.menu-container,.menu-container li a{ border-color:' +  to + '}';
			color_secondary += '.entry-title a:hover{ background:' +  to + '}';
			color_secondary += '.entry-byline .entry-date a:hover, .entry-byline .entry-date a:focus{ color:' +  to + '}';
			$( '#chelonian-color-secondary-css' ).html( color_secondary );
		} );
	} );

	/* Subsidiary Color */
	wp.customize( 'color_subsidiary', function( value ) {
		value.bind( function( to ) {
			var color_subsidiary = '';
			color_subsidiary += '::selection{ background:' +  to + '}';
			color_subsidiary += '::-moz-selection { background:' +  to + '}';
			color_subsidiary += '#landing-page-description a.button:hover{ border-color:' +  to + '}';
			color_subsidiary += 'header h1 strong,#landing-page-description a.button:hover,#menu-toggle-primary a:before,.menu-container li a:hover:after,.sticky .entry-title a:before{ color:' +  to + '}';
			$( '#chelonian-color-subsidiary-css' ).html( color_subsidiary );
		} );
	} );

} )( jQuery );

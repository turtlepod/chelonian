<?php
/**
 * Text String / Translatable string used in tamatebako
 * @since 0.1.0
 */
function tamatebako_string( $context ){

	/* Open Sesame ! */
	$text = array();

	/* Paged Title Tag
	 * Translators: 1 is the page title and separator. 2 is the page number.
	 * Example Output: "{post title} | Page {page number}"
	 */
	$text['paged'] = _x( '%1$s Page %2$s', 'paged title tag', 'chelonian' );

	/* Skip to content (accessibility) */
	$text['skip-to-content'] = _x( 'Skip to content', 'skip to content (accessibility)', 'chelonian' );

	/* Read More */
	$text['read-more'] = _x( 'Read more&hellip;', 'read more', 'chelonian' );

	/* Entry Permalink */
	$text['permalink'] = '';

	/* Next, Previous */
	$text['next'] = _x( 'Next', 'next in pagination and navigation (accessibility)', 'chelonian' );
	$text['previous'] = _x( 'Previous', 'previous in pagination and navigation (accessibility)', 'chelonian' );

	/* Search */
	$text['search'] = '';
	$text['search-button'] = '';
	$text['expand-search-form'] = '';

	/* Comments error */
	$text['comments-closed-pings-open'] = _x( 'Comments are closed, but trackbacks and pingbacks are open.', 'comments notice', 'chelonian' );
	$text['comments-closed'] = _x( 'Comments are closed.', 'comments notice', 'chelonian' );

	/* Content error */
	$text['error'] = _x( '404 Not Found', '404 title', 'chelonian' );
	$text['error-msg'] = _x( 'Apologies, but no entries were found.', '404 content', 'chelonian' );

	/* Theme Layout */
	$text['global-layout'] = '';
	$text['layout'] = '';

	$text = apply_filters( 'tamatebako_string', $text );

	/* Close Sesame ! */
	if ( isset( $text[$context] ) ){
		return $text[$context];
	}
	return '';
}


/**
 * Text String / Translatable string used in this theme
 * To keep track on language usage and separate from Hybrid Core.
 * @since 0.1.0
 */
function chelonian_string( $context ){

	/* Open Sesame ! */
	$text = array();

	/* Register Menus */
	$text['menu-primary-name'] = _x( 'Navigation', 'nav menu location', 'chelonian' );

	/* Register Sidebar */
	$text['sidebar-primary-name'] = _x( 'Sidebar', 'sidebar name', 'chelonian' );

	/* Read More + Comment Link */
	$text['read-more'] = _x( 'Read more&hellip;', 'read more', 'chelonian' );
	$text['comment'] = _x( 'Comment', 'comment link', 'chelonian' );
	$text['comments'] = _x( 'Comments', 'comment link', 'chelonian' );

	/* Customizer Option */
	$text['primary-color'] = _x( 'Primary Color', 'customizer option', 'chelonian' );
	$text['secondary-color'] = _x( 'Hover Color', 'customizer option', 'chelonian' );
	$text['subsidiary-color'] = _x( 'Highlight Color', 'customizer option', 'chelonian' );
	$text['aqua-mode'] = _x( 'Aqua Mode', 'customizer option', 'chelonian' );
	$text['full-size-bg'] = _x( 'Full Size Background', 'customizer option', 'chelonian' );

	$text = apply_filters( 'chelonian_string', $text );

	/* Close Sesame ! */
	if ( isset( $text[$context] ) ){
		return $text[$context];
	}
	return '';
}

<?php
/**
 * Chelonian Template Functions
**/

/**
 * Read More
 */
function chelonian_read_more(){
	$title = the_title_attribute( array( 'echo' => 0 ) );
	$text = _x( 'Read more&hellip;', 'read more', 'chelonian' );
	$url = get_permalink( get_the_ID() );
	$link = '<a href="' . $url . '" title="' . $title . '">' . $text . '</a>';
	comments_popup_link( $text, number_format_i18n( 1 ) . ' ' . _x( 'Comment', 'read more', 'chelonian' ), '%' . ' ' . _x( 'Comments', 'read more', 'chelonian' ), 'comments-link', $link );
}


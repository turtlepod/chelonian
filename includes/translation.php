<?php
/**
 * Make Framework Translatable
**/

/* Load Text Domain */
load_theme_textdomain( 'chelonian', get_template_directory() . '/assets/languages' );

/* Make all string in the framework translatable. */
$texts = array(

	/* functions/template/accessibility.php */
	'skip_to_content'             => _x( 'Skip to content', 'accessibility', 'chelonian' ),

	/* functions/template/general.php */
	'next_posts'                  => _x( 'Next', 'pagination', 'chelonian' ),
	'previous_posts'              => _x( 'Previous', 'pagination', 'chelonian' ),

	/* functions/template/menu.php */
	'menu_search_placeholder'     => _x( 'Search&hellip;', 'nav menu', 'chelonian' ),
	'menu_search_button'          => _x( 'Search', 'nav menu', 'chelonian' ),
	'menu_search_form_toggle'     => _x( 'Expand Search Form', 'nav menu', 'chelonian' ),
	'menu_default_home'           => _x( 'Home', 'nav menu', 'chelonian' ),

	/* functions/template/entry.php */
	'error_title'                 => _x( '404 Not Found', 'entry', 'chelonian' ),
	'error_message'               => _x( 'Apologies, but no entries were found.', 'entry', 'chelonian' ),
	'next_post'                   => _x( 'Next', 'entry', 'chelonian' ),
	'previous_post'               => _x( 'Previous', 'entry', 'chelonian' ),

	/* functions/template/comment.php */
	'next_comment'                => _x( 'Next', 'comment', 'chelonian' ),
	'previous_comment'            => _x( 'Previous', 'comment', 'chelonian' ),
	'comments_closed_pings_open'  => _x( 'Comments are closed, but trackbacks and pingbacks are open.', 'comment', 'chelonian' ),
	'comments_closed'             => _x( 'Comments are closed.', 'comment', 'chelonian' ),

	/* functions/setup.php */
	'untitled'                    => _x( '(Untitled)', 'entry', 'chelonian' ),
	'read_more'                   => _x( 'Read More', 'entry', 'chelonian' ),
	'search_title_prefix'         => _x( 'Search:', 'archive title', 'chelonian' ),
	'comment_moderation_message'  => _x( 'Your comment is awaiting moderation.', 'comment', 'chelonian' ),
);

/* Add text to tamatebako */
tamatebako_load_strings( $texts );
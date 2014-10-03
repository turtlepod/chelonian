<?php
/**
 * Theme Functions
** ---------------------------- */

/* Load text string used in theme */
require_once( trailingslashit( get_template_directory() ) . 'includes/string.php' );

/* Load base theme functionality. */
require_once( trailingslashit( get_template_directory() ) . 'includes/tamatebako.php' );

/* Load theme general setup */
add_action( 'after_setup_theme', 'chelonian_setup' );

/**
 * General Setup
 * @since 0.1.0
 */
function chelonian_setup(){

	/* === DEBUG === */
	$debug_args = array(
		'mobile'         => 0,
		'no-js'          => 0,
		'media-queries'  => 1,
	);
	//add_theme_support( 'tamatebako-debug', $debug_args );

	/* === Theme Layouts === */
	$layouts = array(
		'content' => 'Content',
		'content-sidebar1' => 'Content / Sidebar 1',
	);
	$layouts_args = array(
		'default'   => 'content-sidebar1',
		'customize' => false,
		'post_meta' => false,
	);
	add_theme_support( 'theme-layouts', $layouts, $layouts_args );

	/* === Register Sidebars === */
	$sidebars_args = array(
		"primary" => array( "name" => chelonian_string( 'sidebar-primary-name' ), "description" => "" ),
	);
	add_theme_support( 'tamatebako-sidebars', $sidebars_args );

	/* === Register Menus === */
	$menus_args = array(
		"primary" => chelonian_string( 'menu-primary-name' ),
	);
	add_theme_support( 'tamatebako-menus', $menus_args );

	/* === Load Stylesheet === */
	$style_args = array(
		'theme-open-sans-font',
		'dashicons',
		'theme-reset',
		'parent',
		'style',
		'media-queries'
	);
	add_theme_support( 'hybrid-core-styles', $style_args );

	/* === Editor Style === */
	$editor_css = array(
		'css/reset.min.css',
		'style.css',
		tamatebako_google_open_sans_font_url()
	);
	add_editor_style( $editor_css );

	/* === Customizer Mobile View === */
	add_theme_support( 'tamatebako-customize-mobile-view' );

	/* === Set Content Width === */
	hybrid_set_content_width( 1140 );
}

/**
 * Read More Using Comment Link
 * @since 0.1.0
 */
function chelonian_read_more(){
	$title = the_title_attribute( array( 'echo' => 0 ) );
	$text = chelonian_string( 'read-more' );
	$url = get_permalink( get_the_ID() );
	$link = '<a href="' . $url . '" title="' . $title . '">' . $text . '</a>';
	comments_popup_link( $text, number_format_i18n( 1 ) . ' ' . chelonian_string( 'comment' ), '%' . ' ' . chelonian_string( 'comments' ), 'comments-link', $link );
}


do_action( 'chelonian_after_setup_theme' );
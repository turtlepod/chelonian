<?php
/**
 * Theme Functions
** ---------------------------- */

/* Load Library. */
require_once( trailingslashit( get_template_directory() ) . 'library/tamatebako.php' );

/* Load theme general setup */
add_action( 'after_setup_theme', 'chelonian_setup', 5 );

/**
 * Setup
 */
function chelonian_setup(){

	/* === MINIMUM SYSTEM REQ === */
	$back_compat_args = array(
		'theme_name'   => 'Chelonian',
		'wp_requires'  => '4.1.0',
		'php_requires' => '5.2.4',
	);
	add_theme_support( 'tamatebako-back-compat', $back_compat_args );
	if( ! tamatebako_minimum_requirement( $back_compat_args ) ) return;

	/* === DEPRECATED FUNCTIONS === */
	//tamatebako_include( 'includes/deprecated-hybrid-core' );
	//tamatebako_include( 'includes/deprecated-tamatebako' );
	tamatebako_include( 'includes/deprecated-chelonian' );

	/* === TEMPLATE FUNCTIONS === */
	tamatebako_include( 'includes/template-functions' );

	/* === TRANSLATION === */
	tamatebako_include( 'includes/translation' );

	/* === SCRIPTS === */
	tamatebako_include( 'includes/scripts' );

	/* === CUSTOM FONTS === */
	tamatebako_include( 'includes/custom-fonts' );

	/* === SETUP: Sidebars, Menus, Image Sizes, Content Width === */
	tamatebako_include( 'includes/setup' );

	/* === LAYOUTS === */
	tamatebako_include( 'includes/layouts' );

	/* === BACKGROUND === */
	tamatebako_include( 'includes/background' );

	/* === HEADER IMAGE === */
	tamatebako_include( 'includes/header-image' );

	/* === LOGO === */
	tamatebako_include( 'includes/logo' );

	/* === UTILITY: Mobile View, Custom CSS === */
	tamatebako_include( 'includes/utility' );

	/* === POST FORMATS === */
	tamatebako_include( 'includes/post-formats' );

}

do_action( 'tamatebako_after_setup' );
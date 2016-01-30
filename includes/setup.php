<?php
/**
 * Setup Theme Elements
**/

/* === Maximum Content Width === */

global $content_width;
if ( ! isset( $content_width ) ){
	$content_width = 1140;
}

/* === Register Sidebars === */

$sidebars_args = array(
	"primary"   => array( "name" => _x( 'Sidebar', 'sidebar name', 'chelonian' ), "description" => "" ),
	"landing-page-1"   => array( "name" => _x( 'Landing Page Widget #1', 'sidebar name', 'chelonian' ), "description" => "" ),
	"landing-page-2"   => array( "name" => _x( 'Landing Page Widget #2', 'sidebar name', 'chelonian' ), "description" => "" ),
	"landing-page-3"   => array( "name" => _x( 'Landing Page Widget #3', 'sidebar name', 'chelonian' ), "description" => "" ),
);
add_theme_support( 'tamatebako-sidebars', $sidebars_args );


/* === Register Menus === */

$nav_menus_args = array(
	"primary" => _x( 'Navigation', 'nav menu name', 'chelonian' ),
);
register_nav_menus( $nav_menus_args );


/* === Thumbnail Size === */

//add_image_size( 'theme-thumbnail', 300, 200, true );
//set_post_thumbnail_size( 200, 200, true );


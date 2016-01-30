<?php
/**
 * Layouts Setup
**/
$image_dir = get_template_directory_uri() . '/assets/images/layouts/';
$layouts = array(
	/* One Column */
	'content' => array(
		'name'          => _x( 'Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'content.png',
	),
	/* Two Columns */
	'content-sidebar1'  => array(
		'name'          => _x( 'Content | Sidebar 1', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'content-sidebar1.png',
	),
);
$layouts_args = array(
	'default'           => 'content-sidebar1',
	'customize'         => false,
	'post_meta'         => false,
	'post_types'        => array( 'post' ),
	'thumbnail'         => true,
);
$layouts_strings = array(
	'default'           => _x( 'Default', 'layout', 'nokonoko' ),
	'layout'            => _x( 'Layout', 'layout', 'nokonoko' ),
	'global_layout'     => _x( 'Global Layout', 'layout', 'nokonoko' ),
);
add_theme_support( 'tamatebako-layouts', $layouts, $layouts_args, $layouts_strings );

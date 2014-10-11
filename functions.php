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

	/* === Custom Background === */
	add_theme_support( 'custom-background', array( 'default-color' => '1f1f1f' ) );

	/* === Customizer Option === */
	add_action( 'customize_register', 'chelonian_customizer_register' );

	/* WP Head CSS */
	add_action( 'wp_head', 'chelonian_color_wp_head' );

	/* Body Class */
	add_action( 'body_class', 'chelonian_body_class' );

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



/**
 * Register Customizer Setting
 * @since 1.0.0
 */
function chelonian_customizer_register( $wp_customize ){

	/* === BACKGROUND === */

	/* Full size bg setting */
	$wp_customize->add_setting( 'full_size_background', array(
    	'default'             => 0,
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'chelonian_sanitize_checkbox',
    ));

	/* add it in background image section */
    $wp_customize->add_control( 'chelonian_full_size_background', array(
    	'settings'            => 'full_size_background',
		'section'             => 'background_image',
		'label'               => chelonian_string( 'full-size-bg' ),
		'type'                => 'checkbox',
		'priority'            => 20,
	));

	/* COLOR: Primary */

	/* Primary color setting */
	$wp_customize->add_setting( 'color_primary', array(
		'default'             => apply_filters( 'theme_mod_color_primary', '21759b' ),
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'sanitize_hex_color_no_hash',
	));

	/* add it in colors section */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'custom-colors-primary', array(
		'label'               => chelonian_string( 'primary-color' ),
		'section'             => 'colors',
		'settings'            => 'color_primary',
		'priority'            => 10,
	)));

	/* COLOR: Secondary (Hover) */

	/* Secondary color setting */
	$wp_customize->add_setting( 'color_secondary', array(
		'default'             => apply_filters( 'theme_mod_color_secondary', '3883A5' ),
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'sanitize_hex_color_no_hash',
	));

	/* add it in colors section */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'custom-colors-secondary', array(
		'label'               => chelonian_string( 'secondary-color' ),
		'section'             => 'colors',
		'settings'            => 'color_secondary',
		'priority'            => 10,
	)));

	/* COLOR: Subsidiary (Highlight) */

	/* Subsidiary color setting */
	$wp_customize->add_setting( 'color_subsidiary', array(
		'default'             => apply_filters( 'theme_mod_color_subsidiary', 'ffff00' ),
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'sanitize_hex_color_no_hash',
	));

	/* add it in colors section */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'custom-colors-subsidiary', array(
		'label'               => chelonian_string( 'subsidiary-color' ),
		'section'             => 'colors',
		'settings'            => 'color_subsidiary',
		'priority'            => 10,
	)));

	/* === COLOR: Aqua Mode === */

	/* Aqua Mode setting */
	$wp_customize->add_setting( 'aqua_mode', array(
		'default'             => 0,
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'chelonian_sanitize_checkbox',
	));

	/* add it in colors section */
    $wp_customize->add_control( 'chelonian_aqua_mode', array(
    	'settings'            => 'aqua_mode',
		'section'             => 'colors',
		'label'               => chelonian_string( 'aqua-mode' ),
		'type'                => 'checkbox',
		'priority'            => 10,
	));
}


/**
 * Apply Color Option in Theme
 * @since 1.0.0
 */
function chelonian_color_wp_head(){

	/* Default Args */
	$css = '';

	/* User setting */
	$primary = chelonian_sanitize_hex_color_no_hash( get_theme_mod( 'color_primary', '21759b' ) );
	$secondary = chelonian_sanitize_hex_color_no_hash( get_theme_mod( 'color_secondary', '3883A5' ) );
	$subsidiary = chelonian_sanitize_hex_color_no_hash( get_theme_mod( 'color_subsidiary', 'ffff00' ) );
	$aqua = chelonian_sanitize_checkbox( get_theme_mod( 'aqua_mode', '' ) );

	/* RGB Color */
	$primary_rgb = join( ', ', hybrid_hex_to_rgb( $primary ) );
	$secondary_rgb = join( ', ', hybrid_hex_to_rgb( $secondary ) );

	/* Primary Color */
	if ( '21759b' != $primary ){
		$css .= "a{ color: #{$primary}; }";
		$css .= ".button, button, input[type='button'], input[type='reset'], input[type='submit'],a.comments-link,span.comments-link a,#comments .comment-meta,#reply-title,.loop-pagination .page-numbers{ background: #{$primary}; }";
		$css .= "#header{ background: #{$primary}; }";
		$css .= ".menu-container li a .menu-item-wrap{ background: #{$primary};}";
		$css .= ".entry-title a{ background: #{$primary}; }";
	}

	/* Secondary Color */
	if ( '3883A5' != $secondary ){
		$css .= ".entry-byline .entry-author a:hover { color: #{$secondary}; }";
		$css .= ".button:hover, button:hover, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover,#menu-toggle-primary a.active,#menu-toggle-primary a:hover,a.comments-link:hover,span.comments-link a:hover,#comments .comment-reply-link:hover,#respond #cancel-comment-reply-link:hover,.loop-pagination a.page-numbers:hover{ background: #{$secondary}; }";
		$css .= ".menu-container,.menu-container li a{ border-color: #{$secondary}; }";
		$css .= ".entry-title a:hover{ background: #{$secondary}; }";
	}

	/* Subsidiary Color */
	if ( 'ffff00' != $subsidiary ){
		$css .= "::selection{ background:#{$subsidiary};}";
		$css .= "::-moz-selection { background:#{$subsidiary}; }";
		$css .= "#landing-page-description a.button:hover{ border-color: #{$subsidiary}; }";
		$css .= "header h1 strong,#landing-page-description a.button:hover,#menu-toggle-primary a:before,.menu-container li a:hover:after,.sticky .entry-title a:before{ color: #{$subsidiary}; }";
	}

	/* Aqua Mode */
	if ( $aqua ){

		/* Primary Color */
		$css .= ".entry-title a{ background: rgba({$primary_rgb},0.7); }";

		/* Secondary Color */
		$css .= ".entry-title a:hover{ background: rgba({$secondary_rgb},0.7); }";
	}

	/* Add CSS */
	if ( !empty( $css ) ){
		echo "\n" . '<style type="text/css" id="chelonian-colors-css">' . trim( $css ) . '</style>' . "\n";
	}
}


/**
 * Add Body Classes to style full width background and aqua mode.
 * @since 1.0.0
 */
function chelonian_body_class( $classes ){

	/* full size background */
	if ( chelonian_sanitize_checkbox( get_theme_mod( 'full_size_background', '' ) ) ){
		$classes[] = 'full-size-background';
	}

	/* Aqua Mode */
	if ( chelonian_sanitize_checkbox( get_theme_mod( 'aqua_mode', '' ) ) ){
		$classes[] = 'aqua-mode';
	}

	return $classes;
}


/**
 * Checkbox Sanitization Helper Function
 * @since 1.0.1
 */
function chelonian_sanitize_checkbox( $input ){
	if ( isset($input) && !empty($input) ){
		return true;
	}
	return false;
}


/**
 * Hex Color Sanitization Helper Function
 * This function added to sanitize color in front end, wp sanitize_hex_color() only available in customize screen.
 * This is duplicate for sanitize_hex_color() wp-includes/class-wp-customize-manager.php
 * @since 1.0.1
 */
function chelonian_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}


/**
 * Hex Color Sanitization Helper Function
 * This function added to sanitize color in front end, wp sanitize_hex_color_no_hash() only available in customize screen.
 * This is duplicate for sanitize_hex_color_no_hash() wp-includes/class-wp-customize-manager.php
 * @since 1.0.1
 */
function chelonian_sanitize_hex_color_no_hash( $color ){
	$color = ltrim( $color, '#' );

	if ( '' === $color )
		return '';

	return chelonian_sanitize_hex_color( '#' . $color ) ? $color : null;
}


do_action( 'chelonian_after_setup_theme' );
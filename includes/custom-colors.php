<?php
/**
 * Color Options
 * @since 1.0.0
**/

/* Color Options */
add_action( 'customize_register', 'chelonian_color_customizer' );

/**
 * Register Customizer Setting
 * @since 1.0.0
 */
function chelonian_color_customizer( $wp_customize ){

	/* === PRIMARY COLOR === */

	/* Primary color setting */
	$wp_customize->add_setting( 'color_primary', array(
		'default'             => apply_filters( 'theme_mod_color_primary', '#21759b' ),
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'sanitize_hex_color_no_hash',
	));

	/* add it in colors section */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'custom-colors-primary', array(
		'label'               => _x( 'Primary Color', 'customizer', 'chelonian' ),
		'section'             => 'colors',
		'settings'            => 'color_primary',
		'priority'            => 10,
	)));

	/* === SECONDARY COLOR (HOVER) === */

	/* Secondary color setting */
	$wp_customize->add_setting( 'color_secondary', array(
		'default'             => apply_filters( 'theme_mod_color_secondary', '#3883A5' ),
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'sanitize_hex_color_no_hash',
	));

	/* add it in colors section */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'custom-colors-secondary', array(
		'label'               => _x( 'Hover Color', 'customizer', 'chelonian' ),
		'section'             => 'colors',
		'settings'            => 'color_secondary',
		'priority'            => 10,
	)));

	/* === SUBSIDIARY COLOR (HIGHLIGHT) === */

	/* Subsidiary color setting */
	$wp_customize->add_setting( 'color_subsidiary', array(
		'default'             => apply_filters( 'theme_mod_color_subsidiary', '#ffff00' ),
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'sanitize_hex_color_no_hash',
	));

	/* add it in colors section */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'custom-colors-subsidiary', array(
		'label'               => _x( 'Highlight Color', 'customizer', 'chelonian' ),
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
		'sanitize_callback'   => 'tamatebako_sanitize_checkbox',
	));

	/* add it in colors section */
    $wp_customize->add_control( 'chelonian_aqua_mode', array(
    	'settings'            => 'aqua_mode',
		'section'             => 'colors',
		'label'               => _x( 'Aqua Mode', 'customizer', 'chelonian' ),
		'type'                => 'checkbox',
		'priority'            => 10,
	));

}


/* Body Class */
add_action( 'body_class', 'chelonian_color_body_class' );

/**
 * Add Body Classes to style full width background and aqua mode.
 * @since 1.0.0
 */
function chelonian_color_body_class( $classes ){

	/* Aqua Mode */
	if ( tamatebako_sanitize_checkbox( get_theme_mod( 'aqua_mode', '' ) ) ){
		$classes[] = 'aqua-mode';
	}

	return $classes;
}

/* Print CSS to wp_head */
add_action( 'wp_head', 'chelonian_color_print_css' );

/**
 * Print BG Color CSS
 */
function chelonian_color_print_css(){

	/* Default Args */
	$css = '';

	/* User setting */
	$primary = tamatebako_sanitize_hex_color_no_hash( get_theme_mod( 'color_primary', '21759b' ) );
	$secondary = tamatebako_sanitize_hex_color_no_hash( get_theme_mod( 'color_secondary', '3883A5' ) );
	$subsidiary = tamatebako_sanitize_hex_color_no_hash( get_theme_mod( 'color_subsidiary', 'ffff00' ) );
	$aqua = tamatebako_sanitize_checkbox( get_theme_mod( 'aqua_mode', '' ) );

	/* RGB Color */
	$primary_rgb = join( ', ', tamatebako_hex_to_rgb( $primary ) );
	$secondary_rgb = join( ', ', tamatebako_hex_to_rgb( $secondary ) );

	/* Primary Color */
	if ( '21759b' != $primary ){
		$css .= "a{ color: #{$primary}; }";
		$css .= ".button, button, input[type='button'], input[type='reset'], input[type='submit'],a.comments-link,span.comments-link a,#comments .comment-meta,#reply-title,.navigation.pagination .page-numbers{ background: #{$primary}; }";
		$css .= "#header{ background: #{$primary}; }";
		$css .= ".menu-container li a .menu-item-wrap{ background: #{$primary};}";
		$css .= ".singular.entry-title, .entry-title a{ background: #{$primary}; }";
		$css .= ".entry-byline .entry-date a:hover, .entry-byline .entry-date a:focus{ color: #{$primary}; }";
	}

	/* Secondary Color */
	if ( '3883A5' != $secondary ){
		$css .= ".entry-byline .entry-author a:hover { color: #{$secondary}; }";
		$css .= ".button:hover, button:hover, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover,#menu-toggle-primary a.active,#menu-toggle-primary a:hover,a.comments-link:hover,span.comments-link a:hover,#comments .comment-reply-link:hover,#respond #cancel-comment-reply-link:hover,.navigation.pagination a.page-numbers:hover{ background: #{$secondary}; }";
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
		$css .= ".singular .entry-title,.entry-title a{ background: rgba({$primary_rgb},0.7); }";

		/* Secondary Color */
		$css .= ".entry-title a:hover{ background: rgba({$secondary_rgb},0.7); }";
	}

	/* Add CSS */
	if ( !empty( $css ) ){
		echo "\n" . '<style type="text/css" id="chelonian-colors-css">' . trim( $css ) . '</style>' . "\n";
	}
}
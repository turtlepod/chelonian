<?php
/**
 * Landing Page
**/

/* Register Customizer */
add_action( 'customize_register', 'chelonian_landing_page_customize_register' );

/**
 * Register Customizer
 * @since 2.0.0
 */
function chelonian_landing_page_customize_register( $wp_customize ){

	/* Section */
	$wp_customize->add_section( 'chelonian_landing_page', array(
		'title'               => _x( 'Landing Page', 'customizer', 'chelonian' ),
	));

	/* DESCRIPTION */

	/* Setting */
	$wp_customize->add_setting( 'landing_page_description', array(
		'default'             => '',
		'sanitize_callback'   => 'wp_kses_post',
	));

	/* Control */
	$wp_customize->add_control( 'landing_page_description', array(
		'settings'            => 'landing_page_description',
		'section'             => 'chelonian_landing_page',
		'label'               => _x( 'Description', 'customizer', 'chelonian' ),
		'type'                => 'textarea',
		'priority'            => 20,
	));

	/* BUTTON URL */

	/* Setting */
	$wp_customize->add_setting( 'landing_page_button_url', array(
		'default'             => '',
		'sanitize_callback'   => 'esc_url',
	));

	/* Control */
	$wp_customize->add_control( 'landing_page_button_url', array(
		'settings'            => 'landing_page_button_url',
		'section'             => 'chelonian_landing_page',
		'label'               => _x( 'Button URL', 'customizer', 'chelonian' ),
		'type'                => 'text',
		'priority'            => 20,
	));

	/* BUTTON TEXT */

	/* Setting */
	$wp_customize->add_setting( 'landing_page_button_text', array(
		'default'             => '',
		'sanitize_callback'   => 'esc_attr',
	));

	/* Control */
	$wp_customize->add_control( 'landing_page_button_text', array(
		'settings'            => 'landing_page_button_text',
		'section'             => 'chelonian_landing_page',
		'label'               => _x( 'Button Text', 'customizer', 'chelonian' ),
		'type'                => 'text',
		'priority'            => 20,
	));
}





















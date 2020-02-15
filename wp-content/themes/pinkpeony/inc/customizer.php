<?php
/**
 * PinkPeony Theme Customizer.
 *
 * @package PinkPeony
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pinkpeony_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_section( 'pinkpeony_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'pinkpeony' ),
		'priority' => 130,
	) );

	/* Randomize Testimonials */
	$wp_customize->add_setting( 'pinkpeony_testimonials', array(
		'default'           => 0,
		'sanitize_callback' => 'pinkpeony_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'pinkpeony_testimonials', array(
		'label'             => esc_html__( 'Randomize Front Page Testimonials', 'pinkpeony' ),
		'section'           => 'pinkpeony_theme_options',
		'priority'          => 2,
		'type'              => 'checkbox',
	) );

	/* Front Page: Featured Page One */
	$wp_customize->add_setting( 'pinkpeony_featured_page_one_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'pinkpeony_sanitize_dropdown_pages',
	) );
	$wp_customize->add_control( 'pinkpeony_featured_page_one_front_page', array(
		'label'             => esc_html__( 'Front Page: Featured Page One', 'pinkpeony' ),
		'section'           => 'pinkpeony_theme_options',
		'priority'          => 8,
		'type'              => 'dropdown-pages',
	) );

	/* Front Page: Featured Page Two */
	$wp_customize->add_setting( 'pinkpeony_featured_page_two_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'pinkpeony_sanitize_dropdown_pages',
	) );
	$wp_customize->add_control( 'pinkpeony_featured_page_two_front_page', array(
		'label'             => esc_html__( 'Front Page: Featured Page Two', 'pinkpeony' ),
		'section'           => 'pinkpeony_theme_options',
		'priority'          => 9,
		'type'              => 'dropdown-pages',
	) );

	/* Front Page: Featured Page Three */
	$wp_customize->add_setting( 'pinkpeony_featured_page_three_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'pinkpeony_sanitize_dropdown_pages',
	) );
	$wp_customize->add_control( 'pinkpeony_featured_page_three_front_page', array(
		'label'             => esc_html__( 'Front Page: Featured Page Three', 'pinkpeony' ),
		'section'           => 'pinkpeony_theme_options',
		'priority'          => 10,
		'type'              => 'dropdown-pages',
	) );
}
add_action( 'customize_register', 'pinkpeony_customize_register' );

/**
 * Sanitize the dropdown pages.
 *
 * @param interger $input.
 * @return interger.
 */
function pinkpeony_sanitize_dropdown_pages( $input ) {
	if ( is_numeric( $input ) ) {
		return intval( $input );
	}
}

/**
 * Sanitize the checkbox.
 *
 * @param interger $input.
 * @return interger.
 */
function pinkpeony_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pinkpeony_customize_preview_js() {
	wp_enqueue_script( 'pinkpeony_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'pinkpeony_customize_preview_js' );

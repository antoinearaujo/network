<?php
/**
 * Theme Customizer
 *
 * @package Chuchadon
 */

	/* == Footer section == */
	
	/* Add the footer section. */
	$wp_customize->add_section(
		'footer',
		array(
			'title'    => esc_html__( 'Footer Settings', 'chuchadon' ),
			'priority' => 50,
			'panel'    => 'theme'
		)
	);
	
	/* Add hide footer setting. */
	$wp_customize->add_setting(
		'hide_footer',
		array(
			'default'           => '',
			'sanitize_callback' => 'chuchadon_sanitize_checkbox'
		)
	);
	
	/* Add hide footer control. */
	$wp_customize->add_control(
		'hide_footer',
		array(
			'label'       => esc_html__( 'Hide Footer', 'chuchadon' ),
			'description' => esc_html__( 'Check this if you want to hide Footer content.', 'chuchadon' ),
			'section'     => 'footer',
			'priority'    => 10,
			'type'        => 'checkbox'
		)
	);
	
	/* Add the footer text setting. */
	$wp_customize->add_setting(
		'footer_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'chuchadon_sanitize_textarea'
		)
	);
	
	/* Add the footer text control. */
	$wp_customize->add_control(
		'footer_text',
		array(
			'label'       => esc_html__( 'Footer text', 'chuchadon' ),
			'description' => esc_html__( 'Enter Footer text which replaces default text.', 'chuchadon' ),
			'section'     => 'footer',
			'priority'    => 20,
			'type'        => 'textarea'
		)
	);
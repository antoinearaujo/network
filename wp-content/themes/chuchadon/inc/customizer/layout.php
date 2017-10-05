<?php
/**
 * Theme Customizer
 *
 * @package Chuchadon
 */

	/* == Layout section == */
	
	/* Add the layout section. */
	$wp_customize->add_section(
		'chuchadon-layout',
		array(
			'title'    => esc_html__( 'Layouts', 'chuchadon' ),
			'priority' => 10,
			'panel'    => 'theme'
		)
	);

	/* Add the layout setting. */
	$wp_customize->add_setting(
		'theme_layout',
		array(
			'default'           => '1c',
			'sanitize_callback' => 'chuchadon_sanitize_layout'
		)
	);
	
	$layout_choices = array( 
		'1c'   => __( '1 Column', 'chuchadon' ),
		'2c-l' => __( '2 Columns: Content / Sidebar', 'chuchadon' ),
		'2c-r' => __( '2 Columns: Sidebar / Content', 'chuchadon' )
	);
	
	/* Add the layout control. */
	$wp_customize->add_control(
		'theme_layout',
		array(
			'label'    => esc_html__( 'Global Layout', 'chuchadon' ),
			'section'  => 'chuchadon-layout',
			'priority' => 10,
			'type'     => 'radio',
			'choices'  => $layout_choices
		)
	);
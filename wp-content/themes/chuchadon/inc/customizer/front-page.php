<?php
/**
 * Theme Customizer
 *
 * @package Chuchadon
 */
	
	/* == Front page section == */
	
	/* Add the front-page section. */
	$wp_customize->add_section(
		'front-page',
		array(
			'title'       => esc_html__( 'Front Page Settings', 'chuchadon' ),
			'description' => esc_html__( 'The first Callout is for top callout section and the second one is for bottom Callout section.', 'chuchadon' ),
			'priority'    => 20,
			'panel'       => 'theme'
		)
	);
	
	/* == Callout == */
	
	/* Add the callout title setting twice, top and bottom. */
	
	$k = 0;
	
	while ( $k < 2 ) {
		
		/* Text for placement in settings. */
		if ( 0 == $k ) {
			$placement = 'top';
		} else {
			$placement = 'bottom';
		}
		
		/* Text for placement in the Customizer. */
		if ( 0 == $k ) {
			$placement_text = _x( 'Top', 'position of callout text', 'chuchadon' );
		} else {
			$placement_text = _x( 'Bottom', 'position of callout text', 'chuchadon' );
		}
	
		/* Add the callout text setting. */
		$wp_customize->add_setting(
			'callout_text_' . $placement,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_textarea'
			)
		);
	
		/* Add the callout text control. */
		$wp_customize->add_control(
			'callout_text_' . $placement,
			array(
				'label'    => sprintf( esc_html__( '%s Callout text', 'chuchadon' ), $placement_text ),
				'section'  => 'front-page',
				'priority' => 30 + $k*100,
				'type'     => 'textarea'
			)
		);
	
		/* Add the callout link setting. */
		$wp_customize->add_setting(
			'callout_url_' . $placement,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
 	
		/* Add the callout link control. */
		$wp_customize->add_control(
			'callout_url_' . $placement,
			array(
				'label'    => sprintf( esc_html__( '%s Callout URL', 'chuchadon' ), $placement_text ),
				'section'  => 'front-page',
				'priority' => 50 + $k*100,
				'type'     => 'url'
			)
		);
 	
		/* Add the callout url text setting. */
		$wp_customize->add_setting(
			'callout_url_text_' . $placement,
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
 	
		/* Add the callout url text control. */
		$wp_customize->add_control(
			'callout_url_text_' . $placement,
			array(
				'label'    => sprintf( esc_html__( '%s Callout URL text', 'chuchadon' ), $placement_text ),
				'section'  => 'front-page',
				'priority' => 60 + $k*100,
				'type'     => 'text'
			)
		);
	
		$k++; // Add +1 before loop ends.
	
	} // End while loop.
	
	/* Add order featured setting. */
	$wp_customize->add_setting(
		'order_featured',
		array(
			'default'           => '',
			'sanitize_callback' => 'chuchadon_sanitize_checkbox'
		)
	);
	
	/* Add order featured control. */
	$wp_customize->add_control(
		'order_featured',
		array(
			'label'       => esc_html__( 'Featured area after Sidebar', 'chuchadon' ),
			'description' => esc_html__( 'Check this if you want to move Featured area after Front Page Sidebar in the Front Page Template.', 'chuchadon' ),
			'section'     => 'front-page',
			'priority'    => 75,
			'type'        => 'checkbox'
		)
	);
	
	/* Add the featured area title setting. */
	$wp_customize->add_setting(
		'featured_area_title',
		array(
			'default'           => esc_html__( 'Articles', 'chuchadon' ),
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
 	
	/* Add the featured area url text control. */
	$wp_customize->add_control(
		'featured_area_title',
		array(
			'label'    => esc_html__( 'Featured area title', 'chuchadon' ),
			'section'  => 'front-page',
			'priority' => 77,
			'type'     => 'text'
		)
	);
	
	/* Add the featured area link setting. */
	$wp_customize->add_setting(
		'featured_area_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
 	
	/* Add the featured area control. */
	$wp_customize->add_control(
		'featured_area_url',
		array(
			'label'    => esc_html__( 'Featured area URL', 'chuchadon' ),
			'section'  => 'front-page',
			'priority' => 78,
			'type'     => 'url'
		)
	);
 	
	/* Add the featured area url text setting. */
	$wp_customize->add_setting(
		'featured_area_url_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
 	
	/* Add the featured area url text control. */
	$wp_customize->add_control(
		'featured_area_url_text',
		array(
			'label'    => esc_html__( 'Featured area URL text', 'chuchadon' ),
			'section'  => 'front-page',
			'priority' => 79,
			'type'     => 'text'
		)
	);
	
	/* Add the featured setting where we can select do we use child pages, blog posts or portfolios in front page template. */
	$wp_customize->add_setting(
		'front_page_featured',
		array(
			'default'           => 'blog-posts',
			'sanitize_callback' => 'chuchadon_sanitize_featured'
		)
	);
	
	$front_page_featured_choices = array(
		'blog-posts'  => esc_html__( 'Blog Posts', 'chuchadon' ),
		'child-pages' => esc_html__( 'Child Pages', 'chuchadon' ),
		'nothing'     => esc_html__( 'Nothing', 'chuchadon' )
	);
	
	/* Add the featured control. */
	$wp_customize->add_control(
		'front_page_featured',
		array(
			'label'       => esc_html__( 'Featured Content', 'chuchadon' ),
			'description' => esc_html__( 'Select do you want to feature Blog Posts, Child Pages or nothing in Front Page.', 'chuchadon' ),
			'section'     => 'front-page',
			'priority'    => 80,
			'type'        => 'radio',
			'choices'     => $front_page_featured_choices
		)
	);
	
	/* Add the setting for Callout image. */
	$wp_customize->add_setting(
		'callout_image',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw'
		) );
	
	/* Add the Callout image link control. */
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
			'callout_image',
				array(
					'label'       => esc_html__( 'Callout Image', 'chuchadon' ),
					'description' => esc_html__( 'Add Callout Image which can be map or product image for example. Recommended width is 1920px.', 'chuchadon' ),
					'section'     => 'front-page',
					'priority'    => 170,
				)
		)
	);
	
	/* Add the callout image alt setting. */
	$wp_customize->add_setting(
		'callout_image_alt',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	
	/* Add the callout image alt control. */
	$wp_customize->add_control(
		'callout_image_alt',
		array(
			'label'    => esc_html__( 'Callout image alt text', 'chuchadon' ),
			'section'  => 'front-page',
			'priority' => 180,
			'type'     => 'text'
		)
	);
	
	/* Add the Callout image link setting. */
	$wp_customize->add_setting(
		'callout_image_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
 	
	/* Add the Callout image link control. */
	$wp_customize->add_control(
		'callout_image_url',
		array(
			'label'    => esc_html__( 'Callout image URL', 'chuchadon' ),
			'section'  => 'front-page',
			'priority' => 190,
			'type'     => 'url'
		)
	);
<?php
/**
 * Theme Customizer
 *
 * @package Chuchadon
 */

	/* == Background section == */
	
	/* Add the background section. */
	$wp_customize->add_section(
		'background',
		array(
			'title'    => esc_html__( 'Background Settings', 'chuchadon' ),
			'priority' => 30,
			'panel'    => 'theme'
		)
	);

	/* Add custom header background color setting. */
	$wp_customize->add_setting(
		'header_background_color',
		array(
			'default'           => apply_filters( 'chuchadon_default_bg_color', '#cc0000' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	/* Add custom header background color control. */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'header_background_color',
		array(
			'label'       => esc_html__( 'Header Background Color', 'chuchadon' ),
			'section'     => 'background',
			'priority'    => 40,
		)
	) );
	
	/* Add custom header background color opacity setting. */
	$wp_customize->add_setting(
		'header_background_color_opacity',
		array(
			'default'           => absint( apply_filters( 'chuchadon_default_bg_opacity', 75 ) ),
			'sanitize_callback' => 'absint',
		)
	);
	
	/* Add custom header background color opacity control. */
	$wp_customize->add_control(
		'header_background_color_opacity',
			array(
				'type'        => 'range',
				'priority'    => 50,
				'section'     => 'background',
				'label'       => esc_html__( 'Header Color Opacity.', 'chuchadon' ),
				'description' => esc_html__( 'Set Header Color opacity.', 'chuchadon' ),
				'input_attrs' =>
					array(
						'min'   => 0,
						'max'   => 100,
						'step'  => 1
					),
			)
		);
		
	/* Add the setting for Top Callout background image. */
		
	$wp_customize->add_setting(
		'callout_bg',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw'
		) );
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
			'callout_bg',
				array(
					'label'    => esc_html__( 'Callout background', 'chuchadon' ),
					'section'  => 'background',
					'priority' => 60,
			)
		)
	);
		
	/* Add Callout background color setting. */
	$wp_customize->add_setting(
		'callout_bg_color',
		array(
			'default'           => apply_filters( 'chuchadon_default_callout_bg_color', '#000000' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	/* Add Callout background color control. */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'callout_bg_color',
		array(
			'label'       => esc_html__( 'Callout Background Color', 'chuchadon' ),
			'section'     => 'background',
			'priority'    => 70,
		)
	) );
	
	/* Add Callout background color opacity setting. */
	$wp_customize->add_setting(
		'callout_bg_color_opacity',
		array(
			'default'           => absint( apply_filters( 'chuchadon_default_callout_bg_opacity', 75 ) ),
			'sanitize_callback' => 'absint',
		)
	);
	
	/* Add Callout color opacity control. */
	$wp_customize->add_control(
		'callout_bg_color_opacity',
			array(
				'type'        => 'range',
				'priority'    => 80,
				'section'     => 'background',
				'label'       => esc_html__( 'Callout Background Color Opacity.', 'chuchadon' ),
				'description' => esc_html__( 'Set Callout Background Color Opacity.', 'chuchadon' ),
				'input_attrs' =>
					array(
						'min'   => 0,
						'max'   => 100,
						'step'  => 1
					),
			)
		);
		
	/* Add the setting for Bottom Callout background image. */
		
	$wp_customize->add_setting(
		'callout_bg_bottom',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw'
		) );
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
			'callout_bg_bottom',
				array(
					'label'    => esc_html__( 'Bottom Callout background', 'chuchadon' ),
					'section'  => 'background',
					'priority' => 90,
			)
		)
	);
		
	/* Add Callout background color setting. */
	$wp_customize->add_setting(
		'callout_bg_bottom_color',
		array(
			'default'           => apply_filters( 'chuchadon_default_callout_bg_bottom_color', '#cc0000' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	/* Add Callout background color control. */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'callout_bg_bottom_color',
		array(
			'label'       => esc_html__( 'Callout Background Color', 'chuchadon' ),
			'section'     => 'background',
			'priority'    => 100,
		)
	) );
	
	/* Add Callout background color opacity setting. */
	$wp_customize->add_setting(
		'callout_bg_bottom_color_opacity',
		array(
			'default'           => absint( apply_filters( 'chuchadon_default_callout_bg_bottom_opacity', 75 ) ),
			'sanitize_callback' => 'absint',
		)
	);
	
	/* Add Callout color opacity control. */
	$wp_customize->add_control(
		'callout_bg_bottom_color_opacity',
			array(
				'type'        => 'range',
				'priority'    => 110,
				'section'     => 'background',
				'label'       => esc_html__( 'Bottom Callout Background Color Opacity.', 'chuchadon' ),
				'description' => esc_html__( 'Set Callout Background Color Opacity.', 'chuchadon' ),
				'input_attrs' =>
					array(
						'min'   => 0,
						'max'   => 100,
						'step'  => 1
					),
			)
		);
		
	/* Add the setting for subsidiary sidebar background image. */
	if ( is_active_sidebar( 'subsidiary' ) ) {
		
		$wp_customize->add_setting(
			'subsidiary_sidebar_bg',
			array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw'
			) );
	
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
			$wp_customize,
				'subsidiary_sidebar_bg',
					array(
						'label'    => esc_html__( 'Subsidiary sidebar background', 'chuchadon' ),
						'section'  => 'background',
						'priority' => 120,
				)
			)
		);
		
		/* Add subsidiary sidebar background color setting. */
		$wp_customize->add_setting(
			'subsidiary_sidebar_bg_color',
			array(
				'default'           => apply_filters( 'chuchadon_default_sidebar_bg_color', '#000000' ),
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		/* Add subsidiary sidebar background color control. */
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'subsidiary_sidebar_bg_color',
			array(
				'label'       => esc_html__( 'Subsidiary Sidebar Background Color', 'chuchadon' ),
				'section'     => 'background',
				'priority'    => 130,
			)
		) );
	
		/* Add subsidiary sidebar background color opacity setting. */
		$wp_customize->add_setting(
			'subsidiary_sidebar_bg_color_opacity',
			array(
				'default'           => absint( apply_filters( 'chuchadon_default_subsidiary_sidebar_bg_opacity', 85 ) ),
				'sanitize_callback' => 'absint',
			)
		);
	
		/* Add subsidiary sidebar background color opacity control. */
		$wp_customize->add_control(
			'subsidiary_sidebar_bg_color_opacity',
				array(
					'type'        => 'range',
					'priority'    => 140,
					'section'     => 'background',
					'label'       => esc_html__( 'Subsidiary Sidebar Background Color Opacity.', 'chuchadon' ),
					'description' => esc_html__( 'Set Subsidiary Sidebar Background Color Opacity.', 'chuchadon' ),
					'input_attrs' =>
						array(
							'min'   => 0,
							'max'   => 100,
							'step'  => 1
						),
				)
			);
	
	}
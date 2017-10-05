<?php
/**
 * Theme Customizer
 *
 * @package Chuchadon
 */

/**
 * Add the Customizer functionality.
 *
 * @since 1.0.0
 */
function chuchadon_customize_register( $wp_customize ) {

	/* === Theme panel === */

	/* Add the theme panel. */
	$wp_customize->add_panel(
		'theme',
		array(
			'title'      => esc_html__( 'Theme Settings', 'chuchadon' ),
			'priority'   => 10
		)
	);
	
	/* Load different part of the Customizer. */
	require_once( get_template_directory() . '/inc/customizer/layout.php' );
	require_once( get_template_directory() . '/inc/customizer/front-page.php' );
	require_once( get_template_directory() . '/inc/customizer/background.php' );
	require_once( get_template_directory() . '/inc/customizer/footer.php' );
	
}
add_action( 'customize_register', 'chuchadon_customize_register' );

/**
 * Enqueues front-end CSS for backgrounds.
 *
 * @since 1.0.0
 * @see   wp_add_inline_style()
 */
function chuchadon_color_backgrounds_css() {
	
	/* Get header colors. */
	$header_bg_color = get_theme_mod( 'header_background_color', apply_filters( 'chuchadon_default_bg_color', '#cc0000' ) );
	$header_bg_color_opacity = absint( get_theme_mod( 'header_background_color_opacity', absint( apply_filters( 'chuchadon_default_bg_opacity', 78 ) ) ) );
	$header_bg_color_opacity = $header_bg_color_opacity / 100;
	
	/* Get Callout colors. */
	$callout_bg_color = get_theme_mod( 'callout_bg_color', apply_filters( 'chuchadon_default_callout_bg_color', '#000000' ) );
	$callout_bg_color_opacity = absint( get_theme_mod( 'callout_bg_color_opacity', absint( apply_filters( 'chuchadon_default_callout_bg_opacity', 78 ) ) ) );
	$callout_bg_color_opacity = $callout_bg_color_opacity / 100;
	
	$callout_bg_bottom_color = get_theme_mod( 'callout_bg_bottom_color', apply_filters( 'chuchadon_default_callout_bg_bottom_color', '#cc0000' ) );
	$callout_bg_bottom_color_opacity = absint( get_theme_mod( 'callout_bg_bottom_color_opacity', absint( apply_filters( 'chuchadon_default_callout_bg_bottom_opacity', 78 ) ) ) );
	$callout_bg_bottom_color_opacity = $callout_bg_bottom_color_opacity / 100;
	
	/* Get subsidiary sidebar colors. */
	$subsidiary_sidebar_bg_color = get_theme_mod( 'subsidiary_sidebar_bg_color', apply_filters( 'chuchadon_default_sidebar_bg_color', '#000000' ) );
	$subsidiary_sidebar_bg_color_opacity = absint( get_theme_mod( 'subsidiary_sidebar_bg_color_opacity', absint( apply_filters( 'chuchadon_default_subsidiary_sidebar_bg_opacity', 78 ) ) ) );
	$subsidiary_sidebar_bg_color_opacity = $subsidiary_sidebar_bg_color_opacity / 100;

	/* Convert hex color to rgba. */
	$header_bg_color_rgb = chuchadon_hex2rgb( $header_bg_color );
	$callout_bg_color_rgb = chuchadon_hex2rgb( $callout_bg_color );
	$callout_bg_bottom_color_rgb = chuchadon_hex2rgb( $callout_bg_bottom_color );
	$subsidiary_sidebar_bg_color_rgb = chuchadon_hex2rgb( $subsidiary_sidebar_bg_color );
	
	/* Callout images. */
	$callout_bg        = esc_url( get_theme_mod( 'callout_bg' ) );
	$callout_bg_bottom = esc_url( get_theme_mod( 'callout_bg_bottom' ) );
	
	/* Subsidiary sidebar image. */
	$subsidiary_sidebar_bg = esc_url( get_theme_mod( 'subsidiary_sidebar_bg' ) );
	
	/* When to show callout image. */
	$min_width_callout        = absint( apply_filters( 'chuchadon_callout_bg_show', 800 ) );
	$min_width_callout_bottom = absint( apply_filters( 'chuchadon_callout_bg_bottom_show', 800 ) );
	
	/* When to show subsidiary sidebar image. */
	$min_width = absint( apply_filters( 'chuchadon_subsidiary_sidebar_bg_show', 800 ) );
	
	/* Background arguments for Callout. */
	$background_arguments_callout        = esc_attr( apply_filters( 'chuchadon_callout_bg_arguments', 'no-repeat right top' ) );
	$background_arguments_callout_bottom = esc_attr( apply_filters( 'chuchadon_callout_bg_bottom_arguments', 'no-repeat right top' ) );
	
	/* Background arguments for subsidiary. */
	$background_arguments = esc_attr( apply_filters( 'chuchadon_subsidiary_sidebar_bg_arguments', 'no-repeat left top' ) );
	
	/* Header bg styles. */	
	if ( '#cc0000' !== $header_bg_color || 75 !== $header_bg_color_opacity ) {
			
		$bg_color_css = "
			.site-header,
			.custom-header-image .site-header > .wrap::before {
				background-color: rgba( {$header_bg_color_rgb['red'] }, {$header_bg_color_rgb['green']}, {$header_bg_color_rgb['blue']}, {$header_bg_color_opacity});
			}";
				
	}
	
	/* Top Callout bg styles. */	
	if ( ! empty( $callout_bg ) || !empty( $callout_bg_color ) ) {

		$bg_color_css .= "
		@media screen and (min-width: {$min_width_callout}px) {
				
			.chuchadon-callout-top {
					background: url({$callout_bg}) {$background_arguments_callout}; background-size: 50%;
				}
					
		}
		
		.chuchadon-callout-top,
		.chuchadon-callout-top > .entry-inner::before {
			background-color: rgba( {$callout_bg_color_rgb['red'] }, {$callout_bg_color_rgb['green']}, {$callout_bg_color_rgb['blue']}, {$callout_bg_color_opacity});
		}";	
			
	}
	
	/* Bottom Callout bg styles. */	
	if ( ! empty( $callout_bg_bottom ) || !empty( $callout_bg_bottom_color ) ) {

		$bg_color_css .= "
		@media screen and (min-width: {$min_width_callout_bottom}px) {
				
			.chuchadon-callout-bottom {
					background: url({$callout_bg_bottom}) {$background_arguments_callout_bottom}; background-size: 50%;
				}
					
		}
		
		.chuchadon-callout-bottom,
		.chuchadon-callout-bottom > .entry-inner::before {
			background-color: rgba( {$callout_bg_bottom_color_rgb['red'] }, {$callout_bg_bottom_color_rgb['green']}, {$callout_bg_bottom_color_rgb['blue']}, {$callout_bg_color_opacity});
		}";	
			
	}
	
	/* Subsidiary bg styles. */	
	if ( is_active_sidebar( 'subsidiary' ) && ! empty( $subsidiary_sidebar_bg_color ) ) {

		$bg_color_css .= "
		@media screen and (min-width: {$min_width}px) {
				
			.sidebar-subsidiary {
					background: url({$subsidiary_sidebar_bg}) {$background_arguments}; background-size: 50%;
				}
					
		}
		
		.sidebar-subsidiary,
		.sidebar-subsidiary > .wrap::before {
			background-color: rgba( {$subsidiary_sidebar_bg_color_rgb['red'] }, {$subsidiary_sidebar_bg_color_rgb['green']}, {$subsidiary_sidebar_bg_color_rgb['blue']}, {$subsidiary_sidebar_bg_color_opacity});
		}";	
			
	}
		
	wp_add_inline_style( 'chuchadon-style', $bg_color_css );
}
add_action( 'wp_enqueue_scripts', 'chuchadon_color_backgrounds_css' );

/**
 * Sanitize the Global layout value.
 *
 * @since 1.0.0
 *
 * @param string $layout Layout type.
 * @return string Filtered layout type (1c|2c-l|2c-r).
 */
function chuchadon_sanitize_layout( $layout ) {

	if ( ! in_array( $layout, array( '1c', '2c-l', '2c-r' ) ) ) {
		$layout = '2c-l';
	}

	return $layout;
	
}

/**
 * Sanitize the Featured Content value.
 *
 * @since 1.0.0
 *
 * @param  string $featured content type.
 * @return string Filtered featured content type (child-pages|blog-posts|nothing).
 */
function chuchadon_sanitize_featured( $featured ) {

	if ( ! in_array( $featured, array( 'blog-posts', 'child-pages', 'nothing' ) ) ) {
		$featured = 'blog-posts';
	}

	return $featured;
	
}

/**
 * Sanitize the checkbox value.
 *
 * @since 1.0.0
 *
 * @param  string $input checkbox.
 * @return string (1 or null).
 */
function chuchadon_sanitize_checkbox( $input ) {

	if ( 1 == $input ) {
		return 1;
	} else {
		return '';
	}

}

/**
 * Sanitizes the footer content on the customize screen. Users with the 'unfiltered_html' cap can post 
 * anything. For other users, wp_filter_post_kses() is ran over the setting.
 *
 * @since 1.0.0
 */
function chuchadon_sanitize_textarea( $setting, $object ) {
	
	/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
	if ( 'footer_text' == $object->id && !current_user_can( 'unfiltered_html' ) ) {
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	}
	/* Return the sanitized setting. */
	return $setting;
	
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function chuchadon_customize_register_pm( $wp_customize ) {
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
}
add_action( 'customize_register', 'chuchadon_customize_register_pm' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function chuchadon_customize_preview_js() {
	wp_enqueue_script( 'chuchadon-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '21072016', true );
}
add_action( 'customize_preview_init', 'chuchadon_customize_preview_js' );

/**
* Callout text and link in front page template.
*
* @since  1.0.0
*/
function chuchadon_callout_output( $placement ) {
	
	/* Set default placement of the callout. */
	if( empty( $placement ) ) {
		$placement = 'top';
	}
	
	/* Start output. */
	$output = '';

	/* Output callout link and text on page templates. */
	if ( get_theme_mod( 'callout_url_' . $placement ) || get_theme_mod( 'callout_url_text_' . $placement ) || get_theme_mod( 'callout_text_' . $placement ) ) {
		
		/* Start output. */
		$output .= '<div class="chuchadon-callout chuchadon-callout-' . $placement . ' clear"><div class="entry-inner">';
		
		/* Callout text. */
		if( get_theme_mod( 'callout_text_' . $placement ) ) {
			$output .= '<div class="chuchadon-callout-text">' . apply_filters( 'chuchadon_the_content', wp_kses_post( get_theme_mod( 'callout_text_' . $placement ) ) ) . '</div>';
		}
		
		/* Callout link. */
		if( get_theme_mod( 'callout_url_' . $placement ) && get_theme_mod( 'callout_url_text_' . $placement ) ) {
			$output .= '<div class="chuchadon-callout-link"><a class="chuchadon-button chuchadon-callout-link-anchor" href="' . esc_url( get_theme_mod( 'callout_url_' . $placement ) ) . '">' . esc_html( get_theme_mod( 'callout_url_text_' . $placement ) ) . '</a></div>';
		}
		
		/* End output. */
		$output .= '</div></div>';
		
	}
	
	return $output;
	
}

/**
* Echo Callout in front page template.
*
* @since  1.0.0
*/
function chuchadon_echo_callout( $placement ) {
	
	/* Set default placement of the callout. */
	if( empty( $placement ) ) {
		$placement = 'top';
	}

	$echo_output = chuchadon_callout_output( $placement );

	if( !empty( $echo_output ) ) {
		echo $echo_output;
	}

}

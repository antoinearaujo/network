<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Chuchadon
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function chuchadon_jetpack_setup() {

	/* Add support for infinite scroll. */
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'render'         => 'chuchadon_infinite_scroll_render',
		'footer'         => 'page',
		'footer_widgets' => 'subsidiary'
	) );
	

	/* Add theme support for responsive videos. */
	add_theme_support( 'jetpack-responsive-videos' );
	
}
add_action( 'after_setup_theme', 'chuchadon_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function chuchadon_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
	}
} // end function chuchadon_infinite_scroll_render

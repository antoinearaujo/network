<?php

function wpc_show_admin_bar() {
	return false;
}
add_filter('show_admin_bar' , 'wpc_show_admin_bar');
function wpc_block_dashboard() {
	$file = basename($_SERVER['PHP_SELF']);
	if (is_user_logged_in() && is_admin() && !current_user_can('edit_posts') && $file != 'admin-ajax.php') {
		wp_redirect( home_url() );
		exit();
	}
}
add_action('init', 'wpc_block_dashboard');

add_action('admin_init', 'gkp_restrict_access_administration');	
function gkp_restrict_access_administration(){
    if (!current_user_can('administrator') && !current_user_can('editor')) {
	wp_redirect( get_bloginfo('url') );
	exit();
    }
}

add_action( 'wp_enqueue_scripts', 'shk_corporate_theme_css',999);
function shk_corporate_theme_css() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'theme-menu', get_template_directory_uri() . '/css/theme-menu.css' );
	wp_enqueue_style( 'default-css', get_stylesheet_directory_uri()."/css/default.css" );
	wp_enqueue_style( 'element-style', get_template_directory_uri() . '/css/element.css' );
	wp_enqueue_style( 'media-responsive' ,get_template_directory_uri() . '/css/media-responsive.css');
	wp_dequeue_style('appointment-default',get_template_directory_uri() .'/css/default.css');
}

require( get_stylesheet_directory() . '/header-widget.php' );
require( get_stylesheet_directory() . '/customizer/customizer-pro.php' );


add_action( 'customize_register','shk_corporate_remove_custom', 1000 );
function shk_corporate_remove_custom($wp_customize) {
  $wp_customize->remove_control('upgrade_pro');
}


function shk_corporate_theme_setup(){
	load_theme_textdomain('shk-corporate', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'shk_corporate_theme_setup');	

 /*
 * Let WordPress manage the document title.
 */
	function shk_corporate_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'shk_corporate_setup' );

add_action( 'widgets_init', 'shk_corporate_widgets_init');
function shk_corporate_widgets_init() {
//Header sidebar
	register_sidebar( array(
		'name' => __( 'Top header left area', 'shk-corporate' ),
		'id' => 'home-header-sidebar_left',
		'description' => __('Top header left area', 'shk-corporate' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Top header center area','shk-corporate' ),
		'id' => 'home-header-sidebar_center',
		'description' => __( 'Top header center area', 'shk-corporate' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Top header right area', 'shk-corporate' ),
		'id' => 'home-header-sidebar_right',
		'description' => __( 'Top header right area', 'shk-corporate' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );	
}	                     
?>
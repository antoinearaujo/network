<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Chuchadon
 */
?><!DOCTYPE html>
<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php hybrid_attr( 'body' ); ?>>
<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'chuchadon' ); ?></a>
	
	<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>
	
	<?php get_template_part( 'menus/menu', 'social' );  // Loads the menus/menu-social.php template. ?>
	
	<?php get_template_part( 'menus/menu', 'buttons' ); // Loads the menus/menu-buttoms.php template. ?>

	<?php get_template_part( 'menus/menu', 'primary' ); // Loads the menus/menu-primary.php template. ?>
	
	<?php do_action( 'chuchadon_before_header' ); // Hook before header. ?>
	
	<div class="site-title-desc clear">
	
		<?php if ( function_exists( 'the_custom_logo' ) ) the_custom_logo(); ?>
		
		<p id="home-title" class="home-title" <?php hybrid_attr( 'site-title' ); ?>>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</p>
				
		<p id="home-description" class="home-description" <?php hybrid_attr( 'site-description' ); ?>><?php bloginfo( 'description' ); ?></p>	
	
		<?php
			if ( function_exists( 'breadcrumb_trail' ) && current_theme_supports( 'breadcrumb-trail' ) ) :
				breadcrumb_trail( array( 'container' => 'nav', 'show_on_front' => false, 'show_browse' => false, 'before' => '<h2 class="screen-reader-text">' . esc_attr__( 'Breadcrumbs', 'chuchadon' ) . '</h2>' ) );
			endif;
		?>
	
	</div><!-- .site-title-desc -->
	
	<header id="masthead" class="site-header" role="banner" <?php hybrid_attr( 'header' ); ?>>
		
		<div class="wrap">
	
			<div class="site-branding">
			
				<?php
					if ( !is_singular() ) : // If viewing a multi-post page.

						get_template_part( 'loop', 'meta' ); // Loads the loop-meta.php template.
						
					elseif ( is_singular() ) : // If viewing singular page for Callout header text.
						
						get_template_part( 'loop', 'callout' ); // Loads the loop-callout.php template.
						
					endif; // End check for multi-post page.
				?>
				
				<?php if( is_page_template( 'pages/front-page.php' ) && '' != trim( get_post_field( 'post_content', get_the_ID() ) ) ) : // Content for front page template in the header. ?>
					<div id="top-callout-content" class="top-callout-content clear">
						<?php echo wp_kses_post( apply_filters( 'chuchadon_the_content', ( get_post_field( 'post_content', get_the_ID() ) ) ) ); ?>
					</div>
				<?php endif; ?>
					
			</div><!-- .site-branding -->
			
		</div><!-- .wrap -->
			
	</header><!-- #masthead -->
	
	<?php do_action( 'chuchadon_after_header' ); // Hook after header. ?>

	<div id="content" class="site-content">
		<div class="wrap">
			<div class="wrap-inside">
				
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main" <?php hybrid_attr( 'content' ); ?>>

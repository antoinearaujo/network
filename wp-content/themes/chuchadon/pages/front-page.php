<?php
/**
 * Template Name: Front Page
 *
 * This is the page template for Front Page.
 *
 * @package Chuchadon
 */

get_header(); ?>
		
	<?php chuchadon_echo_callout( $placement = 'top' ); // Echo callout which is set in the Customizer. Function is in inc/customizer.php file. ?>
			
	<?php
		/* Load front page sidebar and featured area. */
		if( get_theme_mod( 'order_featured' ) ) :
			get_sidebar( 'front-page' );          // Loads the sidebar-front-page.php template.
			get_template_part( 'area-featured' ); // Add featured area.
		else :
			get_template_part( 'area-featured' ); // Add featured area.
			get_sidebar( 'front-page' );          // Loads the sidebar-front-page.php template.				
		endif;
	?>
			
	<?php chuchadon_echo_callout( $placement = 'bottom' ); // Echo callout which is set in the Customizer. Function is in inc/customizer.php file. ?>
	
	<?php if( get_theme_mod( 'callout_image' ) ) : // Callout image. ?>
		<div id="callout-image" class="callout-image">
			<?php if( get_theme_mod( 'callout_image_url' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'callout_image_url' ) ); ?>">
					<img src="<?php echo esc_url( get_theme_mod( 'callout_image' ) ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'callout_image_alt' ) ); ?>" />
				</a>
			<?php else : ?>
				<img src="<?php echo esc_url( get_theme_mod( 'callout_image' ) ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'callout_image_alt' ) ); ?>" />
			<?php endif; ?>
		</div>
	<?php endif; ?>
	
<?php get_footer(); ?>

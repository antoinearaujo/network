<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #main and all content after
 *
 * @package Chuchadon
 */
?>

					</main><!-- #main -->
				</div><!-- #primary -->

			<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
			
			</div><!-- .wrap-inside -->
		</div><!-- .wrap -->
	</div><!-- #content -->
	
	<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>
	
	<?php get_template_part( 'menus/menu', 'social-footer' ); // Loads the menus/menu-social-footer.php template. ?>
	
	<?php if( !get_theme_mod( 'hide_footer' ) ) : // Hide footer. ?>
	
		<?php has_nav_menu( 'social-footer' ) ? $extra_class = ' social-nav-footer-active' : $extra_class = ''; // Check for active social menu. ?>
	
		<footer id="colophon" class="site-footer<?php echo esc_attr( $extra_class ); ?>" role="contentinfo" <?php hybrid_attr( 'footer' ); ?>>
		
			<div class="site-info">
			
				<?php
					if( get_theme_mod( 'footer_text' ) ) :
						echo wp_kses_post( get_theme_mod( 'footer_text' ) );
					else :
				?>
				
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'chuchadon' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'chuchadon' ), 'WordPress' ); ?></a>
				<span class="sep"><?php echo esc_html_x( '&middot;', 'Separator in site info.', 'chuchadon' ); ?></span>
				<?php printf( esc_html__( 'Theme %1$s by %2$s', 'chuchadon' ), 'Chuchadon', '<a href="https://foxland.fi" rel="designer">Foxland</a>' ); ?>
			
			<?php endif; // End check for footer text. ?>
			
			</div><!-- .site-info -->
		
		</footer><!-- #colophon -->
		
	<?php endif; // End check for footer. ?>
	
	<?php do_action( 'chuchadon_after_footer' ); // Hook after footer. ?>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

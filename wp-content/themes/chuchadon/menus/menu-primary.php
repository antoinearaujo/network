<?php
/**
 * Primary menu.
 *
 * @package Chuchadon
 */
?>
	
<?php if ( has_nav_menu( 'top-left' ) || has_nav_menu( 'top-right' ) ) : ?>
	
	<nav id="menu-primary" class="menu main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'chuchadon' ); ?>" <?php hybrid_attr( 'menu', 'primary' ); ?>>
		<h2 class="screen-reader-text"><?php esc_html_e( 'Top Menu', 'chuchadon' ); ?></h2>
		
		<?php if ( has_nav_menu( 'top-left' ) ) : ?>
		
			<div class="wrap top-menu-left-wrap">
			
				<?php

					wp_nav_menu(
						array(
							'theme_location'  => 'top-left',
							'menu_id'         => 'top-left-items',
							'depth'           => 4,
							'menu_class'      => 'menu-items menu-items-left',
							'fallback_cb'     => ''
						)
					);
			
				?>
		
			</div><!-- .wrap -->
			
		<?php endif; // End check for top left menu. ?>
		
		<?php if ( has_nav_menu( 'top-right' ) ) : ?>
		
			<div class="wrap top-menu-right-wrap">
			
				<?php

					wp_nav_menu(
						array(
							'theme_location'  => 'top-right',
							'menu_id'         => 'top-right-items',
							'depth'           => 4,
							'menu_class'      => 'menu-items menu-items-right',
							'fallback_cb'     => ''
						)
					);
			
				?>
		
			</div><!-- .wrap -->
			
		<?php endif; // End check for top right menu. ?>
		
	</nav><!-- #menu-primary -->

<?php endif; // End check for main menu. ?>
<?php
/**
 * Social links menu in footer.
 *
 * @package Chuchadon
 */
?>

<?php if ( has_nav_menu( 'social-footer' ) ) : // Check if there's a menu assigned to the 'social-footer' location. ?>
	
	<nav id="menu-social-footer" class="menu-social menu-social-footer menu" role="navigation" aria-label="<?php esc_attr_e( 'Social Menu in Footer', 'chuchadon' ); ?>" <?php hybrid_attr( 'menu', 'social-footer' ); ?>>
		<h2 class="screen-reader-text"><?php esc_attr_e( 'Social Menu in Footer', 'chuchadon' ); ?></h2>
		
		<?php wp_nav_menu(
			array(
				'theme_location' => 'social-footer',
				'menu_id'        => 'social-menu-footer-items',
				'menu_class'     => 'social-menu-footer-items',
				'depth'          => 1,
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>',
				'fallback_cb'    => '',
			)
		); ?>
	</nav><!-- #menu-social-footer -->

<?php endif; // End check for menu. ?>
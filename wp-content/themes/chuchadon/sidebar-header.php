<?php
/**
 * Header Sidebar in Top of the page.
 *
 * @package Chuchadon
 */
?>

<?php if ( is_active_sidebar( 'header' ) ) : ?>

	<div id="sidebar-header-wrapper" class="sidebar-header-wrapper">

		<aside id="sidebar-header" class="sidebar-header sidebar-header-subsidiary sidebar" role="complementary" aria-labelledby="sidebar-header-header" <?php hybrid_attr( 'sidebar', 'header' ); ?>>
			<h2 class="screen-reader-text" id="sidebar-header-header"><?php echo esc_attr_x( 'Header Sidebar', 'Sidebar aria label', 'chuchadon' ); ?></h2>
		
			<div class="wrap">
				<div class="wrap-inside">
			
					<?php dynamic_sidebar( 'header' ); ?>
		
				</div><!-- .wrap-inside -->	
			</div><!-- .div -->

		</aside><!-- #sidebar-header .sidebar -->
	
	</div><!-- .sidebar-header-wrapper -->

<?php endif; // End check for header sidebar. ?>
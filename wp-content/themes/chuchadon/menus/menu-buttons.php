<?php
/**
 * Menu buttons.
 *
 * @package Chuchadon
 */
?>

<?php if ( has_nav_menu( 'top-left' ) || has_nav_menu( 'top-right' ) || has_nav_menu( 'social' ) || is_active_sidebar( 'header' ) ) : ?>
	
	<div id="top-search-form" class="top-search-form">
		<?php get_search_form() ?>
	</div>
	
	<div id="top-menu-buttons" class="top-menu-buttons clear" role="menu">
	
		<?php if ( has_nav_menu( 'top-left' ) || has_nav_menu( 'top-right' ) ) : ?>
	
			<span class="main-nav-menu-button-wrapper">

				<button id="nav-toggle" class="nav-toggle" aria-controls="menu-primary" aria-expanded="false" role="menuitem">
					<span id="nav-toggle-span" class="genericon genericon-menu" aria-hidden="true"></span>
					<span id="nav-toggle-menu" class="nav-toggle-menu top-menu-button"><?php esc_html_e( 'Menu', 'chuchadon' ); ?></span>
				</button>
			
			</span><!-- .main-nav-menu-button-wrapper -->
			
		<?php endif; // End check for main menu button. ?>
		
		<span class="top-search-header-social-buttons-wrapper">
		
			<button id="top-search-form-toggle" class="top-search-form-toggle" aria-controls="top-search-form" aria-expanded="false" role="menuitem">
				<span id="top-search-form-toggle-span" class="genericon genericon-search" aria-hidden="true"></span>
				<span id="top-search-form-toggle-menu" class="top-search-form-toggle-menu top-menu-button"><?php esc_html_e( 'Search', 'chuchadon' ); ?></span>
			</button>
			
			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<button id="social-nav-toggle" class="social-nav-toggle" aria-controls="menu-social" aria-expanded="false" role="menuitem">
					<span id="social-nav-toggle-span" class="genericon genericon-hierarchy" aria-hidden="true"></span>
					<span id="social-nav-toggle-menu" class="social-nav-toggle-menu top-menu-button"><?php esc_html_e( 'Social', 'chuchadon' ); ?></span>
				</button>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'header' ) ) : ?>
				<button id="header-sidebar-toggle" class="header-sidebar-toggle" aria-controls="sidebar-header-wrapper" aria-expanded="false" role="menuitem">
					<span id="header-sidebar-toggle-span" class="genericon genericon-ellipsis" aria-hidden="true"></span>
					<span id="header-sidebar-toggle-menu" class="header-sidebar-toggle-menu top-menu-button"><?php esc_html_e( 'Info', 'chuchadon' ); ?></span>
				</button>
			<?php endif; ?>
			
		</span><!-- .top-search-header-social-buttons-wrapper -->
			
	</div><!-- .top-menu-buttons -->
	
<?php endif; // End check for menu buttons. ?>
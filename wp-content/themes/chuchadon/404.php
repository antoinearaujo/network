<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Chuchadon
 */

get_header(); ?>

	<section class="entry error-404 not-found">
			
		<div class="entry-inner">

			<div class="page-content entry-content">

				<?php get_search_form(); ?>

				<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

				<?php if ( chuchadon_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php _e( 'Most Used Categories', 'chuchadon' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
				<?php endif; ?>

				<?php
					/* translators: %1$s: smiley */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'chuchadon' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
				?>

				<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

			</div><!-- .page-content -->
					
		</div><!-- .entry-inner -->
					
	</section><!-- .error-404 -->

<?php get_footer(); ?>

<?php
/**
 * Template Name: Child Pages
 *
 * This is the page template for displaying child pages.
 *
 * @package Chuchadon
 */

get_header(); ?>
		
	<?php // Child pages area
		$child_pages = new WP_Query( apply_filters( 'chuchadon_child_pages_template_arguments',array(
			'post_type'      => 'page',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_parent'    => $post->ID,
			'posts_per_page' => 500,
			'no_found_rows'  => true,
		) ) );
	?>

	<?php if ( $child_pages->have_posts() ) : ?>

		<div id="child-pages-area" class="child-pages-area child-pages-child-pages-area grid-area">			
			<div class="child-pages-wrapper grid-area-wrapper">

				<?php
					while ( $child_pages->have_posts() ) : $child_pages->the_post();
						get_template_part( 'template-parts/content', 'child-pages' );
					endwhile;
				?>

			</div><!-- .child-pages-wrapper -->
		</div><!-- #child-pages-area -->

	<?php
		endif; // End loop.
		wp_reset_postdata(); // Reset post data.
	?>

<?php get_footer(); ?>

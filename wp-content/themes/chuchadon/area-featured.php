			<?php
			/**
			 * Featured Content area in Front Page Template.
			 *
			 * @package Chuchadon
			 */

				/* Get what we want to show on front page. */
				$chuchadon_featured_area = get_theme_mod( 'front_page_featured', 'blog-posts' );
				
				/* Bail if we do not want to show anything. */
				if( 'nothing' == esc_attr( $chuchadon_featured_area ) ) :
					return;
				endif;
				
				if( 'blog-posts' == esc_attr( $chuchadon_featured_area ) ) :
					
					/* Blog Posts Query. */
					$featured_content = new WP_Query( apply_filters( 'chuchadon_blog_posts_arguments', array(
					'post_type'       => 'post',
					'posts_per_page'  => 4,
					'no_found_rows'   => true,
					) ) );
					
				else :
				
					/* Child Pages Query. */
					$featured_content = new WP_Query( apply_filters( 'chuchadon_child_pages_arguments',array(
						'post_type'      => 'page',
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
						'post_parent'    => $post->ID,
						'posts_per_page' => 500,
						'no_found_rows'  => true,
					) ) );
					
				endif; // End check for featured content.
			?>

			<?php if ( $featured_content->have_posts() ) : ?>

				<div id="featured-area" class="featured-area grid-area <?php echo esc_attr( $chuchadon_featured_area ); ?>-area">			
					
		 			<?php // Featured are title and link
						if( get_theme_mod( 'featured_area_title', esc_html__( 'Articles', 'chuchadon' ) ) || ( get_theme_mod( 'featured_area_url' ) && get_theme_mod( 'featured_area_url_text' ) ) ) :
								
							// Featured are title
							if( get_theme_mod( 'featured_area_title', esc_html__( 'Articles', 'chuchadon' ) ) ) :
								echo '<h2 class="featured-title">' . esc_html( get_theme_mod( 'featured_area_title' ), esc_html__( 'Articles', 'chuchadon' ) );
							endif;
							
							// Featured are link
							if( get_theme_mod( 'featured_area_url' ) && get_theme_mod( 'featured_area_url_text' ) ) :
								echo ' <span class="featured-mark-between">' . _x( '&ndash;', 'Dash between featured title and link', 'chuchadon' ) . '</span>';
								echo ' <a class="featured-link" href="' . esc_url( get_theme_mod( 'featured_area_url' ) ) . '">' . esc_html( get_theme_mod( 'featured_area_url_text' ) ) . '</a>';
							endif;
							
							echo '</h2>';
							
						endif; // End featured are title and link
					?>
					
		 			<?php 
					?>
					
					<div class="featured-wrapper grid-area-wrapper <?php echo esc_attr( $chuchadon_featured_area ); ?>-wrapper">

						<?php while ( $featured_content->have_posts() ) : $featured_content->the_post(); ?>

							<?php
								if( 'blog-posts' == esc_attr( $chuchadon_featured_area ) ) :
									get_template_part( 'template-parts/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
								elseif( 'portfolios' == esc_attr( $chuchadon_featured_area ) ) :
									get_template_part( 'template-parts/content', 'jetpack-portfolio' );
								else :
									get_template_part( 'template-parts/content', 'child-pages' );
								endif;
							?>						

						<?php endwhile; ?>

					</div><!-- .featured-wrapper -->
				</div><!-- #featured-area -->

			<?php
				endif; // End loop.
				wp_reset_postdata(); // Reset post data.
			?>
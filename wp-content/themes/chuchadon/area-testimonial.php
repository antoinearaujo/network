			<?php 
			/**
			 * Testimonial area in Front Page Template.
			 *
			 * @package Chuchadon
			 */
			
			if( ! get_theme_mod( 'hide_testimonials' ) ) : // Check do we want to show testimonials. ?>
			
				<?php // Testimonials area
					$testimonials = new WP_Query( apply_filters( 'chuchadon_testimonials_arguments',array(
						'post_type'      => 'jetpack-testimonial',
						'orderby'        => 'rand',
						'posts_per_page' => 4,
						'no_found_rows'  => true,
					) ) );
				?>

				<?php if ( $testimonials->have_posts() ) : ?>

					<div id="testimonial-area" class="testimonial-area front-page-area">
				
						<?php
							$jetpack_options = get_theme_mod( 'jetpack_testimonials' );
							$chuchadon_testimonial_heading = $jetpack_options['page-title'] ? esc_html( $jetpack_options['page-title'] ) : esc_html__( 'Testimonials', 'chuchadon' );
							echo '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>' . $chuchadon_testimonial_heading . '</h2>';
						?>
					
						<div class="testimonial-wrapper">

							<?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>

								<?php get_template_part( 'template-parts/content', 'jetpack-testimonial' ); ?>

							<?php endwhile; ?>

						</div><!-- .testimonial-wrapper -->
					</div><!-- #testimonial-area -->

				<?php
					endif; // End loop.
					wp_reset_postdata(); // Reset post data.
				?>
			
			<?php endif; // End check for testimonials ?>
<?php
/**
 * Loop meta content for displaying title and description in the header.
 *
 * @package Chuchadon
 */
?>

<div class="loop-meta" <?php hybrid_attr( 'loop-meta' ); ?>>

	<?php
		if ( is_home() && !is_front_page() ) :
			$chuchadon_archive_title = get_post_field( 'post_title', get_queried_object_id() );
			/* Support for Subtitles Plugin. */
			if ( function_exists( 'get_the_subtitle' ) ) :
				$chuchadon_loop_desc = get_the_subtitle( get_queried_object_id() ); 
			endif;
		elseif( is_404() ) :
			$chuchadon_archive_title = __( 'Oops! That page can&rsquo;t be found.', 'chuchadon' );
			$chuchadon_loop_desc     = __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'chuchadon' );
		elseif( is_search() ) :
			/* Translators: %s is the search query. The HTML entities are opening and closing curly quotes. */
			$chuchadon_archive_title = sprintf( __( 'Search results for &#8220;%s&#8221;', 'chuchadon' ), get_search_query() );
			$chuchadon_loop_desc     = sprintf( __( 'You are browsing the search results for &#8220;%s&#8221;', 'chuchadon' ), get_search_query() );;
		elseif( is_author() ) :
			$chuchadon_archive_title = get_the_archive_title();
			$chuchadon_loop_desc     = get_the_author_meta( 'description', get_query_var( 'author' ) );
		elseif( is_post_type_archive( 'jetpack-testimonial' ) ) :
			$jetpack_options = get_theme_mod( 'jetpack_testimonials' );
			$chuchadon_archive_title = $jetpack_options['page-title'] ? esc_html( $jetpack_options['page-title'] ) : esc_html__( 'Testimonials', 'chuchadon' );
			$chuchadon_loop_desc     = convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( $jetpack_options['page-content'] ) ) ) ) ) );
		elseif( is_post_type_archive( 'jetpack-portfolio' ) ) :
			$chuchadon_archive_title = get_theme_mod( 'portfolio_title' ) ? esc_html( get_theme_mod( 'portfolio_title' ) ) : esc_html__( 'Portfolio', 'chuchadon' );
			$chuchadon_loop_desc     = get_theme_mod( 'portfolio_description' ) ? esc_html( get_theme_mod( 'portfolio_description' ) ) : esc_html__( 'Check out our latest work', 'chuchadon' );
		else :
			$chuchadon_archive_title = get_the_archive_title();
			$chuchadon_loop_desc     = get_the_archive_description();		
		endif;
	?>

	<h1 class="site-title loop-title" <?php hybrid_attr( 'loop-title' ); ?>><?php echo $chuchadon_archive_title; ?></h1>

	<?php if ( $chuchadon_loop_desc ) : ?>

		<div class="site-description loop-description" <?php hybrid_attr( 'loop-description' ); ?>>
			<?php echo $chuchadon_loop_desc; ?>
		</div><!-- .loop-description -->
		
	<?php endif; // End paged check. ?>

</div><!-- .loop-meta -->
<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Chuchadon
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php chuchadon_post_thumbnail(); ?>

	<div class="entry-inner">

			<?php if ( !is_singular() ) : ?>
				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				</header><!-- .entry-header -->
			<?php endif; ?>
		
		<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Read more %s', 'chuchadon' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );
				
				wp_link_pages( array(
					'before'      => '<div class="page-links">' . __( 'Pages:', 'chuchadon' ),
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'chuchadon' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">,</span> ',
				) );
			?>
		</div><!-- .entry-content -->
		
	</div><!-- .entry-inner -->

</article><!-- #post-## -->

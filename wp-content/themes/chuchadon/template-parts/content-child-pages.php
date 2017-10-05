<?php
/**
 * The template used for displaying child pages content in pages/front-page.php and pages/child-pages.php
 *
 * @package Chuchadon
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php chuchadon_post_thumbnail(); ?>

	<div class="entry-inner">
		
		<header class="entry-header">

			<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		
		</header><!-- .entry-header -->
		
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	
	</div><!-- .entry-inner -->

</article><!-- #post-## -->

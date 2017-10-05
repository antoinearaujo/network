<?php
/**
 * Output Callout text in header.
 *
 * @package Chuchadon
 */
 
/* Get post meta for Callouts in singular pages. */
$chuchadon_callout_text = get_post_meta( get_the_ID(), '_chuchadon_callout_text', true );
$chuchadon_callout_url  = get_post_meta( get_the_ID(), '_chuchadon_callout_url', true );

?>


<div class="loop-meta callout-meta" <?php hybrid_attr( 'loop-meta' ); ?>>

	<h1 class="entry-title site-title loop-title" <?php hybrid_attr( 'loop-title' ); ?>><?php single_post_title(); ?></h1>
	<?php
		/* Support for Subtitles Plugin. */
		if ( function_exists( 'the_subtitle' ) ) :
			the_subtitle( '<div class="entry-subtitle site-description loop-description">', '</div>' ); 
		endif;
	?>
		
	<?php if ( chuchadon_check_callout_output() ) : // Check if there is Callout text and link. This function can be found in functions.php. ?>
	
		<?php // Set callout text and link
			$chuchadon_callout_text = '<a class="chuchadon-button" href="' . esc_url( $chuchadon_callout_url ) . '">' . esc_attr( $chuchadon_callout_text ) . '</a>';
		?>
		
		<div class="callout-title chuchadon-button" <?php hybrid_attr( 'loop-description' ); ?>>
			<?php echo $chuchadon_callout_text; ?>
		</div><!-- .loop-description -->
		
	<?php endif; // End callout check. ?>

</div><!-- .loop-meta -->
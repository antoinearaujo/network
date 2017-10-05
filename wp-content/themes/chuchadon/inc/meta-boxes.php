<?php
/**
 * Add metabox for Callout info on singular page header section.
 *
 * @package Chuchadon
 */

/**
 * Add custom meta box for wanted post types. This can be filtered in filter 'chuchadon_when_to_show_callout_metaboxes'.
 *
 * @since 1.0.0
 * @return void
 */

function chuchadon_create_meta_boxes() {
	
	/* When to show metaboxes. */
	$chuchadon_when_to_show_metaboxes = apply_filters( 'chuchadon_when_to_show_callout_metaboxes', array( 'page', 'post', 'jetpack-portfolio', 'jetpack-testimonial' ) );
	
	/* Load metaboxes. */
	foreach ( $chuchadon_when_to_show_metaboxes as $chuchadon_when_to_show_metabox ) {
		add_meta_box( 'chuchadon_metabox', esc_html__( 'Header Callout text', 'chuchadon' ), 'chuchadon_meta_box_display', $chuchadon_when_to_show_metabox, 'normal', 'high' );
	}
	
}
add_action( 'add_meta_boxes', 'chuchadon_create_meta_boxes' );

/**
 * Displays the extra meta box.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $post
 * @param  array   $metabox
 * @return void
 */
function chuchadon_meta_box_display( $post, $metabox ) {

	wp_nonce_field( basename( __FILE__ ), 'chuchadon-metabox-nonce' ); ?>
	
	</p>
		<?php _e( 'Add callout link in singular views.', 'chuchadon' ); ?>
	</p>
	
	<p>
		<label for="chuchadon-callout-text"><?php _e( 'Callout text (required)', 'chuchadon' ); ?></label>
		<br />
		<input type="text" name="chuchadon-callout-text" id="chuchadon-callout-text" value="<?php echo esc_attr( get_post_meta( $post->ID, '_chuchadon_callout_text', true ) ); ?>" size="30" style="width: 99%;" />
	</p>
	
	<p>
		<label for="chuchadon-callout-url"><?php _e( 'Callout URL (required)', 'chuchadon' ); ?></label>
		<br />
		<input type="text" name="chuchadon-callout-url" id="chuchadon-callout-url" value="<?php echo esc_attr( get_post_meta( $post->ID, '_chuchadon_callout_url', true ) ); ?>" size="30" style="width: 99%;" />
	</p>
	

	<?php
	
}

/**
 * Saves the metadata for the portfolio item info meta box.
 *
 * @since  1.0.0
 * @access public
 * @param  int     $post_id
 * @param  object  $post
 * @return void
 */
function chuchadon_save_meta_boxes( $post_id, $post ) {

	/* Check nonce. */
	if ( !isset( $_POST['chuchadon-metabox-nonce'] ) || !wp_verify_nonce( $_POST['chuchadon-metabox-nonce'], basename( __FILE__ ) ) ) {
		return;
	}
	
	/* Check autosave, ajax or bulk edit. */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || ( defined( 'DOING_AJAX') && DOING_AJAX ) || isset( $_REQUEST['bulk_edit'] ) ) {
		return;
	}

	$meta = array(
		'_chuchadon_callout_text' => sanitize_text_field( $_POST['chuchadon-callout-text'] ),
		'_chuchadon_callout_url'  => esc_url( $_POST['chuchadon-callout-url'] )
	);

	foreach ( $meta as $meta_key => $new_meta_value ) {

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If there is no new meta value but an old value exists, delete it. */
		if ( current_user_can( 'edit_post', $post_id ) && '' == $new_meta_value && $meta_value ) {
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}

		/* If a new meta value was added and there was no previous value, add it. */
		elseif ( current_user_can( 'edit_post', $post_id ) && $new_meta_value && '' == $meta_value ) {
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		/* If the new meta value does not match the old value, update it. */
		elseif ( current_user_can( 'edit_post', $post_id ) && $new_meta_value && $new_meta_value != $meta_value ) {
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}
		
	}
	
}
add_action( 'save_post', 'chuchadon_save_meta_boxes', 10, 2 );

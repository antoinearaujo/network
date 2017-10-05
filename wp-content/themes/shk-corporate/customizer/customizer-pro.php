<?php
//Pro Button
function shk_corporate_pro_customizer( $wp_customize ) {
class WP_shk_corporate_Pro_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
     <div class="pro-box">
       <a href="<?php echo 'http://webriti.com/appointment?utm_source=wordpress-customizer&utm_medium=referral&utm_campaign=shk-corporate';?>" target="_blank" class="upgrade" id="review_pro"><?php _e('UPGRADE TO PRO','shk-corporate'); ?></a>
		
	</div>
    <?php
    }
}
$wp_customize->add_setting(
    'shk_upgrade_pro',
    array(
       'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_shk_corporate_Pro_Customize_Control( $wp_customize, 'shk_upgrade_pro', array(
		'section' => 'appointment_pro_section',
		'setting' => 'shk_upgrade_pro',
    ))
);
}
add_action( 'customize_register', 'shk_corporate_pro_customizer' );
?>
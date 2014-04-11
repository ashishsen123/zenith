<?php
/*
 * Theme Settings
 * 
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Tung Do <ttsondo@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/cascade
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
add_action( 'admin_menu', 'cascade_theme_admin_setup' );

function cascade_theme_admin_setup() {
    
	global $theme_settings_page;
	
	/* Get the theme settings page name */
	$theme_settings_page = 'appearance_page_theme-settings';

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'cascade_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'cascade_theme_validate_settings' );
	
	/* Enqueue styles */
	add_action( 'admin_enqueue_scripts', 'cascade_admin_scripts' );

}

/* Adds custom meta boxes to the theme settings page. */
function cascade_theme_settings_meta_boxes() {

	/* Add a custom meta box. */
	add_meta_box(
		'cascade-theme-meta-box',			// Name/ID
		__( 'General', 'cascade' ),	// Label
		'cascade_theme_meta_box',			// Callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'normal',					// Which meta box holder?
		'high'					// High/low within the meta box holder
	);
	
	/* Add a custom meta box. */
	add_meta_box(
		'cascade-theme-meta-box-2',			// Name/ID
		__( 'Layout', 'cascade' ),	// Label
		'cascade_theme_meta_box_2',			// Callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'side',					// Which meta box holder?
		'high'					// High/low within the meta box holder
	);	

	/* Add additional add_meta_box() calls here. */
}

/* Function for displaying the first meta box. */
function cascade_theme_meta_box() { ?>

	<table class="form-table">
	
		<!-- Logo upload -->

		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'cascade_logo_url' ); ?>"><?php _e( 'Logo:', 'cascade' ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'cascade_logo_url' ); ?>" name="<?php echo hybrid_settings_field_name( 'cascade_logo_url' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'cascade_logo_url' ) ); ?>" />
				<input id="cascade_logo_upload_button" class="button" type="button" value="Upload" />
				<p class="description"><?php _e( 'Upload image for logo. Once uploaded, click the <strong>Insert Into Post</strong> button. If that does not work, copy the address of the image and paste it in the input field above. Next, click on <strong>Save Settings</strong> buton at the bottom of this page. The image will automatically display here after settings are saved.', 'cascade' ); ?></p>
				
				<?php /* Display uploaded image */
				if ( hybrid_get_setting( 'cascade_logo_url' ) ) { ?>
                    <p><img src="<?php echo hybrid_get_setting( 'cascade_logo_url' ); ?>" alt=""/></p>
				<?php } ?>
			</td>
		</tr>

		<!-- Featured Slider -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'cascade_featured_slider' ); ?>"><?php _e( 'Featured Slider ID:', 'cascade' ); ?></label>
			</th>
			<td>
				<p><input type="text" id="<?php echo hybrid_settings_field_id( 'cascade_featured_slider' ); ?>" name="<?php echo hybrid_settings_field_name( 'cascade_featured_slider' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'cascade_featured_slider' ) ); ?>" /></p>
				<p class="description"><?php _e( 'If the <a href="http://devpress.com/plugins/sliders">DevPress Sliders</a> plugin is installed, enter the ID number of the slider you want to feature on your blog home page.', 'cascade' ); ?></p>
			</td>
		</tr>

		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
	
}

/* Function for displaying the second meta box. */
function cascade_theme_meta_box_2() { ?>

	<table class="form-table">
		
		<!-- Global Layout -->
		<tr>
			<th>
			    <label for="<?php echo esc_attr( hybrid_settings_field_id( 'cascade_global_layout' ) ); ?>"><?php _e( 'Global Layout:', 'cascade' ); ?></label>
			</th>
			<td>
			    <select id="<?php echo esc_attr( hybrid_settings_field_id( 'cascade_global_layout' ) ); ?>" name="<?php echo esc_attr( hybrid_settings_field_name( 'cascade_global_layout' ) ); ?>">
				<option value="layout_default" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_default' ); ?>> <?php echo __( 'layout_default', 'cascade' ) ?> </option>
				<option value="layout_1c" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_1c' ); ?>> <?php echo __( 'layout_1c', 'cascade' ) ?> </option>
				<option value="layout_2c_l" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_2c_l' ); ?>> <?php echo __( 'layout_2c_l', 'cascade' ) ?> </option>
				<option value="layout_2c_r" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_2c_r' ); ?>> <?php echo __( 'layout_2c_r', 'cascade' ) ?> </option>
				<option value="layout_3c_c" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_3c_c' ); ?>> <?php echo __( 'layout_3c_c', 'cascade' ) ?> </option>
				<option value="layout_3c_l" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_3c_l' ); ?>> <?php echo __( 'layout_3c_l', 'cascade' ) ?> </option>
				<option value="layout_3c_r" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_3c_r' ); ?>> <?php echo __( 'layout_3c_r', 'cascade' ) ?> </option>
				<option value="layout_hl_1c" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_hl_1c' ); ?>> <?php echo __( 'layout_hl_1c', 'cascade' ) ?> </option>
				<option value="layout_hl_2c_l" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_hl_2c_l' ); ?>> <?php echo __( 'layout_hl_2c_l', 'cascade' ) ?> </option>
				<option value="layout_hl_2c_r" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_hl_2c_r' ); ?>> <?php echo __( 'layout_hl_2c_r', 'cascade' ) ?> </option>
				<option value="layout_hr_1c" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_hr_1c' ); ?>> <?php echo __( 'layout_hr_1c', 'cascade' ) ?> </option>
				<option value="layout_hr_2c_l" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_hr_2c_l' ); ?>> <?php echo __( 'layout_hr_2c_l', 'cascade' ) ?> </option>
				<option value="layout_hr_2c_r" <?php selected( hybrid_get_setting( 'cascade_global_layout' ), 'layout_hr_2c_r' ); ?>> <?php echo __( 'layout_hr_2c_r', 'cascade' ) ?> </option>
			    </select>
			    <span class="description"><?php _e( 'Set the layout for the entire site. The default layout is 2 columns with content on the left.', 'cascade' ); ?></span>
			</td>
		</tr>	
		
		<!-- End custom form elements. -->
	</table><!-- .form-table -->		
	
<?php }		

/* Validate theme settings. */
function cascade_theme_validate_settings( $settings ) {

	$settings['cascade_logo_url'] = esc_url_raw( $settings['cascade_logo_url'] );
	$settings['cascade_featured_slider'] = absint ( $settings['cascade_featured_slider'] );
	$settings['cascade_global_layout'] = wp_filter_nohtml_kses( $settings['cascade_global_layout'] );

    /* Return the array of theme settings. */
    return $settings;
}

/* Enqueue scripts (and related stylesheets) */
function cascade_admin_scripts( $hook_suffix ) {
    
    global $theme_settings_page;
	
    if ( $theme_settings_page == $hook_suffix ) {

	    wp_enqueue_script( 'cascade-admin', get_template_directory_uri() . '/js/cascade-admin.js', array( 'jquery', 'media-upload' ), '20121004', false );

    }
}

?>
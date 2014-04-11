<?php
/*
 * Theme Settings
 * 
 * @package Murmur
 * @subpackage Settings
 * @since 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
add_action( 'admin_menu', 'murmur_theme_admin_setup' );

function murmur_theme_admin_setup() {
    
	global $theme_settings_page;
	
	/* Get the theme settings page name */
	$theme_settings_page = 'appearance_page_theme-settings';

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'murmur_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'murmur_theme_validate_settings' );
	
	/* Enqueue styles */
	add_action( 'admin_enqueue_scripts', 'murmur_admin_scripts' );

}

/* Adds custom meta boxes to the theme settings page. */
function murmur_theme_settings_meta_boxes() {

	/* Add a custom meta box. */
	add_meta_box(
		'murmur-theme-meta-box',			// Name/ID
		__( 'General', 'murmur' ),	// Label
		'murmur_theme_meta_box',			// Callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'normal',					// Which meta box holder?
		'high'					// High/low within the meta box holder
	);
	
	/* Add a custom meta box. */
	add_meta_box(
		'murmur-theme-meta-box-2',			// Name/ID
		__( 'Portfolio Showcase', 'murmur' ),	// Label
		'murmur_theme_meta_box_2',			// Callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'side',					// Which meta box holder?
		'high'					// High/low within the meta box holder
	);

	/* Add additional add_meta_box() calls here. */
}

/* Function for displaying the first meta box. */
function murmur_theme_meta_box() { ?>

	<table class="form-table">
	
		<!-- Logo upload -->

		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'murmur_logo_url' ); ?>"><?php _e( 'Logo:', 'murmur' ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'murmur_logo_url' ); ?>" name="<?php echo hybrid_settings_field_name( 'murmur_logo_url' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'murmur_logo_url' ) ); ?>" />
				<input id="murmur_logo_upload_button" class="button" type="button" value="Upload" />
				<p class="description"><?php _e( 'Upload image for logo. Once uploaded, click the Insert Into Post button. If that does not work, copy the address of the image and paste it in the input field above. Next, click on Save Settings button at the bottom of this page. The image will automatically display here after settings are saved.', 'murmur' ); ?></p>
				
				<?php /* Display uploaded image */
				if ( hybrid_get_setting( 'murmur_logo_url' ) ) { ?>
                    <p><img src="<?php echo hybrid_get_setting( 'murmur_logo_url' ); ?>" alt=""/></p>
				<?php } ?>
			</td>
		</tr>
		
		<!-- Show Site Description -->
		<tr>
			<th><label for="<?php echo hybrid_settings_field_id( 'murmur_site_description_toggle' ); ?>"><?php _e( 'Site Description Toggle:', 'murmur' ); ?></label></th>
			<td>
				<input class="checkbox" type="checkbox" <?php checked( hybrid_get_setting( 'murmur_site_description_toggle' ), true ); ?> id="<?php echo esc_attr( hybrid_settings_field_id( 'murmur_site_description_toggle' ) ); ?>" name="<?php echo esc_attr( hybrid_settings_field_name( 'murmur_site_description_toggle' ) ); ?>" />
				<label for="<?php echo esc_attr( hybrid_settings_field_id( 'murmur_site_description_toggle' ) ); ?>"><?php _e( 'Check this box to hide site description', 'murmur' ); ?></label>
			</td>
		</tr>
		
		<!-- Extended Site Description -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'murmur_site_description_extended' ); ?>"><?php _e( 'Extended Site Description:', 'murmur' ); ?></label>
			</th>
			<td>
				<p><textarea id="<?php echo hybrid_settings_field_id( 'murmur_site_description_extended' ); ?>" name="<?php echo hybrid_settings_field_name( 'murmur_site_description_extended' ); ?>" cols="60" rows="5" style="width: 98%;"><?php echo wp_htmledit_pre( stripslashes( hybrid_get_setting( 'murmur_site_description_extended' ) ) ); ?></textarea></p>
				<p class="description"><?php _e( 'Write a sentence or two about your company or services. This extended site description will be displayed directly below the header, before the main content.', 'murmur' ); ?></p>
			</td>
		</tr>
		
		<!-- End custom form elements. -->
	</table><!-- .form-table -->

<?php }

/* Function for displaying the second meta box. */
function murmur_theme_meta_box_2() { ?>

	<p>
		<span class="description">
			<?php _e( 'The following settings are for the Portfolio Showcase template.', 'murmur' ); ?>
		</span>
	</p>

	<table class="form-table">
	
		<!-- Number of Slides -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'murmur_slides_number' ); ?>"><?php _e( 'Number of Slides:', 'murmur' ); ?></label>
			</th>
			<td>
				<p><input type="text" id="<?php echo hybrid_settings_field_id( 'murmur_slides_number' ); ?>" name="<?php echo hybrid_settings_field_name( 'murmur_slides_number' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'murmur_slides_number' ) ); ?>" /></p>
				<p><?php _e( 'Enter a number for the amount of slides you want to feature on the Portolio Showcase template. The slider works only if the DP Portfolio plugin is installed and several project entries exists.', 'murmur' ); ?></p>
			</td>
		</tr>

	</table><!-- .form-table -->
	
	<?php

	wp_editor(
		esc_textarea( hybrid_get_setting( 'murmur_feature_one' ) ),	// Editor content.
		hybrid_settings_field_id( 'murmur_feature_one' ), // Editor ID.
		array(
			'tinymce' => false, // Don't use TinyMCE in a meta box.
			'textarea_name' => hybrid_settings_field_name( 'murmur_feature_one' )
		)
	); ?>
	
	<p>
		<span class="description">
			<?php _e( 'After the slider of Portfolio Showcase template, enter information for the first featured area, typically used to introduce one of your available services.', 'murmur' ); ?>
		</span>
	</p>
	
	<?php

	wp_editor(
		esc_textarea( hybrid_get_setting( 'murmur_feature_two' ) ),	// Editor content.
		hybrid_settings_field_id( 'murmur_feature_two' ), // Editor ID.
		array(
			'tinymce' => false, // Don't use TinyMCE in a meta box.
			'textarea_name' => hybrid_settings_field_name( 'murmur_feature_two' )
		)
	); ?>
	
	<p>
		<span class="description">
			<?php _e( 'Enter information for the second featured area.', 'murmur' ); ?>
		</span>
	</p>
	
	<?php

	wp_editor(
		esc_textarea( hybrid_get_setting( 'murmur_feature_three' ) ),	// Editor content.
		hybrid_settings_field_id( 'murmur_feature_three' ), // Editor ID.
		array(
			'tinymce' => false, // Don't use TinyMCE in a meta box.
			'textarea_name' => hybrid_settings_field_name( 'murmur_feature_three' )
		)
	); ?>
	
	<p>
		<span class="description">
			<?php _e( 'Enter information for the third featured area.', 'murmur' ); ?>
		</span>
	</p>


<?php }

/* Validate theme settings. */
function murmur_theme_validate_settings( $settings ) {

	$settings['murmur_logo_url'] = esc_url_raw( $settings['murmur_logo_url'] );
	$settings['murmur_site_description_toggle'] = ( isset( $settings['murmur_site_description_toggle'] ) ? 1 : 0 );
	$settings['murmur_site_description_extended'] = wp_filter_nohtml_kses( $settings['murmur_site_description_extended'] );
	$settings['murmur_slides_number'] = absint( $settings['murmur_slides_number'] );
	
	if ( !current_user_can( 'unfiltered_html' ) ) {
	
		if ( isset( $settings['murmur_feature_one'] ) )
			$settings['murmur_feature_one'] = stripslashes( wp_filter_post_kses( addslashes( $settings['murmur_feature_one'] ) ) );
		if ( isset( $settings['murmur_feature_two'] ) )
			$settings['murmur_feature_two'] = stripslashes( wp_filter_post_kses( addslashes( $settings['murmur_feature_two'] ) ) );
		if ( isset( $settings['murmur_feature_three'] ) )
			$settings['murmur_feature_three'] = stripslashes( wp_filter_post_kses( addslashes( $settings['murmur_feature_three'] ) ) );
			
	}

    /* Return the array of theme settings. */
    return $settings;
}

/* Enqueue scripts (and related stylesheets) */
function murmur_admin_scripts( $hook_suffix ) {
    
    global $theme_settings_page;
	
    if ( $theme_settings_page == $hook_suffix ) {

	    wp_enqueue_script( 'murmur-admin', get_template_directory_uri() . '/js/murmur-admin.js', array( 'jquery', 'media-upload' ), '20120831', false );

    }
}

?>
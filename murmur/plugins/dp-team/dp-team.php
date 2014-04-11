<?php
/**
 * Plugin Name: DevPress Team
 * Plugin URI: http://devpress.com/themes/murmur/
 * Description: A plugin for creating a "staff" custom post type and its meta fields.
 * Version: 0.1
 * Author: Tung Do
 * Author URI: http://devpress.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License version 2, as published by the Free Software Foundation.  You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package DevPress Team
 * @version 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012 Tung Do
 * @link http://devpress.com/themes/murmur/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */

/* Setup the plugin. */
add_action( 'plugins_loaded', 'dp_team_setup' );

/* Register plugin activation hook. */
register_activation_hook( __FILE__, 'dp_team_activation' );
	
/* Register plugin activation hook. */
register_deactivation_hook( __FILE__, 'dp_team_deactivation' );

/**
 * Plugin set up function. This function adds support for plugin features and defines the default theme actions and filters.
 *
 * @since 0.1.0
 */
 
function dp_team_setup() {

	/* Load translations on the backend. */
	if ( is_admin() )
		load_plugin_textdomain( 'dp-team', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		
	/* Register custom post types */
	add_action( 'init', 'dp_team_register_post_types' );
	
	/* Add meta box. */
	add_action( 'add_meta_boxes', 'dp_team_create_meta_boxes' );
	
	/* Save meta box. */
	add_action( 'save_post', 'dp_team_save_member_details', 10, 2 );

}

/**
 * Do things on plugin activation.
 *
 * @since 0.1
 */
function dp_team_activation() {
	
	/* Register the custom post type. */
    dp_team_register_post_types();
	
	/* Flush permalinks. */
    flush_rewrite_rules();
}

/**
 * Flush permalinks on plugin deactivation.
 *
 * @since 0.1
 */
function dp_team_deactivation() {
    flush_rewrite_rules();
}

/**
 * Register the 'team' custom post type.
 *
 * @since 0.1
 */
function dp_team_register_post_types() {

	/* Labels for the team post type. */
	$team_labels = array(
		'name' => __( 'Team', 'dp-team' ),
		'singular_name' => __( 'Team Member', 'dp-team' ),
		'all_items' => __( 'All Team Members', 'dp-team' ),
		'add_new' => __( 'Add New Member', 'dp-team' ),
		'add_new_item' => __( 'Add New Member', 'dp-team' ),
		'edit' => __( 'Edit', 'dp-team' ),
		'edit_item' => __( 'Edit Member', 'dp-team' ),
		'new_item' => __( 'New Member', 'dp-team' ),
		'not_found' => __( 'No members found', 'dp-team' ),
		'not_found_in_trash' => __( 'No members found in Trash', 'dp-team' ),
		'search_items' => __( 'Search Team', 'dp-team' ),
		'view_item' => __( 'View Member', 'dp-team' )
	);

	/* Arguments for the team post type. */
	$team_args = array(
		'can_export' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'labels' => $team_labels,
		'public' => true,
		'query_var' => 'team',
		'rewrite' => array( 'slug' => 'team', 'with_front' => false ),
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' )
	);

	/* Register the video post type. */
	register_post_type( apply_filters( 'dp_team_post_type', 'team' ), apply_filters( 'dp_team_post_type_args', $team_args ) );

}

/**
 * Create custom meta boxes.
 *
 * @since 0.1.0
 */
 
function dp_team_create_meta_boxes() {

	/* Add custom meta box for member details fields */
	add_meta_box(
		'dp-team-member-details',
		__( 'Team Member&#39;s Details', 'dp-team' ),
		'dp_team_display_member_details',
		'team',
		'normal',
		'high'
	);

}

/**
 * Display custom meta boxes.
 *
 * @since 0.1.0
 */

function dp_team_display_member_details() {

	global $post;	

	wp_nonce_field( basename( __FILE__ ), 'dp_team_member_details_nonce' );
	
	/* Retrieve the member's position if it already exists. */
	$member_position = get_post_meta( $post->ID, 'dp_team_member_position', true ); ?>
	
	<p>
		<label for="dp-team-member-position"><?php echo _e( 'Member&#39;s Position', 'dp-team' ); ?></label>
		<br />
		<input type="text" name="dp-team-member-position" id="dp-team-member-position" value="<?php echo wp_filter_nohtml_kses( $member_position ); ?>" style="width: 99%" />
	</p>
	
	<span class="description"><?php echo _e( 'The job title, position, or responsibility of the member.', 'dp-team' ); ?></span>

<?php }

/**
 * Save custom meta box info.
 *
 * @since 0.1.0
 */
 
function dp_team_save_member_details( $post_id, $post ) {

	if ( !isset( $_POST['dp_team_member_details_nonce'] ) || !wp_verify_nonce( $_POST['dp_team_member_details_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
		
	$meta = array(
		'dp_team_member_position' => wp_filter_nohtml_kses( strip_tags( $_POST['dp-team-member-position'] ) )
	);
	
	foreach ( $meta as $meta_key => $new_meta_value ) {

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If a new meta value was added and there was no previous value, add it. */
		if ( $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );

		/* If there is no new meta value but an old value exists, delete it. */
		elseif ( '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );
	}

}
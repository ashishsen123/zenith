<?php
/**
 * Plugin Name: DevPress Portfolio
 * Plugin URI: http://devpress.com/plugins/dp-portfolio
 * Description: A plugin for creating a "project" custom post type and its meta fields.
 * Version: 0.1.4.1
 * Author: Tung Do
 * Author URI: http://devpress.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License version 2, as published by the Free Software Foundation.  You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package DevPress Portfolio
 * @version 0.1.4
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012 Tung Do
 * @link http://devpress.com/themes/murmur/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */

/* Setup the plugin. */
add_action( 'plugins_loaded', 'dp_portfolio_setup' );

/* Register plugin activation hook. */
register_activation_hook( __FILE__, 'dp_portfolio_activation' );
	
/* Register plugin activation hook. */
register_deactivation_hook( __FILE__, 'dp_portfolio_deactivation' );

/**
 * Plugin set up function. This function adds support for plugin features and defines the default theme actions and filters.
 *
 * @since 0.1.0
 */
 
function dp_portfolio_setup() {

	/* Load translations on the backend. */
	if ( is_admin() )
		load_plugin_textdomain( 'dp-portfolio', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		
	/* Register custom post types */
	add_action( 'init', 'dp_portfolio_register_post_types' );
	
	/* Register custom taxonomy. */
	add_action( 'init', 'dp_portfolio_register_taxonomies', 0 );
	
	/* Add meta box. */
	add_action( 'add_meta_boxes', 'dp_portfolio_create_meta_boxes' );
	
	/* Save meta box. */
	add_action( 'save_post', 'dp_portfolio_save_project_info', 10, 2 );

}

/**
 * Do things on plugin activation.
 *
 * @since 0.1
 */
function dp_portfolio_activation() {

	/* Register custom post types */
	dp_portfolio_register_post_types();
	
	/* Flush permalinks */
	flush_rewrite_rules();

}

/**
 * Flush permalinks on plugin deactivation.
 *
 * @since 0.1
 */
function dp_portfolio_deactivation() {

	flush_rewrite_rules();

}

/**
 * Register the 'project" custom post type.
 *
 * @since 0.1
 */
function dp_portfolio_register_post_types() {

	/* Labels for the project post type. */
	$project_labels = array(
		'name' => __( 'Portfolio', 'dp-portfolio' ),
		'singular_name' => __( 'Project', 'dp-portfolio' ),
		'all_items'            => __( 'All Projects', 'dp-portfolio' ),
		'add_new' => __( 'Add New Project', 'dp-portfolio' ),
		'add_new_item' => __( 'Add New Project', 'dp-portfolio' ),
		'edit' => __( 'Edit', 'dp-portfolio' ),
		'edit_item' => __( 'Edit Project', 'dp-portfolio' ),
		'new_item' => __( 'New Project', 'dp-portfolio' ),
		'view_item' => __( 'View Project', 'dp-portfolio' ),
		'search_items' => __( 'Search Portfolio', 'dp-portfolio' ),
		'not_found' => __( 'No projects found', 'dp-portfolio' ),
		'not_found_in_trash' => __( 'No projects found in Trash', 'dp-portfolio' ),
	);

	/* Arguments for the project post type. */
	$project_args = array(
		'can_export' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'labels' => $project_labels,
		'public' => true,
		'query_var' => 'project',
		'rewrite' => array( 'slug' => 'portfolio', 'with_front' => false ),
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'revisions' ),
	);

	/* Register the project post type. */
	register_post_type( apply_filters( 'dp_portfolio_project_post_type', 'project' ), apply_filters( 'dp_portfolio_project_post_type_args', $project_args ) );

}

/**
 * Register custom taxonomies.
 *
 * @since 0.1
 */
function dp_portfolio_register_taxonomies() {
	
	$role_labels = array(
    'name' 				=> _x( 'Portfolio Roles', 'plural', 'dp-portfolio' ),
    'singular_name' 	=> _x( 'Role', 'singular', 'dp-portfolio' ),
    'search_items' 		=> __( 'Search Roles', 'dp-portfolio' ),
    'all_items' 		=> __( 'All Roles', 'dp-portfolio' ),
    'edit_item' 		=> __( 'Edit Role', 'dp-portfolio' ), 
    'update_item' 		=> __( 'Update Role', 'dp-portfolio' ),
    'add_new_item' 		=> __( 'Add New Role', 'dp-portfolio' ),
    'new_item_name' 	=> __( 'New Role Name', 'dp-portfolio' ),
    'parent_item' 		=> null,
    'parent_item_colon' => null,	
    'separate_items_with_commas' => __( 'Separate roles with commas. Roles are used to describe the type of services involved in the project. For examples: wireframing, designing, and coding.', 'dp-portfolio' ),
    'add_or_remove_items' => __( 'Add or remove roles', 'dp-portfolio' ),
    'choose_from_most_used' => __( 'Choose from the most used roles', 'dp-portfolio' ),	
    'menu_name' => __( 'Portfolio Roles', 'dp-portfolio' )
	);
	
	$role_args = array(
		'capabilities'		   => array(
									'manage_terms' => 'manage_categories',
									'edit_terms' => 'manage_categories',
									'delete_terms' => 'manage_categories',
									'assign_terms' => 'edit_posts'
								),
		'labels'               => $role_labels,
		'public'               => true,
		'rewrite'              => array( 'slug' => 'role' ),
		'show_in_nav_menus'    => false,
		'update_count_callback' => '_update_post_term_count'
	);
	
	/* Register the role taxonomy */
	register_taxonomy( apply_filters( 'dp_portfolio_role_taxonomy', 'dp_portfolio_role' ), apply_filters( 'dp_portfolio_project_post_type', 'project' ), apply_filters( 'dp_portfolio_role_taxonomy_args', $role_args ) );
	
	$type_labels = array(
    'name' 				=> _x( 'Portfolio Types', 'plural', 'dp-portfolio' ),
    'singular_name' 	=> _x( 'Type', 'singular', 'dp-portfolio' ),
    'search_items' 		=> __( 'Search Types', 'dp-portfolio' ),
    'all_items' 		=> __( 'All Types', 'dp-portfolio' ),
    'edit_item' 		=> __( 'Edit Type', 'dp-portfolio' ), 
    'update_item' 		=> __( 'Update Type', 'dp-portfolio' ),
    'add_new_item' 		=> __( 'Add New Type', 'dp-portfolio' ),
    'new_item_name' 	=> __( 'New Type Name', 'dp-portfolio' ),
    'parent_item' 		=> null,
    'parent_item_colon' => null,	
    'separate_items_with_commas' => __( 'Separate types with commas. Types are used to describe the project type. For examples: residential, commercial, and government.', 'dp-portfolio' ),
    'add_or_remove_items' => __( 'Add or remove types', 'dp-portfolio' ),
    'choose_from_most_used' => __( 'Choose from the most used types', 'dp-portfolio' ),	
    'menu_name' => __( 'Portfolio Types', 'dp-portfolio' ),
	);
	
	$type_args = array(
		'capabilities'		   => array(
									'manage_terms' => 'manage_categories',
									'edit_terms' => 'manage_categories',
									'delete_terms' => 'manage_categories',
									'assign_terms' => 'edit_posts'
								),
		'labels'               => $type_labels,
		'public'               => true,
		'rewrite'              => array( 'slug' => 'type' ),
		'show_in_nav_menus'    => false,
		'update_count_callback' => '_update_post_term_count'
	);
	
	/* Register the role taxonomy */
	register_taxonomy( apply_filters( 'dp_portfolio_type_taxonomy', 'dp_portfolio_type' ), apply_filters( 'dp_portfolio_project_post_type', 'project' ), apply_filters( 'dp_portfolio_type_taxonomy_args', $type_args ) );

}

/**
 * Create custom meta boxes.
 *
 * @since 0.1.0
 */
 
function dp_portfolio_create_meta_boxes() {

	/* Add custom meta box for project info fields */
	add_meta_box(
		'dp-portfolio-project-info',
		__( 'Project Info', 'dp-portfolio' ),
		'dp_portfolio_display_project_info',
		'project',
		'normal',
		'high'
	);

}

/**
 * Display custom meta boxes.
 *
 * @since 0.1.0
 */

function dp_portfolio_display_project_info() {

	global $post;	

	wp_nonce_field( basename( __FILE__ ), 'dp_portfolio_project_info_nonce' );

	/* Retrieve the project client name if it already exists. */
	$project_client = get_post_meta( $post->ID, 'dp_portfolio_project_client', true ); ?>
	
	<p>
		<label for="dp-portfolio-project-client"><?php echo _e( 'Client', 'dp-portfolio' ); ?></label>
		<br />
		<input type="text" name="dp-portfolio-project-client" id="dp-portfolio-project-client" value="<?php echo strip_tags( $project_client ); ?>" style="width: 99%" />
	</p>
	
	<?php
	/* Retrieve the project URL if it already exists. */
	$project_url = get_post_meta( $post->ID, 'dp_portfolio_project_url', true ); ?>
	
	<p>
		<label for="dp-portfolio-project-url"><?php echo _e( 'URL', 'dp-portfolio' ); ?></label>
		<br />
		<input type="text" name="dp-portfolio-project-url" id="dp-portfolio-project-url" value="<?php echo esc_url( $project_url ); ?>" style="width: 99%" />
	</p>
	
	<span class="description"><?php echo _e( 'The URL this project should link to.', 'dp-portfolio' ); ?></span>
	
	<?php
		/* Retrieve the project testimonial if it already exists. */
		$project_testimonial = get_post_meta( $post->ID, 'dp_portfolio_project_testimonial', true );
	?>
	
	<p>
		<label for="dp-portfolio-project-testimonial"><?php echo _e( 'Testimonial', 'dp-portfolio' ); ?></label>
		<br />
		<textarea name="dp-portfolio-project-testimonial" id="dp-portfolio-project-testimonial" cols="60" rows="5" style="width: 99%"><?php echo wp_filter_nohtml_kses( $project_testimonial ); ?></textarea>
	</p>

<?php }

/**
 * Save custom meta box info.
 *
 * @since 0.1.0
 */
 
function dp_portfolio_save_project_info( $post_id, $post ) {

	if ( !isset( $_POST['dp_portfolio_project_info_nonce'] ) || !wp_verify_nonce( $_POST['dp_portfolio_project_info_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
		
	$meta = array(
		'dp_portfolio_project_client' => strip_tags( $_POST['dp-portfolio-project-client'] ),
		'dp_portfolio_project_url' => esc_url( strip_tags( $_POST['dp-portfolio-project-url'] ) ),
		'dp_portfolio_project_testimonial' => wp_filter_nohtml_kses( $_POST['dp-portfolio-project-testimonial'] )
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
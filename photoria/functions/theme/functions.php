<?php

/* Register Thumbnails Size
================================== */

add_image_size( 'homepage-slider', 950, 430, true );
add_image_size( 'loop-main', 300, 230, true );
add_image_size( 'featured-posts-widget', 60, 45, true );



/* 	Register Custom Menu
==================================== */

register_nav_menu('primary', 'Main Menu');



/* 	Reset default WP styling for [gallery] shortcode
===================================================== */

add_filter('gallery_style', create_function('$a', 'return "<div class=\'gallery\'>";'));



/* 	Maximum width for images placed in posts
============================================= */

if ( ! isset( $content_width ) ) $content_width = 610;



/*  Custom Excerpt Length
==================================== */

function new_excerpt_length($length) {
    return (int) option::get("excerpt_length") ? (int) option::get("excerpt_length") : 50;
}
add_filter('excerpt_length', 'new_excerpt_length');



 
/* 	This will enable to insert [shortcodes] inside Text Widgets
================================================================ */

add_filter('widget_text', 'do_shortcode');



/* Add support for Custom Background
==================================== */

if ( ui::is_wp_version( '3.4' ) )
    add_theme_support( 'custom-background' );
else
    add_custom_background( $args );




/* Email validation
==================================== */

function simple_email_check($email) {
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}

	return true;
}



/* 
Plugin Name: Ping/Track/Comment Count 
Plugin URI: http://txfx.net/code/wordpress/ping-track-comment-count/ 
Version: 1.1 
Description: Provides unctions that return or display the number of trackbacks, pingbacks, comments or combined pings recieved by a given post.  Other authors: Chris J. Davis, Scott "Skippy" Merrill 
Author: Mark Jaquith 
Author URI: http://markjaquith.com/ 
*/ 

/* 

This program is free software; you can redistribute it and/or 
modify it under the terms of the GNU General Public License 
as published by the Free Software Foundation; either version 2 
of the License, or (at your option) any later version. 

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.    See the 
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA     02110-1301, USA. 

*/

function get_comment_type_count($type='all', $post_id = 0) { 
    global $cjd_comment_count_cache, $id, $post; 
    if ( !$post_id ) 
        $post_id = $post->ID; 
    if ( !$post_id ) 
        return; 

    if ( !isset($cjd_comment_count_cache[$post_id]) ) { 
        $p = get_post($post_id); 
        $p = array($p); 
        update_comment_type_cache($p); 
    } 

    if ( $type == 'pingback' || $type == 'trackback' || $type == 'comment' ) 
        return $cjd_comment_count_cache[$post_id][$type]; 
    elseif ( $type == 'ping' ) 
        return $cjd_comment_count_cache[$post_id]['pingback'] + $cjd_comment_count_cache[$post_id]['trackback']; 
    else 
        return array_sum((array) $cjd_comment_count_cache[$post_id]); 
} 

function comment_type_count($type = 'all', $post_id = 0) { 
        echo get_comment_type_count($type, $post_id); 
} 

function update_comment_type_cache($queried_posts) { 
    global $cjd_comment_count_cache, $wpdb; 

    if ( !$queried_posts ) 
        return $queried_posts; 


    foreach ( (array) $queried_posts as $post ) 
        if ( !isset($cjd_comment_count_cache[$post->ID]) ) 
            $post_id_list[] = $post->ID; 

    if ( $post_id_list ) { 
        $post_id_list = implode(',', $post_id_list); 

        foreach ( array('', 'pingback', 'trackback') as $type ) { 
            $counts = $wpdb->get_results("SELECT ID, COUNT( comment_ID ) AS ccount 
            FROM $wpdb->posts 
            LEFT JOIN $wpdb->comments ON ( comment_post_ID = ID AND comment_approved = '1' AND comment_type='$type' ) 
            WHERE post_status = 'publish' AND ID IN ($post_id_list) 
            GROUP BY ID"); 

            if ( $counts ) { 
                if ( '' == $type ) 
                    $type = 'comment'; 
                foreach ( $counts as $count ) 
                    $cjd_comment_count_cache[$count->ID][$type] = $count->ccount; 
            } 
        } 
    } 
    return $queried_posts; 
} 
add_filter('the_posts', 'update_comment_type_cache');
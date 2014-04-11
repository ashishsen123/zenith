<?php
/***
 * Custom Color Options
 *
 * Get custom colors from theme options and embed CSS color settings 
 * in the <head> area of the theme. 
 *
 */


// Add Custom Colors
add_action('wp_head', 'themezee_custom_colors');
function themezee_custom_colors() { 
	
	// Get Theme Options
	$options = get_option('zeetasty_options');
	
	// Check if Custom Colors are active
	if ( isset($options['themeZee_color_scheme']) and $options['themeZee_color_scheme'] <> 'default' ) :
	
		// Get Color
		$color_scheme = esc_attr($options['themeZee_color_scheme']);
		
		// Set Colors
		$link_color = $color_scheme;
		$post_title_color = $color_scheme;
		$post_title_color_hover = '#333333';
		$navi_color = $color_scheme;
		$sidebar_title_color = '#444444';
		$sidebar_link_color = $color_scheme;

		// Define CSS code
		$color_css = '<style type="text/css">';
		$color_css .= '
			a, a:link, a:visited, .comment a:link, .comment a:visited {
				color: '. $link_color .';
			}
			.wp-pagenavi .current {
				background-color: '. $link_color .';
			}
			
			.post-title, .post-title a:link, .post-title a:visited, #respond h3,
			.frontpage-widgets .widget .widgettitle {
				color: '. $post_title_color .';
			}
			.post-title a:hover, .post-title a:active {
				color: '. $post_title_color_hover .';
			}
			.more-link span, #commentform #submit, #frontpage-intro-button a {
				background-color: '. $post_title_color .';
			}
			.more-link span:hover, #commentform #submit:hover, #frontpage-intro-button a:hover, .widget-tabnav li a {
				background-color: '. $post_title_color_hover .';
			}
			#logo a .site-title {
				color: '. $navi_color .';
			}
			#wrapper {
				border-top: 0.5em solid '. $navi_color .';
			}
			#mainnav, #footer {
				background-color: '. $navi_color .';
			}
			#mainnav {
				border-top: 2px solid '. $navi_color .';
			}
			#mainnav-bg-wrap {
				border-top: 1.2em solid '. $navi_color .';
			}
			#sidebar .widgettitle {
				color: '. $sidebar_title_color .';
				border-bottom: 1px solid '. $sidebar_title_color .';
			}
			#sidebar a:link, #sidebar a:visited, .frontpage-widgets a:link, .frontpage-widgets a:visited {
				color: '. $sidebar_link_color .';
			}
		';
		$color_css .= '</style>';
		
		// Print Color CSS
		echo $color_css;
	
	endif;
}
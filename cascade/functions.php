<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Tung Do <ttsondo@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/cascade
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
/* Load the Hybrid Core framework. */
require_once( trailingslashit ( get_template_directory() ) . 'library/hybrid.php' );
$theme = new Hybrid(); // Part of the framework.

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'cascade_theme_setup' );


/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function cascade_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix(); // Part of the framework, cannot be changed or prefixed.
	
	/* Add theme settings */
	if ( is_admin() )
	    locate_template( 'functions/admin.php', true );
	
	/* Register support for all post formats. */
	add_theme_support( 'post-formats', array(
		'aside',
		'audio',
		'chat',
		'gallery',
		'image',
		'link',
		'quote',
		'status',
		'video'
		) );

	/* Add framework menus. */
	add_theme_support( 'hybrid-core-menus', array( // Add core menus.
		'primary',
		'secondary'
		) );
		
	/* Register aditional menus */
	add_action( 'init', 'cascade_register_menus' );

	/* Add framework sidebars */
	add_theme_support( 'hybrid-core-sidebars', array( // Add sidebars or widget areas.
		'primary',
		'secondary',
		'subsidiary',
		'header',
		'before-content',
		'after-content',
		'after-singular'
		) );

	/* Register additional widget areas. */
	add_action( 'widgets_init', 'cascade_register_sidebars', 11 );

	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-template-hierarchy' ); // This is important. Do not remove. */
	
	/* Add aditional layouts */
	add_filter( 'theme_layouts_strings', 'cascade_theme_layouts' );

	/* Add theme support for framework layout extension. */
	add_theme_support( 'theme-layouts', array( // Add theme layout options.
		'1c',
		'2c-l',
		'2c-r',
		'3c-c',
		'3c-l',
		'3c-r',
		'hl-1c',
		'hl-2c-l',
		'hl-2c-r',
		'hr-1c',
		'hr-2c-l',
		'hr-2c-r'
		) );

	/* Add theme support for other framework extensions */
	add_theme_support( 'post-stylesheets' );
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer' ) );

	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );
	
	/* Load resources into the theme. */
	add_action( 'wp_enqueue_scripts', 'cascade_resources' );
	
	/* Add theme support for WordPress background feature */
	add_theme_support( 'custom-background', array(
		'wp-head-callback' => 'cascade_custom_background_callback'
	));
	
	/* Modify excerpt more */
	add_filter('excerpt_more', 'cascade_new_excerpt_more');
	
	/* Wraps <blockquote> around quote posts. */
	add_filter( 'the_content', 'cascade_quote_post_content' );

	/* Set content width. */
	hybrid_set_content_width( 920 );
	
	/* Embed width/height defaults. */
	add_filter( 'embed_defaults', 'cascade_embed_defaults' ); // Set default widths to use when inserting media files
	
	/* Assign specific layouts to pages based on set conditions and disable certain sidebars based on layout choices. */
	add_action( 'template_redirect', 'cascade_layouts' );
	add_filter( 'sidebars_widgets', 'cascade_disable_sidebars' );
	
}


/**
 * Loads the theme scripts.
 *
 * @since 0.1
 */
function cascade_resources() {

	wp_enqueue_script ( 'cascade-scripts', trailingslashit ( get_template_directory_uri() ) . 'js/cascade.js', array( 'jquery' ), '201200215', true );

}

/**
 * This is a fix for when a user sets a custom background color with no custom background image.  What 
 * happens is the theme's background image hides the user-selected background color.  If a user selects a 
 * background image, we'll just use the WordPress custom background callback.
 *
 * @since 0.1
 * @author Justin Tadlock
 * @link http://core.trac.wordpress.org/ticket/16919
 */
function cascade_custom_background_callback() {

	/* Get the background image. */
	$image = get_background_image();

	/* If there's an image, just call the normal WordPress callback. We won't do anything here. */
	if ( !empty( $image ) ) {
		_custom_background_cb();
		return;
	}

	/* Get the background color. */
	$color = get_background_color();

	/* If no background color, return. */
	if ( empty( $color ) )
		return;

	/* Use 'background' instead of 'background-color'. */
	$style = "background: #{$color};";

?>
<style type="text/css">body.custom-background { <?php echo trim( $style ); ?> }</style>
<?php

}

/**
 * Filters the excerpt more.
 *
 * @since 0.1
 */

function cascade_new_excerpt_more( $more ) {
	return '&#133;';
}

/**
 * Wraps the output of posts with the 'quote' post format with a <blockquote> element if the post content 
 * doesn't already have this element within it.
 *
 * @since 0.1
 * @access private
 * @param string $content The content of the post.
 * @return string $content
 */
function cascade_quote_post_content( $content ) {

	if ( has_post_format( 'quote' ) ) {
		preg_match( '/<blockquote.*?>/', $content, $matches );

		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}

	return $content;
}

/**
 * Overwrites the default widths for embeds.  This is especially useful for making sure videos properly
 * expand the full width on video pages.  This function overwrites what the $content_width variable handles
 * with context-based widths.
 *
 * @since 0.1
 */
function cascade_embed_defaults( $args ) {

	$args['width'] = 920;

	if ( current_theme_supports( 'theme-layouts' ) ) {

		$layout = theme_layouts_get_layout();

		if ( 'layout-3c-l' == $layout || 'layout-3c-r' == $layout || 'layout-3c-c' == $layout || 'layout-hl-2c-l' == $layout || 'layout-hl-2c-r' == $layout || 'layout-hr-2c-l' == $layout || 'layout-hr-2c-r' == $layout )
		
			$args['width'] = 280;
			
		elseif ( 'layout-2c-l' == $layout || 'layout-2c-r' == $layout )
		
			$args['width'] = 600;

	}

	return $args;
}

/**
 * Conditional logic deciding the layout of certain pages.
 *
 * @since 0.1.0
 */
function cascade_layouts() {

	if ( current_theme_supports( 'theme-layouts' ) ) {

		$layout = theme_layouts_get_layout();
		$global_layout = hybrid_get_setting( 'cascade_global_layout' );

		if ( !is_singular() && $global_layout !== 'layout_default' && function_exists( "cascade_{$global_layout}" ) ) {
			add_filter( 'get_theme_layout', 'cascade_' . $global_layout );
		}
		
		if ( is_singular() && $layout == 'layout-default' && $global_layout !== 'layout_default' && function_exists( "cascade_{$global_layout}" ) ) {
			add_filter( 'get_theme_layout', 'cascade_' . $global_layout );
		}

	}
	
}

/**
 * Filters 'theme_layouts_strings'.
 *
 * @since 0.1.0
 */
function cascade_theme_layouts( $strings ) {

	/* Set up the layout strings. */
	$strings = array(
		'default' => __( 'Default', 'theme-layouts' ),
		'1c' => __( 'One Column', 'theme-layouts' ),
		'2c-l' => __( 'Two Columns, Left', 'theme-layouts' ),
		'2c-r' => __( 'Two Columns, Right', 'theme-layouts' ),
		'3c-c' => __( 'Three Columns, Center', 'theme-layouts' ),
		'3c-l' => __( 'Three Columns, Left', 'theme-layouts' ),
		'3c-r' => __( 'Three Columns, Right', 'theme-layouts' ),
		'hl-1c' => __( 'Header Left One Column', 'theme-layouts' ),
		'hl-2c-l' => __( 'Header Left Two Columns, Left', 'theme-layouts' ),
		'hl-2c-r' => __( 'Header Left Two Columns, Right', 'theme-layouts' ),
		'hr-1c' => __( 'Header Right One Column', 'theme-layouts' ),
		'hr-2c-l' => __( 'Header Right Two Columns, Left', 'theme-layouts' ),
		'hr-2c-r' => __( 'Header Right Two Columns, Right', 'theme-layouts' )
	);

	return $strings;
}

/**
 * Filters 'get_theme_layout'.
 *
 * @since 0.1.0
 */
function cascade_layout_default( $layout ) {return 'layout-default';}
function cascade_layout_1c( $layout ) {return 'layout-1c';}
function cascade_layout_2c_l( $layout ) {return 'layout-2c-l';}
function cascade_layout_2c_r( $layout ) {return 'layout-2c-r';}
function cascade_layout_3c_c( $layout ) {return 'layout-3c-c';}
function cascade_layout_3c_l( $layout ) {return 'layout-3c-l';}
function cascade_layout_3c_r( $layout ) {return 'layout-3c-r';}
function cascade_layout_hl_1c( $layout ) {return 'layout-hl-1c';}
function cascade_layout_hl_2c_l( $layout ) {return 'layout-hl-2c-l';}
function cascade_layout_hl_2c_r( $layout ) {return 'layout-hl-2c-r';}
function cascade_layout_hr_1c( $layout ) {return 'layout-hr-1c';}
function cascade_layout_hr_2c_l( $layout ) {return 'layout-hr-2c-l';}
function cascade_layout_hr_2c_r( $layout ) {return 'layout-hr-2c-r';}

/**
 * Disables sidebars based on layout choices.
 *
 * @since 0.1.0
 */
function cascade_disable_sidebars( $sidebars_widgets ) {
	global $wp_query;

	if ( current_theme_supports( 'theme-layouts' ) && !is_admin() ) {

		if ( 'layout-default' == theme_layouts_get_layout() || 'layout-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
			$sidebars_widgets['secondary'] = false;
			
		}
		if ( 'layout-default' == theme_layouts_get_layout() || 'layout-1c' == theme_layouts_get_layout() || 'layout-2c-l' == theme_layouts_get_layout() || 'layout-2c-r' == theme_layouts_get_layout() || 'layout-3c-c' == theme_layouts_get_layout() || 'layout-3c-l' == theme_layouts_get_layout() || 'layout-3c-r' == theme_layouts_get_layout() ) {
			$sidebars_widgets['header'] = false;
		}
		if ( 'layout-hl-1c' == theme_layouts_get_layout() || 'layout-hr-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
			$sidebars_widgets['secondary'] = false;
		}
		
	}

	return $sidebars_widgets;
}

/**
 * Registers additional menus.
 *
 * @since 0.1.0
 * @uses register_nav_menu() Registers a nav menu with WordPress.
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menu
 */
function cascade_register_menus() {

	register_nav_menu( 'header-primary', _x( 'Header Primary', 'nav menu location', 'cascade' ) );
	register_nav_menu( 'footer', _x( 'Footer', 'nav menu location', 'cascade' ) );

}

/**
 * Register additional sidebars.
 *
 * @since 0.1.0
 */
function cascade_register_sidebars() {

	$subsidiary_2 = array(
		'id' => 'subsidiary-2c',
		'name' => _x( 'Subsidiary 2 Columns', 'sidebar', 'cascade' ),
		'description' => __( 'A 2-column widget area loaded before the footer of the site.', 'cascade' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	);
	
	$subsidiary_3 = array(
		'id' => 'subsidiary-3c',
		'name' => _x( 'Subsidiary 3 Columns', 'sidebar', 'cascade' ),
		'description' => __( 'A 3-column widget area loaded before the footer of the site.', 'cascade' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	);
	
	$subsidiary_4 = array(
		'id' => 'subsidiary-4c',
		'name' => _x( 'Subsidiary 4 Columns', 'sidebar', 'cascade' ),
		'description' => __( 'A 4-column widget area loaded before the footer of the site.', 'cascade' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	);
	
	$subsidiary_5 = array(
		'id' => 'subsidiary-5c',
		'name' => _x( 'Subsidiary 5 Columns', 'sidebar', 'cascade' ),
		'description' => __( 'A 5-column widget area loaded before the footer of the site.', 'cascade' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	);
	
	$entry = array(
		'id' => 'entry',
		'name' => _x( 'Entry', 'sidebar', 'cascade' ),
		'description' => __( 'Loaded directly before the entry content texts.', 'cascade' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	);

	register_sidebar( $subsidiary_2 );
	register_sidebar( $subsidiary_3 );
	register_sidebar( $subsidiary_4 );
	register_sidebar( $subsidiary_5 );
	register_sidebar( $entry );

}

?>
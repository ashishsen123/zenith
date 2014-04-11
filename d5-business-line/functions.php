<?php
/* 	D5 Business Line Theme's Functions
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since D5 Business Line 1.0
*/
   
  
  	add_theme_support( 'automatic-feed-links' );
  	register_nav_menu( 'menu', 'Menu' );
 


//	Set the content width based on the theme's design and stylesheet.
	if ( ! isset( $content_width ) ) $content_width = 584;

// Load the D5 Framework Optios Page
	if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once get_template_directory() . '/inc/options-framework.php';
	}

// 	Tell WordPress for wp_title in order to modify document title content
	function d5businessline_filter_wp_title( $title ) {
    $site_name = get_bloginfo( 'name' );
    $filtered_title = $site_name . $title;
    return $filtered_title;
	}
	add_filter( 'wp_title', 'd5businessline_filter_wp_title' );

// 	This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)

	// additional image sizes
	// delete the next line if you do not need additional image sizes
	add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	}	
			
// 	WordPress 3.4 Custom Background Support	
	$d5businessline_custom_background = array(
	'default-color'          => 'eeeeee',
	'default-image'          => get_template_directory_uri() . '/images/bodyback.jpg',
	);
	add_theme_support( 'custom-background', $d5businessline_custom_background );
	
// 	WordPress 3.4 Custom Header Support				
	$d5businessline_custom_header = array(
	'default-image'          => get_template_directory_uri() . '/images/logo.png',
	'random-default'         => false,
	'width'                  => 300,
	'height'                 => 90,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '000000',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback' 		 => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $d5businessline_custom_header );

// 	Functions for adding script
	function d5businessline_enqueue_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' ); 
	}
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'd5businessline-menu-style', get_template_directory_uri(). '/js/menu.js' );
	wp_enqueue_style('d5businessline-gfonts1', '//fonts.googleapis.com/css?family=Oswald', false );
	wp_enqueue_style('d5businessline-gfonts2', '//fonts.googleapis.com/css?family=Droid+Sans', false );
	add_editor_style( get_template_directory_uri(). '/editor-style.css' );
	}
	add_action( 'wp_enqueue_scripts', 'd5businessline_enqueue_scripts' );

function d5businessline_sworking() {
	if ( of_get_option('banner-iimage', get_template_directory_uri() . '/images/slide-image/slide-image2.jpg' )  != '' ): wp_enqueue_script( 'd5businessline-slider', get_template_directory_uri(). '/js/slider.js', false );
	endif;
	echo '<div id="slide"><img  class="show" src="' . of_get_option('banner-image', get_template_directory_uri() . '/images/slide-image/slide-image1.jpg' ) . '"/><img src="' . of_get_option('banner-iimage', get_template_directory_uri() . '/images/slide-image/slide-image2.jpg' ) . '"/></div>';
	}

//	Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and d5businessline_continue_reading_link().
//	function tied to the excerpt_more filter hook.
	function d5businessline_excerpt_length( $length ) {
	global $blExcerptLength;
	if ($blExcerptLength) {
    return $blExcerptLength;
	} else {
    return 50; //default value
    } }
	add_filter( 'excerpt_length', 'd5businessline_excerpt_length', 999 );
	
	function d5businessline_excerpt_more($more) {
       global $post;
	return '<a href="'. get_permalink($post->ID) . '" class="read-more">Read the Rest...</a>';
	}
	add_filter('excerpt_more', 'd5businessline_excerpt_more');

//	D5 BusinessLine and WordPress Credit
	function d5businessline_credit() {
		echo '&nbsp;| D5 Business Line Theme by: <a href="http://d5creation.com" target="_blank"><img  width="30px" src="' . get_template_directory_uri() . '/images/d5logofooter.png" /> D5 Creation</a> | Powered by: <a href="http://wordpress.org" target="_blank">WordPress</a>';
	}


//	Adds a pretty "Continue Reading" link to custom post excerpts.
	function d5businessline_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= d5businessline_continue_reading_link();
	}
	return $output;
	}
	add_filter( 'get_the_excerpt', 'd5businessline_custom_excerpt_more' );


//	Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link
	function d5businessline_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
	}
	add_filter( 'wp_page_menu_args', 'd5businessline_page_menu_args' );


//	Registers the Widgets and Sidebars for the site
	function d5businessline_widgets_init() {

	register_sidebar( array(
		'name' => 'Primary Sidebar',
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  'Secondary Sidebar',
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  'Footer Area One',
		'id' => 'sidebar-3',
		'description' =>  'An optional widget area for your site footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  'Footer Area Two',
		'id' => 'sidebar-4',
		'description' =>  'An optional widget area for your site footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  'Footer Area Three',
		'id' => 'sidebar-5',
		'description' =>  'An optional widget area for your site footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' =>  'Footer Area Four',
		'id' => 'sidebar-6',
		'description' =>  'An optional widget area for your site footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	}
	add_action( 'widgets_init', 'd5businessline_widgets_init' );

	add_filter('the_title', 'd5businessline_title');
	function d5businessline_title($title) {
        if ( '' == $title ) {
            return '(Untitled)';
        } else {
            return $title;
        }
    }
	
//	Remove WordPress Custom Header Support for the theme D5 Business Line
// remove_theme_support('custom-header');
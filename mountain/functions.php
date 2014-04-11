<?php
	 add_action('wp_enqueue_scripts', 'my_scripts');
	 		function my_scripts() {
		 	wp_enqueue_script('jquery','','','', true);
		 	}
?>
<?php
	register_sidebar(array('name'=>__('Sidebar','language'),
		'before_widget' => '<div class="hot-news rounds">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	register_sidebar( array(
		'name' => __( 'Slideshow','language' ),
		'description' => __( 'Home Page Slideshow.','language'),
		'id' => 'slideshow-widget-area',
		'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
	) );
?>

<?php add_action( 'init', 'create_post_type' );?>
<?php function create_post_type() {
	register_post_type( 'slideshow',
	array(
		'labels' => array(
		'name' => __( 'Slideshow','language' ),
		'add_new' => __( 'Add Photo','language' ),
					'add_new_item' => __( 'Add Photo' ,'language'),
					'edit_item' => __( 'Edit Photo ' ,'language'),
					'new_item' => __( 'Add New Photo ' ,'language'),
					'view_item' => __( 'View Photo' ,'language'),
					'search_items' => __( 'Search Photo' ,'language'),
					'not_found' => __( 'No Photo Found' ,'language' ),
					'not_found_in_trash' => __( 'No Photos Found In Trash' ,'language'),
					'query_var' => true,
					'rewrite' => false,
					'singular_name' => __( 'Photo','language' )
					),
					'menu_position' => '5',
					'public' => true,
					'menu_icon' => get_bloginfo('template_url') . '/images/mc/slideback.png', 
					'supports' => array("title",'editor','thumbnail' ),
					'capability_type' => 'post',) ); }
					?>
<?php add_action( 'after_setup_theme', 'theme_setup' );

		if ( ! function_exists('theme_setup') ):
			function theme_setup() {
				add_theme_support( 'post-thumbnails' );
				set_post_thumbnail_size( 413, 230 );	
				add_theme_support( 'automatic-feed-links' );
				$lang = get_template_directory() . '/languages';
				load_theme_textdomain('language', $lang);
				add_image_size( 'gallery-single', 690, 9999 ); 
				add_image_size( 'slider', 738, 291, true );
				register_nav_menus(
									array(
											'social' => 'Header Social',
											'sidebar-nav' => 'Sidebar Navigation'
											));
				define( 'HEADER_TEXTCOLOR', '' );
				define( 'HEADER_IMAGE', '%s/images/mc/logo.png' );
				define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yourtheme_header_image_width', 430 ) );
				define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yourtheme_header_image_height',	68 ) );
				define( 'NO_HEADER_TEXT', true );
				$header_defaults = array(
											'default-color'          => '',
											'default-image'          => '',
											'wp-head-callback'       => '',
											'admin-head-callback'    => 'admin_header_style',
											'admin-preview-callback' => ''
											);
				add_theme_support( 'custom-header',$header_defaults );
				}
				endif;
				
				if ( ! function_exists( 'admin_header_style' ) ) :
				
				function yourtheme_admin_header_style() {
				?>
				<style type="text/css">
										#headimg {
										height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
										width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
										}
										#headimg h1, #headimg #desc {
											display: none;
											}
				</style>
				<?php
					} endif;
?>
<?php function theme_pagination($pages = ''){
		global $paged;		
		if(empty($paged))$paged = 1;		
		$prev = $paged - 1;							
		$next = $paged + 1;	
		$range = 3;
		$showitems = ($range * 2)+1;		
		if($pages == '')
		{	
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}				
		if(1 != $pages){
			echo "<div id='pagination'>";
			echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='btn'>&laquo;</a> ":"";
			echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='btn'>&laquo;</a> ":"";				
			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					echo ($paged == $i)? "<a href='".get_pagenum_link($i)."' class='btn current'>".$i."</a> ":"<a href='".get_pagenum_link($i)."' class='btn'>".$i."</a> "; 
				}
			}			
			echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='btn'>&raquo;</a> " :"";
			echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='btn'>&raquo;</a> ":"";
			echo "</div>";
			}
	}
	
	
	// customizer addition
require get_template_directory() . '/inc/customizer.php';

	
	/*genrate body class*/

add_filter('body_class', 'mountain_body_classes');

function mountain_body_classes($classes) 
		{
        $slug = strtolower(get_theme_mod( 'mountain_color_scheme' ));
        $classes[] = 'mountain-'.$slug;
        return $classes;
}

/*end genrate body class*/

?>
<?php class SD_Widget extends WP_Widget {

			function SD_Widget() {
				$widget_ops = array( 'description' => (__('Add a Slideshow to the Home Page','language')));
				$this->WP_Widget('slideshow_home_widget', 'Home Page Slideshow', $widget_ops);
				}
			function widget($args, $instance) {
				global $slideid;
				extract($args, EXTR_SKIP);
				include(TEMPLATEPATH . '/slideshow.php');
				}
				function update($new_instance, $old_instance) {
					$instance = $old_instance;
					return $instance;
				}
			}		
			register_widget('SD_Widget');
?>


<?php
/***
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 */


// Display Custom Header
if ( ! function_exists( 'themezee_display_custom_header' ) ):
	
	function themezee_display_custom_header() {
		
		// Get Theme Options from Database
		$options = get_option('zeetasty_options'); 
		
		// Don't display header image on template-frontpage.php
		if( is_page_template('template-frontpage.php') )
			return;
			
		// Don't display header image when "display frontpage template automatically on home page" option is activated
		if( is_front_page() and isset($options['themeZee_frontpage_activate']) and $options['themeZee_frontpage_activate'] == 'true' )
			return;
			
		// Check if page is displayed and featured header image is used
		if( is_page() && has_post_thumbnail() ) :
		?>
			<div id="custom-header" class="header-image">
				<?php the_post_thumbnail('custom_header_image'); ?>
			</div>
<?php
		// Check if there is a custom header image
		elseif( get_header_image() ) :
		?>
			<div id="custom-header" class="header-image">
				<img src="<?php echo get_header_image(); ?>" />
			</div>
<?php 
		endif;

	}
	
endif;


// Display Postmeta Data
if ( ! function_exists( 'themezee_display_postmeta' ) ) :

	function themezee_display_postmeta() { ?>
		<span class="meta-date">
		<?php printf(__('Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>', 'zeeTasty_lang'), 
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
		?>
		</span>
		<span class="meta-author sep">
		<?php printf(__('by <a href="%1$s" title="%2$s" rel="author">%3$s</a>', 'zeeTasty_lang'), 
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'zeeTasty_lang' ), get_the_author() ) ),
				get_the_author()
			);
		?>
		</span>
	<?php if ( comments_open() ) : ?>
		<span class="meta-comments sep">
			<?php comments_popup_link( __('Leave a comment', 'zeeTasty_lang'),__('One comment','zeeTasty_lang'),__('% comments','zeeTasty_lang') ); ?>
		</span>
	<?php endif; ?>
	<?php
		edit_post_link(__( 'Edit Post', 'zeeTasty_lang' ));
	}

endif;


// Display Postinfo Data
if ( ! function_exists( 'themezee_display_postinfo' ) ) :

	function themezee_display_postinfo() { ?>
		<span class="meta-category">
			<?php printf(__('Posted in %1$s', 'zeeTasty_lang'), get_the_category_list(', ')); ?>
		</span>
		
	<?php
		$tag_list = get_the_tag_list('', ', ');
		if ( $tag_list ) : ?>
			<span class="meta-tags">
				<?php printf(__('tagged with %1$s', 'zeeTasty_lang'), $tag_list); ?>
			</span>
	<?php 
		endif; 
	}
	
endif;

	
// Display Content Pagination
if ( ! function_exists( 'themezee_display_pagination' ) ) :

	function themezee_display_pagination() { 
		global $wp_query;
		
		if ( $wp_query->max_num_pages > 1 ) :

			if(function_exists('wp_pagenavi')) : // if PageNavi is activated
				
				wp_pagenavi();
			
			else : // Otherwise, use traditional Navigation ?>
				
				<div class="post-pagination clearfix">
					<span class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'zeeTasty_lang')) ?></span>
					<span class="alignright"><?php previous_posts_link (__('Recent Entries &raquo;', 'zeeTasty_lang')) ?></span>
				</div>
				
	<?php 	
			endif;
		endif;
	}

endif;


?>
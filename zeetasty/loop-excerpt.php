		
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<h2 class="post-title"><a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="postmeta"><?php themezee_display_postmeta(); ?></div>
		
		<div class="entry clearfix">
			<a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_post_thumbnail('featured_image', array('class' => 'alignnone')); ?></a>
			<?php the_excerpt(); ?>
			<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><span class="moretext"><?php _e('&raquo; Read more', 'zeeTasty_lang'); ?></span></a>
		</div>
		<?php wp_link_pages(); ?>
		
		<div class="postinfo"><?php themezee_display_postinfo(); ?></div>

	</article>
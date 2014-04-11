
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<h2 class="post-title"><?php the_title(); ?></h2>
		<div class="postmeta"><?php themezee_display_postmeta(); ?></div>
			
		<div class="entry clearfix">
			<?php the_post_thumbnail('featured_image', array('class' => 'alignnone')); ?>
			<?php the_content(); ?>
			
			<!-- <?php trackback_rdf(); ?> -->			
		</div>
		<?php wp_link_pages(); ?>
		
		<div class="postinfo"><?php themezee_display_postinfo(); ?></div>

	</article>
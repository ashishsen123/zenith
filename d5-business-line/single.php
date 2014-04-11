<?php

/* 	D5 Business Line Theme's Single Page to display Single Page or Post
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since D5 Business Line 1.0
*/


get_header(); ?>

<div id="content">
          
		  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          
            <h1 class="page-title"><?php the_title(); ?></h1>
            <p class="postmetadataw">Posted by: <?php the_author_posts_link() ?> | on <?php the_time('F j, Y'); ?></p> 
                        
            <div class="content-ver-sep"> </div>
            <div class="entrytext">
            <?php the_post_thumbnail('thumbnail'); ?>
			<?php the_content(); ?>
            </div>
            <div class="clear"> </div>
            <div class="up-bottom-border">
            <p class="postmetadata">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> <?php the_tags('<br />Tags: ', ', ', '<br />'); ?></p>
            <?php  wp_link_pages( array( 'before' => '<div class="page-link"><span>' . 'Pages:' . '</span>', 'after' => '</div>' ) ); ?>
            <div class="floatleft"><?php previous_post_link('&laquo; %link (Previous Post)'); ?></div>
			<div class="floatright"><?php next_post_link('(Next Post) %link &raquo;'); ?></div><br />
            <div class="floatleft"><?php previous_image_link( false, '&laquo; Previous Image' ); ?></div>
			<div class="floatright"><?php next_image_link( false, 'Next Image &raquo;' ); ?></div> 
          	</div>
			
			<?php endwhile;?>
          	            
          <!-- End the Loop. -->          
        	
			<?php comments_template( '', true ); ?>
            
</div>			
<?php get_sidebar(); ?>
<?php get_footer(); ?>
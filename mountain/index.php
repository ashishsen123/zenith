<?php get_header(); ?>   
	<div id="container">            	           
			<div id="content">
				<div class="col-two">                        
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                        	    
                    <div class="post-wrap rounds">
	                	<div class="post rounds">
	                    	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="meta"><?php the_time('M - d Y') ?> | <span class="comment"><?php comments_number('no comments', '1 comment', '% comments' );?></span> | <span class="meta"> <?php _e('By','language');?> <span class="comment"><?php the_author_posts_link();?></span></span></p>
								<div class="post-data">
	                           		<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>                  
								    <?php the_excerpt(); ?>
	                        	</div>
							<div class="tags"><?php the_tags(); ?></div>
						</div>
					</div>
	 <?php endwhile; ?>		
				<?php theme_pagination($wp_query->max_num_pages); ?>    				
				<?php else: ?>   				
				<div class="post-wrap rounds">	                              
	            	<div class="post rounds">
	            		<p><?php _e('Sorry, no posts matched your criteria.','language'); ?></p> 
					</div>
				</div>   
				<?php endif; ?>
				</div>  
            <?php get_sidebar(); ?>                
		</div>         
	</div>
<div style="clear:both"></div>
<?php get_footer(); ?>
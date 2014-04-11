<?php get_header(); ?>     
      <div id="container">                                
            <div id="content">
                  <div class="col-two">                                               
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	                        <div class="post-wrap rounds single">
								<div class="post rounds">
									<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
										<div class="post-data">
	                                    	<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>                  
											<?php the_content(); ?>                                             
                                            <?php edit_post_link(); ?>    
	                                    </div>                                          
	                              </div>
	                        </div>
                       <?php endwhile; ?>		
					   <?php else: ?>   
					   <div class="post-wrap rounds">                              
					   		<div class="post rounds">
						   		<p><?php _e('Sorry, no posts matched your criteria.','language'); ?></p> 
						   	</div>
					   </div>   
				       <?php endif; ?>
					   <div class="post-wrap rounds single">
                       		<div class="post rounds">
						   		<?php comments_template(); ?>    
						   	</div>
                       </div>                    
                  </div>                  
                  <div class="col-one">
				<?php get_sidebar(); ?> 
			</div>
		</div>
	</div>
<div style="clear:both"></div>
<?php get_footer(); ?>
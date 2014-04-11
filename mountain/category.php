<?php get_header(); ?>      
	<div id="container">                       
		<div id="content">
			<div class="col-two"> 
				<div class="post-wrap rounds">
					<div class="postcat rounds">
						<h2 class="breadcrumb"><?php _e("Category: ","language"); ?><?php single_cat_title(); ?></h2>  
	  				</div>
	  			</div>                                                                                 
	  			<?php if ( have_posts() ): while ( have_posts() ) : the_post();?>
	  			<div class="post-wrap rounds">
		  			<div class="post rounds">
			  			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			  				<p class="meta-common"><?php the_time('M - d Y') ?></p><div style="clear:both"></div>
			  					<div class="post-data">
				  					<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>                  
								    <?php the_excerpt(); ?>   
									<div style="clear:both"></div>
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
			<div class="col-one">
				<?php get_sidebar(); ?>    
			</div>
		</div>        
	</div>
<?php get_footer(); ?>
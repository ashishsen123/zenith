<?php get_header(); ?>
	 <div id="container">     	
            <div id="content">
                  <div class="col-two">                        
                        <?php if ( have_posts() ) :while ( have_posts() ) : the_post(); ?>
	                        <div class="post-wrap rounds single">
	                              <div class="post rounds">
	                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                                    <p class="meta"><?php the_time('M - d Y') ?> | <span class="meta"> <?php _e('By','language');?> <span class="comment"><?php the_author_posts_link();?></span></span></p>
	                                    <div class="post-data">
	                                     <?php if(has_post_thumbnail()) {the_post_thumbnail();}	?>
	                                     <?php the_content(); ?>
                                         
                                         <?php edit_post_link(); ?>
                                         
                                         <div class="tags"><?php the_tags(); ?></div>
                                         
                                         <nav class="nav-single">
                                         	<div style="clear:both; margin-top: 75px;"></div>
                                            <span class="nav-previous" style="float:left;"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'mountaincreek' ) . '</span> %title' ); ?></span>
                                            <span class="nav-next" style="float:right;"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'mountaincreek' ) . '</span>' ); ?></span>
                                            <div style="clear:both;"></div>
                                        </nav><!-- .nav-single -->
                                         
	                                    </div>  	                                    
	                              </div>
	                        </div><!-- end of post-wrap div -->
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
                                    <?php comments_template('', true); ?>
                            </div>
                        </div><!-- end of post-wrap div -->              
                  </div><!-- end of col-two -->                  
                  <div class="col-one">
                     <?php get_sidebar(); ?>   
                  </div>
            </div><!--end of content div-->        
      </div><!--end of container div-->
<?php get_footer(); ?>
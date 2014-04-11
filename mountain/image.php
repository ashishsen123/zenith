<?php get_header(); ?>      
      <div id="container">                              
            <div id="content">
                  <div class="col-two">                                               
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	                        <div class="post-wrap rounds">
								<div class="post rounds">
									<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
										<div class="post-data">
	                                    	<?php 
						if(has_post_thumbnail()) {
							$image_id = get_post_thumbnail_id();
							$image_url = wp_get_attachment_url($image_id);
						?>
                        <div class="featured-pic-wrapper">
							<?php the_post_thumbnail('gallery-single');?>
						</div>
                        <?php }	?>
						<?php if (wp_attachment_is_image($post->ID)) {
							$att_image = wp_get_attachment_image_src( $post->ID, "gallery-single");
							$attachmentlink = wp_get_attachment_url($post->ID);
							?>
						<p class="attachment">
						<a href="<?php echo $attachmentlink;?>"><img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" alt="<?php the_title(); ?>" /></a></p>
						<?php } ?><div class="photo-nav"><?php previous_image_link(false,'&laquo; Previous image') ?></div> <div class="photo-nav-sec"><?php next_image_link(false,'Next image &raquo;') ?></div>
  
	                                    </div>                                          
	                              </div>
	                        </div>
                        <?php endwhile; endif; ?>                   
                  </div>              
                  <div class="col-one">
                  <?php get_sidebar(); ?>  
                  </div>
            </div> 
      </div><div style="clear:both"></div>
<?php get_footer(); ?>
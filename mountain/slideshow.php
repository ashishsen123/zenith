<div class="slider rounds">
	<?php query_posts(array('post_type'=>'slideshow')); while ( have_posts() ) : the_post(); ?>
		<div class="slide">	
			<?php $size = 'slider';
			  	   if ( has_post_thumbnail() ) {
				   the_post_thumbnail( $size );
				   } else {
					       $attachments = get_children( array(
						   'post_parent' => get_the_ID(),
						   'post_status' => 'inherit',
						   'post_type' => 'attachment',
						   'post_mime_type' => 'image',
						   'order' => 'ASC',
						   'orderby' => 'menu_order ID',
						   'numberposts' => 1)
						   );
					foreach ( $attachments as $thumb_id => $attachment )
					echo wp_get_attachment_image($thumb_id, $size);
					}
					?>
					<div class="desc">
						<h4>
							<?php the_title(); ?>
						</h4>
					</div>
				</div>
		<?php endwhile;?>
	<?php wp_reset_query();?>
</div>                                            
<?php

/*------------------------------------------*/
/* WPZOOM: Featured Works                   */
/*------------------------------------------*/
 
class Wpzoom_Featured_Works extends WP_Widget {
	
	function Wpzoom_Featured_Works() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'featured_works', 'description' => 'A list of featured posts from a selected category' );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'wpzoom-featured-works' );

		/* Create the widget. */
		$this->WP_Widget( 'wpzoom-featured-works', 'WPZOOM: Featured Works', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		
		extract( $args );

		/* User-selected settings. */
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$category = $instance['category'];
		$amount   = $instance['amount'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		echo '<ul class="posts">';
		
		$query_opts = apply_filters('wpzoom_query', array(
			'posts_per_page' => $amount,
			'post_type' => 'post'
		));
		if ( $category ) $query_opts['cat'] = $category;
		
		query_posts($query_opts);

		if ( have_posts() ) :

			while ( have_posts() ) :

				the_post();

				?>
				<li>
				<?php

					get_the_image( array( 'size' => 'featured-posts-widget', 'width' => 60, 'height' => 45, 'before' => '<div class="cover">', 'after' => '</div>' ) );

					?><div class="content">
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<p class="postmetadata"><span class="timestamp"><?php the_time('F j, Y'); ?></span> | <a href="<?php the_permalink() ?>#commentspost" title="Jump to the comments"><?php comments_number(__('no comments', 'wpzoom'),__('1 comment', 'wpzoom'),__('% comments', 'wpzoom')); ?></a></p>
					</div>
					<div class="cleaner">&nbsp;</div>

				</li><?php

			endwhile;

		endif;
			
		//Reset query_posts
		wp_reset_query();

		echo '</ul><!-- end .posts -->';

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = $new_instance['category'];
		$instance['amount'] = $new_instance['amount'];

		return $instance;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Favourite Works', 'category' => 1, 'amount' => 6 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br />
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>">Category:</label>
			<?php wp_dropdown_categories( 'name=' . $this->get_field_name( 'category' ) . '&id=' . $this->get_field_id( 'category' ) . '&selected=' . $instance['category'] ); ?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>">Show:</label>
			<input id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" value="<?php echo $instance['amount']; ?>" type="text" size="2" /> posts
		</p>

		<?php
	}
}

function wpzoom_register_fw_widget() {
	register_widget('Wpzoom_Featured_Works');
}
add_action('widgets_init', 'wpzoom_register_fw_widget');
?>
<?php
/*
Template Name: Full Width
*/

get_header();
?>

<div class="wrapper">

	<div id="content">

		<?php
		wp_reset_query();

		if ( have_posts() ) :

			while ( have_posts() ) :

				the_post();

				?>
				<h1><?php the_title(); ?></h1>
				<p class="postmetadata"><?php edit_post_link( __('EDIT', 'wpzoom'), '', ''); ?></p>

				<div class="postcontent">

					<?php
					the_content();
					
					wp_link_pages( array( 'before' => '<p class="pages"><strong>' . __('Pages', 'wpzoom') . ':</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) );
					?>

					<div class="cleaner">&nbsp;</div>

				</div><!-- end .postcontent -->

				<?php

				comments_template();

			endwhile;

		else:

			?><p><?php _e('Sorry, no posts matched your criteria.', 'wpzoom'); ?></p><?php

		endif;
		?>

	</div><!-- end #content -->

</div><!-- end .wrapper -->

<?php get_footer(); ?>
<?php
query_posts( array(
	'showposts' => option::get('featured_num'),
	'post__not_in' => get_option('sticky_posts'),
	'meta_key' => 'wpzoom_is_featured',
	'meta_value' => 1
) );
?>

<div id="featPosts">

	<div id="featPostsBig">

		<div class="container">

			<?php if ( have_posts() ) : ?>

				<ul class="slides_container">

					<?php
					while ( have_posts() ) :

						the_post();
						
						?><li class="slide">

							<?php
							get_the_image( array( 'size' => 'homepage-slider', 'width' => 950, 'height' => 430, 'before' => '<div class="cover">', 'after' => '</div>' ) );
							?>

						</li><?php

					endwhile;
					?>

				</ul>

			<?php endif; ?>

			<div class="cleaner">&nbsp;</div>

		</div><!-- end .container -->

	</div><!-- end #featPostsBig -->

	<a href="#" class="browse prev">Prev</a>
	<a href="#" class="browse next">Next</a>

</div><!-- end #featPosts -->

<?php wp_reset_query(); ?>

<script>
	jQuery(document).ready(
	function($)
	{
		$('#featPosts').slides({
			preload: false,
			play: <?php echo option::get('featured_rotate') && option::get('featured_interval') > 0 ? option::get('featured_interval') : '0'; ?>,
			hoverPause: true,
			autoHeight: true,
			generatePagination: false,
			generateNextPrev: false
		});
	});
</script>
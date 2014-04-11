<?php get_header(); ?>

<div class="wrapper">

	<div id="content">

		<h1><?php _e('Search Results for: ', 'wpzoom'); the_search_query(); ?></h1>
		<?php get_template_part('loop'); ?>

	</div><!-- end #content -->

</div><!-- end .wrapper -->

<?php get_footer(); ?>
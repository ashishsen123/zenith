<?php get_header(); ?>

<div class="wrapper">

	<?php if ( option::get('featured_enable') == 'on' && is_home() && $paged < 2 ) get_template_part('wpzoom', 'featured'); ?>

	<div id="content">

		<?php if ( option::get('recent_posts_show') == 'on' ) get_template_part('loop'); ?>

	</div><!-- end #content -->

</div><!-- end .wrapper -->

<?php get_footer(); ?>
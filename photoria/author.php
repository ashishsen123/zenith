<?php
get_header();

$curauth = get_query_var('author_name') ? get_userdatabylogin(get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>

<div class="wrapper">

	<div id="content">

		<h1><?php _e('Author', 'wpzoom'); ?>: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->display_name; ?></a></h1>

		<?php get_template_part('loop'); ?>

	</div><!-- end #content -->

</div><!-- end .wrapper -->

<?php get_footer(); ?>
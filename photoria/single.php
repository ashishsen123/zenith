<?php
get_header();

$template = get_post_meta($post->ID, 'wpzoom_post_template', true);
?>

<div class="wrapper<?php if ($template == 'side-left') echo' sidebarLeft'; ?>">

	<?php
	if ( isset($template) && $template != 'full' ) {
		?><div id="main"><?php
	}
	?>

	<div id="content">

		<?php
		wp_reset_query();

		if ( have_posts() ) :

			while ( have_posts() ) :

				the_post();

				?><h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

				<span class="postmetadata">

					<?php
					if ( option::get('post_author') == 'on' ) { _e('By ', 'wpzoom'); the_author_posts_link(); }
					if ( option::get('post_date') == 'on' ) { _e(' on ', 'wpzoom'); the_date(); echo ' '; the_time(); }
					if ( option::get('post_category') == 'on' ) { _e(' on ', 'wpzoom'); the_category(', '); }
					edit_post_link( __('EDIT', 'wpzoom'), ' / ', '');
					?>

				</span>

				<div class="postcontent">

					<?php
					if ( option::get('ad_content_select') == 'on' && option::get('ad_content_pos') == 'Before content' ) {

						?><div class="banner">

							<?php if ( option::get('ad_content_code') <> "" ) {
								echo stripslashes(option::get('ad_content_code'));
							} else {
								?><a href="<?php echo option::get('ad_content_imgurl'); ?>"><img src="<?php echo option::get('ad_content_imgpath'); ?>" alt="<?php echo option::get('ad_content_imgalt'); ?>" /></a><?php
							} ?>

						</div><?php

					}

					the_content();

					wp_link_pages( array( 'before' => '<p class="pages"><strong>' . __('Pages', 'wpzoom') . ':</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) );

					if ( option::get('post_tags') == 'on' ) { ?><?php the_tags( '<p class="tags"><strong>' . __('Tags', 'wpzoom') . ':</strong> ', ', ', '</p>' ); ?><?php }
					?>

					<div class="cleaner">&nbsp;</div>

					<?php
					if ( option::get('ad_content_select') == 'on' && option::get('ad_content_pos') == 'After content' ) {

						?><div class="banner">

							<?php if ( option::get('ad_content_code') <> "" ) {
								echo stripslashes(option::get('ad_content_code'));
							} else {
								?><a href="<?php echo option::get('ad_content_imgurl'); ?>"><img src="<?php echo option::get('ad_content_imgpath'); ?>" alt="<?php echo option::get('ad_content_imgalt'); ?>" /></a><?php
							} ?>

						</div><?php

					}
					?>

				</div><!-- end .postcontent --><?php

				comments_template();

			endwhile;

		else:

			?><p><?php _e('Sorry, no posts matched your criteria.', 'wpzoom'); ?></p><?php

		endif;
		?>

	</div><!-- end #content -->

	<?php
	if ( isset($template) && $template != 'full' ) {

		?></div><!-- end #main -->

		<div id="sidebar">

			<?php get_sidebar(); ?>

		</div><!-- end #sidebar --><?php

	} //if template is not full width
	?>

</div><!-- end .wrapper -->

<?php get_footer(); ?>
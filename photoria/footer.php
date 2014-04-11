		<div class="cleaner">&nbsp;</div>

		<div class="wrapper">

			<div id="preFooter">

				<div class="column"><?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('Footer: Column 1'); ?></div>
				<div class="column"><?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('Footer: Column 2'); ?></div>
				<div class="column"><?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('Footer: Column 3'); ?></div>
				<div class="column last"><?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('Footer: Column 4'); ?></div>
				<div class="cleaner">&nbsp;</div>

			</div><!-- end #preFooter -->

			<div id="footer">

				<p class="wpzoom"><a href="http://www.wpzoom.com" target="_blank"><?php _e('Portfolio WordPress Theme', 'wpzoom'); ?></a> by <a href="http://www.wpzoom.com" target="_blank" title="Premium WordPress Themes"><img src="<?php bloginfo('template_directory'); ?>/images/wpzoom.png" alt="WPZOOM" /></a></p>
				<p class="copy"><?php _e('Copyright', 'wpzoom'); ?> &copy; <?php echo date("Y", time()); ?> <?php bloginfo('name'); ?>. <?php _e('All Rights Reserved', 'wpzoom'); ?>.</p>

			</div><!-- end #footer -->

		</div>

	</div><!-- end #container -->

	<?php wp_footer(); ?>

</body>
</html>

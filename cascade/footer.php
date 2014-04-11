<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Justin Tadlock
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/cascade
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>

				<?php get_sidebar( 'primary' ) // Loads the sidebar-primary template. ?>
				
				<?php get_sidebar( 'secondary' ) // Loads the sidebar-secondary template. ?>

				<?php do_atomic( 'close_main' ); // cascade_close_main ?>

			</div><!-- .wrap -->

		</div><!-- #main -->
		
		<?php do_atomic( 'after_main' ); // cascade_after_main ?>

	</div></div><!-- #container -->

	<?php do_atomic( 'close_body' ); // cascade_close_body ?>
		
	<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>
	<?php get_sidebar( 'subsidiary-2c' ); // Loads the sidebar-subsidiary-2c.php template. ?>
	<?php get_sidebar( 'subsidiary-3c' ); // Loads the sidebar-subsidiary-3c.php template. ?>
	<?php get_sidebar( 'subsidiary-4c' ); // Loads the sidebar-subsidiary-4c.php template. ?>
	<?php get_sidebar( 'subsidiary-5c' ); // Loads the sidebar-subsidiary-5c.php template. ?>

	<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>
		
	<?php do_atomic( 'before_footer' ); // cascade_before_footer ?>

	<div id="footer">

		<?php do_atomic( 'open_footer' ); // cascade_open_footer ?>

		<div class="footer-wrap">
			
			<?php get_template_part( 'menu', 'footer' ); // Loads the menu-primary.php template. ?>

			<div class="footer-content">
				<?php echo apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) ); ?>
			</div><!-- .footer-content -->

			<?php do_atomic( 'footer' ); // cascade_footer ?>

		</div><!-- .wrap -->

		<?php do_atomic( 'close_footer' ); // cascade_close_footer ?>

	</div><!-- #footer -->

	<?php do_atomic( 'after_footer' ); // cascade_after_footer ?>

	<?php wp_footer(); // wp_footer ?>

</body>
</html>
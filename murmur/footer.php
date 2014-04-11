<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Murmur
 * @subpackage Template
 * @since 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>
				<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

				<?php do_atomic( 'close_main' ); // murmur_close_main ?>

			</div><!-- .wrap -->

		</div><!-- #main -->

		<?php do_atomic( 'after_main' ); // murmur_after_main ?>
		
		<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template ?>
		<?php get_sidebar( 'subsidiary-4c' ); // Loads the sidebar-subsidiary-4c.php template ?>
		<?php get_sidebar( 'subsidiary-5c' ); // Loads the sidebar-subsidiary-5c.php template ?>

		<?php do_atomic( 'before_footer' ); // murmur_before_footer ?>

		<footer id="footer">

			<?php do_atomic( 'open_footer' ); // murmur_open_footer ?>

			<div class="footer-wrap">
			
				<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

				<div class="footer-content">
					<?php hybrid_footer_content(); ?>
				</div>

				<?php do_atomic( 'footer' ); // murmur_footer ?>

			</div><!-- .footer-wrap -->

			<?php do_atomic( 'close_footer' ); // murmur_close_footer ?>

		</footer><!-- #footer -->

		<?php do_atomic( 'after_footer' ); // murmur_after_footer ?>

	</div><!-- #container -->

	<?php do_atomic( 'close_body' ); // murmur_close_body ?>

	<?php wp_footer(); // wp_footer ?>

</body>
</html>
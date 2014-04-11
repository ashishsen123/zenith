<?php
/**
 * 404 Template
 *
 * The 404 template is used when a reader visits an invalid URL on your site. By default, the template will 
 * display a generic message.
 *
 * @package Murmur
 * @subpackage Template
 * @since 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur/
 * @link http://codex.wordpress.org/Creating_an_Error_404_Page
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

@header( 'HTTP/1.1 404 Not found', true, 404 );

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // murmur_before_content ?>
	
	<?php if( hybrid_get_setting( 'murmur_site_description_extended' ) ) { ?>
		<div id="site-description-extended">
			<?php echo hybrid_get_setting( 'murmur_site_description_extended' ); ?>
		</div><!-- #site-description-extended -->
	<?php } ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // murmur_open_content ?>

		<div class="hfeed">

			<div id="post-0" class="<?php hybrid_entry_class(); ?>">

				<h1 class="error-404-title entry-title"><?php _e( 'Not Found', 'murmur' ); ?></h1>

				<div class="entry-content">

					<p>
					<?php printf( __( 'You tried going to %1$s, and it doesn\'t exist. All is not lost! You can search for what you\'re looking for.', 'murmur' ), '<code>' . home_url( esc_url( $_SERVER['REQUEST_URI'] ) ) . '</code>' ); ?>
					</p>

					<?php get_search_form(); // Loads the searchform.php template. ?>

				</div><!-- .entry-content -->

			</div><!-- .hentry -->

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // murmur_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // murmur_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>
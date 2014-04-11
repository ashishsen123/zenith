<?php
/**
 * Team Template
 *
 * This is the team template.  It is used to display singular views of team member profiles. This template works with the DevPress Team plugin.
 *
 * @package Murmur
 * @subpackage Functions
 * @version 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

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

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // murmur_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // murmur_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						
						<div class="entry-content">
							
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'murmur' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'murmur' ), 'after' => '</p>' ) ); ?>
							
							<?php echo apply_atomic_shortcode( 'page_edit', '[entry-edit-link before="<p>" after="</p>"]'); ?>

						</div><!-- .entry-content -->

						<?php do_atomic( 'close_entry' ); // murmur_close_entry ?>

					</div><!-- .hentry -->

					<?php get_sidebar( 'after-singular' ); // Load sidebar-after-singular.php template ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // murmur_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // murmur_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>
<?php
/**
 * Page Template
 *
 * This is the default page template.  It is used when a more specific template can't be found to display 
 * singular views of pages.
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Tung Do <ttsondo@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/cascade
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // cascade_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // cascade_open_content ?>

		<div class="hfeed">
		
			<?php if ( current_theme_supports( 'breadcrumb-trail' ) ) breadcrumb_trail( array( 'separator' => '&raquo;' ) ); ?>
			
			<?php get_sidebar( 'before-content' ); // Loads the sidebar-before-content.php template. ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // cascade_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // cascade_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'cascade' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'cascade' ), 'after' => '</p>' ) ); ?>
							
							<?php echo apply_atomic_shortcode( 'entry_edit_link', '[entry-edit-link before="<p>" after="</p>"]' ); ?>
						</div><!-- .entry-content -->
						
						<?php
							if ( hybrid_get_setting( 'cascade_author_bio_pages' ) ) {
								get_template_part( 'loop', 'entry-author' ); // Loads the loop-entry-author.php template.
							}
						?>

						<?php do_atomic( 'close_entry' ); // cascade_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // cascade_after_entry ?>

					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php do_atomic( 'after_singular' ); // cascade_after_singular ?>

					<?php
						// If comments are open or we have at least one comment, load the comments template.
						if ( comments_open() || '0' != get_comments_number() )
							comments_template( '/comments.php', true ); // Loads the comments.php template.
					?>

				<?php endwhile; ?>

			<?php endif; ?>
			
			<?php get_sidebar( 'after-content' ); // Loads the sidebar-after-content.php template. ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // cascade_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // cascade_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>
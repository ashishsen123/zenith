<?php
/**
 * Attachment Template
 *
 * This is the default attachment template.  It is used when visiting the singular view of a post attachment 
 * page (images, videos, audio, etc.).
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Tung Do <tung@devpress.com>
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

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // cascade_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // cascade_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						
						<?php get_sidebar( 'entry' ); // Loads the sidebar-entry.php template. ?>

						<div class="entry-content">
							<?php if ( wp_attachment_is_image( get_the_ID() ) ) : ?>

								<p class="attachment-image">
									<?php echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) ); ?>
								</p><!-- .attachment-image -->

							<?php else : ?>

								<?php hybrid_attachment(); // Function for handling non-image attachments. ?>

								<p class="download">
									<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="enclosure" type="<?php echo get_post_mime_type(); ?>"><?php printf( __( 'Download "%s";', 'cascade' ), the_title( '<span class="fn">', '</span>', false) ); ?></a>
								</p><!-- .download -->

							<?php endif; ?>

							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'cascade' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'cascade' ), 'after' => '</p>' ) ); ?>
							
							<?php if ( wp_attachment_is_image( get_the_ID() ) ) {
							$gallery = do_shortcode( sprintf( '[gallery id="%1$s" exclude="%2$s" columns="5" numberposts="15" orderby="rand"]', $post->post_parent, get_the_ID() ) );
							if ( !empty( $gallery ) )
								echo '<h3>' . __( 'Gallery', 'cascade' ) . '</h3>' . $gallery;
							}
							?>
						</div><!-- .entry-content -->

						<?php do_atomic( 'close_entry' ); // cascade_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // cascade_after_entry ?>

					<?php do_atomic( 'after_singular' ); // cascade_after_singular ?>

					<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // cascade_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // cascade_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>
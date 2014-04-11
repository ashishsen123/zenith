<?php
/**
 * Project Template
 *
 * This is the project template.  It is used to display singular views of projects. This template works with the DevPress Portfolio plugin.
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
	
	<?php if ( current_theme_supports( 'breadcrumb-trail' ) ) breadcrumb_trail( array( 'separator' => '&raquo;' ) ); ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // murmur_open_content ?>

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // murmur_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // murmur_open_entry ?>
						
						<?php murmur_project_previews(); ?>
						
						<div class="project-details">

							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
							
							<?php echo apply_atomic_shortcode( 'page_edit', '[entry-edit-link before="<p>" after="</p>"]'); ?>
							
							<div class="entry-content">
								
								<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'murmur' ) ); ?>
								<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'murmur' ), 'after' => '</p>' ) ); ?>
								
								<?php if( get_post_meta( $post->ID, 'dp_portfolio_project_client', true ) ) : ?>
								
									<?php if( get_post_meta( $post->ID, 'dp_portfolio_project_url', true ) ) : ?>
									
										<h5 class="project-client-title"><?php echo _e( 'Client:', 'murmur' ); ?></h5>
										
										<p class="project-launch"><a href="<?php echo esc_url( get_post_meta( $post->ID, 'dp_portfolio_project_url', true) ); ?>" class="project-link" title="<?php echo _e( 'Launch Project', 'murmur' ); ?>"><?php echo get_post_meta( $post->ID, 'dp_portfolio_project_client', true ); ?></a></p>

									<?php endif; ?>
								
								<?php endif; ?>
								
								<?php if ( get_post_meta( $post->ID, 'dp_portfolio_project_testimonial', true ) ) : ?>
								
									<h5 class="project-testimonial-title"><?php echo _e( 'Testimonial:', 'murmur' ); ?></h5>
									
									<blockquote class="project-testimonial">
										<p><?php echo get_post_meta( $post->ID, 'dp_portfolio_project_testimonial', true ); ?></p>
									</blockquote>
								
								<?php endif; ?>
								
								<?php if( has_term( '', 'dp_portfolio_role' ) ) : ?>
									
									<h5 class="project-services-title"><?php echo _e( 'Services Provided:', 'murmur' ); ?></h5>

									<ul class="project-services-listing">
										<?php echo get_the_term_list( $post->ID, 'dp_portfolio_role', '<li>', '</li><li>', '</li>' ); ?>
									</ul>
										
								<?php endif; ?>

							</div><!-- .entry-content -->
						
						</div><!-- .project-details -->

						<?php do_atomic( 'close_entry' ); // murmur_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_singular' ); // murmur_after_singular ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // murmur_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // murmur_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>
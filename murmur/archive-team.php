
<?php
/**
 * Team Archive Template
 *
 * The team template is used for displaying team member profiles. It works with the DevPress Team plugin.
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
		
			<ul class="loop-team">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php do_atomic( 'before_entry' ); // murmur_before_entry ?>
				
					<li id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // murmur_open_entry ?>
						
						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						
						<?php if( get_post_meta( $post->ID, 'dp_team_member_position', true ) ) : ?>
							<span class="team-member-position"><?php echo get_post_meta( $post->ID, 'dp_team_member_position', true ); ?></span>
						<?php endif; ?>
						
						<?php if ( current_theme_supports( 'get-the-image' ) )
							get_the_image( array( 'size' => 'thumbnail', 'width' => '66', 'height' => '66', 'link_to_post' => false ) );
						?>
						
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->

						<?php do_atomic( 'close_entry' ); // murmur_close_entry ?>

					</li><!-- .hentry -->
				
				<?php do_atomic( 'after_entry' ); // murmur_after_entry ?>
				
			<?php endwhile; ?>

			<?php else : ?>
				
				<li class="<?php hybrid_entry_class(); ?>">
					
					<div class="entry-summary">
						<p><?php _e( 'Apologies, but no members were found.', 'murmur' ); ?></p>
					</div><!-- .entry-summary -->
					
				</li><!-- .hentry .error -->

			<?php endif; ?>
			
			</ul><!-- .loop-entries -->

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // murmur_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // murmur_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>
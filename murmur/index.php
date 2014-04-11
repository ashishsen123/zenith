
<?php
/**
 * Index Template
 *
 * This is the default template.  It is used when a more specific template can't be found to display
 * posts. It is unlikely that this template will ever be used, but there may be rare cases.
 *
 * @package Murmur
 * @subpackage Template
 * @since 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur/
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
		
			<ul class="loop-entries">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php do_atomic( 'before_entry' ); // murmur_before_entry ?>
				
					<li id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
					
						<?php if( is_sticky() ) : ?>
						
							<?php do_atomic( 'open_sticky_entry' ) // murmur_open_sticky_entry ?>
								
								<?php if ( current_theme_supports( 'get-the-image' ) ) : ?>
									<?php $image = get_the_image( array( 'echo' => false ) );
										if ( $image ) : ?>
											<a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute( 'echo=1' ); ?>" rel="bookmark" class="thumbnail-link"><?php get_the_image( array( 'size' => 'murmur-sticky', 'link_to_post' => false, 'width' => '600', 'height' => '369' ) ); ?></a>
									<?php endif; ?>
								<?php endif; ?>
								
								<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

							<?php do_atomic( 'close_sticky_entry' ) // murmur_close_sticky-entry ?>
						
						<?php else : ?>

							<?php do_atomic( 'open_entry' ); // murmur_open_entry ?>
							
								<?php if ( current_theme_supports( 'get-the-image' ) ) : ?>
									<?php $image = get_the_image( array( 'echo' => false ) );
										if ( $image ) : ?>
											<a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute( 'echo=1' ); ?>" rel="bookmark" class="thunbnail-link"><?php get_the_image( array( 'size' => 'murmur-medium', 'link_to_post' => false, 'width' => '280', 'height' => '169' ) ); ?></a>
									<?php endif; ?>
								<?php endif; ?>

							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
								
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->

							<?php do_atomic( 'close_entry' ); // murmur_close_entry ?>
							
						<?php endif; ?>

					</li><!-- .hentry -->
				
				<?php do_atomic( 'after_entry' ); // murmur_after_entry ?>
				
			<?php endwhile; ?>

			<?php else : ?>
				
				<li class="<?php hybrid_entry_class(); ?>">

					<h2 class="entry-title"><?php _e( 'No Entries', 'murmur' ); ?></h2>
					
					<div class="entry-summary">
						<p><?php _e( 'Apologies, but no entries were found.', 'murmur' ); ?></p>
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
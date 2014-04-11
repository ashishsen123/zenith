<?php
/**
 * Home Template
 *
 * This is the home template.  Technically, it is the "posts page" template.  It is used when a visitor is on the 
 * page assigned to show a site's latest blog posts.
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
	
	<?php if( function_exists( 'sliders_setup' ) && hybrid_get_setting( 'cascade_featured_slider') && !is_paged() ) : ?>
	
		<div id="cascade-featured-slider">
			<?php
				$cascade_featured_slider_id = hybrid_get_setting( 'cascade_featured_slider' );
				echo do_shortcode( '[sliders id="' .$cascade_featured_slider_id. '"]' );	
			?>
		</div><!-- #cascade-featured-slider -->
			
	<?php endif; ?>
	
	<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>
	
	<?php get_sidebar( 'before-content' ); // Loads the sidebar-before-content.php template. ?>
		
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
			
				<?php do_atomic( 'before_entry' ); // cascade_before_entry ?>
				
				<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

				<div class="entry-content">
								
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'cascade' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'cascade' ), 'after' => '</p>' ) ); ?>

				</div><!-- .entry-content -->
				
				<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-published] [entry-author] [entry-permalink] [entry-comments-link] [entry-terms taxonomy="category" after=", "] [entry-terms taxonomy="post_tag"] [entry-edit-link]', 'cascade' ) . '</div>' ); ?>
			
				<?php do_atomic( 'after_entry' ); // cascade_after_entry ?>
				
			</div><!-- .hentry -->
			
				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

		<?php endif; ?>
		
	<?php get_sidebar( 'after-content' ); // Loads the sidebar-after-content.php template. ?>
		
	</div><!-- .hfeed -->
	
	<?php do_atomic( 'close_content' ); // cascade_close_content ?>
	
	<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

</div><!-- #content -->

<?php do_atomic( 'after_content' ); // cascade_after_content ?>

<?php get_footer(); // Loads the header.php template. ?>
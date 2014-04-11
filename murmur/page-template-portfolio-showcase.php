<?php
/**
 * Template Name: Portfolio Showcase
 *
 * This is the portfolio showcase template. It works with the DevPress Portfolio plugin and portfolio settings on your Appearance > Theme Settings page.
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
			
			<?php
			
				$loop = new WP_Query( array(
					'order'        => 'DESC',
					'posts_per_page' => hybrid_get_setting( 'murmur_slides_number' ),
					'post_status'  => 'publish',
					'post_type'    => 'project',
				) );
			?>

			<?php if( $loop->have_posts() ) : ?>

			<div id="dpps">
				<div class="sliders flexslider">
					<ul class="slides">
				
					<?php while( $loop->have_posts() ) : $loop->the_post(); ?>

						<li id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
						
							<div class="slide">
							
							<?php
								if ( current_theme_supports( 'get-the-image' ) )
									get_the_image( array( 'size' => 'dp-portfolio-wide', 'width' => '920', 'height' => '348' ) );
							?>
							
							</div><!-- .slide -->
							
						</li><!-- .hentry -->

					<?php endwhile; ?>

					</ul><!-- .slides -->
				</div><!-- .sliders flexslider -->
			</div><!-- #dpps -->

			<?php endif; ?>
			
			<?php
				$feature_one = hybrid_get_setting( 'murmur_feature_one' );
				$feature_two = hybrid_get_setting( 'murmur_feature_two' );
				$feature_three = hybrid_get_setting( 'murmur_feature_three' );
				
				if( !empty( $feature_one ) || !empty( $feature_two ) || !empty( $feature_three ) ) : ?>

				<div id="dpps-features">
			
					<?php if( !empty( $feature_one ) ) : ?>
				
						<div class="feature one">
						
							<?php echo hybrid_get_setting( 'murmur_feature_one' ); ?>
						
						</div><!-- .portfolio-showcase-feature -->
					
					<?php endif; ?>
					
					<?php if( !empty( $feature_two ) ) : ?>
				
						<div class="feature two">
						
							<?php echo hybrid_get_setting( 'murmur_feature_two' ); ?>
						
						</div><!-- .portfolio-showcase-feature -->
					
					<?php endif; ?>
					
					<?php if( !empty( $feature_three ) ) : ?>
				
						<div class="feature three">
						
							<?php echo hybrid_get_setting( 'murmur_feature_three' ); ?>
						
						</div><!-- .portfolio-showcase-feature -->
					
					<?php endif; ?>
				
				</div><!-- #dpps-features -->
				
			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // murmur_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // murmur_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>
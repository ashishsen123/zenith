<?php get_header(); ?>

	<div id="wrap">
		
		<section id="content" class="primary" role="main">
		
		<?php if (have_posts()) : ?>
			<h2 class="arh"><?php printf( __( 'Search Results for: %s', 'zeeTasty_lang' ), get_search_query() ); ?></h2>
		
		<?php while (have_posts()) : the_post();
		
			get_template_part( 'loop', 'index' );
		
			endwhile;
			
			themezee_display_pagination();

		else : ?>

			<h2 class="arh"><?php printf( __( 'Search Results for: %s', 'zeeTasty_lang' ), get_search_query() ); ?></h2>
			
			<div class="post">
				
				<div class="entry">
					<p><?php _e('No matches. Please try again, or use the navigation menus to find what you search for.', 'zeeTasty_lang'); ?></p>
				</div>
				
			</div>

			<?php endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	
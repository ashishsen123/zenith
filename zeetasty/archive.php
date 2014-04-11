<?php get_header(); ?>

	<div id="wrap">
		
		<section id="content" class="primary" role="main">
		
		<?php if (is_category()) { ?><h2 class="archive-title"><?php _e('Archive for', 'zeeTasty_lang'); ?> <?php echo single_cat_title(); ?></h2>
		<?php } elseif (is_date()) { ?><h2 class="archive-title"><?php _e('Archive for', 'zeeTasty_lang'); ?> <?php the_time(get_option('date_format')); ?></h2>
		<?php } elseif (is_author()) { ?><h2 class="archive-title"><?php _e('Author Archive', 'zeeTasty_lang'); ?></h2>
		<?php } elseif (is_tag()) { ?><h2 class="archive-title"><?php _e('Tag Archive for', 'zeeTasty_lang'); ?> <?php echo single_tag_title('', true); ?></h2>
		<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?><h2 class="archive-title"><?php _e('Archives', 'zeeTasty_lang'); ?></h2><?php } ?>
		
		<?php if (have_posts()) : while (have_posts()) : the_post();
		
			get_template_part( 'loop', 'index' );
		
			endwhile;
			
		themezee_display_pagination();

		endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	
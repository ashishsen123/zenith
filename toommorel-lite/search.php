<?php /**
 * The template for displaying Search Results pages.
 *
 */ ?>
<?php get_header(); ?>
<div class="grid_16 alpha">
    <div class="content">
        <div class="content-info">
            <h2><?php printf(__('Search Results for: %s', 'toommorel'), '' . get_search_query() . ''); ?></h2>
        </div>
        <div class="dotted_line"></div>
        <?php get_template_part('loop', 'search'); ?>
         <div class='wp-pagenavi'>
            <?php /* Display navigation to next/previous pages when applicable */ ?>
            <?php if ($wp_query->max_num_pages > 1) : ?>
                <?php next_posts_link(__('&larr; Older posts','toommorel')); ?>
                <?php previous_posts_link(__('Newer posts &rarr;','toommorel')); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--End Content-->
<?php get_sidebar(); ?>
<div class="clear"></div>
<div class="hr_big"></div>
<!--End Content Wrapper-->
</div>
<div class="clear"></div>
<!--End Main_wrapper-->
<?php get_footer(); ?>
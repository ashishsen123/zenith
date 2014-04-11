<?php /**
 * The template for displaying Category pages.
 *
 */ ?>
<?php get_header(); ?>
<div class="grid_16 alpha">
    <div class="content">
        <div class="content-info">
            <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
            <h2><?php printf(__('Category Archives: %s', 'toommorel'), '' . single_cat_title('', false) . ''); ?></</h2>
        </div>
        <div class="dotted_line"></div>
        <?php
        $category_description = category_description();
        if (!empty($category_description))
            echo '' . $category_description . '';
        /* Run the loop for the category page to output the posts.
         * If you want to overload this in a child theme then include a file
         * called loop-category.php and that will be used instead.
         */
        ?>
        <?php get_template_part('loop', 'category');
        ?>
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
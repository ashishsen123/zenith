<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 *
 */
?>
<?php get_header(); ?>
<div class="grid_16 alpha">
    <div class="content">
        <div class="content-info">
            <?php
            if (function_exists('inkthemes_breadcrumbs'))
                inkthemes_breadcrumbs();
            if (have_posts())
                the_post();
            ?>
        </div>
        <h2>
            <?php if (is_day()) : ?>
                <?php printf(__('Daily Archives: %s', 'toommorel'), get_the_date()); ?>
            <?php elseif (is_month()) : ?>
                <?php printf(__('Monthly Archives: %s', 'toommorel'), get_the_date('F Y')); ?>
            <?php elseif (is_year()) : ?>
                <?php printf(__('Yearly Archives: %s', 'toommorel'), get_the_date('Y')); ?>
            <?php else : ?>
                <?php _e('Blog Archives', 'toommorel'); ?>
            <?php endif; ?>
        </h2>
        <?php
        /* Since we called the_post() above, we need to
         * rewind the loop back to the beginning that way
         * we can run the loop properly, in full.
         */
        rewind_posts();
        /* Run the loop for the archives page to output the posts.
         * If you want to overload this in a child theme then include a file
         * called loop-archives.php and that will be used instead.
         */
        get_template_part('loop', 'archive');
        ?>
        <div class='wp-pagenavi'>
            <?php /* Display navigation to next/previous pages when applicable */ ?>
            <?php if ($wp_query->max_num_pages > 1) : ?>
                <?php next_posts_link(__('&larr; Older posts', 'toommorel')); ?>
                <?php previous_posts_link(__('Newer posts &rarr;', 'toommorel')); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--End Content-->
<?php get_sidebar(); ?>
<!--End Container Div-->
<?php get_footer(); ?>

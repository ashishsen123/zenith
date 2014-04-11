<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
?>
<?php get_header(); ?>
<div class="grid_16 alpha">
    <div class="content">
        <div class="content-info">
            <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
            <h2>Our Blog</h2>
        </div>
        <div class="dotted_line"></div>
        <?php get_template_part('loop', 'index'); ?>
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

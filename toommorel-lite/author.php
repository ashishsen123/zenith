<?php /**
 * The template for displaying Author pages.
 *
 */ ?>
<?php get_header(); ?>
<div class="grid_16 alpha">
    <div class="content">
        <div class="content-info">
            <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
            <h2><?php printf(__('Author Archives: %s', 'toommorel'), "<a class='url fn n' href='" . get_author_posts_url(get_the_author_meta('ID')) . "' title='" . esc_attr(get_the_author()) . "' rel='me'>" . get_the_author() . "</a>"); ?></h2>
        </div>
        <div class="dotted_line"></div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php
                // If a user has filled out their description, show a bio on their entries.
                if (get_the_author_meta('description')) :
                    ?>
                    <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('twentyten_author_bio_avatar_size', 60)); ?>
                    <h2><?php printf(__('About %s', 'toommorel'), get_the_author()); ?></h2>
                    <?php the_author_meta('description'); ?>
                <?php endif; ?>
            <?php endwhile;
        endif; ?>
        <?php
        /* Since we called the_post() above, we need to
         * rewind the loop back to the beginning that way
         * we can run the loop properly, in full.
         */
        rewind_posts();
        /* Run the loop for the author archive page to output the authors posts
         * If you want to overload this in a child theme then include a file
         * called loop-author.php and that will be used instead.
         */
        get_template_part('loop', 'author');
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

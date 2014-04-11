<?php
/**
 * The template for displaying Category pages.
 * @package Andrina 
 * @since Andrina 1.0
 */
?>
<?php get_header(); ?>
<div class="clear"></div>
<div class="page-content">
    <?php if (have_posts()) : ?>
        <h1 class="page_title single-heading"><?php printf(__('Category Archives: %s', 'andrina-lite'), '' . single_cat_title('', false) . ''); ?></h1>
        <div class="grid_16 alpha">
            <div class="content-bar">
                <?php
                $category_description = category_description();
                if (!empty($category_description))
                    echo '' . $category_description . '';
                /* Run the loop for the category page to output the posts.
                 * If you want to overload this in a child theme then include a file
                 * called loop-category.php and that will be used instead.
                 */
                ?>
                <?php get_template_part('loop', 'category'); ?>
                <div class="clear"></div>
                <nav id="nav-single"> <span class="nav-previous">
                        <?php next_posts_link(__('&larr; Older posts', 'andrina-lite')); ?>
                    </span> <span class="nav-next">
                        <?php previous_posts_link(__('Newer posts &rarr;', 'andrina-lite')); ?>
                    </span> </nav>
            <?php endif; ?>
        </div>
    </div>
    <div class="grid_8 omega">
        <!--Start Sidebar-->
        <?php get_sidebar(); ?>
        <!--End Sidebar-->
    </div>
</div>
</div>
<?php get_footer(); ?>
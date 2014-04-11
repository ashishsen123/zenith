<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package Bizway
 * 
 */
?>
<?php get_header(); ?>  
<!--Start Page Heading -->
<div class="page-heading-container">
    <div class="container_24">
        <div class="grid_24">
            <div class="page-heading">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div> 
        </div>
        <div class="clear"></div>
    </div>
</div>
<!--End Page Heading -->
<!--Start Page Content -->
<div class="page-content-container">
    <div class="container_24">
        <div class="grid_24">
            <div class="page-content">
                <div class="grid_sub_16 sub_alpha">
                    <div class="content-bar">
                        <?php if (have_posts()) : ?>
                            <h1 class="page_title"><?php printf(__('Tag Archives: %s', 'bizway'), '' . single_cat_title('', false) . ''); ?></h1>
                            <?php get_template_part('loop', 'index'); ?>
                            <div class="clear"></div>
                            <nav id="nav-single"> <span class="nav-previous">
                                    <?php next_posts_link(__('&larr; Older posts', 'bizway')); ?>
                                </span> <span class="nav-next">
                                    <?php previous_posts_link(__('Newer posts &rarr;', 'bizway')); ?>
                                </span> </nav>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="grid_sub_8 sub_omega">
                    <!--Start Sidebar-->
                    <?php get_sidebar(); ?>
                    <!--End Sidebar-->
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>
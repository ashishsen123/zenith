<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 */
?>
<?php get_header(); ?>  
<div class="heading_container">
    <div class="container_24">
        <div class="grid_24">
            <div class="page-heading">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="page_container">
    <div class="container_24">
        <div class="grid_24 body_color">
            <div class="page-content">
                <div class="grid_16 alpha">
                    <div class="content-bar">  			
                        <?php if (have_posts()) : the_post(); ?>
                            <?php the_content(); ?>
                            <div class="clear"></div>
                            <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'poloray') . '</span>', 'after' => '</div>')); ?>
                            <!--Start Comment box-->
                            <?php comments_template(); ?>
                            <!--End Comment box-->
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
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>
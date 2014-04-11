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
<div class="clear"></div>
<div class="page-content">   
    <h1 class="page_title"><?php the_title(); ?></h1>
    <div class="grid_24 alpha">
        <div class="content-bar">  
            <?php if (have_posts()) : the_post(); ?>
             <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('post_thumbnail', array('class' => 'postimg')); ?>    </a>
                <?php the_content(); ?>	
                <?php wp_link_pages(array('before' => '<div class="clear"></div><div class="page-link"><span>' . __('Pages:', 'andrina-lite') . '</span>', 'after' => '</div>')); ?>
            <?php endif; ?>
            <div class="clear"></div>
            <!--Start Comment box-->
            <?php comments_template(); ?>
            <!--End Comment box-->
        </div>
    </div>
   
</div>
</div>
<?php get_footer(); ?>
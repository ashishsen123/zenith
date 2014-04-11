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
get_header();
?>
<div class="grid_16 alpha">
    <div class="content">
        <div class="content-info">
            <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
            <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                    <h2>
                        <?php the_title(); ?>
                    </h2>
                </div>
                <div class="dotted_line"></div>
                <?php the_content(); ?>
                  <?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'toommorel' ) . '</span>', 'after' => '</div>' ) ); ?>
                <div class="clear"></div>
                <nav id="nav-single"> <span class="nav-previous">
                        <?php previous_post_link('%link', '<span class="meta-nav">&larr;</span> Previous Post '); ?>
                    </span> <span class="nav-next">
                        <?php next_post_link('%link', 'Next Post <span class="meta-nav">&rarr;</span>'); ?>
                    </span> </nav>
                <!-- #nav-single -->
                <div class="dotted_line"></div>
            <?php endwhile; ?>
        <div class="clear"></div>
        <div class="dotted_line"></div>
        <!--Start Comment Section-->
        <?php comments_template(); ?>
        <!--End comment Section-->
    </div>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<div class="hr_big"></div>
<!--End Content Wrapper-->
</div>
<div class="clear"></div>
<!--End Main_wrapper-->
<?php get_footer(); ?>
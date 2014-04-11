<?php
/**
 * The main single page template file.
 *
 *
 */
?>
<?php get_header(); ?>
<div class="grid_16 alpha">
    <div class="content">
        <div class="content-info">
            <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
            <h2><?php _e('Our Blog','toommorel'); ?> </h2>
        </div>
        <div class="dotted_line"></div>
        <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                <!--Start Post-->
                <div class="post single">
                    <h1 class="post_title"><span class="day">
                            <?php $get_time = the_time('d');
                            echo $get_time; ?> 
                            <span class="month"><?php echo get_the_time('M') ?></span></span><span class="title"><?php the_title(); ?></span></h1>
                    <div class="dotted_line"></div>
                    <div class="post-meta"><?php _e('Posted by','toommorel'); ?>
                        <?php the_author_posts_link() ?>
                        <?php _e('in','toommorel'); ?>
                        <?php the_category(', '); ?>
                        <?php _e(', Followed with','toommorel'); ?>
        <?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?>
                    </div>
                    <div class="dotted_line"></div>
                        <?php the_content(); ?>
                     <?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'toommorel' ) . '</span>', 'after' => '</div>' ) ); ?>
                    <div class="tags">
        <?php the_tags(__('Post Tagged with ','toommorel'), ', ', ''); ?>
                    </div>
                    <div class="dotted_line"></div>
                    <nav id="nav-single"> <span class="nav-previous">
                            <?php previous_post_link('%link', '<span class="meta-nav">&larr;</span> Previous Post '); ?>
                        </span> <span class="nav-next">
        <?php next_post_link('%link', 'Next Post <span class="meta-nav">&rarr;</span>'); ?>
                        </span> </nav>
                    <!-- #nav-single -->
                    <div class="dotted_line"></div>
                </div>
                <!--End Post-->
    <?php endwhile; ?>
        <div class="clear"></div>
        <div class="dotted_line"></div>
        <!--Start Comment Section-->
<?php comments_template(); ?>
        <!--End comment Section-->
    </div>
</div>
<!--End Content-->
<!--Start Sidebar-->
<?php get_sidebar(); ?>
<!--End Sidebar-->
<div class="clear"></div>
<div class="hr_big"></div>
<!--End Content Wrapper-->
</div>
<div class="clear"></div>
<!--End Main_wrapper-->
<?php get_footer(); ?>
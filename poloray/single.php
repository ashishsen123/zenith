<?php
/**
 * The Template for displaying all single posts.
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
                        <!-- Start the Loop. -->
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <!--post start-->
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="post_header clearfix">
                                        <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                                        <div class="post_date">
                                            <ul class="date">
                                                <li class="day"><?php echo get_the_time('d') ?></li>
                                                <li class="month"><?php echo get_the_time('F') ?></li>
                                                <li class="year"><?php echo get_the_time('Y') ?></li>
                                            </ul>
                                        </div>
                                        <ul class="post_meta">
                                            <li class="posted_by"><?php _e('By', 'poloray'); ?>&nbsp;&nbsp; <?php the_author_posts_link(); ?></li>
                                            <li class="post_category">&nbsp;&nbsp; <?php the_category(', '); ?></li>
                                            <li class="post_comment">&nbsp;&nbsp;<span></span><?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?></li>
                                        </ul>
                                    </div>
                                    <div class="post_content">
                                        <?php the_content(); ?>
                                        <div class="clear"></div>
                                        <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'poloray') . '</span>', 'after' => '</div>')); ?>
                                        <div class="clear"></div>
                                        <?php if (has_tag()) { ?>
                                            <div class="tag">
                                                <?php the_tags(__('Post Tagged with ', ', ', '')); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--End post-->
                            <?php endwhile;
                        else:
                            ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <p>
                                <?php _e('Sorry, no posts matched your criteria.', 'poloray'); ?>
                                </p>
                            </div>
                            <?php endif; ?>
                        <!--End Loop-->
                        <nav id="nav-single"> <span class="nav-previous">
                                <?php previous_post_link('%link', __('<span class="meta-nav">&larr;</span> Previous Post ', 'poloray')); ?>
                            </span> <span class="nav-next">
<?php next_post_link('%link', __('Next Post <span class="meta-nav">&rarr;</span>', 'poloray')); ?>
                            </span> </nav>
                        <!--Start Comment box-->
<?php comments_template(); ?>
                        <!--End Comment box--> 
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
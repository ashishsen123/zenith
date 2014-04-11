<?php
/*
  Template Name: Blog Page
 */
?>
<?php get_header(); ?>  
<!--Start Page Heading -->
<div class="page-heading-container">
    <div class="container_24">
        <div class="grid_24">
            <div class="page-heading">
                <h1><?php the_title(); ?></h1>
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
                        <?php
                        $limit = get_option('posts_per_page');
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        query_posts('showposts=' . $limit . '&paged=' . $paged);
                        $wp_query->is_archive = true;
                        $wp_query->is_home = false;
                        ?>
                        <!-- Start the Loop. -->
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <!--post start-->
                                <div class="post">
                                    <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1> 
                                    <div class="post_date">
                                        <ul class="date">
                                            <li class="day"><?php echo get_the_time('M') ?></li>
                                            <li class="month"><?php echo get_the_time('d') ?></li>
                                        </ul>
                                    </div>
                                    <ul class="post_meta">
                                        <li class="posted_by"><span><?php _e('Posted by', 'bizway'); ?></span>&nbsp;&nbsp; <?php the_author_posts_link(); ?></li>
                                        <li class="post_category"><span><?php _e('Posted in', 'bizway'); ?></span>&nbsp;&nbsp;<?php the_category(', '); ?></li>
                                        <?php if (comments_open()) : ?>
                                            <li class="post_comment"><?php comments_popup_link('', '1', '%'); ?></li>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="post_content">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('post-thumbnails', array('class' => 'postimg')); ?></a>
                                        <?php } else { ?>
                                            <?php bizway_get_image(200, 156); ?> 
                                            <?php
                                        }
                                        ?>
                                        <?php the_excerpt(); ?>
                                        <a class="read_more" href="<?php the_permalink() ?>"><?php _e('read more', 'bizway'); ?></a> </div>
                                    <?php wp_link_pages(array('before' => '' . __('Pages:', 'bizway'), 'after' => '')); ?>
                                </div>
                                <!--End Post-->

                            <?php
                            endwhile;
                        else:
                            ?>
                            <div class="post">
                                <p>
    <?php _e('Sorry, no posts matched your criteria.', 'bizway'); ?>
                                </p>
                            </div>
<?php endif; ?>
                        <!--End Loop-->
                        <nav id="nav-single"> <span class="nav-previous">
                                <?php next_posts_link(__('&larr; Older posts', 'bizway')); ?>
                            </span> <span class="nav-next">
<?php previous_posts_link(__('Newer posts &rarr;', 'bizway')); ?>
                            </span> </nav>			
                        <div class="clear"></div>			
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
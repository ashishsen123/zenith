<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Andrina 
 * @since Andrina 1.0
 */
?>
<?php get_header(); ?>
<div class="clear"></div>
<div class="page-content single_page">
    <div class="grid_16 alpha">
        <div class="content-bar">
            <!-- Start the Loop. -->
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <!--post Start-->
                    <div class="post">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('post_thumbnail', array('class' => 'postimg')); ?>
                        </a>
                        <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(esc_attr__('Permalink to %s', 'andrina-lite'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h1>
                        <ul class="post_meta">
                            <li class="post_date"><?php the_date(); ?></li>
                            <li class="post_category"><span>/&nbsp;&nbsp;<?php _e('Category', 'andrina-lite'); ?></span>&nbsp;<?php the_category(', '); ?></li>
                            <li class="posted_by"><span>/&nbsp;&nbsp;</span><?php _e('Posted By', 'andrina-lite'); ?>&nbsp;<?php the_author_posts_link(); ?></li>
                            <li class="postc_comment"><span>/&nbsp;&nbsp;</span>&nbsp;<?php comments_popup_link(__('No Comments.', 'andrina-lite'), __('1 Comment.', 'andrina-lite'), __('% Comments.', 'andrina-lite')); ?></li>
                        </ul>
                        <div class="post_content">  <?php the_content(); ?>
                            <div class="clear"></div>
                            <?php if (has_tag()) { ?>
                                <div class="tag">
                                    <?php the_tags(__('Post Tagged with ', ', ', '')); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!--post End-->                
                <?php endwhile; ?>
                <div class="clear"></div>
                <?php wp_link_pages(array('before' => '<div class="clear"></div><div class="page-link"><span>' . __('Pages:', 'andrina-lite') . '</span>', 'after' => '</div>')); ?>
            <?php else: ?>
                <div class="post">
                    <p>
                        <?php _e('Sorry, no posts matched your criteria.', 'andrina-lite'); ?>
                    </p>
                </div>
            <?php endif; ?>
            <!--End Loop-->
            <nav id="nav-single"> <span class="nav-previous">
                    <?php previous_post_link('%link', __('<span class="meta-nav">&larr;</span> Previous Post ', 'local-business')); ?>
                </span> <span class="nav-next">
                    <?php next_post_link('%link', __('Next Post <span class="meta-nav">&rarr;</span>', 'local-business')); ?>
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
<?php get_footer(); ?> 
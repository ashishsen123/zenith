<?php
/*
  Template Name: Blog Page
 */
?>
<?php get_header(); ?>
<div class="clear"></div>
<div class="page-content">
    <h1 class="single-heading"><?php _e('Blog Page', 'andrina-lite'); ?></h1>
    <div class="grid_16 alpha">
        <div class="content-bar">
            <?php
            $limit = get_option('posts_per_page');
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            // The Query                      
            $the_query = new WP_Query();
            $the_query->query('showposts=' . $limit . '&paged=' . $paged);
            ?>
            <!-- Start the Loop. -->
            <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <!--post Start-->
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                        <ul class="post_meta">
                            <li class="post_date"><?php the_date(); ?></li>
                            <li class="post_category"><span>/&nbsp;&nbsp;<?php _e('Category', 'andrina-lite'); ?></span>&nbsp;<?php the_category(', '); ?></li>
                            <li class="posted_by"><span>/&nbsp;&nbsp;</span><?php _e('Posted By', 'andrina-lite'); ?>&nbsp;<?php the_author_posts_link(); ?></li>
                            <li class="postc_comment"><span>/&nbsp;&nbsp;</span>&nbsp;<?php comments_popup_link(__('No Comments.', 'andrina-lite'), __('1 Comment.', 'andrina-lite'), __('% Comments.', 'andrina-lite')); ?></li>
                        </ul>
                        <div class="post_content"><?php if (has_post_thumbnail()) { ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('post_thumbnail', array('class' => 'postimg')); ?>
                                </a>
                            <?php } else { ?>
                                <a href="<?php the_permalink() ?>"><?php echo inkthemes_main_image(250, 170); ?></a>
                                <?php
                            }
                            ?>	
                            <?php the_excerpt(); ?>
                            <a class="read_more" href="<?php the_permalink() ?>"><?php _e('Read More', 'andrina-lite'); ?></a>
                            <div class="clear"></div>
                            <?php if (has_tag()) { ?>
                                <div class="tag">
                                    <?php the_tags('Post Tagged with ', ', ', ''); ?>
                                </div>
                            <?php } ?>                 
                        </div>
                    </div>
                    <!--post End-->
                <?php
                endwhile;
            else:
                ?>
                <div class="post">
                    <p>
    <?php _e('Sorry, no posts matched your criteria.', 'andrina-lite'); ?>
                    </p>
                </div>
<?php endif; ?>
            <!--End Loop-->
            <div class="clear"></div>
            <nav id="nav-single"> <span class="nav-previous">
                    <?php next_posts_link(__('&larr; Older posts', 'andrina-lite'),$the_query->max_num_pages); ?>
                </span> <span class="nav-next">
<?php previous_posts_link(__('Newer posts &rarr;', 'andrina-lite')); ?>
                </span> </nav>
            <?php wp_reset_postdata(); ?>
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
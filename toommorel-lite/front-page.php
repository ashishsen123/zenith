<?php
/*
  /**
 * The main front page file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
?>
<?php get_header(); ?>
<!--Start slider wrapper-->
<div class="slider_wrapper">
    <div id="slides">
        <div id="slide-box">
            <div class="slides_container col-full" >
                <!--Start Slide-->
                <div class="slide" >
                    <!-- // End $type IF Statement -->
                    <div class="entry">
                        <?php if (inkthemes_get_option('inkthemes_slideheading1') != '') { ?>
                            <h2><?php echo stripslashes(inkthemes_get_option('inkthemes_slideheading1')); ?></h2>
                        <?php } else { ?>
                            <h2>Top Section Heading</h2>
                        <?php } ?>
                        <?php if (inkthemes_get_option('inkthemes_slidedescription1') != '') { ?>
                            <p><?php echo stripslashes(inkthemes_get_option('inkthemes_slidedescription1')); ?></p>
                        <?php } else { ?>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <?php } ?>
                        <?php if (inkthemes_get_option('inkthemes_slidebuttontext1') != '') { ?>
                            <a class="btn" href="<?php echo inkthemes_get_option('inkthemes_slidelink1'); ?>"><span><?php echo inkthemes_get_option('inkthemes_slidebuttontext1'); ?></span></a>
                        <?php } else { ?>
                            <a class="btn" href="#"><span>Buy Now</span></a>
                        <?php } ?>
                    </div>         
                    <?php if (inkthemes_get_option('inkthemes_slideimage1') != '') { ?>
                        <div class="images"><img title="slideimage1" src="<?php echo inkthemes_get_option('inkthemes_slideimage1'); ?>"  alt="" /></div>
                    <?php } else { ?>
                        <div class="images"><img title="Top Section" src="<?php echo get_template_directory_uri(); ?>/images/3.png" alt="" /></div>
                    <?php } ?>
                </div>
                <!--End slide -->
            </div>
            <!-- /.slides_container -->
        </div>
        <!-- /#slide-box -->
        <div class="clear"></div>
    </div>
</div>
<!--End slider wrapper-->
<div class="clear"></div>
<!--Start Content Wrapper-->
<div class="content_wrapper">
    <div class="two_third">
        <div class="home_content">
            <!-- Start the Loop. -->
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <!--Start Post-->
                    <div class="post blog <?php post_class(); ?>" id="post-<?php the_ID(); ?>">
                        <h1 class="post_title"><span class="day">
                                <?php
                                $get_time = the_time('d');
                                echo $get_time;
                                ?> 
                                <span class="month"><?php echo get_the_time('M') ?></span></span><span class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>

                        </h1>
                        <div class="dotted_line"></div>
                        <div class="post-meta">Posted by
                            <?php the_author_posts_link() ?>
                            in
                                <?php the_category(', '); ?>
                            , Followed with <a href="#">
        <?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?>
                            </a> </div>
                        <div class="dotted_line"></div>
                            <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
                            <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('post_thumbnail', array('class' => 'postimg')); ?>
                            </a>
                            <?php
                        } else {
                            echo inkthemes_main_image();
                        }
                        ?>
        <?php the_excerpt(); ?>
                        <a class="read-more" href="<?php the_permalink() ?>">Read More ...</a>
                        <div class="tags">
        <?php the_tags(__('Post Tagged with ', 'toommorel'), ', ', ''); ?>
                        </div>
                        <div class="dotted_line"></div>
                    </div>
                    <!--End Post-->
                <?php
                endwhile;
            else:
                ?>
                <div class="post">
                    <p>
                <?php _e('Sorry, no posts matched your criteria.', 'toommorel'); ?>
                    </p>
                </div>
                <?php endif; ?>
            <div class="folio-page-info">
<?php inkthemes_pagination(); ?>
            </div>
        </div>
    </div>
    <!--End Content-->
<?php get_sidebar('home'); ?>
    <div class="clear"></div>
</div>
<div class="hr_big"></div>
<!--End Content Wrapper-->
</div>
<div class="clear"></div>
<!--End Main_wrapper-->
<?php get_footer(); ?>

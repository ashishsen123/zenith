<?php
/**
 * The template for displaying front page pages.
 * @package Andrina 
 * @since Andrina 1.0
 */
?>
<?php get_header(); ?>
<div class="slider-wrapper">
    <div id="container">
        <div id="example">
            <div id="slides">
                <div class="slides_container">
                    <!--Start Slider 1-->                    
                    <div class="slide">                         
                        <?php if (inkthemes_get_option('inkthemes_slideimage1') != '') { ?>                        
                            <a href="<?php echo inkthemes_get_option('inkthemes_slider_link1'); ?>" >
                                <img src="<?php echo inkthemes_get_option('inkthemes_slideimage1'); ?>"  alt="Slide 1"/>
                            </a>
                        <?php } else { ?>
                            <a href="#" >
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sliderimg.jpg"  alt="Slide 1"/>
                            </a>
                        <?php } ?>                       
                        <div class="caption">                            
                            <?php if (inkthemes_get_option('inkthemes_slider_heading1') != '') { ?>                             
                                <h2><?php echo stripslashes(inkthemes_get_option('inkthemes_slider_heading1')); ?></h2>
                            <?php } else { ?>
                                <h2><?php _e('Theme Heading', 'andrina-lite'); ?></h2>
                            <?php } ?>                            
                            <?php if (inkthemes_get_option('inkthemes_slider_des1') != '') { ?>                              
                                <p> <?php echo stripslashes(inkthemes_get_option('inkthemes_slider_des1')); ?></p>
                            <?php } else { ?>
                                <p><?php _e('Lorem ipsum dolor sit amet, are to seg an elit. Duis nec purus a quis puar a tortor,', 'andrina-lite'); ?></p>
                            <?php } ?>                            
                        </div>
                    </div>                     
                    <!--End Slider 1-->                   
                </div>
            </div>
            <img src="<?php echo get_template_directory_uri(); ?>/images/slider-frame2.png" alt="Example Frame" id="frame">
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="full-content">
    <div class="feature-content">
        <?php if (inkthemes_get_option('inkthemes_main_head') != '') { ?>
            <h1><?php echo stripslashes(inkthemes_get_option('inkthemes_main_head')); ?></h1>
        <?php } else { ?>        
            <h1><?php _e('Recent Projects', 'andrina-lite'); ?></h1>
        <?php } ?>        
        <div class="feature-item">
            <?php if (inkthemes_get_option('inkthemes_feature_img1') != '') { ?>
                <a href="<?php echo inkthemes_get_option('inkthemes_link1'); ?>"><img src="<?php echo inkthemes_get_option('inkthemes_feature_img1'); ?>"/></a>
            <?php } else { ?>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/img1.jpg"/></a>
            <?php } ?>            
            <?php if (inkthemes_get_option('inkthemes_f_head1') != '') { ?>
                <h4><?php echo stripslashes(inkthemes_get_option('inkthemes_f_head1')); ?></h4>
            <?php } else { ?>            
                <h4><?php _e('Theme Heading pretty.', 'andrina-lite'); ?></h4>
            <?php } ?>            
            <?php if (inkthemes_get_option('inkthemes_f_des1') != '') { ?>
                <p><?php echo stripslashes(inkthemes_get_option('inkthemes_f_des1')); ?></p>
            <?php } else { ?>
                <p><?php _e('Lorem ipsum dolor sit amet, are to seg an elit. Duis nec purus a quis puar a tortor, quis puar a tortor.', 'andrina-lite'); ?></p>
            <?php } ?>            
        </div>
        <div class="feature-item">
            <?php if (inkthemes_get_option('inkthemes_feature_img2') != '') { ?>
                <a href="<?php echo inkthemes_get_option('inkthemes_link2'); ?>"><img src="<?php echo inkthemes_get_option('inkthemes_feature_img2'); ?>"/></a>
            <?php } else { ?>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/img2.jpg"/></a>
            <?php } ?>            
            <?php if (inkthemes_get_option('inkthemes_f_head2') != '') { ?>
                <h4><?php echo stripslashes(inkthemes_get_option('inkthemes_f_head2')); ?></h4>
            <?php } else { ?>
                <h4><?php _e('Theme Heading pretty.', 'andrina-lite'); ?></h4>
            <?php } ?>            
            <?php if (inkthemes_get_option('inkthemes_f_des2') != '') { ?>
                <p><?php echo stripslashes(inkthemes_get_option('inkthemes_f_des2')); ?></p>
            <?php } else { ?>
                <p><?php _e('Lorem ipsum dolor sit amet, are to seg an elit. Duis nec purus a quis puar a tortor, quis puar a tortor.', 'andrina-lite'); ?></p>
            <?php } ?>            
        </div>
        <div class="feature-item">
            <?php if (inkthemes_get_option('inkthemes_feature_img3') != '') { ?>
                <a href="<?php echo inkthemes_get_option('inkthemes_link3'); ?>"><img src="<?php echo inkthemes_get_option('inkthemes_feature_img3'); ?>"/></a>
            <?php } else { ?>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/img3.jpg"/></a>
            <?php } ?>            
            <?php if (inkthemes_get_option('inkthemes_f_head3') != '') { ?>
                <h4><?php echo stripslashes(inkthemes_get_option('inkthemes_f_head3')); ?></h4>
            <?php } else { ?>
                <h4><?php _e('Theme Heading pretty.', 'andrina-lite'); ?></h4>
            <?php } ?>            
            <?php if (inkthemes_get_option('inkthemes_f_des3') != '') { ?>
                <p><?php echo stripslashes(inkthemes_get_option('inkthemes_f_des3')); ?></p>
            <?php } else { ?>
                <p><?php _e('Lorem ipsum dolor sit amet, are to seg an elit. Duis nec purus a quis puar a tortor, quis puar a tortor.', 'andrina-lite'); ?></p>
            <?php } ?>            
        </div>
        <div class="feature-item">
            <?php if (inkthemes_get_option('inkthemes_feature_img4') != '') { ?>
                <a href="<?php echo inkthemes_get_option('inkthemes_link4'); ?>"><img src="<?php echo inkthemes_get_option('inkthemes_feature_img4'); ?>"/></a>
            <?php } else { ?>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/img4.jpg"/></a>
            <?php } ?>            
            <?php if (inkthemes_get_option('inkthemes_f_head4') != '') { ?>
                <h4><?php echo stripslashes(inkthemes_get_option('inkthemes_f_head4')); ?></h4>
            <?php } else { ?>
                <h4><?php _e('Theme Heading pretty.', 'andrina-lite'); ?></h4>
            <?php } ?>            
            <?php if (inkthemes_get_option('inkthemes_f_des4') != '') { ?>
                <p><?php echo stripslashes(inkthemes_get_option('inkthemes_f_des4')); ?></p>
            <?php } else { ?>
                <p><?php _e('Lorem ipsum dolor sit amet, are to seg an elit. Duis nec purus a quis puar a tortor, quis puar a tortor.', 'andrina-lite'); ?></p>
            <?php } ?>            
        </div>
    </div>
    <div class="clear"></div>
    <div class="bottom-feature">
        <div class="bottom-feature-left">
            <?php
            if (is_active_sidebar('front-widget-area')) :
                dynamic_sidebar('front-widget-area');
            else:            
            ?>
            <?php if (inkthemes_get_option('inkthemes_left_head') != '') { ?>
                <h1><?php echo stripslashes(inkthemes_get_option('inkthemes_left_head')); ?></h1>
            <?php } else { ?>
                <h1><?php _e('From The Blog', 'andrina-lite'); ?></h1>
            <?php } ?> 
            <?php query_posts('posts_per_page=2'); ?>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="bottom-feature-left-inner-wrapper">
                        <a href="<?php the_permalink() ?>"><?php echo inkthemes_blog_image(185, 165); ?></a>
                        <div class="bottom-feature-left-inner">
                            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                            <?php echo inkthemes_custom_trim_excerpt(30); ?>
                            <a href="<?php the_permalink() ?>" class="index-read"></a> 
                        </div>
                    </div>
                    <?php
                endwhile;
            endif;            
            ?>
            <?php 
            wp_reset_query(); 
            endif;
            ?>
        </div>
        <div class="bottom-feature-right">
            <?php if (inkthemes_get_option('inkthemes_right_head') != '') { ?>
                <h1><?php echo stripslashes(inkthemes_get_option('inkthemes_right_head')); ?></h1>
            <?php } else { ?>
                <h1><?php _e('Recent Works', 'andrina-lite'); ?></h1>
            <?php } ?>            
            <div class="bottom-feature-right-wrapper">
                <?php if (inkthemes_get_option('inkthemes_right_des') != '') { ?>
                    <?php echo stripslashes(inkthemes_get_option('inkthemes_right_des')); ?>
                <?php } else { ?>                   
                    <p><?php _e("Even if it ain't pretty  it's fricken  cool, best hing since sliced thebread and instant is a sliced thebread and instant is a sliced thebread and instant is a cool,st thing since sliced thebread and instant is a  ven if it ain't pretty it's icken  sliced .", 'andrina-lite'); ?></p>
                <?php } ?>                
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="index-info">
    <div class="grid_6 alpha">
        <div class="index-info-one">            
            <?php if (inkthemes_get_option('inkthemes_contact_no') != '') { ?>
                <span><?php echo stripslashes(inkthemes_get_option('inkthemes_contact_no')); ?></span>
            <?php } else { ?>
                <span><?php _e('91 xxxx xxxx', 'andrina-lite'); ?></span>
            <?php } ?>                       
        </div>
    </div>
    <div class="grid_7">
        <div class="index-info-two">
            <?php if (inkthemes_get_option('inkthemes_email_add') != '') { ?>
                <span><?php echo stripslashes(inkthemes_get_option('inkthemes_email_add')); ?></span>
            <?php } else { ?>
                <span><?php _e('yourname@domain.com', 'andrina-lite'); ?></span>
            <?php } ?>               
        </div>
    </div>
    <div class="grid_11 omega">
        <div class="index-info-three">
            <?php if (inkthemes_get_option('inkthemes_date') != '') { ?>
                <span><?php echo stripslashes(inkthemes_get_option('inkthemes_date')); ?></span> 
            <?php } else { ?>
                <span><?php _e('Monday To Saturday 11AM To 8PM', 'andrina-lite'); ?></span> 
            <?php } ?>            
        </div>
    </div>
</div>


</div>
<!--End Index-->
<?php get_footer(); ?>
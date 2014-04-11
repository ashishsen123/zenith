<?php
/**
 * The main template file.
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
<div class="slider_container">
    <div class="container_24">
        <div class="grid_24">
            <div class="grid_12 alpha">
                <div class="slider_info">
                    <?php if (poloray_get_option('poloray_slider_heading') != '') { ?>
                        <h1><a href="<?php echo poloray_get_option('poloray_slider_link'); ?>"><?php echo stripslashes(poloray_get_option('poloray_slider_heading')); ?></a></h1>
                    <?php } else { ?>
                        <h1><a href="#"><?php _e("Your Site is faster to built, 
                                easy to use & Search Engine
                                Optimized.",'poloray'); ?></a></h1>
                    <?php } ?> 
                    <?php if (poloray_get_option('poloray_slider_description') != '') { ?>
                        <p><?php echo stripslashes(poloray_get_option('poloray_slider_description')); ?></p>
                    <?php } else { ?>
                        <p><?php _e('Poloray WordPress Theme with Single Click 
                            Installation, Just a Click and your website is 
                            ready in Instant.','poloray'); ?></p>		
                    <?php } ?>
                </div>
            </div>
            <div class="grid_12 omega">
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                        //The strpos funtion is comparing the strings to allow uploading of the Videos & Images in the Slider
                        $mystring1 = poloray_get_option('poloray_slideimage1');
                        $value_img = array('.jpg', '.png', '.jpeg', '.gif', '.bmp', '.tiff', '.tif');
                        $check_img_ofset = 0;
                        foreach ($value_img as $get_value) {
                            if (preg_match("/$get_value/", $mystring1)) {
                                $check_img_ofset = 1;
                            }
                        }
                        // Note our use of ===.  Simply == would not work as expected
                        // because the position of 'a' was the 0th (first) character.                            
                        ?>
                        <?php if ($check_img_ofset == 0 && poloray_get_option('poloray_slideimage1') != '') { ?>
                            <li><?php echo poloray_get_option('poloray_slideimage1'); ?></li>
                        <?php } else { ?> 
                            <li>
                                <?php if (poloray_get_option('poloray_slideimage1') != '') { ?>
                                    <a href="<?php echo poloray_get_option('poloray_slider_link'); ?>"><img  src="<?php echo poloray_get_option('poloray_slideimage1'); ?>" alt=""/></a>
                                <?php } else { ?>
                                    <a href="#"><img  src="<?php echo get_template_directory_uri(); ?>/images/sliderimg.jpg" alt=""/></a>
                                <?php } ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="slider_wrapper"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="content_wrapper">
    <div class="container_24">
        <div class="grid_24 body_color">
            <div class="top_content_wrapper">
                <div class="grid_17 alpha">
                    <div class="content_info">
                        <?php if (poloray_get_option('poloray_mainheading') != '') { ?>
                            <h1><?php echo stripslashes(poloray_get_option('poloray_mainheading')); ?></h1>
                        <?php } else { ?>
                            <h1><?php _e('You will find some of the best and most reliable products over Here.','poloray'); ?></h1>
                        <?php } ?>
                    </div>
                </div>
                <div class="grid_7 omega">
                    <div class="content-info-btn"> 
                        <?php if (poloray_get_option('poloray_homepage_button') != '') { ?>
                            <a href="<?php echo poloray_get_option('poloray_homepage_button_link'); ?>" class="contentbtn"><?php echo stripslashes(poloray_get_option('poloray_homepage_button')); ?></a>
                        <?php } else { ?>
                            <a href="#" class="contentbtn">
                                <?php _e('Get the Item Now !','poloray'); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="feature_box">
                <div class="grid_6 alpha">
                    <div class="feature_inner_box first">
                        <?php if (poloray_get_option('poloray_wimg1') != '') { ?>
                            <div class="circle"><img src="<?php echo poloray_get_option('poloray_wimg1'); ?>" /></div>
                        <?php } else { ?>
                            <div class="circle">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/circleimg1.jpg" alt="Feature image" /></div>
                        <?php } ?>				
                        <?php if (poloray_get_option('poloray_firsthead') != '') { ?>
                            <h2 class="feature_title"><a href="<?php if (poloray_get_option('poloray_feature_link1') != '') {
                            echo poloray_get_option('poloray_feature_link1');
                        } ?>"><?php echo stripslashes(poloray_get_option('poloray_firsthead')); ?></a></h2>
                        <?php } else { ?>
                            <h2 class="feature_title"><a href="#"><?php _e('Quick to Install and Configure','poloray'); ?></a></h2>
                        <?php } ?>
                        <?php if (poloray_get_option('poloray_firstdesc') != '') { ?>
                            <p><?php echo stripslashes(poloray_get_option('poloray_firstdesc')); ?></p>
                        <?php } else { ?>
                            <p><?php _e('Poloray Theme is very easy to Install and you can do the setup in few minutes.','poloray'); ?></p>			  
                        <?php } ?>
                        <div class="readmore-btn"> <a class="readmore" href="<?php if (poloray_get_option('poloray_feature_link1') != '') {
                        echo poloray_get_option('poloray_feature_link1');
                    } ?>"><?php _e('Read More','poloray'); ?></a></div>
                    </div>
                </div>
                <div class="grid_6">
                    <div class="feature_inner_box">
                        <?php if (poloray_get_option('poloray_fimg2') != '') { ?>
                            <div class="circle"><img src="<?php echo poloray_get_option('poloray_fimg2'); ?>" /></div>
                        <?php } else { ?>
                            <div class="circle"><img src="<?php echo get_template_directory_uri(); ?>/images/circleimg2.jpg" alt="Feature image" /></a></div>
                        <?php } ?>
                        <?php if (poloray_get_option('poloray_headline2') != '') { ?>
                            <h2 class="feature_title"><a href="<?php if (poloray_get_option('poloray_feature_link2') != '') {
                            echo poloray_get_option('poloray_feature_link2');
                        } ?>"><?php echo stripslashes(poloray_get_option('poloray_headline2')); ?></a></h2>
                        <?php } else { ?>
                            <h2 class="feature_title"><a href="#"><?php _e('Multi Language Translation Enabled','poloray'); ?></a></h2>					  
                            <?php } ?>
                            <?php if (poloray_get_option('poloray_seconddesc') != '') { ?>
                            <p><?php echo stripslashes(poloray_get_option('poloray_seconddesc')); ?></p>
                            <?php } else { ?>
                            <p><?php _e('Poloray Theme allows multi-language translation &amp; you can easily translate your site.','poloray'); ?></p>			   
                        <?php } ?>
                        <div class="readmore-btn"> <a class="readmore" href="<?php if (poloray_get_option('poloray_feature_link2') != '') {
                            echo poloray_get_option('poloray_feature_link2');
                        } ?>"><?php _e('Read More','poloray'); ?></a></div>
                    </div>
                </div>
                <div class="grid_6">
                    <div class="feature_inner_box">
                            <?php if (poloray_get_option('poloray_fimg3') != '') { ?>
                            <div class="circle"><img src="<?php echo poloray_get_option('poloray_fimg3'); ?>" /></div>
                            <?php } else { ?>
                            <div class="circle"><img src="<?php echo get_template_directory_uri(); ?>/images/circleimg3.jpg" alt="Feature image" /></div>
                                <?php } ?>
                                <?php if (poloray_get_option('poloray_headline3') != '') { ?>
                            <h2 class="feature_title"><a href="<?php if (poloray_get_option('poloray_feature_link3') != '') {
                                echo poloray_get_option('poloray_feature_link3');
                            } ?>"><?php echo stripslashes(poloray_get_option('poloray_headline3')); ?></a></h2>
                            <?php } else { ?>
                            <h2 class="feature_title"><a href="#"><?php _e('Mobile &amp; Tablet Optimized Design','poloray'); ?></a></h2>				  
                            <?php } ?>
                        <?php if (poloray_get_option('poloray_thirddesc') != '') { ?>
                            <p><?php echo stripslashes(poloray_get_option('poloray_thirddesc')); ?></p>
                        <?php } else { ?>
                            <p><?php _e('Poloray Theme had a Responsive Mobiles &amp; Tablets Optimized Design.','poloray'); ?></p>
                        <?php } ?>
                        <div class="readmore-btn"> <a class="readmore" href="<?php if (poloray_get_option('poloray_feature_link3') != '') {
                            echo poloray_get_option('poloray_feature_link3');
                        } ?>"><?php _e('Read More','poloray'); ?></a></div>
                    </div>
                </div>
                <div class="grid_6 omega">
                    <div class="feature_inner_box last"><?php if (poloray_get_option('poloray_fimg4') != '') { ?>
                            <div class="circle"><img src="<?php echo poloray_get_option('poloray_fimg4'); ?>" /></div>
                        <?php } else { ?>
                            <div class="circle"><img src="<?php echo get_template_directory_uri(); ?>/images/circleimg4.jpg" alt="Feature image" /></div>
                            <?php } ?>
                            <?php if (poloray_get_option('poloray_headline4') != '') { ?>
                            <h2 class="feature_title"><a href="<?php if (poloray_get_option('poloray_feature_link4') != '') {
                                    echo poloray_get_option('poloray_feature_link4');
                                } ?>"><?php echo stripslashes(poloray_get_option('poloray_headline4')); ?></a></h2>
                            <?php } else { ?>
                            <h2 class="feature_title"><a href="#"><?php _e('Highly Search Engine Friendly','poloray'); ?></a></h2>				  
                            <?php } ?>
                            <?php if (poloray_get_option('poloray_fourthdesc') != '') { ?>
                            <p><?php echo stripslashes(poloray_get_option('poloray_fourthdesc')); ?></p>
                            <?php } else { ?>
                            <p><?php _e('Poloray Theme is SEO Friendly WordPress Theme, rank your site easily with Poloray.','poloray'); ?></p>
                        <?php } ?>
                        <div class="readmore-btn"> <a class="readmore" href="<?php if (poloray_get_option('poloray_feature_link4') != '') {
                        echo poloray_get_option('poloray_feature_link4');
                    } ?>"><?php _e('Read More','poloray'); ?></a></div>
                    </div>
                </div>
            </div>        
        </div>
        <div class="clear"></div>
    </div>   
</div>
<?php get_footer(); ?>
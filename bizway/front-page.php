<?php
/**
 * The template for displaying front page pages.
 *
 */
?>
<?php get_header(); ?> 
<!--Start Slider Wrapper-->
<div class="slider-wrapper-container">
    <div class="container_24">
        <div class="grid_24">
            <div class="slider-wrapper">
                <?php if (bizway_get_option('bizway_first_head') != '') { ?>
                    <h1><?php echo stripslashes(bizway_get_option('bizway_first_head')); ?></h1>
                <?php } else { ?>
                    <h1><?php _e('Easy &amp; Flexible to Use WordPress Theme', 'bizway'); ?></h1>
                <?php } ?>    
                <?php if (bizway_get_option('bizway_second_head') != '') { ?>
                    <h2><?php echo stripslashes(bizway_get_option('bizway_second_head')); ?></h2>
                <?php } else { ?>
                    <h2><?php _e('The header area consists of the area for putting up your own fullwidth banner which can include Address details.', 'bizway'); ?></h2>
                <?php } ?>
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                        //The strpos funtion is comparing the strings to allow uploading of the Videos & Images in the Slider
                        $mystring1 = bizway_get_option('bizway_slideimage1');
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
                        <?php if ($check_img_ofset == 0 && bizway_get_option('bizway_slideimage1') != '') { ?>
                            <li><?php echo bizway_get_option('bizway_slideimage1'); ?></li>
                        <?php } else { ?> 
                            <li>
                                <?php if (bizway_get_option('bizway_slideimage1') != '') { ?>
                                    <a href="<?php echo bizway_get_option('bizway_slidelink1'); ?>"><img  src="<?php echo bizway_get_option('bizway_slideimage1'); ?>" alt=""/></a>
                                <?php } else { ?>
                                    <a href="#"><img  src="<?php echo get_template_directory_uri(); ?>/images/slide1.jpg" alt=""/></a>
                                <?php } ?></li>
                        <?php } ?>  
                        <?php
                        //The strpos funtion is comparing the strings to allow uploading of the Videos & Images in the Slider
                        $mystring2 = bizway_get_option('bizway_slideimage2');
                        $value_img = array('.jpg', '.png', '.jpeg', '.gif', '.bmp', '.tiff', '.tif');
                        $check_img_ofset = 0;
                        foreach ($value_img as $get_value) {
                            if (preg_match("/$get_value/", $mystring2)) {
                                $check_img_ofset = 1;
                            }
                        }
                        // Note our use of ===.  Simply == would not work as expected
                        // because the position of 'a' was the 0th (first) character.                            
                        ?>
                        <?php if ($check_img_ofset == 0 && bizway_get_option('bizway_slideimage2') != '') { ?>
                            <li><?php echo bizway_get_option('bizway_slideimage2'); ?></li>
                        <?php } else { ?> 
                            <li>
                                <?php if (bizway_get_option('bizway_slideimage2') != '') { ?>
                                    <a href="<?php echo bizway_get_option('bizway_slidelink2'); ?>"><img  src="<?php echo bizway_get_option('bizway_slideimage2'); ?>" alt=""/></a>
                                <?php } else { ?>
                                    <a href="#"><img  src="<?php echo get_template_directory_uri(); ?>/images/slide2.jpg" alt=""/></a>
                                <?php } ?></li>
                        <?php } ?>  
                    </ul>
                </div>      
                <div class="slider-shaddow"></div>             
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!--End Body Wrapper-->
<!--Start main Wrapper-->
<div class="main-content-container">
    <div class="container_24">
        <div class="grid_24">
            <div class="main-content"> 
                <div class="grid_sub_8 sub_alpha">
                    <div class="page-item first-item view view-ninth">
                        <?php if (bizway_get_option('bizway_firsthead') != '') { ?>
                            <h1><a href="<?php echo bizway_get_option('bizway_link1'); ?>"><?php echo stripslashes(bizway_get_option('bizway_firsthead')); ?></a></h1>
                        <?php } else { ?>
                            <h1><a href="#"><?php _e("Elegant &amp; Simple", "bizway"); ?></a></h1>
                        <?php } ?>
                        <?php if (bizway_get_option('bizway_featureimg1') != '') { ?>
                            <a href="<?php echo bizway_get_option('bizway_link1'); ?>"><img class="effect" src="<?php echo bizway_get_option('bizway_featureimg1'); ?>"/></a>
                            <div class="mask mask-1"></div>
                            <div class="mask mask-2"></div>
                        <?php } else { ?>
                            <a href="#"><img class="effect" src="<?php echo get_template_directory_uri(); ?>/images/img1.png" /></a>
                        <?php } ?> 
                        <?php if (bizway_get_option('bizway_firstdesc') != '') { ?>
                            <p><?php echo stripslashes(bizway_get_option('bizway_firstdesc')); ?></p>
                        <?php } else { ?>
                            <p><?php _e('Slider in the Header. It comes different Color Schemes red, green, blue, brown, pink, black, orange. Hello this design comes.', 'bizway'); ?></p>
                        <?php } ?> 
                    </div>
                </div>
                <div class="grid_sub_8 sub_middle">
                    <div class="page-item item-two view view-ninth">
                        <?php if (bizway_get_option('bizway_secondhead') != '') { ?>
                            <h1><a href="<?php echo bizway_get_option('bizway_link2'); ?>"><?php echo stripslashes(bizway_get_option('bizway_secondhead')); ?></a></h1>
                        <?php } else { ?>
                            <h1><a href="#"><?php _e('Beautiful &amp; Responsive', 'bizway'); ?></a></h1>
                        <?php } ?>
                        <?php if (bizway_get_option('bizway_featureimg2') != '') { ?>
                            <a href="<?php echo bizway_get_option('bizway_link2'); ?>"><img class="effect" src="<?php echo bizway_get_option('bizway_featureimg2'); ?>"/></a>
                        <?php } else { ?>
                            <a href="#"><img class="effect" src="<?php echo get_template_directory_uri(); ?>/images/img2.png" /></a>
                        <?php } ?> 
                        <?php if (bizway_get_option('bizway_seconddesc') != '') { ?>
                            <p><?php echo stripslashes(bizway_get_option('bizway_seconddesc')); ?></p>
                        <?php } else { ?>
                            <p><?php _e("Slider in the Header. It comes different Color Schemes red, green, blue, brown, pink, black, orange. Hello this design comes.", "bizway"); ?></p>
                        <?php } ?> 
                    </div>
                </div>
                <div class="grid_sub_8 sub_omega">
                    <div class="page-item last-item view view-ninth">
                        <?php if (bizway_get_option('bizway_thirdhead') != '') { ?>
                            <h1><a href="<?php echo bizway_get_option('bizway_link3'); ?>"><?php echo stripslashes(bizway_get_option('bizway_thirdhead')); ?></a></h1>
                        <?php } else { ?>
                            <h1><a href="#"><?php _e("Art &amp; Creativity", "bizway"); ?></a></h1>
                        <?php } ?>
                        <?php if (bizway_get_option('bizway_featureimg3') != '') { ?>
                            <a href="<?php echo bizway_get_option('bizway_link3'); ?>"><img class="effect" src="<?php echo bizway_get_option('bizway_featureimg3'); ?>"/></a>
                        <?php } else { ?>		

                            <a href="#"><img class="effect" src="<?php echo get_template_directory_uri(); ?>/images/img3.png" /></a>
                        <?php } ?> 
                        <?php if (bizway_get_option('bizway_thirddesc') != '') { ?>
                            <p><?php echo stripslashes(bizway_get_option('bizway_thirddesc')); ?></p>
                        <?php } else { ?>
                            <p><?php _e("Slider in the Header. It comes different Color Schemes red, green, blue, brown, pink, black, orange. Hello this design comes.", "bizway"); ?></p>
                        <?php } ?> 
                    </div>
                </div>
            </div>      
        </div>
        <div class="clear"></div>
    </div>
</div>
<!--End main Wrapper-->
<?php get_footer(); ?>
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title>
            <?php
            /*
             * Print the <title> tag based on what is being viewed.
             */
            wp_title('|', true, 'right');
            ?>
        </title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
        <?php
        wp_head();
        ?>
    </head>
    <body  <?php body_class(); ?> style="background:url(<?php if (inkthemes_get_option('inkthemes_bodybg') != '') { ?><?php echo inkthemes_get_option('inkthemes_bodybg'); ?><?php } else { ?>background:url('images/bodybg.png');<?php } ?>);" >
        <!--Start Container-->
        <div class="container_24">
            <!--Start Main-->
            <div class="grid_24 header_wrapper">
                <!--Start Header Div-->
                <div class="header">
                    <div class="logo">
                        <a title="<?php bloginfo('name'); ?>" href="<?php echo esc_url(home_url()); ?>">
                            <?php if (inkthemes_get_option('inkthemes_logo') != '') { ?>
                            <img alt="logo" src="<?php echo inkthemes_get_option('inkthemes_logo'); ?>"/>
                            <?php }else{ ?>
                                <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                                <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                            <?php } ?>
                        </a> 
                    </div>
                </div>
                <!--End Header Div-->
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        <!--Start Container-->
        <div class="container_24">
            <!--Start Main-->
            <div class="grid_24">
                <!--Start Menubar-->
                <!--Start Main_wrapper-->
                <div class="menu_wrapper">
                    <div class="menu_bar">
                        <div id="MainNav">
                            <!--Start menu-div-->
                            <?php inkthemes_nav(); ?>
                            <!--End menu-div-->
                        </div>
                    </div>
                    <!--End Menubar-->            
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="wrap">
            <div class="bg_line">
                <div class="container_24">
                    <div class="grid_24">
                        <div class="header_line"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="container_24">
            <!--Start Main-->
            <div class="grid_24 main">
                <!--Start Menubar-->
                <!--Start Main_wrapper-->
                <div class="main_wrapper">
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title> 
            <?php
            /*
             * Print the <title> tag based on what is being viewed.
             */
            wp_title();
            ?>
        </title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />       
        <?php
        /* Always have wp_head() just before the closing </head>
         * tag of your theme, or you will break many plugins, which
         * generally use this hook to add elements to <head> such
         * as styles, scripts, and meta tags.
         */
        wp_head();
        ?>      
    </head>
    <body <?php body_class(); ?> style="<?php if (inkthemes_get_option('inkthemes_bodybg') != '') { ?>background: fixed url(<?php echo inkthemes_get_option('inkthemes_bodybg'); ?>);<?php } else {
            ?> background: fixed url(<?php echo get_template_directory_uri(); ?>/images/bg.jpg); <?php } ?>" >
        <div class="main-container">
            <div class="container_24">
                <div class="grid_24">                    
                    <div class="clear"></div>
                    <div class="main-content">
                        <div class="social-links">                        
                        </div>
                        <div class="header">
                            <div class="grid_8 alpha">
                                <div class="logo"> 
                                    <?php if (inkthemes_get_option('inkthemes_logo') != '') { ?>
                                        <a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo inkthemes_get_option('inkthemes_logo'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
                                    <?php } else { ?>
                                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                        <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="grid_16 omega">
                                <!--Start Menu wrapper-->
                                <div class="menu_wrapper">
                                    <?php inkthemes_nav(); ?>
                                </div>
                                <!--End Menu-->
                            </div>
                        </div>
                        <div class="clear"></div>
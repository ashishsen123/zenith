<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title>
            <?php wp_title('&#124;', true, 'right'); ?>
        </title>       	
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />         
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> >
        <div class="wrapper">
            <div class="container_24">
                <div class="grid_24">
                    <div class="header">
                        <div class="grid_8 alpha">
                            <div class="logo">
                                <?php if (poloray_get_option('poloray_logo') != '') { ?>
                                    <a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo poloray_get_option('poloray_logo'); ?>" alt="<?php bloginfo('name'); ?>" alt="logo"/></a>
                                <?php } else { ?>
                                    <hgroup>
                                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                        <h3 class="site-description"><?php bloginfo('description'); ?></h3>
                                    </hgroup>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="grid_16 omega">
                            <div class="menu_container">
                                <div class="menu_bar">
                                    <div id="MainNav">
                                        <a href="#" class="mobile_nav closed"><?php _e('Pages Navigation Menu', 'poloray'); ?><span></span></a>
                                        <?php poloray_nav(); ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
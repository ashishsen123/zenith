<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>	
<meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/responsive.css"/>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<?php wp_get_archives('type=monthly&format=link'); ?>
</head>
<body <?php body_class();?>>
<div id="wrapper">
      <div id="header">
      	<a href="<?php bloginfo('url'); ?>">
			<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo( 'name' ); ?>" />
            </a>                               
            <div class="header-bot">
                  <?php wp_nav_menu(  array('theme_location' => 'social' , 'menu_class' => 'social',  'container' => false)); ?>
            </div>            
            	<div class="sidebar hide-large">
					<a href="#" id="pull">
						<?php _e('Menu','language');?>
					</a>
            <?php wp_nav_menu(  array('theme_location' => 'sidebar-nav' , 'menu_class' => 'sidebar-nav rounds',  'container' => false)); ?>
            </div>
      </div>
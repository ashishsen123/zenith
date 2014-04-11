<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
 	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 
	<title><?php ui::title(); ?></title>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

 	<link href='http://fonts.googleapis.com/css?family=Lato:900' rel='stylesheet' type='text/css'>

	<?php wp_head(); ?>
 	<?php if ( is_home() && option::get('featured_enable') == 'on' ) { ui::js("slides.min.jquery"); } ?>

</head>
 
<body <?php body_class() ?>>

	<div id="container">

		<div class="wrapper">

			<div id="header">

				<div id="logo">
					<?php if (!option::get('misc_logo_path')) { echo "<h1>"; } ?>

					<a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>">
						<?php if (!option::get('misc_logo_path')) { bloginfo('name'); } else { ?>
							<img src="<?php echo ui::logo(); ?>" alt="<?php bloginfo('name'); ?>" />
						<?php } ?>
					</a>

					<?php if (!option::get('misc_logo_path')) { echo "</h1>"; } ?>

				</div><!-- / #logo -->

				<div id="menu" class="dropdown">
					<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => 'dropdown', 'menu_id' => 'nav', 'sort_column' => 'menu_order', 'theme_location' => 'primary' ) ); ?>
				</div>

				<div class="cleaner">&nbsp;</div>

			</div><!-- end #header -->

		</div><!-- end .wrapper -->
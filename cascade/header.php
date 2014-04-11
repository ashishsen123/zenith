<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it 
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the 
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins. 
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Justin Tadlock
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/cascade
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title><?php hybrid_document_title(); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); // wp_head ?>
</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); // cascade_open_body ?>
	
	<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
	
	<?php do_atomic( 'after_menu_primary' ); // cascade_before_header ?>

	<div id="container"><div class="container-wrap">

		<?php do_atomic( 'before_header' ); // cascade_before_header ?>

		<div id="header">

			<?php do_atomic( 'open_header' ); // cascade_open_header ?>

			<div class="header-wrap">

				<div id="branding">

					<?php if ( hybrid_get_setting( 'cascade_logo_url' ) ) : ?>	

						<h1 id="site-title">
							<a href="<?php echo home_url(); ?>/" title="<?php echo bloginfo( 'name' ); ?>" rel="Home">
								<img class="logo" src="<?php echo hybrid_get_setting( 'cascade_logo_url' ); ?>" alt="<?php echo bloginfo( 'name' ); ?>" />
							</a>
						</h1>

					<?php else : ?>

						<h1 id="site-title"><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

					<?php endif; ?>
					
					<?php hybrid_site_description(); ?>

				</div><!-- #branding -->
				
				<?php
					if ( current_theme_supports( 'theme-layouts' ) ) {

						$cascade_layout = theme_layouts_get_layout();
							
						if ( $cascade_layout == 'layout-hl-1c' || $cascade_layout == 'layout-hl-2c-l' || $cascade_layout == 'layout-hl-2c-r' || $cascade_layout == 'layout-hr-1c' || $cascade_layout == 'layout-hr-2c-l' || $cascade_layout == 'layout-hr-2c-r' ) {

							get_template_part( 'menu', 'header-primary' ); // Loads the menu-header-primary.php template.
							
						}
					
					}
				?>
				
				<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>

				<?php do_atomic( 'header' ); // cascade_header ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_header' ); // cascade_close_header ?>

		</div><!-- #header -->

		<?php do_atomic( 'after_header' ); // cascade_after_header ?>
		
		<?php
			if ( current_theme_supports( 'theme-layouts' ) ) {

				$cascade_layout = theme_layouts_get_layout();
							
				if ( $cascade_layout == 'layout-default' || $cascade_layout == 'layout-1c' || $cascade_layout == 'layout-2c-l' || $cascade_layout == 'layout-2c-r' || $cascade_layout == 'layout-3c-c' || $cascade_layout == 'layout-3c-l' || $cascade_layout == 'layout-3c-r' ) {

					get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template.
							
				}

			}
		?>

		<?php do_atomic( 'before_main' ); // cascade_before_main ?>

		<div id="main">

			<div class="wrap">

			<?php do_atomic( 'open_main' ); // cascade_open_main ?>
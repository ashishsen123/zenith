<?php
/***
 * Setup Theme Options
 *
 * Includes all settings from the /includes/options/settings/ folder
 * (setting arrays are splitted in multiple files for reasons of clarity)
 *
 * Defines the theme options array containing all tabs, sections and settings.
 * Contain functions to display the welcome screen and sidebar content on options screen.
 *
 */

// Include all Setting Files
require( get_template_directory() . '/includes/options/settings/settings-general.php' );
require( get_template_directory() . '/includes/options/settings/settings-colors.php' );
require( get_template_directory() . '/includes/options/settings/settings-frontpage.php' );


// Creates theme options array with all sections and settings
function themezee_options_array() {

	/* Section and Setting functions come from setting files included above */
	
	$theme_options = array();
	
	$theme_options['general'] = array(
			"name" => __('General', 'zeeTasty_lang'),
			"sections" => themezee_sections_general(),
			"settings" => themezee_settings_general());
	
	$theme_options['colors'] = array(
			"name" => __('Colors', 'zeeTasty_lang'),
			"sections" => themezee_sections_colors(),
			"settings" => themezee_settings_colors());
			
	$theme_options['frontpage'] = array(
			"name" => __('Front Page', 'zeeTasty_lang'),
			"sections" => themezee_sections_frontpage(),
			"settings" => themezee_settings_frontpage());
	
	return $theme_options;
}
	

// Display Sidebar
function themezee_options_sidebar() {
	$theme_data = wp_get_theme();
?>
	<div class="zee_options_sidebar">
	
		<dl><dt><h4><?php _e('Theme Data', 'zeeTasty_lang'); ?></h4></dt>
			<dd>
				<p><?php _e('Name', 'zeeTasty_lang'); ?>: <?php echo $theme_data->Name; ?><br/>
				<?php _e('Version', 'zeeTasty_lang'); ?>: <b><?php echo $theme_data->Version; ?></b>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php _e('(Changelog)', 'zeeTasty_lang'); ?></a><br/>
				<?php _e('Author', 'zeeTasty_lang'); ?>: <a href="http://themezee.com/" target="_blank">ThemeZee</a><br/>
				</p>
			</dd>
		</dl>
		
		<dl><dt><h4><?php _e('Upgrade', 'zeeTasty_lang'); ?> <?php echo $theme_data->Name; ?></h4></dt>
			<dd>
				<ul>
					<li><a href="http://themezee.com/themes/zeetasty/#PROVersion-1" target="_blank"><?php _e('Check out the PRO Version', 'zeeTasty_lang'); ?></a></li>
					<li><a href="http://themezee.com/join-the-theme-club/" target="_blank"><?php _e('Join the Theme Club and get Support', 'zeeTasty_lang'); ?></a></li>
				</ul>
			</dd>
		</dl>
		
		<dl><dt><h4><?php _e('Help to translate', 'zeeTasty_lang'); ?> </h4></dt>
			<dd>
				<p><?php _e('You want to use this WordPress theme in your native language? Then help out to translate it!', 'zeeTasty_lang'); ?></p>
				<ul>
					<li><a href="http://translate.themezee.org/projects/zeetasty" target="_blank"><?php _e('Join the Online Translation Project', 'zeeTasty_lang'); ?></a></li>
				</ul>
			</dd>
		</dl>
		
		<dl><dt><h4><?php _e('About ThemeZee', 'zeeTasty_lang'); ?></h4></dt>
			<dd>
				<p><?php _e('ThemeZee provides several stunning <b>Freemium WordPress Themes</b>.', 'zeeTasty_lang'); ?></p>
				<p><?php _e('That means you can download and use every theme <b>for FREE</b>, and only pay to get more features, better theme tutorials and advanced theme support!', 'zeeTasty_lang'); ?></p>
				<p><a href="http://themezee.com/" target="_blank"><?php _e('Visit ThemeZee.com now', 'zeeTasty_lang'); ?></a></p>
			</dd>
		</dl>
				
		<dl><dt><h4><?php _e('Subscribe Now', 'zeeTasty_lang'); ?></h4></dt>
			<dd>
				<p><?php _e('Subscribe now and get informed about each <b>Theme Release</b> from ThemeZee.', 'zeeTasty_lang'); ?></p>
				<ul class="subscribe">
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/rss.png"/><a href="http://themezee.com/feed/" target="_blank"><?php _e('RSS Feed', 'zeeTasty_lang'); ?></a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/email.png"/><a href="http://feedburner.google.com/fb/a/mailverify?uri=Themezee" target="_blank"><?php _e('Email Subscription', 'zeeTasty_lang'); ?></a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/twitter.png"/><a href="http://twitter.com/ThemeZee" target="_blank"><?php _e('Follow me on Twitter', 'zeeTasty_lang'); ?></a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/facebook.png"/><a href="http://www.facebook.com/ThemeZee" target="_blank"><?php _e('Become a Facebook Fan', 'zeeTasty_lang'); ?></a></li>
				</ul>
			</dd>
		</dl>
	</div>
	<div class="clear"></div>
<?php
}


// Display Welcome Page
function themezee_options_welcome_page() { 
	$theme_data = wp_get_theme();
	$pro_url = 'http://themezee.com/themes/zeetasty/';
	$club_url = 'http://themezee.com/join-the-theme-club/';
?>
	<div id="zee_welcome">
		<h3><?php _e('Thank you for installing this theme!', 'zeeTasty_lang'); ?></h3>
		<div class="container">
			<h1><?php _e('Welcome to', 'zeeTasty_lang'); ?> <?php echo $theme_data->Name; ?></h1>
			<div class="zee_intro">
				<?php _e("First of all, the theme options might alarm you, <b>but don't panic</b>. Everything is organized and documented well enough for you.", 'zeeTasty_lang'); ?>
			</div>
		</div>
		<div class="welcome_halfed">
			<div class="welcome_left">
				<h3><?php _e('Want more features?', 'zeeTasty_lang'); ?></h3>
				<div class="container">
					<h2><?php _e('Check out', 'zeeTasty_lang'); ?> <?php echo $theme_data->Name; ?>Pro</h2>
					<p><?php _e('The <b>PRO Version</b> provide additional features to <b>customize</b> and configure your Theme.', 'zeeTasty_lang'); ?></p>
					<p><h4><?php _e('Some Pro Features:', 'zeeTasty_lang'); ?></h4>
						<ul>
							<li><?php _e('+ Custom Color Management', 'zeeTasty_lang'); ?></li>
							<li><?php _e('+ Image Slideshow on frontpage', 'zeeTasty_lang'); ?></li>
							<li><?php _e('+ several Pro Widgets', 'zeeTasty_lang'); ?></li>
							<li><?php _e('+ unlimited Font Manager', 'zeeTasty_lang'); ?></li>
							<li><?php _e('+ Header Content feature', 'zeeTasty_lang'); ?></li>
							<li><?php _e('+ and a lot more..', 'zeeTasty_lang'); ?></li>
						</ul>
						<a class="welcome_button" href="<?php echo $pro_url; ?>#PROVersion-1" target="_blank"><?php _e('Learn more about the PRO Version', 'zeeTasty_lang'); ?></a>
					</p>
				</div>
			</div>
			<div class="welcome_right">
				<h3><?php _e('Need support?', 'zeeTasty_lang'); ?></h3>
				<div class="container">
					<h2><?php _e('Join the Theme Club', 'zeeTasty_lang'); ?></h2>
					<p><?php _e('You want <b>top-notch Support</b> for installing and configuring your Theme? Become a <b>Member</b>!', 'zeeTasty_lang'); ?></p>
					<p><h4><?php _e('Theme Club Features:', 'zeeTasty_lang'); ?></h4>
						<ul>
							<li><?php _e('+ access to the Support Forum at ThemeZee.com', 'zeeTasty_lang'); ?></li>
							<li><?php _e('+ download all Pro Themes', 'zeeTasty_lang'); ?></li>
							<li><?php _e('+ advanced online Theme Documentation', 'zeeTasty_lang'); ?></li>
							<li><?php _e('+ fast and helpful answers to all your questions', 'zeeTasty_lang'); ?></li>
						</ul>
						<a class="welcome_button" href="<?php echo $club_url; ?>" target="_blank"><?php _e('Learn more about the Theme Club', 'zeeTasty_lang'); ?></a>
					</p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		
		<h3><?php _e('Not happy with', 'zeeTasty_lang'); ?> <?php echo $theme_data->Name; ?>?</h3>
		<div class="container">
		<p><?php _e('ThemeZee.com provide several other <b>free WordPress Themes</b>.', 'zeeTasty_lang'); ?>
		<a href="http://themezee.com/themes/" target="_blank"><?php _e('Click here to browse through all of my themes.', 'zeeTasty_lang'); ?></a>
		</p>
		</div>
	</div>
<?php
}
?>
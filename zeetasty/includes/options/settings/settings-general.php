<?php
	
	function themezee_sections_general() {
		$themezee_sections = array();
		
		$themezee_sections[] = array("id" => "themeZee_general_header",
					"name" => __('Header Settings', 'zeeTasty_lang'));
					
		$themezee_sections[] = array("id" => "themeZee_general_layout",
					"name" => __('Layout Settings', 'zeeTasty_lang'));
					
		$themezee_sections[] = array("id" => "themeZee_general_css_section",
					"name" => __('Custom CSS Code', 'zeeTasty_lang'));
					
		return $themezee_sections;
	}
	
	function themezee_settings_general() {

		$themezee_settings = array();
	
		### HEADER SETTINGS
		#######################################################################################
		$themezee_settings[] = array("name" => __('Logo Image', 'zeeTasty_lang'),
						"desc" => __('Paste the full Image URL of your logo or click Upload Image. Leave this field blank to display the site title instead of a logo image.', 'zeeTasty_lang'),
						"id" => "themeZee_general_logo",
						"std" => "",
						"type" => "image",
						"section" => "themeZee_general_header");

		$themezee_settings[] = array("name" => __('Show Tagline?', 'zeeTasty_lang'),
						"desc" => __('Check this if you want to show your tagline(blog description) below the logo', 'zeeTasty_lang'),
						"id" => "themeZee_general_tagline",
						"std" => "true",
						"type" => "checkbox",
						"section" => "themeZee_general_header");
						
		### LAYOUT SETTINGS
		#######################################################################################				
		$themezee_settings[] = array("name" => __('Sidebar Options', 'zeeTasty_lang'),
						"desc" => "",
						"id" => "themeZee_general_sidebars",
						"std" => 'right',
						"type" => "radio",
						'choices' => array(
									'left' => __('Left Sidebar', 'zeeTasty_lang'),
									'right' => __('Right Sidebar', 'zeeTasty_lang')),
						"section" => "themeZee_general_layout"
						);
						
		$themezee_settings[] = array("name" => __('Footer Content', 'zeeTasty_lang'),
						"desc" => __('Enter the content which is displayed in the footer here.', 'zeeTasty_lang'),
						"id" => "themeZee_general_footer",
						"std" => "Place your Footer Content here",
						"type" => "html",
						"section" => "themeZee_general_layout");
						
		### CUSTOM CSS
		#######################################################################################					
		$themezee_settings[] = array("name" => __('Custom CSS', 'zeeTasty_lang'),
						"desc" => __('Place your Custom CSS code here.', 'zeeTasty_lang'),
						"id" => "themeZee_general_css",
						"std" => "",
						"type" => "textarea",
						"section" => "themeZee_general_css_section");
										
		return $themezee_settings;
	}

?>
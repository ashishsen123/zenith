<?php
	
	function themezee_sections_frontpage() {
		$themezee_sections = array();
		
		$themezee_sections[] = array("id" => "themeZee_frontpage_template",
					"name" => __('Activate Frontpage Template', 'zeeTasty_lang'));
					
		$themezee_sections[] = array("id" => "themeZee_frontpage_image",
					"name" => __('Frontpage Image', 'zeeTasty_lang'));
					
		$themezee_sections[] = array("id" => "themeZee_frontpage_intro",
					"name" => __('Frontpage Intro', 'zeeTasty_lang'));
					
		$themezee_sections[] = array("id" => "themeZee_frontpage_widgets",
					"name" => __('Frontpage Widgets', 'zeeTasty_lang'));

		return $themezee_sections;
	}
	
	function themezee_settings_frontpage() {
	
		
		### FRONTPAGE Template
		#######################################################################################
		$themezee_settings[] = array("name" => __('Turn on Frontpage Template?', 'zeeTasty_lang'),
						"desc" => __('Check this to automatically display the frontpage template on HOME page.', 'zeeTasty_lang'),
						"id" => "themeZee_frontpage_activate",
						"std" => "false",
						"type" => "checkbox",
						"section" => "themeZee_frontpage_template");
		
		### FRONTPAGE Image
		#######################################################################################
		$themezee_settings[] = array("name" => __('Frontpage Image Source', 'zeeTasty_lang'),
						"desc" => __('Choose which image(s) the frontpage template should display.', 'zeeTasty_lang'),
						"id" => "themeZee_frontpage_image_source",
						"std" => "header",
						"type" => "radio",
						'choices' => array(
									'header' => __('Custom Header Image (from Appearance > Header)', 'zeeTasty_lang'),
									'upload' => __('Individual Image uploaded below', 'zeeTasty_lang')),
						"section" => "themeZee_frontpage_image"
						);
		
		$themezee_settings[] = array("name" => __('Frontpage Image', 'zeeTasty_lang'),
						"desc" => __('Upload an individual frontpage image here. You have to select "Individual Image" above to display it. Image should be 1140x400 pixels.', 'zeeTasty_lang'),
						"id" => "themeZee_frontpage_image_upload",
						"std" => "",
						"type" => "image",
						"section" => "themeZee_frontpage_image");
								
		### FRONTPAGE INTRO
		#######################################################################################			
		$themezee_settings[] = array("name" => __('Frontpage Intro', 'zeeTasty_lang'),
						"desc" => __('Enter here the Text of the Frontpage Intro.', 'zeeTasty_lang'),
						"id" => "themeZee_frontpage_intro_text",
						"std" => "Welcome to the zeeTasty WordPress theme. You can change this intro text in the theme options.",
						"type" => "html",
						"section" => "themeZee_frontpage_intro");
						
		$themezee_settings[] = array("name" => __('Frontpage Intro Button Text', 'zeeTasty_lang'),
						"desc" => __('Enter here the Text of the Frontpage Intro Button. Leave blank to hide to hide the button.', 'zeeTasty_lang'),
						"id" => "themeZee_frontpage_button_text",
						"std" => "Call to Action",
						"type" => "text",
						"section" => "themeZee_frontpage_intro");

		$themezee_settings[] = array("name" => __('Frontpage Intro Button Destination', 'zeeTasty_lang'),
						"desc" => __('Enter here the URL to which the Frontpage Intro Button should point to.', 'zeeTasty_lang'),
						"id" => "themeZee_frontpage_button_destination",
						"std" => "#",
						"type" => "text",
						"section" => "themeZee_frontpage_intro");

		### FRONTPAGE WIDGETS
		#######################################################################################		
		$themezee_settings[] = array("name" => __('About Frontpage Widgets', 'zeeTasty_lang'),
						"desc" => __('Please note: You can configure your widgets to be displayed on the frontpage template on <b>Appearance > Widgets</b>.', 'zeeTasty_lang'),
						"id" => "themeZee_frontpage_widgets_info",
						"type" => "info",
						"std" => '',
						"section" => "themeZee_frontpage_widgets");
		
		return $themezee_settings;
	}

?>
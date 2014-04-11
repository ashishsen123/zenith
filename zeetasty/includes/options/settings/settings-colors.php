<?php
	
	function themezee_sections_colors() {
		$themezee_sections = array();
		
		$themezee_sections[] = array("id" => "themeZee_colors_schemes",
					"name" => __('Predefined Color Schemes', 'zeeTasty_lang'));
		
		return $themezee_sections;
	}
	
	function themezee_settings_colors() {
	
		$color_schemes = array(
			'#151515' => __('Black', 'zeeTasty_lang'),
			'#1562a5' => __('Blue', 'zeeTasty_lang'),
			'#725639' => __('Brown', 'zeeTasty_lang'),
			'#2d912e' => __('Green', 'zeeTasty_lang'),
			'#e34c00' => __('Orange', 'zeeTasty_lang'),
			'#9215a5' => __('Purple', 'zeeTasty_lang'),
			'default' => __('Standard', 'zeeTasty_lang'));
		
		$themezee_settings = array();
	
		### COLOR SETTINGS
		#######################################################################################
							
		$themezee_settings[] = array("name" => __('Set Color Scheme', 'zeeTasty_lang'),
						"desc" => __('Please select your color scheme here.', 'zeeTasty_lang'),
						"id" => "themeZee_color_scheme",
						"std" => "default",
						"type" => "select",
						'choices' => $color_schemes,
						"section" => "themeZee_colors_schemes"
						);
		
		return $themezee_settings;
	}

?>
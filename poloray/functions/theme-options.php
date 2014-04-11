<?php
add_action('init', 'poloray_options');
if (!function_exists('poloray_options')) {
    function poloray_options() {
        // VARIABLES
        $themename = 'Poloray Theme';
        $shortname = "of";
        // Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = poloray_get_option('of_options');
        //Front page on/off
        $file_rename = array("on" => "On", "off" => "Off");
        // Background Defaults
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
        // Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }
        // Populate OptionsFramework option in array for use in theme
        $contact_option = array("on" => "On", "off" => "Off");
        // Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }
        // If using image radio buttons, define a directory path
        $imagepath = get_template_directory_uri() . '/images/';
        $options = array(
        array("name" => "General Settings",
            "type" => "heading"),
			
        array("name" => "Custom Logo",
            "desc" => "Choose your own logo. Optimal Size: 300px Wide by 90px Height.",
            "id" => "poloray_logo",
            "type" => "upload"),

        array("name" => "Custom Favicon",
            "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
            "id" => "poloray_favicon",
            "type" => "upload"),

        array("name" => "Front Page On/Off",
            "desc" => "Check on for enabling front page or check off for enabling blog page in front page",
            "id" => "re_nm",
            "std" => "on",
            "type" => "radio",
            "options" => $file_rename),
			
        array("name" => "Top Feature Settings",
        "type" => "heading"),

        array("name" => "Top Feature Heading",
		"desc" => "Enter your text for Top Feature.",
		"id" => "poloray_slider_heading",
		"std" => "",
		"type" => "textarea"),

       array("name" => "Top Feature Description",
            "desc" => "Enter your text for Top Feature Description.",
            "id" => "poloray_slider_description",
            "std" => "",
            "type" => "textarea"),

       array("name" => "Top Feature Image",
            "desc" => "Choose your image or video. Optimal size is 422px wide and height 224px",
            "id" => "poloray_slideimage1",
            "std" => "",
            "type" => "upload"),

	   array("name" => "Top Feature  Link",
            "desc" => "Enter your text for Top Feature  Link.",
            "id" => "poloray_slider_link",
            "std" => "",
            "type" => "text"),

    //Home Page Feature Setting
       array("name" => "Home Page Feature Settings",
            "type" => "heading"),
			
	   array("name" => "Home Page Tagline",
            "desc" => "Enter your text for home page tagline",
            "id" => "poloray_mainheading",
            "std" => "",
            "type" => "textarea"),
			
	  array("name" => "Home Page Button Text",
            "desc" => "Enter your text for home page button",
            "id" => "poloray_homepage_button",
            "std" => "",
            "type" => "text"),
			
	 array("name" => "Home Page Button Link",
            "desc" => "Enter your text for home page button link",
            "id" => "poloray_homepage_button_link",
            "std" => "",
            "type" => "text"),
			
	 array("name" => "Home Page Feature Section Starts From Here.",
            "type" => "saperate",
            "class" => "saperator"),
	
	 array("name" => "First Feature Image",
            "desc" => "Choose image for your first Feature area. Optimal size 170px x 170px",
            "id" => "poloray_wimg1",
            "std" => "",
            "type" => "upload"),
			
     array("name" => "First Feature Heading",
            "desc" => "Enter your text for first col heading.",
            "id" => "poloray_firsthead",
            "std" => "",
            "type" => "textarea"),
			
      array("name" => "First Feature Description",
            "desc" => "Enter your text for first col description.",
            "id" => "poloray_firstdesc",
            "std" => "",
            "type" => "textarea"),
			
      array("name" => "First feature Link",
            "desc" => "Enter your text for First feature Link.",
            "id" => "poloray_feature_link1",
            "std" => "",
            "type" => "text"),
			
	 array("name" => "Second Feature Starts From Here.",
            "type" => "saperate",
            "class" => "saperator"),

        //Second Feature Separetor
     array("name" => "Second Feature Image",
            "desc" => "Choose image for your second Feature area. Optimal size 170px x 170px",
            "id" => "poloray_fimg2",
            "std" => "",
            "type" => "upload"),
			
     array("name" => "Second Feature Heading",
            "desc" => "Enter your heading for second Feature area",
            "id" => "poloray_headline2",
            "std" => "",
            "type" => "textarea"),
       
     array("name" => "Second Col Description",
            "desc" => "Enter your text for second col description.",
            "id" => "poloray_seconddesc",
            "std" => "",
            "type" => "textarea"),
			
     array("name" => "Second feature Link",
            "desc" => "Enter your text for Second feature Link.",
            "id" => "poloray_feature_link2",
            "std" => "",
            "type" => "text"),
		
	array("name" => "Third Feature Starts From Here.",
            "type" => "saperate",
            "class" => "saperator"),
		
        //Third Feature Separetor
		 
	array("name" => "Third Feature Image",
            "desc" => "Choose image for your thrid Feature. Optimal size 170px x 170px",
            "id" => "poloray_fimg3",
            "std" => "",
            "type" => "upload"),
			
	array("name" => "Third Feature Heading",
            "desc" => "Enter your heading for third Feature area",
            "id" => "poloray_headline3",
            "std" => "",
            "type" => "textarea"),
        
     array("name" => "Third Feature Description",
            "desc" => "Enter your text for Third Feature description.",
            "id" => "poloray_thirddesc",
            "std" => "",
            "type" => "textarea"),
			
     array("name" => "Third feature Link",
            "desc" => "Enter your text for Second feature Link.",
            "id" => "poloray_feature_link3",
            "std" => "",
            "type" => "text"),
			
	array("name" => "Fourth Feature Starts From Here.",
            "type" => "saperate",
            "class" => "saperator"),
			
		//Fourth Feature Separetor
		
	array("name" => "Fourth Feature Image",
            "desc" => "Choose image for your Fourth Feature. Optimal size 170px x 170px",
            "id" => "poloray_fimg4",
            "std" => "",
            "type" => "upload"),
			
	array("name" => "Fourth Feature Heading",
            "desc" => "Enter your heading for Fourth Feature area",
            "id" => "poloray_headline4",
            "std" => "",
            "type" => "textarea"),
			
    array("name" => "Fourth Feature Description",
            "desc" => "Enter your text for Fourth Feature description.",
            "id" => "poloray_fourthdesc",
            "std" => "",
            "type" => "textarea"),
			
    array("name" => "Fourth feature Link",
            "desc" => "Enter your text for Fourth feature Link.",
            "id" => "poloray_feature_link4",
            "std" => "",
            "type" => "text"),

//****=============================================================================****//
//****-----------This code is used for creating color styleshteet options----------****//							
//****=============================================================================****//				
     array("name" => "Styling Options",
            "type" => "heading"),
			
     array("name" => "Custom CSS",
            "desc" => "Quickly add some CSS to your theme by adding it to this block.",
            "id" => "poloray_customcss",
            "std" => "",
            "type" => "textarea"),

//****=============================================================================****//
//****-------------This code is used for creating social logos options-------------****//					
//****=============================================================================****//

       array("name" => "Social Logos",
            "type" => "heading"),
			
	   array("name" => "Facebook URL",
            "desc" => "Enter your Facebook URL if you have one",
            "id" => "poloray_facebook",
            "std" => "#",
            "type" => "text"),
			
       array("name" => "Twitter URL",
            "desc" => "Enter your Twitter URL if you have one",
            "id" => "poloray_twitter",
            "std" => "#",
            "type" => "text"),  
			
	   array("name" => "Yahoo URL",
            "desc" => "Enter your Yahoo Feed URL if you have one",
            "id" => "poloray_yahoo",
            "std" => "#",
            "type" => "text"),

       array("name" => "Rss URL",
            "desc" => "Enter your Rss URL if you have one",
            "id" => "poloray_rss",
            "std" => "#",
            "type" => "text"),

       array("name" => "Digg URL",
            "desc" => "Enter your Digg URL if you have one",
            "id" => "poloray_digg",
            "std" => "#",
            "type" => "text"),

       array("name" => "Pinterest URL",
            "desc" => "Enter your Pinterest Feed URL if you have one",
            "id" => "poloray_pinterest",
            "std" => "#",
            "type" => "text"));    

        poloray_update_option('of_template', $options);
        poloray_update_option('of_themename', $themename);
        poloray_update_option('of_shortname', $shortname);
    }

}
?>

<?php

add_action('init', 'bizway_options');
if (!function_exists('bizway_options')) {

    function bizway_options() {
        // VARIABLES
        $themename = wp_get_theme();
        $themename = $themename['Name'];
        $shortname = "of";
        // Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = bizway_get_option('of_options');
        // Background Defaults
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
        //Front page on/off
        $file_rename = array("on" => "On", "off" => "Off");
        //Stylesheet Reader
        $alt_stylesheets = array("default" => "default", "blue" => "blue", "coffee" => "coffee", "green" => "green", "brown" => "brown", "pink" => "pink", "orange" => "orange", "purple" => "purple", "red" => "red", "forrest-green" => "forrest-green", "yellow" => "yellow");
        // Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }

        // Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }

        // If using image radio buttons, define a directory path
        $imagepath = get_stylesheet_directory_uri() . '/images/';

        $options = array(
            array("name" => __("General Settings", 'bizway'),
                "type" => "heading"),
            array("name" => "Custom Logo",
                "desc" => __("Choose your own logo. Optimal Size: 300px Wide by 90px Height.", 'bizway'),
                "id" => "bizway_logo",
                "type" => "upload"),
            array("name" => __("Custom Favicon", 'bizway'),
                "desc" => __("Specify a 16px x 16px image that will represent your website's favicon.", 'bizway'),
                "id" => "bizway_favicon",
                "type" => "upload"),
            array("name" => __("Tracking Code", 'bizway'),
                "desc" => __("Paste your Google Analytics (or other) tracking code here.", 'bizway'),
                "id" => "bizway_analytics",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Front Page On/Off",
                "desc" => "If the front page option is active then home page will appear otherwise blog page will display.",
                "id" => "re_nm",
                "std" => "on",
                "type" => "radio",
                "options" => $file_rename),
            //Home page heading
            array("name" => __("Homepage Settings", 'bizway'),
                "type" => "heading"),
            //First Heading
            array("name" => __("First Heading", 'bizway'),
                "desc" => __("Enter your text for first heading.", 'bizway'),
                "id" => "bizway_first_head",
                "std" => "",
                "type" => "textarea"),
            //Second Heading
            array("name" => __("Second Heading", 'bizway'),
                "desc" => __("Enter your text for second heading.", 'bizway'),
                "id" => "bizway_second_head",
                "std" => "",
                "type" => "textarea"),
            //Home Page Slider Setting
            array("name" => __("Slider Settings", 'bizway'),
                "type" => "heading"),
            //First Slider
            array("name" => __("Slider Image1", 'bizway'),
                "desc" => __("Choose your image for first slider. Optimal size is 950px wide and 350px height.", 'bizway'),
                "id" => "bizway_slideimage1",
                "std" => "",
                "type" => "upload"),
            array("name" => __("Slide 1 Link", 'bizway'),
                "desc" => "Enter your link url for slide1",
                "id" => "bizway_slidelink1",
                "std" => "",
                "type" => "text"),
            //Second Slider
            array("name" => __("Slider Image2", 'bizway'),
                "desc" => __("Choose your image for second slider. Optimal size is 950px wide and 350px height.", 'bizway'),
                "id" => "bizway_slideimage2",
                "std" => "",
                "type" => "upload"),
            array("name" => __("Slide 2 Link", 'bizway'),
                "desc" => __("Enter your link url for slide2", 'bizway'),
                "id" => "bizway_slidelink2",
                "std" => "",
                "type" => "text"),
//Homepage Feature Area
            array("name" => __("Homepage Feature Area", 'bizway'),
                "type" => "heading"),
            //Right Feature Area
            array("name" => __("Homepage Feature Area First Image", 'bizway'),
                "desc" => __("Choose your image for homepage feature area first image.", 'bizway'),
                "id" => "bizway_featureimg1",
                "std" => "",
                "type" => "upload"),
            array("name" => __("First Feature Heading", 'bizway'),
                "desc" => __("Enter your text for first col heading.", 'bizway'),
                "id" => "bizway_firsthead",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("First Feature Description", 'bizway'),
                "desc" => __("Enter your text for first col description.", 'bizway'),
                "id" => "bizway_firstdesc",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("First Feature Link URL", 'bizway'),
                "desc" => __("Enter your link url for fourth feature section.", 'bizway'),
                "id" => "bizway_link1",
                "std" => "",
                "type" => "text"),
            //Second Feature Separetor
            array("name" => __("Second Feature Starts From Here.", 'bizway'),
                "type" => "saperate",
                "class" => "saperator"),
            array("name" => __("Homepage Feature Area Second Image", 'bizway'),
                "desc" => __("Choose your image for homepage Feature area second image.", 'bizway'),
                "id" => "bizway_featureimg2",
                "std" => "",
                "type" => "upload"),
            array("name" => __("Second Feature Heading", 'bizway'),
                "desc" => __("Enter your text for second col heading.", 'bizway'),
                "id" => "bizway_secondhead",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Second Col Description", 'bizway'),
                "desc" => __("Enter your text for second col description.", 'bizway'),
                "id" => "bizway_seconddesc",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Second Feature Link URL", 'bizway'),
                "desc" => __("Enter your link url for fourth feature section.", 'bizway'),
                "id" => "bizway_link2",
                "std" => "",
                "type" => "text"),
            //Third Feature Separetor
            array("name" => __("Third Feature Starts From Here.", 'bizway'),
                "type" => "saperate",
                "class" => "saperator"),
            array("name" => __("Homepage Third Feature  Image", 'bizway'),
                "desc" => __("Choose your image for homepage Feature area third image.", 'bizway'),
                "id" => "bizway_featureimg3",
                "std" => "",
                "type" => "upload"),
            array("name" => __("Third Feature Heading", 'bizway'),
                "desc" => __("Enter your text for second col heading.", 'bizway'),
                "id" => "bizway_thirdhead",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Third Feature Description", 'bizway'),
                "desc" => __("Enter your text for Third Feature description.", 'bizway'),
                "id" => "bizway_thirddesc",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Third Feature Link URL", 'bizway'),
                "desc" => __("Enter your link url for fourth feature section.", 'bizway'),
                "id" => "bizway_link3",
                "std" => "",
                "type" => "text"),
//****=============================================================================****//
//****-----------This code is used for creating color styleshteet options----------****//							
//****=============================================================================****//				
            array("name" => __("Styling Options", 'bizway'),
                "type" => "heading"),
            array("name" => __("Custom CSS", 'bizway'),
                "desc" => __("Quickly add some CSS to your theme by adding it to this block.", 'bizway'),
                "id" => "bizway_customcss",
                "std" => "",
                "type" => "textarea"));

        bizway_update_option('of_template', $options);
        bizway_update_option('of_themename', $themename);
        bizway_update_option('of_shortname', $shortname);
    }

}
<?php

add_action('init', 'of_options');
if (!function_exists('of_options')) {

    function of_options() {
// VARIABLES
        $themename = function_exists('wp_get_theme') ? wp_get_theme() : get_current_theme();
        $themename = $themename['Name'];
        $shortname = "of";
// Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = get_option('of_options');
        //Front page on/off
        $file_rename = array("on" => "On", "off" => "Off");
//Stylesheet Reader
        $alt_stylesheets = array("green" => "green", "blue" => "blue", "pink" => "pink");
// Test data
        $test_array = array("one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");
// Multicheck Array
        $multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
// Multicheck Defaults
        $multicheck_defaults = array("one" => "1", "five" => "1");
// Background Defaults
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
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
            array("name" => "General Settings",
                "type" => "heading"),
            array("name" => "Custom Logo",
                "desc" => "Choose your own logo. Optimal Size: 170px Wide by 30px Height",
                "id" => "inkthemes_logo",
                "type" => "upload"),
            array("name" => "Custom Favicon",
                "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
                "id" => "inkthemes_favicon",
                "type" => "upload"),
            array("name" => "Body Background Image",
                "desc" => "Select image to change your website background",
                "id" => "inkthemes_bodybg",
                "std" => "",
                "type" => "upload"),
            array("name" => "Front Page On/Off",
                "desc" => "If the front page option is active then home page will appear otherwise blog page will display.",
                "id" => "re_nm",
                "std" => "on",
                "type" => "radio",
                "options" => $file_rename),
//****=============================================================================****//
//****-----------This code is used for creating slider settings--------------------****//							
//****=============================================================================****//						
            array("name" => "Home Top Section",
                "type" => "heading"),
            array("name" => "Top Section Image",
                "desc" => "Choose Image for your Top Section. Optimal Size: 450px x 350px",
                "id" => "inkthemes_slideimage1",
                "type" => "upload"),
            array("name" => "Top Section Heading",
                "desc" => "Enter the Heading for Top Section",
                "id" => "inkthemes_slideheading1",
                "std" => "",
                "type" => "text"),
            array("name" => "Top Section Description",
                "desc" => "Description for Top Section",
                "id" => "inkthemes_slidedescription1",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Top Section Button Text",
                "desc" => "Enter the text for the button",
                "id" => "inkthemes_slidebuttontext1",
                "std" => "",
                "type" => "text"),
            array("name" => "Top Section Button Link",
                "desc" => "Enter the Link URL for button in Top Section",
                "id" => "inkthemes_slidelink1",
                "std" => "",
                "type" => "text"),
//****=============================================================================****//
//****-----------This code is used for creating color styleshteet options----------****//							
//****=============================================================================****//				
            array("name" => "Styling Options",
                "type" => "heading"),
            array("name" => "Theme Stylesheet",
                "desc" => "Select your themes alternative color scheme.",
                "id" => "inkthemes_altstylesheet",
                "std" => "green",
                "type" => "select",
                "options" => $alt_stylesheets),
            array("name" => "Custom CSS",
                "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                "id" => "inkthemes_customcss",
                "std" => "",
                "type" => "textarea"));
        inkthemes_update_option('of_template', $options);
        inkthemes_update_option('of_themename', $themename);
        inkthemes_update_option('of_shortname', $shortname);
    }

}
?>

<?php

add_action('init', 'inkthemes_options');
if (!function_exists('inkthemes_options')) {

    function inkthemes_options() {
        // VARIABLES
        $themename = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme();
        $themename = $themename['Name'];
        $shortname = "of";
        // Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = inkthemes_get_option('of_options');
        //Front page on/off
        $file_rename = array("on" => "On", "off" => "Off");
        // Background Defaults
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
        //Stylesheet Reader
        $alt_stylesheets = array("green" => "green", "black" => "black", "blue" => "blue", "grass" => "grass", "orange" => "orange", "purple" => "purple", "red" => "red", "yellow" => "yellow");
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
            /* ---------------------------------------------------------------------------- */
            /* General Setting */
            /* ---------------------------------------------------------------------------- */
            array("name" => __("General Settings",'andrina-lite'),
                "type" => "heading"),
            array("name" => __("Custom Logo",'andrina-lite'),
                "desc" => __("Choose your own logo. Optimal Size: 221px Wide by 84px Height.",'andrina-lite'),
                "id" => "inkthemes_logo",
                "type" => "upload"),
            array("name" => __("Custom Favicon","andrina-lite"),
                "desc" => __("Specify a 16px x 16px image that will represent your website's favicon.",'andrina-lite'),
                "id" => "inkthemes_favicon",
                "type" => "upload"),
            array("name" => "Front Page On/Off",
                "desc" => "If the front page option is active then home page will appear otherwise blog page will display.",
                "id" => "re_nm",
                "std" => "on",
                "type" => "radio",
                "options" => $file_rename),
            /* ---------------------------------------------------------------------------- */
            /* Homepage Feature Area */
            /* ---------------------------------------------------------------------------- */
            array("name" => __("Homepage Settings",'andrina-lite'),
                "type" => "heading"),
            //Homepage Main Heading 
            array("name" => __("Top Feature Image",'andrina-lite'),
                "desc" => __("Choose your image for first slider. Optimal size is 950px wide and 460px height.",'andrina-lite'),
                "id" => "inkthemes_slideimage1",
                "std" => "",
                "type" => "upload"),
            array("name" => __("Top Feature Heading",'andrina-lite'),
                "desc" => __("Enter your text heading for top feature.",'andrina-lite'),
                "id" => "inkthemes_slider_heading1",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Top Feature Description",'andrina-lite'),
                "desc" => __("Enter your text description for top feature.",'andrina-lite'),
                "id" => "inkthemes_slider_des1",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Main Heading",'andrina-lite'),
                "type" => "saperate",
                "class" => "saperator"),
            array("name" => __("Homepage Main Heading",'andrina-lite'),
                "desc" => __("Enter your text heading for homepage main heading",'andrina-lite'),
                "id" => "inkthemes_main_head",
                "std" => "",
                "type" => "textarea"),
            //Feature Section
            array("name" => __("Feature Area",'andrina-lite'),
                "type" => "saperate",
                "class" => "saperator"),
            //First Feature Image
            array("name" => __("First Feature Image",'andrina-lite'),
                "desc" => __("Choose your image for first feature section. Optimal size is 202px x 134px.",'andrina-lite'),
                "id" => "inkthemes_feature_img1",
                "std" => "",
                "type" => "upload"),
            //Second Feature Image
            array("name" => __("Second Feature Image",'andrina-lite'),
                "desc" => __("Choose your image for second feature section. Optimal size is 202px x 134px.",'andrina-lite'),
                "id" => "inkthemes_feature_img2",
                "std" => "",
                "type" => "upload"),
            //Third Feature Image
            array("name" => __("Third Feature Image",'andrina-lite'),
                "desc" => __("Choose your image for third feature section. Optimal size is 202px x 134px.",'andrina-lite'),
                "id" => "inkthemes_feature_img3",
                "std" => "",
                "type" => "upload"),
            //Fourth Feature Image
            array("name" => __("Fourth Feature Image",'andrina-lite'),
                "desc" => __("Choose your image for fourth feature section. Optimal size is 202px x 134px.",'andrina-lite'),
                "id" => "inkthemes_feature_img4",
                "std" => "",
                "type" => "upload"),
            array("name" => __("Feature Descriptions",'andrina-lite'),
                "type" => "saperate",
                "class" => "saperator"),
            //First Feature Section
            array("name" => __("First Feature Heading",'andrina-lite'),
                "desc" => __("Enter your text heading for first feature section.",'andrina-lite'),
                "id" => "inkthemes_f_head1",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("First Feature Description",'andrina-lite'),
                "desc" => __("Enter your text description for first feature section.",'andrina-lite'),
                "id" => "inkthemes_f_des1",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("First Feature Link URL",'andrina-lite'),
                "desc" => __("Enter your link url for first feature section.",'andrina-lite'),
                "id" => "inkthemes_link1",
                "std" => "",
                "type" => "text"),
            //Second Feature Section
            array("name" => __("Second Feature Heading",'andrina-lite'),
                "desc" => __("Enter your text heading for second feature section.",'andrina-lite'),
                "id" => "inkthemes_f_head2",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Second Feature Description",'andrina-lite'),
                "desc" => __("Enter your text description for second feature section.",'andrina-lite'),
                "id" => "inkthemes_f_des2",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Second Feature Link URL",'andrina-lite'),
                "desc" => __("Enter your link url for second feature section.",'andrina-lite'),
                "id" => "inkthemes_link2",
                "std" => "",
                "type" => "text"),
            //Thrid Feature Section
            array("name" => __("Third Feature Heading",'andrina-lite'),
                "desc" => __("Enter your text heading for third feature section.",'andrina-lite'),
                "id" => "inkthemes_f_head3",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Third Feature Description",'andrina-lite'),
                "desc" => __("Enter your text description for third feature section.",'andrina-lite'),
                "id" => "inkthemes_f_des3",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Third Feature Link URL",'andrina-lite'),
                "desc" => __("Enter your link url for third feature section.",'andrina-lite'),
                "id" => "inkthemes_link3",
                "std" => "",
                "type" => "text"),
            //Fourth Feature Section
            array("name" => __("Fourth Feature Heading",'andrina-lite'),
                "desc" => __("Enter your text heading for fourth feature section.",'andrina-lite'),
                "id" => "inkthemes_f_head4",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Fourth Feature Description",'andrina-lite'),
                "desc" => __("Enter your text description for fourth feature section.",'andrina-lite'),
                "id" => "inkthemes_f_des4",
                "std" => "",
                "type" => "textarea"),
            array("name" => __("Fourth Feature Link URL",'andrina-lite'),
                "desc" => __("Enter your link url for fourth feature section.",'andrina-lite'),
                "id" => "inkthemes_link4",
                "std" => "",
                "type" => "text"),
            //Homepage two cols
            array("name" => __("Homepage Two Cols",'andrina-lite'),
                "type" => "saperate",
                "class" => "saperator"),
            //Left Column heading
            array("name" => __("Left Column Heading",'andrina-lite'),
                "desc" => __("Enter your text heading for left column heading.",'andrina-lite'),
                "id" => "inkthemes_left_head",
                "std" => "",
                "type" => "textarea"),
            //Right Column heading
            array("name" => __("Right Column Heading",'andrina-lite'),
                "desc" => __("Enter your text heading for right column heading.",'andrina-lite'),
                "id" => "inkthemes_right_head",
                "std" => "",
                "type" => "textarea"),
            //Right Column description
            array("name" => __("Right Column Description",'andrina-lite'),
                "desc" => __("Enter your text description for right section. You can put your html code in this section",'andrina-lite'),
                "id" => "inkthemes_right_des",
                "std" => "",
                "type" => "textarea"),
            //Contact Area
            array("name" => __("Contact Area",'andrina-lite'),
                "type" => "saperate",
                "class" => "saperator"),
            array("name" => __("Contact Number",'andrina-lite'),
                "desc" => __("Enter your contact number.",'andrina-lite'),
                "id" => "inkthemes_contact_no",
                "std" => "",
                "type" => "text"),
            array("name" => __("Email Address",'andrina-lite'),
                "desc" => __("Enter your email address.",'andrina-lite'),
                "id" => "inkthemes_email_add",
                "std" => "",
                "type" => "text"),
            array("name" => __("Date",'andrina-lite'),
                "desc" => __("Enter your date.",'andrina-lite'),
                "id" => "inkthemes_date",
                "std" => "",
                "type" => "text"),
            /* ---------------------------------------------------------------------------- */
            /* Styling Setting */
            /* ---------------------------------------------------------------------------- */
            array("name" => __("Styling Options",'andrina-lite'),
                "type" => "heading"),
            array("name" => __("Custom CSS",'andrina-lite'),
                "desc" => __("Quickly add some CSS to your theme by adding it to this block.",'andrina-lite'),
                "id" => "inkthemes_customcss",
                "std" => "",
                "type" => "textarea"));
        inkthemes_update_option('of_template', $options);
        inkthemes_update_option('of_themename', $themename);
        inkthemes_update_option('of_shortname', $shortname);
    }

}
?>

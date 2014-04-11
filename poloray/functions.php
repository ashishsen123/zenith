<?php

include_once get_template_directory() . '/functions/poloray-functions.php';
$poloray_functions_path = get_template_directory() . '/functions/';
/* These files build out the options interface.  Likely won't need to edit these. */
require_once ($poloray_functions_path . 'admin-functions.php');  // Custom functions and plugins
require_once ($poloray_functions_path . 'admin-interface.php');  // Admin Interfaces (options,framework, seo)
/* These files build out the theme specific options and associated functions. */
require_once ($poloray_functions_path . 'theme-options.php');   // Options panel settings and custom settings
define('POLORAY_ADMINURL', get_template_directory_uri() . '/functions/');
/* ----------------------------------------------------------------------------------- */
/* jQuery Enqueue */
/* ----------------------------------------------------------------------------------- */

function poloray_wp_enqueue_scripts() {
    if (!is_admin()) {
        wp_enqueue_script('poloray-ddsmoothmenu', get_template_directory_uri() . '/js/ddsmoothmenu.js', array('jquery'));
        wp_enqueue_script('poloray-cunfon-yui', get_template_directory_uri() . '/js/cufon-yui.js', array('jquery'));
        wp_enqueue_script('poloray-Champagne-font', get_template_directory_uri() . '/js/Champagne.font.js', array('jquery'));
        wp_enqueue_script('flex-slider', get_template_directory_uri() . '/js/jquery-flexslider-min.js', array('jquery'));
        wp_enqueue_script('poloray-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'));
        wp_enqueue_script('poloray-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
        if (is_singular() and get_site_option('thread_comments')) {
            wp_print_scripts('comment-reply');
        }
        wp_enqueue_script('mobile-menu', get_template_directory_uri() . "/js/mobile-menu.js", array('jquery'), '', true);
    }
}

add_action('wp_enqueue_scripts', 'poloray_wp_enqueue_scripts');

//Front Page Rename
$get_status = poloray_get_option('re_nm');
$get_file_ac = get_template_directory() . '/front-page.php';
$get_file_dl = get_template_directory() . '/front-page-hold.php';
//True Part
if ($get_status === 'off' && file_exists($get_file_ac)) {
    rename("$get_file_ac", "$get_file_dl");
}
//False Part
if ($get_status === 'on' && file_exists($get_file_dl)) {
    rename("$get_file_dl", "$get_file_ac");
}

//
function poloray_get_option($name) {
    $options = get_option('poloray_options');
    if (isset($options[$name]))
        return $options[$name];
}

//
function poloray_update_option($name, $value) {
    $options = get_option('poloray_options');
    $options[$name] = $value;
    return update_option('poloray_options', $options);
}

//
function poloray_delete_option($name) {
    $options = get_option('poloray_options');
    unset($options[$name]);
    return update_option('poloray_options', $options);
}

//Add plugin notification 
require_once(get_template_directory() . '/functions/plugin-activation.php');
require_once(get_template_directory() . '/functions/inkthemes-plugin-notify.php');
add_action('tgmpa_register', 'inkthemes_plugins_notify');
?>

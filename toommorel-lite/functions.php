<?php

include_once get_template_directory() . '/functions/inkthemes-functions.php';
$functions_path = get_template_directory() . '/functions/';
/* These files build out the options interface.  Likely won't need to edit these. */
require_once ($functions_path . 'admin-functions.php');  // Custom functions and plugins
require_once ($functions_path . 'admin-interface.php');  // Admin Interfaces (options,framework, seo)
/* These files build out the theme specific options and associated functions. */
require_once ($functions_path . 'theme-options.php');   // Options panel settings and custom settings
/* ----------------------------------------------------------------------------------- */
/* jQuery Enqueue */
/* ----------------------------------------------------------------------------------- */

function inkthemes_jquery_init() {
    if (!is_admin()) {
        wp_enqueue_style('coloroptions', get_template_directory_uri() . "/css/" . inkthemes_get_option('inkthemes_altstylesheet') . ".css", '', '', 'all');
        wp_enqueue_script('ddsmoothmenu', get_stylesheet_directory_uri() . "/js/ddsmoothmenu.js", array('jquery'));
        wp_enqueue_script('homeimagezoomeffect', get_stylesheet_directory_uri() . "/js/image-effect.js", array('jquery'));
        wp_enqueue_script('tipsy', get_stylesheet_directory_uri() . '/js/jquery.tipsy.js', array('jquery'));
        wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'));
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'inkthemes_jquery_init');

function inkthemes_get_option($name) {
    $options = get_option('inkthemes_options');
    if (isset($options[$name]))
        return $options[$name];
}

function inkthemes_update_option($name, $value) {
    $options = get_option('inkthemes_options');
    $options[$name] = $value;

    return update_option('inkthemes_options', $options);
}

function inkthemes_delete_option($name) {
    $options = get_option('inkthemes_options');
    unset($options[$name]);

    return update_option('inkthemes_options', $options);
}
//Front Page Rename
$get_status = inkthemes_get_option('re_nm');
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
//Add plugin notification 
require_once(get_template_directory() . '/functions/plugin-activation.php');
require_once(get_template_directory() . '/functions/inkthemes-plugin-notify.php');
add_action('tgmpa_register', 'inkthemes_plugins_notify');
?>

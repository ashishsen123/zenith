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

function inkthemes_wp_enqueue_scripts() {
    if (!is_admin()) {
        wp_enqueue_script('inkthemes-ddsmoothmenu', get_template_directory_uri() . '/js/ddsmoothmenu.js', array('jquery'));
        wp_enqueue_script('inkthemes-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'));
        wp_enqueue_script('inkthemes-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
        if (is_singular() and get_site_option('thread_comments')) {
            wp_print_scripts('comment-reply');
        }
    }
}

add_action('wp_enqueue_scripts', 'inkthemes_wp_enqueue_scripts');


// customizer addition
require get_template_directory() . '/inc/customizer.php';


//Function for cufon in ie
function inkthemes_iescript() {
    ?>
    <!--[if gte IE 9]>
          <script type="text/javascript">
          Cufon.set('engine', 'canvas');
          </script>
          <![endif]-->
    <?php
}

add_action('wp_head', 'inkthemes_iescript');

//Function get_option to get value from options
function inkthemes_get_option($name) {
    $options = get_option('inkthemes_options');
    if (isset($options[$name]))
        return $options[$name];
}

//Function update option
function inkthemes_update_option($name, $value) {
    $options = get_option('inkthemes_options');
    $options[$name] = $value;
    return update_option('inkthemes_options', $options);
}

//Function delete option
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

/*genrate body class*/

add_filter('body_class', 'andrinalite_body_classes');

function andrinalite_body_classes($classes) 
		{
        $slug = strtolower(get_theme_mod( 'andrinalite_color_scheme' ));
        $classes[] = 'andrinalite-'.$slug;
        return $classes;
}

/*end genrate body class*/

<?php 
/***
 * Custom Javascript Options
 *
 * Passing Variables from custom Theme Options to the javascript files
 * of theme navigation. 
 *
 */

// Passing Variables to Theme Navigation ( js/navigation.js)
add_action('wp_enqueue_scripts', 'themezee_custom_jscript_navigation');

if ( ! function_exists( 'themezee_custom_jscript_navigation' ) ):
function themezee_custom_jscript_navigation() { 

	// Set Parameters array
	$params = array(
		'menuTitle' => __('Menu', 'zeeTasty_lang')
	);
	
	// Passing Parameters to Javascript
	wp_localize_script( 'themezee_jquery_navigation', 'customNavigationParams', $params );
}
endif;

?>
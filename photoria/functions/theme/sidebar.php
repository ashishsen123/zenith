<?php
/*-----------------------------------------------------------------------------------*/
/* Initializing Widgetized Areas (Sidebars)											                     */
/*-----------------------------------------------------------------------------------*/

register_sidebar( array(
	'name' => 'Sidebar',
	'before_widget' => '<div class="widget">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
) );

register_sidebar( array(
	'name' => 'Footer: Column 1',
	'before_widget' => '<div class="widget">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
) );

register_sidebar( array(
	'name' => 'Footer: Column 2',
	'before_widget' => '<div class="widget">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
) );

register_sidebar( array(
	'name' => 'Footer: Column 3',
	'before_widget' => '<div class="widget">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
) );

register_sidebar( array(
	'name' => 'Footer: Column 4',
	'before_widget' => '<div class="widget">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
) );
?>
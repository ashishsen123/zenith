<div class="sidebar">
	<?php wp_nav_menu(  array('theme_location' => 'sidebar-nav' , 'menu_class' => 'sidebar-nav rounds hide-small',  'container' => false)); ?>
	<?php if ( !dynamic_sidebar('Sidebar') ) : ?>
	<?php endif; ?>
</div>

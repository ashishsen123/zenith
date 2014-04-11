<?php
/**
 * Primary Menu Template
 *
 * Displays the Primary Menu if it has active menu items.
 *
 * @package Murmur
 * @subpackage Functions
 * @version 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
if ( has_nav_menu( 'primary' ) ) : ?>

	<?php do_atomic( 'before_menu_primary' ); // murmur_before_menu_primary ?>

	<nav id="menu-primary" class="menu-container">
		
		<h3 id="menu-primary-title">
			<?php _e( 'Toggle Menu', 'murmur' ); ?>
		</h3><!-- #menu-primary-title -->

		<?php do_atomic( 'open_menu_primary' ); // murmur_open_menu_primary ?>

		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-primary-items', 'fallback_cb' => '' ) ); ?>

		<?php do_atomic( 'close_menu_primary' ); // murmur_close_menu_primary ?>

	</nav><!-- #menu-primary .menu-container -->

	<?php do_atomic( 'after_menu_primary' ); // murmur_after_menu_primary ?>

<?php endif; ?>
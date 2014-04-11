<?php
/**
 * Subsidiary Menu Template
 *
 * Displays the Subsidiary Menu if it has active menu items.
 *
 * @package Murmur
 * @subpackage Functions
 * @version 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( has_nav_menu( 'subsidiary' ) ) : ?>

	<?php do_atomic( 'before_menu_subsidiary' ); // murmur_before_menu_subsidiary ?>

	<nav id="menu-subsidiary" class="menu-container">

		<?php do_atomic( 'open_menu_subsidiary' ); // murmur_open_menu_subsidiary ?>

		<?php wp_nav_menu( array( 'theme_location' => 'subsidiary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-subsidiary-items', 'fallback_cb' => '' ) ); ?>

		<?php do_atomic( 'close_menu_subsidiary' ); // murmur_close_menu_subsidiary ?>

	</nav><!-- #menu-subsidiary .menu-container -->

	<?php do_atomic( 'after_menu_subsidiary' ); // murmur_after_menu_subsidiary ?>

<?php endif; ?>
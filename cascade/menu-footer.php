<?php
/**
 * Footer Menu Template
 *
 * Displays the In Footer Menu if it has active menu items.
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Tung Do <ttsondo@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/cascade
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( has_nav_menu( 'footer' ) ) : ?>

	<?php do_atomic( 'before_menu_footer' ); // cascade_before_menu_footer ?>

	<div id="menu-footer" class="menu-container">

		<div class="wrap">
		
			<div id="menu-footer-title">
				<?php _e( 'Menu', 'cascade' ); ?>
			</div><!-- #menu-primary-title -->

			<?php do_atomic( 'open_menu_footer' ); // cascade_open_menu_footer ?>

			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-footer-items', 'fallback_cb' => '' ) ); ?>

			<?php do_atomic( 'close_menu_footer' ); // cascade_close_menu_footer ?>

		</div>

	</div><!-- #menu-footer .menu-container -->

	<?php do_atomic( 'after_menu_footer' ); // cascade_after_menu_footer ?>

<?php endif; ?>
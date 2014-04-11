<?php
/**
 * Header Primary Menu Template
 *
 * Displays the Header Primary Menu if it has active menu items.
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Tung Do <ttsondo@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/cascade
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( has_nav_menu( 'header-primary' ) ) : ?>

	<?php do_atomic( 'before_menu_header_primary' ); // cascade_before_menu_header_primary ?>

	<div id="menu-header-primary" class="menu-container">

		<div class="wrap">

			<?php do_atomic( 'open_menu_header_primary' ); // cascade_open_menu_header_primary ?>
			
			<div id="menu-header-primary-title">
				<?php _e( 'Menu', 'cascade' ); ?>
			</div><!-- #menu-header-primary-title -->

			<?php wp_nav_menu( array( 'theme_location' => 'header-primary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-header-primary-items', 'fallback_cb' => '' ) ); ?>	

			<?php do_atomic( 'close_menu_header_primary' ); // cascade_close_menu_header_primary ?>

		</div>

	</div><!-- #menu-header-primary .menu-container -->

	<?php do_atomic( 'after_menu_header_primary' ); // cascade_after_menu_header_primary ?>

<?php endif; ?>
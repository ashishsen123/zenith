<?php
/**
 * After Singular Sidebar Template
 *
 * Displays widgets for the After Content dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Murmur
 * @subpackage Functions
 * @version 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( is_active_sidebar( 'after-singular' ) ) : ?>

	<?php do_atomic( 'after_sidebar_after_singular' ); // murmur_after_sidebar_after_singular ?>

	<div id="sidebar-after-singular" class="sidebar sidebar-inter-content">

		<?php do_atomic( 'open_sidebar_after_singular' ); // murmur_open_sidebar_after_singular ?>

		<?php dynamic_sidebar( 'after-singular' ); ?>

		<?php do_atomic( 'close_sidebar_after_singular' ); // murmur_close_sidebar_after_singular ?>

	</div><!-- #sidebar-after-singular -->

	<?php do_atomic( 'after_sidebar_after_singular' ); // murmur_after_sidebar_after_singular ?>

<?php endif; ?>
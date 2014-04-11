<?php
/**
 * Entry Sidebar Template
 *
 * Displays widgets for the Entry dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/cascade
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( is_active_sidebar( 'entry' ) ) : ?>

	<?php do_atomic( 'before_sidebar_entry' ); // cascade_before_sidebar_entry ?>

	<div id="sidebar-entry" class="sidebar">

		<?php do_atomic( 'open_sidebar_entry' ); // cascade_open_sidebar_entry ?>

		<?php dynamic_sidebar( 'entry' ); ?>

		<?php do_atomic( 'close_sidebar_entry' ); // cascade_close_sidebar_entry ?>

	</div><!-- #sidebar-entry -->

	<?php do_atomic( 'after_sidebar_entry' ); // cascade_after_sidebar_entry ?>

<?php endif; ?>
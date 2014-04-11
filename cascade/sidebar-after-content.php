<?php
/**
 * After Content Sidebar Template
 *
 * Displays widgets for the After Content dynamic sidebar if any have been added to the sidebar through the 
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

if ( is_active_sidebar( 'after-content' ) ) : ?>

	<?php do_atomic( 'after_sidebar_after_content' ); // cascade_after_sidebar_after_content ?>

	<div id="sidebar-after-content" class="sidebar sidebar-inter-content">

		<?php do_atomic( 'open_sidebar_after_content' ); // cascade_open_sidebar_after_content ?>

		<?php dynamic_sidebar( 'after-content' ); ?>

		<?php do_atomic( 'close_sidebar_after_content' ); // cascade_close_sidebar_after_content ?>

	</div><!-- #sidebar-after-content -->

	<?php do_atomic( 'after_sidebar_after_content' ); // cascade_after_sidebar_after_content ?>

<?php endif; ?>
<?php
/**
 * Before Content Sidebar Template
 *
 * Displays widgets for the Before Content dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Justin Tadlock
 * @author Tung Do <tung@devpress.com>
 */

if ( is_active_sidebar( 'before-content' ) ) : ?>

	<?php do_atomic( 'before_sidebar_before_content' ); // cascade_before_sidebar_before_content ?>

	<div id="sidebar-before-content" class="sidebar sidebar-inter-content">

		<?php do_atomic( 'open_sidebar_before_content' ); // cascade_open_sidebar_before_content ?>

		<?php dynamic_sidebar( 'before-content' ); ?>

		<?php do_atomic( 'close_sidebar_before_content' ); // cascade_close_sidebar_before_content ?>

	</div><!-- #sidebar-before-content -->

	<?php do_atomic( 'after_sidebar_before_content' ); // cascade_after_sidebar_before_content ?>

<?php endif; ?>
<?php
/**
 * Header Sidebar Template
 *
 * Displays widgets for the Header dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Justin Tadlock
 * @author Tung Do <tung@devpress.com>
 */

if ( is_active_sidebar( 'header' ) ) : ?>

	<?php do_atomic( 'before_sidebar_header' ); // cascade_before_sidebar_header ?>

	<div id="sidebar-header" class="sidebar">

		<?php do_atomic( 'open_sidebar_header' ); // cascade_open_sidebar_header ?>

		<?php dynamic_sidebar( 'header' ); ?>

		<?php do_atomic( 'close_sidebar_header' ); // cascade_close_sidebar_header ?>

	</div><!-- #sidebar-header -->

	<?php do_atomic( 'after_sidebar_header' ); // cascade_after_sidebar_header ?>

<?php endif; ?>
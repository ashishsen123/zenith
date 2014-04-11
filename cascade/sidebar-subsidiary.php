<?php
/**
 * Subsidiary Sidebar Template
 *
 * Displays widgets for the Subsidiary dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Cascade
 * @subpackage Functions
 * @version 0.1.3
 * @author Justin Tadlock
 * @author Tung Do <tung@devpress.com>
 */

if ( is_active_sidebar( 'subsidiary' ) ) : ?>

	<?php do_atomic( 'before_sidebar_subsidiary' ); // cascade_before_sidebar_subsidiary ?>

	<div id="sidebar-subsidiary" class="sidebar sidebar-1c sidebar-subsidiary">
	
		<div class="sidebar-wrap">

			<?php do_atomic( 'open_sidebar_subsidiary' ); // cascade_open_sidebar_subsidiary ?>

			<?php dynamic_sidebar( 'subsidiary' ); ?>

			<?php do_atomic( 'close_sidebar_subsidiary' ); // cascade_close_sidebar_subsidiary ?>
		
		</div><!-- .sidebar-wrap -->

	</div><!-- #sidebar-subsidiary -->

	<?php do_atomic( 'after_sidebar_subsidiary' ); // cascade_after_sidebar_subsidiary ?>

<?php endif; ?>
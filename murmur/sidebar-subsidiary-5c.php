<?php
/**
 * Subsidiary 5 Columns Sidebar Template
 *
 * Displays widgets for the Subsidiary 5 Columns dynamic sidebar if any have been added to the sidebar through the 
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

if ( is_active_sidebar( 'subsidiary-5c' ) ) : ?>

	<?php do_atomic( 'before_sidebar_subsidiary_5c' ); // murmur_before_sidebar_subsidiary_5c ?>

	<div id="sidebar-subsidiary-5c" class="sidebar sidebar-5c sidebar-subsidiary">
	
		<div class="sidebar-wrap">

			<?php do_atomic( 'open_sidebar_subsidiary_5c' ); // murmur_open_sidebar_subsidiary_5c ?>

			<?php dynamic_sidebar( 'subsidiary-5c' ); ?>

			<?php do_atomic( 'close_sidebar_subsidiary_5c' ); // murmur_close_sidebar_subsidiary_5c ?>
		
		</div><!-- .sidebar-wrap -->

	</div><!-- #sidebar-subsidiary-5c -->

	<?php do_atomic( 'after_sidebar_subsidiary_5c' ); // murmur_after_sidebar_subsidiary_5c ?>

<?php endif; ?>
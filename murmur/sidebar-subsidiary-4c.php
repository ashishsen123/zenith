<?php
/**
 * Subsidiary 4 Columns Sidebar Template
 *
 * Displays widgets for the Subsidiary 4 Columns dynamic sidebar if any have been added to the sidebar through the 
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

if ( is_active_sidebar( 'subsidiary-4c' ) ) : ?>

	<?php do_atomic( 'before_sidebar_subsidiary_4c' ); // murmur_before_sidebar_subsidiary_4c ?>

	<div id="sidebar-subsidiary-4c" class="sidebar sidebar-4c sidebar-subsidiary">
	
		<div class="sidebar-wrap">

			<?php do_atomic( 'open_sidebar_subsidiary_4c' ); // murmur_open_sidebar_subsidiary_4c ?>

			<?php dynamic_sidebar( 'subsidiary-4c' ); ?>

			<?php do_atomic( 'close_sidebar_subsidiary_4c' ); // murmur_close_sidebar_subsidiary_4c ?>
		
		</div><!-- .sidebar-wrap -->

	</div><!-- #sidebar-subsidiary-4c -->

	<?php do_atomic( 'after_sidebar_subsidiary_4c' ); // murmur_after_sidebar_subsidiary_4c ?>

<?php endif; ?>
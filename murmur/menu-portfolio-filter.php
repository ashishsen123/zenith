<?php
/**
 * Portfolio Filter Menu Template
 *
 * Displays the Content Filter Menu if it has active menu items.
 *
 * @package Murmur
 * @subpackage Functions
 * @version 0.1.2
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
?>

	<?php do_atomic( 'before_menu_portfolio_filter' ); // murmur_before_menu_portfolio_filter ?>

	<nav id="menu-portfolio-filter" class="menu-container">

		<?php do_atomic( 'open_menu_portfolio-filter' ); // murmur_open_menu_portfolio_filter ?>

		<ul id="filters" class="option-set" data-option-key="filter">
			<?php 
				$roles = get_terms( 'dp_portfolio_role', array(
					'order' => 'DESC',
					'orderby' => 'count',
					'hide_empty' => 1,
					'hierarchical' => 0
					)
				);
					
				if( count( $roles ) > 0 ) {
				
					$out = '<li><a href="#filter" data-option-value="*">' . __( 'All', 'murmur' ) . '</a></li>';
				
					foreach ( $roles as $role ) {
						$out .= '<li><a href="#filter" data-option-value=".' . $role->slug . '">' . $role->name . '</a></li>';
					}
				}
					
				echo $out;
			?>
		</ul><!-- #filters .options-set -->

		<?php do_atomic( 'close_menu_portfolio_filter' ); // murmur_close_menu_portfolio_filter ?>

	</nav><!-- #menu-portfolio-filter .menu-container -->

	<?php do_atomic( 'after_menu_portfolio_filter' ); // murmur_after_menu_portfolio-filter ?>
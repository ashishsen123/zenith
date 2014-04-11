<?php
if ( option::get('ad_side_select') == 'on' && option::get('ad_side_pos') == 'Before widgets' ) {

	?><div class="banner">

		<?php if ( option::get('ad_side_code') <> "" ) {
			echo stripslashes(option::get('ad_side_code'));
		} else {
			?><a href="<?php echo option::get('ad_side_imgurl'); ?>"><img src="<?php echo option::get('ad_side_imgpath'); ?>" alt="<?php echo option::get('ad_side_imgalt'); ?>" /></a><?php
		} ?>

	</div><?php

}

if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('Sidebar');

if ( option::get('ad_side_select') == 'on' && option::get('ad_side_pos') == 'After widgets' ) {

	?><div class="banner">

		<?php if ( option::get('ad_side_code') <> "" ) {
			echo stripslashes(option::get('ad_side_code'));
		} else {
			?><a href="<?php echo option::get('ad_side_imgurl'); ?>"><img src="<?php echo option::get('ad_side_imgpath'); ?>" alt="<?php echo option::get('ad_side_imgalt'); ?>" /></a><?php
		} ?>

	</div><?php

}
?>

<div class="cleaner">&nbsp;</div>
<?php

add_action('admin_menu', 'wpzoom_options_box');

function wpzoom_options_box() {
  add_meta_box('wpzoom_post_featured', 'Featured Post', 'wpzoom_post_featured_options', 'post', 'side', 'high');
	add_meta_box('wpzoom_post_layout', 'Post Layout', 'wpzoom_post_layout_options', 'post', 'normal', 'high');
}

function wpzoom_post_featured_options() {
	global $post;
	?>

	<fieldset>
		<div>
			<p>
				<?php $isChecked = ( get_post_meta($post->ID, 'wpzoom_is_featured', true) == 1 ? 'checked="checked"' : '' ); // we store checked checkboxes as 1 ?>
				<input type="checkbox" name="wpzoom_is_featured" id="wpzoom_is_featured" value="1" <?php echo $isChecked; ?> /> <label for="wpzoom_is_featured">Feature on Homepage</label> 
			</p>
		</div>
	</fieldset>
	<?php
}

function wpzoom_post_layout_options() {
	global $post;
	$postLayouts = array('side-right' => 'Sidebar on the right', 'side-left' => 'Sidebar on the left', 'full' => 'Full Width');
	?>

	<style>
	.RadioClass { display: none !important; }
	.RadioLabelClass { margin-right: 10px; }
	img.layout-select { border: solid 4px #c0cdd6; border-radius: 5px; }
	.RadioSelected img.layout-select { border: solid 4px #3173b2; }

 	#wpzoom_post_embed_code { font-size: 20px; }
	#wpzoom_post_embed_code { color: #444444; font-size: 11px; margin: 3px 0 10px; padding: 5px; font-family: Consolas,Monaco,Courier,monospace; }
	.wpzoom_post_embed_code { background: #F4F4F4; color: #444444; font-size: 11px; margin: 3px 0 0; padding: 5px; font-family: Consolas,Monaco,Courier,monospace; }
	.wpz_video { background: url(images/media-button-video.gif) no-repeat; padding: 0 0 0 18px; }
	.wpz_list { font-size: 11px; }
	.wpz_self_input { border: 1px solid #DFDFDF; border-radius: 4px 4px 4px 4px; width: 230px; color: #444444; }
	.wpz_border { border-bottom: 1px solid #EEEEEE; padding: 0 0 10px; }
 
 	</style>

	<script type="text/javascript">  
		jQuery(document).ready( function($) {
			$(".RadioClass").change(function(){  
			    if($(this).is(":checked")){  
			        $(".RadioSelected:not(:checked)").removeClass("RadioSelected");  
			        $(this).next("label").addClass("RadioSelected");  
			    }  
			}); 
 		});  
  	</script>
  
	<fieldset>
		<div>
 			<p>
 			<?php
			foreach ($postLayouts as $key => $value)
			{
				?>
				<input id="<?php echo $key; ?>" type="radio" class="RadioClass" name="wpzoom_post_template" value="<?php echo $key; ?>"<?php if (get_post_meta($post->ID, 'wpzoom_post_template', true) == $key) { echo' checked="checked"'; } ?> />
				<label for="<?php echo $key; ?>" class="RadioLabelClass<?php if (get_post_meta($post->ID, 'wpzoom_post_template', true) == $key) { echo' RadioSelected"'; } ?>">
				<img src="<?php echo wpzoom::$wpzoomPath; ?>/assets/images/layout-<?php echo $key; ?>.png" alt="<?php echo $value; ?>" title="<?php echo $value; ?>" class="layout-select" /></label>
			<?php
			} 
			?>
 			</p>
   		</div>
	</fieldset>
	<?php
}
 
add_action('save_post', 'custom_add_save');

function custom_add_save($postID){
// called after a post or page is saved
if($parent_id = wp_is_post_revision($postID))
{
  $postID = $parent_id;
}
 
if ($_POST['save'] || $_POST['publish']) { 
   update_custom_meta($postID, $_POST['wpzoom_is_featured'], 'wpzoom_is_featured');
	 update_custom_meta($postID, $_POST['wpzoom_post_template'], 'wpzoom_post_template');
}
}

function update_custom_meta($postID, $newvalue, $field_name) {
// To create new meta
if(!get_post_meta($postID, $field_name)){
add_post_meta($postID, $field_name, $newvalue);
}else{
// or to update existing meta
update_post_meta($postID, $field_name, $newvalue);
}
}

// Generates Custom Fields
function get_custom_field_value($szKey, $bPrint = false) {
	
  global $post;
	
  $szValue = get_post_meta($post->ID, $szKey, true);
	
  if ( $bPrint == false )
  { 
  return $szValue;
  } 
  else { echo $szValue; }
} 

?>
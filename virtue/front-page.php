			<?php  global $virtue; ?>
			<?php if(!empty($virtue['mobile_switch'])) { 
				$mobile_slider = $virtue['mobile_switch'];
			} else {
				$mobile_slider = '';
			}
			if(!empty($virtue['choose_slider'])) {
				$slider = $virtue['choose_slider'];
			} else {
				$slider = 'mock_flex';
			}
			if(detect_mobile() && $mobile_slider == '1') {
		 		$slider = $virtue['choose_mobile_slider'];
					 if ($slider == "flex") {
					get_template_part('templates/mobile_home/mobileflex', 'slider');
				}
				else if ($slider == "video") {
					get_template_part('templates/mobile_home/mobilevideo', 'block');
				} 
	} else { ?>
    		<?php if ($slider == "flex") {
					get_template_part('templates/home/flex', 'slider');
				}
				else if ($slider == "thumbs") {
					get_template_part('templates/home/thumb', 'slider');
				}
				else if ($slider == "latest") {
					get_template_part('templates/home/latest', 'slider');
				}
				else if ($slider == "carousel") {
					get_template_part('templates/home/carousel', 'slider');
				}
				else if ($slider == "video") {
					get_template_part('templates/home/video', 'block');
				}
				else if ($slider == "mock_flex") {
					get_template_part('templates/home/mock', 'flex');
				}
}?>
	
    <div id="content" class="container homepagecontent">
   		<div class="row">
          <div class="main <?php echo kadence_main_class(); ?>" role="main">

      	<?php if(isset($virtue['homepage_layout']['enabled'])) { $layout = $virtue['homepage_layout']['enabled']; } else {$layout = array("block_twenty" => "block_twenty", "block_five" => "block_five"); }

				if ($layout):

				foreach ($layout as $key=>$value) {

				    switch($key) {

				    	case 'block_one':?>
						    <div id="homeheader" class="welcomeclass">
									<?php get_template_part('templates/page', 'header'); ?>
							</div><!--titleclass-->
					    <?php 
					    break;
						case 'block_four': ?>
							<?php if(is_home()) { ?>
							<?php if(kadence_display_sidebar()) {$display_sidebar = true; $fullclass = '';} else {$display_sidebar = false; $fullclass = 'fullwidth';} ?>
							<?php global $virtue; if(isset($virtue['home_post_summery']) and ($virtue['home_post_summery'] == 'full')) {$summery = "full"; $postclass = "single-article fullpost";} else {$summery = "summery"; $postclass = "postlist";} ?>
								<div class="homecontent <?php echo $fullclass; ?>  <?php echo $postclass; ?> clearfix home-margin"> 
							<?php while (have_posts()) : the_post(); ?>
							  <?php  if($summery == 'full') {
											if($display_sidebar){
												get_template_part('templates/content', 'fullpost'); 
											} else {
												get_template_part('templates/content', 'fullpostfull');
											}
									} else {
											if($display_sidebar){
											 	get_template_part('templates/content', get_post_format()); 
											 } else {
											 	get_template_part('templates/content', 'fullwidth');
											 }
									}?>
							<?php endwhile; ?>
							<?php if ($wp_query->max_num_pages > 1) : ?>
							        <?php if(function_exists('kad_wp_pagenavi')) { ?>
							              <?php kad_wp_pagenavi(); ?>   
							            <?php } else { ?>      
							              <nav class="post-nav">
							                <ul class="pager">
							                  <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'virtue')); ?></li>
							                  <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'virtue')); ?></li>
							                </ul>
							              </nav>
							            <?php } ?> 
							        <?php endif; ?>
							</div> 
						<?php } else { ?>
						<div class="homecontent clearfix home-margin"> 
							<?php get_template_part('templates/content', 'page'); ?>
						</div>
						<?php 	}
						break;
						case 'block_five':
								get_template_part('templates/home/blog', 'home'); 
						break;
						case 'block_six':
								get_template_part('templates/home/portfolio', 'carousel');		 
						break; 
						case 'block_seven':
								get_template_part('templates/home/icon', 'menu');		 
						break;
						case 'block_twenty':
								get_template_part('templates/home/icon', 'menumock');		 
						break;  
					    }

}
endif; ?>   


</div><!-- /.main -->
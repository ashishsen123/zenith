<div class="grid_sub_6 sub_alpha">
    <div class="footer_widget">
        <?php if (is_active_sidebar('first-footer-widget-area')) : ?>
            <?php dynamic_sidebar('first-footer-widget-area'); ?>
        <?php else : ?>
            <h6><?php _e('Stay In Touch', 'bizway'); ?></h6>
            <ul>
                <li><a href="#"><?php _e('Send Us Email', 'bizway'); ?></a></li>
                <li><a href="#"><?php _e('Follow Us On Twitter', 'bizway'); ?></a></li>
                <li><a href="#"><?php _e('Rss Feed', 'bizway'); ?></a></li>
            </ul>    
        <?php endif; ?> 
    </div>
</div>
<div class="grid_sub_6 sub_middle">
    <div class="footer_widget">   
        <?php if (is_active_sidebar('second-footer-widget-area')) : ?>
            <?php dynamic_sidebar('second-footer-widget-area'); ?>
        <?php else : ?> 
            <h6><?php _e('Contact Details', 'bizway'); ?></h6>
            <?php _e("Address: FM-9, B-Block,  Second Complex Mansarover, Bhopal<br/>
            Contact No : +91-9926465653", "bizway"); ?>
        <?php endif; ?>
    </div>
</div>
<div class="grid_sub_6 sub_middle">
    <div class="footer_widget ">          
        <?php if (is_active_sidebar('third-footer-widget-area')) : ?>
            <?php dynamic_sidebar('third-footer-widget-area'); ?>
        <?php else : ?>
            <h6><?php _e('How To Setup</h6>
                  <p>To setup this widget area, go to appearance settings and navigate to widget option.</p>', 'bizway'); ?>
            <?php endif; ?>
    </div>
</div>
<div class="grid_sub_6 sub_omega">
    <div class="footer_widget last">
        <?php if (is_active_sidebar('fourth-footer-widget-area')) : ?>
            <?php dynamic_sidebar('fourth-footer-widget-area'); ?>
        <?php else : ?>
            <h6><?php _e("Address", "bizway"); ?></h6>
            <p><?php _e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mauris risus.', 'bizway'); ?></p>
        <?php endif; ?>
    </div>
</div>
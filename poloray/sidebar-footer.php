<div class="grid_6 alpha">
    <div class="footer_widget first">
        <?php if (is_active_sidebar('first-footer-widget-area')) : ?>
            <?php dynamic_sidebar('first-footer-widget-area'); ?>
        <?php else : ?>
            <h4><?php _e('About Us', 'poloray'); ?></h4>
            <p><?php _e('A cras tincidunt,  is a  tellus et. Gravida scel sum sed iaculis, is a nunc non nam. Placerat sed hase llus, purus purus elit.', 'poloray'); ?></p>
        <?php endif; ?>
    </div>
</div>
<div class="grid_6">
    <div class="footer_widget">
        <?php if (is_active_sidebar('second-footer-widget-area')) : ?>
            <?php dynamic_sidebar('second-footer-widget-area'); ?>
        <?php else : ?> 
            <h4><?php _e('Archives Widget', 'poloray'); ?></h4>
            <ul>
                <li><a href="#"><?php _e('January', 'poloray'); ?></a></li>
                <li><a href="#"><?php _e('February', 'poloray'); ?></a></li>
                <li><a href="#"><?php _e('March', 'poloray'); ?></a></li>
                <li><a href="#"><?php _e('April', 'poloray'); ?></a></li>
                <li><a href="#"><?php _e('August', 'poloray'); ?></a></li>
            </ul>
        <?php endif; ?>  
    </div>
</div>
<div class="grid_6">
    <div class="footer_widget">
        <?php if (is_active_sidebar('third-footer-widget-area')) : ?>
            <?php dynamic_sidebar('third-footer-widget-area'); ?>
        <?php else : ?>
            <h4><?php _e('Our Services', 'poloray'); ?></h4>
            <ul>
                <li><a href="#"><?php _e('Theme Design', 'poloray'); ?></a></li>
                <li><a href="#"><?php _e('Logo Design', 'poloray'); ?></a></li>
                <li><a href="#"><?php _e('Template Design', 'poloray'); ?></a></li>
                <li><a href="#"><?php _e('PSD Design', 'poloray'); ?></a></li>
                <li><a href="#"><?php _e('Others Themes', 'poloray'); ?></a></li>
            </ul>
        <?php endif; ?>
    </div>
</div>             			
<div class="grid_6 omega">
    <div class="footer_widget last">
        <?php if (is_active_sidebar('fourth-footer-widget-area')) : ?>
            <?php dynamic_sidebar('fourth-footer-widget-area'); ?>
        <?php else : ?>
            <h4><?php _e('Search Site', 'poloray'); ?></h4>
            <form class="searchform" action="#" method="get">
                <input onfocus="if (this.value == 'Search') {
                            this.value = '';
                        }" onblur="if (this.value == '') {
                                    this.value = 'Search';
                                }"  value="Search" type="text" value="" name="s" id="s" />
                <input type="submit" value="" name="submit"/>
            </form>
<?php endif; ?>
    </div>
</div>
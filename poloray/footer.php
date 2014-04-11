<div class="footer_wrapper_top">
    <div class="footer_top_linestrip"></div>
    <div class="container_24">
        <div class="grid_24">
            <div class="footer">
                <?php
                /* A sidebar in the footer? Yep. You can can customize
                 * your footer with four columns of widgets.
                 */
                get_sidebar('footer');
                ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="footer_wrapper_bottom">
    <div class="container_24">
        <div class="grid_24">
            <div class="grid_16 alpha">
                <div class="copyright_left">
                    <a class="tagline" href="<?php echo esc_url(home_url()); ?>"><?php echo get_bloginfo('name'); ?> -
                        <?php bloginfo('description'); ?></a>
                    <ul class="social_logos">
                        <?php if (poloray_get_option('poloray_facebook') != '') { ?>
                            <li><a href="<?php echo esc_url(poloray_get_option('poloray_facebook')); ?>" title="Facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="Facebook" /></a></li>
                        <?php } ?> 
                        <?php if (poloray_get_option('poloray_twitter') != '') { ?>
                            <li><a href="<?php echo esc_url(poloray_get_option('poloray_twitter')); ?>" title="Twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="Twitter" /></a> </li>
                        <?php } ?>  
                        <?php if (poloray_get_option('poloray_yahoo') != '') { ?>
                            <li><a href="<?php echo esc_url(poloray_get_option('poloray_yahoo')); ?>" title="Yahoo"><img src="<?php echo get_template_directory_uri(); ?>/images/yahoo.png" alt="Yahoo" /></a></li>
                        <?php } ?>
                        <?php if (poloray_get_option('poloray_rss') != '') { ?>
                            <li><a href="<?php echo esc_url(poloray_get_option('poloray_rss')); ?>" title="Rss Feed"><img src="<?php echo get_template_directory_uri(); ?>/images/rss.png" alt="Digg Icon" /></a></li>
                        <?php } ?>
                        <?php if (poloray_get_option('poloray_digg') != '') { ?>
                            <li><a href="<?php echo esc_url(poloray_get_option('poloray_digg')); ?>" title="Digg"><img src="<?php echo get_template_directory_uri(); ?>/images/digg.png" alt="Digg icon" /></a></li>
                        <?php } ?>
                        <?php if (poloray_get_option('poloray_pinterest') != '') { ?>
                            <li><a href="<?php echo esc_url(poloray_get_option('poloray_pinterest')); ?>" title="Pinterest"><img src="<?php echo get_template_directory_uri(); ?>/images/pinterest.png" alt="Pinterest icon" /></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="grid_8 omega">
                <div class="copyrightinfo">
                    <?php if (poloray_get_option('poloray_footertext') != '') { ?>
                        <p class="copyright"><?php echo poloray_get_option('poloray_footertext'); ?></p> 
                    <?php } else { ?>
                        <p class="copyright"><a href="http://www.inkthemes.com">Poloray Theme</a> Powered By <a href="http://www.wordpress.org">WordPress</a></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>

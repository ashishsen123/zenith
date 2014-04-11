<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Bizway
 * @since Bizway 1.0
 */
?>

<!--Start Footer Wrapper-->
<div class="footer-wrapper">
    <!--Start Wrapper-->
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
<!--End Wrapper-->
<!--End Footer Wrapper-->
<!--Start Footer Bottom-->
<div class="footer_bottom">
    <!--Start Wrapper-->
    <div class="wrapper">
        <div class="container_24">
            <div class="grid_24">
                <div class="footer_bottom_content">
                    <p class="theme_desc"><?php echo get_bloginfo('title'); ?>-<?php echo get_bloginfo('description'); ?></p>
                    <?php if (bizway_get_option('bizway_footertext') != '') { ?>
                    <p class="copyright"><?php echo esc_attr(bizway_get_option('bizway_footertext')); ?></p> 
                    <?php } else { ?>
                        <p class="copyright"> <?php _e('<a href="http://www.inkthemes.com">BizWay Theme</a> powered by <a href="http://www.wordpress.org">WordPress</a>','bizway'); ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!--End Wrapper-->
</div>
<!--End Footer Bottom-->
<?php wp_footer(); ?>
</body>
</html>
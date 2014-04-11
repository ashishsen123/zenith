<div class="clear"></div>
<!--Start Footer-->
<div class="footer">
    <?php
    /* A sidebar in the footer? Yep. You can can customize
     * your footer with four columns of widgets.
     */
    get_sidebar('footer');
    ?>
</div>
<!--End Footer-->
<div class="clear"></div>
<!--Start Footer bottom-->
<!--Start footer bottom inner-->
<div class="bottom-footer">
    <div class="grid_24">
        <div class="footer_bottom_inner"> 
            <?php if (inkthemes_get_option('inkthemes_footertext') != '') { ?>
                <span class="copyright"><?php echo inkthemes_get_option('inkthemes_footertext'); ?></span> 
            <?php } else { ?>
                <span class="copyright"><a href="http://www.inkthemes.com"><?php _e('Andrina Theme by InkThemes.com','andrina-lite'); ?></a></span>
            <?php } ?>
        </div>
    </div>
</div>
<!--End Footer bottom inner-->
<!--End Footer bottom-->
</div>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>

<div class="grid_6 alpha">
    <div class="widget_inner">
        <?php if (is_active_sidebar('first-footer-widget-area')) : ?>
            <?php dynamic_sidebar('first-footer-widget-area'); ?>       
        <?php endif; ?>
    </div>
</div>
<div class="grid_7">
    <div class="widget_inner">
        <?php if (is_active_sidebar('second-footer-widget-area')) : ?>
            <?php dynamic_sidebar('second-footer-widget-area'); ?>               
        <?php endif; ?>
    </div>
</div>
<div class="grid_11 omega">
    <div class="widget_inner last">
        <?php if (is_active_sidebar('third-footer-widget-area')) : ?>
            <?php dynamic_sidebar('third-footer-widget-area'); ?>               
        <?php endif; ?>
    </div>
</div>
<div class="clear"></div>
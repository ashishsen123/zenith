<!--Start Sidebar-->
<div class="grid_8 omega">
    <div class="sidebar">
        <div class="side_wrapper">
            <?php if (!dynamic_sidebar('primary-widget-area')) : ?>
                <?php get_search_form(); ?>
                <h4>
                    <?php _e('Archives', 'toommorel'); ?>
                </h4>
                <ul>
                    <?php wp_get_archives('type=monthly'); ?>
                </ul>
                <h4>
                    <?php _e('Categories', 'toommorel'); ?>
                </h4>
                <ul>
                    <?php wp_list_categories('title_li'); ?>
                </ul>
            <?php endif; // end primary widget area  ?>
            <?php
            // A second sidebar for widgets, just because.
            if (is_active_sidebar('secondary-widget-area')) :
                ?>
                <?php dynamic_sidebar('secondary-widget-area'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--End Sidebar-->

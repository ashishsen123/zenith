<div class="sidebar">
    <?php if (!dynamic_sidebar('primary-widget-area')) : ?>
        <div class="side-search">
            <?php get_search_form(); ?>
        </div>
        <h3>
            <?php _e('Categories', 'bizway'); ?>
        </h3>
        <ul>
            <?php wp_list_categories('title_li'); ?>
        </ul>
        <?php get_search_form(); ?>
        <h3>
            <?php _e('Archives', 'bizway'); ?>
        </h3>
        <ul>
            <?php wp_get_archives('type=monthly'); ?>
        </ul>
        <div class="side-search">
            <?php get_search_form(); ?>
        </div>
    <?php endif; // end primary widget area ?>
    <?php
// A second sidebar for widgets, just because.
    if (is_active_sidebar('secondary-widget-area')) :
        ?>
        <?php dynamic_sidebar('secondary-widget-area'); ?>
    <?php endif; ?>
</div>
<?php
/**
 * The template for displaying Search Results pages.
 *
 * 
 */
?>
<?php get_header(); ?>  
<div class="heading_container">
  <div class="container_24">
    <div class="grid_24">
      <div class="page-heading">
        <h1 class="page-title"><?php printf(__('Search Results for: %s', 'poloray'), '' . get_search_query() . ''); ?></h1>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div class="page_container">
  <div class="container_24">
    <div class="grid_24">
      <div class="page-content">
        <div class="grid_16 alpha">
          <div class="content-bar">
            <?php if (have_posts()) : ?>               
                <!--Start Post-->
                <?php get_template_part('loop', 'search'); ?>
                <!--End Post-->
            <?php else : ?>
                <article id="post-0" class="post no-results not-found">
                    <header class="entry-header">
                        <h1 class="entry-title">
                            <?php _e('Nothing Found', 'poloray'); ?>
                        </h1>
                    </header>
                    <!-- .entry-header -->
                    <div class="entry-content">
                        <p>
                            <?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'poloray'); ?>
                        </p>
                        <?php get_search_form(); ?>
                    </div>
                    <!-- .entry-content -->
                </article>
            <?php endif; ?>
            <div class="clear"></div>
            <nav id="nav-single"> <span class="nav-previous">
                    <?php next_posts_link(__('&larr; Older posts', 'poloray')); ?>
                </span> <span class="nav-next">
                    <?php previous_posts_link(__('Newer posts &rarr;', 'poloray')); ?>
                </span> </nav>	
          </div>
        </div>
        <div class="grid_8 omega">
          <!--Start Sidebar-->
            <?php get_sidebar(); ?>
          <!--End Sidebar-->
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php get_footer(); ?>
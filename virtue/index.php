  <div id="pageheader" class="titleclass">
    <div class="container">
      <?php get_template_part('templates/page', 'header'); ?>
    </div><!--container-->
  </div><!--titleclass-->
  
    <div id="content" class="container">
      <div class="row">
      <div class="main <?php echo kadence_main_class(); ?>  postlist" role="main">

<?php if (!have_posts()) : ?>
  <div class="alert">
    <?php _e('Sorry, no results were found.', 'virtue'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
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

</div><!-- /.main -->
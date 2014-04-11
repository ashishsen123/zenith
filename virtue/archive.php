  <div id="pageheader" class="titleclass">
    <div class="container">
      <?php get_template_part('templates/page', 'header'); ?>
    </div><!--container-->
  </div><!--titleclass-->
  
    <div id="content" class="container">
      <div class="row">
        <?php global $virtue; if(isset($virtue['blog_archive_full']) && $virtue['blog_archive_full'] == 'full')
        {$summery = 'full'; $postclass = "single-article fullpost";} else {$summery = 'normal'; $postclass = 'postlist';} ?>
      <div class="main <?php echo kadence_main_class(); ?>  <?php echo $postclass .' '. $fullclass; ?>" role="main">

<?php if (!have_posts()) : ?>
  <div class="alert">
    <?php _e('Sorry, no results were found.', 'virtue'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<?php 
      if($summery == 'full') {
               while (have_posts()) : the_post();
                get_template_part('templates/content', 'fullpost');
               endwhile;
             } else {
                while (have_posts()) : the_post(); 
                 get_template_part('templates/content', get_post_format());
                endwhile;
             }

    if ($wp_query->max_num_pages > 1) : ?>
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
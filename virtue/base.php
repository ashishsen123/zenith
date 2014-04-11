<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri() . '/assets/js/vendor/respond.min.js';?>"></script>
    <![endif]-->
<div id="wrapper" class="container">
  <!--[if lt IE 8]><div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</div><![endif]-->

  <?php
    do_action('get_header');
      get_template_part('templates/header');
  ?>

  <div class="wrap contentclass" role="document">

        <?php include kadence_template_path(); ?>
        
      <?php if (kadence_display_sidebar()) : ?>
      <aside class="<?php echo kadence_sidebar_class(); ?> kad-sidebar" role="complementary">
        <div class="sidebar">
          <?php include kadence_sidebar_path(); ?>
        </div><!-- /.sidebar -->
      </aside><!-- /aside -->
      <?php endif; ?>
    </div><!-- /.row-->
    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>
</div><!--Wrapper-->
</body>
</html>

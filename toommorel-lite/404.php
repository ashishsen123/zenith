<?php
/**
 *
 * This is the template for the 404 error page display.
 *
 */
get_header();
?>
<div class="clear"></div>
<div class="content page">
    <h2>404: The Page you are looking for is not found.</h2>
    <h4>You have landed on the Wrong Page..</h4>
    <h4><a href="<?php echo esc_url(home_url('/')); ?>">Click Here to Visit our Home Page</a></h4>
    <h6> Make a Search if you want to find something specific</h6>
 <?php get_search_form(); ?>
</div>
<!--End Content-->
<div class="clear"></div>
<div class="hr_big"></div>
<!--End Content Wrapper-->
</div>
<div class="clear"></div>
<!--End Main_wrapper-->
<?php get_footer(); ?>
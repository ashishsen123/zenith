<?php
/* 	D5 Business Line Theme's Footer
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since D5 Business Line 1.0
*/
?>


</div><!-- container -->


<div id="footer">

<div class="versep"></div>
<div id="footer-content">

<div id="social">
<?php if (of_get_option('facebook-link') !='') : ?>
<a href="<?php echo of_get_option('facebook-link'); ?>" class="facebook-link" target="_blank"></a>
<?php  endif; if (of_get_option('twitter-link') !='') : ?>
<a href="<?php echo of_get_option('twitter-link'); ?>" class="twitter-link" target="_blank"></a>
<?php  endif; if (of_get_option('youtube-link') !='') : ?>
<a href="<?php echo of_get_option('youtube-link'); ?>" class="youtube-link" target="_blank"></a>
<?php  endif; if (of_get_option('li-link') !='') : ?>
<a href="<?php echo of_get_option('li-link'); ?>" class="li-link" target="_blank"></a>
<?php  endif; if (of_get_option('blog-link') !='') : ?>
<a href="<?php echo of_get_option('blog-link'); ?>" class="blog-link" target="_blank"></a>
<?php  endif; ?>
</div>

<?php
   	get_sidebar( 'footer' );
?>

<div id="creditline">&copy;&nbsp;<?php echo date("Y") ?>&nbsp;<?php bloginfo( 'name' );  d5businessline_credit(); ?></div>

<?php wp_footer(); ?> 
</div> <!-- footer-content -->
</div> <!-- footer -->

</body>
</html>
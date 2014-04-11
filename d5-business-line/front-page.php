<?php
/*
	Template Name: Front Page
	D5 Business Line Theme's Front Page to Display the Home Page if Selected
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since D5 Business Line 1.0
*/
?>

<?php get_header(); d5businessline_sworking(); ?>
<h1 id="heading"><?php echo of_get_option('heading_text', 'World class and industry standard IT services are our passion. We build your ideas True'); ?></h1>
<?php get_template_part( 'featured-box' ); ?> 

<?php if (of_get_option('lpost', '1') == '1'): if ( 'posts' == get_option( 'show_on_front' ) ): get_template_part( 'fpost' ); endif; endif;?> 
<div class="content-ver-sep"></div>

<?php if ( of_get_option('bottom-quotation', 'All the developers of D5 Creation have come from the disadvantaged part or group of the society. All have established themselves after a long and hard struggle in their life ----- D5 Creation Team') != '' ) : ?>
<div id="customers-comment">
<blockquote><?php echo of_get_option('bottom-quotation', 'All the developers of D5 Creation have come from the disadvantaged part or group of the society. All have established themselves after a long and hard struggle in their life ----- D5 Creation Team'); ?></blockquote>
</div>
<?php endif; ?>

<?php get_footer(); ?>
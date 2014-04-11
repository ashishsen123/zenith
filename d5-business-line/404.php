<?php

/* 	D5 Business Line Theme's 404 Error Page
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since D5 Business Line 1.0
*/

get_header(); ?>

<h1 class="page-title">Not Found</h1>
<h3 class="arc-src"><span>Apologies, but the page you requested could not be found. Perhaps searching will help.</span></h3>

<?php get_search_form(); ?>
<p><a href="<?php echo home_url(); ?>" title="Browse the Home Page">&laquo; Or Return to the Home Page</a></p><br /><br />

<h2>You can visit the Recent Posts</h2>
<ul>

</ul>

<h2 class="post-title-color">You can also Visit the Following. These are the Featured Contents</h2>
<div class="content-ver-sep"></div><br />
<?php get_template_part( 'featured-box' ); ?>
 
<?php get_footer(); ?>
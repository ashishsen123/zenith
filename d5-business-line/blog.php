<?php 
/* 	Template Name: Blog
	D5 Business Line Theme's Blog Posts Showing Template
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since D5 Business Line 2.1.02
*/

get_header(); ?>
<div id="content">

<?php
$args = array( 'post_type'=> 'post', 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ) );
query_posts( $args ); 

if (have_posts()) : while (have_posts()) : the_post();?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
 <p class="postmetadataw">Posted by: <?php the_author_posts_link() ?> | on <?php the_time('F j, Y'); ?></p>		
 <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
 <div class="content-ver-sep"> </div>
 <div class="entrytext"><?php the_post_thumbnail('thumbnail'); ?>
  <?php the_content('<p class="read-more">Read the rest of this page &raquo;</p>'); ?>
 <div class="clear"> </div>
 <div class="up-bottom-border">
 <p class="postmetadata">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> <?php the_tags('<br />Tags: ', ', ', '<br />'); ?></p>
 </div>
 </div></div>
 
 <?php endwhile; ?>

<div id="page-nav">
<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
<div class="alignright"><?php next_posts_link('Next Entries &raquo;','') ?></div>
</div>
  
 
 <?php  else:  ?>
 
 <h1 class="arc-post-title">Sorry, we couldn't find anything that matched your search.</h1>
		
		<h3 class="arc-src"><span>You Can Try Another Search...</span></h3>
		<?php get_search_form(); ?>
		<p><a href="<?php echo home_url(); ?>" title="Browse the Home Page">&laquo; Or Return to the Home Page</a></p><br />
		<h2 class="post-title-color">You can also Visit the Following. These are the Featured Contents</h2>
		<div class="content-ver-sep"></div><br />
		<?php get_template_part( 'featured-box' ); ?> 
 
<?php endif; wp_reset_query(); ?>
 

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
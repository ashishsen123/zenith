<?php 
/* 	Simplify Theme's part for showing blog or page in the front page
	Copyright: 2012-2013, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/

?>
<div id="f-post-page" > <<< Show Posts >>> </div>
<div id="f-post-page-container" >
<div class="content-ver-sep"></div><br />
<div id="content">
 <?php if (have_posts()) : while (have_posts()) : the_post();?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
 <?php if (!is_page()): ?><p class="postmetadataw">Posted by: <?php the_author_posts_link() ?> | on <?php the_time('F j, Y'); ?></p><?php endif; ?>		
 <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
 <div class="content-ver-sep"> </div>
 <div class="entrytext">
 <?php the_post_thumbnail('thumbnail'); ?>
 <?php if (is_page()): simplify_content(); else : $simplifyExcerptLength = '200'; the_excerpt();  endif;  ?>
 <div class="clear"> </div>
  <?php if (!is_page()): ?><div class="up-bottom-border">
 <p class="postmetadata">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> <?php the_tags('<br />Tags: ', ', ', '<br />'); ?></p>
 </div><?php endif; ?>	
 </div></div>
 
 <?php endwhile; if (!is_page()): ?>

<div id="page-nav">
<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
<div class="alignright"><?php next_posts_link('Next Entries &raquo;','') ?></div>
</div>
 
<?php endif; endif; ?>
 
</div>
<?php get_sidebar(); ?>
<div class="clear"></div><div class="lsep"></div></div>
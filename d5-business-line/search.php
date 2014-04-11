<?php 
/* 	D5 Business Line Theme's Search Page
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since D5 Business Line 1.0
*/

get_header(); ?>

	<?php if (have_posts()) : ?>
		<div id="content">
        <h1 class="arc-post-title">Search Results</h1>
		
		<?php $counter = 0; ?>
		<?php query_posts($query_string . "&posts_per_page=20"); ?>
		<?php while (have_posts()) : the_post();
			if($counter == 0) {
				$numposts = $wp_query->found_posts; // count # of search results ?>
				<h3 class="arc-src"><span>Search Term: </span><?php the_search_query(); ?></h3>
				<h3 class="arc-src"><span>Number of Results: </span><?php echo $numposts; ?></h3><br />
				<?php } //endif ?>
			
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<p class="postmetadataw">Entry Date: <?php the_time('F j, Y'); ?></p>
				<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
				<div class="content-ver-sep"></div>
  				<div class="entrytext">
                <?php the_post_thumbnail('thumbnail'); ?>
  				<?php the_content('<p class="read-more">Read the rest of this page &raquo;</p>'); ?>
 <div class="clear"> </div>
 <div class="up-bottom-border">
 				<p class="postmetadata"><?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> <?php the_tags('<br />Tags: ', ', ', '<br />'); ?></p>
 				</div></div></div>
				
		<?php $counter++; ?>
 		
		<?php endwhile; ?>
		</div>		
		<?php get_sidebar(); ?>
        <?php else: ?>
		<br /><br /><h1 class="arc-post-title">Sorry, we couldn't find anything that matched your search.</h1>
		
		<h3 class="arc-src"><span>You Can Try Another Search...</span></h3>
		<?php get_search_form(); ?>
		<p><a href="<?php echo home_url(); ?>" title="Browse the Home Page">&laquo; Or Return to the Home Page</a></p><br />
		<h2 class="post-title-color">You can also Visit the Following. These are the Featured Contents</h2>
		<div class="content-ver-sep"></div><br />
		<?php get_template_part( 'featured-box' ); ?>

	<?php endif; ?>
	
<?php get_footer(); ?>
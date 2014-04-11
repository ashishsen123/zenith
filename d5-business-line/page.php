<?php
/* 	D5 Business Line Theme's General Page to display all Pages
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since D5 Business Line 1.0
*/

 get_header(); ?>

	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="content-ver-sep"> </div>
            <div class="entrytext">
            <?php the_post_thumbnail('thumbnail'); ?>
				<?php the_content('<p class="read-more">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; ?>
        <div class="clear"> </div>
	<?php edit_post_link('Edit This Entry', '<p>', '</p>'); ?>
	<?php comments_template('', true); ?>
	<?php else: ?>
		<p>Sorry, no pages matched your criteria.</p>
	<?php endif; ?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
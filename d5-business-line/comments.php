<?php
/* 	D5 Business Line Theme's Comments Area for Single Pages
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since D5 Business Line 1.0
*/

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
		return;
	}
?>

<div id="commentsbox">
<?php if ( have_comments() ) : ?>
	<h2 class="comments"><?php comments_number('No Comments', 'One Comment', '% Comments' );?>&nbsp; to &nbsp; <a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
	<ol class="commentlist" <?php comment_class(); ?>>
		<?php wp_list_comments(); ?>
	</ol>
	<div class="comment-nav">
		<div class="floatleft">
			<?php previous_comments_link('Previous Comment') ?>
		</div>
		<div class="floatright">
			<?php next_comments_link('Next Comment') ?>
		</div>
	</div>
<?php else : ?>
	<?php if ( ! comments_open() && ! is_page() ) : ?>
		<p class="watermark">Comments are Closed</p>
	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
	<div id="comment-form">
		<?php comment_form(); ?>
	</div>
<?php endif; ?>
</div>

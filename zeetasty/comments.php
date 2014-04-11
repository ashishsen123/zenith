<?php 
/***
 * Comments Template
 *
 * This template displays the current comments of a post and the comment form
 *
 */

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required()) : ?>
	<p><?php _e('Enter password to view comments.', 'zeeTasty_lang'); ?></p>
<?php return; endif; ?>


<div id="comments">

<?php if ( have_comments() ) : ?>

	<h3 class="comments-title"><?php comments_number( '', __('One comment','zeeTasty_lang'), __('% comments','zeeTasty_lang') );?></h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<div class="comment-pagination clearfix">
		<div class="alignleft"><?php previous_comments_link(); ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	<?php endif; ?>
	
	<ol class="commentlist">
		<?php wp_list_comments( array('avatar_size' => 48)); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<div class="comment-pagination clearfix">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	<?php endif; ?>

 <?php else : ?>

	<?php if ( ! comments_open() and !is_page() ) : ?>
		<p class="nocomments"><?php _e('Comments are closed.', 'zeeTasty_lang'); ?></p>
	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>
	<?php comment_form(array('comment_notes_after' => '')); ?>
<?php endif; ?>

</div>
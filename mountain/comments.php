<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'.'language');?></p>
	<?php
		return;
	}
?>
<?php if ( have_comments() ) : ?>
	<h2 id="comments"><?php comments_number('0 Comments', '1 Comment', '% Comments' );?></h2>

	<ol class="commentlist">
	<?php wp_list_comments(array('avatar_size' => 64)); ?>
	</ol>
 <?php else : ?>
	<?php if ( comments_open() ) : ?>
	 <?php else : ?>
		<p class="nocomments"><?php _e('Comments are closed.','language');?></p>
	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<div id="respond">
<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>
<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php _e('You must be ','language');?><a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e ('logged in','language');?></a><?php _e(' to post a comment.','language');?></p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( is_user_logged_in() ) : ?>
<p><?php _e('Logged in as ','language');?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out &raquo;','language');?></a></p>
<?php else : ?>
<h3><?php _e('Write you response','language');?></h3>
<p><label for="author"><?php _e('Name','language');?></label><br/><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></p>

<p><label for="email"><?php _e('Mail','language');?></label><br/><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></p>

<p><label for="url"><?php _e('Website','language');?></label><br/><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" /></p>

<?php endif; ?>
<p><label for="comment"><?php _e('Your Comment','language');?></label><br/><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif;?>
</div>
<?php endif;?>
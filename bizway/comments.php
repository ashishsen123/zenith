<?php
/**
 * The template for displaying Comments.
 *
 *
 * @package Bizway
 */
?>
<?php
if (post_password_required()) {
    ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'bizway'); ?></p>
    <?php
    return;
}
?>
<!-- You can start editing here. -->
<div id="commentsbox">
    <?php if (have_comments()) : ?>
        <h3 id="comments">
            <?php comments_number('No Responses', 'One Response', '% Responses'); ?>
            <?php _e('so far.', 'bizway'); ?></h3>
        <ol class="commentlist">
            <?php wp_list_comments(); ?>
        </ol>
        <div class="comment-nav">
            <div class="alignleft">
                <?php previous_comments_link() ?>
            </div>
            <div class="alignright">
                <?php next_comments_link() ?>
            </div>
        </div>
    <?php else : // this is displayed if there are no comments so far ?>
        <?php if (comments_open()) : ?>
            <!-- If comments are open, but there are no comments. -->
        <?php else : // comments are closed  ?>
            <?php if (!is_page()) : ?>
                <!-- If comments are closed. -->
                <p class="nocomments"><?php _e('Comments are closed.', 'bizway'); ?></p>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (comments_open()) : ?>
        <div id="comment-form">
            <div id="respond" class="rounded">
                <div class="cancel-comment-reply"> <small>
                        <?php cancel_comment_reply_link(); ?>
                    </small> </div>
                <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                    <p><?php _e('You must be', 'bizway'); ?> <a href="<?php echo wp_login_url(get_permalink()); ?>"><?php _e('logged in', 'bizway'); ?></a> <?php _e('to post a comment.', 'bizway'); ?></p>
                <?php else : ?>
                    <div id="comment-form">
                        <?php comment_form(); ?>
                    </div>
                <?php endif; // If registration required and not logged in  ?>
            </div>
        </div>
    <?php endif; // if you delete this the sky will fall on your head  ?>
</div>

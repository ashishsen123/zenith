<?php
/**
 * Comment Template
 *
 * The comment template displays an individual comment. This can be overwritten by templates specific
 * to the comment type (comment.php, comment-{$comment_type}.php, comment-pingback.php, 
 * comment-trackback.php) in a child theme.
 *
 * @package Murmur
 * @subpackage Template
 * @since 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2012, Tung Do
 * @link http://devpress.com/themes/murmur/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

	global $post, $comment;
?>

	<li id="comment-<?php comment_ID(); ?>" class="<?php hybrid_comment_class(); ?>">

		<?php do_atomic( 'before_comment' ); // murmur_before_comment ?>
	
		<div class="comment-wrap">
		
			<?php do_atomic( 'open_comment' ); // murmur_open_comment ?>

			<div class="comment-header">
				<?php echo hybrid_avatar(); ?>

				<?php echo apply_atomic_shortcode( 'comment_meta', '<div class="comment-meta">[comment-author] [comment-published] [comment-permalink before=" . "] [comment-edit-link before=" . "] [comment-reply-link]</div>' ); ?>
			</div><!-- .comment-header -->

			<div class="comment-content comment-text">
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<?php echo apply_atomic_shortcode( 'comment_moderation', '<p class="alert moderation">' . __( 'Your comment is awaiting moderation.', 'murmur' ) . '</p>' ); ?>
				<?php endif; ?>

				<?php comment_text( $comment->comment_ID ); ?>
			</div><!-- .comment-content .comment-text -->

			<?php do_atomic( 'close_comment' ); // murmur_close_comment ?>

		</div><!-- .comment-wrap -->

		<?php do_atomic( 'after_comment' ); // murmur_after_comment ?>

	<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
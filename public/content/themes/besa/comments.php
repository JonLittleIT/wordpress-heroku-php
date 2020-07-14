<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
        <h3 class="comments-title"><?php comments_number( esc_html__('0 Comments', 'besa'), esc_html__('1 Comment', 'besa'), esc_html__('% Comments', 'besa') ); ?></h3>
		<?php besa_tbay_comment_nav(); ?>
		<ul class="comment-list">
			<?php wp_list_comments('callback=besa_tbay_list_comment'); ?>
		</ul><!-- .comment-list -->

		<?php besa_tbay_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'besa' ); ?></p>
	<?php endif; ?>

	<?php
		$args = wp_parse_args( array() );
		if ( ! isset( $args['format'] ) ) {
			$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
		}
		$html5    = 'html5' === $args['format'];
        $comment_args = array(
        'title_reply'=> esc_html__('Leave a Reply','besa'),
        'comment_field' => '<p class="comment-form-comment form-group"><label class="control-label">' . esc_html__( 'Your Comment:', 'besa' ) .'</label><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
        'fields' => apply_filters(
        	'comment_form_default_fields',
        		array(
                    'author' => '<p class="comment-form-author form-group col-md-4">
								<label class="control-label">' . esc_html__( 'Name:', 'besa' ) .'</label>
					            <input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
                    'email' => '<p class="comment-form-email form-group col-md-4">
								<label class="control-label">' . esc_html__( 'Email:', 'besa' ) .'</label>
					            <input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
					'url'    => '<p class="comment-form-url col-md-4"><label for="url">' . esc_html__( 'Website', 'besa' ) . '</label> ' .
					'<input id="url" class="form-control" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',
                )
			),
            'label_submit' => esc_html__('submit', 'besa'),
			'comment_notes_before' => '<div class="form-group h-info">'.esc_html__('Your email address will not be published. Required fields are makes.','besa').'</div>',
			'comment_notes_after' => '',
        );
    ?>

	<?php besa_tbay_comment_form($comment_args); ?>
</div><!-- .comments-area -->

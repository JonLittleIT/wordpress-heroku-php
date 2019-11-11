<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aqura
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

global $user_identity;
$aqura_comment_form__commenter = wp_get_current_commenter();
$aqura_comment_form__req = get_option( 'require_name_email' );
$aqura_comment_form__aria_req = ( $aqura_comment_form__req ? " aria-required='true'" : '' );
$aqura_comment_form__texarea = '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_html__('Your comment ', 'aqura') . '"/></textarea>';

$aqura_comment_form__args = array(
	'id_form'				=> 'commentform',
	'id_submit'				=> 'submit',
	'class_submit'			=> 'submit',
	'name_submit'			=> 'submit',
	'title_reply'			=> esc_html__( 'Leave a comment' , 'aqura' ),
	'title_reply_to'		=> esc_html__( 'Leave a comment to %s' , 'aqura' ),
	'cancel_reply_link' 	=> esc_html__( 'Cancel Reply', 'aqura' ),
	'label_submit'			=> esc_html__( 'Submit Comment' , 'aqura' ),
	'format'				=> 'xhtml',
	'comment_field' 		=> '',
	'comment_notes_before' 	=> '',
	'fields' 				=> array(
		'author' 		=> '<input id="author" name="author" type="text" value="' . esc_attr($aqura_comment_form__commenter['comment_author']) . '" ' . $aqura_comment_form__aria_req . ' placeholder="' . esc_html__('Name... ', 'aqura') . '" />',
		'email' 		=> '<input id="email" name="email" type="text" value="' . esc_attr($aqura_comment_form__commenter['comment_author_email']) . '" ' . $aqura_comment_form__aria_req . ' placeholder="' . esc_html__('Email... ', 'aqura') . '"/>',
		'website' 		=> '<input id="website" name="website" type="text" value="' . esc_attr($aqura_comment_form__commenter['comment_author_email']) . '" ' . $aqura_comment_form__aria_req . ' placeholder="' . esc_html__('Website... ', 'aqura') . '"/>',
		'comment_field' => $aqura_comment_form__texarea,
	),
	'logged_in_as' 			=> '<p class="logged-in-as">' . sprintf( esc_html__('Logged in as ', 'aqura') . '<a href="%1$s">%2$s</a>. <a href="%3$s" title="' . esc_html__('Log out of this account ', 'aqura') . '">' . esc_html__('Log out?', 'aqura') . '</a>', admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>' . $aqura_comment_form__texarea
); ?>

	<div class="form-type-1" id="comments">
		<div class="comment-respond">
		<?php
		// You can start editing here -- including this comment!
		if ( have_comments() ) : ?>
			<h3 class="comments-title">
				<?php
				$aqura_comment_form__comment_count = get_comments_number();
				echo esc_html( $aqura_comment_form__comment_count ) . ' ';
				if ( '1' === $aqura_comment_form__comment_count ) {
					/* translators: 1: title. */
					esc_html_e( 'Comment' , 'aqura' );
				} else {
					esc_html_e( 'Comments' , 'aqura' );
				}
				?>
			</h3><!-- .comments-title -->

			<?php the_comments_navigation(); ?>

			<div class="comments-section">
				<ul class="comments-list pingback">
					<?php wp_list_comments( 'type=pingback&callback=aqura_comment&short_ping=true' ); ?>
				</ul>
				<ul class="comments-list">
					<?php
						wp_list_comments( 'type=comment&callback=aqura_comment' );
					?>
				</ul><!-- .comment-list -->
			</div>

			<?php the_comments_navigation();

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'aqura' ); ?></p>
			<?php
			endif;

		endif; // Check for have_comments().

		comment_form($aqura_comment_form__args);
		?>

		</div>
	</div>

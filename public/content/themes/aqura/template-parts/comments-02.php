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
$aqura_comment_form__texarea = '<div class="col-md-12 pl"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true" placeholder="' . esc_html__('Your comment ', 'aqura') . '"/></textarea></div>';

$aqura_comment_form__args = array(
	'id_form'				=> 'commentform',
	'id_submit'				=> 'submit',
	'class_submit'			=> 'submit',
	'name_submit'			=> 'submit',
	'title_reply'			=> esc_html__( 'Leave a reply' , 'aqura' ),
	'title_reply_to'		=> esc_html__( 'Leave a reply to %s' , 'aqura' ),
	'cancel_reply_link' 	=> esc_html__( 'Cancel Reply', 'aqura' ),
	'label_submit'			=> esc_html__( 'Post Comment' , 'aqura' ),
	'format'				=> 'xhtml',
	'comment_field' 		=> '',
	'comment_notes_before' 	=> '',
	'fields' 				=> array(
		'comment_field' => $aqura_comment_form__texarea,
		'author' 		=> '<div class="col-md-4 pl"><input id="author" name="author" type="text" value="' . esc_attr($aqura_comment_form__commenter['comment_author']) . '" ' . $aqura_comment_form__aria_req . ' placeholder="' . esc_html__('Name... ', 'aqura') . '" /></div>',
		'email' 		=> '<div class="col-md-4"><input id="email" name="email" type="text" value="' . esc_attr($aqura_comment_form__commenter['comment_author_email']) . '" ' . $aqura_comment_form__aria_req . ' placeholder="' . esc_html__('Email... ', 'aqura') . '"/></div>',
		'website' 		=> '<div class="col-md-4"><input id="website" name="website" type="text" value="' . esc_attr($aqura_comment_form__commenter['comment_author_email']) . '" ' . $aqura_comment_form__aria_req . ' placeholder="' . esc_html__('Website... ', 'aqura') . '"/></div>',
	),
	'logged_in_as' 			=> '<p class="logged-in-as">' . sprintf( esc_html__('Logged in as ', 'aqura') . '<a href="%1$s">%2$s</a>. <a href="%3$s" title="' . esc_html__('Log out of this account ', 'aqura') . '">' . esc_html__('Log out?', 'aqura') . '</a>', admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>' . $aqura_comment_form__texarea
); ?>

	<div class="form-type-2" id="comments">
		<div class="comment-respond">
			<div class="trigger-form">
				<span>
					<i class="fa fa-commenting" aria-hidden="true"></i>
				</span>
				<a>
					<?php echo esc_html__( 'Responses' , 'aqura' ); ?>
				</a>
			</div>
			<?php

			comment_form($aqura_comment_form__args);

			// You can start editing here -- including this comment!
			if ( have_comments() ) : ?>

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
			?>

		</div>
	</div>

<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php
if ( post_password_required() ) {
	return; }
?>

<div id="comments" class="comments-area animate-item slideInUp">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>

		<div class="block-title">
			<h3 class="comments-title">
				<?php
				$beehive_comment_count = get_comments_number();
				if ( 1 === $beehive_comment_count ) {
					esc_html_e( 'One Comment', 'beehive' );
				} else {
					printf( // WPCS: XSS OK.
						// translators: 1: comment count number, 2: title.
						esc_html( _nx( '%1$s Comment', '%1$s Comments', $beehive_comment_count, 'comments title', 'beehive' ) ),
						number_format_i18n( $beehive_comment_count )
					);
				}
				?>
			</h3>
		</div>

		<div class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'       => 'div',
						'short_ping'  => true,
						'avatar_size' => 50,
					)
				);
			?>
		</div><!-- .comment-list -->

		<?php
		the_comments_pagination(
			array(
				'prev_text' => '<i class="icon ion-android-arrow-back"></i>',
				'next_text' => '<i class="icon ion-android-arrow-forward"></i>',
			)
		);

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
		<div class="message">
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'beehive' ); ?></p>
		</div>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(
		array(
			'id_form'            => 'beehive-comment-form',
			'title_reply_before' => '<div class="block-title"><h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h3></div>',
		)
	);
	?>

</div><!-- #comments -->

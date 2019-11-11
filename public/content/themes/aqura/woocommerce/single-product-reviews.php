<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     5.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
				/* translators: 1: reviews count 2: product name */
				printf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'aqura' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
			} else {
				_e( 'Reviews', 'aqura' );
			}
		?></h2>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'aqura' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper" class="form-type-4">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? '' : '',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'aqura' ),
						'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
						'title_reply_after'    => '</span>',
						'class_form'		   => 'omment-form form-type-4 clearfix',
						'comment_notes_after'  => '',
						'submit_button'		   => '<input name="%1$s" type="submit" class="%3$s" value="%4$s" />',
						'fields'               => array(
							'author' => '<input id="author" name="author" type="text" class="cfield-name" placeholder="' . esc_html__( "Your name" , "aqura" ) . '" value="' . esc_attr( $commenter["comment_author"] ) . '" aria-required="true" required>',
							'email'  => '<input id="email" name="email" type="email" value="' . esc_attr( $commenter["comment_author_email"] ) . '" class="cfield-email" placeholder="' . esc_html__( "Your E-mail address"  , "aqura"  ) . '" aria-required="true" required>',
						),
						'label_submit'  => __( 'Submit', 'aqura' ),
						'logged_in_as'  => '',
						'comment_field' => '',
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'aqura' ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><h4>' . esc_html__( 'Your rating', 'aqura' ) . '</h4><select name="rating" id="rating" aria-required="true" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'aqura' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'aqura' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'aqura' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'aqura' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'aqura' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'aqura' ) . '</option>
						</select></div>';
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment form-type-4"><textarea id="comment" name="comment" rows="8" aria-required="true" placeholder="' . esc_html__( 'Enter your review here' , 'aqura' ) . '" required></textarea></p>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'aqura' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>

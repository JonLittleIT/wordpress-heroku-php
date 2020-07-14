<?php
/**
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Woohoo News Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$bdaia_p_author_name        = woohoo_get_option( 'bdaia_p_author_name'       );
$bdaia_p_date               = woohoo_get_option( 'bdaia_p_date'              );
$bdaia_p_time_read          = woohoo_get_option( 'bdaia_p_time_read'         );
$bdaia_p_post_views         = woohoo_get_option( 'bdaia_p_post_views'        );
$bdaia_p_post_like          = woohoo_get_option( 'bdaia_p_post_like'         );
$bdaia_p_comment_count      = woohoo_get_option( 'bdaia_p_comment_count'     ); ?>

<div class="bdaia-meta-info">

	<?php if( $bdaia_p_author_name ) : ?>
		<div class="bdaia-post-author-name">
			<?php woohoo_tr( 'By' ); ?>
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a>

			<?php if ( get_the_author_meta( 'twitter' ) ){ ?>
				<a href="https://twitter.com/<?php echo get_the_author_meta( 'twitter' ); ?>" target="_blank">
					<span class="bdaia-io bdaia-io-twitter"></span>
				</a>
			<?php } ?>
		</div>
	<?php endif; ?>

	<?php if( $bdaia_p_date ) : ?>
		<div class="bdaia-post-date"><span class='bdaia-io bdaia-io-calendar'></span><?php woohoo_tr( 'Posted on' ); ?>&nbsp;<?php woohoo_get_time(); ?></div>
	<?php endif; ?>

	<?php if( $bdaia_p_time_read ) : ?>
		<div class="bdaia-post-time-read"><span class='bdaia-io bdaia-io-clock'></span><?php woohoo_post_read_time(); ?></div>
	<?php endif; ?>

	<?php if( $bdaia_p_comment_count ) : ?>
		<div class="bdaia-post-comment"><span class='bdaia-io bdaia-io-bubbles4'></span><?php comments_popup_link( '0', '1', '%' ); ?></div>
	<?php endif; ?>

	<?php if( $bdaia_p_post_like ) : ?>
		<div class="bdaia-post-like"><?php echo woohoo_getPostLikeLink( get_the_ID() ); ?></div>
	<?php endif; ?>

	<?php if( $bdaia_p_post_views ) : ?>
		<div class="bdaia-post-view">
			<span class='bdaia-io bdaia-io-eye4'></span>
			<?php echo woohoo_get_views(); ?>
		</div>
	<?php endif; ?>

</div>
<!-- END Meta Info. -->
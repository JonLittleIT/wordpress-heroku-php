<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// Post Sharing.
function woohoo_get_post_sharing( $pos = '' ){

	global $post;

	$pos_class = "";
	if( $pos == 'top' ) $pos_class = "top";
	elseif( $pos == 'bottom' ) $pos_class = "bottom";

	$permalink  = get_permalink( get_the_ID() );
	$titleget   = get_the_title();

	if( woohoo_get_option( 'social_lang_type' ) ){
		$social_lang_type = woohoo_get_option( 'social_lang_type' );
	}
	else {
		$social_lang_type ='en-US';
	}
?>
<div class="bdaia-post-sharing bdaia-post-sharing-<?php echo $pos_class; ?>">

	<ul>
		<?php if( woohoo_get_option( 'sharing_facebook' ) ): ?>
			<li class="facebook">
				<a  title="facebook" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink);?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink);?>">
					<span class="bdaia-io bdaia-io-facebook"></span>
					<span><?php woohoo_tr( 'Share on' ); ?> Facebook</span>
				</a>
			</li>
		<?php endif; ?>

		<?php if( woohoo_get_option( 'sharing_twitter' ) ): ?>
			<li class="twitter">
				<a  title="twitter" onClick="window.open('http://twitter.com/share?url=<?php echo esc_url($permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php echo esc_url($permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>">
					<span class="bdaia-io bdaia-io-twitter"></span>
					<span><?php woohoo_tr( 'Share on' ); ?> Twitter</span>
				</a>
			</li>
		<?php endif; ?>

		<?php if( woohoo_get_option( 'sharing_google' ) ): ?>
			<li class="google">
				<a  title="google" onClick="window.open('https://plus.google.com/share?url=<?php echo esc_url($permalink); ?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="https://plus.google.com/share?url=<?php echo esc_url($permalink); ?>">
					<span class="bdaia-io bdaia-io-google-plus"></span>
					<span><?php woohoo_tr( 'Share on' ); ?> Google+</span>
				</a>
			</li>
		<?php endif; ?>

		<?php if( woohoo_get_option( 'sharing_reddit' ) ): ?>
			<li class="reddit">
				<a  title="reddit" onClick="window.open('http://reddit.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>','Reddit','width=617,height=514,left='+(screen.availWidth/2-308)+',top='+(screen.availHeight/2-257)+''); return false;" href="http://reddit.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>">
					<span class="bdaia-io bdaia-io-reddit"></span>
					<span><?php woohoo_tr( 'Share on' ); ?> Reddit</span>
				</a>
			</li>
		<?php endif; ?>

		<?php if( woohoo_get_option( 'sharing_pinterest' ) ): ?>
			<li class="pinterest">
				<?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

				<a title="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink() ); ?>&amp;description=<?php echo urlencode( $post->post_title ); ?>&amp;media=<?php echo urlencode( $full_image[0] ); ?>">
					<span class="bdaia-io bdaia-io-social-pinterest"></span>
					<span><?php woohoo_tr( 'Share on' ); ?> Pinterest</span>
				</a>
			</li>
		<?php endif; ?>

		<?php if( woohoo_get_option( 'sharing_linkedin' ) ): ?>
			<li class="linkedin">
				<a  title="linkedin" onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>">
					<span class="bdaia-io bdaia-io-linkedin2"></span>
					<span><?php woohoo_tr( 'Share on' ); ?> Linkedin</span>
				</a>
			</li>
		<?php endif; ?>

		<?php if( woohoo_get_option( 'sharing_tumblr' ) ): ?>
			<li class="tumblr">
				<?php
				$str = $permalink;
				$str = preg_replace('#^https?://#', '', $str);
				?>
				<a  title="tumblr" onClick="window.open('http://www.tumblr.com/share/link?url=<?php echo $str; ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>','Tumblr','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.tumblr.com/share/link?url=<?php echo $str; ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>">
					<span class="bdaia-io bdaia-io-tumblr"></span>
					<span><?php woohoo_tr( 'Share on' ); ?> Tumblr</span>
				</a>
			</li>
		<?php endif; ?>

		<li class="whatsapp">
			<?php echo woohoo_whatsapp_button(); ?>
		</li>

		<li class="telegram">
			<?php echo woohoo_telegram_button(); ?>
		</li>
	</ul>
</div>
<!-- END Post Sharing -->
<?php } ?>
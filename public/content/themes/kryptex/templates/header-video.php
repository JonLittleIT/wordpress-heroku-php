<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.14
 */
$kryptex_header_video = kryptex_get_header_video();
$kryptex_embed_video = '';
if (!empty($kryptex_header_video) && !kryptex_is_from_uploads($kryptex_header_video)) {
	if (kryptex_is_youtube_url($kryptex_header_video) && preg_match('/[=\/]([^=\/]*)$/', $kryptex_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$kryptex_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($kryptex_header_video) . '[/embed]' ));
			$kryptex_embed_video = kryptex_make_video_autoplay($kryptex_embed_video);
		} else {
			$kryptex_header_video = str_replace('/watch?v=', '/embed/', $kryptex_header_video);
			$kryptex_header_video = kryptex_add_to_url($kryptex_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$kryptex_embed_video = '<iframe src="' . esc_url($kryptex_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php kryptex_show_layout($kryptex_embed_video); ?></div><?php
	}
}
?>
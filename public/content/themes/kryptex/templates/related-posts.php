<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

$kryptex_link = get_permalink();
$kryptex_post_format = get_post_format();
$kryptex_post_format = empty($kryptex_post_format) ? 'standard' : str_replace('post-format-', '', $kryptex_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($kryptex_post_format) ); ?>><?php
	kryptex_show_post_featured(array(
		'thumb_size' => kryptex_get_thumb_size( (int) kryptex_get_theme_option('related_posts') == 1 ? 'huge' : 'big' ),
		'show_no_image' => false,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">'.wp_kses_post(kryptex_get_post_categories('')).'</div>'
							. '<h6 class="post_title entry-title"><a href="'.esc_url($kryptex_link).'">'.esc_html(get_the_title()).'</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="'.esc_url($kryptex_link).'">'.wp_kses_data(kryptex_get_date()).'</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>
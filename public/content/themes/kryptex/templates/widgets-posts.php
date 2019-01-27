<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

$kryptex_post_id    = get_the_ID();
$kryptex_post_date  = kryptex_get_date();
$kryptex_post_title = get_the_title();
$kryptex_post_link  = get_permalink();
$kryptex_post_author_id   = get_the_author_meta('ID');
$kryptex_post_author_name = get_the_author_meta('display_name');
$kryptex_post_author_url  = get_author_posts_url($kryptex_post_author_id, '');

$kryptex_args = get_query_var('kryptex_args_widgets_posts');
$kryptex_show_date = isset($kryptex_args['show_date']) ? (int) $kryptex_args['show_date'] : 1;
$kryptex_show_image = isset($kryptex_args['show_image']) ? (int) $kryptex_args['show_image'] : 1;
$kryptex_show_author = isset($kryptex_args['show_author']) ? (int) $kryptex_args['show_author'] : 1;
$kryptex_show_counters = isset($kryptex_args['show_counters']) ? (int) $kryptex_args['show_counters'] : 1;
$kryptex_show_categories = isset($kryptex_args['show_categories']) ? (int) $kryptex_args['show_categories'] : 1;

$kryptex_output = kryptex_storage_get('kryptex_output_widgets_posts');

$kryptex_post_counters_output = '';
if ( $kryptex_show_counters ) {
	$kryptex_post_counters_output = '<span class="post_info_item post_info_counters">'
								. kryptex_get_post_counters('comments')
							. '</span>';
}


$kryptex_output .= '<article class="post_item with_thumb">';

if ($kryptex_show_image) {
	$kryptex_post_thumb = get_the_post_thumbnail($kryptex_post_id, kryptex_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($kryptex_post_thumb) $kryptex_output .= '<div class="post_thumb">' . ($kryptex_post_link ? '<a href="' . esc_url($kryptex_post_link) . '">' : '') . ($kryptex_post_thumb) . ($kryptex_post_link ? '</a>' : '') . '</div>';
}

$kryptex_output .= '<div class="post_content">'
			. ($kryptex_show_categories
					? '<div class="post_categories">'
						. kryptex_get_post_categories()
						. $kryptex_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($kryptex_post_link ? '<a href="' . esc_url($kryptex_post_link) . '">' : '') . ($kryptex_post_title) . ($kryptex_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('kryptex_filter_get_post_info',
								'<div class="post_info">'
									. ($kryptex_show_date
										? '<span class="post_info_item post_info_posted">'
											. ($kryptex_post_link ? '<a href="' . esc_url($kryptex_post_link) . '" class="post_info_date">' : '')
											. esc_html($kryptex_post_date)
											. ($kryptex_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($kryptex_show_author
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'kryptex') . ' '
											. ($kryptex_post_link ? '<a href="' . esc_url($kryptex_post_author_url) . '" class="post_info_author">' : '')
											. esc_html($kryptex_post_author_name)
											. ($kryptex_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. (!$kryptex_show_categories && $kryptex_post_counters_output
										? $kryptex_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
kryptex_storage_set('kryptex_output_widgets_posts', $kryptex_output);
?>
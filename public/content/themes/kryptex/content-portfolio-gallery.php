<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

$kryptex_blog_style = explode('_', kryptex_get_theme_option('blog_style'));
$kryptex_columns = empty($kryptex_blog_style[1]) ? 2 : max(2, $kryptex_blog_style[1]);
$kryptex_post_format = get_post_format();
$kryptex_post_format = empty($kryptex_post_format) ? 'standard' : str_replace('post-format-', '', $kryptex_post_format);
$kryptex_animation = kryptex_get_theme_option('blog_animation');
$kryptex_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($kryptex_columns).' post_format_'.esc_attr($kryptex_post_format) ); ?>
	<?php echo (!kryptex_is_off($kryptex_animation) ? ' data-animation="'.esc_attr(kryptex_get_animation_classes($kryptex_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($kryptex_image[1]) && !empty($kryptex_image[2])) echo intval($kryptex_image[1]) .'x' . intval($kryptex_image[2]); ?>"
	data-src="<?php if (!empty($kryptex_image[0])) echo esc_url($kryptex_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$kryptex_image_hover = 'icon';	//kryptex_get_theme_option('image_hover');
	if (in_array($kryptex_image_hover, array('icons', 'zoom'))) $kryptex_image_hover = 'dots';
	$kryptex_components = kryptex_is_inherit(kryptex_get_theme_option_from_meta('meta_parts'))
								? 'categories,date,counters,share'
								: kryptex_array_get_keys_by_value(kryptex_get_theme_option('meta_parts'));
	$kryptex_counters = kryptex_is_inherit(kryptex_get_theme_option_from_meta('counters'))
								? 'comments'
								: kryptex_array_get_keys_by_value(kryptex_get_theme_option('counters'));
	kryptex_show_post_featured(array(
		'hover' => $kryptex_image_hover,
		'thumb_size' => kryptex_get_thumb_size( strpos(kryptex_get_theme_option('body_style'), 'full')!==false || $kryptex_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($kryptex_components)
										? kryptex_show_post_meta(apply_filters('kryptex_filter_post_meta_args', array(
											'components' => $kryptex_components,
											'counters' => $kryptex_counters,
											'seo' => false,
											'echo' => false
											), $kryptex_blog_style[0], $kryptex_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'kryptex') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>
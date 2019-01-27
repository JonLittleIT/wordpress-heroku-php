<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($kryptex_columns).' post_format_'.esc_attr($kryptex_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!kryptex_is_off($kryptex_animation) ? ' data-animation="'.esc_attr(kryptex_get_animation_classes($kryptex_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$kryptex_image_hover = kryptex_get_theme_option('image_hover');
	// Featured image
	kryptex_show_post_featured(array(
		'thumb_size' => kryptex_get_thumb_size(strpos(kryptex_get_theme_option('body_style'), 'full')!==false || $kryptex_columns < 3
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $kryptex_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $kryptex_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>
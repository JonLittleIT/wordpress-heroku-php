<?php
/**
 * The template to display the featured image in the single post
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

if ( get_query_var('kryptex_header_image')=='' && is_singular() && has_post_thumbnail() && in_array(get_post_type(), array('post', 'page')) )  {
	$kryptex_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if (!empty($kryptex_src[0])) {
		kryptex_sc_layouts_showed('featured', true);
		?><div class="sc_layouts_featured with_image <?php echo esc_attr(kryptex_add_inline_css_class('background-image:url('.esc_url($kryptex_src[0]).');')); ?>"></div><?php
	}
}
?>
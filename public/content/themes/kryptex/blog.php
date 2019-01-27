<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$kryptex_content = '';
$kryptex_blog_archive_mask = '%%CONTENT%%';
$kryptex_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $kryptex_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($kryptex_content = apply_filters('the_content', get_the_content())) != '') {
		if (($kryptex_pos = strpos($kryptex_content, $kryptex_blog_archive_mask)) !== false) {
			$kryptex_content = preg_replace('/(\<p\>\s*)?'.$kryptex_blog_archive_mask.'(\s*\<\/p\>)/i', $kryptex_blog_archive_subst, $kryptex_content);
		} else
			$kryptex_content .= $kryptex_blog_archive_subst;
		$kryptex_content = explode($kryptex_blog_archive_mask, $kryptex_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) kryptex_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$kryptex_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$kryptex_args = kryptex_query_add_posts_and_cats($kryptex_args, '', kryptex_get_theme_option('post_type'), kryptex_get_theme_option('parent_cat'));
$kryptex_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($kryptex_page_number > 1) {
	$kryptex_args['paged'] = $kryptex_page_number;
	$kryptex_args['ignore_sticky_posts'] = true;
}
$kryptex_ppp = kryptex_get_theme_option('posts_per_page');
if ((int) $kryptex_ppp != 0)
	$kryptex_args['posts_per_page'] = (int) $kryptex_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($kryptex_args);


// Add internal query vars in the new query!
if (is_array($kryptex_content) && count($kryptex_content) == 2) {
	set_query_var('blog_archive_start', $kryptex_content[0]);
	set_query_var('blog_archive_end', $kryptex_content[1]);
}

get_template_part('index');
?>
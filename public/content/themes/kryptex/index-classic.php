<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

kryptex_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	kryptex_show_layout(get_query_var('blog_archive_start'));

	$kryptex_classes = 'posts_container '
						. (substr(kryptex_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap columns_padding_bottom' : 'masonry_wrap');
	$kryptex_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$kryptex_sticky_out = kryptex_get_theme_option('sticky_style')=='columns'
							&& is_array($kryptex_stickies) && count($kryptex_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($kryptex_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$kryptex_sticky_out) {
		if (kryptex_get_theme_option('first_post_large') && !is_paged() && !in_array(kryptex_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($kryptex_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($kryptex_sticky_out && !is_sticky()) {
			$kryptex_sticky_out = false;
			?></div><div class="<?php echo esc_attr($kryptex_classes); ?>"><?php
		}
		get_template_part( 'content', $kryptex_sticky_out && is_sticky() ? 'sticky' : 'classic' );
	}
	
	?></div><?php

	kryptex_show_pagination();

	kryptex_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>
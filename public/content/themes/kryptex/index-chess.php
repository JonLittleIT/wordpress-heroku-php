<?php
/**
 * The template for homepage posts with "Chess" style
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

kryptex_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	kryptex_show_layout(get_query_var('blog_archive_start'));

	$kryptex_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$kryptex_sticky_out = kryptex_get_theme_option('sticky_style')=='columns'
							&& is_array($kryptex_stickies) && count($kryptex_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($kryptex_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$kryptex_sticky_out) {
		?><div class="chess_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($kryptex_sticky_out && !is_sticky()) {
			$kryptex_sticky_out = false;
			?></div><div class="chess_wrap posts_container"><?php
		}
		get_template_part( 'content', $kryptex_sticky_out && is_sticky() ? 'sticky' :'chess' );
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
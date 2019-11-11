<?php
/**
 * The template for displaying all single album
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Aqura
 */

get_header();

$aqura_album_layout = rwmb_meta( 'aqura_album_layout__layout');

if ( ( rwmb_meta( 'aqura_white_header_options__color_checkbox') !== null ) && ( rwmb_meta( 'aqura_white_header_options__color_checkbox' ) == 'dark' ) ): ?>
	<div class="aqura-dark-header-is-displayed"></div>
<?php endif;

if ( $aqura_album_layout != '2' ):

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'album-01' );

	endwhile;

else:

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'album-02' );

	endwhile;

endif;

get_footer();

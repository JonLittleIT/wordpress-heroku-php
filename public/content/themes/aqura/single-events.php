<?php
/**
 * The template for displaying the event
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Aqura
 */

get_header();

if ( ( rwmb_meta( 'aqura_white_header_options__color_checkbox') !== null ) && ( rwmb_meta( 'aqura_white_header_options__color_checkbox' ) == 'dark' ) ): ?>
	<div class="aqura-dark-header-is-displayed"></div>
<?php endif;

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content', 'events-01' );

endwhile;

get_footer();

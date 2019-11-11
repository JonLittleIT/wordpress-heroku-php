<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Aqura
 */

get_header(); ?>

	<?php aqura_header_image(esc_html__( 'Oops! That page can&rsquo;t be found.', 'aqura' ), esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'aqura' ), $aqura_data['aqura_header__header_image__view_more_text'], $aqura_data['aqura_header__header_image__image']['url']); ?>

<?php
get_footer();

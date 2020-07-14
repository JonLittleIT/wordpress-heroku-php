<?php
/**
 * The template for adverts taxonomy
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/before-template' ); ?>

<?php
if ( have_posts() ) :
	?>

	<?php
	global $wp_query;
	remove_filter( 'the_content', 'adverts_the_content' );
	echo shortcode_adverts_list( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		array(
			'category' => $wp_query->get_queried_object_id(),
		)
	);
	?>

	<?php

else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>

<?php wp_reset_postdata(); ?>

<?php get_template_part( 'template-parts/after-template' ); ?>

<?php
get_footer();

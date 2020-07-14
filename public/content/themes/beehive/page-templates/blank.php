<?php
/**
 * Template Name: Blank Template
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

<?php beehive()->layout->set( 'blank' ); ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/before-template' ); ?>

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page' );

	/** If comments are open or we have at least one comment, load up the comment template. */
	if ( comments_open() || get_comments_number() ) :
		comments_template();
  endif;

endwhile; // End of the loop.
?>

<?php wp_reset_postdata(); ?>
  
<?php get_template_part( 'template-parts/after-template' ); ?>

<?php
get_footer();

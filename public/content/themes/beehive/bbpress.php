<?php
/**
 * Template for displaying bbpress forums contents
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
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page' );

endwhile; // End of the loop.
?>

<?php wp_reset_postdata(); ?>
  
<?php get_template_part( 'template-parts/after-template' ); ?>

<?php
get_footer();

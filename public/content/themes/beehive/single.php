<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php beehive()->layout->set( beehive_blog_layout() ); ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/before-template' ); ?>

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'single' );
	?>
  
	<?php if ( 'post' === get_post_type() && ( beehive()->options->get( 'key=post-navigation&default=1' ) && get_the_post_navigation() ) ) : ?>
		<?php get_template_part( 'template-parts/post', 'navigation' ); ?>
	<?php endif; ?>

	<?php if ( 'post' === get_post_type() && beehive()->options->get( 'key=related-posts' ) ) : ?>
		<?php beehive_related_post(); ?>
	<?php endif; ?>
  
	<?php
	/** If comments are open or we have at least one comment, load up the comment template. */
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; /** End of the loop. */
wp_reset_postdata(); /** Reset */
?>

<?php get_template_part( 'template-parts/after-template' ); ?>

<?php
get_footer();

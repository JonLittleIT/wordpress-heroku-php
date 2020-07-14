<?php
/**
 * The template for displaying search page
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

<?php beehive()->layout->set( beehive_blog_layout() ); ?> 

<?php get_header(); ?>

<?php get_template_part( 'template-parts/before-template' ); ?>

<?php
if ( have_posts() ) :
	?>

	<div class="<?php echo esc_attr( join( ' ', beehive_post_container_classes() ) ); ?>">

		<?php
		/** Start the Loop */
		while ( have_posts() ) :
			the_post();
			/**
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'search' );
		endwhile;
		?>

	</div>

	<?php beehive_pagination(); ?>
  
	<?php

else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>

<?php wp_reset_postdata(); ?>

<?php get_template_part( 'template-parts/after-template' ); ?>

<?php
get_footer();

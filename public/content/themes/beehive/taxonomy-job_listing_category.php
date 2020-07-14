<?php
/**
 * The template for displaying archive pages
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

	<ul class="job_listings">

		<?php

		/** Start the Loop */
		while ( have_posts() ) :
			the_post();
			get_job_manager_template( 'content-job_listing.php', array() );
		endwhile;
		?>

	</ul>

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

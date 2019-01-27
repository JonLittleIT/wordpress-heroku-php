<?php
/**
 * The template for displaying all single posts.
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
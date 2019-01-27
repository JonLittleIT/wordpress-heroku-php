<?php
/**
 * The template for displaying all single portfolios.
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single-portfolio' ); ?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
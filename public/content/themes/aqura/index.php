<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aqura
 */

global $aqura_data;
if ($aqura_data) {
	$aqura_view_more 	= array_key_exists('aqura_header__header_image__view_more_text', $aqura_data) ? $aqura_data['aqura_header__header_image__view_more_text'] : '';
	$aqura_header_image = array_key_exists('aqura_header__header_image__image', $aqura_data) ? $aqura_data['aqura_header__header_image__image']['url'] : '';
}

get_header(); ?>

	<?php 
		if ($aqura_data) {
			aqura_header_image(get_bloginfo( 'name' ), get_bloginfo( 'description' ), $aqura_view_more, $aqura_header_image);
		}
	?>

	<!-- ========== START BLOG-LIST-TYPE-1 ========== -->
	<div class="blog-list-type-1 padding" id="view-more-scroll">
		<div class="container">
			<div class="row">
				<div>
					<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content-full-width' );

						endwhile; ?>

						<div class="clearfix"></div>

						<?php

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
				</div><!-- end col-sm-12 -->
			</div><!-- end row -->
		</div><!-- end container -->
	</div><!-- end blog-list-type-1 -->
	<!-- ========== END BLOG-LIIST-TYPE-1 ========== -->

<?php
get_footer();

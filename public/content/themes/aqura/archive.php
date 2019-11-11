<?php
/**
 * The template for displaying archive pages
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
			aqura_header_image(aqura_get_the_archive_title(), wp_strip_all_tags(get_the_archive_description()), $aqura_view_more, $aqura_header_image);
		}
	?>
	<!-- ========== START BLOG-LIST-TYPE-1 ========== -->
	<div class="blog-list-type-1 padding">
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

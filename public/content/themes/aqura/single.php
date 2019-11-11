<?php

/**

 * The template for displaying all single posts

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post

 *

 * @package Aqura

 */



get_header();



setAndViewPostViews(get_the_ID());



$aqura_header_image__title 	= rwmb_meta( 'aqura_post__options__header_image__title');

$aqura_header_image__bg 	= rwmb_meta( 'aqura_post__options__header_image__bg' , array( array( 'limit' => 1 ) , 'size' => 'full' ));

if ( $aqura_header_image__bg != '' ) {

$aqura_header_image__bg 	= reset( $aqura_header_image__bg )['url'];

}

$aqura_blog_layout 			= rwmb_meta( 'aqura_blog_layout__layout');



if ( $aqura_header_image__bg != '' ) {} else {



	$aqura_header_image__bg = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );



}



if ( $aqura_header_image__title != '' ) {} else {



	$aqura_header_image__title = get_the_title();



} ?>



	<?php if ( ( rwmb_meta( 'aqura_white_header_options__color_checkbox') !== null ) && ( rwmb_meta( 'aqura_white_header_options__color_checkbox' ) == 'dark' ) ): ?>

		<div class="aqura-dark-header-is-displayed"></div>

	<?php endif; ?>



	<?php aqura_header_image($aqura_header_image__title, rwmb_meta( 'aqura_post__options__header_image__description'), rwmb_meta( 'aqura_post__options__header_image__view_more'), $aqura_header_image__bg); ?>



	<?php if ( $aqura_blog_layout != '2' ): ?>



	<!-- ========== START ARTICLE ========== -->

	<div class="padding blog-single-type-1" id="view-more-scroll">

		<div class="container">

			<div class="row">

				<div class="col-sm-8">

					<?php

					while ( have_posts() ) : the_post();



						get_template_part( 'template-parts/content', get_post_type() );



						// If comments are open or we have at least one comment, load up the comment template.

						if ( comments_open() || get_comments_number() ) :

							comments_template();

						endif;



					endwhile; // End of the loop.

					?>

				</div><!-- end col-sm-8 -->

				<div class="col-sm-3 col-sm-offset-1 col-padding">

					<div class="blog-list-type-1-aside">

						<?php get_sidebar(); ?>

					</div><!-- end blog-list-type-1-aside -->

				</div><!-- end col-sm-3 -->

			</div><!-- end row -->

		</div><!-- end container -->

	</div><!-- end blog-single-type-1 -->

	<!-- ========== END ARTICLE ========== -->



	<!-- ========== START ARTICLE NAV ========== -->

	<div class="article-nav-type-1">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="prev-post col-sm-6">

						<?php previous_post_link( '%link' , esc_html__( 'Previous Post' , 'aqura' ) ); ?>

					</div>

					<div class="next-post col-sm-6">

						<?php next_post_link( '%link' ,  esc_html__( 'Next Post' , 'aqura' ) ); ?>

					</div>

				</div>

			</div><!-- end row -->

		</div><!-- end container -->

	</div><!-- end article-nav -->

	<!-- ========== END ARTICLE NAV ========== -->



	<?php else: ?>



	<!-- ========== START ARTICLE ========== -->

	<div class="blog-single-type-2 padding" id="view-more-scroll">

		<div class="container">

			<div class="row">

				<?php

				while ( have_posts() ) : the_post();



					get_template_part( 'template-parts/content-02' );



				endwhile; // End of the loop.

				?>

				<div class="col-sm-3 col-sm-offset-1">

					<div class="blog-list-type-1-aside blog-list-type-2-aside">

						<?php get_sidebar(); ?>

					</div><!-- end blog-list-type-2-aside -->

				</div><!-- end col-sm-3 -->

			</div><!-- end row -->

		</div><!-- end container -->

	</div><!-- end blog-singlee-type-2 -->

	<!-- ========== END ARTICLE ========== -->



	<?php endif ?>



<?php

get_footer();


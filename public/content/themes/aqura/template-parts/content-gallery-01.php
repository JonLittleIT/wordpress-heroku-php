<?php

// This fule will display the gallery. 



global $aqura_data;



$aqura_gallery_inherit_title 	= get_the_title();



$aqura_gallery__title 		= rwmb_meta( 'aqura_gallery_options__title');

$aqura_gallery__bg 			= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

$aqura_gallery__photos 		= rwmb_meta( 'aqura_gallery_options__photos' , array( 'size' => 'thumbnail' ));

$aqura_gallery__data 		= rwmb_meta( 'aqura_gallery_options__date' );

$aqura_gallery__view_more 	= rwmb_meta( 'aqura_gallery_options__view_more_text' );



if ( $aqura_gallery__bg == false ) {



	if ( $aqura_data['aqura_header__header_image__image'] != null ) {



		$aqura_gallery__bg = $aqura_data['aqura_header__header_image__image']['url'];



	}



}



if ( $aqura_gallery__title != '' ) {} else {



	$aqura_gallery__title = $aqura_gallery_inherit_title;



}



if ( $aqura_gallery__data != '' ) {} else {

	

	$aqura_gallery__data = get_the_date();



}



if ( $aqura_gallery__view_more != '' ) {} else {



	if ( $aqura_data['aqura_header__header_image__view_more_text'] != '' ) {



		$aqura_gallery__view_more = $aqura_data['aqura_header__header_image__view_more_text'];



	}



}



if ( $aqura_gallery__bg != false ) { ?>

<!-- ========== START HERO-SECTION-HOME ========== -->

<section class="no-mb">

	<div class="before-FullscreenSlider"></div>

	<div class="breadcrumb-fullscreen-parent phone-menu-bg affix-top">

		<div class="breadcrumb breadcrumb-fullscreen breadcrumb-fullscreen--full-w alignleft small-description overlay almost-black-overlay" style="background-image: url(<?php echo esc_url( $aqura_gallery__bg ); ?>);" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">

			<div class="hero-content-type-2 fade-element">

				<h1><?php echo esc_html( $aqura_gallery__title ); ?></h1>

				<time><?php echo esc_html( $aqura_gallery__data ); ?></time>

				<a href="#view-more-scroll" data-easing="easeInOutQuint" data-scroll="" data-speed="900" data-url="false" class="view-more-type-1"><?php echo esc_html( $aqura_gallery__view_more ); ?><i class="fa fa-angle-down"></i></a>

			</div><!-- end hero-content-type-1 -->		

		</div><!-- end breadcrumb -->

	</div><!-- end breadcrumb-fullscreen-parent -->

</section>

<!-- ========== END HERO-SECTION ========== -->

<div id="view-more-scroll"></div>

<?php }



if ( !empty($aqura_gallery__photos) ) { ?>

<!-- ========== START SINGLE-GALLERY ========== -->

<div class="sg-gal-type-1" id="view-more-scroll">

	<div class="container-fluid">

		<div class="row">

			<div class="gallery-section-type-1">

				<div class="container-fluid">

					<div class="row">

						<?php foreach ( $aqura_gallery__photos as $image ) { ?>

							<article class="gallery-item">

								<figure>

									<a href="<?php echo esc_url( $image['full_url'] ); ?>" class="fluidbox"><img src="<?php echo esc_url( $image['full_url'] ); ?>" /></a>

								</figure>

							</article>

						<?php } ?>

					</div><!-- end row -->

				</div><!-- end container-fluid -->

			</div><!-- end gallery-section-type-1 -->

		</div><!-- end row -->

	</div><!-- end container-fluid -->

</div><!-- end sg-gal-type-1 -->

<!-- ========== END SINGLE-GALLERY ========== -->

<?php }
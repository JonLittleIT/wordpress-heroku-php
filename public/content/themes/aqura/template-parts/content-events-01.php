<?php
// This fule will display the gallery. 

global $aqura_data;

$aqura_events_inherit_title 					= get_the_title();

$aqura_events__header_image__title 				= rwmb_meta( 'aqura_events_options__header_image__title');
$aqura_events__header_image__description 		= rwmb_meta( 'aqura_events_options__header_image__description');
$aqura_events__header_image__view_more 			= rwmb_meta( 'aqura_events_options__header_image__view_more' );
$aqura_events__header_image__bg 				= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

$aqura_events__page_title__title 				= rwmb_meta( 'aqura_events_options__page_title__title' );
$aqura_events__page_title__subtitle 			= rwmb_meta( 'aqura_events_options__page_title__subtitle' );
$aqura_events__page_title__title_bg 			= rwmb_meta( 'aqura_events_options__page_title__title_bg' );
$aqura_events__page_title__title__first_word 	= strtok($aqura_events__page_title__title, ' ');
$aqura_events__page_title__title__the_rest 	 	= str_replace($aqura_events__page_title__title__first_word, '', $aqura_events__page_title__title);

$aqura_events__details__cover 					= rwmb_meta( 'aqura_events_options__event_cover' , array( array( 'limit' => 1 ) , 'size' => 'full' ));
if ( $aqura_events__details__cover != '' ) {
$aqura_events__details__cover 					= reset( $aqura_events__details__cover )['url'];
}
$aqura_events__details__title 					= rwmb_meta( 'aqura_events_options__title' );
$aqura_events__details__date 					= rwmb_meta( 'aqura_events_options__date' );
$aqura_events__details__location 				= rwmb_meta( 'aqura_events_options__location' );
$aqura_events__details__type 					= rwmb_meta( 'aqura_events_options__type' );
$aqura_events__details__organizator 			= rwmb_meta( 'aqura_events_options__organizator' );
$aqura_events__details__tickets_url 			= rwmb_meta( 'aqura_events_options__tickets_url' );
$aqura_events__details__description 			= rwmb_meta( 'aqura_events_options__description' );

if ( $aqura_events__header_image__title != '' ) {} else {

	$aqura_events__header_image__title = $aqura_events_inherit_title;

}

aqura_header_image($aqura_events__header_image__title, $aqura_events__header_image__description, $aqura_events__header_image__view_more, $aqura_events__header_image__bg); ?>

<!-- ========== START SINGLE-EVENT ========== -->
<div class="single-event-type-1 padding" id="view-more-scroll">
	<?php if ( ( $aqura_events__page_title__title != '' ) || ( $aqura_events__page_title__title_bg != '' ) ): ?>
	<div class="container-fluid">
		<div class="col-sm-12">
			<div class="section-title-5">
				<div>
					<h1><a><?php echo esc_html( $aqura_events__page_title__title_bg ); ?></a></h1>
					<div class="sub-title">
						<h4><a><span><?php echo esc_html( $aqura_events__page_title__title__first_word ); ?></span><?php echo esc_html( $aqura_events__page_title__title__the_rest ); ?></a></h4>
						<p><?php echo esc_html( $aqura_events__page_title__subtitle ); ?></p>
					</div><!-- end sub-title -->
				</div>
			</div><!-- end section-title-5-->
		</div><!-- end col-sm-12 -->
	</div><!-- end container-fluid -->
	<?php endif ?>
	<div class="container">
		<div class="row">
			<?php if ( $aqura_events__details__cover != false ): ?>
				<div class="col-sm-5">
					<div class="single-event-type-1-poster">
						<figure><a href="<?php echo esc_url( $aqura_events__details__cover ); ?>" class="fluidbox"><img src="<?php echo esc_url( $aqura_events__details__cover ); ?>" alt="<?php echo esc_attr( $aqura_events_inherit_title ); ?>"></a></figure>
					</div><!-- end single-event-type-1-poster -->
				</div><!-- end col-sm-5 -->
			<?php else: ?>
				<div class="col-sm-2"></div>
			<?php endif ?>
			<div class="col-sm-7">
				<div class="single-event-type-1-about">
					<?php if ( $aqura_events__details__title != '' ): ?>
						<h1><?php echo esc_html( $aqura_events__details__title ); ?></h1>
					<?php endif ?>
					<ul class="directions">
						<?php if ( $aqura_events__details__date != '' ): ?>
							<li>
								<?php echo esc_html__( 'Time' , 'aqura' ); ?>
								<span><?php echo esc_html( $aqura_events__details__date ); ?></span>
							</li>
						<?php endif ?>
						<?php if ( $aqura_events__details__location != '' ): ?>
							<li>
								<?php echo esc_html__( 'Location' , 'aqura' ); ?>
								<span><?php echo esc_html( $aqura_events__details__location ); ?></span>
							</li>
						<?php endif ?>
						<?php if ( $aqura_events__details__type != '' ): ?>
							<li>
								<?php echo esc_html__( 'Event Type' , 'aqura' ); ?>
								<span><?php echo esc_html( $aqura_events__details__type ); ?></span>
							</li>
						<?php endif ?>
						<?php if ( $aqura_events__details__organizator != '' ): ?>
							<li>
								<?php echo esc_html__( 'Organized By' , 'aqura' ); ?>
								<span><?php echo esc_html( $aqura_events__details__organizator ); ?></span>
							</li>
						<?php endif ?>
					</ul>
					<?php if ( $aqura_events__details__tickets_url != '' ): ?>
						<div class="tickets"><a href="<?php echo esc_url( $aqura_events__details__tickets_url ); ?>"><?php echo esc_html__( 'Buy Tickets' , 'aqura' ); ?></a></div>
					<?php endif ?>
					<?php if ( $aqura_events__details__description != '' ): ?>
						<h4>
							<?php echo esc_html__( 'About Tour' , 'aqura' ); ?>
						</h4>
						<p>
							<?php echo esc_html( $aqura_events__details__description ); ?>
						</p>
					<?php endif ?>
					<h4>
						<?php echo esc_html__( 'Share' , 'aqura' ); ?>
					</h4>
					<ul class="share">
						<li>
							<?php echo esc_html__( 'On' , 'aqura' ); ?>
							<a target="popup" onclick="window.open('http://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php the_permalink(); ?>','name','width=600,height=400')" rel="nofollow">
								<?php echo esc_html__( 'Facebook' , 'aqura' ); ?>
							</a>
						</li>
						<li>
							<?php echo esc_html__( 'On' , 'aqura' ); ?>
							<a target="popup" onclick="window.open('http://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?php the_permalink(); ?>','name','width=600,height=400')" rel="nofollow">
								<?php echo esc_html__( 'Twitter' , 'aqura' ); ?>
							</a>
						</li>
						<li>
							<?php echo esc_html__( 'On' , 'aqura' ); ?>
							<a target="popup" onclick="window.open('http://api.addthis.com/oexchange/0.8/forward/googleplus/offer?url=<?php the_permalink(); ?>','name','width=600,height=400')" rel="nofollow">
								<?php echo esc_html__( 'Google+' , 'aqura' ); ?>
							</a>
						</li>
						<li>
							<?php echo esc_html__( 'On' , 'aqura' ); ?>
							<a target="popup" onclick="window.open('http://api.addthis.com/oexchange/0.8/forward/vk/offer?url=<?php the_permalink(); ?>','name','width=600,height=400')" rel="nofollow">
								<?php echo esc_html__( 'VK' , 'aqura' ); ?>
							</a>
						</li>
					</ul>
				</div><!-- end single-event-type-1-about -->
			</div><!-- end col-sm-7 -->
			<div class="col-sm-12">
				<div class="album-covers-4-footer">
					<?php aqura_album_next_prev_02(true, 'event') ?>
					<div class="view-more">
						<a>
							<span class="square"></span>
							<span class="square"></span>
							<span class="square"></span>
							<span class="square"></span>
						</a>
					</div><!-- end view-more -->
					<?php aqura_album_next_prev_02(false, 'event') ?>
				</div><!-- end album-demo-one-footer -->
			</div><!-- end col-sm-12 -->
		</div><!-- end row -->	
	</div><!-- end container -->
</div><!-- end single-event-type-1 -->
<!-- ========== END SINGLE-EVENT ========== -->
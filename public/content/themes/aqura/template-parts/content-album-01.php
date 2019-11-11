<?php
// This fule will display album first style type. 

global $aqura_data;

$aqura_album_inherit_title 	= get_the_title();

$aqura_header_image__title 	= rwmb_meta( 'aqura_album_options__header_image__title');
$aqura_header_image__bg 	= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

$aqura_page_bg 				= rwmb_meta( 'aqura_album_options__page_background' , array( array( 'limit' => 1 ) , 'size' => 'full' ));
if ( $aqura_page_bg != '' ) {
$aqura_page_bg 				= reset( $aqura_page_bg )['url'];
}

if ( $aqura_header_image__title != '' ) {} else {

	$aqura_header_image__title = $aqura_album_inherit_title;

} ?>

<?php aqura_header_image($aqura_header_image__title, rwmb_meta( 'aqura_album_options__header_image__description'), rwmb_meta( 'aqura_album_options__header_image__view_more'), $aqura_header_image__bg); ?>

<!-- ========== START ALBUM-SINGLE ========== -->
<div class="album-single-type-1 padding bgk-properties" <?php if ( $aqura_page_bg != '' ) { ?> style="background-image: url(<?php echo esc_url( $aqura_page_bg ); ?>);" <?php } ?>>
	<div class="container">
		<div class="row">
			<?php if ( $aqura_album_inherit_title != '' ): ?>
			<div class="col-sm-12">
				<div class="section-title-1">
					<h2><?php echo esc_html( $aqura_album_inherit_title ); ?></h2>
					<span class="underline-1"></span>
				</div>
			</div>
			<?php endif ?>
			<div class="col-sm-8">
				<div class="playlist-single-type-1">
					<div class="header-playlist">
						<div class="name">	
							<?php echo esc_html__( 'Name' , 'aqura' ); ?>
						</div><!-- end name -->	
						<div class="length">
							<?php echo esc_html__( 'Length' , 'aqura' ); ?>
						</div><!-- end length -->
					</div><!-- end header-playlist -->
					<ul class="clearfix">
						<?php $aqura_tracks = rwmb_meta('aqura_album_options__album_tracks'); ?>
						<?php foreach ($aqura_tracks as $key => $aqura_track): ?>

							<?php if (isset($aqura_track['aqura_album_options__track-external-url'])): ?>

								<?php $aqura_trak_final = $aqura_track['aqura_album_options__track-external-url']; ?>

								<?php if (strpos($aqura_track['aqura_album_options__track-external-url'], 'soundcloud') !== false) {

									$sc_condition = 'data-sc="true"';

								} ?>

							<?php else: ?>

								<?php $aqura_trak_final = wp_get_attachment_url($aqura_track['aqura_album_options__track-url'][0]); ?>

								<?php $sc_condition = ''; ?>

							<?php endif ?>

							<?php if ( $aqura_track['aqura_album_options__track-name'] ): ?>

								<li class="trak-item" data-audio="<?php echo esc_url($aqura_trak_final); ?>" data-artist="<?php echo esc_attr($aqura_track['aqura_album_options__track-author']) ?>" data-thumbnail="<?php echo wp_get_attachment_url($aqura_track['aqura_album_options__track-thumbnail'][0]); ?>" <?php echo esc_attr($sc_condition); ?>>
									<audio src="<?php echo esc_url($aqura_trak_final); ?>" preload="metadata" title="<?php echo esc_attr($aqura_track['aqura_album_options__track-name']) ?>"></audio>
									<a class="play-pause-button"><span><i class="fa fa-play"></i></span></a>
									<span class="song-name">
										<?php echo esc_html($aqura_track['aqura_album_options__track-name']) ?>
									</span>
									<span class="song-length">
										<?php if (isset($aqura_track['aqura_album_options__track-external-url'])): ?>

											<?php echo esc_html($aqura_track['aqura_album_options__track-duration']); ?>

										<?php else: ?>

											<?php

											$aqura_tracktime = isset($aqura_track['aqura_album_options__track-url'][0]) ? wp_get_attachment_metadata($aqura_track['aqura_album_options__track-url'][0]) : '';

											if ($aqura_tracktime):
												echo esc_html($aqura_tracktime['length_formatted']);
											else:
												echo esc_html($aqura_track['aqura_album_options__track-duration']);
											endif;

											?>

										<?php endif ?>

									</span>

								</li>

							<?php endif ?>

						<?php endforeach ?>
					</ul>
				</div><!-- end playlist-single-type-1 -->
			</div><!-- end col-sm-8 -->
			<div class="col-sm-3 col-sm-offset-1">
				<div class="sidebar-albums-type-1">
					<?php
					$aqura_release_date = rwmb_meta( 'aqura_album_options__release_date');
					$aqura_catalog 		= rwmb_meta( 'aqura_album_options__album_catalog');
					$aqura_label 		= rwmb_meta( 'aqura_album_options__album_label');
					$aqura_format 		= rwmb_meta( 'aqura_album_options__album_format');
					
					if ( ( $aqura_release_date != '' ) || ( $aqura_catalog != '' ) || ( $aqura_label != '' ) || ( $aqura_format != '' ) ): ?>
					<div class="widget details">
						<h4>
							<?php echo esc_html__( 'Details' , 'aqura' ); ?>
						</h4>
						<ul class="clearfix">
							<?php if ( $aqura_release_date != '' ): ?>
							<li>
								<?php echo esc_html__( 'Realease Date:' , 'aqura' ); ?>
								<span>
									<?php echo esc_html( $aqura_release_date ); ?>
								</span>
							</li>
							<?php endif;
							if ( $aqura_catalog != '' ): ?>
							<li>
								<?php echo esc_html__( 'Catalog:' , 'aqura' ); ?>
								<span>
									<?php echo esc_html( $aqura_catalog ); ?>
								</span>
							</li>
							<?php endif;
							if ( $aqura_label != '' ): ?>
							<li>
								<?php echo esc_html__( 'Label:' , 'aqura' ); ?>
								<span>
									<?php echo esc_html( $aqura_label ); ?>
								</span>
							</li>
							<?php endif;
							if ( $aqura_format != '' ): ?>
							<li>
								<?php echo esc_html__( 'Fomat:' , 'aqura' ); ?>
								<span>
									<?php echo esc_html( $aqura_format ); ?>
								</span>
							</li>
						<?php endif; ?>
						</ul>
					</div>
					<?php endif;

					$aqura_instagram_api = $aqura_data['aqura_theme__api__instagram'];

					if ( $aqura_instagram_api != '' ): ?>
					<div class="widget insta-sidebar-widget">
						<h4>
							<?php echo esc_html__( 'Instagram' , 'aqura' ); ?>
						</h4>
						<ul id="instagram-sidebar-widget" class="clearfix instagram-sidebar-widget"></ul>
					</div>
					<?php endif;

					$aqura_album_last_fm 	= rwmb_meta('aqura_album_options__last_fm');
					$aqura_album_soundcloud = rwmb_meta('aqura_album_options__soundcloud');
					$aqura_album_itunes 	= rwmb_meta('aqura_album_options__itunes');
					$aqura_album_spotify 	= rwmb_meta('aqura_album_options__spotify');
					$aqura_album_amazon 	= rwmb_meta('aqura_album_options__amazon');
					$aqura_album_beatport 	= rwmb_meta('aqura_album_options__beatport');

					if ( ($aqura_album_last_fm != '') || ($aqura_album_soundcloud != '') || ($aqura_album_itunes != '') || ($aqura_album_spotify != '') || ($aqura_album_amazon != '') || ($aqura_album_beatport != '') ): ?>
					<div class="widget available-on-widget">
						<h4>
							<?php echo esc_html__( 'Available On' , 'aqura' ); ?>
						</h4>
						<ul id="services" class="class services">
							<?php if ( $aqura_album_last_fm != '' ): ?>
							<li>
							  <a href="<?php echo esc_url( $aqura_album_last_fm ); ?>"><div><i class="fa fa-lastfm"></i></div></a>
							</li>
							<?php endif;
							if ( $aqura_album_soundcloud != '' ): ?>
							<li>
								<a href="<?php echo esc_url( $aqura_album_soundcloud ); ?>"><div><i class="fa fa-soundcloud"></i></div></a>
							</li>
							<?php endif;
							if ( $aqura_album_itunes != '' ): ?>
							<li>
								<a href="<?php echo esc_url( $aqura_album_itunes ); ?>"><div><i class="fa fa-apple"></i></div></a>
							</li>
							<?php endif;
							if ( $aqura_album_spotify != '' ): ?>
							<li>
								<a href="<?php echo esc_url( $aqura_album_spotify ); ?>"><div><i class="fa fa-spotify"></i></div></a>
							</li>
							<?php endif;
							if ( $aqura_album_amazon != '' ): ?>
							<li>
								<a href="<?php echo esc_url( $aqura_album_amazon ); ?>"><div><i class="fa fa-amazon"></i></div></a>
							</li>
							<?php endif;
							if ( $aqura_album_beatport != '' ): ?>
							<li>
								<a href="<?php echo esc_url( $aqura_album_beatport ); ?>"><div><i class="fa fa-headphones"></i></div></a>
							</li>
							<?php endif; ?>
						  </ul>
					</div>
					<?php endif ?>
				</div><!-- end sidebar-albums-type-1 -->
			</div><!-- end col-sm-4 -->
		</div><!-- end row -->
	</div><!-- end container -->
</div><!-- end album-single-type-1 -->
<!-- ========== END ALBUM-SINGLE ========== -->

<!-- ========== START ALBUM-SINGLE-NAV ========== -->
<div class="album-single-nav-type-1">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<?php aqura_album_next_prev(true) ?>
				<?php aqura_album_next_prev(false) ?>
			</div><!-- end col-sm-12 -->
		</div><!-- end row -->
	</div><!-- end container -->
</div><!-- end album-single-nav-type-1 -->
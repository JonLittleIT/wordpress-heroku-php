<?php
// This fule will display album second style type. 

global $aqura_data;

$aqura_album_inherit_title 	= get_the_title();

$aqura_header_image__title 	= rwmb_meta( 'aqura_album_options__header_image__title');
$aqura_header_image__bg 	= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

$aqura_page_bg 				= rwmb_meta( 'aqura_album_options__page_background' , array( array( 'limit' => 1 ) , 'size' => 'full' ));
if ( $aqura_page_bg != '' ) {
$aqura_page_bg 				= reset( $aqura_page_bg )['url'];
}

$aqura_album_cover 			= rwmb_meta( 'aqura_album_options__album_cover' , array( array( 'limit' => 1 ) , 'size' => 'full' ));
if ( $aqura_album_cover != '' ) {
$aqura_album_cover 			= reset( $aqura_album_cover )['url'];
}
$aqura_album_video__yt 		= rwmb_meta( 'aqura_album_options_02__video_link_youtube' );
$aqura_album_video__vimeo 	= rwmb_meta( 'aqura_album_options_02__video_link_vimeo' );
$aqura_album_description 	= rwmb_meta( 'aqura_album_options_02__description' );
$aqura_album_song_download 	= rwmb_meta( 'aqura_album_options_02__song_download' );

$aqura_page_title__title 	= rwmb_meta( 'aqura_album_options_02__title' );
$aqura_page_title__subtitle = rwmb_meta( 'aqura_album_options_02__subtitle' );
$aqura_page_title__title_bg = rwmb_meta( 'aqura_album_options_02__title_bg' );

$aqura_page_title__title__first_word = strtok($aqura_page_title__title, ' ');
$aqura_page_title__title__the_rest 	 = str_replace($aqura_page_title__title__first_word, '', $aqura_page_title__title);

if ( $aqura_header_image__title != '' ) {} else {

	$aqura_header_image__title = $aqura_album_inherit_title;

} ?>

<?php aqura_clear_header_image($aqura_header_image__title, $aqura_header_image__bg); ?>

<!-- ========== START ALBUM SINGLE ========== -->
<div class="album-single-type-2 padding">
	<div class="container">
		<div class="row">
			<?php if ( ( $aqura_page_title__title != '' ) || ( $aqura_page_title__title_bg != '' ) ): ?>
			<div class="col-sm-12">
				<div class="section-title-5">
					<div>
						<h1><a><?php echo esc_html( $aqura_page_title__title_bg ); ?></a></h1>
						<div class="sub-title">
							<h4><a><span><?php echo esc_html( $aqura_page_title__title__first_word ); ?></span><?php echo esc_html( $aqura_page_title__title__the_rest ); ?></a></h4>
							<p><?php echo esc_html( $aqura_page_title__subtitle ); ?></p>
						</div><!-- end sub-title -->
					</div>
				</div><!-- end section-title-5-->
			</div><!-- end col-sm-12 -->
			<?php endif ?>
			<div class="col-sm-4">
				<div class="sidebar-albums-type-2">
					<div class="widget album-cover">
						<figure>
							<?php if ( $aqura_album_cover != '' ): ?>
								<a href="<?php echo esc_url( $aqura_album_cover ); ?>" class="fluidbox"><img src="<?php echo esc_url( $aqura_album_cover ); ?>" alt="<?php echo esc_attr( $aqura_album_inherit_title ); ?>"></a>
							<?php endif ?>
							<?php
							$aqura_release_date = rwmb_meta( 'aqura_album_options__release_date');
							$aqura_catalog 		= rwmb_meta( 'aqura_album_options__album_catalog');
							$aqura_label 		= rwmb_meta( 'aqura_album_options__album_label');
							$aqura_format 		= rwmb_meta( 'aqura_album_options__album_format');
							
							if ( ( $aqura_release_date != '' ) || ( $aqura_catalog != '' ) || ( $aqura_label != '' ) || ( $aqura_format != '' ) ): ?>
							<figcaption>
								<ul class="clearfix">
									<?php if ( $aqura_release_date != '' ): ?>
									<li>
										<?php echo esc_html__( 'Realease Date' , 'aqura' ); ?>
										<span>
											<?php echo esc_html( $aqura_release_date ); ?>
										</span>
									</li>
									<?php endif;
									if ( $aqura_catalog != '' ): ?>
									<li>
										<?php echo esc_html__( 'Catalog' , 'aqura' ); ?>
										<span>
											<?php echo esc_html( $aqura_catalog ); ?>
										</span>
									</li>
									<?php endif;
									if ( $aqura_label != '' ): ?>
									<li>
										<?php echo esc_html__( 'Label' , 'aqura' ); ?>
										<span>
											<?php echo esc_html( $aqura_label ); ?>
										</span>
									</li>
									<?php endif;
									if ( $aqura_format != '' ): ?>
									<li>
										<?php echo esc_html__( 'Fomat' , 'aqura' ); ?>
										<span>
											<?php echo esc_html( $aqura_format ); ?>
										</span>
									</li>
								<?php endif; ?>
								</ul>
							</figcaption>
						<?php endif; ?>
						</figure>
					</div><!-- end widget -->
					<?php
					$aqura_album_last_fm 	= rwmb_meta('aqura_album_options__last_fm');
					$aqura_album_soundcloud = rwmb_meta('aqura_album_options__soundcloud');
					$aqura_album_itunes 	= rwmb_meta('aqura_album_options__itunes');
					$aqura_album_spotify 	= rwmb_meta('aqura_album_options__spotify');
					$aqura_album_amazon 	= rwmb_meta('aqura_album_options__amazon');
					$aqura_album_beatport 	= rwmb_meta('aqura_album_options__beatport');

					if ( ($aqura_album_last_fm != '') || ($aqura_album_soundcloud != '') || ($aqura_album_itunes != '') || ($aqura_album_spotify != '') || ($aqura_album_amazon != '') || ($aqura_album_beatport != '') ): ?>
					<div class="widget available">
						<h4>
							<?php echo esc_html__( 'Available On' , 'aqura' ) ?>
						</h4>
						<?php if ( $aqura_album_last_fm != '' ): ?>
						  <a href="<?php echo esc_url( $aqura_album_last_fm ); ?>"><?php echo esc_html__( 'Last.fm' , 'aqura' ) ?></a>
						<?php endif;
						if ( $aqura_album_soundcloud != '' ): ?>
							<a href="<?php echo esc_url( $aqura_album_soundcloud ); ?>"><?php echo esc_html__( 'SoundCloud' , 'aqura' ) ?></a>
						<?php endif;
						if ( $aqura_album_itunes != '' ): ?>
							<a href="<?php echo esc_url( $aqura_album_itunes ); ?>"><?php echo esc_html__( 'iTunes' , 'aqura' ) ?></a>
						<?php endif;
						if ( $aqura_album_spotify != '' ): ?>
							<a href="<?php echo esc_url( $aqura_album_spotify ); ?>"><?php echo esc_html__( 'Spotify' , 'aqura' ) ?></a>
						<?php endif;
						if ( $aqura_album_amazon != '' ): ?>
							<a href="<?php echo esc_url( $aqura_album_amazon ); ?>"><?php echo esc_html__( 'Amazon' , 'aqura' ) ?></a>
						<?php endif;
						if ( $aqura_album_beatport != '' ): ?>
							<a href="<?php echo esc_url( $aqura_album_beatport ); ?>"><?php echo esc_html__( 'Beatport' , 'aqura' ) ?></a>
						<?php endif; ?>
					</div><!-- end widget -->
					<?php endif ?>
					<div class="widget video">
						<h4>
							<?php echo esc_html__( 'New Video' , 'aqura' ) ?>
						</h4>
						<?php if ( $aqura_album_video__yt != '' ): ?>
							<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr( aqura_album_get_video_embed( $aqura_album_video__yt ) ); ?>" frameborder="0" allowfullscreen></iframe>
						<?php elseif ( $aqura_album_video__vimeo != '' ): ?>
							<iframe src="https://player.vimeo.com/<?php echo esc_attr( aqura_album_get_video_embed( $aqura_album_video__vimeo ) ); ?>" width="640" height="320" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						<?php endif; ?>
					</div><!-- end widget -->
				</div><!-- end sidebar-albums-type-2 -->
			</div><!-- end col-sm-4 -->
			<div class="col-sm-7 col-sm-offset-1">
				<div class="single-type-2-description">
					<div class="album-songs">
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

								<div class="song-item trak-item" data-audio="<?php echo esc_url($aqura_trak_final); ?>" data-artist="<?php echo esc_attr($aqura_track['aqura_album_options__track-author']) ?>" data-thumbnail="<?php echo wp_get_attachment_url($aqura_track['aqura_album_options__track-thumbnail'][0]); ?>" <?php echo esc_attr($sc_condition); ?>>
									<audio src="<?php echo esc_url($aqura_trak_final); ?>" preload="metadata" title="<?php echo esc_attr($aqura_track['aqura_album_options__track-name']) ?>"></audio>
									<div class="play-pause-button"><a><i class="fa fa-play"></i></a></div>
									<div class="song-artist">
										<?php echo esc_html($aqura_track['aqura_album_options__track-name']) ?>
									</div>
									<div class="time">
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

									</div>

									<div class="button"><a href="<?php echo esc_url( $aqura_album_song_download ); ?>"><?php echo esc_html__( 'Buy Now' , 'aqura' ); ?></a></div>

								</div>

							<?php endif ?>

						<?php endforeach ?>		
					</div><!-- end album-songs -->
					<?php if ( $aqura_album_description != '' ): ?>
					<div class="about">
						<div class="title">
							<h4>
								<?php echo esc_html__( 'About ' , 'aqura' ) . $aqura_album_inherit_title; ?>
							</h4>
						</div>
						<p>
							<?php echo esc_html( $aqura_album_description ); ?>
						</p>
					</div><!-- end about -->
					<?php endif ?>
					<?php
					$aqura_lyrics = rwmb_meta( 'aqura_album_options_02__lyrics' );
					$aqura_lyrics_i = 0;
					?>
					<?php if ( !empty( $aqura_lyrics ) ): ?>
					<div class="lyrics">
						<div class="title">
							<h4>
								<?php echo esc_html__( 'Lyrics' , 'aqura' ); ?>
							</h4>
						</div>
						<div class="panel-group" id="accordion">
							<?php foreach ($aqura_lyrics as $key => $lyrics): ?>
							<div class="panel">
								<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo esc_attr( $aqura_lyrics_i ) ?>" aria-expanded="true">
									<?php echo esc_html( $lyrics['aqura_album_options_02__lyrics__name'] ); ?> <i class="fa fa-plus" aria-hidden="true"></i></a>

									</h4>
								</div>
								<div id="collapse-<?php echo esc_attr( $aqura_lyrics_i ) ?>" class="panel-collapse collapse" aria-expanded="true" style="">
									<div class="panel-body">
										<pre><?php echo esc_html( $lyrics['aqura_album_options_02__lyrics__text'] ); ?></pre>
									</div>
								</div>
							</div>
							<?php $aqura_lyrics_i++; ?>
							<?php endforeach ?>
						</div>
					</div><!-- end lyrics -->
					<?php endif ?>
				</div><!-- end single-type-2-description -->
			</div><!-- end col-sm-8 -->
			<div class="col-sm-12">
				<div class="album-covers-4-footer">
					<?php aqura_album_next_prev_02(true) ?>
					<div class="view-more">
						<a>
							<span class="square"></span>
							<span class="square"></span>
							<span class="square"></span>
							<span class="square"></span>
						</a>
					</div><!-- end view-more -->
					<?php aqura_album_next_prev_02(false) ?>
				</div><!-- end album-demo-one-footer -->
			</div><!-- end col-sm-12 -->
		</div><!-- end row -->
	</div><!-- end container -->
</div><!-- end albums-single-type-1 -->
<!-- ========== END ALBUM SINGLE ========== -->
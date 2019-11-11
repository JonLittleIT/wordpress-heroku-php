<?php

global $aqura_data;

do_action('theme_before_subscribe', get_the_ID()); ?>

<!doctype html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta name="HandheldFriendly" content="true" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if( $aqura_data['aqura_header__logo_favicon__favicon']['url'] != '' ) : ?>

		<link rel="shortcut icon" href="<?php echo esc_url($aqura_data['aqura_header__logo_favicon__favicon']['url']); ?>" />

	<?php else: ?>

		<link rel="shortcut icon" href="<?php echo esc_url(AQURA_IMAGES . '/favicon.ico'); ?>" />

	<?php endif; ?>

	<?php wp_head(); ?>

</head>

<?php



$aqura_body_bg_color 	= array_key_exists('aqura_theme__style__bg_color', $aqura_data) ? $aqura_data['aqura_theme__style__bg_color'] : '';

if ( array_key_exists('aqura_theme__style__bg_image', $aqura_data) ) {

$aqura_body_bg_image 	= $aqura_data['aqura_theme__style__bg_image'];

} else {

$aqura_body_bg_image 	= '';

}

$aqura_body_ajax_on_off 	= array_key_exists('aqura_theme__ajax__on_off', $aqura_data) ? $aqura_data['aqura_theme__ajax__on_off'] : '';



$aqura_body_style_options = '';



if ( isset( $aqura_body_bg_color ) && ( $aqura_body_bg_color != '' ) ) {

	$aqura_body_style_options .= 'background-color: ' . esc_attr( $aqura_body_bg_color ) . ';';

}



if ( isset( $aqura_body_bg_image['url'] ) && ( $aqura_body_bg_image['url'] != '' ) ) {

	$aqura_body_style_options .= 'background-image: url(' . esc_attr( $aqura_body_bg_image['url'] ) . ');';

}



$aqura_body_ajax_class = '';



if ( $aqura_body_ajax_on_off == false ) {

	$aqura_body_ajax_class = 'djax-disabled';

}



?>

<body <?php body_class($aqura_body_ajax_class); ?> style="<?php echo esc_attr( $aqura_body_style_options ); ?>">



	<!-- ========== START PAGE LOADER ========== -->

	<div class="page-loader" <?php if ( array_key_exists('aqura_loader__style__bg_color', $aqura_data) && ($aqura_data['aqura_loader__style__bg_color'] != '') ) { ?>style="background-color: <?php echo esc_attr($aqura_data['aqura_loader__style__bg_color']); ?>"<?php } ?>>

		<div class="vertical-align align-center">

			<?php

			if ( array_key_exists('aqura_loader__style__loader', $aqura_data) && $aqura_data['aqura_loader__style__loader']['url'] ) {

				$aqura_loader_url 	= $aqura_data['aqura_loader__style__loader']['url'];

			} else {

				$aqura_loader_url 	= AQURA_IMAGES . '/gif/loader.gif';

			}

			?>

			<img src="<?php echo esc_url($aqura_loader_url); ?>" alt="<?php esc_html_e( 'Loader animation.' , 'aqura' ); ?>" class="loader-img">

		</div>

	</div>

	<!-- ========== END PAGE LOADER ========== -->



	<!-- =============== START PLAYER ================ -->

	<?php

		$aqura_player_style 		= array_key_exists('aqura_theme__music_player__style', $aqura_data) ? $aqura_data[ 'aqura_theme__music_player__style' ] : '';

		$aqura_hide_player 			= rwmb_meta( 'aqura_album_layout__layout__player_show_hide' );

		$aqura_bg_player 			= array_key_exists('aqura_theme__music_player__bg', $aqura_data) ? $aqura_data[ 'aqura_theme__music_player__bg-color' ] : '';

		$aqura_hide_player_class 	= '';

		if ( $aqura_hide_player ) {

			$aqura_hide_player_class = 'hide-player';

		}

		if ( array_key_exists('aqura_theme__music_player__on_off', $aqura_data) && ($aqura_data[ 'aqura_theme__music_player__on_off' ] == false) ) {

			$aqura_player_style = $aqura_data[ 'aqura_theme__music_player__on_off' ];

		}

	?>

	<?php if ( isset($aqura_data['aqura_theme__music_player__album']) ): ?>

		<?php $aqura_main_playlist_id = $aqura_data['aqura_theme__music_player__album']; ?>

	<?php endif ?>

	<?php
	if ( $aqura_player_style == '1' ):
	?>

	<!-- =============== START PLAYER ================ -->

	<div class="main-music-player <?php echo esc_attr($aqura_hide_player_class); ?>" style="background-color: <?php if ( $aqura_bg_player ) echo esc_attr($aqura_bg_player['rgba']); ?>;">

		<a class="hide-player-button" style="background-color: <?php if ( $aqura_bg_player ) echo esc_attr($aqura_bg_player['rgba']); ?>;">

			<i class="fa fa-plus"></i>

			<i class="fa fa-minus"></i>

		</a>

		<div id="mesh-main-player" class="jp-jplayer" data-audio-src="" data-title="" data-artist=""></div>

		

		<div id="mesh-main-player-content" class="mesh-main-player" role="application" aria-label="media player">

			<div class="container">

				<div class="row">

					<div class="left-player-side">

						<div class="mesh-prev">

							<i class="fa fa-step-backward"></i>

						</div>

						<div class="mesh-play">

							<i class="fa fa-play"></i>

						</div>

						<div class="mesh-pause">

							<i class="fa fa-pause"></i>

						</div>

						<div class="mesh-next">

							<i class="fa fa-step-forward"></i>

						</div>

						<button id="playlist-toggle" class="jplayerButton">

							<span class="span-1"></span>

							<span class="span-2"></span>

							<span class="span-3"></span>

						</button>

					</div>

					<div class="center-side">

						<div class="mesh-current-time">

						</div>

						<div class="mesh-seek-bar">

							<div class="mesh-play-bar">

							</div>

						</div>

						<div class="mesh-duration">

						</div>

					</div>

					<div class="right-player-side">

						<div class="mesh-thumbnail">

							<img src="">

						</div>

						<div class="mesh-title">

						</div>

						<div class="mesh-artist">

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<?php
	elseif ( $aqura_player_style == '2' ):
	?>

	<!-- =============== END PLAYER ================ -->

	<!-- =============== START PLAYER ================ -->

	<div class="main-music-player new-player-1 <?php echo esc_attr($aqura_hide_player_class); ?>" style="background-color: <?php echo esc_attr($aqura_bg_player['rgba']); ?>;">

		<a class="hide-player-button" style="background-color: <?php echo esc_attr($aqura_bg_player['rgba']); ?>;">

			<i class="fa fa-plus"></i>

			<i class="fa fa-minus"></i>

		</a>

		<div id="mesh-main-player" class="jp-jplayer" data-audio-src="" data-title="" data-artist=""></div>

		

		<div id="mesh-main-player-content" class="mesh-main-player" role="application" aria-label="media player">

			<div class="container-fluid">

				<div class="row">

					<div class="left-player-side">

						<div class="mesh-play">

							<i class="fa fa-play"></i>

						</div>

						<div class="mesh-pause">

							<i class="fa fa-pause"></i>

						</div>

						<div class="mesh-prev">

							<i class="fa fa-step-backward"></i>

						</div>

						<div class="mesh-next">

							<i class="fa fa-step-forward"></i>

						</div>

						

						<div class="mesh-thumbnail">

							<img src="">

						</div>

						<div class="mesh-title">

						</div>

						<div class="mesh-artist">

						</div>

					</div>

					<div class="center-side">

						

						<div class="mesh-seek-bar">

							<div class="mesh-play-bar">

							</div>

						</div>

					</div>

					<div class="right-player-side">

						<div class="mesh-current-time">

						</div>

						<div class="mesh-duration">

						</div>

						<button id="playlist-toggle" class="jplayerButton">

							<span class="span-1"></span>

							<span class="span-2"></span>

							<span class="span-3"></span>

						</button>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- =============== END PLAYER ================ -->

	<?php 
	endif;
	?>



	<?php if ( isset($aqura_main_playlist_id) ): ?>

	<?php if ( !is_null($aqura_main_playlist_id) ): ?>

	<!-- =============== START PLAYLIST ================ -->

	<div class="playlist-wrapper" id="playlist-wrapper">

		<?php



			$aqura_args = array();



			if ( $aqura_main_playlist_id != '' ) {



					$aqura_tracks = rwmb_meta('aqura_album_options__album_tracks', $aqura_args, $aqura_main_playlist_id);



					if ( $aqura_tracks ) {



					?>

					<div class="jp-playlist container">

						<div class="about-list clearfix">

							<span class="about-name">

								<?php esc_html_e( 'NAME' , 'aqura' ) ?>

							</span>

							<span class="about-length">

								<?php esc_html_e( 'LENGTH' , 'aqura' ) ?>

							</span>

							<span class="about-available">

								<?php esc_html_e( 'AVAILABLE ON' , 'aqura' ) ?>

							</span>

						</div>

						<?php



								$aqura_album_itunes 	= rwmb_meta( 'aqura_album_options__itunes',$aqura_args,$aqura_main_playlist_id );

								$aqura_album_spotify = rwmb_meta( 'aqura_album_options__spotify',$aqura_args,$aqura_main_playlist_id );

								$aqura_album_soundcloud 	= rwmb_meta( 'aqura_album_options__soundcloud',$aqura_args,$aqura_main_playlist_id );



								foreach ($aqura_tracks as $key => $aqura_track):



									if ( isset($aqura_track['aqura_album_options__track-external-url']) ):

											

										$aqura_trak_final = $aqura_track['aqura_album_options__track-external-url'];



										if (strpos($aqura_track['aqura_album_options__track-external-url'], 'soundcloud') !== false) :



											$sc_condition = 'data-sc="true"';



										endif;



									else:



										$aqura_trak_final = wp_get_attachment_url($aqura_track['aqura_album_options__track-url'][0]);



										$sc_condition = '';



									endif;



									if (isset($aqura_track['aqura_album_options__track-name'])): ?>



										<div class="trak-item" data-audio="<?php echo esc_url($aqura_trak_final); ?>" data-artist="<?php echo esc_attr($aqura_track['aqura_album_options__track-author']); ?>" data-thumbnail="<?php echo wp_get_attachment_url($aqura_track['aqura_album_options__track-thumbnail'][0]); ?>" <?php echo esc_attr($sc_condition); ?>>

												<audio src="<?php echo esc_url($aqura_trak_final); ?>" preload="metadata" title="<?php echo esc_attr($aqura_track['aqura_album_options__track-name']); ?>"></audio>

												<?php if ( $aqura_album_itunes != '' || $aqura_album_spotify != '' || $aqura_album_soundcloud != '' ): ?>

												<div class="additional-button">

													<div class="center-y-table">

														<?php if ( $aqura_album_itunes != '' ): ?>

															<a href="<?php echo esc_url($aqura_album_itunes); ?>">

																<i class="fa fa-apple"></i>

															</a>

														<?php endif ?>

														<?php if ( $aqura_album_spotify != '' ): ?>

															<a href="<?php echo esc_url($aqura_album_spotify); ?>">

																<i class="fa fa-spotify"></i>

															</a>

														<?php endif ?>

														<?php if ( $aqura_album_soundcloud != '' ): ?>

															<a href="<?php echo esc_url($aqura_album_soundcloud); ?>">

																<i class="fa fa-soundcloud"></i>

															</a>

														<?php endif ?>

													</div>

												</div>

												<?php endif ?>

												<div class="play-pause-button">

													<div class="center-y-table">

														<i class="fa fa-play"></i>

													</div>

												</div>

												<div class="name-artist">

													<div class="center-y-table">

														<h2>

															<?php echo esc_html($aqura_track['aqura_album_options__track-name']); ?>

														</h2>

													</div>

												</div>

												<time class="trak-duration" datetime="<?php echo get_the_date('Y-m-d', $aqura_main_playlist_id); ?>">

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

												</time>

											</div>



									<?php endif;

								endforeach;



							}



						?>

					</div>

		<?php } ?>

	</div>

	<!-- =============== END PLAYLIST ================ -->

	<?php endif; ?>

	<?php endif; ?>



	<!-- ========== START HEADER ========== -->

	<?php

	$aqura_header_style = array_key_exists('aqura_header__style__select', $aqura_data) ? $aqura_data['aqura_header__style__select'] : '';

	if ( array_key_exists('aqura_header__logo_favicon__light_logo', $aqura_data) && ($aqura_data['aqura_header__logo_favicon__light_logo']['url']) ) {

		$aqura_light_logo 	= $aqura_data['aqura_header__logo_favicon__light_logo']['url'];

	} else {

		$aqura_light_logo 	= AQURA_IMAGES . '/header/light-logo.png';

	}

	if ( array_key_exists('aqura_header__logo_favicon__dark_logo', $aqura_data) && ($aqura_data['aqura_header__logo_favicon__dark_logo']['url']) ) {

		$aqura_dark_logo 	= $aqura_data['aqura_header__logo_favicon__dark_logo']['url'];

	} else {

		$aqura_dark_logo 	= AQURA_IMAGES . '/header/dark-logo.png';

	}

	?>

	<?php if ( $aqura_header_style == '1' || is_null($aqura_header_style) ): ?>

	<div class="inline-header">

		<div class="container">

			<div class="row">

				<a class="opened-menu-2">

					<span class="span-1"></span>

					<span class="span-2"></span>

					<span class="span-3"></span>

				</a><!-- end open-menu -->

				<div class="inline-menu">

					<div class="left-side">

						<?php

							if ( has_nav_menu( 'primary' ) ) {

								wp_nav_menu(

									array(

										'theme_location' => 'primary',

										'container' 	 => false,

										'items_wrap' 	 => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'

									)

								);

							}

						?>

					</div><!-- end left-side -->

					<div class="center-side">

						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">

							<?php if ( is_null($aqura_header_style) ): ?>

							<img src="<?php echo esc_url($aqura_dark_logo); ?>" class="light-logo" alt="<?php echo get_bloginfo('name'); ?>">

							<?php else: ?>

							<img src="<?php echo esc_url($aqura_light_logo); ?>" class="light-logo" alt="<?php echo get_bloginfo('name'); ?>">

							<?php endif; ?>

							<img src="<?php echo esc_url($aqura_dark_logo); ?>" class="dark-logo" alt="<?php echo get_bloginfo('name'); ?>">

						</a>

					</div><!-- end center-side -->

					<div class="right-side">

						<?php

							if ( has_nav_menu( 'inline-primary-2' ) ) {

								wp_nav_menu(

									array(

										'theme_location' => 'inline-primary-2',

										'container' 	 => false,

										'items_wrap' 	 => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'

									)

								);

							}

						?>

						<?php if ( $aqura_data['aqura_header__social_icons__on_off'] != false ): ?>

							<ul class="social-media-header">

								<?php if( isset( $aqura_data['aqura_header__social_icons__icon'] ) && shortcode_exists( 'aqura_menu_social_icon' ) ){

									foreach($aqura_data['aqura_header__social_icons__icon'] as $aqura_icon) {

										echo do_shortcode($aqura_icon);

									}

								} ?>

							</ul><!-- end social-media-header -->

						<?php endif ?>

					</div><!-- end right-side -->

				</div><!-- end inline-menu -->

			</div><!-- end row -->

		</div><!-- end container -->

	</div>

	<?php elseif ( $aqura_header_style == '2' && $aqura_header_style != '' ) : ?>

	<div class="trigger-header">

		<div class="right-section">

			<a class="opened-menu">

				<span class="span-1"></span>

				<span class="span-2"></span>

				<span class="span-3"></span>

			</a><!-- end open-menu -->

		</div><!-- end right-section -->

		<div class="burger-menu">

			<nav>

				<!-- Trigger Menu Close Button -->

				<div class="x-filter">

					<span></span><span></span>

				</div><!-- end x-filter -->

				<!-- Trigger Menu Primary List -->

				<?php

					if ( has_nav_menu( 'primary' ) ) {

						wp_nav_menu(

							array(

								'theme_location' => 'primary',

								'container' 	 => false,

								'items_wrap' 	 => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'

							)

						);

					}

				?>

				<!-- Trigger Menu Open Button -->

				<div class="x-filter">

					<span></span>

					<span></span>

				</div><!-- end x-filter -->

				<!-- Trigger Menu Open Button -->

			</nav>

		</div><!-- end burger-menu -->

		<!-- ========== START LOGO ========== -->

		<div class="logo-container">

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">

				<img src="<?php echo esc_url($aqura_light_logo); ?>" class="light-logo" alt="<?php echo get_bloginfo('name'); ?>">

				<img src="<?php echo esc_url($aqura_dark_logo); ?>" class="dark-logo" alt="<?php echo get_bloginfo('name'); ?>">

			</a>

		</div><!-- end logo-container -->

		<!-- ========== END LOGO ========== -->

	</div><!-- end trigger-header -->

	<?php elseif ( $aqura_header_style == '3' && $aqura_header_style != '' ) : ?>

	<div class="trigger-header-type-2">

		<div class="right-section">

			<a class="opened-menu">

				<span class="span-1"></span>

				<span class="span-2"></span>

				<span class="span-3"></span>

			</a><!-- end open-menu -->

		</div><!-- end right-section -->

		<div class="burger-menu">

			<div class="language">

				<?php

					if ( has_nav_menu( 'top-primary-style-3' ) ) {

						wp_nav_menu(

							array(

								'theme_location' => 'top-primary-style-3',

								'container' 	 => false,

								'items_wrap' 	 => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'

							)

						);

					}

				?>

			</div><!-- end language -->	

			<nav>

				<?php

					if ( has_nav_menu( 'primary' ) ) {

						wp_nav_menu(

							array(

								'theme_location' => 'primary',

								'container' 	 => false,

								'items_wrap' 	 => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'

							)

						);

					}

				?>

				<!-- Trigger Menu Open Button -->

				<div class="x-filter">

					<span></span>

					<span></span>

				</div><!-- end x-filter -->

				<!-- Trigger Menu Open Button -->

			</nav>

			<div class="trigger-header-type-2-copyright">

				<?php function aqura_header_03_copyrights() {

					global $aqura_data;

					return $aqura_data['aqura_header__style__menu_copyrights'];

				} ?>

				<?php echo aqura_header_03_copyrights(); ?>

			</div>

		</div><!-- end burger-menu -->

		<!-- ========== START LOGO ========== -->

		<div class="logo-container">

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">

				<img src="<?php echo esc_url($aqura_light_logo); ?>" class="light-logo" alt="<?php echo get_bloginfo('name'); ?>">

				<img src="<?php echo esc_url($aqura_dark_logo); ?>" class="dark-logo" alt="<?php echo get_bloginfo('name'); ?>">

			</a>

		</div><!-- end logo-container -->

		<!-- ========== END LOGO ========== -->

	</div><!-- end trigger-header-2 -->

	<?php else: ?>

	<div class="inline-header">

		<div class="container">

			<div class="row">

				<a class="opened-menu-2">

					<span class="span-1"></span>

					<span class="span-2"></span>

					<span class="span-3"></span>

				</a><!-- end open-menu -->

				<div class="inline-menu">

					<div class="left-side">

						<?php

							if ( has_nav_menu( 'primary' ) ) {

								wp_nav_menu(

									array(

										'theme_location' => 'primary',

										'container' 	 => false,

										'items_wrap' 	 => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'

									)

								);

							}

						?>

					</div><!-- end left-side -->

					<div class="center-side">

						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">

							<img src="<?php echo esc_url($aqura_dark_logo); ?>" class="light-logo" alt="<?php echo get_bloginfo('name'); ?>">

							<img src="<?php echo esc_url($aqura_dark_logo); ?>" class="dark-logo" alt="<?php echo get_bloginfo('name'); ?>">

						</a>

					</div><!-- end center-side -->

					<div class="right-side">

						<?php

							if ( has_nav_menu( 'inline-primary-2' ) ) {

								wp_nav_menu(

									array(

										'theme_location' => 'inline-primary-2',

										'container' 	 => false,

										'items_wrap' 	 => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'

									)

								);

							}

						?>

					</div><!-- end right-side -->

				</div><!-- end inline-menu -->

			</div><!-- end row -->

		</div><!-- end container -->

	</div>

	<?php endif; ?>

	<!-- ========== END HEADER ========== -->



	<div class="aqura_wrapper" id="main">

        <div class="aqura_ajax-update-content first" id="first">
<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// Playlist
global $post;
$pl_rand = woohoo_rand(6);
if ( empty( $num_posts ) ) $num_posts = 6;

$pl_query_args[ 'cat' ]             = 68;
$pl_query_args[ 'post_status' ]     = 'publish';
$pl_query_args[ 'cache_results' ]   = false;
$pl_query_args[ 'no_found_rows' ]   = true;
$pl_query_args['posts_per_page']    = $num_posts;

$bdaia_pl_query = new WP_Query( $pl_query_args );?>

<div class="bdaia-playlist bdaia-pl-uid<?php echo $pl_rand; ?>">
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var playlist_uid = jQuery( '#bdaia-player-uid<?php echo $pl_rand; ?>' );

			jQuery('#bdaia-list-uid<?php echo $pl_rand; ?>').flexslider({
				animation       : "slide",
				controlNav      : true,
				directionNav    : true,
				animationLoop   : false,
				pauseOnHover    : true,
				touch           : true,
				slideshow       : false,
				move            : 0,
				asNavFor        : '#bdaia-player-uid<?php echo $pl_rand; ?>',
				selector        : ".bdaia-list-items .bdaia-list-item"
			});

			playlist_uid.flexslider({
				selector        : ".bdaia-player-items .bdaia-player-item",
				animation       : "slide",
				controlNav      : true,
				directionNav    : true,
				animationLoop   : false,
				pauseOnHover    : true,
				touch           : true,
				slideshow       : false,
				move            : 0,
				start: function( slider ) {
					jQuery( '.bdaia-pl-uid<?php echo $pl_rand; ?> .bdaia-row').removeClass( 'pl_loading' );
				},
				sync            : "#bdaia-list-uid<?php echo $pl_rand; ?>"
			});
		});
	</script>

	<div class="bd-container">
		<div class="bdaia-pl-content">

			<div class="bdaia-row pl_loading">
				<?php if ( $bdaia_pl_query->have_posts() ) : ?>

				<div class="bd-col-md-8">

					<div class="bdaia-pl-player">
						<div class="bdaia-plp-content" id="bdaia-player-uid<?php echo $pl_rand; ?>">

							<ul class="bdaia-player-items">
								<?php while ( $bdaia_pl_query->have_posts() ) : $bdaia_pl_query->the_post(); ?>
									<li class="bdaia-player-item">
										<?php
										$bdaia_p_video = get_post_meta( get_the_ID(),'post_video_bd', true );
										$video_id = $video_type = '';
										if( isset( $bdaia_p_video['video'] ) ) $video_id = $bdaia_p_video['video'];
										if( isset( $bdaia_p_video['video_type'] ) ) $video_type = $bdaia_p_video['video_type'];

										if( get_post_format( get_the_ID() ) == 'video' ) {
											?>
											<div class="bdaia-pl-video">
												<?php
												if ( $video_type == 'youtube' && $video_id   ) echo '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . $video_id . '?&amp;enablejsapi=1" frameborder="0" allowfullscreen></iframe>';
												elseif ( $video_type == 'vimeo' && $video_id ) echo '<iframe src="http://player.vimeo.com/video/' . $video_id . '?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
												elseif ( $video_type == 'daily' && $video_id ) echo '<iframe frameborder="0" width="500" height="281" src="http://www.dailymotion.com/embed/video/' . $video_id . '"></iframe>';
												?>
											</div>
											<?php
										}
										?>
									</li>
								<?php endwhile;?>
							</ul>
						</div>
					</div>

				</div>

				<div class="bd-col-md-4">

					<div class="bdaia-pl-list">
						<div class="bdaia-pll-content" id="bdaia-list-uid<?php echo $pl_rand; ?>">
							<ul class="bdaia-list-items">
								<?php while ( $bdaia_pl_query->have_posts() ) : $bdaia_pl_query->the_post(); ?>
									<li class="bdaia-list-item">
										<div class="bdaia-li-container">
											<div class="bdaia-pl-img-container">
												<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
													<?php the_post_thumbnail( $GLOBALS['bdaia-small'] ); ?>
												<?php endif; ?>
											</div>

											<div class="bdaia-pl-content-wrapper">
												<div class="bdaia-post-date"><?php woohoo_get_time(); ?></div>
												<div class="cfix"></div>
												<h3><?php the_title(); ?></h3>
											</div>
										</div>
									</li>
								<?php endwhile; wp_reset_query();?>
							</ul>
						</div>
					</div>

				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
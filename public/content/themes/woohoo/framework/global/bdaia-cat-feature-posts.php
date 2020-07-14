<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

global $post;
$original_post      = $post;
$fp_rand            = woohoo_rand(6);
$category_id        = get_query_var('cat') ;
$bdaia_cat_options  = get_option( "bd_cat_$category_id" );

$num_posts = $onof = $display = $sort_order = $offset = $speed = $time = "";
if( !empty( $bdaia_cat_options['bdaia_fp_num_posts'] ) ) $num_posts = $bdaia_cat_options['bdaia_fp_num_posts'];
if( !empty( $bdaia_cat_options['bdaia_fp_offset'] ) ) $offset = $bdaia_cat_options['bdaia_fp_offset'];
if( !empty( $bdaia_cat_options['bdaia_fp_speed'] ) ) $speed = $bdaia_cat_options['bdaia_fp_speed'];
if( !empty( $bdaia_cat_options['bdaia_fp_time'] ) ) $time = $bdaia_cat_options['bdaia_fp_time'];
if( !empty( $bdaia_cat_options['bdaia_fp_onof'] ) ) $onof = $bdaia_cat_options['bdaia_fp_onof'];
if( !empty( $bdaia_cat_options['bdaia_fp_style'] ) ) $display = $bdaia_cat_options['bdaia_fp_style'];
if( !empty( $bdaia_cat_options['bdaia_fp_sort_order'] ) ) $sort_order = $bdaia_cat_options['bdaia_fp_sort_order'];

if( !$speed || $speed == ' ' || !is_numeric( $speed ) ) $speed = 7000;
if( !$time  || $time  == ' ' || !is_numeric( $time ) ) $time  = 600;

$fp_query_args['cat'] = $category_id;

$bdaia_fp_display = "";
if( !empty( $display ) )
	$bdaia_fp_display = $display;

switch ( $sort_order )
{
	case 'popular':
		$fp_query_args['meta_key']      = 'bdaia_views';
		$fp_query_args['orderby']       = 'meta_value_num';
		$fp_query_args['order']         = 'DESC';
		break;

	case 'review_high':
		$fp_query_args['meta_key']      = 'bdaia_taqyeem_final_score';
		$fp_query_args['orderby']       = 'meta_value';
		$fp_query_args['order']         = 'DESC';
		$fp_query_args['meta_value']    = 0;
		$fp_query_args['meta_compare']  = '!=';
		break;

	case 'random_posts':
		$fp_query_args['orderby']       = 'rand';
		break;

	case 'comment_count':
		$fp_query_args['orderby']       = 'comment_count';
		$fp_query_args['order']         = 'DESC';
		break;

	case 'random_today':
		$fp_query_args['orderby']       = 'rand';
		$fp_query_args['year']          = date('Y');
		$fp_query_args['monthnum']      = date('n');
		$fp_query_args['day']           = date('j');
		break;

	case 'random_7_day':
		$fp_query_args['orderby']       = 'rand';
		$fp_query_args['date_query']    = array(
			'column' => 'post_date_gmt',
			'after' => '1 week ago'
		);
		break;
}

$fp_query_args['post_status']       = 'publish';
$fp_query_args['cache_results']     = false;
$fp_query_args['no_found_rows']     = true;

if ( empty( $num_posts ) ) $num_posts = 3;
$fp_query_args['posts_per_page'] = $num_posts;

if ( !empty( $offset ) ) $fp_query_args['offset'] = $offset;

if( ! empty( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) && is_array( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) )
{
	$fp_query_args['post__not_in'] = $GLOBALS['woohoo_do_not_diblicate_boxes'];
}

$bdaia_fp_c1 = 1;
$bdaia_fp_c2 = $bdaia_fp_c3 = 0;

$bdaia_fp_query = new WP_Query( $fp_query_args ); ?>

<?php if( $onof == true ) { ?>

	<?php if ( $bdaia_fp_display == "default" ) { ?>

		<div class="bdaia-feature-posts bdaia-fp-s1">
			<div class="bd-container">
				<div class="bdaia-fp-content">
					<div class="bdaia-fp-container">
						<script>
							jQuery(document).ready(function() {
								jQuery('.bdaia-fp-uid<?php echo $fp_rand; ?>').flexslider({
									animation       : "fade",
									slideshowSpeed  :<?php echo $speed ?>,
									animationSpeed  :<?php echo $time ?>,
									selector        : ".bdaia-fp-flexslider-items .bdaia-fp-post",
									smoothHeight    : false,
									controlNav      : true,
									randomize       : false,
									pauseOnHover    : true,
									touch           : true,
									prevText        : "",
									nextText        : ""
								});
							});
						</script>
						<div class="bdaia-fp-flexslider bdaia-fp-uid<?php echo $fp_rand; ?>">
							<ul class="bdaia-fp-flexslider-items">
								<?php if ( $bdaia_fp_query->have_posts() ) : while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post(); if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
									<li class="bdaia-fp-post bdaia-fp-big-thumb bdaia-fp-post-<?php echo $bdaia_fp_c1; ?>">

										<?php
										$thumb_bg = '';
										if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
										{
											$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( 'woohoo-full' ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( 'woohoo-full' ) ) .'"';
										}
										?>

                                        <div class="bdaia-fp-post-img-container" <?php echo ( $thumb_bg ); ?>>
											<?php woohoo_video_icon_play(); ?>
                                            <a class="bdaia-text-gradient" href="<?php the_permalink(); ?>"></a>
                                        </div>
                                        <div class="fp1-post-content-inner">
                                            <div class="bdaia-category"><?php echo woohoo_custom_primary_category(); ?></div>
                                            <div class="bdaia-fp-post-content-wrapper">
                                                <header class="bdaia-post-header">
                                                    <div class="bdaia-post-title">
                                                        <h2 class="name post-title entry-title" ><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
                                                    </div>
                                                    <div class="bdaia-meta-info">
                                                        <div class="bdaia-post-author-name">
															<?php woohoo_tr( 'By' ); ?>
															<?php the_author_posts_link(); ?>
															<?php if ( get_the_author_meta( 'twitter' ) ){ ?>
                                                                <a href="https://twitter.com/<?php echo get_the_author_meta( 'twitter' ); ?>" target="_blank">
                                                                    <span class='bdaia-io bdaia-io-twitter'></span>
                                                                </a>
															<?php } ?>
                                                        </div>
                                                        <div class="bdaia-post-date"><?php woohoo_tr( 'Posted' ); ?>&nbsp;<?php woohoo_get_time(); ?></div>
                                                    </div>
                                                </header>
                                            </div>
                                        </div>
									</li>
									<?php $bdaia_fp_c1++; $bdaia_fp_c2++; endwhile; endif; ?>
							</ul>
							<div class="cfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .bdaia-feature-posts.bdaia-fp-s1 /-->

	<?php } elseif ( $bdaia_fp_display == "grid1" ) { ?>

		<div class="bdaia-feature-posts bdaia-fp-s2">
			<div class="bd-container">
				<div class="bdaia-fp-content">
					<div class="bdaia-fp-container">
						<script>
							jQuery(document).ready(function () {
								jQuery( '.big-grids-uid<?php echo $fp_rand;?>' ).flexslider({
									animation       : "fade",
									slideshowSpeed  : <?php echo $speed; ?>,
									animationSpeed  : <?php echo $time; ?>,
									selector        : ".big-grids-single-slide",
									randomize       : false,
									pauseOnHover    : true,
									prevText        : "",
									nextText        : "",
									controlNav      : false
								});
							});
						</script>
						<div class="big-grids-container">
							<div class="big-grids big-grid1 big-grids-uid<?php echo $fp_rand;?><?php if ( $num_posts <= 3 ) echo ' big-grids-disable-nav'; ?>">
								<?php if ( $bdaia_fp_query->have_posts() ) : while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post(); $bdaia_fp_c2++; $bdaia_fp_c3++; if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
									<?php if ( $bdaia_fp_c1 % 3 == 1 ) echo '<div class="big-grids-single-slide">'; ?>
									<?php if( $bdaia_fp_c2 == 1 ) $size = 'bdaia-gr1'; else $size = 'bdaia-gr2'; ?>

									<div class="big-grid big-grid-<?php echo $bdaia_fp_c2; ?> fea-<?php echo $bdaia_fp_c3; ?>">
										<div class="big-grid-inner">

											<?php woohoo_video_icon_play(); ?>

											<?php
											$thumb_bg = '';
											if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
											{
												$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( $size ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( $size ) ) .'"';
											}
											?>

                                            <a class="img" <?php echo ( $thumb_bg ); ?> href="<?php the_permalink(); ?>"></a>

											<div class="featured-title">
												<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
												<?php woohoo_get_time(); ?>
											</div>
										</div>
									</div>
									<?php if ( $bdaia_fp_c1 % 3 == 0 ) echo "</div>"; ?>
									<?php if ( $bdaia_fp_c2 == 3 ) $bdaia_fp_c2 = 0; ?>
									<?php $bdaia_fp_c1++; endwhile; endif; ?>
								<?php if ( $bdaia_fp_c1 % 3 != 1 ) echo "</div>";?>
							</div>
						</div>
						<div class="cfix"></div>
					</div>
				</div>
			</div>
		</div><!-- .bdaia-feature-posts.bdaia-fp-s2 /-->

	<?php } elseif ( $bdaia_fp_display == "grid2" ) { ?>

		<div class="bdaia-feature-posts bdaia-fp-s3">
			<div class="bd-container">
				<div class="bdaia-fp-content">
					<div class="bdaia-fp-container">
						<script>
							jQuery(document).ready(function () {
								jQuery( '.big-grids-uid<?php echo $fp_rand;?>' ).flexslider({
									animation       : "fade",
									slideshowSpeed  : <?php echo $speed; ?>,
									animationSpeed  : <?php echo $time; ?>,
									selector        : ".big-grids-single-slide",
									randomize       : false,
									pauseOnHover    : true,
									prevText        : "",
									nextText        : "",
									controlNav      : false
								});
							});
						</script>
						<div class="big-grids-container">
							<div class="big-grids big-grid2 big-grids-uid<?php echo $fp_rand;?><?php if ( $num_posts <= 5 ) echo ' big-grids-disable-nav'; ?>">
								<?php if ( $bdaia_fp_query->have_posts() ) : while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post(); $bdaia_fp_c2++; $bdaia_fp_c3++; if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
									<?php
									if ( $bdaia_fp_c1 % 5 == 1 ) { $size = 'bdaia-gr3'; } else { $size = 'bdaia-gr4'; }
									if ( $bdaia_fp_c1 % 5 == 1 ) echo '<div class="big-grids-single-slide">'; ?>
									<div class="big-grid big-grid-<?php echo $bdaia_fp_c2; ?> fea-<?php echo $bdaia_fp_c3; ?>">
										<div class="big-grid-inner">

											<?php woohoo_video_icon_play(); ?>

											<?php
											$thumb_bg = '';
											if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
											{
												$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( $size ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( $size ) ) .'"';
											}
											?>

                                            <a class="img" <?php echo ( $thumb_bg ); ?> href="<?php the_permalink(); ?>"></a>

											<div class="featured-title">
												<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
												<?php woohoo_get_time(); ?>
											</div>
										</div>
									</div>
									<?php if ( $bdaia_fp_c1 % 5 == 0 ) echo "</div>"; ?>
									<?php if ( $bdaia_fp_c2 == 5 ) $bdaia_fp_c2 = 0; ?>
									<?php $bdaia_fp_c1++; endwhile; endif; ?>
								<?php if ( $bdaia_fp_c1 % 5 != 1 ) echo "</div>";?>
							</div>
						</div>
						<div class="cfix"></div>
					</div>
				</div>
			</div>
		</div><!-- .bdaia-feature-posts.bdaia-fp-s3 /-->

	<?php } elseif ( $bdaia_fp_display == "grid3" ) { ?>

		<div class="bdaia-feature-posts bdaia-fp-grids bdaia-fp-grid3">
			<script>
				jQuery(document).ready(function () {
					jQuery( '.big-grids-uid<?php echo $fp_rand;?>' ).flexslider({
						animation       : "fade",
						slideshowSpeed  : <?php echo $speed; ?>,
						animationSpeed  : <?php echo $time; ?>,
						selector        : ".big-grids-single-slide",
						randomize       : false,
						pauseOnHover    : true,
						prevText        : "",
						nextText        : "",
						controlNav      : false
					});
				});
			</script>
			<div class="bd-container">
				<div class="bdaia-fp-grids-content">
					<div class="bdaia-fp-grids-inner">

						<div class="big-grids big-grids-uid<?php echo $fp_rand;?><?php if ( $num_posts <= 5 ) echo ' big-grids-disable-nav'; ?>">
							<?php if ( $bdaia_fp_query->have_posts() ) : while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post(); $bdaia_fp_c2++; $bdaia_fp_c3++; if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
								<?php
								if ( $bdaia_fp_c1 % 5 == 1 ) { $size = 'bdaia-gr1'; } else { $size = 'bdaia-gr2'; }
								if ( $bdaia_fp_c1 % 5 == 1 ) echo '<div class="big-grids-single-slide">';  ?>
								<div class="big-grid big-grid-<?php echo $bdaia_fp_c2; ?> fea-<?php echo $bdaia_fp_c3; ?>">
									<div class="big-grid-inner">

										<?php woohoo_video_icon_play(); ?>

										<?php
										$thumb_bg = '';
										if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
										{
											$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( $size ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( $size ) ) .'"';
										}
										?>

                                        <a class="img" <?php echo ( $thumb_bg ); ?> href="<?php the_permalink(); ?>"></a>

										<div class="featured-title">
											<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
											<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>
											<?php if( $post_reviews ){ ?>
												<div class="bdaia-post-rating">
													<?php echo woohoo_final_score(); ?>
												</div>
											<?php } else { ?>
												<?php woohoo_get_time(); ?>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if ( $bdaia_fp_c1 % 5 == 0 ) echo "</div>"; ?>
								<?php if ( $bdaia_fp_c2 == 5 ) $bdaia_fp_c2 = 0; ?>
								<?php $bdaia_fp_c1++; endwhile; endif; ?>
							<?php if ( $bdaia_fp_c1 % 5 != 1 ) echo "</div>";?>
						</div>

						<div class="cfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="cfix"></div>

	<?php } elseif ( $bdaia_fp_display == "grid4" ) { ?>

		<div class="bdaia-feature-posts bdaia-fp-grids bdaia-fp-grid4">
			<script>
				jQuery(document).ready(function () {
					jQuery( '.big-grids-uid<?php echo $fp_rand;?>' ).flexslider({
						animation       : "fade",
						slideshowSpeed  : <?php echo $speed; ?>,
						animationSpeed  : <?php echo $time; ?>,
						selector        : ".big-grids-single-slide",
						randomize       : false,
						pauseOnHover    : true,
						prevText        : "",
						nextText        : "",
						controlNav      : false
					});
				});
			</script>
			<div class="">
				<div class="bdaia-fp-grids-content">
					<div class="bdaia-fp-grids-inner">

						<div class="big-grids big-grids-uid<?php echo $fp_rand;?><?php if ( $num_posts <= 4 ) echo ' big-grids-disable-nav'; ?>">
							<?php $post_count = 0; if ( $bdaia_fp_query->have_posts() ) : while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post(); $bdaia_fp_c2++; $bdaia_fp_c3++; if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
								<?php
								if ( $bdaia_fp_c1 % 4 == 1 ) { $size = 'bdaia-gr1'; }
								if ( $bdaia_fp_c1 % 4 == 1 ) echo '<div class="big-grids-single-slide">'; ?>

								<div class="big-grid big-grid-<?php echo $bdaia_fp_c2; ?> fea-<?php echo $bdaia_fp_c3; ?>">
									<div class="big-grid-inner">

										<?php woohoo_video_icon_play(); ?>

										<?php
										$thumb_bg = '';
										if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
										{
											$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( $size ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( $size ) ) .'"';
										}
										?>

                                        <a class="img" <?php echo ( $thumb_bg ); ?> href="<?php the_permalink(); ?>"></a>

										<div class="featured-title">
											<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
											<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>
											<?php if( $post_reviews ){ ?>
												<div class="bdaia-post-rating">
													<?php echo woohoo_final_score(); ?>
												</div>
											<?php } else { ?>
												<?php woohoo_get_time(); ?>
											<?php } ?>
										</div>
									</div>
								</div>

								<?php if ( $bdaia_fp_c1 % 4 == 0 ) echo "</div><!--.big-grids-single-slide/-->"; ?>
								<?php if ( $bdaia_fp_c2 == 4 ) $bdaia_fp_c2 = 0; ?>
								<?php $bdaia_fp_c1++; endwhile; endif; ?>
							<?php if ( $bdaia_fp_c1 % 4 != 1 ) echo "</div><!--.big-grids-single-slide/-->";?>

						</div>

						<div class="cfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="cfix"></div>

	<?php } elseif ( $bdaia_fp_display == "grid5" ) { ?>

		<div class="bdaia-feature-posts bdaia-fp-grids bdaia-fp-grid5">
			<script>
				jQuery(document).ready(function () {
					jQuery( '.big-grids-uid<?php echo $fp_rand;?>' ).flexslider({
						animation       : "fade",
						slideshowSpeed  : <?php echo $speed; ?>,
						animationSpeed  : <?php echo $time; ?>,
						selector        : ".big-grids-single-slide",
						randomize       : false,
						pauseOnHover    : true,
						prevText        : "",
						nextText        : "",
						controlNav      : false
					});
				});
			</script>
			<div class="bd-container">
				<div class="bdaia-fp-grids-content">
					<div class="bdaia-fp-grids-inner">

						<div class="big-grids big-grids-uid<?php echo $fp_rand;?><?php if ( $num_posts <= 5 ) echo ' big-grids-disable-nav'; ?>">
							<?php if ( $bdaia_fp_query->have_posts() ) : while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post(); $bdaia_fp_c2++; $bdaia_fp_c3++; if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
								<?php
								$size = 'bdaia-gr1';
								if ( $bdaia_fp_c1 % 2 == 1 ) echo '<div class="big-grids-single-slide">';  ?>
								<div class="big-grid big-grid-<?php echo $bdaia_fp_c2; ?> fea-<?php echo $bdaia_fp_c3; ?>">
									<div class="big-grid-inner">

										<?php woohoo_video_icon_play(); ?>

										<?php
										$thumb_bg = '';
										if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
										{
											$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( $size ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( $size ) ) .'"';
										}
										?>

                                        <a class="img" <?php echo ( $thumb_bg ); ?> href="<?php the_permalink(); ?>"></a>

										<div class="featured-title">
											<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
											<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>
											<?php if( $post_reviews ){ ?>
												<div class="bdaia-post-rating">
													<?php echo woohoo_final_score(); ?>
												</div>
											<?php } else { ?>
												<?php woohoo_get_time(); ?>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if ( $bdaia_fp_c1 % 2 == 0 ) echo "</div>"; ?>
								<?php if ( $bdaia_fp_c2 == 2 ) $bdaia_fp_c2 = 0; ?>
								<?php $bdaia_fp_c1++; endwhile; endif; ?>
							<?php if ( $bdaia_fp_c1 % 2 != 1 ) echo "</div>";?>
						</div>

						<div class="cfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="cfix"></div>

	<?php } elseif ( $bdaia_fp_display == "grid6" ) { ?>
		<div class="bdaia-feature-posts bdaia-fp-grids bdaia-feature-grid6">
			<div class="bd-container">
				<div class="bdaia-fp-grids-content">
					<div class="bdaia-fp-grids-inner">
						<div class="big-grids big-grids-uid<?php echo $fp_rand;?>">
							<?php
							// WP_Query
							$fp_query_args['posts_per_page'] = 7;
							$bdaia_fp_query = new WP_Query( $fp_query_args );
							if ( $bdaia_fp_query->have_posts() ) :
								while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post();
									if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );

									$bdaia_fp_c2++;
									$bdaia_fp_c3++;
									$buffy = '';

									if( $bdaia_fp_c2 == 1 ){
										$buffy .= '<div class="woohoo-feature-grid6-group-1">';
										$size = 'bdaia-gr1';
									}
									if( $bdaia_fp_c2 == 3 ){
										$buffy .= '</div>';
										$buffy .= '<div class="woohoo-feature-grid6-group-2">';
										$size = 'bdaia-gr2';
									}
									if( $bdaia_fp_c2 == 6 ){
										$buffy .= '</div>';
										$buffy .= '<div class="woohoo-feature-grid6-group-3">';
										$size = 'bdaia-gr3';
									}
									if( $bdaia_fp_c2 == 8 ){
										$buffy .= '</div>';
									}
									echo $buffy;
									?>
									<div class="big-grid big-grid-<?php echo $bdaia_fp_c2; ?> fea-<?php echo $bdaia_fp_c3; ?>">
										<div class="big-grid-inner">
											<?php woohoo_video_icon_play(); ?>

											<?php
											$thumb_bg = '';
											if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
											{
												$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( $size ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( $size ) ) .'"';
											}
											?>

                                            <a class="img" <?php echo ( $thumb_bg ); ?> href="<?php the_permalink(); ?>"></a>

											<div class="featured-title">
												<?php woohoo_get_time(); ?>
												<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
											</div>
										</div>
									</div>
								<?php endwhile; wp_reset_query(); endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="cfix"></div>

	<?php } elseif ( $bdaia_fp_display == "grid7" ) { ?>

		<div class="bdaia-feature-posts bdaia-fp-s7">
			<div class="bd-container">
				<div class="bdaia-fp-content">
					<div class="bdaia-fp-container">
						<script>
							jQuery(document).ready(function () {
								jQuery( '.big-grids-uid<?php echo $fp_rand;?>' ).flexslider({
									animation       : "fade",
									slideshowSpeed  : <?php echo $speed; ?>,
									animationSpeed  : <?php echo $time; ?>,
									selector        : ".big-grids-single-slide",
									randomize       : false,
									pauseOnHover    : true,
									prevText        : "",
									nextText        : "",
									controlNav      : false
								});
							});
						</script>
						<div class="big-grids-container">
							<div class="big-grids big-grid7 big-grids-uid<?php echo $fp_rand;?><?php if ( $num_posts <= 4 ) echo ' big-grids-disable-nav'; ?>">
								<?php if ( $bdaia_fp_query->have_posts() ) : while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post(); $bdaia_fp_c2++; $bdaia_fp_c3++; if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
									<?php if ( $bdaia_fp_c1 % 4 == 1 ) echo '<div class="big-grids-single-slide">'; ?>

									<?php
									if ( $bdaia_fp_c2 == 1 ) {
										$size = 'bdaia-gr1';
									}
									elseif ( $bdaia_fp_c2 == 4 ) {
										$size = 'bdaia-gr3';
									}
									else {
										$size = 'bdaia-gr4';
									}
									?>

									<div class="big-grid big-grid-<?php echo $bdaia_fp_c2; ?> fea-<?php echo $bdaia_fp_c3; ?>">
										<div class="big-grid-inner">
											<?php woohoo_video_icon_play(); ?>

											<?php
											$thumb_bg = '';
											if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
											{
												$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( $size ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( $size ) ) .'"';
											}
											?>

                                            <a class="img" <?php echo ( $thumb_bg ); ?> href="<?php the_permalink(); ?>"></a>

											<div class="featured-title">
												<div class="featured-cat">
													<?php
													// Get category ------------ ^_^
													echo woohoo_custom_primary_category(); ?>
												</div>
												<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
												<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>
												<?php if( $post_reviews ){ ?>
													<div class="bdaia-post-rating">
														<?php echo woohoo_final_score(); ?>
													</div>
												<?php } else { ?>
													<?php woohoo_get_time(); ?>
												<?php } ?>
											</div>
										</div>
									</div>
									<?php if ( $bdaia_fp_c1 % 4 == 0 ) echo "</div>"; ?>
									<?php if ( $bdaia_fp_c2 == 4 ) $bdaia_fp_c2 = 0; ?>
									<?php $bdaia_fp_c1++; endwhile; wp_reset_query(); endif; ?>
								<?php if ( $bdaia_fp_c1 % 4 != 1 ) echo "</div>";?>
							</div>
						</div>
						<div class="cfix"></div>
					</div>
				</div>
			</div>
		</div><!-- .bdaia-feature-posts.bdaia-fp-s7 /-->

	<?php } elseif( $bdaia_fp_display == "carousel" ) { ?>

		<div class="bdaia-feature-posts bdaia-fp-s4">
			<script>
				jQuery(document).ready(function() {
					jQuery('.bdaia-pc<?php echo $fp_rand; ?>').imagesLoaded(function() {
						jQuery('.bdaia-pc<?php echo $fp_rand; ?>').slick({
							<?php if( is_rtl() ) : ?>
							rtl: true,
							<?php endif;?>
							touchMove      : false,
							speed          : <?php echo $time ?>,
							slide          : 'li',
							autoplay       : true,
							autoplaySpeed  : <?php echo $speed ?>,
							slidesToShow   : 4,
							slidesToScroll : 4,
							infinite       : true,
							arrows         : false,
							dots           : true,
							responsive     : [
								{ breakpoint : 1500, settings : { speed : 500, slide : 'li', slidesToShow : 4, slidesToScroll : 4 } },
								{ breakpoint : 1045, settings : { speed : 500, slide : 'li', slidesToShow : 3, slidesToScroll : 3 } },
								{ breakpoint : 990, settings : { speed : 500, slide : 'li', slidesToShow : 2, slidesToScroll : 2 } },
								{ breakpoint : 900,  settings : { speed : 500, slide : 'li', slidesToShow : 2, slidesToScroll : 2 } },
								{ breakpoint : 730,  settings : { speed : 500, slide : 'li', slidesToShow : 1, slidesToScroll : 1 } },
								{ breakpoint : 670,  settings : { speed : 500, slide : 'li', slidesToShow : 1, slidesToScroll : 1 } },
								{ breakpoint : 500,  settings : { speed : 500, slide : 'li', slidesToShow : 1, slidesToScroll : 1 } },
								{ breakpoint : 350,  settings : { speed : 500, slide : 'li', slidesToShow : 1, slidesToScroll : 1 } }
							]
						});
					});
				});
			</script>
			<div class="bd-container">
				<ul class="bd-post-carousel unstyled bd-post-carousel-after bdaia-pc<?php echo $fp_rand; ?>">
					<?php
					$size = 'bdaia-carousel';
					if ( $bdaia_fp_query->have_posts() ) :
						while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post();
							if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
							?>
							<li class="bd-post-carousel-item">
								<article>
									<?php woohoo_video_icon_play(); ?>

									<?php
									$thumb_bg = '';
									if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
									{
										$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( $size ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( $size ) ) .'"';
									}
									?>

                                    <a class="img" <?php echo ( $thumb_bg ); ?> href="<?php the_permalink(); ?>"></a>

									<div class="bd-meta-info-container">
										<div class="bd-meta-info-align">
											<div class="bd-meta">
												<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
											</div>
											<div class="bd-meta-info"><?php woohoo_get_time(); ?></div>
										</div>
									</div>
								</article>
							</li>
							<?php
						endwhile; wp_reset_query();
					endif;
					?>
				</ul>
			</div>
		</div><!-- .bdaia-feature-posts.bdaia-fp-s4 /-->

	<?php } ?>
<?php } ?>
<?php $post = $original_post; ?>

<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header();

// Post Settings.
$bdaia_p_breadcrumbs        = woohoo_get_option( 'bdaia_p_breadcrumbs'       );
$bdaia_p_categories_tags    = woohoo_get_option( 'bdaia_p_categories_tags'   );
$bdaia_p_author_name        = woohoo_get_option( 'bdaia_p_author_name'       );
$bdaia_p_date               = woohoo_get_option( 'bdaia_p_date'              );
$bdaia_p_time_read          = woohoo_get_option( 'bdaia_p_time_read'         );
$bdaia_p_post_views         = woohoo_get_option( 'bdaia_p_post_views'        );
$bdaia_p_post_like          = woohoo_get_option( 'bdaia_p_post_like'         );
$bdaia_p_comment_count      = woohoo_get_option( 'bdaia_p_comment_count'     );
$bdaia_p_post_tags          = woohoo_get_option( 'bdaia_p_post_tags'         );
$bdaia_p_next_prev          = woohoo_get_option( 'bdaia_p_next_prev'         );
$bdaia_p_author_box         = woohoo_get_option( 'bdaia_p_author_box'        );
$bdaia_p_commetns_posts     = woohoo_get_option( 'bdaia_p_commetns_posts'    );
$bdaia_p_top_sharing        = woohoo_get_option( 'bdaia_p_top_sharing'       );
$bdaia_p_bottom_sharing     = woohoo_get_option( 'bdaia_p_bottom_sharing'    );
$bdaia_p_featured_image     = woohoo_get_option( 'bdaia_p_featured_image'    );
$bdaia_p_featured_lightbox  = woohoo_get_option( 'bdaia_p_featured_lightbox' );

// GET post meta.
$meta_post_options      = get_post_meta( get_the_ID(), 'meta_post_options_bd', true    );

// GET Thumbnail.
$bdaia_thumbnail_Object         = get_post( get_post_thumbnail_id() );
$bdaia_feautred_image_lightbox  = $bdaia_thumbnail_Object->_bdaia_feautred_image_lightbox;
$thumb_description              = $bdaia_thumbnail_Object->post_excerpt;
$thumb_caption                  = $bdaia_thumbnail_Object->post_content;
$image_id                       = get_post_thumbnail_id( get_the_ID() );
$image_url                      = wp_get_attachment_image_src( $image_id, 'full' );
$image_url                      = $image_url[0];

$bd_p_featured_image = $bd_p_featured_gallery = $post_sidebars = $baia_itemscope = "";

if ( isset ( $meta_post_options['show_post_feature_img_bd'] )     ) $bd_p_featured_image      = $meta_post_options['show_post_feature_img_bd'];
if ( isset ( $meta_post_options['bdaia_format_gallery_style'] )   ) $bd_p_featured_gallery    = $meta_post_options['bdaia_format_gallery_style'];

$bd_p_review_pos    = get_post_meta( get_the_ID(), 'bdaia_taqyeem_position', true   );
$post_reviews       = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true            );

if ( isset ( $meta_post_options['sidebar_position_bd'] ) ) $post_sidebars = $meta_post_options['sidebar_position_bd']; // Meta Post Sidebar Postion.
if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' ); // Site Sidebar Postion in Themepanel.

if ( $post_sidebars == 'sideNo' ) $size = $GLOBALS['bdaia-full'];
else $size = $GLOBALS['bdaia-large'];

$protocol = is_ssl() ? 'https' : 'http';

if ( $post_reviews ){
	$baia_itemscope = ' itemscope itemtype="'.$protocol.'://schema.org/Review"';
}
else {
	$baia_itemscope = ' itemscope itemtype="'.$protocol.'://schema.org/Article"';
}
$woohoo_get_post_format = 	get_post_format( get_the_ID() );
$woohoo_video_id    = $woohoo_video_type = '';
$woohoo_p_video     = get_post_meta( get_the_ID(),'post_video_bd', true );
if( isset( $woohoo_p_video['video'] )       ) $woohoo_video_id      = $woohoo_p_video['video'];
if( isset( $woohoo_p_video['video_type'] )  ) $woohoo_video_type    = $woohoo_p_video['video_type']; ?>

	<?php if( $woohoo_video_id ){ ?>
		<div class="post-style10-head">
			<div class="post-style10-cover-bg">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="bd-container">
						<div class="post-style10-cover">
							<div class="vid-play bdaia-burna">
								<span class="bdaia-io bdaia-io-controller-play"></span>
							</div>
							<?php if ( has_post_thumbnail ( get_the_ID() ) ) { ?>
							<?php the_post_thumbnail ( $GLOBALS['bdaia-full'] ); ?>
							<?php } else { ?>
								<img src="<?php echo woohoo_get_video_image(); ?>" alt="<?php the_title(); ?>" width="1240" height="540" />
							<?php } ?>
						</div>

						<div class="bdaia-post-featured-video">
							<?php
							if ( $woohoo_video_type == 'youtube' && $woohoo_video_id   ) echo '<textarea class="embed-code" style="display: none"><iframe class="post-style10-iframe" width="100%" height="214" src="'.$protocol.'://www.youtube.com/embed/' . $woohoo_video_id . '?&wmode=opaque&autoplay=1" frameborder="0" allowfullscreen></iframe></textarea>';
							elseif ( $woohoo_video_type == 'vimeo' && $woohoo_video_id ) echo '<textarea class="embed-code" style="display: none"><iframe class="post-style10-iframe" src="'.$protocol.'://player.vimeo.com/video/' . $woohoo_video_id . '?title=0&amp;byline=0&amp;portrait=0" width="100%" height="214" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></textarea>';
							elseif ( $woohoo_video_type == 'daily' && $woohoo_video_id ) echo '<textarea class="embed-code" style="display: none"><iframe class="post-style10-iframe" frameborder="0" width="100%" height="214" src="'.$protocol.'://www.dailymotion.com/embed/video/' . $woohoo_video_id . '"></iframe></textarea>';
							?>
						</div>
					</div>
				<?php endwhile; // END of the loop. ?>
			</div>
		</div>
	<?php } ?>

	<div class="post-style10-header">
		<div class="bd-container">
			<?php while ( have_posts() ) : the_post(); ?>
				<header class="bdaia-post-header">

					<?php
					// Breadcrumbs.
					if( $bdaia_p_breadcrumbs ) woohoo_breadcrumbs(); ?>

					<?php if( $bdaia_p_categories_tags ) : ?>
						<div class="bdaia-category">
							<?php
							foreach( ( get_the_category() ) as $cat )
								echo '<a class="bd-cat-link bd-cat-'.$cat->cat_ID.'" href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->cat_name . '</a>'."\n";
							?>
						</div>
						<!-- END category. -->
					<?php endif; ?>

					<div class="bdaia-post-title">
						<h1 class="post-title entry-title"><span><?php the_title(); ?></span></h1>
					</div>
					<!-- END Post Title. -->

					<?php get_template_part( 'framework/single/post-meta-info' ); ?>

				</header>
			<?php endwhile; // END of the loop. ?>
		</div>
	</div>

	<div class="bd-container bdaia-post-template">
		<div class="bd-main bdaia-site-content" id="bdaia-primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?> <?php echo $baia_itemscope; ?>>

						<?php if( $bdaia_p_top_sharing ) woohoo_get_post_sharing( 'top' ); // END Post Sharing. ?>

						<div class="bdaia-post-content">
							<?php
							if( get_post_format( get_the_ID() ) == 'gallery' ) {

								if( $bd_p_featured_gallery == 'slideshow' ) woohoo_post_gallery( $size );
								elseif( $bd_p_featured_gallery == 'grid' ) woohoo_gallery_grid( $GLOBALS['bdaia-gallery-grid'] );

							}
							elseif( get_post_meta( get_the_ID(),'bdaia_meta_soundcloud_embed', true ) ) {

								$bdaia_p_soundcloud = get_post_meta( get_the_ID(),'bdaia_meta_soundcloud_embed', true );
								echo '<div class="bdaia-post-soundcloud">' . do_shortcode( stripslashes ( $bdaia_p_soundcloud['soundcloud_embed'] ) ) . '</div>';
							}
							elseif( ( !empty( $bd_p_featured_image ) && $bd_p_featured_image == false ) || ( empty( $bd_p_featured_image ) && $bdaia_p_featured_image ) ) {

								if( ( !empty( $bdaia_feautred_image_lightbox ) && $bdaia_feautred_image_lightbox == 'lightbox' ) || ( empty( $bdaia_feautred_image_lightbox ) && $bdaia_p_featured_lightbox == 'lightbox' ) )
								{
									if( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
									{
										?>
										<div class="bdaia-post-featured-image" style="margin-bottom: 30px">
											<a href="<?php echo esc_url ( $image_url) ; ?>" rel="lightbox-enabled" data-caption="<?php echo esc_attr( $thumb_description ); ?>">
												<?php the_post_thumbnail( $size ); ?>
												<?php if ( ! empty( $thumb_caption ) || ! empty( $thumb_description ) ) { ?>
													<div class="bdaia-featured-text">
														<?php if ( ! empty( $thumb_caption ) ) { ?>
															<div class="bdaia-post-caption"><?php echo esc_attr( $thumb_caption ); ?></div>
														<?php } ?>

														<?php if ( ! empty( $thumb_description ) ) { ?>
															<div class="bdaia-post-description"><?php echo esc_attr( $thumb_description ); ?></div>
														<?php } ?>
													</div>
												<?php } ?>
											</a>
										</div>
										<?php
									}
								} else { ?>

									<?php if( has_post_thumbnail( get_the_ID() ) ) { ?>
										<div class="bdaia-post-featured-image">
											<?php the_post_thumbnail( $size ); ?>
											<?php if( !empty( $thumb_caption) || !empty( $thumb_description ) ){ ?>
												<div class="bdaia-featured-text">
													<?php if( !empty( $thumb_caption) ){ ?>
														<div class="bdaia-post-caption"><?php echo esc_attr( $thumb_caption ); ?></div>
													<?php } ?>

													<?php if( !empty( $thumb_description ) ){ ?>
														<div class="bdaia-post-description"><?php echo esc_attr( $thumb_description ); ?></div>
													<?php } ?>
												</div>
											<?php } ?>
										</div>
										<!-- END Featured Image. -->

									<?php } // has_post_thumbnail.  ?>

								<?php } } ?>

							<?php
							// Top E3.
							get_template_part( 'framework/single/post-top-e3' ); ?>

							<?php
							// Review pos top.
							if( $bd_p_review_pos == 'top_bd' ) get_template_part('framework/global/bdaia-post-review'); ?>

							<?php
							// The Content.
							the_content(); ?>

							<?php
							// Page links.
							get_template_part( 'framework/single/post-page-links' ); ?>

							<?php
							// Review pos bottom.
							if( $bd_p_review_pos == 'bottom_bd' ) get_template_part('framework/global/bdaia-post-review'); ?>

						</div><!-- END Post Content. -->

						<footer>
							<?php
							// Tags.
							if ( $bdaia_p_post_tags ) the_tags( '<div class="clear"></div><div class="tagcloud"><span>' . woohoo__tr( 'Tags' ) . '</span>', '', '</div><div class="clear"></div>' ); ?>

							<?php
							// Bottom Sharing.
							if( $bdaia_p_bottom_sharing ) woohoo_get_post_sharing( 'bottom' ); ?>

							<?php
							// Mail Chimp.
							if( woohoo_get_option( 'bdaia_p_mailchimp' ) ) get_template_part( 'framework/single/post-mailchimp-box' ); ?>

							<?php
							// Bottom E3.
							get_template_part( 'framework/single/post-bottom-e3' ); ?>

							<?php
							// Next/Prev.
							if( $bdaia_p_next_prev ) get_template_part( 'framework/single/post-next-prev' ); ?>

							<?php
							// Author Box.
							if( $bdaia_p_author_box && get_the_author_meta( 'description' ) ) get_template_part( 'framework/single/post-author-box' ); ?>
						</footer>

						<?php
						// Itemscpoe.
						get_template_part( 'framework/single/post-itemscope' ); ?>

					</article>

					<?php
					// Related.
					get_template_part( 'framework/global/bdaia-related' ); ?>

					<?php
					// Comments.
					if( ! $bdaia_p_commetns_posts ) get_template_part( 'framework/single/post-comments' ); ?>

				<?php endwhile; // END of the loop. ?>

				<?php
				// Check Also.
				get_template_part( 'framework/global/check-also' ); ?>
			</div>

		</div><!-- END Content. -->

		<?php get_sidebar(); // END Sidebar. ?>

	</div>

<?php get_footer(); // END Footer. ?>
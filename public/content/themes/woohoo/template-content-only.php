<?php
/*
 Template Name: Content Only
 Template Post Type: post, page
*/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

$meta_GET = get_post_custom( get_the_ID() );
if( isset( $meta_GET[ 'bdaia_builder_page' ][0] ) )
{
	$home_boxes = false;
	if( !empty( $meta_GET[ 'bdaia_builder_page' ][0] ) )
	{
		$home_boxes = $meta_GET[ 'bdaia_builder_page' ][0];
		if( is_serialized( $home_boxes ) ){
			$home_boxes = unserialize ( $home_boxes );
		}
	}
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php if( woohoo_get_option( 'responsive' ) ) : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<?php else : ?>
		<meta name="viewport" content="width=1045" />
	<?php endif; ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope=itemscope itemtype="https://schema.org/WebPage">

<?php woohoo_template1_header(); ?>
<div class="page-outer bdaia-header-default<?php echo woohoo_page_class(); ?>">
	<div class="bg-cover"></div>

	<div id="page">
		<div class="inner-wrapper">
			<div id="warp" class="clearfix bdaia-sidebar-none">
				<?php woohoo_above_content_box(); ?>
				<div class="bdMain">

					<?php if( !empty( $meta_GET[ 'bdaia_builder_p_active' ][0] ) && ! woohoo_get_option( 'bdaia_disable_builder_page' ) ) { ?>
						<div class="bdaia-home-container">
							<div class="bd-container">
								<div class="bd-c-row">
									<div class="bd-main">
										<?php
										$repeat     = 1;

										if ( !empty( $home_boxes ) && is_array( $home_boxes ) )
										{
											foreach ( $home_boxes as $k => $v )
											{
												$block_title        = ( isset( $v['block_title'] ) ) ? $v['block_title'] : '';
												$title_url          = ( isset( $v['title_url'] ) ) ? $v['title_url'] : '';
												$title_text_color   = ( isset( $v['title_text_color'] ) ) ? $v['title_text_color'] : '';
												$title_bg_color     = ( isset( $v['title_bg_color'] ) ) ? $v['title_bg_color'] : '';
												$margin_t           = ( isset( $v['margin_t'] ) ) ? $v['margin_t'] : '';
												$margin_b           = ( isset( $v['margin_b'] ) ) ? $v['margin_b'] : '';
												$cat                = ( isset( $v['cat'] ) ) ? $v['cat'] : array(0);
												$cat_uids           = ( isset( $v['cat_uids'] ) ) ? $v['cat_uids'] : '';
												$tag_slug           = ( isset( $v['tag_slug'] ) ) ? $v['tag_slug'] : '';
												$post_in            = ( isset( $v['post_in'] ) ) ? $v['post_in'] : '';
												$sort_order         = ( isset( $v['sort_order']) ) ? $v['sort_order'] : array(0);
												$num_posts          = ( isset( $v['num_posts'] ) ) ? $v['num_posts'] : '';
												$text_code          = ( isset( $v['text_code'] ) ) ? $v['text_code'] : '';
												$offset             = ( isset( $v['offset'] ) ) ? $v['offset'] : '';
												$ajax_pagination    = ( isset( $v['ajax_pagination']) ) ? $v['ajax_pagination'] : array(0);
												$pagination         = ( isset( $v['pagination']) ) ? $v['pagination'] : array(0);
												$display            = ( isset( $v['display']) ) ? $v['display'] : array(0);

												$box_id             = $GLOBALS['k'];
												$block_title        = $GLOBALS['block_title'];
												$title_url          = $GLOBALS['title_url'];
												$title_text_color   = $GLOBALS['title_text_color'];
												$title_bg_color     = $GLOBALS['title_bg_color'];
												$margin_t           = $GLOBALS['margin_t'];
												$margin_b           = $GLOBALS['margin_b'];
												$cat                = $GLOBALS['cat'];
												$cat_uids           = $GLOBALS['cat_uids'];
												$tag_slug           = $GLOBALS['tag_slug'];
												$post_in            = $GLOBALS['post_in'];
												$sort_order         = $GLOBALS['sort_order'];
												$num_posts          = $GLOBALS['num_posts'];
												$offset             = $GLOBALS['offset'];
												$ajax_pagination    = $GLOBALS['ajax_pagination'];
												$pagination         = $GLOBALS['pagination'];
												$display            = $GLOBALS['display'];
												$text_code          = $GLOBALS['text_code'];

												switch ( $v['type'] )
												{
													case "block1":
														echo do_shortcode('[bdaia_block1 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block2":
														echo do_shortcode('[bdaia_block2 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block13":
														echo do_shortcode('[bdaia_block13 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block3":
														echo do_shortcode('[bdaia_block3 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block4":
														echo do_shortcode('[bdaia_block4 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block5":
														echo do_shortcode('[bdaia_block5 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block6":
														echo do_shortcode('[bdaia_block6 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block7":
														echo do_shortcode('[bdaia_block7 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block8":
														echo do_shortcode('[bdaia_block8 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block9":
														echo do_shortcode('[bdaia_block9 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block10":
														echo do_shortcode('[bdaia_block10 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block11":
														echo do_shortcode('[bdaia_block11 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "blog":
														echo do_shortcode('[bdaia_blog block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" num_posts="'.$num_posts.'" pagination="'.$pagination.'" display="'.$display.'"]');
														break;

													case "slider":
														echo do_shortcode('[bdaia_slider margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" post_in="'.$post_in.'"]');
														break;

													case "block12" :
														echo do_shortcode('[bdaia_block12 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ajax_pagination="'.$ajax_pagination.'"]');
														break;

													case "block23" :
														echo do_shortcode('[bdaia_block23 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'"]');
														break;

													case "block24":
														print_r( do_shortcode('[bdaia_block24 block_title="'.$block_title.'" title_url="'.$title_url.'" title_text_color="'.$title_text_color.'" title_bg_color="'.$title_bg_color.'" margin_t="'.$margin_t.'" margin_b="'.$margin_b.'" cat="'.$cat.'" cat_uids="'.$cat_uids.'" tag_slug="'.$tag_slug.'" sort_order="'.$sort_order.'" num_posts="'.$num_posts.'" offset="'.$offset.'" ]') );
														break;

													case "ad":
														$rndn = woohoo_rand(7);
														$block_margin ='';
														if( !empty( $margin_t ) || !empty( $margin_b ) ) {
															$block_margin = ' style="';
															if( !empty( $margin_t ) ) $block_margin .= ' margin-top:'.$margin_t.'px !important;';
															if( !empty( $margin_b ) ) $block_margin .= ' margin-bottom:'.$margin_b.'px !important;';
															$block_margin .= '"';
														}
														?>
														<div class="cfix"></div>
														<div class="bdaia-block-e3 bdaia-block-e3-uid<?php echo $rndn;?>"<?php echo $block_margin; ?>><div class="bdaia-ad-container"><?php if( !empty( $text_code ) ) echo do_shortcode( htmlspecialchars_decode( stripslashes ( $text_code ) ) ); ?></div></div>
														<?php
														break;
												}
											}
										}

										//get_template_part('time');
										?>
									</div>

								</div>
							</div>
						</div><!-- END Home Container. -->

					<?php } else {

						// GET post meta.
						$meta_page_options = get_post_meta( get_the_ID(), 'meta_page_options_bd', true    );
						$post_sidebars = "";
						if( isset( $meta_page_options['sidebar_position_bd'] ) ) $post_sidebars = $meta_page_options['sidebar_position_bd']; // Meta Post Sidebar Postion.
						if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' ); // Site Sidebar Postion in Themepanel.
						if( $post_sidebars == 'sideNo' ) $size = $GLOBALS['bdaia-full'];
						else $size = $GLOBALS['bdaia-large'];

						// GET Thumbnail.
						$bdaia_thumbnail_Object         = get_post( get_post_thumbnail_id() );
						$bdaia_feautred_image_lightbox  = $bdaia_thumbnail_Object->_bdaia_feautred_image_lightbox;
						$thumb_description              = $bdaia_thumbnail_Object->post_excerpt;
						$thumb_caption                  = $bdaia_thumbnail_Object->post_content;
						$size                           = $GLOBALS['bdaia-large'];
						$image_id                       = get_post_thumbnail_id( get_the_ID() );
						$image_url                      = wp_get_attachment_image_src( $image_id, 'full' );
						$image_url                      = $image_url[0]; ?>

						<div class="bd-container bdaia-post-template">
							<div class="bd-c-row">
								<div class="bd-main bdaia-site-content" id="bdaia-primary">
									<div id="content" role="main">
										<?php if( isset( $meta_page_options['bdaia_hide_page_breadcrumb'] ) == 0 && woohoo_get_option( 'bdaia_page_breadcrumbs' ) == 0 ) woohoo_breadcrumbs(); // END Breadcrumbs. ?>
										<?php while ( have_posts() ) : the_post(); ?>
											<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>
												<?php if( isset( $meta_page_options['bdaia_hide_page_title'] ) == 0 ): ?>
													<header class="bdaia-post-header">
														<div class="bdaia-post-title">
															<h1 class="post-title entry-title"><span><?php the_title(); ?></span></h1>
														</div>
													</header>
												<?php endif;?>
												<div class="bdaia-post-content"<?php if ( isset( $meta_page_options['bdaia_hide_page_title'] ) == 1 ) { echo "style=\"margin-top: 0;\""; } ?>>
													<?php
													if( ( !empty( $bdaia_feautred_image_lightbox ) && $bdaia_feautred_image_lightbox == 'lightbox' ) ) {
														if( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) ) { ?>
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
													}
													else {
														if( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) ) { ?>
															<div class="bdaia-post-featured-image" style="margin-bottom: 30px">
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
															</div>
														<?php } } // has_post_thumbnail. ?>
													<?php the_content(); ?>
													<?php
													// Page links.
													get_template_part( 'framework/single/post-page-links' ); ?>
												</div>
												<footer>
													<?php if( woohoo_get_option( 'bdaia_page_bottom_sharing' ) ) woohoo_get_post_sharing( 'bottom' ); // END Post Sharing. ?>
												</footer>
											</article>
											<?php
											// Comments.
											if( isset( $meta_page_options['bdaia_hide_page_comments'] ) == 0 && ! woohoo_get_option( 'bdaia_page_commetns_posts' ) ) get_template_part( 'framework/single/post-comments' ); ?>
										<?php endwhile; // END of the loop. ?>
									</div>
								</div><!-- END Content. -->

							</div>
						</div>
					<?php } ?>

				</div>
			</div>
		</div><!-- #page/-->
	</div><!-- .page-outer/-->

	<?php wp_footer(); ?>
</body>
</html>
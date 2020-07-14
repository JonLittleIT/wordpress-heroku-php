<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header();

// Post Settings.
$bdaia_thumbnail_Object         = get_post( get_post_thumbnail_id() );
$bdaia_feautred_image_lightbox  = $bdaia_thumbnail_Object->_bdaia_feautred_image_lightbox;
$thumb_description              = $bdaia_thumbnail_Object->post_excerpt;
$thumb_caption                  = $bdaia_thumbnail_Object->post_content;

$image_id       = get_post_thumbnail_id( get_the_ID() );
$image_url      = wp_get_attachment_image_src( $image_id, 'full' );
$image_url      = $image_url[0];

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

$size           = $GLOBALS['bdaia-full'];

$bd_p_featured_image = $bd_p_featured_gallery = "";

if( isset( $meta_post_options['show_post_feature_img_bd'] ) ) $bd_p_featured_image = $meta_post_options['show_post_feature_img_bd'];
if( isset( $meta_post_options['bdaia_format_gallery_style'] ) ) $bd_p_featured_gallery = $meta_post_options['bdaia_format_gallery_style'];

$bd_p_review_pos    = get_post_meta( get_the_ID(), 'bdaia_taqyeem_position', true   );
$post_reviews       = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true            );

$protocol = is_ssl() ? 'https' : 'http';

$baia_itemscope = "";
if( $post_reviews ){
	$baia_itemscope = ' itemscope itemtype="'.$protocol.'://schema.org/Review"';
}
else {
	$baia_itemscope = ' itemscope itemtype="'.$protocol.'://schema.org/Article"';
}
?>

	<div class="bd-container bdaia-post-template">

		<div class="bd-main bdaia-site-content" id="bdaia-primary">

			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?> <?php echo $baia_itemscope; ?>>

						<?php if( $bdaia_p_top_sharing ) woohoo_get_post_sharing( 'top' ); // END Post Sharing. ?>

						<div class="bdaia-post-content">
							<?php
							if( get_post_format( get_the_ID() ) == 'video' ) {
								?>
								<div class="bdaia-post-featured-video">
									<?php woohoo_get_video(); ?>
								</div>
								<?php
							}
							elseif( get_post_format( get_the_ID() ) == 'gallery' ) {
								$size = "bd-large";
								if( $bd_p_featured_gallery == 'slideshow' ) woohoo_post_gallery( $size );
								elseif( $bd_p_featured_gallery == 'grid' ) woohoo_gallery_grid( $GLOBALS['bdaia-gallery-grid'] );

							}
							elseif( get_post_meta( get_the_ID(),'bdaia_meta_soundcloud_embed', true ) ) {

								$bdaia_p_soundcloud = get_post_meta( get_the_ID(),'bdaia_meta_soundcloud_embed', true );
								echo '<div class="bdaia-post-soundcloud">' . do_shortcode( stripslashes ( $bdaia_p_soundcloud['soundcloud_embed'] ) ) . '</div>';
							}
							?>

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

		</div>
		<!-- END Content. -->

	</div>

<?php get_footer(); // END Footer. ?>
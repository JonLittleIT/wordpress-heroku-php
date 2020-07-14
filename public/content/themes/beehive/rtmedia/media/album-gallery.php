<?php
/**
 * Generate random number for gallery container
 * This will be useful when multiple gallery shortcodes are used in a single page
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$rand_id = wp_rand( 0, 1000 );
?>
<div class="rtmedia-container" id="rtmedia_gallery_container_<?php echo esc_attr( $rand_id ); ?>">
	<?php
	do_action( 'rtmedia_before_album_gallery' );

	$rtm_gallery_title = get_rtmedia_gallery_title();
	?>

	<div id="rtm-media-options" class="rtm-media-options subnav-filters filters rtm-gallery-options">
		<?php do_action( 'rtmedia_album_gallery_actions' ); ?>
	</div>

	<div id="rtm-media-gallery-uploader" class="rtm-media-gallery-uploader">
		<?php rtmedia_uploader( array( 'is_up_shortcode' => false ) ); ?>
	</div>

	<div id="rtm-gallery-title-container" class="clearfix">
		<h2 class="rtm-gallery-title">
			<?php
			if ( $rtm_gallery_title ) {
				echo esc_html( $rtm_gallery_title );
			} else {
				esc_html_e( 'Album List', 'buddypress-media' );
			}
			?>
		</h2>
	</div>

	<?php do_action( 'rtmedia_after_album_gallery_title' ); ?>

	<?php
	do_action( 'rtmedia_after_media_gallery_title' );
	if ( have_rtmedia() ) {
		?>

		<!-- addClass 'rtmedia-list-media' for work properly selectbox -->
		<ul class="rtmedia-list-media rtmedia-list rtmedia-album-list clearfix">
			<?php
			while ( have_rtmedia() ) :
				rtmedia();
				?>
					<?php include 'album-gallery-item.php'; ?>
				<?php endwhile; ?>
		</ul>

		<div class="rtmedia_next_prev rtm-load-more clearfix">
			<!-- these links will be handled by backbone -->
			<?php
			global $rtmedia;

			$general_options = $rtmedia->options;

			if ( isset( $rtmedia->options['general_display_media'] ) && 'pagination' === $general_options['general_display_media'] ) {
				rtmedia_media_pagination();
			} else {
				?>
				<a id="rtMedia-galary-next" class="color-primary <?php echo ( rtmedia_offset() + rtmedia_per_page_media() < rtmedia_count() ) ? esc_attr( 'show-it' ) : esc_attr( 'hide-it' ); // @codingStandardsIgnoreLine ?>" href="<?php echo esc_url( rtmedia_pagination_next_link() ); ?>">
					<?php esc_html_e( 'Load More', 'buddypress-media' ); ?>
				</a>
				<?php
			}
			?>
		</div><!--/.rtmedia_next_prev-->
	<?php } else { ?>
		<p class="rtmedia-no-media-found">
			<?php
			$message = apply_filters( 'rtmedia_no_media_found_message_filter', esc_html__( 'Sorry !! There\'s no media found for the request !!', 'buddypress-media' ) );
			echo esc_html( $message );
			?>
		</p>
	<?php } ?>

	<?php do_action( 'rtmedia_after_album_gallery' ); ?>
	<?php do_action( 'rtmedia_after_media_gallery' ); ?>
</div>

<!-- template for single media in gallery -->
<script id="rtmedia-gallery-item-template" type="text/template">
	<div class="rtmedia-item-thumbnail">
		<a href="media/<%= id %>">
			<img src="<%= guid %>">
		</a>
	</div>
	<div class="rtmedia-item-title">
		<h4 title="<%= media_title %>">
			<a href="media/<%= id %>">
				<%= media_title %>
			</a>
		</h4>
	</div>
</script>
<!-- rtmedia_actions remained in script tag -->

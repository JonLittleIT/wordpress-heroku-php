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

<div class="rtmedia-container" id="rtmedia_gallery_container_<?php echo intval( $rand_id ); ?>">
	<?php do_action( 'rtmedia_before_media_gallery' ); ?>
	<?php
		$rtm_gallery_title = get_rtmedia_gallery_title();
		global $rtmedia_query;
	?>

	<?php if ( isset( $rtmedia_query->is_gallery_shortcode ) && true === $rtmedia_query->is_gallery_shortcode ) { // if gallery is displayed using gallery shortcode. ?>
		<nav class="nav-component">
			<ul class="nav-component-list media-navigation">
				<li class="media-navigation-item selected">
					<a href="<?php the_permalink(); ?>" class="media-navigation-link">
						<span class="nav-link-text">
							<?php
							if ( $rtm_gallery_title ) {
								echo esc_html( $rtm_gallery_title );
							} else {
								esc_html_e( 'Media Gallery', 'buddypress-media' );
							}
							?>
						</span>
					</a>
				</li>
				<?php if ( is_user_logged_in() && isset( $rtmedia_query->original_query['uploader'] ) && $rtmedia_query->original_query['uploader'] ) : ?>
				<li class="media-navigation-item">
					<a href="#rtmedia-uploader-form" class="media-navigation-link">
						<span class="nav-link-text"><?php echo esc_html_e( 'Add', 'beehive' ); ?></span>
					</a>
				</li>
				<?php endif; ?>
			</ul>
		</nav>

		<div id="rtm-media-options" class="rtm-media-options <?php echo ( function_exists( 'rtmedia_media_search_enabled' ) && rtmedia_media_search_enabled() ? 'rtm-media-search-enable beehive-filters' : '' ); ?>">
			<div class="filter-wrapper">
				<?php do_action( 'rtmedia_media_gallery_shortcode_actions' ); ?>

				<?php
				/**
				 * Show media search if search_filter="true"
				 */
				if ( isset( $shortcode_attr['attr']['search_filter'] ) ) {
					if ( 'true' === $shortcode_attr['attr']['search_filter'] ) {
						add_search_filter( $shortcode_attr['attr'] );
					}
					unset( $shortcode_attr['attr']['search_filter'] );
				}
				?>
			</div>
		</div>

		<div id="rtm-gallery-title-container" class="clearfix rtm-gallery-shortcode-title-container">

			<h2 class="screen-reader-text">
				<?php
				if ( $rtm_gallery_title ) {
					echo esc_html( $rtm_gallery_title );
				} else {
					esc_html_e( 'Media Gallery', 'buddypress-media' );
				}
				?>
			</h2>

			<?php do_action( 'rtmedia_gallery_after_title' ); ?>
		</div>

		<?php do_action( 'rtmedia_gallery_after_title_container' ); ?>

		<?php
	} else {
		?>

		<div id="rtm-media-options" class="subnav-filters filters rtm-media-options <?php echo ( function_exists( 'rtmedia_media_search_enabled' ) && rtmedia_media_search_enabled() ? 'rtm-media-search-enable' : '' ); ?>">
			<?php do_action( 'rtmedia_media_gallery_actions' ); ?>
		</div>

		<div id="rtm-media-gallery-uploader" class="rtm-media-gallery-uploader">
			<?php rtmedia_uploader( array( 'is_up_shortcode' => false ) ); ?>
		</div>

		<div id="rtm-gallery-title-container" class="clearfix rtm-gallery-media-title-container">
			<h2 class="rtm-gallery-title">
				<?php
				if ( $rtm_gallery_title ) {
					echo esc_html( $rtm_gallery_title );
				} else {
					esc_html_e( 'Media Gallery', 'buddypress-media' );
				}
				?>
			</h2>

			<?php do_action( 'rtmedia_gallery_after_title' ); ?>
		</div>

		<?php do_action( 'rtmedia_gallery_after_title_container' ); ?>
		<?php
	}
	?>
	<?php do_action( 'rtmedia_after_media_gallery_title' ); ?>
	<?php if ( have_rtmedia() ) { ?>
		<ul class="rtmedia-list rtmedia-list-media rtm-gallery-list <?php rtmedia_media_gallery_class(); ?>">

			<?php
			while ( have_rtmedia() ) :
				rtmedia();
				?>

				<?php include 'media-gallery-item.php'; ?>

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
				<a id="rtMedia-galary-next" class="color-primary <?php echo ( rtmedia_offset() + rtmedia_per_page_media() < rtmedia_count() ) ? esc_attr( 'show-it' ) : esc_attr( 'hide-it' ); // @codingStandardsIgnoreLine ?>" href="<?php esc_url( rtmedia_pagination_next_link() ); ?>"><?php esc_html_e( 'Load More', 'buddypress-media' ); ?></a>
				<?php
			}
			?>
		</div>
	<?php } else { ?>
		<p class="rtmedia-no-media-found">
			<?php
			$message = apply_filters( 'rtmedia_no_media_found_message_filter', esc_html__( 'Sorry !! There\'s no media found for the request !!', 'buddypress-media' ) );
			echo esc_html( $message );
			?>
		</p>
		<?php
	} // End if() statement.
	?>

	<?php do_action( 'rtmedia_after_media_gallery' ); ?>

</div>

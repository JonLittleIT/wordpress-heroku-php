<?php
/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php
	wp_enqueue_style( 'adverts-frontend' );
	wp_enqueue_style( 'adverts-icons' );
	wp_enqueue_style( 'adverts-icons-animate' );

	wp_enqueue_script( 'adverts-frontend' );
?>

<?php do_action( 'adverts_tpl_single_top', $post_id ); ?>

<div class="adverts-single-box">
	<div class="adverts-single-author">
		<div class="adverts-single-author-avatar">
			<?php $id_or_email = get_post_field( 'post_author', $post_id ); ?>
			<?php $id_or_email = $id_or_email ? $id_or_email : get_post_meta( $post_id, 'adverts_email', true ); ?>
			<?php echo get_avatar( $id_or_email, 48 ); ?>
		</div>
		<div class="adverts-single-author-name">
			<p class="name">
				<?php // translators: ad posted by author name. ?>
				<?php echo wp_kses_post( apply_filters( 'adverts_tpl_single_posted_by', sprintf( __( 'by <strong>%s</strong>', 'adverts' ), get_post_meta( $post_id, 'adverts_person', true ) ), $post_id ) ); ?>
			</p>
			<span class="published-date">
				<?php // translators: ad published date. ?>
				<?php echo esc_html( sprintf( __( 'Published: %1$s (%2$s ago)', 'adverts' ), date_i18n( get_option( 'date_format' ), get_post_time( 'U', false, $post_id ) ), human_time_diff( get_post_time( 'U', false, $post_id ), current_time( 'timestamp' ) ) ) ); ?>
			</span>
		</div>
	</div>

	<?php if ( get_post_meta( $post_id, 'adverts_price', true ) ) : ?>
		<div class="adverts-single-price">
			<span class="adverts-price-box color-primary"><?php echo esc_html( adverts_get_the_price( $post_id ) ); ?></span>
		</div>
	<?php elseif ( adverts_config( 'empty_price' ) ) : ?>
		<div class="adverts-single-price adverts-price-empty">
			<span class="adverts-price-box color-primary"><?php echo esc_html( adverts_empty_price( get_the_ID() ) ); ?></span>
		</div>
	<?php endif; ?>
</div>

<h3 class="post-block-title"><?php esc_html_e( 'Description:', 'beehive' ); ?></h3>

<div class="adverts-grid adverts-grid-closed-top adverts-grid-with-icons adverts-single-grid-details">
	<?php $advert_category = get_the_terms( $post_id, 'advert_category' ); ?>
	<?php if ( ! empty( $advert_category ) ) : ?> 
	<div class="adverts-grid-row ">
		<div class="adverts-grid-col adverts-col-35">
			<span class="adverts-round-icon light"><i class="uil-apps"></i></span>
			<span class="adverts-row-title"><strong><?php esc_html_e( 'Category', 'adverts' ); ?></strong></span>
		</div>
		<div class="adverts-grid-col adverts-col-65">
			<?php foreach ( $advert_category as $c ) : ?> 
				<a href="<?php echo esc_attr( get_term_link( $c ) ); ?>" class="color-primary category-name"><?php echo esc_html( join( '/', advert_category_path( $c ) ) ); ?></a>
			<?php endforeach; ?>
		</div>
	</div>        
	<?php endif; ?>

	<?php if ( get_post_meta( $post_id, 'adverts_location', true ) ) : ?>
		<div class="adverts-grid-row">
			<div class="adverts-grid-col adverts-col-35">
				<span class="adverts-round-icon light"><i class="uil-location-point"></i></span>
				<span class="adverts-row-title"><strong><?php esc_html_e( 'Location', 'adverts' ); ?></strong></span>
			</div>
			<div class="adverts-grid-col adverts-col-65">
				<?php echo apply_filters( 'adverts_tpl_single_location', esc_html( get_post_meta( $post_id, 'adverts_location', true ) ), $post_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
	<?php endif; ?>

	<?php do_action( 'adverts_tpl_single_details', $post_id ); ?>
</div>

<div class="adverts-content">
	<?php echo wp_kses_post( $post_content ); ?>
</div>

<?php
do_action( 'adverts_tpl_single_bottom', $post_id );

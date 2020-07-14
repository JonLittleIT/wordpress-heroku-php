<?php
/**
 * Related Adverts
 *
 * Displays related adverts under single ad
 * WP Advert plugin must be installed
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php
if ( ! is_singular( 'advert' ) ) {
	return; }
?>

<?php $related_adverts = beehive_get_related_posts(); ?>
<?php if ( isset( $related_adverts ) && $related_adverts->have_posts() ) : ?>
	<div class="related-adverts">
		<div class="block-title">
			<h3><?php esc_html_e( 'Related Ads', 'beehive' ); ?></h3>
		</div>
		<div class="adverts-list adverts-bg-hover">
			<?php while ( $related_adverts->have_posts() ) : ?>
				<?php $related_adverts->the_post(); ?>
				<div class="<?php echo esc_attr( adverts_css_classes( 'advert-item animate-item slideInUp advert-item-col-1', get_the_ID() ) ); ?>">
					<div class="advert-item-inner">
						<div class="advert-overview">
							<a href="<?php the_permalink(); ?>" class="advert-img">
								<?php if ( beehive_is_featured_advert() ) : ?>
									<span class="featured-advert"><?php esc_html_e( 'Featured', 'beehive' ); ?></span>
								<?php endif; ?>
								<?php if ( adverts_get_main_image( get_the_ID() ) ) : ?>
									<img src="<?php echo esc_url( adverts_get_main_image( get_the_ID() ) ); ?>" alt="<?php the_title(); ?>" class="advert-item-grow" />
								<?php else : ?> 
									<div class="placeholder-image"></div>
								<?php endif; ?>
							</a>
							<div class="ad-info">
								<?php if ( ! empty( get_the_terms( get_the_ID(), 'advert_category' ) ) && ! is_wp_error( get_the_terms( get_the_ID(), 'advert_category' ) ) ) : ?>
									<div class="advert-categories">
										<?php foreach ( get_the_terms( get_the_ID(), 'advert_category' ) as $ad_term ) : ?>
											<a href="<?php echo esc_url( get_term_link( $ad_term->slug, 'advert_category' ) ); ?>" class="light"><?php echo esc_html( $ad_term->name ); ?></a>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
								<h4 class="adverts-title">
									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
								</h4>				
								<?php if ( get_the_content() ) : ?>
									<p class="ad-excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?></p>
								<?php endif; ?>
								<?php if ( get_post_meta( get_the_ID(), 'adverts_location', true ) ) : ?>
									<p class="address mute"><i class="uil-location-point"></i><?php echo esc_html( get_post_meta( get_the_ID(), 'adverts_location', true ) ); ?></p>
								<?php endif; ?>
							</div>
						</div>
						<div class="action">
							<?php if ( get_post_meta( get_the_ID(), 'adverts_price', true ) ) : ?>
								<div class="price advert-price color-primary"><?php echo esc_html( adverts_get_the_price( get_the_ID(), get_post_meta( get_the_ID(), 'adverts_price', true ) ) ); ?></div>
							<?php elseif ( adverts_config( 'empty_price' ) ) : ?>
								<div class="price advert-price adverts-price-empty color-primary"><?php echo esc_html( adverts_empty_price( get_the_ID() ) ); ?></div>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>" class="button small"><?php esc_html_e( 'Detail', 'beehive' ); ?></a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>
<?php
wp_reset_postdata();

<?php
/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="<?php echo esc_attr( adverts_css_classes( 'advert-item animate-item slideInUp advert-item-col-' . (int) $columns, get_the_ID() ) ); ?>">
	<div class="advert-item-inner">

		<div class="advert-overview">
			<a href="<?php the_permalink(); ?>" class="advert-img">
				<?php if ( beehive_is_featured_advert() ) : ?>
					<span class="featured-advert"><?php esc_html_e( 'Featured', 'beehive' ); ?></span>
				<?php endif; ?>
				<?php $image = adverts_get_main_image( get_the_ID() ); ?>
				<?php if ( $image ) : ?>
					<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title(); ?>" class="advert-item-grow" />
				<?php else : ?> 
					<div class="placeholder-image"></div>
				<?php endif; ?>
			</a>
			<div class="ad-info">
				<?php $ad_terms = get_the_terms( get_the_ID(), 'advert_category' ); ?>
				<?php if ( ! empty( $ad_terms ) && ! is_wp_error( $ad_terms ) ) : ?>
					<div class="advert-categories">
						<?php foreach ( $ad_terms as $ad_term ) : ?>
							<a href="<?php echo esc_url( get_term_link( $ad_term->slug, 'advert_category' ) ); ?>" class="light"><?php echo esc_html( $ad_term->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<h4 class="adverts-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h4>
				<?php if ( get_the_excerpt() ) : ?>
					<p class="ad-excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php endif; ?>

				<?php if ( get_post_meta( get_the_ID(), 'adverts_location', true ) ) : ?>
					<p class="address mute"><i class="uil-location-point"></i><?php echo esc_html( get_post_meta( get_the_ID(), 'adverts_location', true ) ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="action">
			<?php $price = get_post_meta( get_the_ID(), 'adverts_price', true ); ?>
			<?php if ( $price ) : ?>
				<div class="price advert-price color-primary"><?php echo esc_html( adverts_get_the_price( get_the_ID(), $price ) ); ?></div>
			<?php elseif ( adverts_config( 'empty_price' ) ) : ?>
				<div class="price advert-price adverts-price-empty color-primary"><?php echo esc_html( adverts_empty_price( get_the_ID() ) ); ?></div>
			<?php else : ?>
				<div class="price advert-price adverts-price-empty color-primary"><?php echo esc_html_e( 'N/A', 'beehive' ); ?></div>
			<?php endif; ?>
			<a href="<?php the_permalink(); ?>" class="button small"><?php esc_html_e( 'Detail', 'beehive' ); ?></a>
		</div>

	</div>
</div>

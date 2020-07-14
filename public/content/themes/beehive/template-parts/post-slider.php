<?php
/**
 * Post slider
 *
 * Displays post slider in blog posts
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php if ( $photos ) : ?>
	<div class="post-medias">
		<?php if ( count( $photos ) < 2 ) : ?>
			<div class="item-media">
				<?php if ( is_single() ) : ?>
					<span style="background-image: url(<?php echo esc_url( $photos[0] ); ?>);"></span>
				<?php else : ?>
					<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo esc_url( $photos[0] ); ?>);"></a>
				<?php endif; ?>	
			</div>
		<?php else : ?>
			<div id="beehive-post-slider" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<?php $index = 0; ?>
					<?php foreach ( $photos as $photo ) : ?>
						<?php 0 === $index ? $active = ' active' : $active = ''; ?>
						<div class="carousel-item<?php echo esc_attr( $active ); ?>">
							<div class="item-media">
								<?php if ( is_single() ) : ?>
									<span style="background-image: url(<?php echo esc_url( $photo ); ?>);"></span>
								<?php else : ?>
									<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo esc_url( $photo ); ?>);"></a>
								<?php endif; ?>
							</div>
						</div>
						<?php $index++; ?>
					<?php endforeach; ?>
				</div>
				<a class="carousel-control-prev" href="#beehive-post-slider" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only"><?php esc_html_e( 'Previous', 'beehive' ); ?></span>
				</a>
				<a class="carousel-control-next" href="#beehive-post-slider" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only"><?php esc_html_e( 'Previous', 'beehive' ); ?></span>
				</a>
			</div>
		<?php endif; ?>
	</div>
	<?php
endif;

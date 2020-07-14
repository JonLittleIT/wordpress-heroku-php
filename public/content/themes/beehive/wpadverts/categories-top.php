<?php
/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php if ( ! empty( $terms ) ) : ?>
	<div class="adverts-flexbox adverts-categories-top">
		<?php foreach ( $terms as $term ) : ?>
			<?php $icon = adverts_taxonomy_get( 'advert_category', $term->term_id, 'advert_category_icon', 'folder' ); ?>
			<div class="adverts-flexbox-item animate-item slideInUp <?php echo esc_attr( $columns ); ?> <?php echo esc_attr( 'adverts-category-slug-' . $term->slug ); ?>">
				<a href="<?php echo esc_attr( get_term_link( $term ) ); ?>" class="adverts-flexbox-wrap top">
					<span class="category-icon color-primary adverts-flexbox-icon <?php echo esc_attr( apply_filters( 'adverts_category_font_icon', 'adverts-icon-' . $icon, $term, 'big' ) ); ?>"></span>
					<h5 class="adverts-flexbox-title"><?php echo esc_html( $term->name ); ?></h5>
					<?php if ( $show_count ) : ?>
						<span class="ad-count light"><?php echo esc_html( adverts_category_post_count( $term ) ); ?> <?php esc_html_e( 'ads', 'beehive' ); ?></span>
					<?php endif; ?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	<div class="adverts-grid-row">
		<div class="adverts-col-100">
			<span><?php esc_html_e( 'No categories found.', 'adverts' ); ?></span>
		</div>
	</div>
<?php endif; ?>

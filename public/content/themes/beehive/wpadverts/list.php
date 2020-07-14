<?php
/**
 * Included by adverts/includes/shortcodes.php shortcodes_adverts_list()
 *
 * @var $loop WP_Query
 * @var $query string
 * @var $location string
 * @var $paged int
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php do_action( 'adverts_sh_list_before', $params ); ?>

<?php if ( 'enabled' === $search_bar ) : ?>
	<div class="adverts-options beehive-filters">
		<form action="<?php echo ( isset( $action ) && $action ) ? esc_attr( $action ) : '#'; ?>" class="adverts-search-form" method="get">

			<?php foreach ( $form->get_fields( array( 'type' => array( 'adverts_field_hidden' ) ) ) as $field ) : ?>
				<?php call_user_func( adverts_field_get_renderer( $field ), $field ); ?>
			<?php endforeach; ?>

			<?php if ( ! empty( $fields_visible ) ) : ?>
				<div class="adverts-search">
					<?php foreach ( $fields_visible as $field ) : ?>
						<div class="advert-input <?php echo esc_attr( $field['adverts_list_classes'] ); ?>">
							<?php if ( isset( $field['label'] ) && ! empty( $field['label'] ) ) : ?>
							<span class="adverts-search-input-label screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
							<?php endif; ?>
							<?php call_user_func( adverts_field_get_renderer( $field ), $field ); ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $fields_hidden ) ) : ?>
				<div class="adverts-search adverts-search-hidden">
					<?php foreach ( $fields_hidden as $field ) : ?>
						<div class="advert-input <?php echo esc_attr( $field['adverts_list_classes'] ); ?>">
							<?php if ( isset( $field['label'] ) && ! empty( $field['label'] ) ) : ?>
								<span class="adverts-search-input-label"><?php echo esc_html( $field['label'] ); ?></span>
							<?php endif; ?>
							<?php call_user_func( adverts_field_get_renderer( $field ), $field ); ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( $switch_views || $allow_sorting ) : ?>
				<div class="adverts-options-left adverts-sorting-options adverts-js">
					<div class="option-wrapper">
						<?php if ( $switch_views ) : ?>
							<a href="<?php echo esc_url( add_query_arg( 'display', 'grid' ) ); ?>" class="adverts-button-small adverts-switch-view light" title="<?php esc_attr_e( 'Grid', 'adverts' ); ?>"><i class="uil-grids"></i></a>
							<a href="<?php echo esc_url( add_query_arg( 'display', 'list' ) ); ?>" class="adverts-button-small adverts-switch-view light" title="<?php esc_attr_e( 'List', 'adverts' ); ?>"><i class="uil-list-ul"></i></a>
						<?php endif; ?>
						<?php if ( $allow_sorting ) : ?>
							<div class="adverts-list-sort-wrap">
								<a href="#" class="adverts-button-small adverts-list-sort-button" title="<?php echo esc_attr( $sort_current_title ); ?>">
									<span class="adverts-list-sort-label light"><?php echo esc_html( $sort_current_text ); ?></span> 
									<i class="uil-sort"></i>
								</a>
								<div id="adverts-list-sort-options-wrap" class="adverts-multiselect-holder">
									<div class="adverts-multiselect-options adverts-list-sort-options">
									<?php foreach ( $sort_options as $sort_group ) : ?>
										<span class="adverts-list-sort-option-header">
											<strong><?php echo esc_html( $sort_group['label'] ); ?></strong>
										</span>
										<?php foreach ( $sort_group['items'] as $sort_item_key => $sort_item ) : ?>
											<a href="<?php echo esc_url( add_query_arg( 'adverts_sort', $sort_item_key ) ); ?>" class="adverts-list-sort-option">
												<?php echo esc_html( $sort_item ); ?>
												<?php if ( $adverts_sort == $sort_item_key ) : ?>
													<i class="uil-check"></i>
												<?php endif; ?>
											</a>
										<?php endforeach; ?>
									<?php endforeach; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="adverts-options-right adverts-js">
				<?php if ( ! empty( $fields_hidden ) ) : ?>
					<a href="#" class="adverts-form-filters adverts-button-small input" title="<?php esc_attr_e( 'Advanced Search', 'adverts' ); ?>"><i class="uil-search-plus"></i></a>
				<?php endif; ?>
				<a href="#" class="adverts-form-submit button button-primary"><i class="icon ion-android-search"></i></a>
			</div>

			<div class="adverts-options-fallback adverts-no-js">
				<input type="submit" value="&#xf2f5;" />
			</div>

		</form>
	</div>
<?php endif; ?>

<?php if ( $show_results ) : ?>
	<div class="adverts-list adverts-bg-hover<?php echo ( 1 < $columns ) ? ' grid-list masonry' : ''; ?>">
		<?php if ( $loop->have_posts() ) : ?>
			<?php
			while ( $loop->have_posts() ) :
				$loop->the_post();
				?>
				<?php include apply_filters( 'adverts_template_load', ADVERTS_PATH . 'templates/list-item.php' ); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<div class="adverts-list-empty"><?php esc_html_e( 'There are no ads matching your search criteria.', 'adverts' ); ?></div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>

	<?php if ( $show_pagination ) : ?>
	<div class="beehive-pagination">
			<?php
			echo paginate_links(
				array(
					'base'      => $paginate_base,
					'format'    => $paginate_format,
					'current'   => max( 1, $paged ),
					'total'     => $loop->max_num_pages,
					'prev_text' => '<i class="uil-angle-left"></i>',
					'next_text' => '<i class="uil-angle-right"></i>',
					'type'      => 'list',
				)
			);
			?>
	</div>
	<?php endif; ?>

	<?php
endif;

<?php
/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="adverts-grid manage-adverts">
<?php if ( $loop->have_posts() ) : ?>
	<?php
	while ( $loop->have_posts() ) :
		$loop->the_post();
		?>

		<?php global $post; ?>
		<?php $columns = 1; ?>
		<div class="advert-manage-item animate-item slideInUp <?php echo esc_attr( 'advert-item advert-item-col-' . (int) $columns ); ?>">
			<div class="advert-item-inner">

				<div class="advert-overview">
					<?php $image = adverts_get_main_image( get_the_ID() ); ?>
					<a href="<?php the_permalink(); ?>" class="advert-img">
						<?php if ( $image ) : ?>
							<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title(); ?>" class="advert-item-grow" />
						<?php else : ?>
							<div class="placeholder-image"></div>
						<?php endif; ?>
					</a>
					<div class="ad-info">

						<?php $price = get_post_meta( get_the_ID(), 'adverts_price', true ); ?>
						<?php if ( $price ) : ?>
							<div class="advert-price color-primary"><?php echo esc_html( adverts_get_the_price( get_the_ID(), $price ) ); ?></div>
						<?php elseif ( adverts_config( 'empty_price' ) ) : ?>
							<div class="advert-price adverts-price-empty color-primary"><?php echo esc_html( adverts_empty_price( get_the_ID() ) ); ?></div>
						<?php else : ?>
							<div class="advert-price adverts-price-empty color-primary"><?php echo esc_html_e( 'N/A', 'beehive' ); ?></div>
						<?php endif; ?>

						<h4 class="adverts-title">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
						</h4>
						<?php if ( get_the_excerpt() ) : ?>
							<p class="ad-excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
						<?php endif; ?>

						<?php $expires = get_post_meta( $post->ID, '_expiration_date', true ); ?>
						<?php if ( $expires ) : ?>
							<p class="mute">
								<?php // translators: listing expire date. ?>
								<abbr title="<?php echo esc_html( sprintf( __( 'Expires %s', 'adverts' ), date_i18n( get_option( 'date_format' ), $expires ) ) ); ?>"><?php echo esc_html( apply_filters( 'adverts_sh_manage_date', date_i18n( __( 'Y/m/d', 'adverts' ), $expires ), $post ) ); ?></abbr>
							</p>
						<?php endif; ?>

						<div class="ad-status">
							<?php if ( 'pending' === $post->post_status ) : ?>
								<span class="adverts-inline-icon adverts-inline-icon-warn adverts-icon-lock" title="<?php esc_attr_e( 'Inactive — This Ad is in moderation.', 'adverts' ); ?>"></span>
							<?php endif; ?>
							<?php if ( 'expired' === $post->post_status ) : ?>
								<span class="adverts-inline-icon adverts-inline-icon-warn adverts-icon-eye-off" title="<?php esc_attr_e( 'Inactive — This Ad expired.', 'adverts' ); ?>"></span>
							<?php endif; ?>
							<?php do_action( 'adverts_sh_manage_list_status', $post ); ?>
						</div>
					</div>
				</div>

				<div class="advert-published adverts-manage-actions-wrap action">
					<a href="#" class="button small" id="actions_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php esc_attr_e( 'Manage', 'beehive' ); ?></a>
					<div class="dropdown-menu" aria-labelledby="actions_dropdown">
						<span class="adverts-manage-actions-left">
							<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php esc_attr_e( 'View', 'adverts' ); ?>" class="adverts-manage-action view">
								<i class="uil-eye"></i>
								<?php esc_html_e( 'View', 'adverts' ); ?>
							</a>
							<a href="<?php echo esc_url( $baseurl . str_replace( '%#%', get_the_ID(), $edit_format ) ); ?>" title="<?php esc_attr_e( 'Edit', 'adverts' ); ?>" class="adverts-manage-action edit">
								<i class="uil-pen"></i>
								<?php esc_html_e( 'Edit', 'adverts' ); ?>
							</a>
							<a href="<?php echo esc_url( adverts_ajax_url() ); ?>?action=adverts_delete&id=<?php echo get_the_ID(); ?>&redirect_to=<?php echo esc_attr( rawurlencode( $baseurl ) ); ?>&_ajax_nonce=<?php echo wp_create_nonce( 'adverts-delete' ); ?>" title="<?php esc_attr_e( 'Delete', 'adverts' ); ?>" class="adverts-manage-action adverts-manage-action-delete delete" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce( 'adverts-delete' ); ?>">
								<i class="uil-trash"></i>
								<?php esc_html_e( 'Delete', 'adverts' ); ?>
							</a>
							<div class="adverts-manage-action adverts-manage-delete-confirm">
								<?php esc_html_e( 'Are you sure?', 'adverts' ); ?>
								<span class="animate-spin adverts-icon-spinner adverts-manage-action-spinner"></span>
								<a href="#" class="adverts-manage-action-delete-yes color-primary"><?php esc_html_e( 'Yes', 'adverts' ); ?></a>
								<a href="#" class="adverts-manage-action-delete-no"><?php esc_html_e( 'Cancel', 'adverts' ); ?></a>
							</div>
							<?php do_action( 'adverts_sh_manage_actions_left', $post->ID, $baseurl ); ?>
						</span>
						<span class="adverts-manage-actions-right">
							<?php do_action( 'adverts_sh_manage_actions_right', $post->ID, $baseurl ); ?>
							<a href="#" class="adverts-manage-action adverts-manage-action-more">
								<i class="uil-arrow-circle-right"></i>
								<?php esc_html_e( 'More', 'adverts' ); ?>
							</a>
						</span>
						<div class="adverts-manage-actions-more">
							<?php do_action( 'adverts_sh_manage_actions_more', $post->ID, $baseurl ); ?>
						</div>
					</div>
				</div>
				<?php do_action( 'adverts_sh_manage_actions_after', $post->ID, $baseurl ); ?>
			</div>
		</div>

	<?php endwhile; ?>
<?php else : ?>
	<div class="adverts-list-empty"><em><?php esc_html_e( 'You do not have any Ads posted yet.', 'adverts' ); ?></em></div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div>

<div class="adverts-pagination beehive-pagination">
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

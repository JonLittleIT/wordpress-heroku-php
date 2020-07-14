<?php
/**
 * Single view job meta box.
 *
 * Hooked into single_job_listing_start priority 20
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing-meta.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.14.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

do_action( 'single_job_listing_meta_before' ); ?>

<ul class="job-listing-meta meta">
	<?php do_action( 'single_job_listing_meta_start' ); ?>

	<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
		<?php $types = wpjm_get_the_job_types(); ?>
		<?php if ( ! empty( $types ) ) : ?> 
			<li class="single-job-type">
				<div class="item-name">
					<span class="item-icon"><i class="uil-briefcase-alt"></i></span>
					<span class="item-title">
						<strong><?php esc_html_e( 'Job Type', 'beehive' ); ?></strong>
					</span>
				</div>
				<div class="item-desc">
				<?php foreach ( $types as $type ) : // @codingStandardsIgnoreLine ?>
					<span><?php echo esc_html( $type->name ); ?></span>
				<?php endforeach; ?>
				</div>
			</li>
		<?php endif; ?>
	<?php } ?>

	<li class="location">
		<div class="item-name">
			<span class="item-icon"><i class="uil-location-point"></i></span>
			<span class="item-title">
				<strong><?php esc_html_e( 'Location', 'beehive' ); ?></strong>
			</span>
		</div>
		<div class="item-desc">
			<?php the_job_location(); ?>
		</div>
	</li>

	<?php if ( is_position_filled() ) : ?>
		<li class="position-filled">
			<div class="item-name">
				<span class="item-icon"><i class="uil-check-circle"></i></span>
				<span class="item-title">
					<strong><?php esc_html_e( 'Filled', 'beehive' ); ?></strong>
				</span>
			</div>
			<div class="item-desc">
				<?php esc_html_e( 'This position has been filled', 'wp-job-manager' ); ?>
			</div>
		</li>
	<?php elseif ( ! candidates_can_apply() && 'preview' !== $post->post_status ) : ?>
		<li class="listing-expired">
			<div class="item-name">
				<span class="item-icon"><i class="uil-times-circle"></i></span>
				<span class="item-title">
					<strong><?php esc_html_e( 'Closed', 'beehive' ); ?></strong>
				</span>
			</div>
			<div class="item-desc">
				<?php esc_html_e( 'Applications have closed', 'wp-job-manager' ); ?>
			</div>
		</li>
	<?php endif; ?>

	<?php do_action( 'single_job_listing_meta_end' ); ?>
</ul>

<?php do_action( 'single_job_listing_meta_after' ); ?>

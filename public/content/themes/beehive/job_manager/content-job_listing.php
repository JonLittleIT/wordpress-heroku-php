<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.34.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
?>
<li <?php job_listing_class( 'animate-item slideInUp' ); ?> data-longitude="<?php echo esc_attr( $post->geolocation_long ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_lat ); ?>">
	<div class="job-list-item">
		<div class="logo">
			<figure>
				<?php the_company_logo(); ?>
			</figure>
		</div>
		<div class="job-info">
			<h4 class="job-title">
				<a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a>
			</h4>
			<div class="about-company">
				<span class="address mute ellipsis"><?php the_job_location( false ); ?></span>
				<?php the_company_name( '<p class="company-name color-primary ellipsis">', '</p> ' ); ?>
			</div>
		</div>
		<div class="job-listing-meta">
			<?php do_action( 'job_listing_meta_start' ); ?>
			<?php if ( get_option( 'job_manager_enable_types' ) ) : ?>
				<?php $types = wpjm_get_the_job_types(); ?>
				<?php if ( ! empty( $types ) ) : ?>
					<ul class="job-types-lists ellipsis">
					<?php foreach ( $types as $type ) : // @codingStandardsIgnoreLine ?>
						<li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></li>
					<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			<?php endif; ?>
			<?php do_action( 'job_listing_meta_end' ); ?>
		</div>
	</div>
</li>

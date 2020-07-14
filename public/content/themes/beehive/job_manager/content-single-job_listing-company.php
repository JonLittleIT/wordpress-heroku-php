<?php
/**
 * Single view Company information box
 *
 * Hooked into single_job_listing_start priority 30
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing-company.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.14.0
 * @version     1.31.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! get_the_company_name() ) {
	return;
}
?>
<div class="company job-single-header">
	<div class="logo">
		<?php the_company_logo(); ?>
	</div>
	<div class="info">
		<?php the_title( '<h2 class="job_title">', '</h2>' ); ?>
		<?php the_company_name( '<span class="color-primary">', '</span>' ); ?>
		<?php the_company_tagline( '<p class="tagline">', '</p>' ); ?>
	</div>
	<div class="contacts">
		<?php if ( get_the_company_website() ) : ?>
			<a class="website item" href="<?php echo esc_url( get_the_company_website() ); ?>" target="_blank" rel="nofollow" title="<?php esc_attr_e( 'Website', 'beehive' ); ?>">
				<i class="icon ion-android-globe"></i>
			</a>
		<?php endif; ?>
		<?php if ( get_the_company_twitter() ) : ?>
			<a class="company_twitter item" href="<?php echo esc_url( 'https://twitter.com/' . sanitize_title( get_the_company_twitter() ) ); ?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'beehive' ); ?>">
				<i class="icon ion-social-twitter"></i>
			</a>
		<?php endif; ?>
	</div>
</div>

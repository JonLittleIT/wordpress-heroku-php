<?php
/**
 * Related Jobs
 *
 * Displays related jobs under single job
 * WP Job Manager plugin must be installed
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php
if ( ! is_singular() ) {
	return;
}
?>
<?php $related_jobs = beehive_get_related_posts( get_the_ID(), 5 ); ?>
<?php if ( isset( $related_jobs ) && $related_jobs->have_posts() ) : ?>
	<div class="related-jobs">
		<div class="block-title">
			<h3><?php esc_html_e( 'Related Jobs', 'beehive' ); ?></h3>
		</div>
		<ul class="job_listings">
			<?php while ( $related_jobs->have_posts() ) : ?>
				<?php $related_jobs->the_post(); ?>
				<?php get_job_manager_template( 'content-job_listing.php', array() ); ?>
			<?php endwhile; ?>
		</ul>
	</div>
<?php endif; ?>
<?php
wp_reset_postdata();

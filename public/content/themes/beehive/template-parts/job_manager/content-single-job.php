<?php
/**
 * Template for displaying job contents
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php if ( in_array( beehive()->layout->get(), array( 'full', 'social-12', 'social-collapsed' ), true ) ) : ?>
	<div class="row">
		<div class="col-lg-8 col-main-content">
<?php endif; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content clearfix">
					<?php
						the_content(
							sprintf(
								wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'beehive' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							)
						);
						?>
				</div>
				<?php beehive_page_links(); ?>
			</article><!-- #post-<?php the_ID(); ?> -->
			<?php if ( taxonomy_exists( 'job_listing_category' ) && beehive()->options->get( 'key=related-jobs&default=1' ) ) : ?>
				<?php beehive_related_jobs(); ?>
			<?php endif; ?>
<?php if ( in_array( beehive()->layout->get(), array( 'full', 'social-12', 'social-collapsed' ), true ) ) : ?>
		</div>
		<div class="col-lg-4 col-overview-aside">
			<aside class="post-overview sticky-sidebar">
				<div class="widget job-overview">
					<h5 class="widget-title"><?php esc_html_e( 'Job Overview', 'beehive' ); ?></h5>
					<ul class="job-overview-list">
						<li>
							<div class="item">
								<span class="item-icon light"><i class="uil-clock"></i></span>
								<div class="info">
									<p class="name"><strong><?php esc_html_e( 'Date Posted', 'beehive' ); ?></strong></p>
									<p class="meta-info light"><?php the_job_publish_date(); ?></p>
								</div>
							</div>
						</li>
						<?php if ( get_the_job_location() ) : ?>
						<li>
							<div class="item">
								<span class="item-icon light"><i class="uil-location-point"></i></span>
								<div class="info">
									<p class="name"><strong><?php esc_html_e( 'Location', 'beehive' ); ?></strong></p>
									<p class="meta-info light"><?php the_job_location(); ?></p>
								</div>
							</div>
						</li>
						<?php endif; ?>
						<?php if ( get_option( 'job_manager_enable_types' ) ) : ?>
							<?php if ( ! empty( wpjm_get_the_job_types() ) ) : ?>
								<li>
									<div class="item">
										<span class="item-icon light"><i class="uil-briefcase-alt"></i></span>
										<div class="info">
											<p class="name"><strong><?php esc_html_e( 'Jop Type', 'beehive' ); ?></strong></p>
											<p class="meta-info light">
												<?php foreach ( wpjm_get_the_job_types() as $type ) : // @codingStandardsIgnoreLine ?>
													<span class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></span>
												<?php endforeach; ?>
											</p>
										</div>
									</div>
								</li>
							<?php endif; ?>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, '_job_salary', true ) ) : ?>
							<li>
								<div class="item">
									<span class="item-icon light"><i class="uil-usd-circle"></i></span>
									<div class="info">
										<p class="name"><strong><?php esc_html_e( 'Salary', 'beehive' ); ?></strong></p>
										<p class="meta-info light">$ <?php echo esc_html( get_post_meta( $post->ID, '_job_salary', true ) ); ?></p>
									</div>
								</div>
							</li>
						<?php endif; ?>
						<?php if ( taxonomy_exists( 'job_listing_category' ) ) : ?>
							<li>
								<div class="item">
									<span class="item-icon light"><i class="uil-apps"></i></span>
									<div class="info">
										<p class="name"><strong><?php esc_html_e( 'Category', 'beehive' ); ?></strong></p>
										<?php if ( get_the_term_list( $post->ID, 'job_listing_category', '', ', ' ) ) : ?>
											<p class="meta-info light"><?php echo esc_html( wp_strip_all_tags( get_the_term_list( $post->ID, 'job_listing_category', '', ', ' ) ) ); ?></p>
										<?php else : ?>
											<p class="meta-info light"><?php esc_html_e( 'Uncategorized', 'beehive' ); ?></p>
										<?php endif; ?>
									</div>
								</div>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</aside>
		</div>
	</div>
	<?php
endif;

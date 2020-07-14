<?php
/**
 * Template for displaying adverts
 *
 * Used for single advert posts
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
	return; }
?>

<?php if ( in_array( beehive()->layout->get(), array( 'full', 'social-12', 'social-collapsed' ), true ) ) : ?>
	<div class="row">
		<div class="col-lg-8 col-main-content">
<?php endif; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-header">
					<div class="single-classified-title">
						<?php the_title( '<h2 class="title">', '</h2>' ); ?>
					</div>
				</div>
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
			<?php if ( beehive()->options->get( 'key=related-adverts&default=1' ) ) : ?>
				<?php beehive_related_adverts(); ?>
			<?php endif; ?>
<?php if ( in_array( beehive()->layout->get(), array( 'full', 'social-12', 'social-collapsed' ), true ) ) : ?>
		</div>
		<div class="col-lg-4 col-overview-aside">
			<aside class="post-overview sticky-sidebar">
				<?php if ( beehive()->options->get( 'key=advert-tips' ) ) : ?>
					<div class="widget tips-and-tricks">
						<h5 class="widget-title"><?php esc_html_e( 'Useful Tips', 'beehive' ); ?></h5>
						<ul>
							<?php foreach ( beehive()->options->get( 'key=advert-tips' ) as $tip ) : ?>
								<li><?php echo esc_html( $tip ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php else : ?>
					<div class="widget tips-and-tricks">
						<h5 class="widget-title"><?php esc_html_e( 'Useful Tips', 'beehive' ); ?></h5>
						<ul>
							<li><?php esc_html_e( 'Choose a save place to meet with the seller you are dealing with.', 'beehive' ); ?></li>
							<li><?php esc_html_e( 'Read the ad carefully and beware of unrealistic offers.', 'beehive' ); ?></li>
							<li><?php esc_html_e( 'Use a secure transaction. Try to avoid cash transactions.', 'beehive' ); ?></li>
						</ul>
					</div>
				<?php endif; ?>
			</aside>
		</div>
	</div>
	<?php
endif;

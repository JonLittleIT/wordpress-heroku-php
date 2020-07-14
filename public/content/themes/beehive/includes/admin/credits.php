<?php
/**
 * Admin Page | Credits
 *
 * Displays the credits screen
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="wrap about-wrap beehive-wrap">
	<?php $this->admin_header( 'credits' ); ?>
	<div class="beehive-admin-block support">
		<h3 class="block-title"><?php esc_html_e( 'Credits', 'beehive' ); ?></h3>
		<p class="block-desc"><?php esc_html_e( 'We are very thankfull to the following people/company who provided some cool stuffs that tremendously helped us to create an amazing social network theme. A big thumbs up from Thunder Team.', 'beehive' ); ?></p>
	</div>
	<div class="beehive-credits">
		<div class="beehive-cols col-1"> 
			<div class="col">
				<div class="grid-block scripts">
					<p><strong><?php esc_html_e( 'Plugins and Scripts', 'beehive' ); ?></strong></p>
					<div class="item"><a href="<?php echo esc_url( 'https://buddypress.org/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'The BuddyPress Community', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://rtmedia.io/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'RTCamp', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://buddydev.com/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'BuddyDev', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://woocommerce.com/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'Automattic', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://wpjobmanager.com/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'Job Manager', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://wpadverts.com/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'WP Adverts', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://bbpress.org/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'The bbPress Community', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://reduxframework.com/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'Team Redux', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://github.com/CMB2/CMB2/graphs/contributors' ); ?>" class="url" target="_blank"><?php esc_html_e( 'CMB2 team', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://leafo.net/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'Leafo', 'beehive' ); ?></a></div>
				</div>
			</div>
			<div class="col">
				<div class="grid-block scripts">
					<p><strong><?php esc_html_e( 'Graphics and Media', 'beehive' ); ?></strong></p>
					<div class="item"><a href="<?php echo esc_url( 'https://www.pexels.com/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'Pexels', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://www.freepik.com/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'Freepik', 'beehive' ); ?></a></div>
					<div class="item"><a href="<?php echo esc_url( 'https://www.mockupworld.co/' ); ?>" class="url" target="_blank"><?php esc_html_e( 'Mockup World', 'beehive' ); ?></a></div>
				</div>
			</div>
		</div>
	</div>
</div>

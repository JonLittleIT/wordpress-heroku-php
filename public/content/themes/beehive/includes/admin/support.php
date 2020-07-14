<?php
/**
 * Admin Page | Support
 *
 * Displays the support screen
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="wrap about-wrap beehive-wrap">
	<?php $this->admin_header( 'support' ); ?>
	<div class="beehive-admin-block support">
		<h3 class="block-title"><?php esc_html_e( 'Theme Support', 'beehive' ); ?></h3>
		<p class="block-desc"><?php esc_html_e( 'Like all the themeforest themes, Beehive offers 6 months of free support. If your support has expired, you may want to renew it at our themeforest item page. We will be more than happy to assist you.', 'beehive' ); ?></p>
	</div>
	<div class="beehive-support">
		<div class="beehive-cols col-3">
			<div class="col">
				<div class="grid-block install-plugin">
					<h3></span><?php esc_html_e( 'Docummentation', 'beehive' ); ?></h3>
					<p><?php esc_html_e( 'Having trouble to setup the theme? Check out our docs that describes every aspect of our theme.', 'beehive' ); ?></p>
					<a href="https://themified.com/beehive/documentation/" class="button button-large button-primary" target="_blank"><?php esc_html_e( 'Docummentation', 'beehive' ); ?></a>
				</div>
			</div>
			<div class="col">
				<div class="grid-block import-demo">
					<h3></span><?php esc_html_e( 'Contact Support', 'beehive' ); ?></h3>
					<p><?php esc_html_e( 'No luck? Well, no problem. We are here to help you. Contact us and will get back to you within 24 hours.', 'beehive' ); ?></p>
					<a href="https://themeforest.net/user/thunder-team" class="button button-large button-primary" target="_blank"><?php esc_html_e( 'Contact us', 'beehive' ); ?></a>
				</div>
			</div>
			<div class="col">
				<div class="grid-block update-theme">
					<h3></span><?php esc_html_e( 'Request a Feature', 'beehive' ); ?></h3>
					<p><?php esc_html_e( 'Want new feature? Write us and if we think the suggested feature is great, we will include them in the theme.', 'beehive' ); ?></p>
					<a href="https://themeforest.net/user/thunder-team" class="button button-large button-primary" target="_blank"><?php esc_html_e( 'Request feature', 'beehive' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
/**
 * Admin Page | Welcome
 *
 * Displays the Welcome Screen
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="wrap about-wrap beehive-wrap">
	<?php $this->admin_header(); ?>
	<div class="beehive-admin-block welcome">
		<p class="block-desc"><?php esc_html_e( 'Congratulation!! You have successfully installed and activated the theme. Now it is time to setup the theme just as the demo you saw online. Please go through the following simple steps and deploy your beautiful social network website in minutes. If you encounter any problem, do not hesitate to contact us.', 'beehive' ); ?></p>
	</div>
	<div class="beehive-welcome-steps">
		<div class="beehive-cols col-3">
			<div class="col">
				<div class="grid-block install-plugin">
					<h3><?php esc_html_e( 'Install Plugins', 'beehive' ); ?></h3>
					<p><?php esc_html_e( 'First, install and activate all the plugins including both required and recommended plugins.', 'beehive' ); ?></p>
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="button button-large button-primary"><?php esc_html_e( 'Install Plugins', 'beehive' ); ?></a>
				</div>
			</div>
			<div class="col">
				<div class="grid-block import-demo">
					<h3><?php esc_html_e( 'Import Demo', 'beehive' ); ?></h3>
					<?php if ( class_exists( 'OCDI_Plugin' ) ) : ?>
						<p><?php esc_html_e( 'If you have activated the plugins successfully, you should now import demo contents.', 'beehive' ); ?></p>
						<a href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import' ) ); ?>" class="button button-large button-primary"><?php esc_html_e( 'Import Demo', 'beehive' ); ?></a>
					<?php else : ?>
						<p><?php esc_html_e( 'Please install and activate One Click Demo import plugin to be able to import contents.', 'beehive' ); ?></p>
						<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="button button-large button-primary"><?php esc_html_e( 'Install OCDI', 'beehive' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="col">
				<div class="grid-block update-theme">
					<h3><?php esc_html_e( 'Theme Updates', 'beehive' ); ?></h3>
					<?php if ( class_exists( 'Envato_Market' ) ) : ?>
						<p><?php esc_html_e( 'You can automatically get theme updates. Just click the button and follow the process.', 'beehive' ); ?></p>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=envato-market' ) ); ?>" class="button button-large button-primary"><?php esc_html_e( 'Setup Updates', 'beehive' ); ?></a>
					<?php else : ?>
						<p><?php esc_html_e( 'Theme updates are disabled. Please activate Envato Market plugin to receive updates.', 'beehive' ); ?></p>
						<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="button button-large button-primary"><?php esc_html_e( 'Enable Updates', 'beehive' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

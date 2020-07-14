<?php
/**
 * Admin Page | Server
 *
 * Displays all of the <div id="header"> section
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="wrap about-wrap beehive-wrap">
	<?php $this->admin_header( 'server' ); ?>
	<div class="beehive-admin-block system-status">
		<h3 class="block-title"><?php esc_html_e( 'System Status', 'beehive' ); ?></h3>
		<p class="block-desc"><?php esc_html_e( 'Find you server information here. If you see warnings, we strongly recommend you to fix them before you import the demo contents. In any case if you need help from our end, please do not hesitate to contact us.', 'beehive' ); ?></p>
	</div>
	<?php
		global $wpdb;
		$php_memory = ( ! ini_get( 'memory_limit' ) || -1 === ini_get( 'memory_limit' ) ) ? wp_convert_hr_to_bytes( WP_MEMORY_LIMIT ) : wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) );
		$server     = array(
			'php-version'        => array(
				'name'  => 'PHP Version:',
				'value' => ( null === phpversion() ) ? __( 'Sorry we could not find your PHP version.', 'beehive' ) : phpversion(),
				'icon'  => ( null === phpversion() ) ? 'dashicons-no-alt' : 'dashicons-yes',
				'text'  => ( version_compare( phpversion(), '7.0.0' ) >= 0 ) ? __( 'Met WordPress recommendation.', 'beehive' ) : __( 'WordPress recommends 7.0.0 or above.', 'beehive' ),
			),
			'mysql-version'      => array(
				'name'  => 'mySQL Version:',
				'value' => $wpdb->db_version(),
				'icon'  => 'dashicons-yes',
				'text'  => __( 'mySQL is installed.', 'beehive' ),
			),
			'php-memory-limit'   => array(
				'name'  => 'PHP Memory Limit:',
				'value' => size_format( $php_memory ),
				'icon'  => ( $php_memory < 256000000 ) ? 'dashicons-no-alt' : 'dashicons-yes',
				'text'  => ( $php_memory < 256000000 ) ? __( 'We encourange you to set up PHP memory limit to at least 256MB', 'beehive' ) : __( 'Your memory limit is sufficient.', 'beehive' ),
			),
			'php-time-limit'     => array(
				'name'  => 'PHP Time Limit:',
				'value' => ini_get( 'max_execution_time' ),
				'icon'  => ( 300 > ini_get( 'max_execution_time' ) && 0 != ini_get( 'max_execution_time' ) ) ? 'dashicons-no-alt' : 'dashicons-yes',
				'text'  => ( 300 > ini_get( 'max_execution_time' ) && 0 != ini_get( 'max_execution_time' ) ) ? __( 'We encourange you to set it to at least 300', 'beehive' ) : __( 'Time limit is sufficient', 'beehive' ),
			),
			'php-post-max-size'  => array(
				'name'  => 'PHP Post Max Size:',
				'value' => size_format( wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) ) ),
				'icon'  => 'dashicons-yes',
				'text'  => __( 'The largest file size that can be contained in one post.', 'beehive' ),
			),
			'max-upload-size'    => array(
				'name'  => 'Max Upload Size:',
				'value' => size_format( wp_max_upload_size() ),
				'icon'  => 'dashicons-yes',
				'text'  => __( 'The largest file size that can be uploaded to your WordPress installation.', 'beehive' ),
			),
			'php-max-input-vars' => array(
				'name'  => 'PHP Max Input Vars:',
				'value' => ini_get( 'max_input_vars' ),
				'icon'  => ( 1000 > ini_get( 'max_input_vars' ) ) ? 'dashicons-no-alt' : 'dashicons-yes',
				// translators: click here link.
				'text'  => ( 1000 > ini_get( 'max_input_vars' ) ) ? sprintf( __( 'Recommended value is 1000. Max input vars limitation will truncate POST data such as menus. Learn more <a href="%s">here</a>.', 'beehive' ), 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) : __( 'Value is sufficient.', 'beehive' ),
			),
			'Zip-archive'        => array(
				'name'  => 'ZipArchive:',
				'value' => ( class_exists( 'ZipArchive' ) ) ? __( 'Installed', 'beehive' ) : __( 'Not installed', 'beehive' ),
				'icon'  => ( class_exists( 'ZipArchive' ) ) ? 'dashicons-yes' : 'dashicons-no-alt',
				'text'  => __( 'ZipArchive is required for importing demo contents', 'beehive' ),
			),
			'wp-debug-mode:'     => array(
				'name'  => 'WP Debug Mode:',
				'value' => ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? __( 'DEBUG is ON. If you are running your site live, consider disabling it', 'beehive' ) : __( 'DEBUG is Off', 'beehive' ),
				'icon'  => ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? 'dashicons-no-alt' : 'dashicons-yes',
				'text'  => __( 'WordPress debug mode.', 'beehive' ),
			),
		);
		?>
	<div class="beehive-system-status grid-block">
		<?php foreach ( $server as $value ) : ?>
		<div class="system-status-item">
			<div class="name">
				<strong><?php echo esc_html( $value['name'] ); ?></strong>
			</div>
			<div class="status">
				<div class="tooltip">
					<span class="dashicons <?php echo esc_attr( $value['icon'] ); ?>"></span>
					<span class="tooltiptext"><?php echo esc_html( $value['text'] ); ?></span>
				</div>
				<span><?php echo esc_html( $value['value'] ); ?></span>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>

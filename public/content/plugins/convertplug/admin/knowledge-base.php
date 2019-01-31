<?php
/**
 * Prohibit direct script loading.
 *
 * @package Convert_Plus.
 */

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

?>
<div class="wrap about-wrap about-cp bend">
	<div class="wrap-container">
		<div class="bend-heading-section cp-about-header">
			<h1>
				<?php
				/* translators:%s Plugin name*/
				echo sprintf( __( '%s &mdash; Knowledge Base', 'smile' ), CP_PLUS_NAME );
				?>
			</h1>
			<h3>
				<?php
				/* translators:%s Plugin name*/
				echo sprintf( __( 'We are here to help you solve all your doubts, queries and issues you might face while using %s In case of a problem, you can peep into our knowledge base and find a quick solution for it', 'smile' ), CP_PLUS_NAME );
				?>
			</h3>
			<div class="bend-head-logo">
				<div class="bend-product-ver">
					<?php
					_e( 'Version', 'smile' );
					echo ' ' . CP_VERSION;
					?>
				</div>
			</div>
		</div><!-- bend-heading section -->

		<div class="bend-content-wrap">
			<div class="smile-settings-wrapper">
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab" href="?page=<?php echo CP_PLUS_SLUG; ?>" title="<?php _e( 'About', 'smile' ); ?>"><?php echo __( 'About', 'smile' ); ?></a>				
					<a class="nav-tab" href="?page=<?php echo CP_PLUS_SLUG; ?>&view=modules" title="<?php _e( 'Modules', 'smile' ); ?>"><?php echo __( 'Modules', 'smile' ); ?></a>
					<a class="nav-tab nav-tab-active" href="?page=<?php echo CP_PLUS_SLUG; ?>&view=knowledge_base" title="<?php _e( 'knowledge Base', 'smile' ); ?>"><?php echo __( 'Knowledge Base', 'smile' ); ?></a>
					<?php if ( isset( $_GET['author'] ) ) { ?>
					<a class="nav-tab" href="?page=<?php echo CP_PLUS_SLUG; ?>&view=debug&author=true" title="<?php _e( 'Debug', 'smile' ); ?>"><?php echo __( 'Debug', 'smile' ); ?></a>
					<?php } ?>

				</h2>
			</div><!-- smile-settings-wrapper -->
		</hr>
		<div class="container" style="padding: 50px 0 0 0;">
			<div class="col-md-12 text-center" style="overflow:hidden;">
				<?php
				$knowledge_url = 'https://www.convertplug.com/plus/docs/';
				?>
				<a style="max-width:330px;" class="button-primary cp-started-footer-button" href="<?php echo esc_url( $knowledge_url ); ?>" target="_blank" rel="noopener">Click Here For Knowledge Base</a>
			</div>
		</div><!-- container -->

	</div><!-- bend-content-wrap -->
</div><!-- .wrap-container -->
</div><!-- .bend -->

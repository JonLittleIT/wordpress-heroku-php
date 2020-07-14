<?php
/**
 * Footer section of our theme
 *
 * Displays all of the <div id="footer"> section
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<footer id="footer" class="site-footer default-footer">
	<?php if ( beehive()->options->get( 'key=footer-social-links&default=1' ) && beehive_get_other_networks() ) : ?>
	<div class="find-us-on">
		<div class="container">
			<?php echo beehive_get_other_networks(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
	<?php endif; ?>
	<?php if ( beehive_footer_has_menu() ) : ?>
		<div class="footer-menu-area">
			<div class="container">
				<div class="menu-area">
				<?php if ( has_nav_menu( 'company-menu' ) ) : ?>
						<div class="footer-nav-menu company">
							<h4 class="menu-title"><?php esc_html_e( 'Company', 'beehive' ); ?></h4>
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'company-menu',
										'depth'          => 1,
										'container'      => '',
										'menu_class'     => 'footer-menu-list',
										'fallback_cb'    => 'Beehive_Navwalker::fallback',
									)
								);
							?>
						</div>
					<?php endif; ?>
					<?php if ( has_nav_menu( 'community-menu' ) ) : ?>
						<div class="footer-nav-menu community">
							<h4 class="menu-title"><?php esc_html_e( 'Community', 'beehive' ); ?></h4>
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'community-menu',
										'depth'          => 1,
										'container'      => '',
										'menu_class'     => 'footer-menu-list',
										'fallback_cb'    => 'Beehive_Navwalker::fallback',
									)
								);
							?>
						</div>
					<?php endif; ?>
					<?php if ( has_nav_menu( 'usefull-menu' ) ) : ?>
						<div class="footer-nav-menu useful-links">
							<h4 class="menu-title"><?php esc_html_e( 'Useful links', 'beehive' ); ?></h4>
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'usefull-menu',
										'depth'          => 1,
										'container'      => '',
										'menu_class'     => 'footer-menu-list',
										'fallback_cb'    => 'Beehive_Navwalker::fallback',
									)
								);
							?>
						</div>
					<?php endif; ?>
					<?php if ( has_nav_menu( 'legal-menu' ) ) : ?>
						<div class="footer-nav-menu legal">
							<h4 class="menu-title"><?php esc_html_e( 'Legal', 'beehive' ); ?></h4>
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'legal-menu',
										'depth'          => 1,
										'container'      => '',
										'menu_class'     => 'footer-menu-list',
										'fallback_cb'    => 'Beehive_Navwalker::fallback',
									)
								);
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( beehive()->options->get( 'key=colophon&meta=1&default=1' ) ) : ?>
		<div id="colophon" class="colophon">
			<div class="container">
				<div class="copyright-text">
					<p>
						<?php if ( ! empty( beehive()->options->get( 'key=copyright-text' ) ) ) : ?>
							<?php echo do_shortcode( beehive()->options->get( 'key=copyright-text' ) ); ?>
						<?php else : ?>
							<?php esc_html_e( 'Thunder Team © 2020. All rights reserved', 'beehive' ); ?>
						<?php endif; ?>
					</p>
				</div>
			</div>
		</div>
	<?php endif; ?>
</footer>

<?php
/**
 * Beehive header section
 *
 * Displays all of the <header id="masthead"> section
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<header id="masthead" class="<?php echo esc_attr( join( ' ', beehive_header_classes() ) ); ?>">
	<nav class="navbar beehive-navbar default<?php echo ( beehive()->options->get( 'key=fixed-nav&meta=1&default=1' ) ) ? esc_attr( ' fixed-top' ) : ''; ?>">
		<div class="<?php echo ( beehive()->options->get( 'key=fluid-header&meta=1' ) ) ? 'container-fluid' : 'container'; ?>">
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( beehive_get_logo_url() ); ?>" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="default-logo" />
			</a>
			<button class="beehive-toggler navbar-icon" type="button">
				<span class="icon-bar bar1"></span>
				<span class="icon-bar bar2"></span>
				<span class="icon-bar bar3"></span>
			</button>
			<div class="navbar-main-container">
				<div class="menu-label">
					<span class="h5"><?php esc_html_e( 'Main Menu', 'beehive' ); ?></span>
				</div>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'default-navbar',
						'depth'          => 5,
						'container'      => '',
						'menu_class'     => 'navbar-nav navbar-main',
						'fallback_cb'    => 'Beehive_Navwalker::fallback',
						'walker'         => new Beehive_Navwalker(),
					)
				);
				?>
			</div>
			<?php do_action( 'beehive_after_default_navbar' ); ?>
		</div>
	</nav>
</header><!-- #masthead -->

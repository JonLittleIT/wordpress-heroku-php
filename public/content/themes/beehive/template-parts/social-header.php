<?php
/**
 * Beehive social header
 *
 * Displays all of the <header id="sochead"> section
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<header id="sochead" class="<?php echo esc_attr( join( ' ', beehive_header_classes() ) ); ?>">
	<nav class="navbar beehive-navbar social<?php echo ( beehive()->options->get( 'key=fixed-nav&meta=1&default=1' ) ) ? esc_attr( ' fixed-top' ) : ''; ?>">
		<div class="<?php echo ( beehive()->options->get( 'key=fluid-header&meta=1' ) ) ? 'container-fluid' : 'container'; ?>">
			<div id="beehive-ajax-search" class="beehive-ajax-search">
				<form role="search" method="get" id="ajax-search-form" class="ajax-search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="search-field">
						<i class="icon ion-android-search"></i>
						<input id="ajax-search-textfield" type="text" name="s" placeholder="<?php esc_attr_e( 'Search...', 'beehive' ); ?>" value="" autocomplete="off" required>
						<span class="beehive-loading-ring"></span>
					</div>
					<div class="search-button">
						<button type="submit" class="search-submit"><i class="icon ion-android-search"></i></button>
					</div>
				</form>
				<div id="ajax-search-result"></div>
			</div>
			<?php do_action( 'beehive_after_social_navbar' ); ?>
		</div>
	</nav>
</header><!-- #sochead -->

<?php
/**
 * The search-form template.
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url_raw( home_url( '/' ) ); ?>">
	<div class="search-field">
		<input type="text" name="s" placeholder="<?php esc_attr_e( 'Search...', 'beehive' ); ?>" value="<?php echo get_search_query(); ?>" />
	</div>
	<div class="search-button">
		<button type="submit" class="search-submit"><i class="uil-search-alt"></i></button>
	</div>
</form>


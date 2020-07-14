<?php

/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<form role="search" method="get" id="bbp-search-form" class="filter_form" action="<?php bbp_search_url(); ?>">
	<div>
		<label class="screen-reader-text hidden" for="bbp_search"><?php esc_html_e( 'Search for:', 'bbpress' ); ?></label>
		<input type="hidden" name="action" value="bbp-search-request" />
		<input tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" placeholder="<?php esc_attr_e( 'Search', 'beehive' ); ?>" id="bbp_search" />
		<input tabindex="<?php bbp_tab_index(); ?>" class="button" type="submit" id="bbp_search_submit" value="&#xf2f5;" />
	</div>
</form>

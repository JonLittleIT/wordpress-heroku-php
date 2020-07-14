<?php

/**
 * No Access Feedback Part
 *
 * @package bbPress
 * @subpackage Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div id="forum-private" class="bbp-forum-content">
	<div class="block-title">
		<h3 class="entry-title"><?php esc_html_e( 'Private', 'bbpress' ); ?></h3>
	</div>
	<div class="entry-content">
		<div class="bbp-template-notice info">
			<p><?php esc_html_e( 'You do not have permission to view this forum.', 'bbpress' ); ?></p>
		</div>
	</div>
</div><!-- #forum-private -->

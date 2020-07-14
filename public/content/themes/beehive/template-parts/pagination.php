<?php
/**
 * Pagination
 *
 * @link https://codex.wordpress.org/Next_and_Previous_Links
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="beehive-pagination">
	<?php
	echo paginate_links( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		array(
			'prev_text' => '<i class="icon ion-android-arrow-back"></i>',
			'next_text' => '<i class="icon ion-android-arrow-forward"></i>',
			'type'      => 'list',
		)
	);
	?>
</div>

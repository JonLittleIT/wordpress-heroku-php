<?php
/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php adverts_flash( $adverts_flash ); ?>

<div>
	<?php if ( '1' == $moderate ) : ?>
		<p>
			<?php esc_html_e( 'Your ad has been put into moderation, please wait for admin to approve it.', 'adverts' ); ?>
		</p>
	<?php else : ?>
		<p>
			<?php esc_html_e( 'Your ad has been published.', 'beehive' ); ?>
		</p>
	<?php endif; ?>
</div>

<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

// Post Bottom Ad.
$bdaia_p_bottom_desktop_ad = woohoo_get_option( 'bdaia_p_bottom_ad'      ); ?>

<?php if( $bdaia_p_bottom_desktop_ad ) { ?>
	<div class="bdaia-p-bottom-e3-desktop"><div class="bdaia-e3-container"><?php echo do_shortcode( (stripslashes( $bdaia_p_bottom_desktop_ad ) )); ?></div></div>
<?php } ?>
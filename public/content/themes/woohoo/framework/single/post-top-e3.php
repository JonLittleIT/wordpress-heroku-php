<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

// Post Top Ad.
$bdaia_p_top_desktop_ad = woohoo_get_option( 'bdaia_p_top_ad'      ); ?>

<?php if( $bdaia_p_top_desktop_ad ) { ?>
	<div class="bdaia-p-top-e3-desktop"><div class="bdaia-e3-container"><?php echo do_shortcode( (stripslashes( $bdaia_p_top_desktop_ad ) ) ); ?></div></div>
<?php } ?>
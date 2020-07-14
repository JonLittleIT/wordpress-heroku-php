<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>

<?php
// Header Ad.
$bdaia_header_desktop_ad = woohoo_get_option( 'bdaia_header_ad'      );

if( $bdaia_header_desktop_ad ) { ?>
	<div class="bdaia-header-e3-desktop"><div class="bdaia-e3-container"><?php echo do_shortcode( ( stripslashes( $bdaia_header_desktop_ad ) ) ); ?></div></div>
<?php } ?>
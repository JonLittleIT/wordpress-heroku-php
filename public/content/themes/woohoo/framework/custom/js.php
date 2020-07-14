<?php
/**
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Woohoo News Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>

<?php $custom_js = woohoo_get_option( 'custom_javascript' ); ?>
<script>
    <?php echo stripslashes( $custom_js ); ?>
</script>
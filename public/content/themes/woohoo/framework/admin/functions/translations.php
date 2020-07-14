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

function woohoo_trans( $input, $head = true )
{
	/*
	$bd_option  = unserialize( get_option( 'bdayh_setting' ) );
	global $woohoo_default_texts;

	foreach ( $woohoo_default_texts as $value )
	{
		$value = htmlspecialchars( $value );

		echo '<div class="bd_option_item">';
		echo '<h3>'. $value .'</h3>';
		echo '<input name="'.woohoo_sanitize_title( $value ).'" id="'.woohoo_sanitize_title( $value ).'" type="text" value="'. stripslashes( $bd_option["bd_setting"][$value["id"]] ) .'" />';
		echo '</div>';
	}
	*/
}
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

function woohoo_images($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    $current_value = woohoo_get_option($input['id']);
    echo '<input name="'. $input['id'] .']['. $input['key'] .'" id="'. $input['id'] .'['. $input['key'] .']" type="radio" value="'. $current_value[$input['key']] .'" /> '."\n";
}
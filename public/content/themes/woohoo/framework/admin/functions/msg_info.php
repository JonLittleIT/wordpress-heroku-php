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

function woohoo_msg_info( $input, $head = true )
{
    $bd_option = unserialize( get_option( 'bdayh_setting' ) );

    $class_name = (isset($input['class'])) ? $input['class'] : "";
    if ( !empty( $input['name'] ) && $input['name'] != ' ' ){
        echo '<p class="msg-info '.$class_name.'">'. $input['name'] .'</p>' ."\n";
    }
}

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

function woohoo_subtitleTwo( $input, $head = true )
{
    $bd_option = unserialize(get_option('bdayh_setting'));
	if ( !empty($input['name']) && $input['name'] != ' ' ) {

        $class_name = (isset($input['class'])) ? $input['class'] : "";
        echo '<div class="bd-subtitle-two '.$class_name.'"><span>'. $input['name'] .'</span></div>' ."\n";
    }
}
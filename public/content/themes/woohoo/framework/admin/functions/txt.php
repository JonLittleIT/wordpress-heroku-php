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

function woohoo_txt($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    $currentValue = woohoo_get_option( $input['id'] );

    $class_name = (isset($input['class'])) ? $input['class'] : "";
    echo "\n".'<div class="bd_option_item '.$class_name.'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. htmlspecialchars_decode( $input['name'] ) .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>'."\n";
    }
    echo '<input name="'. $input['id'] .']['. $input['key'] .'" id="'. $input['id'] .'['. $input['key'] .']" type="text" value="'. htmlspecialchars( stripslashes( $currentValue[$input['key']] ) ).'" /> </div>'."\n";
}
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

function woohoo_textarea( $input, $head = true )
{
    $bd_option  = unserialize( get_option( 'bdayh_setting' ) );
    $class_name = ( isset( $input['class'] ) ) ? $input['class'] : "";
	echo '<div id="item-'. $input['id'] .'" class="bd_option_item '. $class_name .'">';

    if ( !empty( $input['tip'] ) && $input['tip'] != ' ' )
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>';

    if ( !empty( $input['name'] ) && $input['name'] != ' ' )
        echo '<h3>'. $input['name'] .'</h3>';

    if ( !empty( $input['exp'] ) && $input['exp'] != ' ' )
        echo '<p class="bd-exp">'. $input['exp'] .'</p>';

	$text_code = "";
    if( $input['id'] != 'advanced_export' ) {
	    if( !empty( $bd_option['bd_setting'][$input['id']] ) ) $text_code = stripslashes( $bd_option['bd_setting'][$input['id']] );
    }
    else {
        $text_code = @base64_encode( get_option( 'bdayh_setting' ) );
    }

    if( $input['id'] == 'advanced_export' ) {
        echo '<div id="div-'.$input['id'].'" class="'.$class_name.'"  style="border-radius: 2px;background: #FFF;border: 1px solid #ebecf2;min-width: 220px;width: 90%;padding: 10px;color: #757575;font-family: tahoma;font-size: 12px;box-shadow: none !important;resize: none;overflow-y: scroll;width: 444px;">'.$text_code.'</div>';
    }
    else {
        echo '<textarea id="textarea-'.$input['id'].'" class="'.$class_name.'" name="'.$input['id'].'" rows="8" style="width:100%">'.$text_code.'</textarea>';
    }

    if( $input['id'] != 'advanced_export' ) {}
    else {
        ?><div class="clear"></div><button type="button" class="go btn" onclick="window.location='admin.php?page=mypanel&do=download';">Download</button><?php
    }

	if( isset( $input['js'] ) ) echo $input['js'];

    echo '</div>';
}
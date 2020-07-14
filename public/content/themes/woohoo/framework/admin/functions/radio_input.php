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

function woohoo_radio_input( $input, $head = true )
{
	$bd_option  = unserialize( get_option( 'bdayh_setting' ) );
	$class_name = ( isset( $input['class'] ) ) ? $input['class'] : "";
	echo '<div id="item-'. $input['id'] .'" class="bd_option_item '. $class_name .'">';

	if ( !empty( $input['tip'] ) && $input['tip'] != ' ' )
		echo '<a class="bd_help" title="'. $input['tip'] .'"></a>';

	if ( !empty( $input['name'] ) && $input['name'] != ' ' )
		echo '<h3 for="' . $input['id'] . '">'. $input['name'] .'</h3>';

	if ( !empty( $input['exp'] ) && $input['exp'] != ' ' )
		echo '<p class="bd-exp">'. $input['exp'] .'</p>';

    echo '<div class="check_radio_content">';

    foreach ( $input['options'] as $key => $option ) {
        ?>
        <div class="clear"></div>
        <div class="check_radio">
            <input class="on-of r_<?php echo $input['id'];?> <?php echo $class_name; ?>" name="<?php echo $input['id']; ?>" id="input-<?php echo $input['id']; ?>" type="radio" value="<?php echo $key ?>" <?php if( !empty( $bd_option['bd_setting'][$input['id']] ) && $bd_option['bd_setting'][$input['id']] == $key ) echo 'checked="checked"'; ?>>
            <div class="lab"><?php echo $option; ?></div>
        </div>
    <?php
    }
	echo '</div>';

	if( isset( $input['js'] ) ) echo $input['js'];

    echo '</div>';
}
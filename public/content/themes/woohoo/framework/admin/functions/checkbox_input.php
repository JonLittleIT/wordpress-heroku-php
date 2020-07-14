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

function woohoo_checkbox_input( $input, $head = true )
{
    $bd_option  = unserialize( get_option( 'bdayh_setting' ) );
    $class_name = ( isset( $input['class'] ) ) ? $input['class'] : "";
    echo '<div id="item-'. $input['id'] .'" class="bd_option_item '. $class_name .'">';

    if ( !empty( $input['tip'] ) && $input['tip'] != ' ' )
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'; ?>

    <table class="bd-on-of">
        <tbody>
        <tr>
            <th style="width: 335px; display: block;">
                <?php
                if ( !empty( $input['name'] ) && $input['name'] != ' ' )
	                echo '<h3 for="' . $input['id'] . '">'. $input['name'] .'</h3>';

                if ( !empty( $input['exp'] ) && $input['exp'] != ' ' )
	                echo '<p class="bd-exp">'. $input['exp'] .'</p>';
                ?>
            </th>
            <td>
                <input class="on-of" type="checkbox" id="input-<?php echo $input['id']; ?>" <?php if( isset( $bd_option['bd_setting'][$input['id']] ) and $bd_option['bd_setting'][$input['id']] == 1 ) echo ' checked="checked"'; ?> class="<?php echo $class_name; ?>" name="<?php echo $input['id']; ?>"  value="1" />
            </td>
        </tr>
        </tbody>
    </table>

    <?php
	if( isset( $input['js'] ) ) echo $input['js'];

    echo '</div>';
}
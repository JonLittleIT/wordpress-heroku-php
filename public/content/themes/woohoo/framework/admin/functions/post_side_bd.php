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

function woohoo_post_side_bd( $input, $head = true )
{
    $bd_option = unserialize( get_option( 'bdayh_setting' ) );

    $class_name = (isset($input['class'])) ? $input['class'] : "";
    echo "\n".'<div class="bd_option_item '.$class_name.'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' ) {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }

    if ( !empty($input['name']) && $input['name'] != ' ' ) {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }

    if ( !empty($input['exp']) && $input['exp'] != ' ' ) {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    } ?>

    <ul class="box_layout_list bd_box_layout layouts-inner">
        <li <?php if( woohoo_get_option( $input['id'] ) == 'default' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img style-default">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'default' ){ echo 'checked="checked"'; } ?> type="radio" value="default" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'sideRight' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img side-right">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'sideRight' ){ echo 'checked="checked"'; } ?> type="radio" value="sideRight" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'sideLeft' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img side-left">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'sideLeft' ){ echo 'checked="checked"'; } ?> type="radio" value="sideLeft" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'sideNo' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img side-no">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'sideNo' ){ echo 'checked="checked"'; } ?> type="radio" value="sideNo" />
        </li>
    </ul> <?php echo '</div>'."\n";
}
?>
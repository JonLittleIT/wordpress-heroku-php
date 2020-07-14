<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) die( 'No direct script access allowed' );

function woohoo_column_bd( $input, $head = true )
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
        <li <?php if( woohoo_get_option( $input['id'] ) == 'col_one' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img col_one">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'col_one' ){ echo 'checked="checked"'; } ?> type="radio" value="col_one" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'col_two' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img col_two">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'col_two' ){ echo 'checked="checked"'; } ?> type="radio" value="col_two" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'col_three' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img col_three">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'col_three' ){ echo 'checked="checked"'; } ?> type="radio" value="col_three" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'col_four' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img col_four">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'col_four' ){ echo 'checked="checked"'; } ?> type="radio" value="col_four" />
        </li>
    </ul> <?php echo '</div>'."\n";
}
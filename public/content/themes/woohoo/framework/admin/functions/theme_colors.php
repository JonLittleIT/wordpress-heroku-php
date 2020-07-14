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

function woohoo_theme_colors($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    $class_name = (isset($input['class'])) ? $input['class'] : "";
    echo "\n".'<div class="bd_option_item '.$class_name.'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>

    <ul class="box_layout_list bd_box_layout">

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color1'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-1 ttip" title="Default"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color1'){ echo 'checked="checked"'; } ?> type="radio" value="none" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color2'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-2"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color2'){ echo 'checked="checked"'; } ?> type="radio" value="color2" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color3'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-3"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color3'){ echo 'checked="checked"'; } ?> type="radio" value="color3" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color4'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-4"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color4'){ echo 'checked="checked"'; } ?> type="radio" value="color4" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color5'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-5"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color5'){ echo 'checked="checked"'; } ?> type="radio" value="color5" />
        </li>

    </ul>
    <?php
    echo '</div>'."\n";
}
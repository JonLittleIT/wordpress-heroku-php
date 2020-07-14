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

function woohoo_pattrens_bg( $input,$head = true )
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    $class_name = (isset($input['class'])) ? $input['class'] : "";
    echo "\n".'<div id="'.$input['id'].'" class="bd_option_item '. $class_name .'">' ."\n";
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

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat'){ echo 'class="selectd"'; } ?>>
            <span title="No Pattren" class="theme_colors_spans pat"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat'){ echo 'checked="checked"'; } ?> type="radio" value="none" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat1'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-1"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat1'){ echo 'checked="checked"'; } ?> type="radio" value="pat1" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat2'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-2"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat2'){ echo 'checked="checked"'; } ?> type="radio" value="pat2" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat3'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-3"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat3'){ echo 'checked="checked"'; } ?> type="radio" value="pat3" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat4'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-4"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat4'){ echo 'checked="checked"'; } ?> type="radio" value="pat4" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat5'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-5"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat5'){ echo 'checked="checked"'; } ?> type="radio" value="pat5" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat6'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-6"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat6'){ echo 'checked="checked"'; } ?> type="radio" value="pat6" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat7'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-7"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat7'){ echo 'checked="checked"'; } ?> type="radio" value="pat7" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat8'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-8"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat8'){ echo 'checked="checked"'; } ?> type="radio" value="pat8" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat9'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-9"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat9'){ echo 'checked="checked"'; } ?> type="radio" value="pat9" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat10'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-10"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat10'){ echo 'checked="checked"'; } ?> type="radio" value="pat10" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat11'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-11"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat11'){ echo 'checked="checked"'; } ?> type="radio" value="pat11" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat12'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-12"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat12'){ echo 'checked="checked"'; } ?> type="radio" value="pat12" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat13'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-13"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat13'){ echo 'checked="checked"'; } ?> type="radio" value="pat13" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat14'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-14"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat14'){ echo 'checked="checked"'; } ?> type="radio" value="pat14" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat15'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-15"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat15'){ echo 'checked="checked"'; } ?> type="radio" value="pat15" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat16'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-16"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat16'){ echo 'checked="checked"'; } ?> type="radio" value="pat16" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat17'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-17"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat17'){ echo 'checked="checked"'; } ?> type="radio" value="pat17" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat18'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-18"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat18'){ echo 'checked="checked"'; } ?> type="radio" value="pat18" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat19'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-19"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat19'){ echo 'checked="checked"'; } ?> type="radio" value="pat19" />
        </li>

        <li <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat20'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-20"></span>
            <input name="pattrens_bg" <?php if( !empty( $bd_option['bd_setting']['pattrens_bg'] ) && $bd_option['bd_setting']['pattrens_bg'] == 'pat20'){ echo 'checked="checked"'; } ?> type="radio" value="pat20" />
        </li>

    </ul>
    <?php
    echo '</div>';
}

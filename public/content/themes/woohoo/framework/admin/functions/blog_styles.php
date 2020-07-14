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

function woohoo_blog_styles_bd($input,$head = true)
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

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle1' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-01">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle1' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle1" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle2' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-02">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle2' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle2" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle3' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-03">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle3' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle3" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle4' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-04">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle4' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle4" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle5' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-05">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle5' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle5" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle6' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-06">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle6' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle6" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle7' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-07">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle7' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle7" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle8' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-08">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle8' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle8" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle9' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-09">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle9' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle9" />
        </li>

        <li <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle10' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img blog-style-10">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blogStyle10' ){ echo 'checked="checked"'; } ?> type="radio" value="blogStyle10" />
        </li>

    </ul> <?php echo '</div>'."\n";
}
?>
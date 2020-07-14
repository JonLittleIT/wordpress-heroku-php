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

function woohoo_post_layouts_bd($input,$head = true)
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

        <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle1' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-01">
                <i></i>
            </span>
            <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle1' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle1" />
        </li>

	    <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle2' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-02">
                <i></i>
            </span>
		    <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle2' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle2" />
	    </li>

	    <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle3' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-03">
                <i></i>
            </span>
		    <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle3' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle3" />
	    </li>

	    <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle4' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-04">
                <i></i>
            </span>
		    <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle4' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle4" />
	    </li>

	    <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle5' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-05">
                <i></i>
            </span>
		    <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle5' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle5" />
	    </li>

	    <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle6' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-06">
                <i></i>
            </span>
		    <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle6' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle6" />
	    </li>

	    <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle7' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-07">
                <i></i>
            </span>
		    <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle7' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle7" />
	    </li>

	    <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle8' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-08">
                <i></i>
            </span>
		    <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle8' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle8" />
	    </li>

	    <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle9' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-09">
                <i></i>
            </span>
		    <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle9' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle9" />
	    </li>

	    <li <?php if( woohoo_get_option( $input['id'] ) == 'postStyle10' ){ echo 'class="selectd"'; } ?>>
            <span class="layout-img post-style-10">
                <i></i>
            </span>
		    <input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'postStyle10' ){ echo 'checked="checked"'; } ?> type="radio" value="postStyle10" />
	    </li>

    </ul> <?php echo '</div>'."\n";
}
?>
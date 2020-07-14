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
?>

<input type="hidden" name="bdaia_hidden_flag" value="true" />
<div class="my_meta_control">

    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th>Hide Page Title</th>
                <td>
					<?php $mb->the_field( 'bdaia_hide_page_title' ); ?>
                    <input class="on-of" type="checkbox" name="<?php $mb->the_name(); ?>" value="bdaia_hide_page_title"<?php $mb->the_checkbox_state( true ); ?>/>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!-- .box_meta_inner -->

    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th>Hide Page Breadcrumb</th>
                <td>
					<?php $mb->the_field( 'bdaia_hide_page_breadcrumb' ); ?>
                    <input class="on-of" type="checkbox" name="<?php $mb->the_name(); ?>" value="bdaia_hide_page_breadcrumb"<?php $mb->the_checkbox_state( true ); ?>/>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!-- .box_meta_inner -->


    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th>Hide Page Comments</th>
                <td>
					<?php $mb->the_field( 'bdaia_hide_page_comments' ); ?>
                    <input class="on-of" type="checkbox" name="<?php $mb->the_name(); ?>" value="bdaia_hide_page_comments"<?php $mb->the_checkbox_state( true ); ?>/>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!-- .box_meta_inner -->

    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th><span class="box_meta_label">Sidebar position :</span></th>
                <td>
                    <?php $mb->the_field( 'sidebar_position_bd' ); ?>
                    <ul id="sidebar_position_bd" class="box_layout_list bd_box_layout layouts-inner">

                        <li <?php if( $mb->is_value( 'default' ) ){ echo 'class="selectd"'; } ?>>
                            <span class="layout-img style-default">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'default' ) ){ echo 'checked="checked"'; } ?> type="radio" value="" />
                        </li>

                        <li <?php if( $mb->is_value( 'sideRight' ) ){ echo 'class="selectd"'; } ?>>
                            <span class="layout-img side-right">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'sideRight' ) ){ echo 'checked="checked"'; } ?> type="radio" value="sideRight" />
                        </li>

                        <li <?php if( $mb->is_value( 'sideLeft' ) ){ echo 'class="selectd"'; } ?>>
                            <span class="layout-img side-left">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'sideLeft' ) ){ echo 'checked="checked"'; } ?> type="radio" value="sideLeft" />
                        </li>

                        <li <?php if( $mb->is_value( 'sideNo' ) ){ echo 'class="selectd"'; } ?>>
                            <span class="layout-img side-no">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'sideNo' ) ){ echo 'checked="checked"'; } ?> type="radio" value="sideNo" />
                        </li>

                    </ul>
                </td>
            </tr>

            </tbody>
        </table>
    </div>

</div>
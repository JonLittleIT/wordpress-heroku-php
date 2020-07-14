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
            <?php $mb->the_field( 'post_color' ); ?>
            <tr>
                <th><span class="box_meta_label">Custom color</span></th>
                <td id="<?php echo $mb->the_id(); ?>">
                    <div class="color-area">
                        <div class="colorSelector">
                            <div class="color-see" style="background-color:<?php $mb->the_value(); ?>;"></div>
                        </div>
                        <input id="<?php echo $mb->the_id(); ?>_input" class="input_numb color_input " type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
                    </div>
                    <script>
                        jQuery(document).ready(function($){
                            jQuery('#<?php echo $mb->the_id(); ?> .color-area').ColorPicker({
                                color: '#FFFFFF', onShow: function (colpkr){ jQuery(colpkr).stop().fadeIn(); return false; }, onHide: function (colpkr){ jQuery(colpkr).hide(); return false; }, onChange: function (hsb, hex, rgb){
                                    jQuery('#<?php echo $mb->the_id(); ?> .color-see').css('backgroundColor', '#' + hex);
                                    jQuery('#<?php echo $mb->the_id(); ?>'+'_input').val('#' + hex);
                                }
                            });
                        });
                    </script>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th><span class="box_meta_label">Background</span></th>
                <td>
                    <?php $mb->the_field( 'img' ); ?>
                    <input id="<?php $mb->the_id(); ?>_img" class="img-path" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
                    <input id="upload_<?php echo $mb->the_id(); ?>_img_button" type="button" class="button" value="Upload" />
                    <div id="<?php echo $mb->the_id(); ?>_img-preview" class="img-preview upload_img" <?php if(!$mb->the_value() ) echo 'style="display:none;"' ?>>
                        <img src="<?php echo $mb->the_value(); ?>" alt="" />
                        <a href="#" class="del-img btn remove_img bd-del">Remove</a>
                    </div>
                    <script type="text/javascript">
                        jQuery('#<?php echo $mb->the_id(); ?>_img').change(function(){
                            jQuery('#<?php echo $mb->the_id(); ?>_img-preview').show();
                            jQuery('#<?php echo $mb->the_id(); ?>_img-preview img').attr("src", jQuery(this).val());
                        });
                        woohoo_set_uploader( '<?php echo $mb->the_id(); ?>_img' );
                    </script>
                    <div class="clear"></div>
                    <?php $mb->the_field( 'color' ); ?>
                    <div id="<?php echo $mb->the_id(); ?>-bg">
                        <div class="color-area">
                            <div class="colorSelector">
                                <div class="color-see" style="background-color:<?php $mb->the_value(); ?>;"></div>
                            </div>
                            <input id="<?php echo $mb->the_id(); ?>-bg_input" class="input_numb color_input " type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
                        </div>
                        <script>
                            jQuery(document).ready(function(){
                                jQuery('#<?php echo $mb->the_id(); ?>-bg .color-area').ColorPicker({
                                    color: '#FFFFFF', onShow: function (colpkr){ jQuery(colpkr).stop().fadeIn(); return false; }, onHide: function (colpkr){ jQuery(colpkr).hide(); return false; }, onChange: function (hsb, hex, rgb){
                                        jQuery('#<?php echo $mb->the_id(); ?>-bg .color-see').css('backgroundColor', '#' + hex);
                                        jQuery('#<?php echo $mb->the_id(); ?>-bg'+'_input').val('#' + hex);
                                    }
                                });
                            });
                        </script>
                    </div>
                    <?php $mb->the_field( 'repeat' ); ?>
                    <select class="tybo-style" name="<?php $mb->the_name(); ?>">
                        <option value=""<?php $mb->the_select_state( '' ); ?>></option>
                        <option value="repeat"<?php $mb->the_select_state( 'repeat' ); ?>>Repeat</option>
                        <option value="no-repeat"<?php $mb->the_select_state( 'no-repeat' ); ?>>No-repeat</option>
                        <option value="repeat-x"<?php $mb->the_select_state( 'repeat-x' ); ?>>Repeat-x</option>
                        <option value="repeat-y"<?php $mb->the_select_state( 'repeat-y' ); ?>>Repeat-y</option>
                    </select>
                    <?php $mb->the_field( 'attachment' ); ?>
                    <select class="tybo-style" name="<?php $mb->the_name(); ?>">
                        <option value=""<?php $mb->the_select_state( '' ); ?>></option>
                        <option value="fixed"<?php $mb->the_select_state( 'fixed' ); ?>>Fixed</option>
                        <option value="scroll"<?php $mb->the_select_state( 'scroll' ); ?>>Scroll</option>
                    </select>
                    <?php $mb->the_field( 'hor' ); ?>
                    <select class="tybo-style" name="<?php $mb->the_name(); ?>">
                        <option value=""<?php $mb->the_select_state( '' ); ?>></option>
                        <option value="left"<?php $mb->the_select_state( 'left' ); ?>>Left</option>
                        <option value="right"<?php $mb->the_select_state( 'right' ); ?>>Right</option>
                        <option value="center"<?php $mb->the_select_state( 'center' ); ?>>Center</option>
                    </select>
                    <?php $mb->the_field( 'ver' ); ?>
                    <select class="tybo-style" name="<?php $mb->the_name(); ?>">
                        <option value=""<?php $mb->the_select_state( '' ); ?>></option>
                        <option value="top"<?php $mb->the_select_state( 'top' ); ?>>Top</option>
                        <option value="center"<?php $mb->the_select_state( 'center' ); ?>>Center</option>
                        <option value="bottom"<?php $mb->the_select_state( 'bottom' ); ?>>Bottom</option>
                    </select>
                    <div class="clear"></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th><span class="box_meta_label">Full Screen Background</span></th>
                <td>
                    <?php $mb->the_field('full_scr'); ?>
                    <input class="on-of" type="checkbox" name="<?php $mb->the_name(); ?>" value="bd_full_scr"<?php $mb->the_checkbox_state( true ); ?>/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
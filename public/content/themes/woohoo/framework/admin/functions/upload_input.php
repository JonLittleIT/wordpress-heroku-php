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

function woohoo_upload_input($input,$head = true)
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
    <input id="<?php echo $input['id']; ?>" class="img-path" size="20" type="text" name="<?php echo $input['id']; ?>" value="<?php if( !empty( $bd_option['bd_setting'][$input['id']] ) ) echo $bd_option['bd_setting'][$input['id']]; ?>" />
    <input id="upload_<?php echo $input['id']; ?>_button" type="button" class="bdaia-btn color2 st_upload_button" value="Upload" />

    <div id="<?php echo $input['id']; ?>-preview" class="img-preview upload_img" <?php if( !empty( $bd_option['bd_setting'][$input['id']] ) == '' ){ ?> style="display:none;"<?php } ?>>
        <img src="<?php if( !empty( $bd_option['bd_setting'][$input['id']] ) ) echo $bd_option['bd_setting'][$input['id']]; ?>" alt="" />
        <a class="del-img btn remove_img bd-del" title="Delete"></a>
    </div>

    <script type='text/javascript'>
        jQuery('#<?php echo $input['id']; ?>').change(function(){
            jQuery('#<?php echo $input['id']; ?>-preview').show();
            jQuery('#<?php echo $input['id']; ?>-preview img').attr("src", jQuery(this).val());
        });
        woohoo_set_uploader( '<?php echo $input['id']; ?>' );
    </script>

    <?php
    echo '</div>'."\n";
}
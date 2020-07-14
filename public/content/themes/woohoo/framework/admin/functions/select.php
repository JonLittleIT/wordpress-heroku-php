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

function woohoo_select( $input, $head = true )
{
	$bd_option  = unserialize( get_option( 'bdayh_setting' ) );
	$class_name = ( isset( $input['class'] ) ) ? $input['class'] : "";
	echo '<div id="item-'. $input['id'] .'" class="bd_option_item '. $class_name .'">';

	if ( !empty( $input['tip'] ) && $input['tip'] != ' ' )
		echo '<a class="bd_help" title="'. $input['tip'] .'"></a>';

	if ( !empty( $input['name'] ) && $input['name'] != ' ' )
		echo '<h3 for="' . $input['id'] . '">'. $input['name'] .'</h3>';

	if ( !empty( $input['exp'] ) && $input['exp'] != ' ' )
		echo '<p class="bd-exp">'. $input['exp'] .'</p>';


    echo '<select  class="'. $class_name .'" name="'. $input['id'] .'" >';

    if( is_array( $input['list'] ) ) {
        foreach( $input['list'] as $r ) {
            ?><option value="<?php echo $r;?>" <?php if( !empty( $bd_option['bd_setting'][$input['id']] ) && $bd_option['bd_setting'][$input['id']] == $r ){ echo 'selected="selected"'; } ?> ><?php echo $r;?></option><?php
        }
    }
    elseif( $input['list'] == 'cats' )
    {
	    $cats = get_categories();
        ?><option value="" selected="selected" >- All categories -</option><?php
        foreach( $cats as $cat ) {
	        ?><option value="<?php echo esc_attr( $cat->slug ); ?>" <?php if ( !empty( $bd_option['bd_setting'][$input['id']] ) && $bd_option['bd_setting'][$input['id']] == $cat->slug ) { echo ' selected="selected"' ; } ?>><?php echo esc_attr( $cat->name ); ?></option><?php
        }
    }
    echo '</select>';

	if( isset( $input['js'] ) ) echo $input['js'];

	echo '</div>';
}
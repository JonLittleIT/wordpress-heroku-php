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

function woohoo_cat_blocks( $input,$head = true )
{
	$bd_option      = unserialize( get_option( 'bdayh_setting' ) );
	$class_name     = ( isset( $input['class'] ) ) ? $input['class'] : "";

	echo "\n".'<div class="bd_option_item '.$class_name.'">' ."\n";
	if ( !empty( $input['tip'] ) && $input['tip'] != ' ' ) echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
	if ( !empty( $input['name'] ) && $input['name'] != ' ' ) echo '<h3>'. $input['name'] .'</h3>'."\n";
	if ( !empty( $input['exp'] ) && $input['exp'] != ' ' ) echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n"; ?>

	<ul class="box_layout_list bd_box_layout layouts-inner">
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle1' ) echo 'class="selectd"'; ?>><span class="layout-img block-1"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle1' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle1" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle2' ) echo 'class="selectd"'; ?>><span class="layout-img block-2"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle2' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle2" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle3' ) echo 'class="selectd"'; ?>><span class="layout-img block-3"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle3' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle3" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle4' ) echo 'class="selectd"'; ?>><span class="layout-img block-4"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle4' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle4" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle5' ) echo 'class="selectd"'; ?>><span class="layout-img block-5"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle5' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle5" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle6' ) echo 'class="selectd"'; ?>><span class="layout-img block-6"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle6' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle6" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle7' ) echo 'class="selectd"'; ?>><span class="layout-img block-7"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle7' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle7" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle9' ) echo 'class="selectd"'; ?>><span class="layout-img block-9"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle9' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle9" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle10' ) echo 'class="selectd"'; ?>><span class="layout-img block-10"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle10' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle10" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle11' ) echo 'class="selectd"'; ?>><span class="layout-img block-11"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle11' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle11" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle12' ) echo 'class="selectd"'; ?>><span class="layout-img block-22"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle12' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle12" />
		</li>
		<li <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle13' ) echo 'class="selectd"'; ?>><span class="layout-img block-12"><i></i></span>
			<input name="<?php echo $input['id']; ?>" <?php if( woohoo_get_option( $input['id'] ) == 'blockStyle13' ){ echo 'checked="checked"'; } ?> type="radio" value="blockStyle13" />
		</li>
	</ul> <?php echo '</div>'."\n";
}
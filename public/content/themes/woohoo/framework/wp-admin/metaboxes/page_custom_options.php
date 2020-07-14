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
<div class="my_meta_control">

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Below Header Box</th>
				<td>
					<?php $mb->the_field( 'bdaia_code_below_header' ); ?>
					<textarea name="<?php $mb->the_name(); ?>" type="textarea" rows="2" style="width: 90%"><?php stripslashes( $mb->the_value() ); ?></textarea>
					<div class="box_meta_info">Supports: Text, HTML and Shortcodes.</div>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Below Header Box/-->

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Top Margin</th>
				<td>
					<?php $mb->the_field( 'bdaia_code_below_header_t' ); ?>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width: 50px" />
					&nbsp;&nbsp;<span class="box_meta_info">Below Header Box Top Margin (pixels)</span>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Below Header Box Top Margin/-->

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Bottom Margin</th>
				<td>
					<?php $mb->the_field( 'bdaia_code_below_header_b' ); ?>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width: 50px" />
					&nbsp;&nbsp;<span class="box_meta_info">Below Header Box Bottom Margin (pixels)</span>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Below Header Box Bottom Margin/-->

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Above Content Box</th>
				<td>
					<?php $mb->the_field( 'bdaia_code_above_content' ); ?>
					<textarea name="<?php $mb->the_name(); ?>" type="textarea" rows="2" style="width: 90%"><?php stripslashes( $mb->the_value() ); ?></textarea>
					<div class="box_meta_info">Supports: Text, HTML and Shortcodes.</div>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Above Content Box/-->

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Top Margin</th>
				<td>
					<?php $mb->the_field( 'bdaia_code_above_content_t' ); ?>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width: 50px" />
					&nbsp;&nbsp;<span class="box_meta_info">Above Content Box Top Margin (pixels)</span>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Above Content Box Top Margin/-->

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Bottom Margin</th>
				<td>
					<?php $mb->the_field( 'bdaia_code_above_content_b' ); ?>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width: 50px" />
					&nbsp;&nbsp;<span class="box_meta_info">Above Content Box Bottom Margin (pixels)</span>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Above Content Box Bottom Margin/-->

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Below Content Box</th>
				<td>
					<?php $mb->the_field( 'bdaia_code_below_content' ); ?>
					<textarea name="<?php $mb->the_name(); ?>" type="textarea" rows="2" style="width: 90%"><?php stripslashes( $mb->the_value() ); ?></textarea>
					<div class="box_meta_info">Supports: Text, HTML and Shortcodes.</div>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Below Content Box/-->

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Top Margin</th>
				<td>
					<?php $mb->the_field( 'bdaia_code_below_content_t' ); ?>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width: 50px" />
					&nbsp;&nbsp;<span class="box_meta_info">Below Content Box Top Margin (pixels)</span>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Below Content Box Top Margin/-->

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Bottom Margin</th>
				<td>
					<?php $mb->the_field( 'bdaia_code_below_content_b' ); ?>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width: 50px" />
					&nbsp;&nbsp;<span class="box_meta_info">Below Content Box Bottom Margin (pixels)</span>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Below Content Box Bottom Margin/-->

	<div class="cf"></div>
</div>
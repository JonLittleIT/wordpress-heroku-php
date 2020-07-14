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

function woohoo_pb_bo( $arr ) {
	?>
	<div class="postbox">
		<h3 >
			<span>Blocks Options</span>
		</h3>

		<div class="inside">
			<div class="my_meta_control">

				<!--START/Categories Meta/-->
				<div class="box_meta_inner">
					<table class="meta_box_table">
						<tbody>
						<tr>
							<th>Disable Categories Meta</th>
							<td>
								<input class="on-of" type="checkbox" name="bdaia_bo[blocks_cats_meta]" id="bdaia_bo-blocks_cats_meta" value="1" <?php if ( isset( $arr['blocks_cats_meta'] ) and $arr['blocks_cats_meta'] == 1 ){ echo ' checked="checked"'; } ?> />
								<div class="box_meta_info"></div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<!--END/Categories Meta/-->

				<!--START/Review Star/-->
				<div class="box_meta_inner">
					<table class="meta_box_table">
						<tbody>
						<tr>
							<th>Disable Review Star</th>
							<td>
								<input class="on-of" type="checkbox" name="bdaia_bo[blocks_review_star]" id="bdaia_bo-blocks_review_star" value="1" <?php if ( isset( $arr['blocks_review_star'] ) and $arr['blocks_review_star'] == 1 ){ echo ' checked="checked"'; } ?> />
								<div class="box_meta_info"></div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<!--END/Review Star/-->

				<!--START/Author Meta/-->
				<div class="box_meta_inner">
					<table class="meta_box_table">
						<tbody>
						<tr>
							<th>Disable Author Meta</th>
							<td>
								<input class="on-of" type="checkbox" name="bdaia_bo[blocks_author_meta]" id="bdaia_bo-blocks_author_meta" value="1" <?php if ( isset( $arr['blocks_author_meta'] ) and $arr['blocks_author_meta'] == 1 ){ echo ' checked="checked"'; } ?> />
								<div class="box_meta_info"></div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<!--END/Author Meta/-->

				<!--START/Date Meta/-->
				<div class="box_meta_inner">
					<table class="meta_box_table">
						<tbody>
						<tr>
							<th>Disable Date Meta</th>
							<td>
								<input class="on-of" type="checkbox" name="bdaia_bo[blocks_date_meta]" id="bdaia_bo-blocks_date_meta" value="1" <?php if ( isset( $arr['blocks_date_meta'] ) and $arr['blocks_date_meta'] == 1 ){ echo ' checked="checked"'; } ?> />
								<div class="box_meta_info"></div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<!--END/Date Meta/-->

				<!--START/Comments Meta/-->
				<div class="box_meta_inner">
					<table class="meta_box_table">
						<tbody>
						<tr>
							<th>Disable Comments Meta</th>
							<td>
								<input class="on-of" type="checkbox" name="bdaia_bo[blocks_comments_count_meta]" id="bdaia_bo-blocks_comments_count_meta" value="1" <?php if ( isset( $arr['blocks_comments_count_meta'] ) and $arr['blocks_comments_count_meta'] == 1 ){ echo ' checked="checked"'; } ?> />
								<div class="box_meta_info"></div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<!--END/Comments Meta/-->

				<!--START/Views Meta/-->
				<div class="box_meta_inner">
					<table class="meta_box_table">
						<tbody>
						<tr>
							<th>Disable Views Meta</th>
							<td>
								<input class="on-of" type="checkbox" name="bdaia_bo[blocks_views_meta]" id="bdaia_bo-blocks_views_meta" value="1" <?php if ( isset( $arr['blocks_views_meta'] ) and $arr['blocks_views_meta'] == 1 ){ echo ' checked="checked"'; } ?> />
								<div class="box_meta_info"></div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<!--END/Views Meta/-->

				<!--START/Read More/-->
				<div class="box_meta_inner">
					<table class="meta_box_table">
						<tbody>
						<tr>
							<th>Disable Read More</th>
							<td>
								<input class="on-of" type="checkbox" name="bdaia_bo[blocks_read_more]" id="bdaia_bo-blocks_read_more" value="1" <?php if ( isset( $arr['blocks_read_more'] ) and $arr['blocks_read_more'] == 1 ){ echo ' checked="checked"'; } ?> />
								<div class="box_meta_info"></div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<!--END/Read More/-->

			</div>
		</div>
	</div>
<?php } ?>



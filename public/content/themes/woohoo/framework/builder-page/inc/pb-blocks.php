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

function woohoo_pb_block( $k, $arr, $block_id ) {
	?>
	<div class="bdaia_box_item bdaia_box_item_<?php echo $block_id;?>" id="home_box_<?php echo $k; ?>">

		<input type="hidden" name="bdaia_home_cats[<?php echo $k; ?>][type]" value="<?php echo $block_id;?>">

		<script>
			jQuery(document).ready(function(){
				jQuery('.bdaia_box_item_<?php echo $block_id;?>').find('.bdaia-input-color').wpColorPicker();
			});
		</script>

		<div class="bdaia_boxes_title">
			<a href="#" class="bdaia_handle"><i class="handle"></i></a>
			<a href="#" class="bdaia_del" id="remove_<?php echo $k; ?>"><i class="del"></i></a>
			<a href="#" class="bdaia_toggle"><i class="toggle"></i></a>
		</div>

		<div class="bdaia_boxes_content">

			<div class="bdaia_boxes_title_cu">
				<?php
				if( isset( $arr['block_title'] ) ) echo $arr['block_title'];
				else echo 'Custom Title';
				?>
			</div>

			<div class="bdaia_boxes_wrapper of">

				<div class="bd_item_content">

					<div class="my_meta_control">

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Custom title:</th>
									<td>
										<input name="bdaia_home_cats[<?php echo $k; ?>][block_title]" type="text" id="bdaia_block<?php echo $k; ?>-block_title" value="<?php echo $arr['block_title']; ?>" />
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Title url:</th>
									<td>
										<input name="bdaia_home_cats[<?php echo $k; ?>][title_url]" type="text" id="bdaia_block<?php echo $k; ?>-title_url" value="<?php echo $arr['title_url']; ?>" />
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Title Text Color:</th>
									<td>
										<input name="bdaia_home_cats[<?php echo $k; ?>][title_text_color]" type="text" id="bdaia_block<?php echo $k; ?>-title_text_color" class="bdaia-input-color" value="<?php echo $arr['title_text_color']; ?>" />
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Dot Background Color:</th>
									<td>
										<input name="bdaia_home_cats[<?php echo $k; ?>][title_bg_color]" type="text" id="bdaia_block<?php echo $k; ?>-title_bg_color" class="bdaia-input-color" value="<?php echo $arr['title_bg_color']; ?>" />
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Margin top:</th>
									<td>
										<input name="bdaia_home_cats[<?php echo $k; ?>][margin_t]" type="text" id="bdaia_block<?php echo $k; ?>-margin_t" value="<?php echo $arr['margin_t']; ?>" />
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Margin Bottom:</th>
									<td>
										<input name="bdaia_home_cats[<?php echo $k; ?>][margin_b]" type="text" id="bdaia_block<?php echo $k; ?>-margin_b" value="<?php echo $arr['margin_b']; ?>" />
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Category Filter:</th>
									<td>
										<?php $cats = get_categories(); ?>
										<select name="bdaia_home_cats[<?php echo $k; ?>][cat]" id="bdaia_block<?php echo $k; ?>-cat">
											<option value="" selected='selected'>- All categories -</option>
											<?php foreach( $cats as $cat ){ ?>
												<option value="<?php echo esc_attr( $cat->slug );?>" <?php if( !empty( $arr['cat'] ) && $arr['cat'] == $cat->slug ){ echo "selected='selected'"; } ?>><?php echo esc_attr( $cat->name ); ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Multiple categories filter:</th>
									<td>
										<input style="width: 100%" name="bdaia_home_cats[<?php echo $k; ?>][cat_uids]" type="text" id="bdaia_block<?php echo $k; ?>-cat_uids" value="<?php echo $arr['cat_uids']; ?>" />
										<div class="list_tags">
											<?php
											$bdaia_block_categories = get_categories();
											foreach ( $bdaia_block_categories as $cat ) {
												?><span onclick="add_cat( 'bdaia_block<?php echo $k; ?>-cat_uids', '<?php echo $cat->slug; ?>' )"><?php echo esc_attr( $cat->name ); ?></span><?php
											}
											?>
										</div>
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Filter by tag slug:</th>
									<td>
										<input name="bdaia_home_cats[<?php echo $k; ?>][tag_slug]" type="text" id="bdaia_block<?php echo $k; ?>-tag_slug" value="<?php echo $arr['tag_slug']; ?>" />
										<div class="list_tags">
											<?php
											$bdaia_block_tags = get_tags('orderby=count&order=desc&number=50');
											foreach ( $bdaia_block_tags as $cat ) {
												?><span onclick="add_cat( 'bdaia_block<?php echo $k; ?>-tag_slug', '<?php echo $cat->slug; ?>' )"><?php echo esc_attr( $cat->name ); ?></span><?php
											}
											?>
										</div>
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Sort order:</th>
									<td>
										<select name="bdaia_home_cats[<?php echo $k; ?>][sort_order]" id="bdaia_block<?php echo $k; ?>-sort_order">
											<option value="" <?php if( $arr['sort_order'] == '' || $arr['sort_order']=='' ) echo 'selected="selected"'; ?>>- Latest -</option>
											<option value="popular" <?php if( $arr['sort_order'] == 'popular' ) echo 'selected="selected"'; ?>>Popular (all time)</option>
											<option value="alphabetical_order" <?php if( $arr['sort_order'] == 'alphabetical_order' ) echo 'selected="selected"'; ?>>Alphabetical A -&gt; Z</option>
											<option value="review_high" <?php if( $arr['sort_order'] == 'review_high' ) echo 'selected="selected"'; ?>>Highest rated (reviews)</option>
											<option value="comment_count" <?php if( $arr['sort_order'] == 'comment_count' ) echo 'selected="selected"'; ?>>Most Commented</option>
											<option value="random_posts" <?php if( $arr['sort_order'] == 'random_posts' ) echo 'selected="selected"'; ?>>Random Posts</option>
											<option value="random_today" <?php if( $arr['sort_order'] == 'random_today' ) echo 'selected="selected"'; ?>>Random posts Today</option>
											<option value="random_7_day" <?php if( $arr['sort_order'] == 'random_7_day' ) echo 'selected="selected"'; ?>>Random posts from last 7 Day</option>
										</select>
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner num_posts">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Limit post number:</th>
									<td>
										<input name="bdaia_home_cats[<?php echo $k; ?>][num_posts]" type="text" id="bdaia_block<?php echo $k; ?>-num_posts" value="<?php echo $arr['num_posts']; ?>" />
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner offset">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Offset posts:</th>
									<td>
										<input name="bdaia_home_cats[<?php echo $k; ?>][offset]" type="text" id="bdaia_block<?php echo $k; ?>-offset" value="<?php echo $arr['offset']; ?>" />
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner ajax_pagination">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Pagination:</th>
									<td>
										<select name="bdaia_home_cats[<?php echo $k; ?>][ajax_pagination]" id="bdaia_block<?php echo $k; ?>-ajax_pagination">
											<option value="" <?php if( $arr['ajax_pagination'] == '' || $arr['ajax_pagination']=='' ) echo 'selected="selected"'; ?>>- No pagination -</option>
											<option value="load_more" <?php if( $arr['ajax_pagination'] == 'load_more' ) echo 'selected="selected"'; ?>>Load More button</option>
											<option class="pbnext_prev" value="next_prev" <?php if( $arr['ajax_pagination'] == 'next_prev' ) echo 'selected="selected"'; ?>>Next/Prev</option>
										</select>
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

						<div class="box_meta_inner">
							<table class="meta_box_table">
								<tbody>
								<tr>
									<th>Box Shortcode</th>
									<td>
										<textarea style="width: 100%">[bdaia_<?php echo $block_id;?><?php if( $arr['block_title'] ) { ?> block_title="<?php echo $arr['block_title']; ?>" <?php } ?><?php if( $arr['title_url'] ) { ?> title_url="<?php echo $arr['title_url']; ?>" <?php } ?><?php if( $arr['title_text_color'] ){ ?> title_text_color="<?php echo $arr['title_text_color']; ?>" <?php } ?><?php if( $arr['title_bg_color'] ){ ?> title_bg_color="<?php echo $arr['title_bg_color']; ?>" <?php } ?><?php if( $arr['margin_t'] ){ ?> margin_t="<?php echo $arr['margin_t']; ?>" <?php } ?><?php if( $arr['margin_b'] ){ ?> margin_b="<?php echo $arr['margin_b']; ?>" <?php } ?><?php if( $arr['cat'] ){ ?> cat="<?php echo $arr['cat']; ?>" <?php } ?><?php if( $arr['cat_uids'] ){ ?> cat_uids="<?php echo $arr['cat_uids']; ?>" <?php } ?><?php if( $arr['tag_slug'] ){ ?>tag_slug="<?php echo $arr['tag_slug']; ?>" <?php } ?><?php if( $arr['num_posts'] ){ ?> num_posts="<?php echo $arr['num_posts']; ?>" <?php } ?><?php if( $arr['offset'] ){ ?> offset="<?php echo $arr['offset']; ?>" <?php } ?><?php if( $arr['sort_order'] ){ ?> sort_order="<?php echo $arr['sort_order']; ?>" <?php } ?><?php if( $arr['ajax_pagination'] ){ ?> ajax_pagination="<?php echo $arr['ajax_pagination']; ?>"<?php } ?>]</textarea>
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- box_meta_inner -->

					</div>

				</div>

			</div><!-- .Wrapper -->
		</div>
	</div>

<?php } ?>



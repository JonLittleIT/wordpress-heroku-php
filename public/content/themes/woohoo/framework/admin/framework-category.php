<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action ( 'edit_category_form_fields', 'woohoo_category_fields_bd');
function woohoo_category_fields_bd( $tag ) {

	wp_enqueue_media();
	$t_id = $tag->term_id;
	$cat_option = get_option( 'bd_cat_'.$t_id ); ?>

	<tr class="form-field fff">
		<td colspan="2">
			<div class="cf"></div>
			<div class="bd-subtitle-two">Feature Posts</div>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Feature Posts
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name"      => "Feature Posts",
					"id"        => "bdaia_fp_onof",
					"cat"       => $t_id ,
					"type"      => "checkbox"
				)
			);
			?>
			<p class="description">Check to enable, uncheck to disable.</p>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Speed
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name"      => "Speed",
					"id"        => "bdaia_fp_speed",
					"cat"       => $t_id ,
					"type"      => "slider",
					"unit"      => "px",
					"max"       => 10000,
					"min"       => 0
				));
			?>
			<p class="description">Select the speed, 1000 = 1 second.</p>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Animation Speed
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name"      => "Animation Speed",
					"id"        => "bdaia_fp_time",
					"cat"       => $t_id ,
					"type"      => "slider",
					"unit"      => "px",
					"max"       => 10000,
					"min"       => 0
				));
			?>
			<p class="description">Select the animation speed, 1000 = 1 second.</p>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Feature Posts Style
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name"      => "Feature Posts Style",
					"id"        => "bdaia_fp_style",
					"cat"       => $t_id ,
					"type"      => "select",
					"options"   => array(
						"default"       => "Flexslider Big",
						"grid1"         => "Grid style1",
						"grid2"         => "Grid style2",
						"grid3"         => "Grid style3",
						"grid4"         => "Grid style4",
						"grid5"         => "Grid style5",
						"grid6"         => "Grid style6",
						"grid7"         => "Grid style7",
						"carousel"      => "Carousel",
						"eislider"      => "Elastic Slider"
					)
				));
			?>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Sort order
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name"      => "Sort order",
					"id"        => "bdaia_fp_sort_order",
					"cat"       => $t_id ,
					"type"      => "select",
					"options"   => array(
						""                  => "- Latest -",
						"popular"           => "Popular (all time)",
						"comment_count"     => "Most Commented",
						"review_high"       => "Highest rated (reviews)",
						"random_posts"      => "Random posts",
						"random_today"      => "Random posts Today",
						"random_7_day"      => "Random posts from last 7 Day"
					)
				));
			?>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Limit post number
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name"      => "Sort order",
					"id"        => "bdaia_fp_num_posts",
					"cat"       => $t_id ,
					"type"      => "slider",
					"unit"      => "px",
					"max"       => 50,
					"min"       => 0
				));
			?>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Offset posts
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name"      => "Offset posts",
					"id"        => "bdaia_fp_offset",
					"cat"       => $t_id ,
					"type"      => "slider",
					"unit"      => "px",
					"max"       => 50,
					"min"       => 0
				));
			?>
		</td>
	</tr>

	<tr class="form-field fff">
		<td colspan="2">
			<div class="cf"></div>
			<div class="bd-subtitle-two">
				Custom Styles
			</div>
		</td>
	</tr>

	<tr class="form-field ffr">
		<th scope="row">
			Custom Color
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "FuCustom Color",
					"id" => "cat_color",
					"cat" => $t_id ,
					"type" => "color"));
			?>
		</td>
	</tr>


	<tr class="form-field ffr">
		<th scope="row">
			Background
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Background",
					"id" => "custom_styles_bd",
					"cat" => $t_id ,
					"type" => "bgop"
				));
			?>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Full Screen Background
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Full Screen Background",
					"id" => "full_scr",
					"cat" => $t_id ,
					"type" => "checkbox"));
			?>
		</td>
	</tr>

	<tr class="form-field fff">
		<td colspan="2">
			<div class="cf"></div>
			<div class="bd-subtitle-two">More options</div>
		</td>
	</tr>

    <tr class="form-field ffr">
        <th scope="row">
            Disable Rss Icon
        </th>
        <td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Disable Rss Icon",
					"id" => "bdaia_cat_rss_icon",
					"cat" => $t_id ,
					"type" => "checkbox"));
			?>
        </td>
    </tr>
	<tr class="form-field ffr">
		<th scope="row">
			Disable Review Score
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Disable Review Score",
					"id" => "bdaia_cat_meta_review_score",
					"cat" => $t_id ,
					"type" => "checkbox"));
			?>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Disable Author Meta
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Disable Author Meta",
					"id" => "bdaia_cat_meta_athor_meta",
					"cat" => $t_id ,
					"type" => "checkbox"));
			?>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Disable Date Meta
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Disable Date Meta",
					"id" => "bdaia_cat_meta_date_meta",
					"cat" => $t_id ,
					"type" => "checkbox"));
			?>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Disable Categories Meta
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Disable Categories Meta",
					"id" => "bdaia_cat_meta_categories_meta",
					"cat" => $t_id ,
					"type" => "checkbox"));
			?>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Disable Comments Meta
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Disable Comments Meta",
					"id" => "bdaia_cat_meta_comments_meta",
					"cat" => $t_id ,
					"type" => "checkbox"));
			?>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">
			Disable Views Meta
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Disable Views Meta",
					"id" => "bdaia_cat_meta_views_meta",
					"cat" => $t_id ,
					"type" => "checkbox"));
			?>
		</td>
	</tr>

	<tr class="form-field fff">
		<td colspan="2">
			<div class="cf"></div>
			<div class="bd-subtitle-two">More options</div>
		</td>
	</tr>

	<tr class="form-field ffr">
		<th scope="row">
			Post Display View
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name"      => "Post Display View:",
					"id"        => "bdaia_cat_post_display",
					"type"      => "post_display",
					"cat"       => $t_id ,
					"options"   => array(
						"blockStyle1"   => "blockStyle1",
						"blockStyle2"   => "blockStyle2",
						"blockStyle3"   => "blockStyle3",
						"blockStyle4"   => "blockStyle4",
						"blockStyle5"   => "blockStyle5",
						"blockStyle6"   => "blockStyle6",
						"blockStyle7"   => "blockStyle7",
						"blockStyle8"   => "blockStyle8",
						"blockStyle9"   => "blockStyle9",
						"blockStyle10"  => "blockStyle10",
						"blockStyle11"  => "blockStyle11",
						"blockStyle12"  => "blockStyle12",
						"blockStyle13"  => "blockStyle13",
					)));
			?>
			<input type="hidden" name="bdaia_cat_post_template_save" value="<?php echo $cat_option['bdaia_cat_post_template'];?>" />
		</td>
	</tr>

	<tr class="form-field ffr">
		<th scope="row">
			Single Post Template
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name"      => "Single Post Template:",
					"id"        => "bdaia_cat_post_template",
					"type"      => "post_template",
					"cat"       => $t_id ,
					"options"   => array(
						""              => "Default",
						"postStyle1"    => "Post Style 1",
						"postStyle2"    => "Post Style 2",
						"postStyle3"    => "Post Style 3",
						"postStyle4"    => "Post Style 4",
						"postStyle5"    => "Post Style 5",
						"postStyle6"    => "Post Style 6",
						"postStyle7"    => "Post Style 7",
						"postStyle8"    => "Post Style 8",
						"postStyle9"    => "Post Style 9",
						"postStyle10"    => "Post Style 10",
					)));
			?>
			<input type="hidden" name="sbdaia_cat_post_template_save" value="<?php echo $cat_option['bdaia_cat_post_template'];?>" />
		</td>
	</tr>

	<tr class="form-field ffr">
		<th scope="row">
			Sidebar position
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Sidebar position :",
					"id" => "sidebar_po",
					"type" => "sideBar",
					"cat" => $t_id ,
					"options" => array(
						""=>"default",
						"sideRight"=>"sideRight",
						"sideLeft"=>"sideLeft",
						"sideNo"=>"sideNo",
					)));
			?>
			<input type="hidden" name="sidebar_po_save" value="<?php echo $cat_option['sidebar_po'];?>" />
		</td>
	</tr>

	<tr class="form-field ffr">
		<th scope="row">
			What kind of logo?
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "What kind of logo?",
					"id" => "logo_displays",
					"cat" => $t_id ,
					"type" => "radio",
					"options" => array(
						""=>"Default" ,
						"logo_image"=>"Custom Image Logo" ,
						"logo_title"=>"Display The Category Title"
					)
				));
			?>
		</td>
	</tr>

	<tr class="form-field ffr">
		<th scope="row">
			Upload Logo
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Upload Logo",
					"id" => "logo_upload",
					"cat" => $t_id ,
					"type" => "upload"
				));
			?>
			<p class="description">Please choose an image file for your logo.</p>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">Logo (Retina Version @2x)
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Upload Logo (Retina Version @2x)",
					"id" => "logo_retina",
					"cat" => $t_id ,
					"type" => "upload"
				));
			?>
			<p class="description">Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.</p>
		</td>
	</tr>
	<tr class="form-field ffr">
		<th scope="row">Standard Logo Width for Retina Logo
		</th>
		<td>
			<?php
			woohoo_cat_options_bd(
				array(
					"name" => "Upload Logo (Retina Version @2x)",
					"id" => "retina_logo_width",
					"cat" => $t_id ,
					"type" => "slider",
					"unit" => "px",
					"max" => 1200,
					"min" => 0
				));
			?>
			<p class="description">If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.</p>
		</td>
	</tr>

	<?php
}

/*  -----------------------------------------------------------------------------
    save extra category extra fields hook
 */
add_action ( 'edited_category', 'woohoo_save_extra_category_fileds_bd');
function woohoo_save_extra_category_fileds_bd( $term_id ) {
	$t_id = $term_id;
	update_option( "bd_cat_$t_id", $_POST["bd_cat"] );
}

/*  -----------------------------------------------------------------------------
    Cate Options
 */
function woohoo_cat_options_bd($value){

	?>
	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<?php /*-----------------------------------------------------------------------------------*/

		$cat_option = get_option('bd_cat_'.$value['cat']);
		switch ( $value['type'] ) {

		case 'checkbox':
			if( isset( $cat_option[$value['id']] ) ){
				$checked = "checked=\"checked\"";
			} else{
				$checked = "";
			}

			?>
		<input class="on-of" type="checkbox" name="bd_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />
		<?php
		break;

		case 'blogStyle':
		?>
			<ul class="box_layout_list bd_box_layout layouts-inner">
				<?php $i_cont = 0; foreach ($value['options'] as $key => $option) { ?>
					<?php
					if ( $i_cont == 0 ) {
						$cont = 'style-default';
					} elseif ( $i_cont == 10 ) {
						$cont = 'blog-style-10';
					} else {
						$cont = 'blog-style-0'.$i_cont;
					}
					?>
					<li <?php if( checked( $cat_option[$value['id']] , $key ) ){ echo 'class="selectd"'; } ?>>
                                <span class="layout-img <?php echo $cont ?>">
                                    <i></i>
                                </span>
						<input <?php checked( $cat_option[$value['id']] , $key ); ?> id="<?php echo $value['id'] ?>" name="bd_cat[<?php echo $value['id']; ?>]" type="radio" value="<?php echo $key ?>">
					</li>
					<?php $i_cont++; } ?>
			</ul> <?php echo '</div>'."\n";
		break;

		case 'sideBar':
		?>
			<ul class="box_layout_list bd_box_layout layouts-inner">
				<?php $i_cont = 1; foreach ($value['options'] as $key => $option) { ?>
					<?php
					$side = "";
					if ( $i_cont == 1 ) $side = 'style-default';
					elseif ( $i_cont == 2 ) $side = 'side-right';
					elseif ( $i_cont == 3 ) $side = 'side-left';
					elseif ( $i_cont == 4 ) $side = 'side-no'; ?>
					<li <?php if( checked( $cat_option[$value['id']] , $key )) { echo 'class="selectd"'; } ?>>
						<span class="layout-img <?php echo $side ?>"><i></i></span>
						<input <?php checked( $cat_option[$value['id']] , $key ); ?> id="<?php echo $value['id'] ?>" name="bd_cat[<?php echo $value['id']; ?>]" type="radio" value="<?php echo $key ?>">
					</li>
					<?php $i_cont++; } ?>
			</ul> <?php echo '</div>'."\n";
		break;

		case 'post_template':
		?>
			<ul class="box_layout_list bd_box_layout layouts-inner">
				<?php $i_cont = 1; foreach ($value['options'] as $key => $option) { ?>
					<?php
					$ps = "";
					if ( $i_cont == 1 ) $ps = 'style-default';
					elseif ( $i_cont == 2 ) $ps = 'post-style-01';
					elseif ( $i_cont == 3 ) $ps = 'post-style-02';
					elseif ( $i_cont == 4 ) $ps = 'post-style-03';
					elseif ( $i_cont == 5 ) $ps = 'post-style-04';
					elseif ( $i_cont == 6 ) $ps = 'post-style-05';
					elseif ( $i_cont == 7 ) $ps = 'post-style-06';
					elseif ( $i_cont == 8 ) $ps = 'post-style-07';
					elseif ( $i_cont == 9 ) $ps = 'post-style-08';
					elseif ( $i_cont == 10 ) $ps = 'post-style-09';
					elseif ( $i_cont == 11 ) $ps = 'post-style-10';
					?>
					<li <?php if( checked( $cat_option[$value['id']] , $key )) { echo 'class="selectd"'; } ?>>
						<span class="layout-img <?php echo $ps ?>"><i></i></span>
						<input <?php checked( $cat_option[$value['id']] , $key ); ?> id="<?php echo $value['id'] ?>" name="bd_cat[<?php echo $value['id']; ?>]" type="radio" value="<?php echo $key ?>">
					</li>
					<?php $i_cont++; } ?>
			</ul> <?php echo '</div>'."\n";
		break;

		case 'post_display':
		?>
			<style type="text/css">#bdaia_cat_post_display-item li.block-8 {display: none !important}</style>
			<ul class="box_layout_list bd_box_layout layouts-inner">
				<?php $i_cont = 1; foreach ($value['options'] as $key => $option) { ?>
					<?php
					$ps = "";
					if ( $i_cont == 1 ) { $ps = ' block-1'; }
					elseif ( $i_cont == 2 ) { $ps = ' block-2'; }
					elseif ( $i_cont == 3 ) { $ps = ' block-3'; }
					elseif ( $i_cont == 4 ) { $ps = ' block-4'; }
					elseif ( $i_cont == 5 ) { $ps = ' block-5'; }
					elseif ( $i_cont == 6 ) { $ps = ' block-6'; }
					elseif ( $i_cont == 7 ) { $ps = ' block-7'; }
					elseif ( $i_cont == 8 ) { $ps = ' block-8'; }
					elseif ( $i_cont == 9 ) { $ps = ' block-9'; }
					elseif ( $i_cont == 10 ) { $ps = ' block-10'; }
					elseif ( $i_cont == 11 ) { $ps = ' block-11'; }
					elseif ( $i_cont == 12 ) { $ps = ' block-22'; }
					elseif ( $i_cont == 13 ) { $ps = ' block-12'; }
					?>
					<li <?php if( checked( $cat_option[$value['id']] , $key )) { echo 'class="selectd '.$ps.'"'; } else { echo 'class="'.$ps.'"'; } ?>>
						<span class="layout-img<?php echo $ps ?>"><i></i></span>
						<input <?php checked( $cat_option[$value['id']] , $key ); ?> id="<?php echo $value['id'] ?>" name="bd_cat[<?php echo $value['id']; ?>]" type="radio" value="<?php echo $key ?>">
					</li>
					<?php $i_cont++; } ?>
			</ul> <?php echo '</div>'."\n";
		break;

		case 'text':
		?>
		<input name="bd_cat[<?php echo $value['id']; ?>]" id="<?php  echo $value['id']; ?>" type="text" value="<?php echo stripslashes( $cat_option[$value['id']] ); ?>" />
		<?php
		break;

		case 'select':
			?>
			<select name="bd_cat[<?php echo $value['id']; ?>]" >
				<?php foreach ( $value['options'] as $key => $option) { ?>
					<option value="<?php echo $key ?>" <?php if( checked( $cat_option[$value['id']] , $key ) ) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			<?php
		break;

		case 'radio':
		?>

		<?php foreach ($value['options'] as $key => $option) {?>
			<div class="check_radio">
				<input <?php checked( $cat_option[$value['id']] , $key ); ?> id="<?php echo $value['id'] ?>" class="on-of" name="bd_cat[<?php echo $value['id']; ?>]" type="radio" value="<?php echo $key ?>">
				<div class="lab"><?php echo $option; ?></div>
			</div>
		<?php } ?>
		<?php
		break;

		case 'upload':
		?>
		<input id="<?php echo $value['id']; ?>" class="img-path" size="20" type="text" name="bd_cat[<?php echo $value['id']; ?>]" value="<?php echo $cat_option[$value['id']]; ?>" />
		<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="btn st_upload_button button button-primary" value="Upload" />

			<div id="<?php echo $value['id']; ?>-preview" class="img-preview upload_img" <?php if(!$cat_option[$value['id']] ) echo 'style="display:none;"' ?>>
				<img src="<?php if( $cat_option[$value['id']] ) echo $cat_option[$value['id']] ; else echo get_template_directory_uri().'/images/spacer.png'; ?>" alt="" />
				<a href="#" class="del-img btn remove_img bd-del">Remove</a>
			</div>
			<script type='text/javascript'>
				jQuery('#<?php echo $value['id']; ?>').change(function(){
					jQuery('#<?php echo $value['id']; ?>-preview').show();
					jQuery('#<?php echo $value['id']; ?>-preview img').attr("src", jQuery(this).val());
				});
				woohoo_set_uploader( '<?php echo $value['id']; ?>' );
			</script>

		<?php
		break;

		case 'color':
		?>
			<div class="clear"></div>
			<div class="color-area">
				<div id="<?php echo $value['id']; ?>colorselect" class="colorSelector">
					<div class="color-see" <?php if( $cat_option[$value['id']] ){ ?> style="background-color:<?php echo $cat_option[$value['id']]; ?>;" <?php } ?>></div>
				</div>
				<input id="<?php echo $value['id']; ?>_color" class="input_numb color_input " type="text" name="bd_cat[<?php echo $value['id']; ?>]" value="<?php echo $cat_option[$value['id']]; ?>" />
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function()
				{
					jQuery('#<?php echo $value['id']; ?>colorselect').ColorPicker
					({
						color: '#FFFFFF',
						onShow: function (colpkr)
						{
							jQuery(colpkr).stop().fadeIn();
							return false;
						},
						onHide: function (colpkr)
						{
							jQuery(colpkr).hide();
							return false;
						},
						onChange: function (hsb, hex, rgb)
						{
							jQuery('#<?php echo $value['id']; ?>colorselect .color-see').css('backgroundColor', '#' + hex);
							jQuery('#<?php echo $value['id']; ?>'+'_color').val('#' + hex);
						}
					});
				});
			</script>
		<?php
		break;

		case 'bgop':
		?>
		<input id="<?php echo $value['id']; ?>_cat_img" class="img-path" size="20" type="text" name="bd_cat[<?php echo $value['id']; ?>][img]" value="<?php echo $cat_option[$value['id']]['img']; ?>" />
		<input id="upload_<?php echo $value['id']; ?>_cat_img_button" type="button" class="btn st_upload_button button button-primary" value="Upload" />

			<div id="<?php echo $value['id']; ?>_cat_img-preview" class="img-preview upload_img" <?php if(!$cat_option[$value['id']]['img'] ) echo 'style="display:none;"' ?>>
				<img src="<?php if( $cat_option[$value['id']]['img'] ) echo $cat_option[$value['id']]['img'] ; else echo get_template_directory_uri().'/images/spacer.png'; ?>" alt="" />
				<a href="#" class="del-img btn remove_img bd-del">Remove</a>
			</div>
			<script type='text/javascript'>
				jQuery('#<?php echo $value['id']; ?>_cat_img').change(function(){
					jQuery('#<?php echo $value['id']; ?>_cat_img-preview').show();
					jQuery('#<?php echo $value['id']; ?>_cat_img-preview img').attr("src", jQuery(this).val());
				});
				woohoo_set_uploader( '<?php echo $value['id']; ?>_cat_img' );
			</script>

			<div class="clear"></div>
			<div class="color-area">
				<div id="<?php echo $value['id']; ?>colorselect" class="colorSelector">
					<div class="color-see" <?php if( $cat_option[$value['id']]['color'] ){ ?> style="background-color:<?php echo $cat_option[$value['id']]['color']; ?>;" <?php } ?>></div>
				</div>
				<input id="<?php echo $value['id']; ?>_color" class="input_numb color_input " type="text" name="bd_cat[<?php echo $value['id']; ?>][color]" value="<?php echo $cat_option[$value['id']]['color']; ?>" />
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function()
				{
					jQuery('#<?php echo $value['id']; ?>colorselect').ColorPicker
					({
						color: '#FFFFFF',
						onShow: function (colpkr)
						{
							jQuery(colpkr).stop().fadeIn();
							return false;
						},
						onHide: function (colpkr)
						{
							jQuery(colpkr).hide();
							return false;
						},
						onChange: function (hsb, hex, rgb)
						{
							jQuery('#<?php echo $value['id']; ?>colorselect .color-see').css('backgroundColor', '#' + hex);
							jQuery('#<?php echo $value['id']; ?>'+'_color').val('#' + hex);
						}
					});
				});
			</script>

			<select class="tybo-style" name="bd_cat[<?php echo $value['id']; ?>][repeat]">
				<option value="" <?php if ( ! $cat_option[$value['id']][''] ) { echo ' selected="selected"' ; } ?>></option>
				<option value="repeat" <?php if ( $cat_option[$value['id']]['repeat']  == 'repeat' ) { echo ' selected="selected"' ; } ?>>repeat</option>
				<option value="no-repeat" <?php if ( $cat_option[$value['id']]['repeat']  == 'no-repeat') { echo ' selected="selected"' ; } ?>>no-repeat</option>
				<option value="repeat-x" <?php if ( $cat_option[$value['id']]['repeat'] == 'repeat-x') { echo ' selected="selected"' ; } ?>>repeat-x</option>
				<option value="repeat-y" <?php if ( $cat_option[$value['id']]['repeat'] == 'repeat-y') { echo ' selected="selected"' ; } ?>>repeat-y</option>
			</select>

			<select class="tybo-style" name="bd_cat[<?php echo $value['id']; ?>][attachment]">
				<option value="" <?php if ( !$cat_option[$value['id']]['attachment'] ) { echo ' selected="selected"' ; } ?>></option>
				<option value="fixed" <?php if ( $cat_option[$value['id']]['attachment']  == 'fixed' ) { echo ' selected="selected"' ; } ?>>Fixed</option>
				<option value="scroll" <?php if ( $cat_option[$value['id']]['attachment']  == 'scroll') { echo ' selected="selected"' ; } ?>>scroll</option>
			</select>
			<select class="tybo-style" name="bd_cat[<?php echo $value['id']; ?>][hor]">
				<option value="" <?php if ( !$cat_option[$value['id']]['hor'] ) { echo ' selected="selected"' ; } ?>></option>
				<option value="left" <?php if ( $cat_option[$value['id']]['hor']  == 'left' ) { echo ' selected="selected"' ; } ?>>Left</option>
				<option value="right" <?php if ( $cat_option[$value['id']]['hor']  == 'right') { echo ' selected="selected"' ; } ?>>Right</option>
				<option value="center" <?php if ( $cat_option[$value['id']]['hor'] == 'center') { echo ' selected="selected"' ; } ?>>Center</option>
			</select>
			<select class="tybo-style" name="bd_cat[<?php echo $value['id']; ?>][ver]">
				<option value="" <?php if ( !$cat_option[$value['id']]['ver'] ) { echo ' selected="selected"' ; } ?>></option>
				<option value="top" <?php if ( $cat_option[$value['id']]['ver']  == 'top' ) { echo ' selected="selected"' ; } ?>>Top</option>
				<option value="center" <?php if ( $cat_option[$value['id']]['ver'] == 'center') { echo ' selected="selected"' ; } ?>>Center</option>
				<option value="bottom" <?php if ( $cat_option[$value['id']]['ver']  == 'bottom') { echo ' selected="selected"' ; } ?>>Bottom</option>
			</select>
			<div class="clear"></div>

		<?php
		break;

		case 'slider':
		echo '<div class="bd-uislider"><div class="slider_num slide_num_f" id="'. $value['id'] .'" ></div>' ."\n";
		echo '<input id="'. $value['id'].'_input" class="input_num_f" type="text" name="bd_cat['.$value['id'].']" value="'. $cat_option[$value['id']] .'">' ."\n";
		echo '<span class="unitf">'. $value['unit'].'<span> </div>'."\n";
		echo '</div>'."\n";
		?>
			<script>
				jQuery(document).ready(function() {
					jQuery("#<?php echo $value['id']; ?>").slider({
						range: "min",
						min: <?php echo $value['min']; ?>,
						max: <?php echo $value['max']; ?>,
						value: <?php if( $cat_option[$value['id']] ) echo $cat_option[$value['id']]; else echo 0; ?>,
						slide: function(event, ui) {
							jQuery('#'+jQuery(this).attr('id')+'_input').val(ui.value);

						}
					});
				});
			</script>
			<?php
			break;
		}

		if( isset( $value['extra_text'] ) ) : ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php endif;
		?>
	</div>

	<?php
}
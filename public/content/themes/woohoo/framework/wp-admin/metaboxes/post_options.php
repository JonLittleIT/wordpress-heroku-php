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
                <th>Hide Featured Image</th>
                <td>
                    <?php $mb->the_field( 'show_post_feature_img_bd' ); ?>
                    <input class="on-of" type="checkbox" name="<?php $mb->the_name(); ?>" value="show_post_feature_img_bd"<?php $mb->the_checkbox_state( true ); ?>/>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!-- .box_meta_inner -->

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Post Format Gallery Style</th>
				<td>
					<?php $mb->the_field( 'bdaia_format_gallery_style' ); ?>
					<select name="<?php $mb->the_name(); ?>">
						<option value=""<?php $mb->the_select_state( 'default' ); ?>>default</option>
						<option value="slideshow"<?php $mb->the_select_state( 'slideshow' ); ?>>Slideshow</option>
						<option value="grid"<?php $mb->the_select_state( 'grid' ); ?>>Grid</option>
					</select>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!-- .box_meta_inner -->

    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th><span class="box_meta_label">Post template :</span></th>

                <td>
                    <?php $mb->the_field( 'post_template_bd' ); ?>
                    <ul id="post_template_bd" class="box_layout_list bd_box_layout layouts-inner">
                        <li <?php if( $mb->is_value( 'default' ) ){ echo 'class="selectd"'; } ?>>
                            <span class="layout-img style-default">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'default' ) ) { echo 'checked="checked"'; } ?> type="radio" value="" />
                        </li>

                        <li <?php if( $mb->is_value( 'postStyle1' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-01">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle1' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle1" />
                        </li>

                        <li <?php if( $mb->is_value( 'postStyle2' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-02">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle2' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle2" />
                        </li>

                        <li <?php if( $mb->is_value( 'postStyle3' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-03">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle3' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle3" />
                        </li>

                        <li <?php if( $mb->is_value( 'postStyle4' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-04">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle4' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle4" />
                        </li>

                        <li <?php if( $mb->is_value( 'postStyle5' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-05">
                                <i></i>
                            </span>
                            <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle5' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle5" />
                        </li>

	                    <li <?php if( $mb->is_value( 'postStyle6' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-06">
                                <i></i>
                            </span>
		                    <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle6' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle6" />
	                    </li>

	                    <li <?php if( $mb->is_value( 'postStyle7' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-07">
                                <i></i>
                            </span>
		                    <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle7' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle7" />
	                    </li>

	                    <li <?php if( $mb->is_value( 'postStyle8' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-08">
                                <i></i>
                            </span>
		                    <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle8' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle8" />
	                    </li>

	                    <li <?php if( $mb->is_value( 'postStyle9' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-09">
                                <i></i>
                            </span>
		                    <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle9' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle9" />
	                    </li>

	                    <li <?php if( $mb->is_value( 'postStyle10' ) ) { echo 'class="selectd"'; } ?>>
                            <span class="layout-img post-style-10">
                                <i></i>
                            </span>
		                    <input name="<?php $mb->the_name(); ?>" <?php if( $mb->the_radio_state( 'postStyle10' ) ) { echo 'checked="checked"'; } ?> type="radio" value="postStyle10" />
	                    </li>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

	<div class="cf"></div>

	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>Primary category</th>
				<td>
					<?php $mb->the_field( 'woohoo_primary_cat' ); ?>
					<select name="<?php $mb->the_name(); ?>">
						<option value="">Auto select a category</option>
						<?php
						$cats = get_categories();
						foreach ( $cats as $cat ) {
							?>
							<option value="<?php echo esc_attr( $cat->slug );?>"<?php $mb->the_select_state( esc_attr( $cat->slug ) ); ?>><?php echo esc_attr( $cat->name ); ?></option>
							<?php
						}
						?>
					</select>
					<div class="box_meta_info">If the posts has multiple categories, the one selected here will be used for settings and it appears in the category labels.</div>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!-- .box_meta_inner -->

	<div class="cf"></div>

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
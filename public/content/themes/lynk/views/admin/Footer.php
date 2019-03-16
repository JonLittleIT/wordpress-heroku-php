<div class="jvbpd_ts_tab javo-opts-group-tab hidden" tar="footer">
	<h2> <?php esc_html_e("Footer Settings", 'jvbpd' ); ?> </h2>
	<table class="form-table">
	<tr><th>
		<?php esc_html_e( "Select a Footer", 'jvbpd' );?>
		<span class="description"></span>
	</th><td>

		<?php
		if( function_exists( 'jvbpdCore' ) ) :
			foreach( Array(
				'elementor_footer' => Array(
					'label' => esc_html__( "Default(Global) Footer", 'jvbpd' ),
					'description' => sprintf( __(
						'To create more footers, Core >> page builder ( <a href="%1$s" target="_blank">Go page builder</a> )<br>
						 If you do not select, the recent footer ( you created ) will be displayed.', 'jvbpd' ),
						esc_url( add_query_arg( Array( 'post_type' => 'jvbpd-listing-elmt', ), admin_url( 'edit.php' ) ) )
					),
				),
				'elementor_footer_post' => Array(
					'label' => esc_html__( "Single post detail pages", 'jvbpd' ),
					'description' => esc_html__( 'If you do not select "Footer", "Default(Global) Footer" will be displayed.', 'jvbpd' ),
				),
				'elementor_footer_lv_listing' => Array(
					'label' => esc_html__( "Single listing detail pages", 'jvbpd' ),
					'description' => esc_html__( 'If you do not select "Footer", "Default(Global) Footer" will be displayed.', 'jvbpd' ),
				),

			) as $elementor_header_key => $elementor_header_meta ) {
				?>
				<h4><?php echo esc_html( $elementor_header_meta[ 'label' ] ); ?></h4>
				<fieldset class="inner">
					<select name="jvbpd_ts[<?php echo esc_attr($elementor_header_key); ?>]">
						<option value=''><?php esc_html_e( "Select a footer", 'jvbpd' ); ?></option>
						<?php
						foreach( jvbpdCore()->admin->getElementorFooterID() as $template_id  ) {
							if( false === get_post_status( $template_id ) ) {
								continue;
							}
							printf(
								'<option value="%1$s"%3$s>%2$s</option>', $template_id, get_the_title( $template_id ),
								selected( $template_id == jvbpd_tso()->get( $elementor_header_key, '' ), true, false )
							);
						} ?>
					</select>
					<?php
					if( isset( $elementor_header_meta[ 'description' ] ) ) { ?>
						<div>
							<span class="description"><?php echo esc_html($elementor_header_meta[ 'description' ]); ?></span>
						</div>
						<?php
					} ?>
				</fieldset>
				<?php
			}
		endif; ?>
	</td></tr><!-- <tr><th>
		<?php esc_html_e('Color Settings', 'jvbpd' );?>
		<span class="description">
			<?php esc_html_e('You can change colors on footer area.', 'jvbpd' );?>
		</span>
	</th><td>

		<h4><?php esc_html_e('Footer Background Color','jvbpd' );?></h4>
		<fieldset class="inner" id="jv-theme-settings-footer-middle-bg-color">
			<input name="jvbpd_ts[footer_middle_background_color]" type="text" value="<?php echo esc_attr( jvbpd_tso()->get('footer_middle_background_color','#323131'));?>" class="wp_color_picker" data-default-color="#333333">
		</fieldset>

		<h4><?php esc_html_e('Footer Title Color','jvbpd' );?></h4>
		<fieldset class="inner">
			<input name="jvbpd_ts[footer_title_color]" type="text" value="<?php echo esc_attr( jvbpd_tso()->get('footer_title_color','#ffffff'));?>" class="wp_color_picker" data-default-color="#ffffff">
		</fieldset>

		<h4><?php esc_html_e('Footer Title Underline Color','jvbpd' );?></h4>
		<fieldset class="inner">
			<input name="jvbpd_ts[footer_title_underline_color]" type="text" value="<?php echo esc_attr( jvbpd_tso()->get('footer_title_underline_color','#ffffff'));?>" class="wp_color_picker" data-default-color="footer_title_underline_color">
			<input type="checkbox" name="jvbpd_ts[show_footer_title_underline]" value="disabled" <?php checked(jvbpd_tso()->get('show_footer_title_underline') == 'disabled' );?>>
			<?php esc_html_e( "Disabled", 'jvbpd' );?>
		</fieldset>

		<h4><?php esc_html_e('Footer Content Color','jvbpd' );?></h4>
		<fieldset class="inner">
			<input name="jvbpd_ts[footer_content_color]" type="text" value="<?php echo esc_attr( jvbpd_tso()->get('footer_content_color','#999999'));?>" class="wp_color_picker" data-default-color="#999999">
		</fieldset>

	<h4><?php esc_html_e('Footer Content Link Hover Color','jvbpd' );?></h4>
		<fieldset class="inner">
			<input name="jvbpd_ts[footer_content_link_hover_color]" type="text" value="<?php echo esc_attr( jvbpd_tso()->get('footer_content_link_hover_color','#ffffff'));?>" class="wp_color_picker" data-default-color="ffffff">
	</fieldset>

	</td></tr>

	<tr><th>
		<?php esc_html_e( 'Footer Layout Option', 'jvbpd' );?>
		<span class="description"></span>
	</th><td>

		<h4><?php esc_html_e( 'Footer Type','jvbpd' );?></h4>
		<fieldset class="inner">
			<label>
				<input type="radio" name="jvbpd_ts[footer_container_type]" value="" <?php checked(jvbpd_tso()->get('footer_container_type') == '' );?>>
				<?php esc_html_e( "Wide", 'jvbpd' );?>
			</label>
			<label>
				<input type="radio" name="jvbpd_ts[footer_container_type]" value="active" <?php checked(jvbpd_tso()->get('footer_container_type')== "active");?>>
				<?php esc_html_e( "Boxed", 'jvbpd' );?>
			</label>
			<label>
				<input type="radio" name="jvbpd_ts[footer_container_type]" value="disable-footer" <?php checked(jvbpd_tso()->get('footer_container_type')== "disable-footer");?>>
				<?php esc_html_e( "Disabled", 'jvbpd' );?>
			</label>
		</fieldset>

		<h4><?php esc_html_e( 'Footer Sticky','jvbpd' );?></h4>
		<fieldset class="inner">
			<label>
				<input type="radio" name="jvbpd_ts[footer_sticky]" value="enable" <?php checked(jvbpd_tso()->get('footer_sticky') == 'enable' );?>>
				<?php esc_html_e( "Enabled", 'jvbpd' );?>
			</label>
			<label>
				<input type="radio" name="jvbpd_ts[footer_sticky]" value="" <?php checked(jvbpd_tso()->get('footer_sticky')== "");?>>
				<?php esc_html_e( "Disabled", 'jvbpd' );?>
			</label>
		</fieldset>

		<h4><?php esc_html_e( 'Footer Sidebar Columns','jvbpd' );?></h4>
		<fieldset class="inner">
			<?php
			foreach(
				Array(
					'' => esc_html__( "3 Columns (default)", 'jvbpd' ),
					'column4' => esc_html__( "4 Columns", 'jvbpd' ),
				) as $strColumns => $strLabel
			) printf(
				'<label><input type="radio" name="jvbpd_ts[footer_sidebar_columns]" value="%1$s"%2$s>%3$s</label>' . ' ',
				$strColumns,
				checked( $strColumns == jvbpd_tso()->get('footer_sidebar_columns'), true, false ),
				$strLabel
			); ?>
		</fieldset>

	</td></tr>

	<tr><th>
		<?php esc_html_e( 'Footer Infomation', 'jvbpd' );?>
	</th><td>

		<h4><?php esc_html_e( 'Show Footer Information','jvbpd' );?></h4>
		<fieldset class="inner">
			<label>
				<input type="radio" name="jvbpd_ts[footer_info_use]" value="active" <?php checked(jvbpd_tso()->get('footer_info_use') == 'active' );?>>
				<?php esc_html_e( "Enabled", 'jvbpd' );?>
			</label>
			<label>
				<input type="radio" name="jvbpd_ts[footer_info_use]" value="" <?php checked(jvbpd_tso()->get('footer_info_use')== "");?>>
				<?php esc_html_e( "Disabled", 'jvbpd' );?>
			</label>
		</fieldset>

		<h4><?php esc_html_e( 'Social Icons','jvbpd' );?></h4>
		<fieldset class="inner">
			<label>
				<input type="radio" name="jvbpd_ts[footer_social_use]" value="active" <?php checked(jvbpd_tso()->get('footer_social_use') == 'active' );?>>
				<?php esc_html_e( "Enabled", 'jvbpd' );?>
			</label>
			<label>
				<input type="radio" name="jvbpd_ts[footer_social_use]" value="" <?php checked(jvbpd_tso()->get('footer_social_use')== "");?>>
				<?php esc_html_e( "Disabled", 'jvbpd' );?>
			</label>
		</fieldset>

		<h4><?php esc_html_e( 'Footer bottom - Middle Area Title','jvbpd' );?></h4>
		<fieldset class="inner">
			<input name="jvbpd_ts[footer_info_text_title]" value="<?php echo esc_attr( jvbpd_tso()->get('footer_info_text_title'));?>">
		</fieldset>

		<h4><?php esc_html_e( 'Footer bottom - Middle Text','jvbpd' );?></h4>
		<fieldset class="inner">
			<textarea name="jvbpd_ts[footer_text]" class="large-text code" rows="10"><?php echo stripslashes(jvbpd_tso()->get('footer_text', ''));?></textarea>
		</fieldset>



		<h4><?php esc_html_e( 'Footer Bottom - Right Title','jvbpd' );?></h4>
		<fieldset class="inner">
			<input name="jvbpd_ts[footer_info_image_title]" value="<?php echo esc_attr( jvbpd_tso()->get('footer_info_image_title'));?>">
		</fieldset>

		<h4><?php esc_html_e( 'Footer Bottom - Right','jvbpd' );?></h4>
		<fieldset class="inner">
			<input type="text" name="jvbpd_ts[footer_info_image_url]" value="<?php echo esc_attr( jvbpd_tso()->get('footer_info_image_url'));?>" tar="footer_info_image">
			<input type="button" class="button button-primary fileupload" value="<?php esc_attr_e('Select Image', 'jvbpd' );?>" tar="footer_info_image">
			<input class="fileuploadcancel button" tar="footer_image" value="<?php esc_attr_e('Delete', 'jvbpd' );?>" type="button">
			<p>
				<?php esc_html_e("Preview",'jvbpd' ); ?><br>
				<img src="<?php echo esc_attr( jvbpd_tso()->get('footer_info_image_url'));?>" tar="footer_info_image" style="max-width:60%;">
			</p>
		</fieldset>

	</td></tr>

	<tr><th>
		<?php esc_html_e('Footer Background Option', 'jvbpd' );?>
		<span class="description">
			<?php esc_html_e('You can add a background image on footer area.', 'jvbpd' );?>
		</span>
	</th><td>
		<h4><?php esc_html_e('Background status','jvbpd' );?></h4>
		<fieldset class="inner">
			<label>
				<input type="radio" name="jvbpd_ts[footer_background_image_use]" value="use" <?php checked(jvbpd_tso()->get('footer_background_image_use') == "use");?>><?php esc_html_e('Enable', 'jvbpd' );?>
			</label>
			<label>
				<input type="radio" name="jvbpd_ts[footer_background_image_use]" value="" <?php checked(jvbpd_tso()->get('footer_background_image_use')== "");?>><?php esc_html_e('Disable', 'jvbpd' );?>
			</label>
		</fieldset>
		<h4><?php esc_html_e('Image Upload','jvbpd' );?></h4>
		<fieldset class="inner">
			<input type="text" name="jvbpd_ts[footer_background_image_url]" value="<?php echo esc_attr( jvbpd_tso()->get('footer_background_image_url'));?>" tar="footer_image">
			<input type="button" class="button button-primary fileupload" value="<?php esc_attr_e('Select Image', 'jvbpd' );?>" tar="footer_image">
			<input class="fileuploadcancel button" tar="footer_image" value="<?php esc_attr_e('Delete', 'jvbpd' );?>" type="button">
			<p>
				<?php esc_html_e("Preview",'jvbpd' ); ?><br>
				<img src="<?php echo esc_attr( jvbpd_tso()->get('footer_background_image_url'));?>" tar="footer_image" style="max-width:60%;">
			</p>
		</fieldset>
		<h4><?php esc_html_e('Background Size','jvbpd' ); ?></h4>
		<fieldset class="inner">
			<?php
			$footer_background_size = Array(
				'contain'			=> esc_html__('Contain', 'jvbpd' )
				, 'cover'		=> esc_html__('Cover', 'jvbpd' )
			);
			?>
			<select name="jvbpd_ts[footer_background_size]">
				<option value=""><?php esc_html_e('Select', 'jvbpd' );?></option>
				<?php
				foreach($footer_background_size as $size=> $text){
					printf('<option value="%s" %s>%s</option>', $size
						,( jvbpd_tso()->get('footer_background_size')!='' && jvbpd_tso()->get('footer_background_size') == $size? " selected": "")
						, $text);
				} ?>
			</select>
		</fieldset>
		<h4><?php esc_html_e('Background Repeat','jvbpd' ); ?></h4>
		<fieldset class="inner">
			<?php
			$footer_background_repeat = Array(
				'repeat'			=> esc_html__('Repeat X, Y', 'jvbpd' )
				, 'repeat-x'		=> esc_html__('Repeat-X', 'jvbpd' )
				, 'repeat-y'		=> esc_html__('Repeat-Y', 'jvbpd' )
				, 'no-repeat'		=> esc_html__('No-Repeat', 'jvbpd' )
			);
			?>
			<select name="jvbpd_ts[footer_background_repeat]">
				<option value=""><?php esc_html_e('Select', 'jvbpd' );?></option>
				<?php
				foreach($footer_background_repeat as $repeat=> $text){
					printf('<option value="%s" %s>%s</option>', $repeat
						,( jvbpd_tso()->get('footer_background_repeat')!='' && jvbpd_tso()->get('footer_background_repeat') == $repeat? " selected": "")
						, $text);
				} ?>
			</select>
		</fieldset>
		<h4><?php esc_html_e('Opacity (0.1 ~ 1)','jvbpd' ); ?></h4>
		<fieldset class="inner">
			<input name="jvbpd_ts[footer_background_opacity]" value="<?php echo esc_attr( jvbpd_tso()->get('footer_background_opacity'));?>">
		</fieldset>
	</td></tr><tr><th>
		<?php esc_html_e('Copyright Information', 'jvbpd' );?>
		<span class="description">
			<?php esc_html_e('Type your copyright information. It will be displayed on footer.', 'jvbpd' );?>
		</span>
	</th><td>
		<h4><?php esc_html_e('Copyright Color','jvbpd' );?></h4>
		<fieldset class="inner">
			<input name="jvbpd_ts[copyright_color]" type="text" value="<?php echo esc_attr( jvbpd_tso()->get('copyright_color','#ffffff'));?>" class="wp_color_picker" data-default-color="ffffff">
		</fieldset>

		<h4><?php esc_html_e('Display Text or HTML', 'jvbpd' );?></h4>
		<fieldset>
			<textarea name="jvbpd_ts[copyright]" class="large-text code" rows="15"><?php echo stripslashes(jvbpd_tso()->get('copyright', ''));?></textarea>
		</fieldset>
	</td></tr><tr><th>
		<?php esc_html_e("Footer Logo Settings",'jvbpd' ); ?>
		<span class='description'>
			<?php esc_html_e("Uploaded logos will be displayed on the footer in their appropriate locations.", 'jvbpd' );?>
		</span>
	</th><td>
		<h4><?php esc_html_e("Logo",'jvbpd' ); ?></h4>
		<fieldset class="inner">
			<p>
				<input type="text" name="jvbpd_ts[bottom_logo_url]" value="<?php echo esc_attr( jvbpd_tso()->get( 'bottom_logo_url' ) );?>" tar="g03">
				<input type="button" class="button button-primary fileupload" value="<?php esc_attr_e('Select Image', 'jvbpd' );?>" tar="g03">
				<input class="fileuploadcancel button" tar="g03" value="<?php esc_attr_e('Delete', 'jvbpd' );?>" type="button">
			</p>
			<p>
				<?php esc_html_e("Preview",'jvbpd' ); ?><br>
				<img src="<?php echo esc_attr( jvbpd_tso()->get( 'bottom_logo_url' ) );?>" tar="g03">
			</p>
		</fieldset>

		<h4><?php esc_html_e("Retina Logo",'jvbpd' ); ?></h4>
		<fieldset class="inner">
			<p>
				<input type="text" name="jvbpd_ts[bottom_retina_logo_url]" value="<?php echo esc_attr( jvbpd_tso()->get( 'bottom_logo_url' ) );?>" tar="g04">
				<input type="button" class="button button-primary fileupload" value="<?php esc_attr_e('Select Image', 'jvbpd' );?>" tar="g04">
				<input class="fileuploadcancel button" tar="g04" value="<?php esc_attr_e('Delete', 'jvbpd' );?>" type="button">
			</p>
			<p>
				<?php esc_html_e("Preview",'jvbpd' ); ?><br>
				<img src="<?php echo esc_attr( jvbpd_tso()->get( 'bottom_retina_logo_url' ) );?>" tar="g04">
			</p>
		</fieldset>
	</td></tr> -->
	</table>
</div>
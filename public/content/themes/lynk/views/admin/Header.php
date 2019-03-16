<?php
$jvbpd_options = Array(
	'header_type' => apply_filters( 'jvbpd_options_header_types', Array() ),
	'header_skin' => Array(
		esc_html__("Light", 'jvbpd' ) => "",
		esc_html__("Dark", 'jvbpd' ) => "dark"
	),
	'able_disable' => Array(
		esc_html__("Disable", 'jvbpd' ) => "disabled",
		esc_html__("Able", 'jvbpd' ) => "enable"
	),
	'sticky_able_disable' => Array(
		esc_html__("Able", 'jvbpd' ) => "enable",
		esc_html__("Disable", 'jvbpd' ) => "disabled"
	),
	'header_fullwidth' => Array(
		esc_html__("Center Left", 'jvbpd' ) => "fixed",
		esc_html__("Center Right", 'jvbpd' ) => "fixed-right",
		esc_html__("Wide", 'jvbpd' ) => "full"
	),
	'header_relation' => Array(
		esc_html__("Transparency menu", 'jvbpd' )	=> "absolute",
		esc_html__("Default menu", 'jvbpd' ) => "relative"
	),
	'default_header_relation' => Array(
		esc_html__("Default menu", 'jvbpd' )	=> "relative",
		esc_html__("Transparency menu", 'jvbpd' )	=> "absolute"
	),
); ?>

<div class="jvbpd_ts_tab javo-opts-group-tab hidden" tar="header">
	<h2><?php esc_html_e("Heading Settings", 'jvbpd' ); ?> </h2>
	<table class="form-table">

	<tr><th>
		<?php esc_html_e( "Select a header", 'jvbpd' );?>
		<span class="description"></span>
	</th><td>

	<?php
	if( function_exists( 'jvbpdCore' ) ) :
		foreach( Array(
			'elementor_header' => Array(
				'label' => esc_html__( "Default(Global) Header", 'jvbpd' ),
				'description' => sprintf(
					__(
					'To create more headers, Core >> page builder ( <a href="%1$s" target="_blank">Go page builder</a> )<br>
					 If you do not select, the recent header ( you created ) will be displayed.', 'jvbpd' ),
					esc_url( add_query_arg( Array( 'post_type' => 'jvbpd-listing-elmt', ), admin_url( 'edit.php' ) ) )
				),
			),
			'elementor_header_post' => Array(
				'label' => esc_html__( "Single post detail pages", 'jvbpd' ),
				'description' => esc_html__( 'If you do not select "Header", "Default(Global) Header" will be displayed.', 'jvbpd' ),
			),
             'elementor_header_post_archive' => Array(
                 'label' => esc_html__("Post archive pages", 'jvbpd'),
                 'description' => esc_html__('If you do not select "Header", "Default(Global) Header" will be displayed.','jvbpd'),
             ),
			'elementor_header_lv_listing' => Array(
                'label' => esc_html__( "Single listing detail pages", 'jvbpd' ),
                'description' => esc_html__( 'If you do not select "Header", "Default(Global) Header" will be displayed.', 'jvbpd' ),
            ),
            'elementor_header_lv_listing_archive' => Array(
                'label' => esc_html__( "Listing archive pages", 'jvbpd' ),
                'description' => esc_html__( 'If you do not select "Header", "Default(Global) Header" will be displayed.', 'jvbpd' ),
            ),
            'elementor_header_profile' => Array(
                'label' => esc_html__( "My Dashboard Page", 'jvbpd' ),
				'description' => esc_html__( 'If you do not select "Header", "Default(Global) Header" will be displayed.', 'jvbpd' ),
				'condition' => function_exists( 'bp_is_active' ),
			),
			'elementor_header_member' => Array(
                'label' => esc_html__( "Member Page", 'jvbpd' ),
				'description' => esc_html__( 'If you do not select "Header", "Default(Global) Header" will be displayed.', 'jvbpd' ),
				'condition' => function_exists( 'bp_is_active' ),
            ),
			'elementor_header_group' => Array(
                'label' => esc_html__( "Group Page", 'jvbpd' ),
				'description' => esc_html__( 'If you do not select "Header", "Default(Global) Header" will be displayed.', 'jvbpd' ),
				'condition' => function_exists( 'bp_is_active' ) && bp_is_active( 'groups'),
            ),


		) as $elementor_header_key => $elementor_header_meta ) {
			if( isset( $elementor_header_meta['condition'] ) ){
				if( false === $elementor_header_meta['condition'] ) {
					continue;
				}
			} ?>
			<h4><?php echo esc_html( $elementor_header_meta[ 'label' ] ); ?></h4>
			<fieldset class="inner">
				<select name="jvbpd_ts[<?php echo esc_attr($elementor_header_key); ?>]">
					<option value=''><?php esc_html_e( "Select a header", 'jvbpd' ); ?></option>
					<?php
					foreach( jvbpdCore()->admin->getElementorHeaderID() as $template_id  ) {
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

	</td></tr><tr><th>
		<?php esc_html_e( "Select a sidebars", 'jvbpd' );?>
		<span class="description"></span>
	</th><td>
	<?php
	foreach(
		Array(
			'sidebar_left' => Array(
				'label' => esc_html__( "Left Sidebar", 'jvfrmtd' ),
				'note' => esc_html__( "It shows when there is at least one menu. otherwise, it doesn't show.", 'jvfrmtd' ),
			),
		) as $strOptionName => $strOptionMeta
	) {
		?>
		<h4 class="pull-left"><?php echo esc_html( $strOptionMeta[ 'label' ] ); ?></h4>
		<fieldset class="inner margin-20-0 <?php if($strOptionMeta[ 'label' ]=='Member Sidebar') echo 'margin-custom-28-0'; ?>">
			<select name="jvbpd_ts[<?php echo esc_attr( $strOptionName ); ?>]">
				<?php
				foreach(
					Array(
						'disabled' => esc_html__( "Disable (Default)", 'jvfrmtd' ),
						'enabled' => esc_html__( "Enable", 'jvfrmtd' ),
					) as $strOption => $strOptionLabel
				) {
					printf(
						'<option value="%1$s"%3$s>%2$s</option>',
						$strOption, $strOptionLabel,
						selected( $strOption == jvbpd_tso()->get( $strOptionName, apply_filters( 'jvbpd_theme_option_' . $strOption . '_default', 'disabled' ) ), true, false )
					);
				} ?>
			</select>
			<?php printf( '<div class="description">%1$s : %2$s</div>', esc_html__( "Note", 'jvfrmtd' ), $strOptionMeta[ 'note' ] ); ?>
		</fieldset>
		<?php
	} ?>



		<?PHP /*

		<?php if( jvbpd_layout()->getThemeType() == 'jvd-lk' ) : ?>

			<h4 class="pull-left"><?php esc_html_e( "Topbar", 'jvbpd' );?></h4>
			<fieldset class="inner margin-10-0">

				<select name="jvbpd_ts[topbar_use]" data-show-field='<?php echo json_encode( Array( 'enable' => Array( '#topbar_height_field', '#topbar_color_field', '#topbar_text_color_field', '#topbar_logo_field' ) ) ); ?>'>
					<?php
					foreach(
						Array(
							'enable' => esc_html__( "Enable", 'jvbpd' ),
							'disable' => esc_html__( "Disable", 'jvbpd' ),
						) as $strValue => $strLabel
					) printf(
						'<option value="%1$s"%3$s>%2$s</option>',
						$strValue, $strLabel,
						selected( $strValue == jvbpd_tso()->get( 'topbar_use', 'disable' ), true, false )
					); ?>
				</select>

			</fieldset>

			<dl id="topbar_height_field" class="hidden">
				<dt><?php esc_html_e( "Topbar Height", 'jvbpd' );?></dt>
				<dd><input type="number" name="jvbpd_ts[hd][topbar_height]" value="<?php echo esc_attr( jvbpd_tso()->header->get( 'topbar_height', '0' ));?>"></dd>
			</dl>

			<dl id="topbar_color_field" class="hidden">
				<dt><?php esc_html_e( "Topbar Background Color", 'jvbpd' );?></dt>
				<dd><input type="text" name="jvbpd_ts[hd][topbar_bg_color]" value="<?php echo esc_attr( jvbpd_tso()->header->get( 'topbar_bg_color', '#ffffff' ));?>" class="wp_color_picker" data-default-color="#ffffff"></dd>
			</dl>

			<dl id="topbar_text_color_field" class="hidden">
				<dt><?php esc_html_e( "Topbar Text Color", 'jvbpd' );?></dt>
				<dd><input type="text" name="jvbpd_ts[hd][topbar_text_color]" value="<?php echo esc_attr( jvbpd_tso()->header->get( 'topbar_text_color', '#000000' ));?>" class="wp_color_picker"></dd>
			</dl>

			<dl id="topbar_logo_field" class="hidden">
				<dt><?php esc_html_e( "Topbar Logo", 'jvbpd' );?></dt>
				<dd style="width:70%;">
					<fieldset>
						<input type="text" name="jvbpd_ts[hd][topbar_logo]" value="<?php echo esc_attr( jvbpd_tso()->header->get( 'topbar_logo' ) );?>" tar="topbar_logo">
						<input type="button" class="button button-primary fileupload" value="<?php esc_attr_e('Select Image', 'jvbpd' );?>" tar="topbar_logo">
						<input class="fileuploadcancel button" tar="topbar_logo" value="<?php esc_attr_e('Delete', 'jvbpd' );?>" type="button">
						<p>
							<?php esc_html_e("Preview",'jvbpd' ); ?><br>
							<img src="<?php echo esc_attr( jvbpd_tso()->header->get( 'topbar_logo' ) ); ?>" tar="topbar_logo">
						</p>
					</fieldset>
				</dd>
			</dl>

			<?php
			foreach(
				Array(
					'sidebar_left' => Array(
						'label' => esc_html__( "Left Sidebar", 'jvbpd' ),
						'note' => esc_html__( "It shows when there is at least one menu. otherwise, it doesn't show.", 'jvbpd' ),
					),
					'sidebar_member' => Array(
						'label' => esc_html__( "Member Sidebar", 'jvbpd' ),
						'note' => esc_html__( "It works when required plugins ('Core', 'BuddyPress') are actived. For groups, group component in BuddyPress needs to be actived.", 'jvbpd' ),
					),
				) as $strOptionName => $strOptionMeta
			) {
				?>
				<h4 class="pull-left"><?php echo esc_html( $strOptionMeta[ 'label' ] ); ?></h4>
				<fieldset class="inner margin-20-0 <?php if($strOptionMeta[ 'label' ]=='Member Sidebar') echo 'margin-custom-28-0'; ?>">
					<select name="jvbpd_ts[<?php echo esc_attr( $strOptionName ); ?>]">
						<?php
						foreach(
							Array(
								'enabled' => esc_html__( "Enable", 'jvbpd' ),
								'disabled' => esc_html__( "Disabled", 'jvbpd' ),
							) as $strOption => $strOptionLabel
						) {
							printf(
								'<option value="%1$s"%3$s>%2$s</option>',
								$strOption, $strOptionLabel,
								selected( $strOption == jvbpd_tso()->get( $strOptionName, apply_filters( 'jvbpd_theme_option_' . $strOptionName . '_default', '' ) ), true, false )
							);
						} ?>
					</select>
					<?php printf( '<div class="description">%1$s : %2$s</div>', esc_html__( "Note", 'jvbpd' ), $strOptionMeta[ 'note' ] ); ?>
				</fieldset>
				<?php
			}
		endif; ?>

		<h4><?php esc_html_e( "General", 'jvbpd' );?></h4><hr>
		<fieldset>
			<?php // if( jvbpd_layout()->getThemeType() == 'jvd-lk' ) : ?>
				<dl>
					<dt><?php esc_html_e( "Header Menu Type", 'jvbpd' );?></dt>
					<dd>
						<select name="jvbpd_ts[hd][header_type]" data-show-field='{"jv-nav-row-2":["#header_banner_field"]}'>
							<?php
							foreach( $jvbpd_options['header_type'] as $label => $value ) {
								printf(
									"<option value='{$value}' %s>{$label}</option>",
									selected( $value == jvbpd_tso()->header->get(
										'header_type', apply_filters( 'jvbpd_theme_option_header_type_default', 'dashboard-style', jvbpd_tso() )
									), true, false
								) );
							} ?>
						</select>
					</dd>
				</dl>
			<?php // endif; ?>

			<dl class="hidden" id="header_banner_field">
				<dt><?php esc_html_e( "Header Banner", 'jvbpd' );?></dt>
				<dd style="width:70%;">
					<fieldset>
						<input type="text" name="jvbpd_ts[hd][header_banner]" value="<?php echo esc_attr( jvbpd_tso()->header->get( 'header_banner' ) );?>" tar="header_banner">
						<input type="button" class="button button-primary fileupload" value="<?php esc_attr_e('Select Image', 'jvbpd' );?>" tar="header_banner">
						<input class="fileuploadcancel button" tar="header_banner" value="<?php esc_attr_e('Delete', 'jvbpd' );?>" type="button">
						<p>
							<?php esc_html_e("Preview",'jvbpd' ); ?><br>
							<img src="<?php echo esc_attr( jvbpd_tso()->header->get( 'header_banner' ) ); ?>" tar="header_banner">
						</p>
					</fieldset>
					<div class="description"><?php esc_html_e("Note: This banner is for only 2 Row type - Right banner menu type.", 'jvbpd' );?></div>
				</dd>
			</dl>

			<dl>
				<dt><?php esc_html_e( "Navi Type", 'jvbpd' );?></dt>
				<dd>
					<select name="jvbpd_ts[hd][header_relation]">
						<?php
						foreach( $jvbpd_options['default_header_relation'] as $label => $value )
						{
							printf( "<option value='{$value}' %s>{$label}</option>", selected( $value == jvbpd_tso()->header->get("header_relation"), true, false ) );
						} ?>
					</select>
					<div class="description"><?php esc_html_e("Caution: If you choose transparent menu type, page's main text contents ascends as much as menu's height to make menu transparent.", 'jvbpd' );?></div>
				</dd>
			</dl>

			<dl>
				<dt><?php esc_html_e( "Header Menu Skin ( Logo, Text )", 'jvbpd' );?></dt>
				<dd>
					<select name="jvbpd_ts[hd][header_skin]">
						<?php
						foreach( $jvbpd_options['header_skin'] as $label => $value )
						{
							printf( "<option value='{$value}' %s>{$label}</option>", selected( $value == jvbpd_tso()->header->get("header_skin"), true, false ) );
						} ?>
					</select>
					<div class="description"><?php esc_html_e("Depends on this option, logo changes to the color appropriate to the skin and if selected logo of skin option is not uploaded, theme's basic logo will be shown.", 'jvbpd' );?></div>
				</dd>
			</dl>
			<dl>
				<dt><?php esc_html_e( "Initial Header Background Color", 'jvbpd' );?></dt>
				<dd><input type="text" name="jvbpd_ts[hd][header_bg]" value="<?php echo esc_attr( jvbpd_tso()->header->get( 'header_bg', '#506ac5' ));?>" class="wp_color_picker" data-default-color="#506ac5"></dd>
			</dl>
			<dl>
				<dt><?php esc_html_e( "Header Memu Link Color", 'jvbpd' );?></dt>
				<dd><input type="text" name="jvbpd_ts[hd][db_menu_link_color]" value="<?php echo esc_attr( jvbpd_tso()->header->get("db_menu_link_color", "#ffffff"));?>" class="wp_color_picker" data-default-color="#ffffff">
				<div class="description"><?php esc_html_e("It's for only Dashboard menu type.", 'jvbpd' );?></div>

				</dd>
			</dl>

			<dl>
				<dt><?php esc_html_e( "Initial Header Transparency", 'jvbpd' );?></dt>
				<dd>
					<input type="text" name="jvbpd_ts[hd][header_opacity]" value="<?php echo (float)jvbpd_tso()->header->get("header_opacity", 1); ?>">
					<div class="description"><?php esc_html_e("Please enter numerical value from 0.0 to 1.0. The higher the value you enter, the more opaque it will be. Ex. 1=opaque, 0= invisible.", 'jvbpd' );?></div>
				</dd>
			</dl>

			<dl>
				<dt><?php esc_html_e( "Navi Shadow", 'jvbpd' );?></dt>
				<dd>
					<select name="jvbpd_ts[hd][header_shadow]">
						<?php
						foreach( $jvbpd_options['able_disable'] as $label => $value )
						{
							printf( "<option value='{$value}' %s>{$label}</option>", selected( $value == jvbpd_tso()->header->get("header_shadow"), true, false ) );
						} ?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt><?php esc_html_e( "Navi Position", 'jvbpd' );?></dt>
				<dd>
					<select name="jvbpd_ts[hd][header_fullwidth]">
						<?php
						foreach( $jvbpd_options['header_fullwidth'] as $label => $value ) {
							printf( "<option value='{$value}' %s>{$label}</option>", selected( $value == jvbpd_tso()->header->get( 'header_fullwidth', 'full' ), true, false ) );
						} ?>
					</select>
				</dd>
			</dl>
		</fieldset>

		<h4><?php esc_html_e("Navi on mobile setting", 'jvbpd' ); ?></h4><hr>
		<fieldset>
			<dl>
				<dt><?php esc_html_e( "Initial Mobile Header Background Color", 'jvbpd' );?></dt>
				<dd>
					<input type="text" name="jvbpd_ts[hd][mobile_header_bg]" value="<?php echo esc_attr( jvbpd_tso()->header->get("mobile_header_bg", "#ffffff"));?>" class="wp_color_picker" data-default-color="#ffffff">
				</dd>
			</dl>
			<dl>
				<dt><?php esc_html_e( "Initial Mobile Header Transparency", 'jvbpd' );?></dt>
				<dd>
					<input type="text" name="jvbpd_ts[hd][mobile_header_opacity]" value="<?php echo esc_attr( jvbpd_tso()->header->get("mobile_header_opacity", 1));?>">
					<div class="description"><?php esc_html_e("Please enter numerical value from 0.0 to 1.0. The higher the value you enter, the more opaque it will be. Ex. 1=opaque, 0= invisible.", 'jvbpd' );?></div>
				</dd>
			</dl>
			<dl>
				<dt><?php esc_html_e( "Header Menu Skin", 'jvbpd' );?></dt>
				<dd>
					<select name="jvbpd_ts[hd][mobile_header_skin]">
						<?php
						foreach( $jvbpd_options['header_skin'] as $label => $value )
						{
							printf( "<option value='{$value}' %s>{$label}</option>", selected( $value == jvbpd_tso()->header->get("mobile_header_skin"), true, false ) );
						} ?>
					</select>
					<div class="description"><?php esc_html_e("Depends on this option, logo changes to the color appropriate to the skin and if selected logo of skin option is not uploaded, theme's basic logo will be shown.", 'jvbpd' );?></div>
				</dd>
			</dl>
		</fieldset>
		*/ ?>

	</td></tr>
	</table>
</div>
<p class="field-custom description ">
	<label for="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>">
		<?php esc_html_e( "Icon Class (For Parent Menu on Left Sidebar Only)", 'jvfrmtd' ); ?><br />
		<input type="text" id="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="<?php echo esc_html(  $jvbpdAdmin->getNavField(  $item_id, '_menu_item_icon' ) );?>" value="<?php echo esc_attr( $item->nav_icon ); ?>" />
	</label>
	<?php
	printf(
		'<div><a href="%1$s" target="_blank">%3$s</a>, <a href="%2$s" target="_blank">%4$s</a> <br>%5$s</div>',
		esc_url_raw( 'http://fontawesome.io/icons/' ),
		esc_url_raw( 'wpjavo.com/a/jvbpd-icon1/icon1-list.html' ),
		esc_html__( "Font awsome", 'jvfrmtd' ),
		esc_html__( "Javo custom icons", 'jvfrmtd' ),
		esc_html__( "Ex) jvbpd-icon1-shop2", 'jvfrmtd' )
	); ?>
</p>

<?php
if( !isset( $jvbpdAdmin->cache_categories ) ) {
	$jvbpdAdmin->cache_categories = Array(
		'post' => get_terms( array( 'taxonomy' => 'category', 'fields' => 'id=>name', 'empty_hide' => false ) ),
		'lv_listing' => get_terms( array( 'taxonomy' => 'listing_category', 'fields' => 'id=>name', 'empty_hide' => false ) ),
	);
}

if( 0 === abs( $item->menu_item_parent ) ) {  ?>
	<p class="field-custom description ">
		<label for="edit-menu-item-subtitle-<?php echo esc_attr( $item_id ); ?>">
			<input type="checkbox" id="edit-menu-item-subtitle-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="<?php echo esc_attr(  $jvbpdAdmin->getNavField(  $item_id, '_wide_menu' ) );?>" value="yes" <?php echo checked( 'yes' == $item->wide_menu ); ?>" />
			<?php esc_html_e( "Wide menu (for Only top-level menu)", 'jvfrmtd' ); ?>
		</label>
	</p>
	<?php
	/*
	$arrImageURL = wp_get_attachment_image_src( $item->nav_bg );
	$arrImageURL = is_array( $arrImageURL ) ?  $arrImageURL[0] : ''; ?>
	<p class="field-custom description ">
		<div class="field-header"> <?php esc_html_e( "Background Image", 'jvfrmtd' ); ?></div>
		<div class="field-body jv-media-uploader-hepler" data-handle-title="<?php esc_html_e( "Mega menu background", 'jvfrmtd' ); ?>" data-select-button="<?php esc_html_e( "Select", 'jvfrmtd' ); ?>">
			<div class="field-preview preview-container" style="background-image:url(<?php echo esc_url_raw( $arrImageURL ); ?>);"></div>
			<div class="field-action">
				<button type="button" class="button button-primary upload">
					<i class="dashicons dashicons-admin-appearance"></i>
					<?php esc_html_e( "Select", 'jvfrmtd' ); ?>
				</button>
				<button type="button" class="button remove">
					<?php esc_html_e( "Cancel", 'jvfrmtd' ); ?>
				</button>
				<input type="hidden" id="edit-menu-item-subtitle-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="<?php echo esc_attr( $jvbpdAdmin->getNavField(  $item_id, '_nav_bg' ) );?>" value="<?php echo esc_attr( $item->nav_bg ); ?>">
			</div>
		</div>
	</p> */ ?>
<?php }?>

<p class="jvbpd-field field-post_type description description-wide">
	<label for="wide-menu-post-type-<?php echo esc_attr( $item_id ); ?>">
		<span><?php esc_html_e( "Mega menu post type", 'jvfrmtd' ); ?></span>
		<select id="wide-menu-post-type-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="<?php echo esc_attr( $jvbpdAdmin->getNavField(  $item_id, '_wide_menu_post_type' ) );?>">
			<?php
			foreach( Array('post', 'lv_listing') as $post_type ){
				printf(
					'<option value="%1$s" %3$s>%2$s</option>',
					$post_type, get_post_type_object($post_type)->label,
					selected($post_type == $item->wide_menu_post_type, true, false)
				);
			} ?>
		</select>
	</label>
</p>


<p class="jvbpd-field field-tax-post description description-wide hidden">
	<label for="wide-menu-post-categories-<?php echo esc_attr( $item_id ); ?>">
		<span><?php esc_html_e( "Mega menu post categories", 'jvfrmtd' ); ?></span>
		<select id="wide-menu-post-categories-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="<?php echo esc_attr( $jvbpdAdmin->getNavField(  $item_id, '_wide_menu_category' ) );?>[]" multiple="multiple">
			<!-- <option value="all" <?php selected( 'all' == $item->wide_menu_category ); ?>><?php esc_html_e( "All Category", 'jvfrmtd' ); ?></option> -->
			<?php
			foreach( $jvbpdAdmin->cache_categories['post'] as $intTermID => $strTermName ) {
				printf( '<option value="%1$s"%3$s>%2$s</option>', $intTermID, $strTermName, selected( in_array($intTermID, $item->wide_menu_category), true, false ) );
			} ?>
		</select>
	</label>
</p>

<p class="jvbpd-field field-tax-lv_listing description description-wide hidden">
	<label for="wide-menu-listing-categories-<?php echo esc_attr( $item_id ); ?>">
		<span><?php esc_html_e( "Mega menu listing categories", 'jvfrmtd' ); ?></span>
		<select id="wide-menu-listing-categories-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="<?php echo esc_attr( $jvbpdAdmin->getNavField(  $item_id, '_wide_menu_listing_category' ) );?>[]" multiple="multiple">
			<!-- <option value="all" <?php selected( 'all' == $item->wide_menu_listing_category ); ?>><?php esc_html_e( "All Category", 'jvfrmtd' ); ?></option> -->
			<?php
			foreach( $jvbpdAdmin->cache_categories['lv_listing'] as $intTermID => $strTermName ) {
				printf( '<option value="%1$s"%3$s>%2$s</option>', $intTermID, $strTermName, selected( in_array($intTermID, $item->wide_menu_listing_category), true, false ) );
			} ?>
		</select>
	</label>
</p>

<?php
if(function_exists('jvbpd_elements_tools')) {
	?>
	<p class="description description-wide">
		<label for="wide-menu-module-<?php echo esc_attr( $item_id ); ?>">
			<span><?php esc_html_e( "Mega menu module", 'jvfrmtd' ); ?></span>
			<select id="wide-menu-module-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="<?php echo esc_attr( $jvbpdAdmin->getNavField(  $item_id, '_wide_menu_module' ) );?>">
				<?php
				foreach( jvbpd_elements_tools()->getModuleIDs() as $moduleID => $strTermName ) {
					printf( '<option value="%1$s"%3$s>%2$s</option>', $moduleID, $strTermName, selected( $moduleID == $item->wide_menu_module, true, false ) );
				} ?>
			</select>
		</label>
	</p>
	<?php
}

/*

<?php
if( 'post_type' === $item->type ) {
	?>
	<p class="field-custom description ">
		<label for="edit-menu-item-scrollspy-<?php echo esc_attr( $item_id ); ?>">
			<br>
			<input type="checkbox" id="edit-menu-item-scrollspy-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="<?php echo esc_attr(  $jvbpdAdmin->getNavField( $item_id, '_menu_item_scrollspy' ) );?>" value="1" <?php checked( '1' == $item->scrollspy ); ?> />
			<?php esc_html_e( "Use as a scrollspy menu", 'jvfrmtd' ); ?>
		</label>
	</p>
	<p class="field-custom description ">
		<label for="edit-menu-item-scrollspy-author-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( "Scrollspy Anchor", 'jvfrmtd' ); ?><br />
			<input type="text" id="edit-menu-item-scrollspy-author-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="<?php echo esc_attr( $jvbpdAdmin->getNavField(  $item_id, '_menu_item_anchor' ) );?>" value="<?php echo esc_attr( $item->anchor ); ?>" />
		</label>
	</p>
	<?php
} */
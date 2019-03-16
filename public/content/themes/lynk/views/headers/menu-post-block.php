<?php
$jvbpd_menu_args = (object) Array(
	'post_type' => get_post_meta($item->ID, '_wide_menu_post_type', true),
	'taxonomy' => 'category',
    'term_id' => get_post_meta($item->ID, '_wide_menu_category', true),
	'module_id' => get_post_meta($item->ID, '_wide_menu_module', true),
);

if( ! isset( $jvbpd_menu_args ) || ! class_exists( 'Jvbpd_Shortcode_Parse' ) ) {
	return;
}

if( 'lv_listing' == $jvbpd_menu_args->post_type ) {
	$jvbpd_menu_args->term_id = get_post_meta($item->ID, '_wide_menu_listing_category', true);
	$jvbpd_menu_args->taxonomy = 'listing_category';
}

$jvbpd_menu_args->term_id = is_array($jvbpd_menu_args->term_id) ? join(',', $jvbpd_menu_args->term_id) : $jvbpd_menu_args->term_id;

$arrShortcodeArgs = Array(
	'count' => 3,
	'post_type' => $jvbpd_menu_args->post_type,
	'filter_by' => $jvbpd_menu_args->taxonomy,
	'filter_style' => 'general',
	'loading_style' => 'circle',
    'pagination' => 'prevNext',
    'layout_type' => 'type_a',

    'column_1' => $jvbpd_menu_args->module_id,
    'columns' => '3',

	// libaray/class-layout.php : add_menu_shortcode_atts > in_menu
	'in_menu' => true,
);

$arrShortcodeArgs[ 'post_title_font_color' ] = $arrShortcodeArgs[ 'post_describe_font_color' ] = $arrShortcodeArgs[ 'post_meta_font_color' ] = '#A7A7A7';

$intCustomTermID = false;
if( 'all' != $jvbpd_menu_args->term_id ) {
	//$intCustomTermID = intVal( $jvbpd_menu_args->term_id );
	$intCustomTermID = $jvbpd_menu_args->term_id;
	//if( 0 < $intCustomTermID ) {
        $arrShortcodeArgs[ 'custom_filter_by_post' ] = true;
        $arrShortcodeArgs[ 'filter_terms' ] = $intCustomTermID;
        $arrShortcodeArgs[ 'custom_filter' ] = $intCustomTermID;

	//}
}

$objWideCateShortcode = new jvbpd_block( $arrShortcodeArgs );
?>
	<div class="hidden-xs">
		<?php $objWideCateShortcode->sHeader(); ?>
			<div id="<?php echo esc_attr( $objWideCateShortcode->getID() ); ?>" class="shortcode-container no-flex-menu nav-active">
				<div class="shortcode-header">
					<div class="shortcode-nav">
						<?php $objWideCateShortcode->sFilter(); ?>
					</div>
				</div>
				<div class="shortcode-output">
					<?php
                    $objWideCateShortcode->loop($objWideCateShortcode->get_post());
                    /*
                    $objPosts = $objWideCateShortcode->get_post();
                    foreach( $objPosts as $ojbPost ) {
                        echo '<div class="col-md-4">';
                        $strTemplate = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($jvbpd_menu_args->module_id);
                        $replaceInstance =  new Jvbpd_Replace_Content( $ojbPost->ID, $strTemplate, 'post' );
                        echo $replaceInstance->render();
                        echo '</div>';
                    }
                    $objWideCateShortcode->sParams();
                    $objWideCateShortcode->pagination(); */ ?>
				</div>
			</div>
		<?php $objWideCateShortcode->sFooter(); ?>
	</div>
</li>
<?php
/* Disabled Mobile
$arrQueryArgs = Array( 'taxonomy' => 'category', 'hide_empty' => 'false', 'fields' => 'id=>name' );
if( $intCustomTermID ) {
	$arrQueryArgs[ 'include' ] = $intCustomTermID;
}
foreach( get_terms( $arrQueryArgs ) as $intTermID => $strTermName ) {
	?>
	<li class="sub-menu-item menu-item-depth-1 hidden-sm hidden-md hidden-lg">
		<a href="<?php echo get_term_link( $intTermID ); ?>" target="_self" class="menu-link sub-menu-link">
			<span class="menu-titles"><?php echo esc_html( $strTermName ); ?></span>
		</a>
	</li>
	<?php
} ?>
<li> */ ?>
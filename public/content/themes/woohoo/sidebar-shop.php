<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

$bdaia_get_page_meta = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
$bdaia_get_post_meta = get_post_meta( get_the_ID(), 'meta_post_options_bd', true );

if( is_category() || is_single() ) {
	$cat_id = '';
	if( is_category() ) $cat_id = get_query_var( 'cat' ) ;
	if( is_single() )
	{
		$categories = get_the_category( get_the_ID() );
		if( !empty( $categories[0]->term_id ) ) $cat_id = $categories[0]->term_id;
	}
	$bdaia_get_cat_meta = get_option( "bd_cat_$cat_id" );
}
$post_sidebars = $sidebar = "";
if( is_single() ) {
	if( isset( $bdaia_get_post_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_post_meta['sidebar_position_bd'];
}
elseif( is_page() ) {
	if( isset( $bdaia_get_page_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_page_meta['sidebar_position_bd'];
}
elseif( is_category() ) {
	if( isset( $bdaia_get_cat_meta['sidebar_po'] ) ) $post_sidebars = $bdaia_get_cat_meta['sidebar_po'];
}
elseif( is_author() ) {
	$post_sidebars = woohoo_get_option( 'author_sidebar_pos' );
}
elseif( is_tag() ) {
	$post_sidebars = woohoo_get_option( 'tag_sidebar_pos' );
}
elseif( is_archive() ) {
	$post_sidebars = woohoo_get_option( 'archive_sidebar_pos' );
}
elseif( is_search() ) {
	$post_sidebars = woohoo_get_option( 'search_sidebar_pos' );
}

if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );

if( $post_sidebars == 'default' || $post_sidebars == 'sideLeft' || $post_sidebars == 'sideRight' ) {
	?>

	<div class="bd-sidebar theia_sticky">
		<div class="cfix"></div>
		<div class="theiaStickySidebar">
			<?php
			wp_reset_query();

			if ( is_active_sidebar( 'woocommerce-widget' ) ) {
				dynamic_sidebar( 'woocommerce-widget' );
			}
			else {
				dynamic_sidebar( 'primary-widget' );
			}
			?>
		</div>
	</div>
<?php } ?>
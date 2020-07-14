<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

woohoo_set_post_views();

/* Single Post */
if( is_category() || is_single() )
{
	$cat_id = '';
	if( is_category() ) $cat_id = get_query_var( 'cat' ) ;
	if( is_single() )
	{
		$categories = get_the_category( get_the_ID() );
		if( !empty( $categories[0]->term_id ) ) $cat_id = $categories[0]->term_id;
	}
	$bdaia_get_cat_meta = get_option( "bd_cat_$cat_id" );
}

$bdaia_get_post_meta          = get_post_meta( get_the_ID(), 'meta_post_options_bd', true );

$post_template_style = "";
if( isset( $bdaia_get_post_meta['post_template_bd'] ) )
	$post_template_style = $bdaia_get_post_meta['post_template_bd'];

elseif( isset( $bdaia_get_cat_meta['bdaia_cat_post_template'] ) )
	$post_template_style = $bdaia_get_cat_meta['bdaia_cat_post_template'];

if( $post_template_style == '' ) $post_template_style = woohoo_get_option( 'bdaia_post_template' );

if( $post_template_style == 'postStyle1'        ) get_template_part( 'single-style1'    );
else if( $post_template_style == 'postStyle2'   ) get_template_part( 'single-style2'    );
else if( $post_template_style == 'postStyle3'   ) get_template_part( 'single-style3'    );
else if( $post_template_style == 'postStyle4'   ) get_template_part( 'single-style4'    );
else if( $post_template_style == 'postStyle5'   ) get_template_part( 'single-style5'    );
else if( $post_template_style == 'postStyle6'   ) get_template_part( 'single-style6'    );
else if( $post_template_style == 'postStyle7'   ) get_template_part( 'single-style7'    );
else if( $post_template_style == 'postStyle8'   ) get_template_part( 'single-style8'    );
else if( $post_template_style == 'postStyle9'   ) get_template_part( 'single-style9'    );
else if( $post_template_style == 'postStyle10'  ) get_template_part( 'single-style10'   );
else get_template_part( 'single-default' );
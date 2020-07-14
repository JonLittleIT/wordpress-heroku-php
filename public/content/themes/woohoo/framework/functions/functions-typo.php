<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly

if(file_exists(get_template_directory().'/framework/admin/framework-gfonts.php')) {
    require_once (get_template_directory().'/framework/admin/framework-gfonts.php');
}

/**
 * Enqueue Google fonts
 * ----------------------------------------------------------------------------- *
 */
function woohoo_enqueue_font( $got_font )
{
    if ( $got_font )
    {
        $char_set = '';
        if( woohoo_get_option( 'wp_typography_latin_extended' ) || woohoo_get_option( 'wp_typography_cyrillic' ) || woohoo_get_option( 'wp_typography_cyrillic_extended' ) || woohoo_get_option( 'wp_typography_greek' ) || woohoo_get_option( 'wp_typography_greek_extended' ) || woohoo_get_option( 'wp_typography_vietnamese' ) || woohoo_get_option( 'wp_typography_khmer' ) ){
            $char_set = '&subset=latin';
            if( woohoo_get_option( 'wp_typography_latin_extended' ) )
                $char_set .= ',latin-ext';

            if( woohoo_get_option( 'wp_typography_cyrillic' ) )
                $char_set .= ',cyrillic';

            if( woohoo_get_option( 'wp_typography_cyrillic_extended' ) )
                $char_set .= ',cyrillic-ext';

            if( woohoo_get_option( 'wp_typography_greek' ) )
                $char_set .= ',greek';

            if( woohoo_get_option( 'wp_typography_greek_extended' ) )
                $char_set .= ',greek-ext';

            if( woohoo_get_option( 'wp_typography_khmer' ) )
                $char_set .= ',khmer';

            if( woohoo_get_option( 'wp_typography_vietnamese' ) )
                $char_set .= ',vietnamese';
        }

        $font_pieces = explode(":", $got_font);
        $font_name = $font_pieces[0];
        $font_type = $font_pieces[1];

        if( $font_type == 'non-google' ){}

        elseif( $font_type == 'early-google' ){
            $font_name = str_replace (" ","", $font_pieces[0] );
            $protocol = is_ssl() ? 'https' : 'http';
            wp_enqueue_style( $font_name , $protocol.'://fonts.googleapis.com/earlyaccess/'.$font_name);
        }

        else {
            $font_name = str_replace (" ","+", $font_pieces[0] );
            $font_variants = str_replace ("|",",", $font_pieces[1] );
            $protocol = is_ssl() ? 'https' : 'http';
            wp_enqueue_style( $font_name , $protocol.'://fonts.googleapis.com/css?family='.$font_name . ':' . $font_variants.$char_set );
        }
    }
}

function woohoo_get_font( $got_font )
{
    if($got_font){
        $font_pieces = explode(":", $got_font);
        $font_name = $font_pieces[0];
        $font_name = str_replace('&quot;' , '"' , $font_pieces[0] );
        if (strpos($font_name, ',') !== false)
            return $font_name;
        else
            return "'".$font_name."'";
    }
}

$google_font_array  = json_decode ($google_api_output,true) ;
$options_fonts      = array();
$options_fonts['']  = 'Default Font';

foreach ($google_font_array as $item)
{
    $variants='';
    $variantCount=0;
    foreach ($item['variants'] as $variant)
    {
        $variantCount++;
        if ($variantCount>1) { $variants .= '|'; }
        $variants .= $variant;
    }
    $variantText = ' (' . $variantCount .' '. 'Variants' . ')';
    if ($variantCount <= 1) $variantText = '';
    $options_fonts[ $item['family'] . ':' . $variants ] = $item['family']. $variantText;
}


function woohoo_typography()
{
    global $custom_typography;
    foreach( $custom_typography as $selector => $input)
    {
        $option = woohoo_get_option( $input );
        if( !empty( $option['font'] ) ) woohoo_enqueue_font( $option['font'] ) ;
    }
}
add_action('wp_enqueue_scripts', 'woohoo_typography');

$custom_typography = array(

	## Body.
	'body' => 'bdaia_typo_body',

	## Logo.
	'.bdaia-header-default .header-container .logo .site-name' => 'logo_typography',

	## Top sub menu.
	'.bdaia-header-default .topbar .top-nav li a, .bdaia-header-default .topbar .top-nav > li ul.sub-menu li a' => 'bdaia_typo_header_top_sub_menu',

	## Top menu.
	'.bdaia-header-default .topbar .top-nav > li > a' => 'bdaia_typo_header_top_menu',

	## Main menu.
	'.bdaia-header-default #navigation .primary-menu #menu-primary > li > a' => 'bdaia_typo_header_main_menu',

	## Main sub menu.
	'.bdaia-header-default #navigation .primary-menu ul ul li' => 'bdaia_typo_header_main_sub_menu',

	## Main mega menu.
	'.bdaia-header-default #navigation .primary-menu ul#menu-primary div.bd_mega ul.bd_mega.sub-menu > li, div.bdaia-anp-inner li a' => 'bdaia_typo_header_main_mega_menu',

	## Main category menu.
	'.bdaia-header-default #navigation .bd-block-mega-menu-post h4, div.bdaia-anp-inner li a' => 'bdaia_typo_header_main_category_menu',

	## Live search.
	'.bdaia-ns-inner #sf_sb .entry-title' => 'bdaia_typo_header_live_search',

	## Mobile menu.
	'#bd-MobileSiderbar #mobile-menu a' => 'bdaia_typo_header_mobile_menu',

	## Mobile sub menu.
	'#bd-MobileSiderbar #mobile-menu ul ul a' => 'bdaia_typo_header_mobile_sub_menu',

	## Breaking news title.
	'div#bdaia-breaking-news.breaking-news-items span.breaking-title span.txt, span.breaking-title' => 'bdaia_typo_other_breaking_news_title',

	## Breaking news post.
	'ul.webticker li h4, .breaking-news-items a' => 'bdaia_typo_other_breaking_news',

	## Crumb.
	'.bdaia-crumb-container' => 'bdaia_typo_other_crumb',

	## Flexslider BIG Post title.
	'.bdaia-feature-posts.bdaia-fp-s1 .bdaia-post-title .entry-title' => 'bdaia_typo_flexslider_big_post_title',

	## Grid Style 1 small Post title.
	'.bdaia-feature-posts.bdaia-fp-s2 .big-grids .featured-title h2' => 'bdaia_typo_grid1_small_post_title',

	## Grid Style 1 Big Post title.
	'.bdaia-feature-posts.bdaia-fp-s2 .big-grids.big-grid1 .big-grid-1 .featured-title h2' => 'bdaia_typo_grid1_big_post_title',

	## Grid Style 2/3 small Post title.
	'.bdaia-feature-posts.bdaia-fp-s3 .big-grids .featured-title h2, div.bdaia-feature-posts.bdaia-fp-grid3 div.featured-title h2.post-title' => 'bdaia_typo_grid2_small_post_title',

	## Grid Style 2/3 Big Post title.
	'div.bdaia-feature-posts.bdaia-fp-grid3 div.big-grid-1 div.featured-title h2.post-title, .bdaia-feature-posts.bdaia-fp-s3 .big-grids.big-grid2 .big-grid-1 .featured-title h2, .bdaia-feature-posts.bdaia-fp-s3 .big-grids.big-grid2 .big-grid-2 .featured-title h2' => 'bdaia_typo_grid2_big_post_title',

	## Post Carousel Post title.
	'.bd-post-carousel-item article .bd-meta-info-align h3' => 'bdaia_typo_post_carousel_post_title',

	## Feature posts meta info.
	'.big-grids .featured-title .bdayh-date, .bd-post-carousel-item article .bd-meta-info, .bdaia-feature-posts .bdaia-meta-info' => 'bdaia_typo_post_feature_posts_meta_info',

	## Category name (shape).
	'.bd-cat-link' => 'bdaia_typo_other_category_name_shape',

	## More buttons.
	'.bd-more-btn, .bdaia-wb-wrap .bdaia-wb-more-btn .bdaia-wb-mb-inner, .bdaia-load-more-news-btn, button, input[type="button"], input[type="reset"], input[type="submit"]' => 'bdaia_typo_other_more_buttons',

	## Blocks title.
	'.bdaia-block-wrap h4.block-title, .bdaia-template-head h4.block-title' => 'bdaia_typo_blocks_title',

	## Blocks meta info.
	'.bdaia-block-wrap .bdaia-blocks footer' => 'bdaia_typo_blocks_meta_info',

	## Blocks excerpt.
	'.bdaia-block-wrap .bdaia-blocks p.block-exb, .bdaia-slider-block .ei-title h3' => 'bdaia_typo_blocks_excerpt',

	## Block Slider Post title.
	'.bdaia-slider-block .ei-title h2' => 'bdaia_typo_block_slider_post_title',

	## Block 1 Post title.
	'.bdaia-blocks.bdaia-block1 .entry-title' => 'bdaia_typo_block1_post_title',

	## Block 2 Post title.
	'.bdaia-blocks.bdaia-block2 .entry-title' => 'bdaia_typo_block2_post_title',

	## Block 3 Post title.
	'.bdaia-blocks.bdaia-block3 .entry-title' => 'bdaia_typo_block3_post_title',

	## Block 4 Post title.
	'.bdaia-blocks.bdaia-block4 .entry-title' => 'bdaia_typo_block4_post_title',

	## Block 5 Post title.
	'.bdaia-blocks.bdaia-block5 .entry-title' => 'bdaia_typo_block5_post_title',

	## Block 6 Post title.
	'.bdaia-blocks.bdaia-block6 .entry-title' => 'bdaia_typo_block6_post_title',

	## Block 7 Post title.
	'.bdaia-blocks.bdaia-block7 .entry-title' => 'bdaia_typo_block7_post_title',

	## Block 8 Big Post title.
	'.bdaia-blocks.bdaia-block8 .block-article.block-first-article .entry-title' => 'bdaia_typo_block8_big_post_title',

	## Block 8 Small Post title.
	'.bdaia-blocks.bdaia-block8 .block-article.block-other-article .entry-title' => 'bdaia_typo_block8_small_post_title',

	## Block 9 Big Post title.
	'.bdaia-blocks.bdaia-block9 .block-article.block-first-article .entry-title' => 'bdaia_typo_block9_big_post_title',

	## Block 9 Small Post title.
	'.bdaia-blocks.bdaia-block9 .block-article.block-other-article .entry-title' => 'bdaia_typo_block9_small_post_title',

	## Block 10 Big Post title.
	'.bdaia-blocks.bdaia-block10 .block-article.block-first-article .entry-title' => 'bdaia_typo_block10_big_post_title',

	## Block 10 Small Post title.
	'.bdaia-blocks.bdaia-block10 .block-article.block-other-article .entry-title' => 'bdaia_typo_block10_small_post_title',

	## Block 11 Big Post title.
	'.bdaia-blocks.bdaia-block11 .block-article.block-first-article .entry-title' => 'bdaia_typo_block11_big_post_title',

	## Block 11 Small Post title.
	'.bdaia-blocks.bdaia-block11 .block-article.block-other-article .entry-title' => 'bdaia_typo_block11_small_post_title',

	## Block 13 Post title.
	'div.bdaia-blocks.bdaia-block22 div.block-article .entry-title' => 'bdaia_typo_block13_post_title',

	## Block Timeline Post title.
	'div.bdaia-block-wrap.bdaia-new-timeline .entry-title' => 'bdaia_typo_block_timeline_post_title',

	## Widget title.
	'#bdCheckAlso h4.block-title, .bd-sidebar h4.block-title, div.bdaia-footer h4.block-title, #bdaia-ralated-posts .bdaia-ralated-posts-head li a, .bdaia-widget-tabs .bdaia-tabs-nav li a' => 'bdaia_typo_widget_title',

	## Widget Post meta info.
	'.bdaia-wb-wrap .bwb-article-content-wrapper footer' => 'bdaia_typo_widget_post_meta_info',

	## Widget Post excerpt.
	'.bdaia-wb-wrap .bdaia-wb-article p.block-exb, .check-also-post p' => 'bdaia_typo_widget_post_excerpt',

	## Widget Post title.
	'div.widget.bdaia-widget .widget-inner li, div.widget.bdaia-widget .widget-inner h3, div.widget.bdaia-widget .widget-inner h4, div.widget.bdaia-widget.bd-tweets .widget-inner p.twitter-text, .check-also-post .post-title, .bdaia-posts-grid-post.post .entry-title, .bdaia-posts-grid-post h3' => 'bdaia_typo_widget_post_title',

	## Widget Post Big title.
	'.bdaia-wb-wrap .bdaia-wb-article.bdaia-wba-big .entry-title, .bdaia-wb-wrap .bdaia-wb-article.bdaia-wba-bigsh .entry-title' => 'bdaia_typo_widget_post_big_title',

	## Single Post Meta info.
	'.single .bdaia-meta-info, .page .bdaia-meta-info' => 'bdaia_typo_single_post_meta_info',

	## Single Post title.
	'.bdaia-post-title .entry-title' => 'bdaia_typo_single_post_title',

	## Single Post blocks title.
	'.single .bdaia-site-content h4.block-title, .page .bdaia-site-content h4.block-title, .bdaia-author-box .authorBlock-header-title' => 'bdaia_typo_single_post_blocks_title',

	## Post content.
	'.single .bdaia-site-content .bdaia-post-content, .single .bdaia-site-content .bdaia-post-content p, .page .bdaia-site-content .bdaia-post-content, .page .bdaia-site-content .bdaia-post-content p' => 'bdaia_typo_post_content',

	## Default blockqoute.
	'.single .bdaia-site-content .bdaia-post-content blockquote, .single .bdaia-site-content .bdaia-post-content blockquote p, .page .bdaia-site-content .bdaia-post-content blockquote, .page .bdaia-site-content .bdaia-post-content blockquote p' => 'bdaia_typo_post_content_blockqoute',

	## h1.
	'.bdaia-site-content .bdaia-post-content h1' => 'bdaia_typo_post_content_h1',

	## h2.
	'.bdaia-site-content .bdaia-post-content h2' => 'bdaia_typo_post_content_h2',

	## h3.
	'.bdaia-site-content .bdaia-post-content h3' => 'bdaia_typo_post_content_h3',

	## h4.
	'.bdaia-site-content .bdaia-post-content h4' => 'bdaia_typo_post_content_h4',

	## h5.
	'.bdaia-site-content .bdaia-post-content h5' => 'bdaia_typo_post_content_h5',

	## h6.
	'.bdaia-site-content .bdaia-post-content h6' => 'bdaia_typo_post_content_h6',

	## Footer top tags
	'div.woohoo-footer-top-area .tagcloud a, div.woohoo-footer-top-area .tagcloud span' => 'woohoo_footer_typo_top_tags',

	## Footer about us
	'div.woohoo-footer-top-area .footer-about-us-inner' => 'woohoo_footer_typo_about_us',

	## Footer menu
	'div.woohoo-footer-menu a, div.woohoo-footer-menu' => 'woohoo_footer_typo_menu',

	## Grid 4 Post title ---------(^.^)
	'div.bdaia-feature-posts.bdaia-fp-grid4 div.featured-title h2.post-title' => 'bdaia_typo_grid4_post_title',

	## Grid 5 Post title ---------(^.^)
	'div.bdaia-feature-posts.bdaia-fp-grid5 div.featured-title h2.post-title' => 'bdaia_typo_grid5_post_title',

	## Grid 6 Post title ---------(^.^)
	'div.bdaia-feature-posts.bdaia-feature-grid6 div.featured-title h2.post-title' => 'bdaia_typo_grid6_post_title',

	## Grid 7 Post title ---------(^.^)
	'div.big-grids.big-grid7 div.featured-title h2' => 'bdaia_typo_grid7_post_title',
);
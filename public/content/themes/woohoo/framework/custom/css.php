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
<style type="text/css">
<?php
// Post content.
$ctc    = woohoo_get_option( 'bdaia_post_content_text_color' );
$clc    = woohoo_get_option( 'bdaia_post_content_links_color' );
$clhc   = woohoo_get_option( 'bdaia_post_content_links_hover_color' );
$cbtc   = woohoo_get_option( 'bdaia_post_content_blockqoute_text_color' );
if( !empty( $ctc ) || !empty( $clc ) || !empty( $clhc ) || !empty( $cbtc ) )
{
	if( !empty( $ctc ) ) echo '.bdaia-post-content, .bdaia-post-content p, .bdaia-post-content h1, .bdaia-post-content h2, .bdaia-post-content h3, .bdaia-post-content h4, .bdaia-post-content h5, .bdaia-post-content h6, .bdaia-post-content blockquote p, blockquote p {color: '.$ctc.';}';
	if( !empty( $clc ) ) echo '.bdaia-post-content a{color: '.$clc.';}';
	if( !empty( $clhc ) ) echo '.bdaia-post-content a:hover{color: '.$clhc.';}';
	if( !empty( $cbtc ) ) echo '.bdaia-post-content blockquote p, .bdaia-post-content blockquote {color: '.$cbtc.';}';
}
// Body.
$btc    = woohoo_get_option( 'bdaia_sbody_text_color' );
$blc    = woohoo_get_option( 'bdaia_sbody_links_color' );
$blhc   = woohoo_get_option( 'bdaia_sbody_links_hover_color' );
if( !empty( $btc ) || !empty( $blc ) || !empty( $blhc ) )
{
	if( !empty( $btc ) ) echo 'body {color: '.$btc.';}';
	if( !empty( $blc ) ) echo 'a, a:link, a:active{color: '.$blc.';}';
	if( !empty( $blhc ) ) echo 'a:hover{color: '.$blhc.';}';
}
/*-----------------------------------------------------------------------------------*/
// START Custom Background
/*-----------------------------------------------------------------------------------*/
$background_displays = woohoo_get_option( 'background_displays' );
if ( $background_displays == 'bg_cutsom' )
{
    echo 'body {';

        $bg = woohoo_get_option( 'custom_background' );
        if( !empty( $bg['color'] ) ){
            echo 'background-color:'. $bg['color'] .';';
        }

        if( !empty( $bg['img'] ) ){
            echo 'background-image:url("'. $bg['img'] .'");';
        }

        if( !empty( $bg['repeat'] ) ){
            echo 'background-repeat:'. $bg['repeat'] .';';
        }

        if( !empty( $bg['attachment'] ) ){
            echo 'background-attachment:'. $bg['attachment'] .';';
        }

        if( !empty( $bg['hor']  ) || !empty( $bg['ver'] ) ){
            echo 'background-position:'. $bg['hor'] .' '. $bg['ver'] .';';
        }

        if( woohoo_get_option( 'custom_background_full' ) ){
            echo 'background-size: cover; -o-background-size: cover; -moz-background-size: cover; -webkit-background-size: cover;';
        }

    echo '}';
}
elseif ( $background_displays == 'bg_pattren' )
{
    $pa = woohoo_get_option( 'pattrens_bg' );
    $pa_c = woohoo_get_option( 'custom_pattrens_color' );
    if ( $pa || $pa_c )
    {
        echo 'body {';

            if( $pa_c ){
                echo 'background-color:'. $pa_c .';';
            }

            if( $pa == 'pat1' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-1.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat2' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-2.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat3' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-3.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat4' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-4.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat5' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-5.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat6' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-6.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat7' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-7.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat8' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-8.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat9' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-9.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat10' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-10.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat11' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-11.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat12' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-12.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat13' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-13.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat14' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-14.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat15' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-15.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat16' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-16.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat17' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-17.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat18' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-18.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat19' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-19.png" ); background-position: center center; background-repeat: repeat;';
            }

            if( $pa == 'pat20' ){
                echo 'background-image: url( "'. get_template_directory_uri() .'/images/pattrens/pat-20.png" ); background-position: center center; background-repeat: repeat;';
            }

        echo '}';
    }
}
/*-----------------------------------------------------------------------------------*/
// END Custom Background
/*-----------------------------------------------------------------------------------*/
/**
 * Unlimited colors
 * ----------------------------------------------------------------------------- *
 */
function woohoo_theme_colors($unlimited_colors)
{
echo '
a:hover{color:'.$unlimited_colors.'}
::selection{background:'.$unlimited_colors.'}
a.more-link, button, .btn-link, input[type="button"], input[type="reset"], input[type="submit"] { background-color:'.$unlimited_colors.'}
button:active, .btn-link:active, input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active { background-color:'.$unlimited_colors.'}
.gotop:hover { background-color:'.$unlimited_colors.'}
.top-search { background-color:'.$unlimited_colors.'}
.primary-menu ul#menu-primary > li.current-menu-parent, .primary-menu ul#menu-primary > li.current-menu-ancestor, .primary-menu ul#menu-primary > li.current-menu-item, .primary-menu ul#menu-primary > li.current_page_item { color: '.$unlimited_colors.'; }
.primary-menu ul#menu-primary > li.current-menu-parent > a, .primary-menu ul#menu-primary > li.current-menu-ancestor > a, .primary-menu ul#menu-primary > li.current-menu-item > a, .primary-menu ul#menu-primary > li.current_page_item > a { color: '.$unlimited_colors.'; }
.primary-menu ul#menu-primary > li:hover > a { color: '.$unlimited_colors.'; }
.primary-menu ul#menu-primary li.bd_menu_item ul.sub-menu li:hover > ul.sub-menu, .primary-menu ul#menu-primary li.bd_mega_menu:hover > ul.bd_mega.sub-menu, .primary-menu ul#menu-primary li.bd_menu_item:hover > ul.sub-menu, .primary-menu ul#menu-primary .sub_cats_posts { border-top-color: '.$unlimited_colors.'; }
div.nav-menu.primary-menu-dark a.menu-trigger:hover i, div.nav-menu.primary-menu-light a.menu-trigger:hover i, div.nav-menu.primary-menu-light a.menu-trigger.active i, div.nav-menu.primary-menu-dark a.menu-trigger.active i { background: '.$unlimited_colors.'; }
span.bd-criteria-percentage { background: '.$unlimited_colors.'; color: '.$unlimited_colors.'; }
.divider-colors { background: '.$unlimited_colors.'; }
.blog-v1 article .entry-meta a { color: '.$unlimited_colors.'; }
.blog-v1 article .article-formats { background-color: '.$unlimited_colors.'; }
.cat-links { background-color: '.$unlimited_colors.'; }
.new-box { border-top-color: '.$unlimited_colors.'; }
.widget a:hover { color: '.$unlimited_colors.'; }
.timeline-article a:hover i {
    color: '.$unlimited_colors.';
}
h4.block-title:before {background: '.$unlimited_colors.';}
#header.bdayh-header.a {background: '.$unlimited_colors.';}
.bdaia-load-comments-btn a:hover,
.bd-more-btn:hover{
    border-color: '.$unlimited_colors.' ;
    background-color: '.$unlimited_colors.' ;
}
#bdaia-cats-builder ul.slick-dots li.slick-active button{
	background: '.$unlimited_colors.';
}
.bdaia-cats-more-btn,
.bbd-post-cat-content, .bbd-post-cat-content a,
.blog-v1 article a.more-link { color: '.$unlimited_colors.'; }
#big-grids .flex-next:hover,
#big-grids .flex-prev:hover,
.featured-title:hover .featured-cat a,
.featured-title .featured-comment a,
.big-grids-container .flex-control-paging li a.flex-active,
.tagcloud a:hover { background: '.$unlimited_colors.'; }
.featured-title:hover .bd-cat-link:before {border-top-color: '.$unlimited_colors.';}
.featured-title .featured-comment a:after {
    border-color: '.$unlimited_colors.' rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
}
ul.tabs_nav li.active a { background: '.$unlimited_colors.'; }
.bd-tweets ul.tweet_list li.twitter-item a { color: '.$unlimited_colors.'; }
.widget.bd-login .login_user .bio-author-desc a { color: '.$unlimited_colors.'; }
.comment-reply-link, .comment-reply-link:link, .comment-reply-link:active { color: '.$unlimited_colors.'; }
.gallery-caption { background-color: '.$unlimited_colors.'; }
.slider-flex ol.flex-control-paging li a.flex-active { background: '.$unlimited_colors.'; }
#folio-main ul#filters li a.selected { background: '.$unlimited_colors.'; }
.search-mobile button.search-button { background: '.$unlimited_colors.'; }
.bdaia-pagination .current {
background-color: '.$unlimited_colors.';
border-color: '.$unlimited_colors.';
}
.gotop{background: '.$unlimited_colors.';}
.ei-slider-thumbs li.ei-slider-element {background: '.$unlimited_colors.';}
.ei-title h2,
.ei-title h3 {border-right-color: '.$unlimited_colors.';}
.sk-circle .sk-child:before,
#reading-position-indicator{background: '.$unlimited_colors.';}
#bdCheckAlso{border-top-color: '.$unlimited_colors.';}
.woocommerce .product .onsale, .woocommerce .product a.button:hover, .woocommerce .product #respond input#submit:hover, .woocommerce .checkout input#place_order:hover, .woocommerce .woocommerce.widget .button:hover, .single-product .product .summary .cart .button:hover, .woocommerce-cart .woocommerce table.cart .button:hover, .woocommerce-cart .woocommerce .shipping-calculator-form .button:hover, .woocommerce .woocommerce-message .button:hover, .woocommerce .woocommerce-error .button:hover, .woocommerce .woocommerce-info .button:hover, .woocommerce-checkout .woocommerce input.button:hover, .woocommerce-page .woocommerce a.button:hover, .woocommerce-account div.woocommerce .button:hover, .woocommerce.widget .ui-slider .ui-slider-handle, .woocommerce.widget.widget_layered_nav_filters ul li a {background: none repeat scroll 0 0 '.$unlimited_colors.' !important}
.bdaia-post-content blockquote p,
blockquote p{
color: '.$unlimited_colors.';
}
.bdaia-ns-wrap:after {background:'.$unlimited_colors.'}
.bdaia-header-default #navigation .primary-menu ul#menu-primary > li >.bd_mega.sub-menu,
.bdaia-header-default #navigation .primary-menu ul#menu-primary > li > .sub-menu,
.bdaia-header-default #navigation .primary-menu ul#menu-primary .sub_cats_posts {border-top-color: '.$unlimited_colors.'}
.bdaia-header-default #navigation .primary-menu ul#menu-primary > li:hover > a:after,
.bdaia-header-default #navigation .primary-menu ul#menu-primary > li.current-menu-item > a:after,
.bdaia-header-default #navigation .primary-menu ul#menu-primary > li.current-menu-ancestor > a:after,
.bdaia-header-default #navigation .primary-menu ul#menu-primary > li.current-menu-parent > a:after {background:'.$unlimited_colors.'}
.bdaia-header-default #navigation .primary-menu #menu-primary > li:hover > a{color: '.$unlimited_colors.'}
.bdayh-click-open{background:'.$unlimited_colors.'}
div.bdaia-alert-new-posts-inner,
.bdaia-header-default .header-wrapper{border-top-color: '.$unlimited_colors.'}
.bdaia-post-content blockquote p,
blockquote p{color: '.$unlimited_colors.'}
.bdaia-post-content a {color: '.$unlimited_colors.'}
div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover,
div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover span.bdayh-date {
    color: '.$unlimited_colors.';
}
div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover span.bdayh-date:before {
    background: '.$unlimited_colors.';
    border-color: '.$unlimited_colors.';
}
#navigation .bdaia-alert-new-posts,
div.bdaia-tabs.horizontal-tabs ul.nav-tabs li.current:before,
div.bdaia-toggle h4.bdaia-toggle-head.toggle-head-open span.bdaia-sio {
    background: '.$unlimited_colors.';
}
.woocommerce .product .onsale, .woocommerce .product a.button:hover, .woocommerce .product #respond input#submit:hover, .woocommerce .checkout input#place_order:hover, .woocommerce .woocommerce.widget .button:hover, .single-product .product .summary .cart .button:hover, .woocommerce-cart .woocommerce table.cart .button:hover, .woocommerce-cart .woocommerce .shipping-calculator-form .button:hover, .woocommerce .woocommerce-message .button:hover, .woocommerce .woocommerce-error .button:hover, .woocommerce .woocommerce-info .button:hover, .woocommerce-checkout .woocommerce input.button:hover, .woocommerce-page .woocommerce a.button:hover, .woocommerce-account div.woocommerce .button:hover, .woocommerce.widget .ui-slider .ui-slider-handle, .woocommerce.widget.widget_layered_nav_filters ul li a {
    background: none repeat scroll 0 0 '.$unlimited_colors.' !important
}
div.bdaia-post-count {border-left-color :'.$unlimited_colors.'}

aside#bd-MobileSiderbar svg,
#bdaia-selector #bdaia-selector-toggle {background:'.$unlimited_colors.'}

div.bdaia-blocks.bdaia-block22 div.block-article hr{background:'.$unlimited_colors.'}
div.bdaia-blocks.bdaia-block22 div.block-article .post-more-btn a,
div.bdaia-blocks.bdaia-block22 div.block-article .post-more-btn a:hover,
div.bdaia-blocks.bdaia-block22 div.block-article .bdaia-post-cat-list a,
div.bdaia-blocks.bdaia-block22 div.block-article .bdaia-post-cat-list a:hover{color:'.$unlimited_colors.'}
div.woohoo-footer-top-area .tagcloud span,
div.woohoo-footer-top-area .tagcloud a:hover {background: '.$unlimited_colors.';}
.bdaia-header-default #navigation.mainnav-dark .primary-menu ul#menu-primary > li:hover > a,
.bdaia-header-default #navigation.mainnav-dark .primary-menu ul#menu-primary > li.current-menu-item > a,
.bdaia-header-default #navigation.mainnav-dark .primary-menu ul#menu-primary > li.current-menu-ancestor > a,
.bdaia-header-default #navigation.mainnav-dark .primary-menu ul#menu-primary > li.current-menu-parent > a,
.bdaia-header-default #navigation.mainnav-dark {background: '.$unlimited_colors.';}
.bdaia-header-default #navigation.dropdown-light .primary-menu ul#menu-primary li.bd_mega_menu div.bd_mega ul.bd_mega.sub-menu li a:hover,
.bdaia-header-default #navigation.dropdown-light .primary-menu ul#menu-primary li.bd_menu_item ul.sub-menu li a:hover,
.bdaia-header-default #navigation.dropdown-light .primary-menu ul#menu-primary .sub_cats_posts a:hover {color: '.$unlimited_colors.';}
#reading-position-indicator {box-shadow: 0 0 10px '.$unlimited_colors.';}
div.woohoo-footer-light div.woohoo-footer-top-area a:hover,
div.woohoo-footer-light div.bdaia-footer-area a:hover,
div.woohoo-footer-light div.bdaia-footer-widgets a:hover,
div.woohoo-footer-light div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover,
div.woohoo-footer-light div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover span.bdayh-date{color: '.$unlimited_colors.';}
div.woohoo-footer-light div.bdaia-footer-widgets .carousel-nav a:hover {background-color: '.$unlimited_colors.';border-color: '.$unlimited_colors.';}


.bp-navs ul li .count,
.buddypress-wrap #compose-personal-li a,
.buddypress-wrap .bp-pagination .bp-pagination-links .current,
.buddypress-wrap .activity-list .load-more a,
.buddypress-wrap .activity-list .load-newest a,
.buddypress-wrap .profile .profile-fields .label:before,
.buddypress #buddypress.bp-dir-hori-nav .create-button a,
.widget.buddypress .item-options a.selected:not(.loading)
{
    background: '.$unlimited_colors.';
}

.widget.buddypress .item-options a.selected:not(.loading)
{
    border-color: '.$unlimited_colors.';
}

.bp-navs ul li.selected a,
.bp-navs ul li.current a,
.bp-dir-hori-nav:not(.bp-vertical-navs) .bp-navs.main-navs ul li a:hover,
.bp-dir-hori-nav:not(.bp-vertical-navs) .bp-navs.main-navs ul li.selected a,
.bp-dir-hori-nav:not(.bp-vertical-navs) .bp-navs.main-navs ul li.current a,
#group-create-tabs:not(.tabbed-links) li.current a,
.buddypress-wrap .bp-subnavs li.selected a,
.buddypress-wrap .bp-subnavs li.current a,
.activity-list .activity-item .activity-meta.action .unfav:before,
#buddypress #latest-update a,
.buddypress-wrap .profile .profile-fields .label,
.buddypress-wrap .profile.edit .button-nav li a:hover,
.buddypress-wrap .profile.edit .button-nav li.current a,
.bp-single-vert-nav .bp-navs.vertical li.selected a,
.bp-single-vert-nav .item-body:not(#group-create-body) #subnav:not(.tabbed-links) li.current a,
.bp-dir-vert-nav .dir-navs ul li.selected a,
.buddypress-wrap.bp-vertical-navs .dir-navs.activity-nav-tabs ul li.selected a,
.buddypress-wrap.bp-vertical-navs .dir-navs.sites-nav-tabs ul li.selected a,
.buddypress-wrap.bp-vertical-navs .dir-navs.groups-nav-tabs ul li.selected a,
.buddypress-wrap.bp-vertical-navs .dir-navs.members-nav-tabs ul li.selected a,
.buddypress-wrap.bp-vertical-navs .main-navs.user-nav-tabs ul li.selected a,
.buddypress-wrap.bp-vertical-navs .main-navs.group-nav-tabs ul li.selected a,
.activity-list q::before,
.activity-list blockquote::before,
.activity-list q cite,
.activity-list blockquote cite
{
    color: '.$unlimited_colors.';
}
.search-mobile .search-submit {background: '.$unlimited_colors.';}
';
}

## Custom Post Color
if(is_category() || is_singular() || (function_exists('is_woocommerce') && is_woocommerce()))
{
    $cat_bg = '';
    $cat_bg_color = '';
    $cat_full = '';
    if(is_category())
	{
		$category_id = get_query_var('cat') ;
		$cat_get_options = get_option( "bd_cat_$category_id");
		$cat_options = $cat_get_options['custom_styles_bd'];

        if( !empty( $cat_get_options['cat_color'] ) ){
            $cat_color = $cat_get_options['cat_color'];
        }

        if( !empty( $cat_options['img'] ) ){
            $cat_bg = $cat_options['img'];
        }

        if( !empty( $cat_options['color'] ) ){
            $cat_bg_color = $cat_options['color'];
        }

        if( !empty( $cat_options['repeat'] ) ){
            $cat_bg_repeat = $cat_options['repeat'];
        }

        if( !empty( $cat_options['attachment'] ) ){
            $cat_bg_attachment = $cat_options['attachment'];
        }

        if( !empty( $cat_options['hor'] ) ){
            $cat_bg_hor = $cat_options['hor'];
        }

        if( !empty( $cat_options['ver'] ) ){
            $cat_bg_ver = $cat_options['ver'];
        }

        if( !empty( $cat_get_options['full_scr'] ) ){
            $cat_full = $cat_get_options['full_scr'];
        }
	}

	if( is_singular() || (function_exists('is_woocommerce') && is_woocommerce()) )
	{
        $current_ID = get_the_ID();
        if(function_exists('is_woocommerce') && is_woocommerce()){
            $current_ID = woocommerce_get_page_id('shop');
        }
        $get_meta = get_post_meta( $current_ID, 'custom_styles_bd', true );

		if(!empty($get_meta["post_color"])){
			$cat_color = $get_meta["post_color"];
        }

		if(!empty($get_meta["img"])){
			$cat_bg = $get_meta["img"];
        }

        if(!empty($get_meta["color"])){
			$cat_bg_color = $get_meta["color"];
        }

        if(!empty($get_meta["repeat"])){
			$cat_bg_repeat = $get_meta["repeat"];
        }

        if(!empty($get_meta["attachment"])){
			$cat_bg_attachment = $get_meta["attachment"];
        }

        if(!empty($get_meta["hor"])){
			$cat_bg_hor = $get_meta["hor"];
        }

        if(!empty($get_meta["ver"])){
			$cat_bg_ver = $get_meta["ver"];
        }

		if(!empty($get_meta["full_scr"])){
			$cat_full = $get_meta['full_scr'];
        }

        if( is_single() )
        {
			$categories = get_the_category( get_the_ID() );
			$category_id = "";
			if( !empty( $categories[0]->term_id ) ) {
				$category_id = $categories[0]->term_id;
			}
            $cat_get_options    = get_option( "bd_cat_$category_id");
		    $cat_options        = $cat_get_options['custom_styles_bd'];

            if( empty($cat_color) && !empty( $cat_get_options['cat_color'] ) ){
                $cat_color = $cat_get_options['cat_color'];
            }

            if( empty($cat_bg) && !empty( $cat_options['img'] ) ){
                $cat_bg = $cat_options['img'];
            }

            if( empty($cat_bg_color) && !empty( $cat_options['color'] ) ){
                $cat_bg_color = $cat_options['color'];
            }

            if( empty($cat_bg_repeat) && !empty( $cat_options['repeat'] ) ){
                $cat_bg_repeat = $cat_options['repeat'];
            }

            if( empty($cat_bg_attachment) && !empty( $cat_options['attachment'] ) ){
                $cat_bg_attachment = $cat_options['attachment'];
            }

            if( empty($cat_bg_hor) && !empty( $cat_options['hor'] ) ){
                $cat_bg_hor = $cat_options['hor'];
            }

            if( empty($cat_bg_ver) && !empty( $cat_options['ver'] ) ){
                $cat_bg_ver = $cat_options['ver'];
            }

            if( empty($cat_full) && !empty( $cat_get_options['full_scr'] ) ){
                $cat_full = $cat_get_options['full_scr'];
            }
		}
	}

    if(!empty($cat_color)){
        woohoo_theme_colors($cat_color);
    }

    if( $cat_bg || $cat_bg_color ){
        echo 'body {';
            if( !empty( $cat_bg_color ) ){
                echo 'background-color:'. $cat_bg_color .';';
            }
            if( !empty( $cat_bg ) ){
                echo 'background-image:url("'. $cat_bg .'");';
            }
            if( !empty( $cat_bg_repeat ) ){
                echo 'background-repeat:'. $cat_bg_repeat .';';
            }
            if( !empty( $cat_bg_attachment ) ){
                echo 'background-attachment:'. $cat_bg_attachment .';';
            }
            if( !empty( $cat_bg_hor  ) || !empty( $cat_bg_ver ) ){
                echo 'background-position:'. $cat_bg_hor .' '. $cat_bg_ver .';';
            }
            if( $cat_full ){
                echo 'background-size: cover; -o-background-size: cover; -moz-background-size: cover; -webkit-background-size: cover;';
            }
        echo '}';
    }
}
/* Category Name Bg Color */
$categories_obj = get_categories('hide_empty=0');
foreach ($categories_obj as $pn_cat)
{
    $category_id = $pn_cat->cat_ID ;
    $cat_get_options = get_option( "bd_cat_$category_id");

    if( !empty( $cat_get_options['cat_color'] ) )
    {
        $cat_custom_color = $cat_get_options['cat_color'];
        echo '.bd-cat-' . $category_id . '{ background : ' . $cat_custom_color . ' !important }';
        echo '.bd-cat-' . $category_id . ':before{ border-top-color : ' . $cat_custom_color . ' !important }';
    }
}
if( is_page() )
{
	$get_meta_bo = get_post_custom( get_the_ID() );

	if( isset( $get_meta_bo[ 'bdaia_bp_block_options' ][0] ) )
	{
		$get_bp_bo = false;
		if( !empty( $get_meta_bo[ 'bdaia_bp_block_options' ][0] ) )
		{
			$get_bp_bo = $get_meta_bo[ 'bdaia_bp_block_options' ][0];
			if( is_serialized( $get_bp_bo ) ){
				$get_bp_bo = unserialize ( $get_bp_bo );
			}
		}
	}

	if( !empty( $get_bp_bo[ 'blocks_cats_meta' ][0] ) ) echo '.bdaia-blocks .block-info-cat, .bdaia-blocks .bdaia-post-cat-list{ display: none !important;}';
	if( !empty( $get_bp_bo[ 'blocks_review_star' ][0] ) ) echo '.bdaia-blocks .bdaia-post-rating{display: none !important;}';
	if( !empty( $get_bp_bo[ 'blocks_author_meta' ][0] ) ) echo '.bdaia-blocks .bdaia-post-author-name{display: none !important;}';
	if( !empty( $get_bp_bo[ 'blocks_date_meta' ][0] ) ) echo '.bdaia-blocks .bdaia-post-date{display: none !important;}';
	if( !empty( $get_bp_bo[ 'blocks_comments_count_meta' ][0] ) ) echo '.bdaia-blocks .bdaia-post-comment{display: none !important;}';
	if( !empty( $get_bp_bo[ 'blocks_views_meta' ][0] ) ) echo '.bdaia-blocks .bdaia-post-view{display: none !important;}';
	if( !empty( $get_bp_bo[ 'blocks_read_more' ][0] ) ) echo '.bdaia-blocks .bd-more-btn{display: none !important;}';
}
/* Tagline color */
if( woohoo_get_option( 'tagline_color' ) )
{
	echo '.bdaia-header-default .header-container .logo .site-tagline{color:'.woohoo_get_option( 'tagline_color' ).'}';
}
/* Begin Typo */
global $custom_typography;
foreach( $custom_typography as $selector => $input ){
$option = woohoo_get_option( $input );
if( !empty( $option['font'] ) && $option['font'] || !empty( $option['size'] ) && $option['size'] || !empty( $option['lineheight'] ) && $option['lineheight'] || !empty( $option['weight'] ) && $option['weight'] || !empty( $option['style'] ) && $option['style'] || !empty( $option['texttransform'] ) && $option['texttransform'] ):
echo $selector."{"; ?>
<?php if( !empty( $option['font'] ) && $option['font'] ) { echo "font-family: ". stripslashes( woohoo_get_font( $option['font'] ) )."; "; } ?>
<?php if( !empty( $option['size'] ) && $option['size'] ) { echo "font-size : ".$option['size']."px; "; } ?>
<?php if( !empty( $option['lineheight'] ) && $option['lineheight'] ) { echo "line-height : ".$option['lineheight']."px; "; }?>
<?php if( !empty( $option['weight'] ) && $option['weight'] ) { echo "font-weight: ".$option['weight']."; "; } ?>
<?php if( !empty( $option['style'] ) && $option['style'] ) { echo "font-style: ". $option['style']."; "; } ?>
<?php if( !empty( $option['texttransform'] ) && $option['texttransform'] ) { echo "text-transform: ". $option['texttransform']."; "; } ?>
}
<?php endif;
} /* End Typo */
// Custom Css.
$custom_css = woohoo_get_option( 'custom_css' );
$custom_css_code =  str_replace( "<pre>", "", stripslashes( $custom_css ) );
echo $custom_css_code = str_replace( "</pre>", "", $custom_css_code ), "\n";
// Desktop 1170.
if( woohoo_get_option( 'css_desktop' ) ){ ?>
@media (min-width: 1170px) {
<?php echo stripcslashes( woohoo_get_option( 'css_desktop' ) ); ?>
}
<?php }
// Ipad Landscape 1024 to 1170.
if( woohoo_get_option( 'css_tablets' ) ){ ?>
@media (min-width: 1024px) and (max-width: 1170px) {
<?php echo stripcslashes( woohoo_get_option( 'css_tablets' ) ); ?>
}
<?php }
// Ipad Portrait 768 to 1170.
if( woohoo_get_option( 'css_wide_phones' ) ){ ?>
@media (min-width: 768px) and (max-width: 1170px) {
<?php echo stripcslashes( woohoo_get_option( 'css_wide_phones' ) ); ?>
}
<?php }
// Phones 0 to 760.
if( woohoo_get_option( 'css_phones' ) ){ ?>
@media (max-width: 760px) {
<?php echo stripcslashes( woohoo_get_option( 'css_phones' ) ); ?>
}
<?php
}

if( woohoo_get_option( 'custom_theme_color' ) ) woohoo_theme_colors( woohoo_get_option( 'custom_theme_color' ) );
?>
</style>
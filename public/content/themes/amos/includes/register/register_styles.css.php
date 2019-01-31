<?php header("Content-type: text/css; charset: UTF-8");
$amos_redata = amos_redata_variable();

$styles = $amos_redata;

extract($styles);
?>

<style type="text/css">
  
	 #test{display: none;}
	 aside .tagcloud a:hover, .nav-growpop .icon-wrap, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .woocommerce #content .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page .quantity .plus:hover,.block_title .nav-fillpath a:hover,.overlay_menu nav ul li a:after, .latest_blog .owl-carousel .owl-controls .owl-next:hover, .latest_blog .owl-carousel .owl-controls .owl-prev:hover, .testimonial_carousel_element:hover .pagination a.next:hover, .testimonial_carousel_element:hover .pagination a.prev:hover, .block_title.column_title.inner-inline_border_circle .divider .line, .services_text .divider .line, .block_title.section_title .divider .line,.wpcf7 input[type="submit"].btn-bt.default, aside .widget-title:after, .woocommerce span.onsale, .woocommerce-page span.onsale, aside .widget-title:after, .blog-article .readmore span:after, .menu_6 nav .menu>li a::before, aside ul li a:after,.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span, .latest_blog .format-quote .content, .subscribe_form .subscribe_submit, .blog-article.alternate-style.format-quote .content, .single-portfolio .custom_layout .media_container .title h2 span:before, #portfolio-filter ul li a:after, #blog-filter ul li a:after, .recent_news.vertical .blog-item .readmore span:after {background:<?php echo esc_attr($primary_color) ?>;} 


	 .plyr__play-large svg{fill:<?php echo esc_attr($primary_color) ?> !important;}
	 <?php if($show_ver_separator == '0') : ?>
	 	.header_tools .vert_mid .right_search:after, .header_tools .cart:after{display: none;}
	 <?php endif; ?>
	 .header_wrapper.h4, .header_wrapper.h6, .header_wrapper.h7{height:<?php echo (esc_attr($header_first_row_height['height'])+esc_attr($header_second_row_height['height']))?>px !Important;}
	 
	 .header_tools .vert_mid .right_search:after, .header_tools .cart:after{color:<?php echo esc_attr($base_border_color); ?>}
	 .blog-article .extra_info, .latest_blog .blog-article.grid-style .content .text, .single_testimonial,.vc_tta-style-default .vc_tta-tabs-container {border-color: rgba(<?php echo implode(',', amos_hexToRgb($base_border_color)); ?>, 0.7);}
	 .comment dl dd span.author a, .button .readmore:hover,.blog-article .readmore:hover, .btn-bt.bordered_effect, .post_navigation a:hover .icon-wrapper i, .latest_blog .content .readmore:hover, .yith-wcwl-wishlistexistsbrowse i.fa.fa-heart, .yith-wcwl-add-button a.add_to_wishlist, .yith-wcwl-add-to-wishlist, .portfolio_single .nav-growpop a:hover h3, .product_list_widget .woocs_price_code .amount, #portfolio-filter ul li a:hover, #blog-filter ul li a:hover, aside ul li:before{
	 	color:<?php echo esc_attr($primary_color) ?>;
	 }
	 .light .latest_blog .owl-carousel .owl-controls .owl-next:hover, .light .latest_blog .owl-carousel .owl-controls .owl-prev:hover, .light .testimonial_carousel_element:hover .pagination a.next:hover, .light .testimonial_carousel_element:hover .pagination a.prev:hover, .light .nav-fillpath a:hover,.vc_tta-style-default .vc_tta-tab.vc_active, .wpcf7 input[type="submit"].btn-bt.default, .btn-bt.bordered_effect span.border, .owl-theme .owl-dots .owl-dot span {border-color:<?php echo esc_attr($primary_color) ?>;}
  
	  .services_large:hover, .wpcf7 .subscribe_form input:not([type="submit"]):focus, .price_table.highlighted, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .blog-article.sticky .content{border-color:<?php echo esc_attr($primary_color) ?> !important;}
	 .nav-growpop .icon-wrap{border:0px solid <?php echo esc_attr($primary_color) ?>;}
	 nav .amos_custom_menu_mega_menu > ul > li{border-right:1px solid <?php echo esc_attr($dropdown_border_color) ?>;}
	 .amos_slider .swiper-slide .buttons a.bordered:hover, .header_12 .full_nav_menu nav ul > li:hover, .header_12 .full_nav_menu nav ul > li.current-menu-item, .header_12 .full_nav_menu nav ul > li.current-menu-parent, .header_12 .full_nav_menu nav ul > li:hover, .blog-article.standard-style .info .date, .blog-article.standard-style.format-quote .content, article .info .date{background:<?php echo esc_attr($primary_color) ?>;}
	 .top_nav .footer_social_icons li:hover a i, .header_wrapper .footer_social_icons li:hover a i, .amos_slider .swiper-slide .buttons.colors-light a.colored:hover, .vc_btn3.vc_btn3-color-white.vc_btn3-style-outline:hover, .light .wpcf7 input.btn-bt, blockquote:before, .header_tools .open_search_button:hover,  .header_tools .cart .cart_icon:hover{color:<?php echo esc_attr($primary_color) ?> !important;}
	 .blog-article.timeline-style .timeline .date, #s, #respond textarea, #respond input[type="text"], .recent_news.events .blog-item, .post-password-form input[type="password"], aside #woocommerce-product-search-field{border:1px solid <?php echo esc_attr($base_border_color) ?>;}
	 .header_12 .full_nav_menu nav ul > li{border-left:1px solid <?php echo esc_attr($base_border_color) ?>;}
	 .header_12 .full_nav_menu nav ul > li:last-child{border-right:1px solid <?php echo esc_attr($base_border_color) ?>; padding-right:<?php echo esc_attr($menu_padding['padding-right']) ?> !important;}
	 .timeline-border{background:<?php echo esc_attr($base_border_color) ?>;}
	 <?php $primary_hex = amos_hexToRgb($primary_color); ?>
	 .skill .prog, .amos_slider .swiper-slide .buttons.colors-light a.colored, .recent_news.events .blog-item:hover, .owl-theme .owl-controls.clickable .owl-buttons div:hover, .clients_el .pagination a:hover{background:<?php echo esc_attr($primary_color) ?>;}
	 .services_medium.style_1:hover .icon_wrapper, .services_medium.style_3:hover .icon_wrapper{box-shadow: inset 0 0 0 70px <?php echo esc_attr($primary_color) ?>, inset 0 0 0 16px rgba(255,255,255,0.8), 0 1px 2px rgba(0,0,0,0.1);
	 }
	 .services_medium.style_3:hover .icon_wrapper, .clients_el .pagination a:hover,.woocommerce .add_to_cart_button.btn-bt,.amos_slider .swiper-slide .buttons.colors-light a.colored:hover{border:1px solid <?php echo esc_attr($primary_color) ?> !important;}
	  .header_12 .after_navigation_widgetized #s, .woocommerce .cart-collaterals .cart_totals .actions input#coupon_code{border:1px solid <?php echo esc_attr($base_border_color) ?>;}
	 .list li.titledesc dl dt .circle{border:2px solid <?php echo esc_attr($base_border_color) ?>;}
	 blockquote, .blockquote{border-left:2px solid <?php echo esc_attr($primary_color) ?>;}
	 .header_page h1{line-height:<?php echo (int) $page_header_height['height'] ?>px;}
	 .services_media.style_2 h5, .accordion.style_1 .accordion-heading.in_head .accordion-toggle, .header_tools .cart_icon .nr, .vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,.woocommerce .add_to_cart_button.btn-bt  {
		background:<?php echo esc_attr($primary_color) ?>;
	 }

	 .header_tools .extra_navigation_button .circles_container .circle{
	 	border-color: <?php echo esc_attr($menu_font_style['color']);?>;
	 }

	  .header_tools .extra_navigation_button:hover .circles_container .circle{
	 	border-color: <?php echo esc_attr($primary_color) ?> !important;
	 }

	 .services_medium:not(.style_2) .icon_wrapper:after{box-shadow: 0 0 0 2px <?php echo esc_attr($primary_color) ?>;}
	 .services_small .content div, .comment .comment_text{line-height: <?php echo esc_attr($body_typography['line-height']) ?>;}
	  <?php if($amos_redata['page_header_design_style'] == 'padd'): ?>
	 .header_page.with_padding_style.with_subtitle.centered .titles h1, .header_page.with_padding_style.with_subtitle.left .titles h1{background:rgba(<?php echo implode(',', amos_hexToRgb($page_header_padd_bg_title['color'])); ?>, <?php echo esc_attr($page_header_padd_bg_title['alpha']) ?> );}
	 .header_page.with_padding_style.with_subtitle.centered .titles h3, .header_page.with_padding_style.with_subtitle.left .titles h3{background:rgba(<?php echo implode(',', amos_hexToRgb($page_header_padd_bg_subtitle['color'])); ?>, <?php echo esc_html($page_header_padd_bg_subtitle['alpha']) ?> ); color:<?php echo esc_attr($page_header_padd_bg_subtitle_font) ?>;}
	  <?php endif; ?>
	 .services_large:hover .icon_wrapper, .services_steps:hover .icon_wrapper, .nav-fillpath a:hover {background: <?php echo esc_attr($primary_color) ?> ;}
	  .header_12 .full_nav_menu{border-top:1px solid <?php echo esc_attr($base_border_color) ?>; border-bottom:1px solid <?php echo esc_attr($base_border_color) ?>}
	 .section-style.borders{border-top:1px solid rgba(<?php echo implode(',', amos_hexToRgb($base_border_color)); ?>, 0.5) ; border-bottom:1px solid rgba(<?php echo implode(',', amos_hexToRgb($base_border_color)); ?>, 0.5)}
	 .background--dark header#header .header_tools .vert_mid > a:hover, .background--dark header#header .header_tools .vert_mid .cart .cart_icon:hover, .tabbable.style_1.tabs-left .nav-tabs li.active a, .contact_information dt i, .nav-fillpath a, .vc_tta-tab > a i{color:<?php echo esc_attr($primary_color) ?> !important;}
	  .tabbable.tabs-top.style_1 .nav.nav-tabs li.active a,.post_navigation a:hover span i,  .post_navigation a:hover h5,  .post_navigation a:hover h6, .single_testimonial dl dd .param .position, #menu-onepage .current-menu-item a{color:<?php echo esc_attr($primary_color) ?>;}
	 .vc_custom_heading a:hover,.social_icons_sc i{color:<?php echo esc_attr($primary_color) ?> !important;}
	 .blog-article a.btn-bt.default:not(.author_link):hover{color:<?php echo esc_attr($primary_color) ?> !important;}
	 <?php if(!$header_transparency): ?>  
	 .header_1.fullwidth_slider_page .top_wrapper, .header_4.fullwidth_slider_page .top_wrapper, .header_5.fullwidth_slider_page .top_wrapper,.header_5.page_header_yes .top_wrapper, .header_11.fullwidth_slider_page .top_wrapper{
	 	padding-top:<?php echo esc_attr($header_height['height']); ?>;
	 }
	 <?php endif; ?>
	 .menu_3 nav .menu>li.current-menu-item, .menu_3 nav .menu>li.current_page_item, .menu_3 nav .menu>li.current-menu-parent, .menu_3 nav .menu>li:hover{border-top:3px solid <?php echo esc_attr($primary_color) ?>;}
	 .menu_3 nav .amos_custom_menu_mega_menu{border-top:2px solid <?php echo esc_attr($primary_color) ?>;}
	 .menu_3 nav .menu > li > ul.sub-menu{border-top:2px solid <?php echo esc_attr($primary_color) ?>;}

	 .header_3 nav .menu>li.current-menu-item, .header_3 nav .menu>li.current-menu-parent, .header_3 nav .menu>li:hover{border-top:3px solid <?php echo esc_attr($primary_color) ?>;}
	 .header_3 nav .amos_custom_menu_mega_menu{border-top:2px solid <?php echo esc_attr($primary_color) ?>;}
	 .header_3 nav .menu > li > ul.sub-menu{border-top:2px solid <?php echo esc_attr($primary_color) ?>;} 
	 <?php $bd_hex = amos_hexToRgb($background_dropdown); ?>  
	 .menu_4 nav .menu li > ul, .menu_4 nav .menu>li:hover a, .menu_4 nav .menu>li.current-menu-item a, .menu_4 nav .menu>li.current-menu-parent, .header_4 .amos_custom_menu_mega_menu, .menu_4 .amos_custom_menu_mega_menu{background:rgba(<?php 
	 		 echo implode(',', amos_hexToRgb($background_dropdown['color'])); ?>, 0.90) !important;}
	 <?php $dbc = amos_hexToRgb($dropdown_border_color); ?>   
	 .menu_4 .amos_custom_menu_mega_menu ul.sub-menu{
	 	background:transparent !important; 
	 }
	 .menu_4 nav .menu>li:hover a, .menu_4 nav .menu>li.current-menu-item a, .menu_4 nav .menu>li.current-menu-parent a{color:<?php echo esc_attr($megamenu_title['color']) ?>;}
	 .menu_4 nav .menu li > ul.sub-menu li{border-bottom:1px solid rgba(<?php echo esc_attr($dbc['r']) ?>,<?php echo esc_attr( $dbc['g']) ?>,<?php echo esc_attr($dbc['b']) ?>,0);}
	 .menu_4 nav .menu li > ul.sub-menu li:hover, .header_4 nav .menu li > ul.sub-menu li.current_page_item {background: rgba(<?php  if(!empty($bd_hex)){
	  			echo ($bd_hex['r']-10); ?>, <?php echo ($bd_hex['g']-10); ?>, <?php echo ($bd_hex['b']-10); }?>, 0.90)}
   
	 .header_4 .header_page.with_subtitle .titles{margin-top:<?php echo ($header_height['height']/2) ?>px;}
	 
	 .header_8 nav .menu>li.current-menu-item, .header_8 nav .menu>li.current-menu-parent, .header_8 nav .menu>li:hover{border-bottom:3px solid <?php echo esc_attr($primary_color) ?>;}
	 .header_9 nav .menu>li>a::before, .header_9 nav .menu>li>a.current_page_item::before, .header_5 nav .menu>li>a::before, .header_5 nav .menu>li>a.current_page_item::before, .menu_2 nav .menu li>a::before, .menu_2 nav .menu>li>a.current_page_item::before, .menu_2 nav .menu li .sub-menu li a:hover::before, .menu_2 nav .menu li .sub-menu li.current-menu-item a::before{background-color: <?php echo esc_attr($primary_color) ?>; }

	 .wrapper-menu .line-menu{
	 	background-color: <?php echo esc_attr($menu_font_style['color']);?>; 
	 }


	 .menu_7 nav .menu li.current_page_item a, .menu_7 nav .menu li.current-menu-item a, .menu_7 nav .menu li a:hover
	 {color: rgba(<?php echo implode(',', amos_hexToRgb($menu_7_color_1['color'])); ?>, <?php echo esc_attr($menu_7_color_1['alpha'])?> );

	 	background: linear-gradient(45deg, rgba(<?php echo implode(',', amos_hexToRgb($menu_7_color_1['color'])); ?>, <?php echo esc_attr($menu_7_color_1['alpha'])?> ) 0%, rgba(<?php echo implode(',', amos_hexToRgb($menu_7_color_2['color'])); ?>, <?php echo esc_attr($menu_7_color_2['alpha'])?> ) 100%);
	 	-webkit-background-clip: text;
  		-webkit-text-fill-color: transparent;}

	 /*.header_9 nav .menu>li.current-menu-item > a, .header_9 nav .menu>li.current-menu-parent > a{border-bottom:2px solid <?php echo esc_attr($primary_color) ?>;}
	 */
	 .header_10 .full_nav_menu .container{border-top:1px solid <?php echo esc_attr($base_border_color) ?>;border-bottom:1px solid <?php echo esc_attr($base_border_color) ?>;}
	 <?php if($header_10_border): ?>
	 .header_10 .full_nav_menu .container{border-top:1px solid <?php echo esc_attr($base_border_color) ?>;border-bottom:1px solid <?php echo esc_attr($base_border_color) ?>;}
	 <?php endif; ?>
	 .header_11.sticky_header nav.left .menu > li:last-child{padding-right:<?php echo esc_attr($menu_padding['padding-right']) ?>; margin-right:<?php echo esc_attr($menu_margin['margin-right']) ?>; }
	 <?php if($h_vertical_border): ?>
		 <?php if($h_vertical_position == "left") $e = "border-right:1px solid "; else $e = "border-left:1px solid "; ?> 
		.h8 .header_wrapper, .h9 .header_wrapper{ <?php echo esc_html($e).esc_attr($base_border_color) ?> }
	 <?php endif; ?>

	 <?php if($h8_border_top): ?>
		.h8.header_wrapper {
			border-top: 6px solid <?php echo esc_attr($primary_color) ?>;
		}
	 <?php endif; ?>

	 <?php if(!$header_transparency): ?> 
	 .header_transparency.fullwidth_slider_page .top_wrapper, .header_transparency.page_header_yes .top_wrapper{
	 	padding-top:<?php echo esc_attr($header_height['height']); ?>;
	 }
	 <?php endif; ?>

	 .creative-single.background--light .title .info li.date::after, .creative-single.background--light .title .info li.date::before{background:<?php echo amos_output($headings_font_color);?>}
	 .woocommerce ul.products li.product:hover .overlay, .woocommerce-page ul.products li.product:hover .overlay{background:rgba(<?php echo implode(',', amos_hexToRgb($shop_product_overlay['color'])); ?>, <?php echo esc_attr($shop_product_overlay['alpha']) ?> );}
	 .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price, .woocommerce .star-rating span, .woocommerce-page .star-rating span, .recent_news.events .link i{color: <?php echo esc_attr($primary_color) ?>;}
	 .header_tools .cart .checkout{
	 	border-top:1px solid rgba(<?php echo esc_attr(implode(',', amos_hexToRgb($dropdown_border_color))) ?>, 0.3);
	 }
	 .header_tools .cart_icon i:before{line-height:<?php echo esc_attr($menu_font_style['line-height']) ?>;}
	  .header_tools .cart .content .cart_item{
	  	border-bottom:1px solid <?php echo esc_attr($dropdown_border_color) ?>;
	  }
	   .header_tools .cart .content .cart_item .description .price, .header_tools .cart .content .cart_item .description .price .amount, .header_tools .cart .cart_item .remove:after{
	  	color:<?php echo esc_attr($dropdown_font['color']) ?>;
	  }
	  .header_tools .cart .content .cart_item .description .title, .header_tools .cart .checkout .subtotal{
	  	color:<?php echo esc_attr($megamenu_title['color']) ?>;
	  }
	  .header_tools .cart .content .cart_item .description .title:hover, .header_tools .cart .cart_item .remove:hover:after{color:<?php echo esc_attr($primary_color) ?>;}
	 .tabbable.style_1 .nav-tabs li a{font-weight: <?php echo esc_attr($headings_font_type['font-weight']) ?>}
	 .portfolio-item.grayscale .project:after{
  		border-color: transparent transparent <?php echo esc_attr($portfolio_grayscale_bg) ?> transparent;
	 }
	 .portfolio-item.grayscale p.description, .portfolio-item.grayscale .project p a{ color: <?php echo amos_output($portfolio_grayscale_title['color']);?>; }
	 .vc_separator.vc_separator_align_center h4, .vc_separator.vc_separator_align_left h4, .vc_separator.vc_separator_align_right h4{color: <?php echo esc_attr($primary_color);?>}
	 .portfolio_single ul.info li .title{
	 	font-weight: <?php echo esc_attr($sidebar_widget_title['font-weight']) ?>
	 }

	 .portfolio-item.overlayed .tpl2 .bg.custom_bg{background: linear-gradient(45deg, rgba(<?php echo implode(',', amos_hexToRgb($portfolio_overlay_bg_grad1['color'])); ?>, <?php echo esc_attr($portfolio_overlay_bg_grad1['alpha'])?> ) 0%, rgba(<?php echo implode(',', amos_hexToRgb($portfolio_overlay_bg_grad2['color'])); ?>, <?php echo esc_attr($portfolio_overlay_bg_grad2['alpha'])?> ) 100%)}

	 .portfolio-item.overlayed .tpl2 .bg.custom_bg:after{background: linear-gradient(45deg, rgba(<?php echo implode(',', amos_hexToRgb($portfolio_overlay_bg_grad1['color'])); ?>, <?php echo esc_attr($portfolio_overlay_bg_grad1['alpha'])?> ) 0%, rgba(<?php echo implode(',', amos_hexToRgb($portfolio_overlay_bg_grad2['color'])); ?>, <?php echo esc_attr($portfolio_overlay_bg_grad2['alpha'])?> ) 100%)}

	 .content_portfolio.fullwidth #portfolio-filter ul li.mixitup-control-active a, .content_portfolio.fullwidth #portfolio-filter ul li a:hover{border-bottom: 1px solid <?php echo amos_output($amos_redata['portfolio_filter_full_link_color']['color']);?>;}
	 .tabbable.tabs-top.style_1 .nav.nav-tabs li a{
	 	text-transform: <?php echo esc_attr($sidebar_widget_title['text-transform']) ?>;
	 }



	 /*#portfolio-preview-items.slider .swiper-slide .overlay{background-color:rgba(<?php echo implode(',', amos_hexToRgb($portfolio_slider_overlay_color['color'])); ?>, <?php echo esc_attr($portfolio_slider_overlay_color['alpha'])?>);}*/

	 .woocommerce #review_form #respond textarea, .woocommerce-page #review_form #respond textarea,.side-nav,.wpcf7-form-control-wrap input, .wpcf7-form-control-wrap textarea,.select2-drop-active, .woocommerce .woocommerce-ordering, .woocommerce-page .woocommerce-ordering, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce .woocommerce-message, .woocommerce-page .woocommerce-error, .woocommerce-page .woocommerce-info, .woocommerce-page .woocommerce-message, #mc_signup_form .mc_input{
		border:1px solid <?php echo esc_attr($contact_border) ?> !important;
	 }
	
	 .side-nav li{
	 	border-bottom:1px solid <?php echo esc_attr($contact_border) ?>;
	 }

	 footer .widget_search input[type="text"]{
	 	background:<?php echo esc_attr($copyright_background_color) ?>;
	 	color:<?php echo esc_attr($footer_body_typography['color']) ?>;
	 	font-size:<?php echo esc_attr($footer_body_typography['font-size']) ?>;
	 	line-height:<?php echo esc_attr($footer_body_typography['line-height']) ?>;

	 }
	 .fixed_bar .icon:before, .fixed_bar .icon:after {background-color: <?php echo esc_attr($footer_body_typography['color']) ?>;}

	 .amos_news_slider .swiper-slide h1, .amos_news_slider .featured_posts .featured h4, .portfolio-item.parallax .content_box{
	 	background:rgba(<?php echo esc_attr($primary_hex['r']) ?>, <?php echo esc_attr($primary_hex['g']) ?>, <?php echo esc_attr($primary_hex['b']) ?>, 0.8);
	 }

	 .extra_navigation h5.widget-title{
	 	text-transform:<?php echo esc_html($sidebar_widget_title['text-transform']) ?>;
	 	font-weight:<?php echo esc_attr($sidebar_widget_title['font-weight']) ?>;
	 	font-size:<?php echo esc_attr($sidebar_widget_title['font-size']) ?>;
	 	letter-spacing: :<?php echo esc_attr($sidebar_widget_title['letter-spacing']) ?>;
	 	line-height:<?php echo esc_attr($sidebar_widget_title['line-height']) ?>;
	 }

	 .blog-article.grid-style .content h1, .latest_blog .blog-item .content h4, .recent_news .blog-item h4, .recent_news.events .blog-item dt .date{text-transform: <?php echo esc_html($blog_title_typography['text-transform']) ?>}

	  .blog-article.creative-single .content h1, aside .widget_most_popular li a{color:<?php echo esc_html($blog_title_typography['color'])?>}
	 //.blog-article.standard-style .content {background-color:<?php echo esc_attr($timeline_bg_color);?>}
	 .latest_blog .blog-item .content h4{font-weight:<?php echo esc_attr($blog_title_typography['font-weight']) ?>;}
	 
	 .price_table  h1, .price_table .list ul li:before, .blog-article.timeline-style .timeline .date .month{color:<?php echo esc_attr($primary_color) ?>;}

	 .side-nav li.current_page_item, .p_pagination .pagination .current, .p_pagination .pagination a:hover, .block_title.column_title.inner-inline_border .divider, .not_found .search_field .btn-bt{background:<?php echo esc_attr($primary_color) ?>;}

	 .services_large .services_large_image {
	 	<?php if(!empty($primary_color)): ?>
				box-shadow: inset 0 0 0 0  rgba(<?php echo esc_attr($primary_hex['r']) ?>, <?php echo esc_attr($primary_hex['g']) ?>, <?php echo esc_attr($primary_hex['b']) ?>, 0.4), inset 0 0 0 16px rgba(255,255,255,0.6), 0 1px 2px rgba(0,0,0,0.1) ;
		<?php endif; ?> 
	 }	
	 .services_large:hover .services_large_image{
	 	<?php if(!empty($primary_color)): ?>
				box-shadow:inset 0 0 0 110px rgba(<?php echo esc_attr($primary_hex['r']) ?>, <?php echo esc_attr($primary_hex['g']) ?>, <?php echo esc_attr($primary_hex['b']) ?>, 0.4), inset 0 0 0 16px rgba(255,255,255,0.8), 0 1px 2px rgba(0,0,0,0.1) ;
		<?php endif; ?> 
	 }

	 .btn-bt.business:hover, .btn-bt.default .overlay{
	 	<?php if(!empty($button_hover_background)): ?>
			<?php if(is_array($button_hover_background)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_hover_background['color'])); ?>
				background: rgba(<?php echo esc_attr($rgb) ?>, <?php echo ((isset($button_hover_background['alpha']))? $button_hover_background['alpha']:1); ?>) ;
			<?php }else{ ?>
				background: <?php echo esc_attr($button_hover_background) ?> ;
			<?php } ?>
		<?php endif; ?> 
	}
	
	 .light .btn-bt.default:hover, .background--dark:not(.creative-single) .btn-bt.default:not(.cart_button):hover, .light .btn-bt.business:hover, .background--dark .btn-bt.business:hover, .light .btn-bt.rounded:hover, .background--dark .btn-bt.rounded:hover, .fullscreen-blog-article .content.background--dark .btn-bt:hover, .light .btn-bt.default:before{
	 	<?php if(!empty($button_light__hover_background)): ?>
			<?php if(is_array($button_light__hover_background)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_light__hover_background['color'])); ?>
				background:  rgba(<?php echo esc_attr($rgb) ?>, <?php echo ((isset($button_light__hover_background['alpha']))? $button_light__hover_background['alpha']:1); ?>) ;
			<?php }else{ ?>
				background: <?php echo esc_attr($button_light__hover_background) ?> ;
			<?php } ?>
		<?php endif; ?> 
	}

	.btn-bt.business, .btn-bt.default{
	 	<?php if(!empty($button_hover_background)): ?>
			<?php if(is_array($button_hover_background)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_hover_background['color'])); ?>
				background:  rgba(<?php echo esc_attr($rgb) ?>, <?php echo ((isset($button_hover_background['alpha']))? $button_hover_background['alpha']:1); ?>) ;
			<?php }else{ ?>
				background: <?php echo esc_attr($button_hover_background) ?> ;
			<?php } ?>
		<?php endif; ?> 
	}
	 .light .btn-bt.default, .background--dark:not(.creative-single) .btn-bt.default:not(.cart_button), .light .btn-bt.business, .background--dark:not(.creative-single) .btn-bt.business,  .light .btn-bt.rounded, .background--dark .btn-bt.rounded{
	 	<?php if(!empty($button_light__hover_background)): ?>
			<?php if(is_array($button_light__hover_background)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_light__hover_background['color'])); ?>
				background: rgba(<?php echo esc_attr($rgb) ?>, <?php echo ((isset($button_light__hover_background['alpha']))? $button_light__hover_background['alpha']:1); ?>) ;
			<?php }else{ ?>
				background: <?php echo esc_attr($button_light__hover_background) ?> ;
			<?php } ?>
		<?php endif; ?> 
	}


	 .btn-bt.<?php echo esc_attr($amos_redata['overall_button_style'][0]) ?>{
	 	<?php if(!empty($button_typography['color'])): ?>
			color: <?php echo esc_attr($button_typography['color']) ?> ;
		<?php endif; ?>
		
		<?php if(!empty($button_background_color) ): ?>
			<?php if(is_array($button_background_color)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_background_color['color'])); ?>
				background: rgba(<?php echo esc_attr($rgb) ?>, <?php echo ((isset($button_background_color['alpha']))? $button_background_color['alpha']:1); ?>) ;
			<?php }else{ ?>
				background: <?php echo esc_attr($button_background_color) ?> ;
			<?php } ?>
		<?php endif; ?>
		
		<?php if($amos_redata['overall_button_style'][0] == 'gradient'): ?>


		<?php  if(is_array($amos_redata['button_gradient_color1'])){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($amos_redata['button_gradient_color1']['color']));
				$gradient_color1 = "rgba(".esc_attr($rgb).", ". ((isset($amos_redata['button_gradient_color1']['alpha']))? $amos_redata['button_gradient_color1']['alpha']:1) .")";
			 }else{ 
				$gradient_color1 = esc_attr($amos_redata['button_gradient_color1'])  ;
			 }

			 if(is_array($amos_redata['button_gradient_color2'])){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($amos_redata['button_gradient_color2']['color']));
				$gradient_color2 = "rgba(".esc_attr($rgb).", ". ((isset($amos_redata['button_gradient_color2']['alpha']))? $amos_redata['button_gradient_color2']['alpha']:1) .")";
			 }else{ 
				$gradient_color2 = esc_attr($amos_redata['button_gradient_color2'])  ;
			 } ?>


			background: linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);

			background: -webkit-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);
		    background: -o-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);
		    background: -moz-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);


		<?php endif; ?>

		<?php if(!empty($button_border_color)): ?>
			<?php if(is_array($button_border_color)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_border_color['color'])); ?>
				border-color: rgba(<?php echo esc_attr( $rgb )?>, <?php echo esc_attr($button_border_color['alpha']) ?>) ;
			<?php }else{ ?>
				border-color: <?php echo esc_attr($button_border_color) ?> ;
			<?php } ?>
		<?php endif; ?>

		<?php if(!empty($button_typography['font-size'])): ?>
			font-size: <?php echo esc_attr($button_typography['font-size']) ?> ;
		<?php endif; ?>

		<?php if(!empty($button_typography['font-weight'])): ?>
			font-weight: <?php echo esc_attr($button_typography['font-weight']) ?> ;
		<?php endif; ?>

		<?php if(!empty($button_typography['text-transform'])): ?>
			text-transform: <?php echo esc_attr($button_typography['text-transform']) ?> ;
		<?php endif; ?>

		<?php if(!empty($button_typography['letter-spacing'])): ?>
			letter-spacing: <?php echo esc_attr($button_typography['letter-spacing']) ?> ;
		<?php endif; ?>
	 }
	 
	 .btn-bt.<?php echo esc_attr($amos_redata['overall_button_style'][0]) ?>:hover{
	 	<?php if(!empty($button_hover_font_color)): ?>
	 		color: <?php echo esc_attr($button_hover_font_color) ?> ;
		<?php endif; ?>

	 	<?php if(!empty($button_hover_background) && ($amos_redata['overall_button_style'][0] != 'business' && $amos_redata['overall_button_style'][0] != 'default')): ?> 
	 		<?php if(is_array($button_hover_background)){ ?>
		 		<?php $rgb = implode(',', amos_hexToRgb($button_hover_background['color'])); ?>
				background: rgba(<?php echo esc_attr($rgb) ?>, <?php echo esc_attr($button_hover_background['alpha']) ?>) ;
			<?php }else{ ?>
				background: <?php echo esc_attr($button_hover_background) ?>;
			<?php } ?>

		<?php endif; ?>

		<?php if($amos_redata['overall_button_style'][0] == 'gradient'): ?>
		
			
			<?php  if(is_array($amos_redata['button_gradient_color1'])){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($amos_redata['button_gradient_color1']['color']));
				$gradient_color1 = "rgba(".esc_attr($rgb).", ". ((isset($amos_redata['button_gradient_color1']['alpha']))? $amos_redata['button_gradient_color1']['alpha']:1) .")";
			 }else{ 
				$gradient_color1 = esc_attr($amos_redata['button_gradient_color1'])  ;
			 }

			 if(is_array($amos_redata['button_gradient_color2'])){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($amos_redata['button_gradient_color2']['color']));
				$gradient_color2 = "rgba(".esc_attr($rgb).", ". ((isset($amos_redata['button_gradient_color2']['alpha']))? $amos_redata['button_gradient_color2']['alpha']:1) .")";
			 }else{ 
				$gradient_color2 = esc_attr($amos_redata['button_gradient_color2'])  ;
			 } ?>


			background: linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);

			background: -webkit-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);
		    background: -o-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);
		    background: -moz-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);

			
		<?php endif; ?>

		<?php if(!empty($button_hover_border)): ?>
			<?php if(is_array($button_hover_border)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_hover_border['color'])); ?>
				border-color: rgba(<?php echo esc_attr($rgb) ?>, <?php echo esc_attr($button_hover_border['alpha']) ?>) ;
			<?php }else{ ?>
				border-color: <?php echo esc_attr($button_hover_border) ?> ;
			<?php } ?>	
		<?php endif; ?>
	 }

	 .light .btn-bt.<?php echo esc_attr($amos_redata['overall_button_style'][0])?>, .fullscreen-blog-article .content.background--dark .btn-bt{
		
		<?php if(!empty($button_light_font_color)): ?>
	 		color: <?php echo esc_attr($button_light_font_color) ?> ;
		<?php endif; ?>

		<?php if(!empty($button_light_background)): ?>
			<?php if(is_array($button_light_background)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_light_background['color'])); ?>
				<?php if(!isset($button_light_background['alpha'])) $button_light_background['alpha'] = 1 ?>
				background: rgba(<?php echo esc_attr($rgb) ?>, <?php echo esc_attr($button_light_background['alpha']) ?>) ;
			<?php }else{ ?>
				background: <?php echo esc_attr($button_light_background) ?> ;
			<?php } ?>
		<?php endif; ?>


		<?php if($amos_redata['overall_button_style'][0] == 'gradient'): ?>
		
			
			<?php  if(is_array($amos_redata['button_light_gradient_color1'])){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($amos_redata['button_light_gradient_color1']['color']));
				$gradient_color1 = "rgba(".esc_attr($rgb).", ". ((isset($amos_redata['button_light_gradient_color1']['alpha']))? $amos_redata['button_light_gradient_color1']['alpha']:1) .")";
			 }else{ 
				$gradient_color1 = esc_attr($amos_redata['button_light_gradient_color1'])  ;
			 }

			 if(is_array($amos_redata['button_light_gradient_color2'])){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($amos_redata['button_light_gradient_color2']['color']));
				$gradient_color2 = "rgba(".esc_attr($rgb).", ". ((isset($amos_redata['button_light_gradient_color2']['alpha']))? $amos_redata['button_light_gradient_color2']['alpha']:1) .")";
			 }else{ 
				$gradient_color2 = esc_attr($amos_redata['button_light_gradient_color2'])  ;
			 } ?>


			background: linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);

			background: -webkit-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);
		    background: -o-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);
		    background: -moz-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);

			
		<?php endif; ?>


		<?php if(!empty($button_light_border)): ?>
			<?php if(is_array($button_light_border)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_light_border['color'])); ?>
				border-color: rgba(<?php echo esc_attr($rgb) ?>, <?php echo esc_attr($button_light_border['alpha']) ?>) ;
			<?php }else{ ?>
				border-color: <?php echo esc_attr($button_light_border) ?> ;
			<?php } ?>
		<?php endif; ?>

	 }

	 .light .btn-bt.<?php echo esc_attr($amos_redata['overall_button_style'][0]) ?>:hover, .fullscreen-blog-article .content.background--dark .btn-bt:hover{
		
		<?php if(!empty($button_light_hover_font_color)): ?>
	 		color: <?php echo esc_attr($button_light_hover_font_color) ?> ;
		<?php endif; ?>

		<?php if(!empty($button_light__hover_background) && ($amos_redata['overall_button_style'][0] != 'business' && $amos_redata['overall_button_style'][0] != 'default')): ?>
			<?php if(is_array($button_light__hover_background)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_light__hover_background['color'])); ?>
				background: rgba(<?php echo esc_attr($rgb) ?>, <?php echo esc_attr($button_light__hover_background['alpha']) ?>) ;
			<?php }else{ ?>
				background: <?php echo esc_attr($button_light__hover_background) ?> ;
			<?php } ?>
		<?php endif; ?>


		<?php if($amos_redata['overall_button_style'][0] == 'gradient'): ?>
		
			
			<?php  if(is_array($amos_redata['button_light_gradient_color1'])){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($amos_redata['button_light_gradient_color1']['color']));
				$gradient_color1 = "rgba(".esc_attr($rgb).", ". ((isset($amos_redata['button_light_gradient_color1']['alpha']))? $amos_redata['button_light_gradient_color1']['alpha']:1) .")";
			 }else{ 
				$gradient_color1 = esc_attr($amos_redata['button_light_gradient_color1'])  ;
			 }

			 if(is_array($amos_redata['button_light_gradient_color2'])){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($amos_redata['button_light_gradient_color2']['color']));
				$gradient_color2 = "rgba(".esc_attr($rgb).", ". ((isset($amos_redata['button_light_gradient_color2']['alpha']))? $amos_redata['button_light_gradient_color2']['alpha']:1) .")";
			 }else{ 
				$gradient_color2 = esc_attr($amos_redata['button_light_gradient_color2'])  ;
			 } ?>


			background: linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);

			background: -webkit-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);
		    background: -o-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);
		    background: -moz-linear-gradient(45deg, <?php echo esc_attr($gradient_color1); ?> 0%, <?php echo esc_attr($gradient_color2); ?> 100%);

			
		<?php endif; ?>

		<?php if(!empty($button_light_hover_border)): ?>
			<?php if(is_array($button_light_hover_border)){ ?>
				<?php $rgb = implode(',', amos_hexToRgb($button_light_hover_border['color'])); ?>
				border-color: rgba(<?php echo esc_attr($rgb) ?>, <?php echo esc_attr($button_light_hover_border['alpha']) ?>) ;
			<?php }else{ ?>
				border-color: <?php echo esc_attr($button_light_hover_border) ?> ;
			<?php } ?>
		<?php endif; ?>

	 }


	 <?php if(isset($fullscreen_blog_box_bg) && (float) $fullscreen_blog_box_bg['alpha'] > 0): ?>
	 	.fullscreen-blog-article .content{padding:4%;}
	 <?php endif; ?>


	 <?php if($amos_redata['menu_presets'] == 'h8' || $amos_redata['menu_presets'] == 'h9'): ?>
		.h8.header_wrapper, .h9.header_wrapper{
			width: <?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?>;
			<?php if($amos_redata['h_vertical_position'] == 'left'): ?>
			left:0;
			<?php else: ?>
			right:0;
			<?php endif; ?>
			padding-left:<?php echo esc_attr($amos_redata['h_vertical_padding']['padding-left']); ?>;
			padding-right:<?php echo esc_attr($amos_redata['h_vertical_padding']['padding-right']); ?>;
			padding-top:<?php echo esc_attr($amos_redata['h_vertical_padding']['padding-top']); ?>;
			padding-bottom:<?php echo esc_attr($amos_redata['h_vertical_padding']['padding-bottom']); ?>;
			box-sizing: border-box;
		}

		.h9.header_wrapper.hidden_header .vertical_header_background{
			width: <?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?>;

		}
		.h8 .header_widgetized, .h9 .header_widgetized{
			width: calc(<?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?> - 40px);
		}
		.h9.hidden_header.pos--<?php echo esc_attr($amos_redata['h_vertical_position']) ?>, .h9.hidden_header.pos--<?php echo esc_attr($amos_redata['h_vertical_position']) ?> .vertical_header_background{
			<?php echo esc_attr($amos_redata['h_vertical_position']) ?>: calc(70px - <?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?>);
		}
		

		.h8 .viewport, .h9 .viewport{padding-<?php echo esc_attr($amos_redata['h_vertical_position']) ?>:<?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?> ;}

		.h9.hidden_header .viewport{padding-<?php echo esc_attr($amos_redata['h_vertical_position']) ?>:70px ;}


		.h8.header_wrapper #navigation, .h8 .header_widgetized, .h9.header_wrapper #navigation, .h9 .header_widgetized{margin-top:<?php echo esc_attr($amos_redata['h_vertical_margin']['margin-top']) ?>;}
		.h8 #navigation.pos_left nav .menu > li > ul.sub-menu, .h8 #navigation.pos_left nav .menu > li > ul.sub-menu ul, .h8 #navigation.pos_left nav .amos_custom_menu_mega_menu, .h9 #navigation.pos_left nav .menu > li > ul.sub-menu, .h9 #navigation.pos_left nav .menu > li > ul.sub-menu ul, .h9 #navigation.pos_left nav .amos_custom_menu_mega_menu {
  			left:<?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?>;
  			margin-left:-<?php echo esc_attr($amos_redata['h_vertical_padding']['padding-right']); ?> !important;
		}

		.h8 #navigation.pos_right nav .menu > li > ul.sub-menu,.h8 #navigation.pos_right nav .menu > li > ul.sub-menu ul, .h8 #navigation.pos_right nav .amos_custom_menu_mega_menu, .h9 #navigation.pos_right nav .menu > li > ul.sub-menu, .h9 #navigation.pos_right nav .menu > li > ul.sub-menu ul, .h9 #navigation.pos_right nav .amos_custom_menu_mega_menu   {
  			right:<?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?>;
  			margin-right:-<?php echo esc_attr($amos_redata['h_vertical_padding']['padding-right']); ?> !important;
		}
		.h8 #navigation.pos_left nav .menu > li, .h9 #navigation.pos_left nav .menu > li{
			padding-left:0;
			padding-right: <?php echo esc_attr($amos_redata['h_vertical_padding']['padding-right']); ?>;
		}
		.h8 #navigation.pos_right nav .menu > li{
		
		}
		.h8 .nav-growpop a.prev, .h9 .nav-growpop a.prev{left:<?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?>;}
	 	
	 	<?php if($amos_redata['h_vertical_position'] == 'left'): ?>
		.h8 .nav-growpop a.prev, .h9 .nav-growpop a.prev{left:<?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?>;}
		<?php endif; ?>

		<?php if($amos_redata['h_vertical_position'] == 'right'): ?>
		.h8 .nav-growpop a.next, .h9 .nav-growpop a.next{right:<?php echo esc_attr($amos_redata['h_vertical_width']['width']); ?>;}
		<?php endif; ?>
	 <?php endif; ?>

	@media (max-width: 979px) {
		 .header_5 .background--dark nav .menu > li > a{
		 	color: <?php echo esc_attr($menu_font_style['color']) ?> !important;
		 }
	}

	<?php if($header_style == 'header_6'): ?>
		.header_6 nav .menu > li{
			border-bottom:3px solid <?php echo esc_attr($header_navigation['color']) ?>;
		}
		.header_6 nav .menu > li.current-menu-item{border-bottom:3px solid <?php echo esc_attr($primary_color) ?>;}
		.header_6 nav .menu > li:hover{border-bottom:3px solid <?php echo esc_attr($primary_color) ?>;}
		.header_6 nav .menu > li:last-child{
  			padding-right:<?php echo esc_attr($menu_padding['padding-right']) ?>;
		}
		.header_6 nav .menu > li:first-child{
		  	padding-left:<?php echo esc_attr($menu_padding['padding-left']) ?>;
		}
	<?php endif; ?>


	/* Layout Inner Container */

	<?php if(!empty($page_container_width_percent['width'])): ?>
	@media (min-width: 981px) and (max-width: 1100px) {
		.container{	width:<?php echo esc_attr($page_container_width_percent['width']) ?> !important ; }
	}
	@media (min-width: 768px){
		.container{			
			max-width: <?php echo esc_attr($page_container_width['width']) ?> !important;
		}
		.row .span12{
			width:100%; 
			margin-left:0 !important;
			padding-left:20px;
			box-sizing: border-box;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
		}
	}

	
	<?php endif; ?>

	@media (min-width: 1101px) {
		.container{
			<?php if(!empty($page_container_width_percent['width'])): ?>
				width:<?php echo esc_attr($page_container_width_percent['width']) ?>;
				max-width: <?php echo esc_attr($page_container_width['width']) ?> !important;
			<?php else: ?>
				width:<?php echo esc_attr($page_container_width['width']) ?>;
			<?php endif; ?>
		}

		.row .span12{
			
			<?php if(!empty($page_container_width_percent['width'])): ?>
				width:100%;
				margin-left:0 !important;
				padding-left:20px;
				box-sizing: border-box;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
			<?php else: ?> 
				width:<?php echo esc_attr($page_container_width['width']) ?>;
			<?php endif; ?>
		}
		.testimonial_carousel .item{width:<?php echo esc_attr($page_container_width['width']) ?>;}
	}

	/* End Layout Inner Container */


	/* Layout Boxed */
	.boxed_layout{
		margin-top:<?php echo esc_attr( $boxed_container_margin['margin-top']) ?> !important;
		margin-bottom:<?php echo esc_attr($boxed_container_margin['margin-bottom']) ?> !important;
		<?php if($amos_redata['boxed_shadow'] || !isset($amos_redata['boxed_shadow'] )): ?>
		  -webkit-box-shadow:0 5px 19px 2px rgba(0,0,0,0.1);
		  -moz-box-shadow:0 5px 19px 2px rgba(0,0,0,0.1);
		  box-shadow:0 5px 19px 2px rgba(0,0,0,0.1);
		<?php endif; ?>
	}
	<?php if(!empty($boxed_container_width_percent['width'])): ?>
	
	
	.boxed_layout{			
		width:<?php echo esc_attr($boxed_container_width_percent['width']) ?> !important ;
		max-width: <?php echo esc_attr($boxed_container_width['width']) ?> !important;
	}
	

	<?php endif; ?>
	
	<?php if(empty($boxed_container_width_percent['width'])): ?>

	@media (min-width: 1101px) {
		.container{ width:<?php echo esc_attr($boxed_container_width['width']) ?>; }
	}

	<?php endif; ?>

	/* End Layout Boxed */



<?php if(isset($amos_redata['custom_css'])) echo wp_kses($amos_redata['custom_css'], ''); ?>
</style>
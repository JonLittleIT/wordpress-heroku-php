<?php
		/******************************
             --   PAGE FONT  --
        *****************************/
?>




<?php if( !empty($farvis_font) || !empty($farvis_font_weight) ) : ?>
html body, html p  {
	<?php if( !empty($farvis_font) ) : ?>font-family: '<?php echo esc_attr($farvis_font)?>' ; <?php endif; ?>
    <?php if( !empty($farvis_font) ) : ?>font-weight: <?php echo esc_attr($farvis_font_weight)?> ; <?php endif; ?>
}

html .esg-grid *{
	<?php if( !empty($farvis_font) ) : ?>font-family: '<?php echo esc_attr($farvis_font)?>' ; <?php endif; ?>
    <?php if( !empty($farvis_font) ) : ?>font-weight: <?php echo esc_attr($farvis_font_weight)?>; <?php endif; ?>
}



.kaswara-theme-font  .kswr-ibi-content ,
.kaswara-theme-font   .kswr-iibl-content ,
.kaswara-theme-font   .kswr-heading-container , 
.kaswara-theme-font  .kswr-heading-container div {
    <?php if( !empty($farvis_font) ) : ?>font-family: '<?php echo esc_attr($farvis_font)?>'  <?php endif; ?>
   

}


.kaswara-theme-font   .kswr-ibi-container ,
.kaswara-theme-font  .kswr-iibl-bottom ,
.kaswara-theme-font   .kswr-heading-container ,
.kaswara-theme-font .kswr-heading-container div {
   <?php if( !empty($farvis_font) ) : ?>font-weight: <?php echo esc_attr($farvis_font_weight)?> ; <?php endif; ?>
}


.tmpl-theme-font , .tmpl-theme-font *{
	<?php if( !empty($farvis_font) ) : ?>font-family: '<?php echo esc_attr($farvis_font)?>' !important; <?php endif; ?>
    <?php if( !empty($farvis_font) ) : ?>font-weight: <?php echo esc_attr($farvis_font_weight)?> !important;  <?php endif; ?>
}


.booked-no-prev span , .booked-no-prev strong , .booked-appt-list  span ,  .booked-appt-list strong{
    <?php if( !empty($farvis_font) ) : ?>font-family: '<?php echo esc_attr($farvis_font)?>' !important; <?php endif; ?>
    <?php if( !empty($farvis_font) ) : ?>font-weight: <?php echo esc_attr($farvis_font_weight)?> !important;  <?php endif; ?>
}



<?php endif; ?>



<?php
		/******************************
             --   TITLE FONT   --
        *****************************/
?>
<?php if( !empty($farvis_title) || !empty($farvis_title_weight) ) : ?>



.title_font_family  ,
html .spl-title h2   ,
.farvis-column-info h3 ,
html .btn-style-1  * ,
html .btn-style-1 span ,
.quote-form input[type=submit] ,
.section-title ,
.person-description h5 ,
.our-services  h4 ,
.pix-lastnews-light .news-item  h3 a  ,
.pix-lastnews-light .one-news div *,
.pix-lastnews-light .news-item h3 a ,
.testimonial-author h4 ,
.team .user-info h4 ,
.stats > div > div,
footer h2,
footer h3,
footer h4,
footer h5,
footer h6 ,
.title,
.feature-item h5 ,
.blog-description h4 ,
.blog-description h4 a ,
.work-heading  h3 ,
.work-body  h5 ,
.services h4 ,
.ui-title-page.pull-left h1, .ui-title-page.pull-left .subtitle ,
.work-body h3 ,
.reply-title ,
.form-cart-table > thead > tr > th ,
.form-cart__price-total,
.form-cart__title  ,
.form-cart__shipping-name ,
.woocommerce #reviews #comments h2 ,
.woocommerce .rtd div.product .product_title , .b-info-columns-holder.b-steps-list .b-info-column .info-column-title , .member-caption .member-name , .panel-heading , .service-heading , .b-video .video-caption , .folio-isotop-filter ul > li a , .media-heading-review , .wrap-works .post .post-body h5 , .application .app-features h5 , .nav.nav-tabs.theme-tab li a , .b-info-column .info-column-title , .discount-options , .box-form-7 h3 , .block_content h3 , aside .widget-title , .wpt_widget_content .tab_title a , .wpt_comment_post , html .post-body > h4 a , .comment-list cite a , .comment-list cite
{
	<?php if( !empty($farvis_title) ) : ?>font-family: '<?php echo esc_attr($farvis_title)?>' ; <?php endif; ?>
    <?php if( !empty($farvis_title_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_title_weight)?> ; <?php endif; ?>
}


 .kswr-fancytext-container , .kswr-trcflp-front-title ,
.km-teammate-container[data-style=style2] .km-teammate-name
{
	<?php if( !empty($farvis_title) ) : ?>font-family: '<?php echo esc_attr($farvis_title)?>' ; <?php endif; ?>
    <?php if( !empty($farvis_title_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_title_weight)?> ; <?php endif; ?>
}




.tmpl-title-font , .tmpl-title-font *{

    <?php if( !empty($farvis_title) ) : ?>font-family: '<?php echo esc_attr($farvis_title)?>' !important; <?php endif; ?>
    <?php if( !empty($farvis_title_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_title_weight)?> !important; <?php endif; ?>
}



html .kaswara-theme-font   .kswr-heading-title , 
.kaswara-theme-font  .kswr-ibi-title ,
.read-more,
.kaswara-theme-font  .swr-iibl-title,
.kaswara-theme-font  .kswr-iibl-title ,
.kaswara-theme-font .kswr-heading-content , 
.plan-item .item-body .price-count span ,
.kaswara-theme-font  .kswr-animatedheading-titletext{
	<?php if( !empty($farvis_title) ) : ?>font-family: '<?php echo esc_attr($farvis_title)?>' ; <?php endif; ?>
}




.kaswara-theme-font   .kswr-ibi-title-ct,
.read-more ,
.kaswara-theme-font  .kswr-iibl-title-ct,
.kaswara-theme-font .kswr-iibl-title-ct,
.plan-item .item-body .price-count span ,
.kaswara-theme-font  .kswr-animatedheading-titletext{

   <?php if( !empty($farvis_title_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_title_weight)?> ; <?php endif; ?>

}



b,
strong {
    <?php if( !empty($farvis_title_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_title_weight)?> ; <?php endif; ?>
}



<?php endif; ?>



<?php
		/******************************
             --   SUBTITLE FONT   --
        *****************************/
?>
<?php if( !empty($farvis_subtitle) || !empty($farvis_subtitle_weight) ) : ?>

.section-subtitle ,
html .nav-tabs-vertical>li>a ,
.person-description .under-name ,
.testimonial-author small ,
.team .user-info small ,
.portfolio-single-section .work-heading .category a, .portfolio-single-section .work-heading .category ,html body  p.subhead  , .member-caption .member-position , .media-heading-review + p , .wrap-timeline .time-item .date , .blog-item-content .blog-item-caption .item-name, .blog-item-content .blog-item-caption .item-name a , .b-about-tabs .tabs-controls .tabs-name , .wpt_widget_content .entry-title ,  footer .widgettitle , .post-header .post-info a, .post-header .post-info  , .rtd .woocommerce-tabs h2 , .rtd .related h2, .upsells h2 , .product-name , .product-name a
{
	<?php if( !empty($farvis_subtitle) ) : ?>font-family: '<?php echo esc_attr($farvis_subtitle)?>' !important; <?php endif; ?>
    <?php if( !empty($farvis_subtitle_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_subtitle_weight)?> !important; <?php endif; ?>
}

.yamm  li  a , html [data-off-canvas] , .smart-tabs ul li.active a , .syp-itemgrid-title a{
    <?php if( !empty($farvis_subtitle) ) : ?>font-family: '<?php echo esc_attr($farvis_subtitle)?>' !important; <?php endif; ?>
    <?php if( !empty($farvis_subtitle_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_subtitle_weight)?> !important; <?php endif; ?>
}

html body .h1,html body  .h2, html body  .h3,  html body .h4, html body  .h5, html body  .h6, html body  h1,html body  h2,html body  h3, html body  h4, html body  h5, html body  h6  {
    <?php if( !empty($farvis_subtitle) ) : ?>font-family: '<?php echo esc_attr($farvis_subtitle)?>' ; <?php endif; ?>
    <?php if( !empty($farvis_subtitle_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_subtitle_weight)?> ; <?php endif; ?>
}

.km-hover-image-title , .km-testimonial-name{
	<?php if( !empty($farvis_subtitle) ) : ?>font-family: '<?php echo esc_attr($farvis_subtitle)?>' !important; <?php endif; ?>
    <?php if( !empty($farvis_subtitle_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_subtitle_weight)?> !important; <?php endif; ?>
}

.b-info-columns-holder.b-steps-list .b-info-column .info-column-title{
     <?php if( !empty($farvis_subtitle) ) : ?>font-family: '<?php echo esc_attr($farvis_subtitle)?>' !important; <?php endif; ?>
    <?php if( !empty($farvis_subtitle_weight) ) : ?>font-weight: <?php echo esc_attr($farvis_subtitle_weight)?> !important; <?php endif; ?>
}

<?php endif; ?>
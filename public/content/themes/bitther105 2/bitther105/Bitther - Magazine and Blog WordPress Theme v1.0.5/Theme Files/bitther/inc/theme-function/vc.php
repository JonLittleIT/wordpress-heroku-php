<?php
/**
 * @package     bitther
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

if (class_exists('WPBakeryVisualComposerAbstract')) {

    function bitther_vc_templates( $default_templates ) {
        // New templates
        $new_templates = array(
            'templates-home-1' => array(
                'name' 			=> esc_html__( 'Templates Home 1', 'bitther' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home1.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row full_width="stretch_row_content" css=".vc_custom_1529559600872{margin-top: -30px !important;margin-bottom: 50px !important;}" el_class="home1_slide"][vc_column][top_blog layout_types="column4" type_post="yes" number_post="6" category_name=""][/vc_column][/vc_row][vc_row css=".vc_custom_1529556757275{margin-bottom: 50px !important;}" el_class="page_ads"][vc_column][vc_single_image image="1353" img_size="full" alignment="center"][/vc_column][/vc_row][vc_row][vc_column width="3/4" css=".vc_custom_1529293810209{padding-right: 50px !important;}"][box_video layout_types="large" auto_play="" title="latest videos" category_name="" el_class="mb-70"][box_category layout_types="box1" columns="3" type_post="views" number_post="6" filter="yes" meta="yes" title="trending news" category_name="" el_class="mb-30"][blog-recent-posts style="slide" show_cat="yes" title="EDITORS PICK"][blog show_post_format="" pagination="pagination" title="Latest News" category_name=""][/vc_column][vc_column width="1/4" css=".vc_custom_1529312807032{margin-top: 5px !important;padding-right: 15px !important;padding-left: 0px !important;}" el_class="sidebar"][vc_widget_sidebar sidebar_id="archive"][/vc_column][/vc_row]'
            ),
            'templates-home-2' => array(
                'name' 			=> esc_html__( 'Templates Home 2', 'bitther' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home2.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row css=".vc_custom_1529907401863{margin-top: -25px !important;margin-bottom: 35px !important;}"][vc_column][top_blog layout_types="column-center" type_post="yes" number_post="10" category_name=""][/vc_column][/vc_row][vc_row][vc_column width="3/4" css=".vc_custom_1529901894922{padding-right: 50px !important;}"][box_video layout_types="large" auto_play="" title="latest videos" category_name="" el_class="mb-70"][box_category layout_types="box1" columns="3" type_post="views" number_post="6" filter="yes" meta="" title="trending news" category_name="" el_class="mb-30"][blog-recent-posts style="slide" show_cat="yes" title="EDITORS PICKS" number="4"][blog number="6" pagination="pagination" title="Latest News" category_name=""][/vc_column][vc_column width="1/4" css=".vc_custom_1529901883792{padding-right: 15px !important;padding-left: 0px !important;}" el_class="sidebar"][vc_widget_sidebar sidebar_id="archive"][/vc_column][/vc_row]'
            ),
            'templates-home-3' => array(
                'name' 			=> esc_html__( 'Templates Home 3', 'bitther' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home3.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row css=".vc_custom_1529569082851{margin-top: -15px !important;margin-bottom: 50px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][top_blog layout_types="column3" type_post="yes" number_post="6" category_name=""][/vc_column][/vc_row][vc_row css=".vc_custom_1523892410511{padding-right: 0px !important;padding-bottom: 90px !important;padding-left: 0px !important;}"][vc_column width="1/4" el_class="sidebar" css=".vc_custom_1529908440601{padding-right: 0px !important;padding-left: 15px !important;}"][vc_widget_sidebar sidebar_id="blogs"][/vc_column][vc_column width="3/4" css=".vc_custom_1529908447536{padding-left: 50px !important;}"][blog post_layout="grid" columns="2" number="4" view_more="" share_button="" show_btn_cat="" show_pagination="" filter="" category_name="" title="BITCOIN NEWS" el_class="mb-10"][vc_column_text]
[ccpw id="1851"][/vc_column_text][box_category layout_types="box1" columns="3" type_post="views" number_post="6" filter="yes" meta="" title="trending news" category_name="" el_class="mb-30"][blog-recent-posts style="slide" show_cat="yes" title="editor’s picks"][blog number="6" pagination="pagination" title="Latest News" category_name=""][/vc_column][/vc_row]'
            ),
            'templates-home-4' => array(
                'name' 			=> esc_html__( 'Templates Home 4', 'bitther' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home4.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row css=".vc_custom_1530027419912{margin-top: -20px !important;}"][vc_column css=".vc_custom_1530027467040{padding-right: 50px !important;}" offset="vc_col-lg-9 vc_col-md-9 vc_col-xs-12"][vc_row_inner][vc_column_inner css=".vc_custom_1530027504462{margin-bottom: 50px !important;}"][top_blog type_post="yes" number_post="5" category_name=""][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1525279349676{padding-bottom: 15px !important;}"][vc_column_inner][box_category layout_types="box10" type_post="news" number_post="4" filter="" meta="" category_name="" title="Bitcoin News"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1530027769191{padding-bottom: 40px !important;}"][vc_column_inner][vc_column_text][ccpw id="1851"][/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner][blog-recent-posts style="slide" show_cat="yes" title="editor’s picks"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1525279882997{padding-bottom: 75px !important;}"][vc_column_inner][blog number="6" pagination="pagination" category_name="" title="Latest News"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column css=".vc_custom_1530027274198{padding-right: 15px !important;padding-left: 0px !important;}" offset="vc_col-lg-3 vc_col-md-3 vc_col-xs-12" el_class="sidebar"][vc_widget_sidebar sidebar_id="blogs"][/vc_column][/vc_row]'
            ),

            'templates-contact-us' => array(
                'name' 			=> esc_html__( 'Templates Contact Us', 'bitther' ),
                'weight' 		=> 0,
                'custom_class'	=> '',
                'content' 		=> '[vc_row css=".vc_custom_1501780296562{margin-top: 0px !important;}"][vc_column][vc_gmaps link="#E-8_JTNDaWZyYW1lJTIwc3JjJTNEJTIyaHR0cHMlM0ElMkYlMkZ3d3cuZ29vZ2xlLmNvbSUyRm1hcHMlMkZlbWJlZCUzRnBiJTNEJTIxMW0xOCUyMTFtMTIlMjExbTMlMjExZDYzMDQuODI5OTg2MTMxMjcxJTIxMmQtMTIyLjQ3NDY5NjgwMzMwOTIlMjEzZDM3LjgwMzc0NzUyMTYwNDQzJTIxMm0zJTIxMWYwJTIxMmYwJTIxM2YwJTIxM20yJTIxMWkxMDI0JTIxMmk3NjglMjE0ZjEzLjElMjEzbTMlMjExbTIlMjExczB4ODA4NTg2ZTYzMDI2MTVhMSUyNTNBMHg4NmJkMTMwMjUxNzU3YzAwJTIxMnNTdG9yZXklMkJBdmUlMjUyQyUyQlNhbiUyQkZyYW5jaXNjbyUyNTJDJTJCQ0ElMkI5NDEyOSUyMTVlMCUyMTNtMiUyMTFzZW4lMjEyc3VzJTIxNHYxNDM1ODI2NDMyMDUxJTIyJTIwd2lkdGglM0QlMjI2MDAlMjIlMjBoZWlnaHQlM0QlMjI2MDAlMjIlMjBmcmFtZWJvcmRlciUzRCUyMjAlMjIlMjBzdHlsZSUzRCUyMmJvcmRlciUzQTAlMjIlMjBhbGxvd2Z1bGxzY3JlZW4lM0UlM0MlMkZpZnJhbWUlM0U="][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_custom_heading text="Get in touch with us " font_container="tag:h2|font_size:34|text_align:left|color:%23000000" google_fonts="font_family:Oswald%3A300%2Cregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal" css=".vc_custom_1510587009279{margin-bottom: 30px !important;}"][contact-form-7 id="76" title="Get in touch with us "][/vc_column][vc_column width="1/2" css=".vc_custom_1498717766379{margin-left: 0px !important;padding-left: 30px !important;}"][vc_custom_heading text="Contact Details" font_container="tag:h2|font_size:34|text_align:left|color:%23000000" google_fonts="font_family:Oswald%3A300%2Cregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal" css=".vc_custom_1510587272317{margin-bottom: 50px !important;}"][vc_column_text]<i class="fa fa-map-marker"></i> 198 West 21th Street, Suite 721 New York, NY 10010

<i class="fa fa-phone"></i> Phone: +95 (0) 123 456 789

<i class="fa fa-envelope-o"></i> <a href="mailto:nanoagency@gmail.com">nanoagency.co@gmail.com</a>
[/vc_column_text][vc_single_image image="248" img_size="full"][/vc_column][/vc_row]',
            ),

        );


        foreach ( array_reverse( $new_templates ) as $template ) {
            array_unshift( $default_templates, $template );
        }

        return $default_templates;
    }
    add_filter( 'vc_load_default_templates', 'bitther_vc_templates' );

}

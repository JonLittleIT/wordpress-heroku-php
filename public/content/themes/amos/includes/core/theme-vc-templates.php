<?php

add_filter( 'vc_load_default_templates', 'default_templates' ); // Hook in
function default_templates( $data ) {
    return array(); // This will remove all default templates. Basically you should use native PHP functions to modify existing array and then return it.
}

function amos_add_default_templates() {

	$templates = visual_templates();
	  if ( defined( 'WPB_VC_VERSION' ) ) 
		return array_map( 'vc_add_default_templates', $templates );
	
}
amos_add_default_templates();

function visual_templates(){
	
	$uri = get_template_directory_uri() . '/ellethemes/img/visual_templates/';
	$templates = array();
	
	//Blog Category
	//Default Blog vc-template
	$data = array();
	$data['name'] = esc_html__( 'Full Blog', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/blog/full_blog.png' );
	$data['sort_name'] = 'Blog';
	$data['custom_class'] = 'general blog';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f5f5f5" top_padding="80" bottom_padding="80"][vc_column][block_title title="Our Latest Blog Posts" upper_title="We work to make it real!"][/block_title][vc_empty_space height="42px"][recent_news posts_per_page="3" shadow="yes"][vc_empty_space height="42px"][vc_column_text]
<h6 style="text-align:center;"><a href="#">SEE ALL THE POSTS</a></h6>
[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Default Blog vc-template
	$data = array();
	$data['name'] = esc_html__( 'Recent News', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/blog/recent_news.png' );
	$data['sort_name'] = 'Blog';
	$data['custom_class'] = 'general blog';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f9f9f9"][vc_column width="1/2"][block_title style="column_title" title="Recent News"]
[/block_title][recent_news posts_per_page="3" style="vertical"][/vc_column][vc_column width="1/2"][block_title style="column_title" title="Recent News"]
[/block_title][recent_news posts_per_page="5" style="events"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

    //Default Blog vc-template
	$data = array();
	$data['name'] = esc_html__( 'Recent news with Background', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/blog/recent_news_with_background.png' );
	$data['sort_name'] = 'Blog';
	$data['custom_class'] = 'general blog';
	$data['content'] = <<<CONTENT
[vc_row full_height="yes" type="full_width_background" bg_image="1709" parallax_bg="true" overlay="true" overlay_color="rgba(40,40,40,0.75)" text_color="light" top_padding="90" bottom_padding="90" link_bool="" link_value="#"][vc_column][block_title inner_style_title="only_text" padding_desc="20%" title="Recent News"]Recent news with Inline Horizontal Style. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer a varius nunc. Sed id tempor velit[/block_title][recent_news posts_per_page="4"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	 //Default Blog vc-template
	$data = array();
	$data['name'] = esc_html__( 'Latest from Blog', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/blog/latest_from_blog.png' );
	$data['sort_name'] = 'Blog';
	$data['custom_class'] = 'general blog';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="150" bottom_padding="150"][vc_column][block_title inner_style_title="only_text" title="Latest Stories"]Creative portfolio ready made templates are ready on one-click.[/block_title][vc_zigzag color="custom" el_width="10" el_border_width="10" custom_color="#1873ff"][vc_empty_space height="45px"][latest_blog dynamic_from_where="cat" dynamic_cat="214"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	/*Portfolio styles*/
    //Grid Portfolio vc-template
	$data = array();
	$data['name'] = esc_html__( 'Grid Portfolio', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/portfolio/grid_portfolio.png' );
	$data['sort_name'] = 'Portfolio';
	$data['custom_class'] = 'general portfolio';
	$data['content'] = <<<CONTENT
[vc_row][vc_column][recent_portfolio style="basic" columns="4" rows="4" carousel="no"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

   //Masonry Portfolio vc-template
	$data = array();
	$data['name'] = esc_html__( 'Masonry Portfolio', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/portfolio/masonry_portfolio.png' );
	$data['sort_name'] = 'Portfolio';
	$data['custom_class'] = 'general portfolio';
	$data['content'] = <<<CONTENT
[vc_row][vc_column][recent_portfolio mode="masonry" columns="4" rows="4" carousel="no"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Pinterest Portfolio vc-template
	$data = array();
	$data['name'] = esc_html__( 'Pinterest Portfolio', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/portfolio/pinterest_portfolio.png' );
	$data['sort_name'] = 'Portfolio';
	$data['custom_class'] = 'general portfolio';
	$data['content'] = <<<CONTENT
[vc_row][vc_column][recent_portfolio mode="pinterest" columns="4" rows="4" carousel="no"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;


	//Recent Portfolio vc-template
	$data = array();
	$data['name'] = esc_html__( 'Recent Portfolio', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/portfolio/recent_portfolio.png' );
	$data['sort_name'] = 'Portfolio';
	$data['custom_class'] = 'general portfolio';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="150" bottom_padding="150"][vc_column][block_title inner_style_title="only_text" title="Latest Stories"]Creative portfolio ready made templates are ready on one-click.[/block_title][vc_zigzag color="custom" el_width="10" el_border_width="10" custom_color="#1873ff"][vc_empty_space height="45px"][latest_blog dynamic_from_where="cat" dynamic_cat="214"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

    // Home 2 Portfolio section vc-template
    $data = array();
	$data['name'] = esc_html__( 'Fullwidth Portfolio ', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/portfolio/fullwidth_portfolio.png' );
	$data['sort_name'] = 'Portfolio';
	$data['custom_class'] = 'general portfolio';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_content"][vc_column][recent_portfolio mode="masonry" space="no_space" columns="4" rows="5" carousel="no"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;


	//Clients Elements
    //Default clients  vc-template
	$data = array();
	$data['name'] = esc_html__( 'Clients', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/clients/clients.png' );
	$data['sort_name'] = 'Clients';
	$data['custom_class'] = 'general client';
	$data['content'] = <<<CONTENT
	[vc_row type="full_width_background" bg_color="#f7f7f7" top_padding="0" bottom_padding="0"][vc_column][clients][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Corporate clients 2 vc-template
	$data = array();
	$data['name'] = esc_html__( 'Clients with Background Color', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/clients/clients_background.png' );
	$data['sort_name'] = 'Clients';
	$data['custom_class'] = 'general client';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#5198ff" bg_color_2="#7d6cc9" text_color="light" top_padding="50" bottom_padding="50"][vc_column][clients dark_light="light"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Default clients  vc-template
	$data = array();
	$data['name'] = esc_html__( 'Clients Dark', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/clients/clients_dark.png' );
	$data['sort_name'] = 'Clients';
	$data['custom_class'] = 'general client';
	$data['content'] = <<<CONTENT
	[vc_row type="full_width_background" bg_image="6692" parallax_bg="true" overlay="true" overlay_color="rgba(0,0,0,0.87)" text_color="light" top_padding="50" bottom_padding="50"][vc_column][clients dark_light="light"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Default clients  vc-template
	$data = array();
	$data['name'] = esc_html__( 'Clients and Text', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/clients/text_and_clients.png' );
	$data['sort_name'] = 'Clients';
	$data['custom_class'] = 'general client';
	$data['content'] = <<<CONTENT
	[vc_row][vc_column width="1/2"][vc_empty_space height="50px"][block_title style="column_title" title="2 variations of Clients"][/block_title][vc_custom_heading text="There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form." font_container="tag:div|font_size:16px|text_align:left|line_height:24px" google_fonts="font_family:Hind%3A300%2Cregular%2C500%2C600%2C700|font_style:400%20regular%3A400%3Anormal"][vc_empty_space height="25px"][button title="Learn More"][/vc_column][vc_column width="1/2" centered_cont="true" centered_cont_vertical="true"][clients carousel="no"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;



	//Counters Category
	//Agency Counter vc-template
	$data = array();
	$data['name'] = esc_html__( 'Counter', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/counter/full_section_counters.png' );
	$data['sort_name'] = 'Counters';
	$data['custom_class'] = 'general counters';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="70" bottom_padding="0" link_bool="" link_value="#"][vc_column][block_title inner_style_title="only_text" padding_desc="20%" title="The best way to show numbers" description="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."]Customizable animated counters element can be used in any part of website where you want to show some infographics data.[/block_title][/vc_column][/vc_row][vc_row][vc_column width="1/4"][counter text="Coffes" icon="linea-basic-clubs" number="654"][/vc_column][vc_column width="1/4"][counter text="Lines of Code" icon="linea-basic-todolist-pencil" number="1000"][/vc_column][vc_column width="1/4"][counter text="Hours" icon="linea-basic-alarm" number="356"][/vc_column][vc_column width="1/4"][counter text="Tweets" icon="icon-twitter" number="1500"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Agency Counter vc-template
	$data = array();
	$data['name'] = esc_html__( 'Counter with Background', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/counter/counters_with_background.png' );
	$data['sort_name'] = 'Counters';
	$data['custom_class'] = 'general counters';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_image="6810" parallax_bg="true" overlay="true" overlay_color="rgba(10,10,10,0.6)" text_color="light" top_padding="90" bottom_padding="90" link_bool="" link_value="#"][vc_column width="1/4"][counter text="Hours" icon="linea-basic-alarm" number="356"][/vc_column][vc_column width="1/4"][counter text="Coding Hours" icon="linea-basic-sheet-pen" number="3500"][/vc_column][vc_column width="1/4"][counter text="Emails" icon="linea-basic-mail" number="2000"][/vc_column][vc_column width="1/4"][counter text="Html Lines" icon="linea-basic-world" number="2500"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Agency Countdown vc-template
	$data = array();
	$data['name'] = esc_html__( 'Countdown', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/counter/countdown.png' );
	$data['sort_name'] = 'Counters';
	$data['custom_class'] = 'general counters';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_image="6643" parallax_bg="true" overlay="true" overlay_color="rgba(0,0,0,0.7)" text_color="light" top_padding="200" bottom_padding="200"][vc_column background_color_opacity=""][vc_custom_heading text="COMING" font_container="tag:h2|font_size:118px|text_align:center|line_height:120px" google_fonts="font_family:Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:900%20bold%20regular%3A900%3Anormal" el_class="custom_coming"][vc_custom_heading text="SOON" font_container="tag:h2|font_size:170px|text_align:center|line_height:130px" google_fonts="font_family:Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:900%20bold%20regular%3A900%3Anormal" el_class="custom_soon"][vc_empty_space][vc_custom_heading text="We Are Creating A Pretty New Website." font_container="tag:h2|font_size:18px|text_align:center|color:%23eeeeee|line_height:60px" google_fonts="font_family:Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:400%20regular%3A400%3Anormal"][vc_row_inner][vc_column_inner width="1/4"][/vc_column_inner][vc_column_inner width="1/2" font_color="#ffffff"][countdown month="9" year="2018" day="5"][/vc_column_inner][vc_column_inner width="1/4"][/vc_column_inner][/vc_row_inner][vc_empty_space height="45px"][button title="Back to home" link="http://thesimple.ellethemes.com/" icon="moon-arrow-right-5" align="center"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Footers
	//Default Footer vc-template
	$data = array();
	$data['name'] = esc_html__( 'Footer Startup', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/footers/footer.png' );
	$data['sort_name'] = 'Footer';
	$data['custom_class'] = 'general footer';
	$data['content'] = <<<CONTENT
[vc_row gap="10" type="full_width_background" bg_color="#1b1d1f" top_padding="70" bottom_padding="70"][vc_column width="1/3" css=".vc_custom_1505746954463{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-right: 30px !important;padding-bottom: 55px !important;padding-left: 30px !important;border-left-color: #494949 !important;border-left-style: solid !important;border-right-color: #494949 !important;border-right-style: solid !important;border-top-color: #494949 !important;border-top-style: solid !important;border-bottom-color: #494949 !important;border-bottom-style: solid !important;border-radius: 3px !important;}"][media image="7"][vc_empty_space height="20px"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3" css=".vc_custom_1505747368546{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-right: 20px !important;padding-left: 20px !important;border-left-color: #494949 !important;border-left-style: solid !important;border-right-color: #494949 !important;border-right-style: solid !important;border-top-color: #494949 !important;border-top-style: solid !important;border-bottom-color: #494949 !important;border-bottom-style: solid !important;border-radius: 3px !important;}"][vc_empty_space height="10px"][vc_widget_sidebar sidebar_id="footer-column-2"][/vc_column][vc_column width="1/3" column_padding="10%" css=".vc_custom_1505731310314{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;border-left-color: #494949 !important;border-left-style: solid !important;border-right-color: #494949 !important;border-right-style: solid !important;border-top-color: #494949 !important;border-top-style: solid !important;border-bottom-color: #494949 !important;border-bottom-style: solid !important;border-radius: 3px !important;}"][vc_empty_space height="10px"][contact-form-7 id="7509"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	
	

	//Maps Category
	//Corporate Map vc-template
	$data = array();
	$data['name'] = esc_html__( 'Map and Address', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/maps/maps.png' );
	$data['sort_name'] = 'Maps';
	$data['custom_class'] = 'general map';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="1/2" column_padding="10%"][vc_column_text][h2_heading]Contact Details[/h2_heading]

Vivamus eu urna scelerisque, porta tortor nec, cursus nisl. Pellentesque non lacus odio. Quisque a dolor nec ligula euismod placerat nec eget nisi. Nulla ut risus iaculis enim euismod tempus. Quisque a dolor nec ligula euismod placerat nec eget nisi. Nulla ut risus iaculis enim euismod tempus.

[h2_heading]New York[/h2_heading]

Address: New York, First Aveneue 25 Street Wall

Tel: +1655789996

Email: info@ellethemes.com[/vc_column_text][/vc_column][vc_column width="1/2"][google_map height="400" greyscale="no" dynamic_src="https://maps.google.com/maps?ll=42.34024,-71.105871&z=16&t=m&hl=en-US&gl=US&mapclient=embed&q=Brookline%20Ave%20Boston%2C%20MA%20USA"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Default Map vc-template
	$data = array();
	$data['name'] = esc_html__( 'Fullwidth Map', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/maps/fullwidth_map.png' );
	$data['sort_name'] = 'Maps';
	$data['custom_class'] = 'general map';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_content" text_color="light"][vc_column][google_map height="400" dynamic_src="https://maps.google.com/maps?ll=42.34024,-71.105871&z=16&t=m&hl=en-US&gl=US&mapclient=embed&q=Brookline%20Ave%20Boston%2C%20MA%20USA"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

    /*Sections*/


	
	//Corporate Graph vc-template
	$data = array();
	$data['name'] = esc_html__( 'Full section Center', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/full_section_center.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_custom_heading text="Branding and Social Marketing" font_container="tag:h2|font_size:40px|text_align:center|line_height:55px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_custom_heading text="How do we do it? Take a look below to join us on a whirlwind ride through today's connected world." font_container="tag:h6|font_size:18px|text_align:center|line_height:36px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row][vc_column][media alignment="center" animation="bottom" shadow="no" image="7800" width="1200"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Latest from Blog with text vc-template
	$data = array();
	$data['name'] = esc_html__( 'Latest from Blog with text', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/latest_blog_light.jpg' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="90" bottom_padding="90"][vc_column width="1/3"][block_title style="column_title" title="3 blog element styles" second_title="We have worked hard to make this great theme which has infinite possibilities, the possibility to customize everything, a lot of style options."][/block_title][vc_column_text]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam explicabo.[/vc_column_text][button title="Purchase Now" icon=""][/vc_column][vc_column width="2/3"][latest_blog posts_per_page="2" all_posts="8"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Corporate Graph 2 vc-template
	$data = array();
	$data['name'] = esc_html__( 'Section Media', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/section_media.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f7f7f7" top_padding="100" bottom_padding="100"][vc_column width="1/2"][block_title style="column_title" inner_style="inline_border_circle" title="Perfect template for your company" second_title="Your idea needs a great website"][/block_title][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_row_inner][vc_column_inner][services_small title="Graphic Design" icon="linea-basic-cards-diamonds" dynamic_content_type="content"]Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/services_small][services_small title="Graphic Design" icon="linea-basic-cards-diamonds" dynamic_content_type="content"]Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/services_small][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2"][media image="1396"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Text with Services 1 vc-template
	$data = array();
	$data['name'] = esc_html__( 'Text with Services 1', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/text_services1.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f1a9a0" text_color="light" top_padding="90" bottom_padding="0"][vc_column][vc_custom_heading text="It's all about perfection, isn't it?" font_container="tag:h2|font_size:45px|text_align:center|line_height:55px" google_fonts="font_family:Montserrat%3Aregular%2C700%2Clight|font_style:200%20light%3A200%3Anormal"][vc_empty_space height="20px"][vc_custom_heading text="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
et dolore magna aliqua. Ut enim ad minim veniam." font_container="tag:div|font_size:17px|text_align:center|line_height:24px" google_fonts="font_family:Karla%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal"][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#f1a9a0" text_color="light" top_padding="50" bottom_padding="90"][vc_column width="1/3"][services_medium title="Design Systems" style="style_2" icon="linea-basic-pencil-ruler" icon_color="#ffffff"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Creative Direction" style="style_2" icon="linea-basic-lightbulb" icon_color="#ffffff"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Digital Experiences" style="style_2" icon="linea-basic-laptop" icon_color="#ffffff"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.[/services_medium][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

   //Heading with Services vc-template
	$data = array();
	$data['name'] = esc_html__( 'Heading with Services', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/heading_services.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f6f6f6" top_padding="90" bottom_padding="0"][vc_column][vc_custom_heading text="A great theme to build perfect portfolio websites" font_container="tag:h2|font_size:35px|text_align:center|line_height:55px" google_fonts="font_family:Montserrat%3Aregular%2C700%2Clight|font_style:200%20light%3A200%3Anormal"][vc_empty_space height="20px"][vc_custom_heading text="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
et dolore magna aliqua. Ut enim ad minim veniam." font_container="tag:div|font_size:17px|text_align:center|color:%23808080|line_height:24px" google_fonts="font_family:Karla%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal"][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#f6f6f6" top_padding="60" bottom_padding="90"][vc_column width="1/3"][services_small title="Parallax Background" icon_bool="no" dynamic_content_type="content"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.[/services_small][vc_empty_space height="20px"][services_small title="Parallax Background" icon_bool="no" dynamic_content_type="content"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.[/services_small][/vc_column][vc_column width="1/3"][services_small title="Parallax Background" icon_bool="no" dynamic_content_type="content"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.[/services_small][vc_empty_space height="20px"][services_small title="Parallax Background" icon_bool="no" dynamic_content_type="content"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.[/services_small][/vc_column][vc_column width="1/3"][services_small title="Parallax Background" icon_bool="no" dynamic_content_type="content"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.[/services_small][vc_empty_space height="20px"][services_small title="Parallax Background" icon_bool="no" dynamic_content_type="content"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.[/services_small][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Heading with Services 2 vc-template
	$data = array();
	$data['name'] = esc_html__( 'Heading with Services 2', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/heading_services2.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f6f6f6" top_padding="110" bottom_padding="110"][vc_column][block_title inner_style_title="only_text" title="Design your presence."][/block_title][vc_empty_space height="40px"][vc_row_inner][vc_column_inner width="1/4"][services_medium title="Project Management" style="style_2" icon="linea-basic-pencil-ruler" icon_color="#606060"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod consecturetur incididunt ut labore et dolore magna aliqua.[/services_medium][/vc_column_inner][vc_column_inner width="1/4"][services_medium title="Brand Design" style="style_2" icon="linea-basic-lightbulb" icon_color="#606060"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod consecturetur incididunt ut labore et dolore magna aliqua.[/services_medium][/vc_column_inner][vc_column_inner width="1/4"][services_medium title="Social Marketing" style="style_2" icon="linea-basic-target" icon_color="#606060"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod consecturetur incididunt ut labore et dolore magna aliqua.[/services_medium][/vc_column_inner][vc_column_inner width="1/4"][services_medium title="Ecommerce Solutions" style="style_2" icon="linea-basic-mouse" icon_color="#606060"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod consecturetur incididunt ut labore et dolore magna aliqua.[/services_medium][/vc_column_inner][/vc_row_inner][vc_empty_space height="60px"][vc_custom_heading text="Nulla facilisi. Suspendisse quis ligula sagittis, eleifend libero velsa fringilla tortorlibero
sapien Lorem ipsum dolor sit amet do eiusmod tempor incididunt" font_container="tag:div|font_size:14px|text_align:center|line_height:24px" google_fonts="font_family:Montserrat%3Aregular%2C700%2Clight|font_style:400%20regular%3A400%3Anormal"][vc_empty_space height="60px"][button title="Read More" icon="moon-arrow-right-5" align="center"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//Fullwidth two columns vc-template
	$data = array();
	$data['name'] = esc_html__( 'Fullwidth Two Columns', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/fullwidth_two_columns.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_content" bg_image="145" bg_position="center center" top_padding="90" bottom_padding="90"][vc_column width="1/2" centered_cont_vertical="true" css=".vc_custom_1513958035177{padding-top: 12% !important;padding-right: 12% !important;padding-bottom: 12% !important;padding-left: 12% !important;}"][vc_custom_heading text="Our latest app is featured
on Apple Store" font_container="tag:h2|font_size:28px|text_align:left|line_height:35px" google_fonts="font_family:Josefin%20Sans%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal"][vc_empty_space height="25px"][vc_custom_heading text="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur consectetur ligula erat, sed consectetur mi faucibus a. Donec sit amet consectetur ligula. Proin turpis est, sodales ac lorem id, finibus feugiat turpis.

Vestibulum malesuada quis lectus sit amet mollis. Phasellus lacinia faucibus purus, ut rutrum eros blandit sit amet." font_container="tag:h2|font_size:16px|text_align:left|color:%23707582|line_height:24px" google_fonts="font_family:Karla%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal"][vc_empty_space height="25px"][button title="View Portfolio" icon="moon-arrow-right-5" button_bool="yes" button_2_title="All Features"][/vc_column][vc_column width="1/2" centered_cont_vertical="true" css=".vc_custom_1513958077643{padding-right: 50px !important;}"][vc_empty_space][media alignment="right" shadow="no" image="159"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

    //Fullwidth background vc-template
	$data = array();
	$data['name'] = esc_html__( 'Fullwidth Background', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/fullwidth_background.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_image="40" bg_position="center center" overlay="true" overlay_color="rgba(0,0,0,0.43)" text_color="light" top_padding="120" bottom_padding="120"][vc_column enable_animation="true" animation="fadeInUp" delay="200"][vc_custom_heading text="The true work of art is but a shadow
of the divine perfection." font_container="tag:h2|font_size:60px|text_align:center|color:%23ffffff|line_height:80px" google_fonts="font_family:Playfair%20Display%3Aregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:700%20bold%20italic%3A700%3Aitalic"][vc_empty_space height="40px"][button title="Purchase Theme" align="center"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Heading with skills vc-template
	$data = array();
	$data['name'] = esc_html__( 'Heading with skills', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/skills.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row class="skills"][vc_column][block_title inner_style_title="only_text" title="Skills"]Creative portfolio ready made templates are ready on one-click.[/block_title][/vc_column][/vc_row][vc_row][vc_column width="1/4"][chart_skill percent="90" text="Photoshop" color="#000000" skill_desc="Sed venenatis, tortor sed tempor imperdiet, sem massa feugiat tortor, aliquet rhoncus lorem odio a justo. Nam enim ligula, sagittis ac ultricies vel, hendrerit condimentum ipsum."][/vc_column][vc_column width="1/4"][chart_skill percent="85" text="Adobe After Effects" color="#000000" skill_desc="Sed venenatis, tortor sed tempor imperdiet, sem massa feugiat tortor, aliquet rhoncus lorem odio a justo. Nam enim ligula, sagittis ac ultricies vel, hendrerit condimentum ipsum."][/vc_column][vc_column width="1/4"][chart_skill percent="75" text="Illustrator" color="#000000" skill_desc="Sed venenatis, tortor sed tempor imperdiet, sem massa feugiat tortor, aliquet rhoncus lorem odio a justo. Nam enim ligula, sagittis ac ultricies vel, hendrerit condimentum ipsum."][/vc_column][vc_column width="1/4"][chart_skill percent="75" text="Illustrator" color="#000000" skill_desc="Sed venenatis, tortor sed tempor imperdiet, sem massa feugiat tortor, aliquet rhoncus lorem odio a justo. Nam enim ligula, sagittis ac ultricies vel, hendrerit condimentum ipsum."][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Personal Resume vc-template
	$data = array();
	$data['name'] = esc_html__( 'Personal Resume', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/resume_contact.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f6f6f6" top_padding="90" bottom_padding="90" class="hire"][vc_column width="1/2"][contact-form-7 id="4"][/vc_column][vc_column width="1/2"][vc_empty_space height="35px"][vc_custom_heading text="Hire me for your next creative project" font_container="tag:h2|font_size:50px|text_align:left|line_height:60px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_empty_space height="25px"][vc_custom_heading text="This is my personal resume" font_container="tag:h2|font_size:20px|text_align:left|color:%23686868|line_height:28px" google_fonts="font_family:Courgette%3Aregular|font_style:400%20regular%3A400%3Anormal"][vc_empty_space height="25px"][vc_custom_heading text="Sed venenatis, tortor sed tempor imperdiet, sem massa feugiat tortor, aliquet rhoncus lorem odio a justo. Nam enim ligula, sagittis ac ultricies vel, hendrerit condimentum ipsum. Nam auctor, mauris aliquam ultricies laoreet, massa felis hendrerit magna, ac condimentum lacus orci et nisl. Pellentesque ultricies, erat nec sodales aliquam, ante quam varius metus, sit amet congue tellus neque molestie eros. Quisque finibus diam eu enim eleifend ultricies." font_container="tag:div|font_size:16px|text_align:left|line_height:24px" google_fonts="font_family:Hind%3A300%2Cregular%2C500%2C600%2C700|font_style:400%20regular%3A400%3Anormal"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Our Services Minimal vc-template
	$data = array();
	$data['name'] = esc_html__( 'Our Services Minimal', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/services_minimal.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="1/3"][services_media title="Development Services" photo="7091" shadow="no"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.tation ullamcorper suscipit lobortis nisldolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum.[/services_media][/vc_column][vc_column width="1/3"][services_media title="UX Design Services" photo="7090" shadow="no"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.tation ullamcorper suscipit lobortis nisldolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum.[/services_media][/vc_column][vc_column width="1/3"][services_media title="Marketing Strategy Services" photo="7089" shadow="no"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.tation ullamcorper suscipit lobortis nisldolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum.[/services_media][/vc_column][/vc_row][vc_row][vc_column][button title="See My Works" link="http://amos.ellethemes.com/minimal/?page_id=6848" icon="" align="center"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

    /*Pricing*/
	//Business Pricing vc-template
	$data = array();
	$data['name'] = esc_html__( 'Pricing Table 1', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/pricing/price_table_1.png' );
	$data['sort_name'] = 'Pricing';
	$data['custom_class'] = 'general pricing';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f5f5f5" top_padding="80" bottom_padding="80"][vc_column width="1/3"][price_list title="Standart" price="$35" period="monthly" sub_title="Billed Anually" bg_color="#ffffff" style="list" button_title="Purchase Now"][price_list_item title="Password protection"][price_list_item title="Code export"][price_list_item title="Unlimited hosted projects"][price_list_item title="10 projects"][/price_list][/vc_column][vc_column width="1/3"][price_list title="Professional" price="$45" period="monthly" sub_title="Billed Anually" bg_color="#ffffff" style="list" button_title="Purchase Now"][price_list_item title="Password protection"][price_list_item title="Code export"][price_list_item title="Unlimited hosted projects"][price_list_item title="10 projects"][/price_list][/vc_column][vc_column width="1/3"][price_list title="Premium" price="$65" period="monthly" sub_title="Billed Anually" bg_color="#ffffff" style="list" button_title="Purchase Now"][price_list_item title="Password protection"][price_list_item title="Code export"][price_list_item title="Unlimited hosted projects"][price_list_item title="10 projects"][/price_list][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	// Default Pricing Tables Contact Us 2 vc-template
    $data = array();
	$data['name'] = esc_html__( 'Pricing Tables 2', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/pricing/pricing-tables_2.png' );
	$data['sort_name'] = 'Pricing';
	$data['custom_class'] = 'general pricing';
	$data['content'] = <<<CONTENT
[vc_row link_bool="" link_value="#"][vc_column width="1/3"][price_list title="Basic" price="55.6"][list_item title="Drag & Drop Builder"][list_item title="Advanced Theme Options"][list_item title="Unlimited Color Choices"][list_item title="Seo Optimized"][list_item title="Speed Optimized"][/price_list][/vc_column][vc_column width="1/3"][price_list title="Premium" price="70.0" type="highlighted"][list_item title="Drag & Drop Builder"][list_item title="Advanced Theme Options"][list_item title="Unlimited Color Choices"][list_item title="Seo Optimized"][list_item title="Speed Optimized"][/price_list][/vc_column][vc_column width="1/3"][price_list title="Professional" price="95.0"][list_item title="Drag & Drop Builder"][list_item title="Advanced Theme Options"][list_item title="Unlimited Color Choices"][list_item title="Seo Optimized"][list_item title="Speed Optimized"][/price_list][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Business Pricing vc-template
	$data = array();
	$data['name'] = esc_html__( 'Pricing Table with Icons', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/pricing/price_table_icon.png' );
	$data['sort_name'] = 'Pricing';
	$data['custom_class'] = 'general pricing';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f1f2f3" top_padding="70" bottom_padding="100" borders="1" link_bool="" link_value="#"][vc_column width="1/4"][price_list price_icon="linea-basic-clessidre" title="Monthly Package" price="89.9" bg_color="#ffffff"][list_item title="Advanced Theme Options"][list_item title="Codeless Slider"][list_item title="SEO Ready"][list_item title="Page Transitions & Animations"][list_item title="Online Builder"][/price_list][/vc_column][vc_column width="1/4"][price_list price_icon="linea-basic-gear" title="Ultimate Package" price="139.9" bg_color="#ffffff"][list_item title="Advanced Theme Options"][list_item title="Codeless Slider"][list_item title="SEO Ready"][list_item title="Page Transitions & Animations"][list_item title="Online Builder"][/price_list][/vc_column][vc_column width="1/4"][price_list price_icon="linea-basic-anchor" title="Yearly Package" price="259.9" bg_color="#ffffff"][list_item title="Advanced Theme Options"][list_item title="Codeless Slider"][list_item title="SEO Ready"][list_item title="Page Transitions & Animations"][list_item title="Online Builder"][/price_list][/vc_column][vc_column width="1/4"][price_list price_icon="linea-basic-globe" title="Lifetime Package" price="599.9" bg_color="#ffffff"][list_item title="Advanced Theme Options"][list_item title="Codeless Slider"][list_item title="SEO Ready"][list_item title="Page Transitions & Animations"][list_item title="Online Builder"][/price_list][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;


	/*Services*/
	//Bussines Services vc-template
	$data = array();
	$data['name'] = esc_html__( 'Services Square', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/services/full_section_square_services.png' );
	$data['sort_name'] = 'Services';
	$data['custom_class'] = 'general service';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f5f5f5"][vc_column][block_title title="Some of Our Features." upper_title="We work to make it real!"][/block_title][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#f5f5f5" top_padding="0" bottom_padding="100"][vc_column width="1/3" css_animation="fadeInRight"][services_large title="Perfect Design" style="style_2" icon="linea-basic-heart-broken" circle_color="" border_color="" box_background_color="#ffffff" bottom_button="no"]Aenean commodo ligula eget dolor. venean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit.[/services_large][services_large title="Social Media" style="style_2" icon="linea-basic-message-multiple" circle_color="" border_color="" box_background_color="#ffffff" bottom_button="no"]Aenean commodo ligula eget dolor. venean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit.[/services_large][/vc_column][vc_column width="1/3" css_animation="fadeInRight"][services_large title="Support EveryWhere" style="style_2" icon="linea-basic-life-buoy" circle_color="" border_color="" box_background_color="#ffffff" bottom_button="no"]Aenean commodo ligula eget dolor. venean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit.[/services_large][services_large title="Email Marketing" style="style_2" icon="linea-basic-mail-open" circle_color="" border_color="" box_background_color="#ffffff" bottom_button="no"]Aenean commodo ligula eget dolor. venean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit.[/services_large][/vc_column][vc_column width="1/3" css_animation="fadeInRight"][services_large title="Speedy Way" style="style_2" icon="linea-basic-bolt" circle_color="" border_color="" box_background_color="#ffffff" bottom_button="no"]Aenean commodo ligula eget dolor. venean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit.[/services_large][services_large title="Development" style="style_2" icon="linea-basic-helm" circle_color="" border_color="" box_background_color="#ffffff" bottom_button="no"]Aenean commodo ligula eget dolor. venean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit.[/services_large][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Circle Services vc-template
	$data = array();
	$data['name'] = esc_html__( 'Services Circle', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/services/full_section_circle_services.png' );
	$data['sort_name'] = 'Services';
	$data['custom_class'] = 'general service';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="90" bottom_padding="20"][vc_column width="1/4"][services_medium title=" We work with passion" style="style_2" icon="linea-basic-accelerator" icon_color="#222222" align_icon="left"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_medium][services_medium title="Working With Care" style="style_2" icon="linea-basic-home" icon_color="#222222" align_icon="left"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Simplicity is the key" style="style_2" icon="linea-basic-lightbulb" icon_color="#222222" align_icon="left"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_medium][services_medium title="SEO Optimization" style="style_2" icon="linea-basic-accelerator" icon_color="#222222" align_icon="left"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Clients come first" style="style_2" icon="linea-basic-headset" icon_color="#222222" align_icon="left"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_medium][services_medium title="Enhanced Performance" style="style_2" icon="linea-basic-cup" icon_color="#222222" align_icon="left"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Working With Care" style="style_2" icon="linea-basic-heart" icon_color="#222222" align_icon="left"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_medium][services_medium title="Designed for perfection " style="style_2" icon="linea-basic-magic-mouse" icon_color="#222222" align_icon="left"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_medium][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Services Small vc-template
	$data = array();
	$data['name'] = esc_html__( 'Services Small', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/services/services_small.png' );
	$data['sort_name'] = 'Services';
	$data['custom_class'] = 'general service';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="0" bottom_padding="90"][vc_column width="1/4" enable_animation="true" animation="fadeIn" delay="300"][services_small title="We work with passion" icon="linea-basic-alarm" dynamic_content_type="content"]

Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.

[/services_small][services_small title="Video tutorials" icon="linea-basic-lock-open" dynamic_content_type="content"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_small][/vc_column][vc_column width="1/4"][services_small title="Simplicity is the key" icon="linea-basic-cards-diamonds" dynamic_content_type="content"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_small][services_small title="SEO Optimization" icon="linea-basic-star" dynamic_content_type="content"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_small][/vc_column][vc_column width="1/4"][services_small title="Clients come first" icon="linea-basic-compass" dynamic_content_type="content"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_small][services_small title="Optimized code" icon="linea-basic-cup" dynamic_content_type="content"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_small][/vc_column][vc_column width="1/4"][services_small title="Working With Care" icon="linea-basic-geolocalize-05" dynamic_content_type="content"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_small][services_small title="Branding design" icon="linea-basic-paperplane" dynamic_content_type="content"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created.[/services_small][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Services Small Background vc-template
	$data = array();
	$data['name'] = esc_html__( 'Services Small with Background', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/services/services_small_background.png' );
	$data['sort_name'] = 'Services';
	$data['custom_class'] = 'general service';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_image="7348" bg_position="center center" parallax_bg="true" overlay="true" overlay_color="rgba(0,0,0,0.65)" text_color="light" top_padding="90" bottom_padding="90"][vc_column width="1/4" enable_animation="true" animation="fadeIn" delay="300"][services_small title="Innovative Design" icon="linea-basic-bolt" style="style_2" color_icon_wr="#ffffff" icon_color="#0a0a0a" dynamic_content_type="content"]Use unlimited services elements with AmosWordPress Theme. Dont miss this opportunity.[/services_small][services_small title="Professional Support" icon="linea-basic-gear" style="style_2" color_icon_wr="#ffffff" icon_color="#0a0a0a" dynamic_content_type="content"]Use unlimited services elements with The SimpleWordPress Theme. Dont miss this opportunity.[/services_small][/vc_column][vc_column width="1/4"][services_small title="Accelerated Animations" icon="linea-basic-mixer2" style="style_2" color_icon_wr="#ffffff" icon_color="#0a0a0a" dynamic_content_type="content"]Use unlimited services elements with The SimpleWordPress Theme. Don’t miss this opportunity.[/services_small][services_small title="High Performance" icon="linea-basic-cup" style="style_2" color_icon_wr="#ffffff" icon_color="#0a0a0a" dynamic_content_type="content"]Use unlimited services elements with TheSimple WordPress Theme. Don’t miss this opportunity.[/services_small][/vc_column][vc_column width="1/4"][services_small title="Predefined Elements" icon="linea-basic-compass" style="style_2" color_icon_wr="#ffffff" icon_color="#0a0a0a" dynamic_content_type="content"]Use unlimited services elements with TheSimple WordPress Theme. Don’t miss this opportunity.[/services_small][services_small title="Live Customizer" icon="linea-basic-link" style="style_2" color_icon_wr="#ffffff" icon_color="#0a0a0a" dynamic_content_type="content"]Use unlimited services elements with TheSimpleWordPress Theme. Dont miss this opportunity.[/services_small][/vc_column][vc_column width="1/4"][services_small title="Infinite Layouts" icon="linea-basic-settings" style="style_2" color_icon_wr="#ffffff" icon_color="#0a0a0a" dynamic_content_type="content"]Use unlimited services elements with TheSimple WordPress Theme. Don’t miss this opportunity.[/services_small][services_small title="Lifetime Updates" icon="linea-arrows-rotate-dashed" style="style_2" color_icon_wr="#ffffff" icon_color="#0a0a0a" dynamic_content_type="content"]Use unlimited services elements with Amos WordPress Theme. Don’t miss this opportunity.[/services_small][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Services Text Effect vc-template
	$data = array();
	$data['name'] = esc_html__( 'Services Text Effect', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/services/services_text_effect.png' );
	$data['sort_name'] = 'Services';
	$data['custom_class'] = 'general service';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f5f5f5" top_padding="90" bottom_padding="0"][vc_column][block_title inner_style_title="only_text" padding_desc="20%" title="We have worked hard to make this happen."]Hover over service element to view the text effect. So many customizations for a single element.[/block_title][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#f5f5f5"][vc_column][vc_row_inner][vc_column_inner width="1/4"][services_steps title="Woocommerce" icon="linea-basic-signs"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.[/services_steps][vc_empty_space][services_steps title="Live Customizer" icon="linea-basic-helm"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.[/services_steps][/vc_column_inner][vc_column_inner width="1/4"][services_steps title="Continual Updates" icon="linea-basic-clockwise"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.[/services_steps][vc_empty_space][services_steps title="Advanced Options" icon="linea-basic-share"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.[/services_steps][/vc_column_inner][vc_column_inner width="1/4"][services_steps title="SEO Optimized" icon="linea-basic-gear"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.[/services_steps][vc_empty_space][services_steps title="No Koding Skills Needed" icon="linea-basic-magnifier"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.[/services_steps][/vc_column_inner][vc_column_inner width="1/4"][services_steps title="New Entries" icon="linea-basic-anchor"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.[/services_steps][vc_empty_space][services_steps title="Infinite Layouts" icon="linea-basic-book-pencil"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.[/services_steps][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Services Media vc-template
	$data = array();
	$data['name'] = esc_html__( 'Services Media', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/services/services_media.png' );
	$data['sort_name'] = 'Services';
	$data['custom_class'] = 'general service';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="1/3"][services_media title="Services Media Image" photo="7453" style="style_2" shadow="no"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.tation ullamcorper suscipit lobortis nisldolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril[/services_media][/vc_column][vc_column width="1/3"][services_media title="Services Media Image" photo="7454" style="style_2" shadow="no"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.tation ullamcorper suscipit lobortis nisldolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril[/services_media][/vc_column][vc_column width="1/3"][services_media title="Services Media Image" photo="7455" style="style_2" shadow="no"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.tation ullamcorper suscipit lobortis nisldolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril[/services_media][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	 // Default Media & Text vc-template
    $data = array();
	$data['name'] = esc_html__( 'Media & Text', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/media&text.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f7f7f7" top_padding="100" bottom_padding="100"][vc_column width="1/2"][block_title style="column_title" inner_style="inline_border_circle" title="Perfect template for your company" second_title="Your idea needs a great website"][/block_title][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_row_inner][vc_column_inner][services_small title="Graphic Design" icon="linea-basic-cards-diamonds" dynamic_content_type="content"]Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/services_small][services_small title="Graphic Design" icon="linea-basic-cards-diamonds" dynamic_content_type="content"]Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/services_small][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2"][media image="1396"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	
// Default Video Background vc-template
    $data = array();
	$data['name'] = esc_html__( 'Video Background', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/video-background.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row video_bg="use_video" video_bg_url="https://youtu.be/gF0rrpMH-Jo?t=14s" overlay="true" overlay_color="rgba(22,22,22,0.51)" text_color="light" top_padding="150" bottom_padding="150"][vc_column][vc_custom_heading text="Opportunities don't happen.
You create them." font_container="tag:h2|font_size:45px|text_align:center|line_height:55px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

// Default Staff & Clients vc-template
    $data = array();
	$data['name'] = esc_html__( 'Staff & Clients', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/staff&clients.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="80" bottom_padding="80"][vc_column][block_title inner_style_title="only_text" title="Our Creative Staff"]Are you ready to work with us?[/block_title][staff_carousel pagination="no" slide_per_view="3" test_cat="0"][/vc_column][/vc_row][vc_row][vc_column][block_title inner_style_title="only_text" title="Our Clients"]We are grateful to our clients for trusting us.[/block_title][clients carousel="no"][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#5198ff" bg_color_2="#7c6cc8" text_color="light" top_padding="50" bottom_padding="50"][vc_column][vc_custom_heading text="Build your portfolio site today" font_container="tag:h2|font_size:26px|text_align:center|line_height:40px" google_fonts="font_family:Montserrat%3Aregular%2C700%2Clight|font_style:400%20regular%3A400%3Anormal"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	// Minimal About Me vc-template
    $data = array();
	$data['name'] = esc_html__( 'About Me', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/about-me.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="1/2"][vc_empty_space height="100px"][vc_custom_heading text="About Me" font_container="tag:h2|font_size:35px|text_align:center|line_height:45px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_empty_space height="20px"][vc_custom_heading text="Nec ut mazim ancillae disputando, erat falli mel ex. Postea verterem temporibus te sea, quo persecuti interesset ex, sanctus intellegebat vis cu. Placerat persecuti honestatis per cu, mea pertinacia dissentiet ex. Duo ea tempor audire, pertinacia mediocritatem ne eum, ad eos noluisse necessitatibus. Stet accusam vituperatoribus cu eam, ad sit partiendo suscipiantur contentiones, ferri pertinacia ius no. Ad mea amet placerat, pri an sale porro albucius. Nec ut mazim ancillae disputando, erat falli mel ex. Postea verterem temporibus te sea, quo persecuti interesset ex, sanctus intellegebat vis cu. Placerat persecuti honestatis per cu, mea pertinacia dissentiet ex. Duo ea tempor audire, pertinacia mediocritatem ne eum, ad eos noluisse" font_container="tag:div|font_size:15px|text_align:center|line_height:28px" google_fonts="font_family:Hind%3A300%2Cregular%2C500%2C600%2C700|font_style:400%20regular%3A400%3Anormal"][/vc_column][vc_column width="1/2"][media alignment="center" shadow="no" image="7082" width="500"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	
	// Default About Me Personal vc-template
    $data = array();
	$data['name'] = esc_html__( 'About Me Personal', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/about-me-personal.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="90" bottom_padding="90"][vc_column width="1/2"][block_title style="column_title" title="My skills"][/block_title][vc_custom_heading text="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum nulla ac tincidunt malesuada. Sed volutpat semper elit quis pharetra. Etiam sodales a sem vitae fermentum. Curabitur pellentesque massa eu nulla et consequat porttitor arcu porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. " font_container="tag:div|font_size:14px|text_align:left|line_height:22px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][/vc_column][vc_column width="1/2"][skills][skill title="Front-end Developer" percentage="95"][skill title="Back-end Developer" percentage="85"][skill title="Full-stack Developer" percentage="70"][skill title="Web Developer" percentage="95"][/skills][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#5198ff" text_color="light" top_padding="100" bottom_padding="30"][vc_column][vc_custom_heading text="This is my personal resume" font_container="tag:h5|font_size:22px|text_align:center|line_height:35px" google_fonts="font_family:Courgette%3Aregular|font_style:400%20regular%3A400%3Anormal"][vc_custom_heading text="I am a creative designer with 10 years of experience" font_container="tag:h2|font_size:35px|text_align:center|line_height:50px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

		// Default Contact Us vc-template
    $data = array();
	$data['name'] = esc_html__( 'Contact Us', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/contact-us.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row equal_height="yes"][vc_column width="1/2" css=".vc_custom_1506004249941{padding-top: 40px !important;padding-right: 35% !important;padding-bottom: 40px !important;padding-left: 40px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][block_title style="column_title" title="Lets Talk" second_title="Drop us a line and let us know what do you think about our company."][/block_title][vc_custom_heading text="Phone" font_container="tag:h4|font_size:16px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="0 110 360 79 79" font_container="tag:h4|font_size:14px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_custom_heading text="Email" font_container="tag:h4|font_size:16px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="ellethemes@gmail.com" font_container="tag:h4|font_size:14px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_custom_heading text="Address" font_container="tag:h4|font_size:16px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="5th Avenue, Upper West Side Los Angeles" font_container="tag:h4|font_size:14px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt[/vc_column_text][vc_column_text][social_icons icon="facebook" link="#" size="small"][social_icons icon="twitter" link="#" size="small"][social_icons icon="linkedin" link="#" size="small"][social_icons icon="pinterest" link="#" size="small"][social_icons icon="github" link="#" size="small"][/vc_column_text][/vc_column][vc_column width="1/2"][vc_empty_space height="100px"][contact-form-7 id="7388" title="contact_2"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	// Default Contact Us 2 vc-template
    $data = array();
	$data['name'] = esc_html__( 'Contact Us 2', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/contact-us-2.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_content"][vc_column][google_map height="500" dynamic_src="https://maps.google.com/maps?ll=42.34024,-71.105871&z=16&t=m&hl=en-US&gl=US&mapclient=embed&q=Brookline%20Ave%20Boston%2C%20MA%20USA"][/vc_column][/vc_row][vc_row equal_height="yes"][vc_column width="1/2" css=".vc_custom_1506004249941{padding-top: 40px !important;padding-right: 35% !important;padding-bottom: 40px !important;padding-left: 40px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][block_title style="column_title" title="Lets Talk" second_title="Drop us a line and let us know what do you think about our company."][/block_title][vc_custom_heading text="Phone" font_container="tag:h4|font_size:16px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="0 110 360 79 79" font_container="tag:h4|font_size:14px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_custom_heading text="Email" font_container="tag:h4|font_size:16px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="ellethemes@gmail.com" font_container="tag:h4|font_size:14px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_custom_heading text="Address" font_container="tag:h4|font_size:16px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="5th Avenue, Upper West Side Los Angeles" font_container="tag:h4|font_size:14px|text_align:left|line_height:35px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt[/vc_column_text][vc_column_text][social_icons icon="facebook" link="#" size="small"] [social_icons icon="twitter" link="#" size="small"][social_icons icon="linkedin" link="#" size="small"][social_icons icon="pinterest" link="#" size="small"][social_icons icon="github" link="#" size="small"][/vc_column_text][/vc_column][vc_column width="1/2"][vc_empty_space height="100px"][contact-form-7 id="7388" title="contact_2"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	// Default Pricing Tables Contact Us 2 vc-template
    $data = array();
	$data['name'] = esc_html__( 'Pricing Tables', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/pricing-tables.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="90" bottom_padding="0"][vc_column][block_title inner_style_title="only_text" title="Pricing Tables Styles"]Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor.[/block_title][/vc_column][/vc_row][vc_row link_bool="" link_value="#"][vc_column width="1/3"][price_list title="Basic" price="55.6"][list_item title="Drag & Drop Builder"][list_item title="Advanced Theme Options"][list_item title="Unlimited Color Choices"][list_item title="Seo Optimized"][list_item title="Speed Optimized"][/price_list][/vc_column][vc_column width="1/3"][price_list title="Premium" price="70.0" type="highlighted"][list_item title="Drag & Drop Builder"][list_item title="Advanced Theme Options"][list_item title="Unlimited Color Choices"][list_item title="Seo Optimized"][list_item title="Speed Optimized"][/price_list][/vc_column][vc_column width="1/3"][price_list title="Professional" price="95.0"][list_item title="Drag & Drop Builder"][list_item title="Advanced Theme Options"][list_item title="Unlimited Color Choices"][list_item title="Seo Optimized"][list_item title="Speed Optimized"][/price_list][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;


	// Default Services vc-template
    $data = array();
	$data['name'] = esc_html__( 'Services', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/services.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="1/3"][services_medium title="With content blocks" style="style_2" icon="linea-basic-archive-full"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created. Different Styles and unlimited styles for every element and shortcode.[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Setup Wizard" style="style_2" icon="linea-basic-cup"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created. Different Styles and unlimited styles for every element and shortcode.[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Premium Plugins" style="style_2" icon="linea-basic-star"]Customize every element of the theme within minutes. Amos is the easiest and fastest theme ever created. Different Styles and unlimited styles for every element and shortcode.[/services_medium][/vc_column][/vc_row][vc_row type="full_width_content"][vc_column width="1/2" css=".vc_custom_1508491583834{background-image: url(http://amos.ellethemes.com/wp-content/uploads/2017/09/andrew-neel-300014-1.jpg?id=7788) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_empty_space height="400px"][/vc_column][vc_column width="1/2" css=".vc_custom_1508491639028{background-image: url(http://amos.ellethemes.com/wp-content/uploads/2017/09/andrew-neel-308138-1.jpg?id=7789) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_empty_space height="400px"][/vc_column][/vc_row][vc_row]
CONTENT;
	$templates[] = $data;

	// Default Services 2 vc-template
    $data = array();
	$data['name'] = esc_html__( 'Services 2', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/services-2.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="90" bottom_padding="90"][vc_column width="1/4" enable_animation="true" animation="fadeIn" delay="300"][services_small title="Working Passionly" icon="linea-basic-heart" dynamic_content_type="content"]Use unlimited services elements with The Simple WordPress Theme. Don’t miss this opportunity.[/services_small][services_small title="Online Supporting" icon="linea-basic-rss" dynamic_content_type="content"]Use unlimited services elements with The Simple WordPress Theme. Don’t miss this opportunity.[/services_small][/vc_column][vc_column width="1/4"][services_small title="Working Together" icon="linea-basic-globe" dynamic_content_type="content"]Use unlimited services elements with The Simple WordPress Theme. Don’t miss this opportunity.[/services_small][services_small title="SEO Optimized" icon="linea-basic-accelerator" dynamic_content_type="content"]Use unlimited services elements with The Simple WordPress Theme. Don’t miss this opportunity.[/services_small][/vc_column][vc_column width="1/4"][services_small title="Working For Clients" icon="linea-basic-message-txt" dynamic_content_type="content"]Use unlimited services elements with The Simple WordPress Theme. Don’t miss this opportunity.[/services_small][services_small title="Online Builder" icon="linea-basic-share" dynamic_content_type="content"]Use unlimited services elements with The Simple WordPress Theme. Don’t miss this opportunity.[/services_small][/vc_column][vc_column width="1/4"][services_small title="Working With Care" icon="linea-basic-magnifier" dynamic_content_type="content"]Use unlimited services elements with The Simple WordPress Theme. Don’t miss this opportunity.[/services_small][services_small title="Always Branding" icon="linea-basic-lightbulb" dynamic_content_type="content"]Use unlimited services elements with The Simple WordPress Theme. Don’t miss this opportunity.[/services_small][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#5198ff" top_padding="40" bottom_padding="40"][vc_column][clients dark_light="light"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	// Home 2 Full grid section vc-template
    $data = array();
	$data['name'] = esc_html__( 'Full Section Grid', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/full-section-grid.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="2/3"][vc_custom_heading text="Amos is a <strong>creative studio agency</strong> that is specialized in brand design and digital creation. " font_container="tag:h2|font_size:40px|text_align:left|color:%23222222|line_height:50px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_empty_space height="20px"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row][vc_row type="full_width_content" bg_color="#f8f8f8" text_color="light"][vc_column width="1/2" el_class="no_padding" css=".vc_custom_1512141592986{padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;background-image: url(http://amos.ellethemes.com/wp-content/uploads/2017/09/andrew-neel-300014-1.jpg?id=7788) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_empty_space height="400px"][/vc_column][vc_column width="1/2" css=".vc_custom_1507813507100{padding-top: 100px !important;padding-right: 80px !important;padding-bottom: 100px !important;padding-left: 80px !important;background-color: #5198ff !important;}"][vc_custom_heading text="Our creative spirit" font_container="tag:h6|font_size:18px|text_align:center|line_height:50px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal" el_class="with_line"][vc_custom_heading text="Whether we are graphic designers, ergonomists or even developers, our main goal is to give each project its own creative and unique solution. This enables us to question all the uses and methods of the digital field in order to find the best current and future techniques." font_container="tag:div|font_size:16px|text_align:center|line_height:24px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][/vc_column][/vc_row][vc_row type="full_width_content" bg_color="#f8f8f8" class="no_padding"][vc_column width="1/2" el_class="no_padding" css=".vc_custom_1512141817543{padding-top: 125px !important;padding-right: 100px !important;padding-bottom: 125px !important;padding-left: 100px !important;background-color: #ffffff !important;}"][vc_custom_heading text="The principle of the design - the harmony, rhythm and balance are all the same with interior and fashion design." font_container="tag:div|font_size:26px|text_align:center|color:%23222222|line_height:40px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][/vc_column][vc_column width="1/2" css=".vc_custom_1512141634951{background-image: url(http://amos.ellethemes.com/wp-content/uploads/2017/09/andrew-neel-308138-1.jpg?id=7789) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_empty_space height="402px"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	
	
    // Default Our Team vc-template
    $data = array();
	$data['name'] = esc_html__( 'Our Team', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/section/team.png' );
	$data['sort_name'] = 'Section';
	$data['custom_class'] = 'general section';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f4f4f4" top_padding="80" bottom_padding="80"][vc_column width="1/3"][staff staff="6730"][/vc_column][vc_column width="1/3"][staff staff="6733"][/vc_column][vc_column width="1/3"][staff staff="6745"][/vc_column][/vc_row][vc_row type="full_width_background" bg_image="6810" bg_position="center center" overlay="true" overlay_color="rgba(81,152,255,0.92)" text_color="light" top_padding="120" bottom_padding="120"][vc_column][vc_custom_heading text="Want to join our creative team?" font_container="tag:h2|font_size:26px|text_align:center|line_height:36px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="Send us your portfolio now and get the opportunity to work with the best." font_container="tag:h2|font_size:16px|text_align:center|line_height:28px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal"][vc_empty_space height="25px"][button title="Contact Us" icon="moon-arrow-right-5" align="center"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	/*Tabs*/
	//Tabs and accorditions vc-template
	$data = array();
	$data['name'] = esc_html__( 'Tabs Style 1', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/tabs/tabs_1.png' );
	$data['sort_name'] = 'Tabs';
	$data['custom_class'] = 'general tabs';
	$data['content'] = <<<CONTENT
[vc_row][vc_column][block_title inner_style_title="only_text" title="Great element to organize your content!"]Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/block_title][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_tta_tabs shape="square" color="white" spacing="5" active_section="1"][vc_tta_section title="Responsive" tab_id="1443707815518-4e101fbe-ad1e"][vc_column_text]

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est

[/vc_column_text][/vc_tta_section][vc_tta_section title="Parallax" tab_id="1443707815685-fdb9a60f-ba3f"][vc_column_text]

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est

[/vc_column_text][/vc_tta_section][vc_tta_section title="Awesome Fonts" tab_id="1443708155192-9b7a6918-e316"][vc_column_text]

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est

[/vc_column_text][/vc_tta_section][/vc_tta_tabs][/vc_column][vc_column width="1/2"][vc_tta_tabs shape="square" color="white" spacing="5" gap="5" tab_position="bottom" alignment="center" active_section="1"][vc_tta_section tab_id="1443708227568-6cf0b137-4d9a" title="Visual Composer"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est[/vc_column_text][/vc_tta_section][vc_tta_section tab_id="1443708227836-fdcc04b9-e351" title="Powerful theme options"][vc_column_text]Parallax

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est[/vc_column_text][/vc_tta_section][vc_tta_section tab_id="1443708228099-6192f6ef-8f89" title="6000+ Icons"][vc_column_text]Awesome Fonts

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est[/vc_column_text][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

//Tabs and accorditions vc-template
	$data = array();
	$data['name'] = esc_html__( 'Tabs Style 2', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/tabs/tabs_2.png' );
	$data['sort_name'] = 'Tabs';
	$data['custom_class'] = 'general tabs';
	$data['content'] = <<<CONTENT
[vc_row][vc_column][separator width="1100px" height="2px" position="center" color="#f5f5f5"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_tta_tabs style="modern" spacing="5" active_section="1"][vc_tta_section title="Responsive" tab_id="1505813540568-d96e5abf-6f97"][vc_column_text]

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est

[/vc_column_text][/vc_tta_section][vc_tta_section title="Parallax" tab_id="1505813540816-75dd2db0-a069"][vc_column_text]

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est

[/vc_column_text][/vc_tta_section][vc_tta_section title="Awesome Fonts" tab_id="1505813541061-0a8da6dc-8a9d"][vc_column_text]

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est

[/vc_column_text][/vc_tta_section][/vc_tta_tabs][/vc_column][vc_column width="1/2"][vc_tta_tabs style="outline" color="black" spacing="5" gap="5" tab_position="bottom" alignment="center" active_section="2" css_animation="top-to-bottom"][vc_tta_section tab_id="1505813541600-51f38aa2-794e" title="Visual Composer"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est[/vc_column_text][/vc_tta_section][vc_tta_section tab_id="1505813541870-93db5487-a175" title="Powerful theme options"][vc_column_text]Parallax

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est[/vc_column_text][/vc_tta_section][vc_tta_section tab_id="1505813542152-e3b6e8b2-5c1d" title="6000+ Icons"][vc_column_text]Awesome Fonts

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est[/vc_column_text][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

//Tabs and accorditions vc-template
	$data = array();
	$data['name'] = esc_html__( 'Accordions and Toggles', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/tabs/accordions_toggles.png' );
	$data['sort_name'] = 'Tabs';
	$data['custom_class'] = 'general tabs';
	$data['content'] = <<<CONTENT
[vc_row][vc_column][block_title inner_style_title="only_text" title="Accordions & Toggles"]Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/block_title][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_tta_accordion shape="square" color="white" gap="5" active_section="1"][vc_tta_section title="Work with passion" tab_id="1443704609319-a74905bd-533c"][vc_column_text]

We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][vc_tta_section title="Countless Possibilities " tab_id="1443704609469-f7623146-9423"][vc_column_text]

Vivamus eu urna scelerisque, porta tortor nec, cursus nisl. Pellentesque non lacus odio. Quisque a dolor nec ligula. We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][vc_tta_section title="Discover all features" tab_id="1443704783845-1125a043-3381"][vc_column_text]

Vivamus eu urna scelerisque, porta tortor nec, cursus nisl. Pellentesque non lacus odio. Quisque a dolor nec ligula. We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][/vc_tta_accordion][/vc_column][vc_column width="1/2"][vc_tta_accordion shape="square" color="white" spacing="5" c_align="center" c_icon="" active_section="1"][vc_tta_section title="Work with passion" tab_id="1443704847313-67216f28-cf8f"][vc_column_text]

We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][vc_tta_section title="Countless Possibilities " tab_id="1443704847575-84d70df8-f51c"][vc_column_text]

We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][vc_tta_section title="Discover all features" tab_id="1443704847839-6a852ddf-cd20"][vc_column_text]

We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][/vc_tta_accordion][/vc_column][/vc_row][vc_row][vc_column][separator width="1100px" height="2px" position="center" color="#f5f5f5"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_tta_accordion style="modern" shape="round" color="white" gap="5" c_icon="triangle" active_section="1"][vc_tta_section title="Work with passion" tab_id="1505813696885-4430e7c0-3298"][vc_column_text]

We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][vc_tta_section title="Countless Possibilities " tab_id="1505813697192-b9408f17-974d"][vc_column_text]

Vivamus eu urna scelerisque, porta tortor nec, cursus nisl. Pellentesque non lacus odio. Quisque a dolor nec ligula. We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][vc_tta_section title="Discover all features" tab_id="1505813697545-34233364-a0c6"][vc_column_text]

Vivamus eu urna scelerisque, porta tortor nec, cursus nisl. Pellentesque non lacus odio. Quisque a dolor nec ligula. We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][/vc_tta_accordion][/vc_column][vc_column width="1/2"][vc_tta_accordion style="classic" shape="round" color="white" spacing="5" c_align="center" c_icon="" active_section="1"][vc_tta_section title="Work with passion" tab_id="1505813698203-c142004a-2e9c"][vc_column_text]

We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][vc_tta_section title="Countless Possibilities " tab_id="1505813698531-a117537d-41a9"][vc_column_text]

We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][vc_tta_section title="Discover all features" tab_id="1505813698864-666daa05-99d7"][vc_column_text]

We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.

[/vc_column_text][/vc_tta_section][/vc_tta_accordion][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	/*Team sections*/
	//Staff vc-template
	$data = array();
	$data['name'] = esc_html__( 'Staff', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/team/staff.png' );
	$data['sort_name'] = 'Team';
	$data['custom_class'] = 'general team';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="90" bottom_padding="90"][vc_column][block_title inner_style_title="only_text" padding_desc="20%" title="Meet our Team"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua.[/block_title][staff_carousel slide_per_view="4" test_cat="0"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Team Presentation vc-template
	$data = array();
	$data['name'] = esc_html__( 'Team Presentation', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/team/full_team.png' );
	$data['sort_name'] = 'Team';
	$data['custom_class'] = 'general team';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f6f6f6" top_padding="90" bottom_padding="0"][vc_column][block_title inner_style_title="only_text" padding_desc="20%" title="Choose from 2 styles"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua.[/block_title][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#f6f6f6" top_padding="40" bottom_padding="90"][vc_column width="1/3"][staff staff="6765"][/vc_column][vc_column width="1/3"][staff staff="6735"][/vc_column][vc_column width="1/3"][staff staff="6769"][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#f6f6f6" top_padding="40" bottom_padding="90"][vc_column width="1/3"][staff style="style_2" staff="6770"][/vc_column][vc_column width="1/3"][staff style="style_2" staff="6730"][/vc_column][vc_column width="1/3"][staff style="style_2" staff="6745"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;


	/*Testimonials Category*/
	//Testimonials vc-template
	$data = array();
	$data['name'] = esc_html__( 'Single Testimonials', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/testimonials/single_testimonial.png' );
	$data['sort_name'] = 'Testimonials';
	$data['custom_class'] = 'general testimonial';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#ffffff" top_padding="90" bottom_padding="90"][vc_column][block_title inner_style_title="only_text" padding_desc="20%" title="What they say"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua.[/block_title][vc_row_inner][vc_column_inner width="1/3"][single_testimonial testimon="7234"][/vc_column_inner][vc_column_inner width="1/3"][single_testimonial testimon="7237"][/vc_column_inner][vc_column_inner width="1/3"][single_testimonial testimon="7236"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;


	//Testimonials with background vc-template
	$data = array();
	$data['name'] = esc_html__( 'Testimonials with Background', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/testimonials/testimonials_with_background.png' );
	$data['sort_name'] = 'Testimonials with Background';
	$data['custom_class'] = 'general testimonial';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content" type="full_width_background" bg_image="7102" bg_position="center center" parallax_bg="true" bg_color="#ffffff" overlay="true" overlay_color="rgba(0,0,0,0.81)" text_color="light" top_padding="90" bottom_padding="110"][vc_column][block_title inner_style_title="only_text" padding_desc="20%" title="Our Testimonials"][/block_title][testimonial_carousel test_cat="0"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

   //Testimonials Cycle vc-template
	$data = array();
	$data['name'] = esc_html__( 'Testimonials Cycle', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/testimonials/testimonials_cycle.png' );
	$data['sort_name'] = 'Testimonials Cycle';
	$data['custom_class'] = 'general testimonial';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="90" bottom_padding="90"][vc_column width="1/2"][vc_column_text][h2_heading]What clients say about us[/h2_heading]
Extremely versatile theme. Love themes that come with VC composer, and introduced me to some great sliders. I have purchased two copies of it so far, and will again if the project is right! Extremely versatile theme. Love themes that come with VC composer, and introduced me to some great sliders. I have purchased two copies of it so far, and will again if the project is right![/vc_column_text][/vc_column][vc_column width="1/2" enable_animation="true" animation="fadeInRight" background_color_opacity="" background_image="961" delay="100"][testimonial_cycle test_cat="0"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	
	
	//FAQa vc-template
	//FAQs style 1
	$data = array();
	$data['name'] = esc_html__( 'Faq Style 1', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/faq/faq1.png' );
	$data['sort_name'] = 'faq';
	$data['custom_class'] = 'general faq';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="2/3"][faq faq_cat="0"][/vc_column][vc_column width="1/3"][vc_column_text][h3_heading]Where can I find the purchase code?[/h3_heading]

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed elit vitae tortor consequat viverra. Vivamus tempus dui at sodales rutrum. Vivamus tempus dui at sodales rutrum.

[h3_heading]What demo should I install?[/h3_heading]

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed elit vitae tortor consequat viverra. Vivamus tempus dui at sodales rutrum. Vivamus tempus dui at sodales rutrum.

[h3_heading]How many portfolios can I create?[/h3_heading]

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed elit vitae tortor consequat viverra. Vivamus tempus dui at sodales rutrum. Vivamus tempus dui at sodales rutrum.

[h3_heading]Is the theme compatible with WPML?[/h3_heading]

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed elit vitae tortor consequat viverra. Vivamus tempus dui at sodales rutrum. Vivamus tempus dui at sodales rutrum.[/vc_column_text][button title="View Terms and Conditions" icon="moon-info"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

   //FAQs style 2
	$data = array();
	$data['name'] = esc_html__( 'Faq Style 2', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/faq/faq2.png' );
	$data['sort_name'] = 'faq';
	$data['custom_class'] = 'general faq';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" bg_color="#f6f6f6" top_padding="90" bottom_padding="90"][vc_column width="1/2"][vc_custom_heading text="GENERAL QUESTIONS" font_container="tag:h2|font_size:22px|text_align:left|color:%23222222|line_height:40px" google_fonts="font_family:Raleway%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:600%20bold%20regular%3A600%3Anormal"][vc_empty_space height="25px"][faq style="style_2" faq_cat="233"][/vc_column][vc_column width="1/2"][vc_custom_heading text="REGULAR & EXTENDED LICENSES" font_container="tag:h2|font_size:22px|text_align:left|color:%23222222|line_height:40px" google_fonts="font_family:Raleway%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:600%20bold%20regular%3A600%3Anormal"][vc_empty_space height="25px"][faq style="style_3" faq_cat="234"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

   //FAQs style 3
	$data = array();
	$data['name'] = esc_html__( 'Latest Faqs', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/faq/latest_faqs.png' );
	$data['sort_name'] = 'faq';
	$data['custom_class'] = 'general faq';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="1/2"][vc_custom_heading text="General Questions" font_container="tag:h2|font_size:22px|text_align:left|color:%23222222|line_height:40px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_empty_space height="25px"][faq faq_cat="233"][/vc_column][vc_column width="1/2"][vc_custom_heading text="Regular & Extended Licenses" font_container="tag:h2|font_size:22px|text_align:left|color:%23222222|line_height:40px" google_fonts="font_family:Montserrat%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_empty_space height="25px"][faq style="style_2" faq_cat="234"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	/*Shop sections*/
	//Recent Products
	$data = array();
	$data['name'] = esc_html__( 'Recent Products', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/shop/recent_products.png' );
	$data['sort_name'] = 'Shop';
	$data['custom_class'] = 'general shop';
	$data['content'] = <<<CONTENT
[vc_row type="full_width_background" top_padding="90" bottom_padding="40"][vc_column][block_title inner_style_title="only_text" title="Recent Products"]Recently added products[/block_title][recent_products per_page="8" columns="4" orderby="" order=""][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//New Collection
	$data = array();
	$data['name'] = esc_html__( 'New Collection', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/shop/shop_new_collection.png' );
	$data['sort_name'] = 'Shop';
	$data['custom_class'] = 'general shop';
	$data['content'] = <<<CONTENT
[vc_row gap="15" equal_height="yes"][vc_column width="1/4" centered_cont="true" centered_cont_vertical="true" background_image="49" css=".vc_custom_1507199670991{padding-top: 200px !important;padding-right: 80px !important;padding-bottom: 200px !important;padding-left: 80px !important;background-image: url(http://amos.ellethemes.com/store/wp-content/uploads/2017/10/bags.jpg?id=49) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][button title="Bags" align="center"][/vc_column][vc_column width="1/4" css=".vc_custom_1507200227567{padding-top: 200px !important;padding-right: 80px !important;padding-bottom: 200px !important;padding-left: 80px !important;background-image: url(http://amos.ellethemes.com/store/wp-content/uploads/2017/10/shutterstock_667679992-copy.jpg?id=55) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][button title="Accessories" align="center"][/vc_column][vc_column width="1/4" css=".vc_custom_1507199848410{padding-top: 200px !important;padding-right: 80px !important;padding-bottom: 200px !important;padding-left: 80px !important;background-image: url(http://amos.ellethemes.com/store/wp-content/uploads/2017/10/shutterstock_681089491.jpg?id=50) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][button title="Clothes" align="center"][/vc_column][vc_column width="1/4" css=".vc_custom_1507200543506{padding-top: 200px !important;padding-right: 80px !important;padding-bottom: 200px !important;padding-left: 80px !important;background-image: url(http://amos.ellethemes.com/store/wp-content/uploads/2017/10/100044462-copy.jpg?id=59) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][button title="Shoes" align="center"][/vc_column][/vc_row][vc_row type="full_width_background" top_padding="90" bottom_padding="40"][vc_column][block_title inner_style_title="only_text" title="New Collection"]Woman's Wear[/block_title][product_category per_page="8" columns="4" orderby="" order="" category="clothes"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//Testimonials and Instagram
	$data = array();
	$data['name'] = esc_html__( 'Testimonials and Instagram', 'amos' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = preg_replace( '/\s/', '%20',  get_template_directory_uri() . '/ellethemes/img/visual_templates/shop/shop_testimonials_connect.png' );
	$data['sort_name'] = 'Shop';
	$data['custom_class'] = 'general shop';
	$data['content'] = <<<CONTENT
[vc_row][vc_column width="1/2"][vc_empty_space height="70px"][block_title inner_style_title="only_text" title="Testimonials"]Our client's thoughts[/block_title][testimonial_carousel][/vc_column][vc_column width="1/2"][vc_column_text][instagram-feed num=12 cols=4 showheader=false showbutton=false showfollow=false][/vc_column_text][/vc_column][/vc_row][vc_row type="full_width_background" bg_image="7242" bg_position="center center" parallax_bg="true" overlay="true" overlay_color="rgba(28,28,28,0.33)" text_color="light" top_padding="150" bottom_padding="150"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_column_text el_class="subscribe"]
<p style="text-align: center;">[mc4wp_form id="7244"]</p>
[/vc_column_text][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;


	return $templates;
}
<?php
global $amos_redata;

vc_remove_element("vc_button");

vc_remove_element("vc_posts_slider");

vc_remove_element("vc_gmaps");

vc_remove_element("vc_teaser_grid");

vc_remove_element("vc_progress_bar");

//vc_remove_element("vc_facebook");

//vc_remove_element("vc_tweetmeme");

vc_remove_element("vc_googleplus");

//vc_remove_element("vc_facebook");

vc_remove_element("vc_pinterest");

vc_remove_element("vc_message");

vc_remove_element("vc_posts_grid");

vc_remove_element("vc_carousel");

vc_remove_element("vc_flickr");

vc_remove_element("vc_tour");

vc_remove_element("vc_separator");

//vc_remove_element("vc_single_image"); 

vc_remove_element("vc_cta_button");

vc_remove_element("vc_cta_button2");

//vc_remove_element("vc_accordion");

//vc_remove_element("vc_accordion_tab");

vc_remove_element("vc_toggle");



//vc_remove_element("vc_tabs");

//vc_remove_element("vc_tab");

vc_remove_element("vc_images_carousel");

vc_remove_element("vc_wp_archives");

vc_remove_element("vc_wp_calendar");

vc_remove_element("vc_wp_categories");

vc_remove_element("vc_wp_custommenu");

vc_remove_element("vc_wp_links");

vc_remove_element("vc_wp_meta");

vc_remove_element("vc_wp_pages");

vc_remove_element("vc_wp_posts");

vc_remove_element("vc_wp_recentcomments");

vc_remove_element("vc_wp_rss");

vc_remove_element("vc_wp_search");

vc_remove_element("vc_wp_tagcloud");

vc_remove_element("vc_wp_text");

vc_remove_element("vc_pie");



// VC_Row Mods/Additions
vc_remove_param("vc_row", "css");

vc_remove_param("vc_row", "bg_color");

vc_remove_param("vc_row", "font_color");

vc_remove_param("vc_row", "margin_bottom");

vc_remove_param("vc_row", "bg_image");

vc_remove_param("vc_row", "bg_image_repeat");

vc_remove_param("vc_row", "padding");

vc_remove_param("vc_row", "el_class");

//vc_remove_param("vc_text_separator", "el_width");



$portfolio_types = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=portfolio_entries');



$portfolio_terms = array();

if(!empty($portfolio_types)){

  foreach ($portfolio_types as $type) {

    if(isset($type->term_id))

      $portfolio_terms[$type->name] = $type->term_id;

  }

}







$blog_types = get_categories('title_li=&orderby=name&hide_empty=0');



$blog_terms = array();

if(!empty($blog_types)){

  foreach ($blog_types as $type) {

    if(isset($type->term_id))

      $blog_terms[$type->name] = $type->term_id;

  }

}

$args = array( 'posts_per_page' => 9999 );

$blog_posts = get_posts($args);

$post_terms = array();

if(!empty($blog_posts)){

     foreach ( $blog_posts as $posts ):

            if(isset($posts->ID))

                  $post_terms[$posts->post_title] = $posts->ID;
      endforeach;
}


$image_sizes_ = array();
$image_sizes = amos_get_image_sizes();
if(!empty($image_sizes) ){
  foreach ($image_sizes as $key => $value) {
    $image_sizes_[$value['width'].' x '.$value['height']] = $key;
  }
}


$pages_entries = get_pages('title_li=&orderby=name');

$pages = array();



if(!empty($pages_entries) ){

  foreach($pages_entries as $p){

      $pages[$p->post_title] = $p->ID;

  }

}


$posts_entries = get_posts('title_li=&orderby=name');

$posts = array();



if(!empty($posts_entries) ){

  foreach($posts_entries as $p){

      $posts[$p->post_title] = $p->ID;

  }

}




$test_entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=testimonial');

$testimonials = array();



if(!empty($test_entries) ){

  foreach($test_entries as $p){

      $testimonials[$p->post_title] = $p->ID;

  }

}

$staff_entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=staff');

$staff = array();



if(!empty($staff_entries) ){

  foreach($staff_entries as $p){

      $staff[$p->post_title] = $p->ID;

  }

}


$testimonials_cat = array();
$testimonials_cat['Retrive from all categories'] = 0;
$testimonials_cat_term = get_terms('testimonial_entries');

if(!($testimonials_cat_term ))
foreach ($testimonials_cat_term as $term) {
  $testimonials_cat[$term->name] = $term->term_id;
}

$staff_cat = array();
$staff_cat['Retrive from all categories'] = 0;
$staff_cat_term = get_terms('staff_entries');

if(!($staff_cat_term ))
foreach ($staff_cat_term as $term) {
  $staff_cat[$term->name] = $term->term_id;
}

$faq_cat = array();
$faq_cat['Retrive from all categories'] = 0;
$faq_cat_term = get_terms('faq_entries');

foreach ($faq_cat_term as $term) {
  if(is_object($term))
  $faq_cat[$term->name] = $term->term_id;
} 


if(isset($amos_redata['primary_color']))
      $amos_redata['primary_color'];
else
      $amos_redata['primary_color'] = "";    

if(isset($amos_redata['highlighted_background_main']))
      $amos_redata['highlighted_background_main'];
else
      $amos_redata['highlighted_background_main'] = '';



vc_map( array (

  'base' => 'block_title',

  'name' => 'Title Heading',

  'description' => 'Block title heading, section and column',

  'icon' => get_template_directory_uri().'/includes/core/icons/title_heading.png',

  'params' => 

  array (


      array (

      'heading' => 'Type',

      'admin_label' => true,

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => array(

            'Section Title (Centered)' => 'section_title',
            'Column Title (Left Aligned)' => 'column_title' 

      )

    ),

    array (

      'heading' => 'Title',

      'admin_label' => true,

      'param_name' => 'title',

      'type' => 'textfield',

    ),

     array (

      'heading' => 'Second Title',

      'admin_label' => true,

      'param_name' => 'second_title',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'column_title',

        ),
      )

    ),


     array (

      'heading' => 'Style',

      'admin_label' => true,

      'param_name' => 'inner_style',

      'type' => 'dropdown',

      'value' => array(

            'Simple' => 'section_title',
            
            'Creative' => 'inline_border_circle' 

      ),

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'column_title',

        ),
      )

    ),

    array (

      'heading' => 'Style',

      'admin_label' => true,

      'param_name' => 'inner_style_title',

      'type' => 'dropdown',

      'value' => array(

            'Creative' => 'square',

            'Simple Only text' => 'only_text' 

      ),

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'section_title',

        ),
      )

    ), 
    array (

      'heading' => 'Text above title',

      'admin_label' => true,

      'param_name' => 'text_above',

      'type' => 'textfield',

    ),


    array (

      'heading' => 'Description',

      'admin_label' => true,

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'section_title',

        ),
      )

    ),

 
    array (

      'heading' => 'Padding Description',

      'admin_label' => true,

      'param_name' => 'padding_desc',

      'type' => 'textfield',

      'value' => '22%',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'section_title',

        ),
      )

    ),

  ),

  'category' => 'Amos Elements',
));


vc_map( array (

  'base' => 'separator',

  'name' => 'Separator',

  'icon' => get_template_directory_uri().'/includes/core/icons/separator.png',

  'description' => 'Create a custom separator',

  'category' => 'Amos Elements',

  'params' => array (

      array (

            'heading' => 'Width',

            'description' => '',

            'type' => 'textfield',

            'value' => '40px',

            'param_name' => 'width',

          ),

      array (

            'heading' => 'Height',

            'description' => '',

            'type' => 'textfield',

            'value' => '4px',

            'param_name' => 'height',

          ),

       array (

            'heading' => 'Position',

            'param_name' => 'position',

            'type' => 'dropdown',

            'value' => 

            array (

              'Left' => 'left',

              'Center' => 'center',

              'Right' => 'right',

            ),

          ),

      array (
            "type" => "colorpicker",

            "class" => "",

            "heading" => "Color",

            "param_name" => "color",

            "value" => "#222",

            "description" => ""
            ),

      array (

            'heading' => 'Margin Top',

            'description' => '',

            'type' => 'textfield',

            'value' => '0px',

            'param_name' => 'margin_top',

          ),

      array (

            'heading' => 'Margin Bottom',

            'description' => '',

            'type' => 'textfield',

            'value' => '0px',

            'param_name' => 'margin_bottom',

          ),
      )
));

vc_map( array (

  'base' => 'wave_divider',

  'name' => 'Wave Divider Shape',

  'icon' => get_template_directory_uri().'/includes/core/icons/wave_divider.png',

  'description' => 'Add the waves divider shape (MUST select "FullWidth Container" row in row settings)',

  'category' => 'Amos Elements',

  'params' => array (

      array (

            'heading' => 'Width',

            'description' => '',

            'type' => 'textfield',

            'value' => '100%',

            'param_name' => 'width',

          ),

      array (

            'heading' => 'Height',

            'description' => '',

            'type' => 'textfield',

            'value' => '400px',

            'param_name' => 'height',

          ),

       array (

            'heading' => 'Position',

            'param_name' => 'position',

            'type' => 'dropdown',

            'value' => 

            array (

              'Top' => 'top',

              'Bottom' => 'bottom',

            ),

          ),

      array (
            "type" => "colorpicker",

            "class" => "",

            "heading" => "Background Color",

            "param_name" => "color",

            "value" => "#fff",

            "description" => ""
            ),
       array (

            'heading' => 'Wave style',

            'param_name' => 'wave_style',

            'type' => 'dropdown',

            'value' => 

            array (

              'With 3 waves' => 'wave_3',

              'Single wave' => 'normal',

            ),

          ),
      
      )
));

vc_map( array (

  'base' => 'recent_portfolio',

  'name' => 'Recent Portfolio',

  'icon' => get_template_directory_uri().'/includes/core/icons/recent_portfolio.png',

  "description" => __('Show off some recent portfolio', 'amos'),

  'params' => 

  array (


    array (

      'heading' => 'Select the way you want to show the items',

      'admin_label' => true,

      'description' => '',

      'value' => 

      array (

        'Grid' => 'grid',

        'Masonry' => 'masonry',

        'Pinterest' => 'pinterest',
        'Parallax' => 'parallax'


      ),

      'param_name' => 'mode',

      'type' => 'dropdown',

    ),

    array (

      'heading' => 'Portfolio Style',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => 

      array (

        'Overlayed' => 'overlayed',

        'Grayscale' => 'grayscale',

        'Basic' => 'basic',

        'Basic with effect' => 'basic_effect',

        'Wrap with Chrome browser' => 'chrome',

      ),
      'dependency' => 

      array (

        'element' => 'mode',

        'value' => 

        array (

          0 => 'masonry',
          1 => 'pinterest',
          2 => 'grid'

        ),

      ),

    ),





    array (

      'param_name' => 'space',

      'admin_label' => true,

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'normal',

        'No' => 'no_space',

      ),

      'heading' => 'Do you want space beetwen items?',
      'dependency' => 

      array (

        'element' => 'mode',

        'value' => 

        array (

          0 => 'masonry',
          1 => 'pinterest',
          2 => 'grid'

        ),

      ),

    ),

    array (

      'heading' => 'Block Size:',

      'admin_label' => true,

      'description' => 'This mean that if you select 1/4 and you choose a 100% row, should be display 4 items. Be sure that items are in exact proporcion with the column percentage. For example you cant use a 1/4 with 66% column or 1/3 with 75% column ',

      'param_name' => 'columns',

      'type' => 'dropdown',

      'value' => 

      array (

        '1/5' => 5,

        '1/4' => 4,

        '1/3' => 3,

        '1/2' => 2

      ),
      'dependency' => 

      array (

        'element' => 'mode',

        'value' => 

        array (

          0 => 'masonry',
          1 => 'pinterest',
          2 => 'grid'

        ),

      ),

    ),

    array (

      'heading' => 'Portfolio Rows',

      'admin_label' => true,

      'param_name' => 'rows',

      'type' => 'dropdown',

      'value' => 

      array (

        'One Row' => '1',

        'Two Rows' => '2',

        'Three Rows' => '3',

        'Four Rows' => '4',

        'Five Rows' => '5',

      ),
      'dependency' => 

      array (

        'element' => 'mode',

        'value' => 

        array (

          0 => 'masonry',
          1 => 'pinterest',
          2 => 'grid'

        ),

      ),

    ),

    array (

      'heading' => 'With carousel',

      'admin_label' => true,

      'param_name' => 'carousel',

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),
      'dependency' => 

      array (

        'element' => 'rows',

        'value' => 

        array (

          0 => '1',

        ),
        'element' => 'mode',

        'value' => 

        array (

          0 => 'masonry',
          1 => 'pinterest',
          2 => 'grid'

        ),

      ),

    ),


    array (

      'param_name' => 'from_where',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Set featured Portfolio:',

      'value' => 

      array (

        'Show Portfolio from all categories' => 'all_cat',

        'Select a specific Category' => 'cat',

      ),

    ),


    array (

      'param_name' => 'category',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Select the category:',

      'value' => $portfolio_terms,

      'dependency' => 

      array (
  
        'element' => 'from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),

     array (

      'heading' => 'With category filter',

      'admin_label' => true,

      'param_name' => 'with_filter',

      'type' => 'dropdown',

      'value' => 

      array (

        'No' => 'no',

        'Yes' => 'yes'

      ),
      'dependency' => 

      array (

        'element' => 'from_where',

        'value' => 

        array (

          0 => 'all_cat',

        ),
        'element' => 'mode',

        'value' => 

        array (

          0 => 'masonry',
          1 => 'pinterest',
          2 => 'grid'

        ),

      ),

    ),

  ),

  'category' => 'Amos Elements',

));



vc_map( array (

  'base' => 'latest_blog',

  'name' => 'Latest From Blog',

  'icon' => get_template_directory_uri().'/includes/core/icons/latest_blog.png',

  'description' => 'Blog Carousel with 2 styles',

  'params' => 

  array (
 

    array (

      'param_name' => 'dynamic_from_where',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Set Headlines From Blog',

      'value' => 

      array (

        'Show headlines from all categories' => 'all_cat',

        'Select a specific Category' => 'cat',

        'Select a specific post' => 'one_post'

      ),

    ),
    

   array (

      'param_name' => 'post_selected', 

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Select the post:',

      'value' => $post_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'one_post',

        ),

      ),

    ),
 
 

    array (

      'param_name' => 'dynamic_cat',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Select the category:',

      'value' => $blog_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),

    array (

      'heading' => 'With carousel',

      'admin_label' => true,

      'param_name' => 'carousel',

      'type' => 'dropdown', 

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      )

    ),

    array (

      'param_name' => 'style',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Style',

      'value' => 

      array (

        'Simple without box' => 'simple',

        'Boxed and with padding' => 'boxed'

      ),

    ),

    array (

      'param_name' => 'posts_per_page',

      'admin_label' => true,

      'type' => 'textfield',

      'heading' => 'Posts to show (per row)',

      'value' => '3'

    ),

  ),

  'category' => 'Amos Elements',

));

vc_map( array (

  'base' => 'home_blog',

  'name' => 'Full Blog',

  'icon' => get_template_directory_uri().'/includes/core/icons/full_blog.png',

  'description' => 'All blog styles, show as much as you want',

  'params' => 

  array ( 

    array (

      'heading' => 'Style:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'style',

      'value' => 

      array (

        'Normal' => 'index',

        'Second Style' => 'second-style',

        'Masonry' => 'grid',

        'TimeLine' => 'timeline',

      ),

      'type' => 'dropdown',

    ),

    array (

      'heading' => 'Post Numbers',

      'admin_label' => true,

      'description' => '-1 for all',

      'param_name' => 'posts_per_page',

      'value' => '4',

      'type' => 'textfield',

    ),

    array (

      'param_name' => 'dynamic_from_where',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Set Headlines From Blog',

      'value' => 

      array (

        'Show headlines from all categories' => 'all_cat',

        'Select a specific Category' => 'cat',

      ),

    ),


    array (

      'param_name' => 'dynamic_cat',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Select the category:',

      'value' => $blog_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),

  ),

  'category' => 'Amos Elements',

));


vc_map( array (

  'base' => 'recent_news',

  'name' => 'Recent News',

  'icon' => get_template_directory_uri().'/includes/core/icons/recent_news.png',

  'description' => 'Posts as events, inline and thumbnail',

  'params' => 

  array (


    array (

      'heading' => 'Number of posts',

      'admin_label' => true,

      'param_name' => 'posts_per_page',

      'type' => 'textfield',

      'value' => '2',

    ),

    array (

      'param_name' => 'dynamic_from_where',

      'admin_label' => true, 

      'type' => 'dropdown',

      'heading' => 'Set Headlines From Blog',

      'value' => 

      array (

        'Show headlines from all categories' => 'all_cat',

        'Select a specific Category' => 'cat',

      ),

    ),


    array (

      'param_name' => 'dynamic_cat',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Select the category:',

      'value' => $blog_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),

    array (

      'param_name' => 'style',

      'admin_label' => true, 

      'type' => 'dropdown',

      'heading' => 'Style',

      'value' => 

      array (

        'Inline Style Horizontal' => 'inline',

        'Events Style' => 'events',

        'Vertical with thumbnail' => 'vertical'

      ),

    ),
 
  ),

  'category' => 'Amos Elements',

));



vc_map( array (

  'base' => 'textbar',

  'name' => 'Call-to-action',

  'icon' => get_template_directory_uri().'/includes/core/icons/call_to_action.png',

  'description' => 'CTA block with various options',

  'params' => 

  array (

 

    array (

      'heading' => 'Title',

      'admin_label' => true,

      'description' => '',

      'value'   => '',

      'param_name' => 'title',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Style',

      'admin_label' => true,

      'description' => '', 

      'param_name' => 'style',

      'value' => 

      array (

        'All in-line' => 'style_1',

        'Center with button after title' => 'style_2',

      ),

      'type' => 'dropdown',

    ),

    array (

      'heading' => 'Button Bool',

      'admin_label' => true,

      'description' => '',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'param_name' => 'button_bool',

      'type' => 'dropdown',

    ),

 
    array(

       'heading' =>'Font Italic for textbar',
      
       'admin_label' => true,

       'description' => '',

       'value' => 

       array(

         'Yes' => 'yes',

         'No' => 'no',

        ),

        'param_name' => 'font_italic',

        'type' => 'dropdown', 


      ),

    array (

      'heading' => 'Button Title',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button_title',

      'type' => 'textfield',

      'value'   => '',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),

   

    array (

      'heading' => 'Button Link',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button_link',

      'type' => 'textfield',

      'value'   => '#',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),


    array (

      'heading' => 'Select Icon',

      'admin_label' => true,

      'description' => '',

      'type' => 'iconpicker',

      'settings' => array (

        'emptyIcon' => false,

        'type' => 'amosicons',

        'iconsPerpage' => 100,
      ),

      'param_name' => 'icon',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),


  ),

  'category' => 'Amos Elements'

));


vc_map( array (

  'base' => 'services_small',

  'name' => 'Service Small Icon',

  'icon' => get_template_directory_uri().'/includes/core/icons/services_small.png',

  'description' => 'Small icon in the left',

  'params' => 

  array (



    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),



    array (

      'heading' => 'Do you want Icon?',

    

      'description' => '',

      'param_name' => 'icon_bool',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'type' => 'dropdown',

    ),



    array (

      'heading' => 'Select Icon',

      'description' => '',

      'param_name' => 'icon', 

      'type' => 'iconpicker',

      'settings' => array (

        'emptyIcon' => false,

        'type' => 'amosicons',

        'iconsPerpage' => 100,
      ),

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 'yes',             

        array (

           'yes'

        ),

      ),

    ),


    array (

      'heading' => 'Select Style',

      'description' => '',

      'param_name' => 'style',

      'value' => array('Only Icon' => 'style_1', 'With Circle' => 'style_2'),

      'type' => 'dropdown',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

           'yes'

        ),

      ),

    ),

    array (

      'heading' => 'Icon wrapper bg color',

      'admin_label' => true,

      'param_name' => 'color_icon_wr',

      'type' => 'colorpicker', 

      'value' => '#222',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

           'style_2'

        ),

      ),

    ),

    array (

      'heading' => 'Icon color',

      'admin_label' => true,

      'param_name' => 'icon_color',

      'type' => 'colorpicker',

      'value' => $amos_redata['primary_color']

    ),


    array (

   

      'heading' => 'Content Type',

      'description' => 'Select the content type to be used',

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        'Post' => 'post',

        'Page' => 'page',

        'Add Content here' => 'content',

      ),

    ),



    array (

    

      'heading' => 'Select the post',

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        ),

      ),

    ),



    array (

     

      'heading' => 'Select the page',

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page',

        ),

      ),

    ),



    array (

   

      'heading' => 'Content',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'content',

        ),

      ),

    ),



    array (

    

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'content',

        ),

      ),

    ),

    array (

      'heading' => 'Element Alignment',

    

      'description' => '',

      'param_name' => 'align',

      'value' => 

      array (

        'Left' => 'left',

        'Right' => 'right',

      ),

      'type' => 'dropdown',

    ),

  ),

  'category' => 'Amos Elements',

));


vc_map( array (

  'base' => 'services_medium',

  'name' => 'Service Circle Icon',

  'icon' => get_template_directory_uri().'/includes/core/icons/services_circle.png',

  'description' => 'With large icon in top center',

  'params' => 

  array (



    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

    ),

    
    array (

      'heading' => 'Style?',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'style', 

      'value' => 

      array (

        'Circle without border' => 'style_1',

        'Only icon' => 'style_2',

        'With border' => 'style_3' 

      ),

      'type' => 'dropdown'

    ),


    array (

      'heading' => 'Do you want Icon or Image?',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'icon_bool',

      'value' => 

      array (

        'Icon' => 'icon',

        'Image' => 'image',
        
        'SVG' => 'svg'

      ),

      'type' => 'dropdown'

    ),

  


    array (

      'heading' => 'Select Icon',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon',

      'type' => 'iconpicker',

      'settings' => array (

        'emptyIcon' => false,

        'type' => 'amosicons',

        'iconsPerpage' => 100,
      ),


      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

          0 => 'icon',

        )

      )

    ),

    array (

      'heading' => 'Paste SVG',

      'description' => '',

      'param_name' => 'icon_svg', 

      'value' => '', 

      'type' => 'textarea',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

           'svg'

        ),

      ),

    ),

    array (

      'heading' => 'Image:',

      'admin_label' => true,

      'param_name' => 'image',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

          0 => 'image',

        ),

      ),

    ),


    array (

      'heading' => 'Icon color',

      'admin_label' => true,

      'param_name' => 'icon_color',

      'type' => 'colorpicker',

      'value' => $amos_redata['primary_color']

    ),


    array (

      'heading' => 'Circle Color',

      'admin_label' => true,

      'param_name' => 'circle_color',

      'type' => 'colorpicker',

      'value' => $amos_redata['highlighted_background_main']

    ),

    array (

      'heading' => 'Border Color',

      'admin_label' => true,

      'param_name' => 'border_color',

      'type' => 'colorpicker',

      'value' => $amos_redata['primary_color']

    ),


  array (

      'heading' => 'Align',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'align_icon',

      'value' => 

      array (

        'Center' => 'center',

        'Left' => 'left',
        
        'Right' => 'right'

      ),

      'type' => 'dropdown'

    ),

    array (

      'admin_label' => false,

      'heading' => 'Content Type',

      'description' => 'Select the content type to be used',

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        'Add Content here' => 'content',

        'Post' => 'post',

        'Page' => 'page'

        

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the post',

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        )

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the page',

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page'

        )

      )

    ),

  

    array (

      'admin_label' => true,

      'heading' => 'Content',

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          'content'

        ),

      ),

    ),

   

    array (

      'admin_label' => false,

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

           'content'

        )

      )

    )

  ),

  'category' => 'Amos Elements'

));


vc_map( array (

  'base' => 'services_large',

  'name' => 'Service Square',

  'icon' => get_template_directory_uri().'/includes/core/icons/services_square.png',

  'description' => 'With large icon in top center and borders',

  'params' => 

  array (



    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

    ),

    
    array (

      'heading' => 'Style?',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'style', 

      'value' => 

      array (

        'Circle without border' => 'style_1',

        'Only icon' => 'style_2',

        'With border' => 'style_3' 

      ),

      'type' => 'dropdown'

    ),


    array (

      'heading' => 'Do you want Icon or Image?',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'icon_bool',

      'value' => 

      array (

        'Icon' => 'icon',

        'Image' => 'image',
        
        'SVG' => 'svg'

      ),

      'type' => 'dropdown'

    ),

  


    array (

      'heading' => 'Select Icon',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon',

      'type' => 'iconpicker',

      'settings' => array (

        'emptyIcon' => false,

        'type' => 'amosicons',

        'iconsPerpage' => 100,
      ),

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

          0 => 'icon',

        )

      )

    ),

    array (

      'heading' => 'Paste SVG',

      'description' => '',

      'param_name' => 'icon_svg', 

      'value' => '', 

      'type' => 'textarea',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

           'svg'

        ),

      ),

    ),

    array (

      'heading' => 'Image:',

      'admin_label' => true,

      'param_name' => 'image',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

          0 => 'image',

        ),

      ),

    ),


    array (

      'heading' => 'Icon color',

      'admin_label' => true,

      'param_name' => 'icon_color',

      'type' => 'colorpicker',

      'value' => $amos_redata['primary_color']

    ),


    array (

      'heading' => 'Circle Color',

      'admin_label' => true,

      'param_name' => 'circle_color',

      'type' => 'colorpicker',

      'value' => $amos_redata['highlighted_background_main']

    ),

    array (

      'heading' => 'Icon Border Color',

      'admin_label' => true,

      'param_name' => 'border_color',

      'type' => 'colorpicker',

      'value' => $amos_redata['primary_color']

    ),

    array (

      'heading' => 'Box Border Color',

      'admin_label' => true,

      'param_name' => 'box_border_color',

      'type' => 'colorpicker',

      'value' => '#f2f2f2'

    ),

   
    array (

      'admin_label' => false,

      'heading' => 'Content Type',

      'description' => 'Select the content type to be used',

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        'Add Content here' => 'content',

        'Post' => 'post',

        'Page' => 'page'

        

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the post',

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        )

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the page',

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page'

        )

      )

    ),

  

    array (

      'admin_label' => true,

      'heading' => 'Content',

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          'content'

        ),

      ),

    ),

   

    array (

      'admin_label' => false,

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

           'content'

        )

      )

    )

  ),

  'category' => 'Amos Elements'

));


vc_map( array (

  'base' => 'services_text',

  'name' => 'Service Only Text',

  'icon' => get_template_directory_uri().'/includes/core/icons/services_square.png',

  'description' => 'With first character as icon.',

  'params' => 

  array (



    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

    ),

    array (

      'heading' => 'Title 2:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title_2',

      'value' => '',

      'type' => 'textfield'

    ),



    array (

      'admin_label' => true,

      'heading' => 'Content',

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

    ),

   

    array (

      'admin_label' => false,

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

    )

  ),

  'category' => 'Amos Elements'

));

vc_map( array (

  'base' => 'services_steps',

  'name' => 'Service Text Effect',

  'icon' => get_template_directory_uri().'/includes/core/icons/services_text.png',

  'description' => 'When hover title, shows the description',

  'params' => 

  array (



    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

    ),

    array (

      'heading' => 'Select Icon',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon',

      'type' => 'iconpicker',

      'settings' => array (

        'emptyIcon' => false,

        'type' => 'amosicons',

        'iconsPerpage' => 100,
      ),

    ),


    array (

      'admin_label' => true,

      'heading' => 'Content',

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html'

    ),

  ),

  'category' => 'Amos Elements'

));


vc_map( array (

  'base' => 'services_media',

  'name' => 'Service Media',

  'icon' => get_template_directory_uri().'/includes/core/icons/services_media.png',

  'description' => 'Add a service with image or video',

  'params' => 

  array (


    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Type of Media ?',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'type',

      'value' => 

      array (

        'Image' => 'img',

        'Video' => 'video',

      ),

      'type' => 'dropdown',

    ),
 

    array (

      'heading' => 'Upload Photo',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'photo',

      'value' => '',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'img',

        ),

      ),

    ),


    array (

      'heading' => 'Video',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'video',

      'value' => '',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

    ),


    array (

      'heading' => 'Style',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'style', 

      'value' => 

      array (

        'With Title and Description below media' => 'style_1',

        'Title over image' => 'style_2' 

      ),

      'type' => 'dropdown'

    ),

    array(

      'heading' => 'Set a shadow around the services image',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'shadow',

      'type' => 'dropdown',

      'value' => array(

          'Enable' =>'yes',

          'Disable' => 'no'

        ),


      ),

    array (

      'heading' => 'Description',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'content',

      'value' => '',

      'type' => 'textarea_html',

    ),


    array (

      'admin_label' => false,

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'link',

      'type' => 'textfield',

      'value' => '#',

    ),

  ),

  'category' => 'Amos Elements',

));


vc_map( array (

  'base' => 'chart_skill',

  'name' => 'Chart Skill',

  'icon' => get_template_directory_uri().'/includes/core/icons/skills_chart.png',

  'description' => 'Pie Chart skill ',

  'params' => 

  array (

    array (

      'heading' => 'Percentage %',

      'admin_label' => true,

      'param_name' => 'percent',

      'type' => 'textfield',

      'value' => '',

    ),

    array (

      'heading' => 'Title',

      'admin_label' => true,

      'param_name' => 'text',

      'value' => '',

      'type' => 'textfield',

    ),


    array (

      'heading' => 'Color',

      'admin_label' => true,

      'param_name' => 'color',

      'type' => 'colorpicker',

      'value' => 'base',

    ),

    array (

      'heading' => 'Description',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'skill_desc',

       'value' => '', 

      'type' => 'textarea'

    ),

  ),

  'category' => 'Amos Elements',

));

vc_map( array (

  'base' => 'skills',

  'name' => 'Skills',

  'icon' => get_template_directory_uri().'/includes/core/icons/skills.png',

  'description' => 'Progress Bar Skills. Linked with Skill element',

  "content_element" => true,
 
  'is_container' => true,

  "show_settings_on_create" => false,

  'category' => 'Amos Elements',

  'js_view' => 'VcColumnView'

));



vc_map( array (

  'base' => 'skill',

  'name' => 'Skill',

  'icon' => get_template_directory_uri().'/includes/core/icons/skills.png',

  'description' => 'Single skill to be linked with others',

  'as_child' => array('only' => 'skills'),

  'params' => 

  array (



    array (

      'heading' => 'Title',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),



    array (

      'heading' => 'Percentage %',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'percentage',

      'value' => '',

      'type' => 'textfield'

    )

    

  ),

  'category' => 'Amos Elements'

));

vc_map( array (

  'base' => 'single_testimonial',

  'name' => 'Single Testimonial',

  'icon' => get_template_directory_uri().'/includes/core/icons/testimonial.png',

  'description' => 'Testimonial with image in the left',

  'params' => 

  array (

    array (

      'heading' => 'Select testimonial:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'testimon',

      'value' => $testimonials,

      'type' => 'dropdown',

    ),



  ),

  'category' => 'Amos Elements',

));

vc_map( array (

  'base' => 'testimonial_carousel',

  'name' => 'Testimonial (Carousel)',

  'icon' => get_template_directory_uri().'/includes/core/icons/testimonial_carousel.png',

  'description' => 'Without image and so simple',

  "show_settings_on_create" => false,

  'params' => 

  array (

    array (

      'heading' => 'Select Category:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'test_cat',

      'value' => $testimonials_cat,

      'type' => 'dropdown',

    ),

    array (

      'heading' => 'Select styles',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'element_style',

      'value' => 

          array(

            'amos' => 'amos',
            
            'With Background' => 'background',  

          ),

      'type' => 'dropdown',    
    
    ), 

  ),

  'category' => 'Amos Elements',

));

vc_map( array (

  'base' => 'testimonial_cycle',

  'name' => 'Testimonial (Cycle)',

  'icon' => get_template_directory_uri().'/includes/core/icons/testimonial_cycle.png',

  'description' => 'Testimonial business, corporate style, no image',

  'params' => 

  array (

    array (

      'heading' => 'Select Category:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'test_cat',

      'value' => $testimonials_cat,

      'type' => 'dropdown',

    ),



  ),

  "show_settings_on_create" => false, 

  'category' => 'Amos Elements',

));

vc_map( array (

  'base' => 'staff',

  'name' => 'Single Staff',

  'icon' => get_template_directory_uri().'/includes/core/icons/staff_single.png',

  'description' => 'Show one member from staff',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Select Staff Member',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'staff',

      'type' => 'dropdown',

      'value' => $staff,

    ),

    array (

      'heading' => 'Style',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => array('With white box' => 'style_1', 'Simple' => 'style_2'),

    )

  ),

  'category' => 'Amos Elements',

));

vc_map( array (

  'base' => 'staff_carousel',

  'name' => 'Staff Carousel',

  'icon' => get_template_directory_uri().'/includes/core/icons/staff_carousel.png',

  'description' => 'Staff members carousel',

  'params' => 

  array (

    array (

      'heading' => 'Do you want pagination?',

      'admin_label' => false,

      'description' => 'if you active pagination, you have to create a section on top of this section. See the preview About us 2',

      'param_name' => 'pagination',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no'

      ),

      'type' => 'dropdown'

    ),

    array (
      "type" => "textfield",

      "class" => "",

      "heading" => "Slide per view",

      "value" => 4 ,

      "param_name" => "slide_per_view",
      
      "description" => ""
    ),

    array (

      'heading' => 'Select Category:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'test_cat',

      'value' => $staff_cat,

      'type' => 'dropdown',

    )

  ),

  'category' => 'Amos Elements'

));

vc_map( array (

  'base' => 'faq',

  'name' => 'FAQ',

  'icon' => get_template_directory_uri().'/includes/core/icons/faq.png',

  'description' => 'Display FAQ posts',

  'params' => 

  array (

    array (

      'heading' => 'Style',

      'admin_label' => true,

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => 

      array (

        "Title with Background" => "style_1",

        "With circle in left" => "style_2",

        "Simple" => "style_3"

      ),

    ),

    array (

      'heading' => 'Select Category:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'faq_cat',

      'value' => $faq_cat,

      'type' => 'dropdown',

    ),

  ),

  'category' => 'Amos Elements',

));


vc_map( array (

  'base' => 'clients',

  'name' => 'Clients',

  'icon' => get_template_directory_uri().'/includes/core/icons/clients.png',

  'description' => 'Show clients from Theme Options -> Clients',

  'params' => 

  array (

    array (

      'heading' => 'Dark or Light:',

      'admin_label' => true,

      'description' => 'Select the type of client image, light or dark version',

      'param_name' => 'dark_light',

      'value' => array("Dark" => 'dark', 'Light' => 'light'),

      'type' => 'dropdown',

    ),

    array (

      'heading' => 'Carousel',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'carousel',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'type' => 'dropdown',

    ),

  ),

  'category' => 'Amos Elements',

));

vc_map( array (

  'base' => 'price_list',

  'name' => 'Price List',

  'icon' => get_template_directory_uri().'/includes/core/icons/price_list.png',

  'description' => 'Price list is linked with List Item element',

  'as_parent' => array('only' => 'price_list_item'),

   'is_container' => true,

   "content_element" => true,
   
   'js_view' => 'VcColumnView',

  'params' => 


 


  array (


    array (

      'heading' => 'Select Icon',

      'admin_label' => true,

      'description' => '',

      'type' => 'iconpicker',

      'settings' => array (

        'emptyIcon' => false,

        'type' => 'amosicons',

        'iconsPerpage' => 100,
      ),

      'param_name' => 'price_icon'

    ),
    array (

      'heading' => 'Title',

      'admin_label' => true,

      'param_name' => 'title',

      'type' => 'textfield',

      'value' => '',

    ),


    array (

      'heading' => 'Price',

      'admin_label' => true,

      'param_name' => 'price',

      'type' => 'textfield',

      'value' => '55',

    ),


    array (

      'heading' => 'Currency',

      'admin_label' => true,

      'param_name' => 'currency',

      'type' => 'textfield',

      'value' => '$',

    ),


    array (

      'heading' => 'Period',

      'admin_label' => true,

      'param_name' => 'period',

      'type' => 'textfield',

      'value' => 'month',

    ),

    array (

      'heading' => 'Box Color',

      'admin_label' => true,

      'param_name' => 'bg_color', 

      'type' => 'colorpicker',

      'value' => '',

    ),

    array (

     "type" => "dropdown",

      "class" => "",

      "heading" => "Type",

      "param_name" => "type",

      "value" => array(

            "Normal" => "normal",

            "Highlighted" => "highlighted"   

      ),
    ),

    array (

      'heading' => 'Button title',

      'admin_label' => true,

      'param_name' => 'button_title',

      'type' => 'textfield',

      'value' => 'Purchase',

    ),
    array (

      'heading' => 'Button link',

      'admin_label' => true,

      'param_name' => 'button_link',

      'type' => 'textfield',

      'value' => '#',

    ),

  ),

  'category' => 'Amos Elements',

));

vc_map( array (

  'base' => 'price_list_item',

  'name' => 'Price List Item',

  'icon' => get_template_directory_uri().'/includes/core/icons/list_item.png',

  'description' => 'used Price List',

  'as_child' => array("only" => 'price_list'),

  //'content_element' => true,

  'params' => 

  array (
    

    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),   


  ),

  'category' => 'Amos Elements'

));

vc_map( array (

  'base' => 'list_item',

  'name' => 'List Item',

  'icon' => get_template_directory_uri().'/includes/core/icons/list_item.png',

  'description' => 'used in List',

  'as_child' => array("only" => 'list'),

  'content_element' => true,

  'params' => 

  array (
    
    array (

      'heading' => 'Style',

      'admin_label' => true,

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => array(

            'Simple' => 'simple',
            'Title & Description' => 'titledesc' 
      )
    ),

    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),   

    array (

      'heading' => 'Description:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'desc',

      'value' => '',

      'type' => 'textarea',


      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'titledesc',

        ),
      )

    ), 

  ),

  'category' => 'Amos Elements'

));


vc_map( array (

  'base' => 'list',

  'name' => 'List',

  'icon' => get_template_directory_uri().'/includes/core/icons/list.png',

  'description' => 'List with or without description',

  'as_parent' => array('only' => 'list_item'),

  'is_container' => false,

  'category' => 'Amos Elements',

  'js_view' => 'VcColumnView',

  'params' => array (

      array (

            'heading' => 'Select Icon',

            'admin_label' => true,

            'description' => '',

            'type' => 'iconpicker',

            'settings' => array (

              'emptyIcon' => false,

              'type' => 'amosicons',

              'iconsPerpage' => 100,
             ),

            'param_name' => 'icon',

          ),

   )

));



vc_map( array (

  'base' => 'list_item',

  'name' => 'List Item',

  'icon' => get_template_directory_uri().'/includes/core/icons/list_item.png',

  'description' => 'used in List and Price List',

  'as_child' => array('list_item', 'price_list'),

  'content_element' => true,

  'params' => 

  array (
    
    array (

      'heading' => 'Style',

      'admin_label' => true,

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => array(

            'Simple' => 'simple',
            'Title & Description' => 'titledesc' 
      )
    ),

    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),   

    array (

      'heading' => 'Description:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'desc',

      'value' => '',

      'type' => 'textarea',


      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'titledesc',

        ),
      )

    ), 

  ),

  'category' => 'Amos Elements'

));


vc_map( array (

  'base' => 'google_map',

  'name' => 'Google Map',

  'icon' => get_template_directory_uri().'/includes/core/icons/maps.png',

  'description' => 'Create a google map',

  'params' => 

  array (


    array (

      'heading' => 'Source',

      'admin_label' => true,

      'description' => 'Only the link',

      'param_name' => 'dynamic_src',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Map Height (px)',

      'admin_label' => true,

      'description' => '',

      'value' => '150',

      'param_name' => 'height',

      'type' => 'textfield',

    ),

    array(

    'heading' => 'Greyscale effect for the map',

    'admin_label' => true,

    'description' => 'Activate the greyscale mode (black and white)',

    'type' => 'dropdown',

    'param_name' => 'greyscale',

    'value' => 

      array(

        'Enable' => 'yes',

        'Disable' => 'no',

      ),



    ),

    array (

      'heading' => 'Content after the map',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'desc',

      'type' => 'exploded_textarea',

    ),

  ),

  'category' => 'Amos Elements',

));


vc_map( array (

  'base' => 'countdown',

  'name' => 'Countdown',

  'icon' => get_template_directory_uri().'/includes/core/icons/countdown.png',

  'description' => 'Comingsoon countdown',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Year',

      'admin_label' => true,

      'param_name' => 'year',

      'type' => 'textfield',

    ),

    1 => 

    array (

      'heading' => 'Month',

      'admin_label' => true,

      'param_name' => 'month',

      'type' => 'dropdown',

      'value' => 

      array (

        1 => 1,

        2 => 2,

        3 => 3,

        4 => 4,

        5 => 5,

        6 => 6,

        7 => 7,

        8 => 8,

        9 => 9,

        10 => 10,

        11 => 11,

        12 => 12,

      ),

    ),

    2 => 

    array (

      'heading' => 'Day',

      'admin_label' => true,

      'param_name' => 'day',

      'type' => 'textfield',

    ),

  ),

  'category' => 'Amos Elements',

));



vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Type",

  "param_name" => "type",

  "value" => array(

    "In Container" => "in_container",

    "Full Width Background" => "full_width_background",

    "Full Width Content" => "full_width_content"    

  )

));



vc_add_param("vc_row", array(

  "type" => "attach_image",

  "class" => "",

  "heading" => "Background Image",

  "param_name" => "bg_image",

  "value" => "",

  "description" => ""

));



vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Background Position",

  "param_name" => "bg_position",

  "value" => array(

     "Left Top" => "left top",

       "Left Center" => "left center",

       "Left Bottom" => "left bottom",

       "Center Top" => "center top",

       "Center Center" => "center center",

       "Center Bottom" => "center bottom",

       "Right Top" => "right top",

       "Right Center" => "right center",

       "Right Bottom" => "right bottom"

  ),

  "dependency" => Array('element' => "bg_image", 'not_empty' => true)

));



vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Background Repeat",

  "param_name" => "bg_repeat",

  "value" => array(

    "No Repeat" => "no-repeat",

    "Repeat" => "repeat"

  ),

  "dependency" => Array('element' => "bg_image", 'not_empty' => true)

));



vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Parallax Background",

  "value" => array("Enable Parallax Background?" => "true" ),

  "param_name" => "parallax_bg",

  "description" => "",

  "dependency" => Array('element' => "bg_image", 'not_empty' => true)

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Background Color",

  "param_name" => "bg_color",

  "value" => "",

  "description" => ""

));

vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Background Gradient second color (selet a second color if you want gradient background)",

  "param_name" => "bg_color_2",

  "value" => "",

  "description" => ""

));

vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Set the shape you want for your rows",

  "param_name" => "row_shape",

  "value" => array(

    "Normal" => "normal",

    "Polygon" => "polygon",

    "Polygon Upper" => "polygon_upper",

    "Angled" => "angled"
 ),

  "description" =>""

));



vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Overlay",

  "value" => array("Enable a color overlay? " => "true" ),

  "param_name" => "overlay",

  "description" => ""

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Overlay Color",

  "param_name" => "overlay_color",

  "value" => "",

  "description" => "",

  "dependency" => Array('element' => "overlay", 'value' => array('true'))

));





vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Video Background",

  "value" => array("Enable Video Background?" => "use_video" ),

  "param_name" => "video_bg",

  "description" => ""

));







vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "WebM File URL",

  "value" => "",

  "param_name" => "video_webm",

  "description" => "Webm video file url",

  "dependency" => Array('element' => "video_bg", 'value' => array('use_video'))

));



vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "MP4 File URL",

  "value" => "",

  "param_name" => "video_mp4",

  "description" => "Mp4 video file url",

  "dependency" => Array('element' => "video_bg", 'value' => array('use_video'))

));





vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Text Color",

  "param_name" => "text_color",

  "value" => array(

    "Dark" => "dark",

    "Light" => "light",

    "Custom" => "custom"

  )

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Custom Text Color",

  "param_name" => "custom_text_color",

  "value" => "",

  "description" => "",

  "dependency" => Array('element' => "text_color", 'value' => array('custom'))

));





vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Padding Top",

  "value" => "",

  "param_name" => "top_padding",

  "description" => "Without px"

));



vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Padding Bottom",

  "value" => "",

  "param_name" => "bottom_padding",

  "description" => "Without px"

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Transparency Section to be used with Slider",

  "value" => array("Enable Transparency" => true ),

  "param_name" => "transparency",

  "description" => "Check this if you want to use this section as a transparent section on the slider."

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Active Borders",

  "value" => array("Check to active section borders" => true ),

  "param_name" => "borders",

  "description" => "Check this if you want to active the borders top and bottom of this section"

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Active Arrow Bottom",

  "value" => array("Check to active bottom arrow" => true ),

  "param_name" => "arrow_bottom",

  "description" => ""

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Active Arrow Up",

  "value" => array("Check to active top arrow" => true ),

  "param_name" => "arrow_top",

  "description" => ""

));

vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Extra Class Name",

  "param_name" => "class",

  "value" => ""

));

vc_add_param("vc_icon", array(

      'heading' => 'Do you want Icon or SVG?',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon_bool',

      'value' => 

      array (

        'Icon' => 'icon',
        
        'SVG' => 'svg'

      ),

      'type' => 'dropdown'

    ));

vc_add_param("vc_icon", array(

      'type' => 'dropdown',

      'param_name' => 'type',

      "heading" => "Type",

      'value' => array(

        'Font Awesome'=> 'fontawesome',
        'Open Iconic' => 'openiconic',
        'Typicons'  => 'typicons',
        'Entypo'  => 'entypo',
        'Linecons' => 'linecons',
        'Mono Social' => 'monosocial',

      ),

      'dependency' => array (

        'element' => 'icon_bool',

        'value' => 

        array ( 'icon'),

      ),
    
));

vc_add_param("vc_icon", array(

      'heading' => 'Paste SVG',

      'description' => '',

      'param_name' => 'icon_svg', 

      'value' => '', 

      'type' => 'textarea',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

           'svg'

        ),

      ),

    ));



vc_add_param("vc_tta_tabs", array(

      'type' => 'dropdown',
      'param_name' => 'style',
      "heading" => "Style",
      'value' => array(

        'Default' => 'default',
        'Classic'=> 'classic',
        'Modern' => 'modern',
        'Flat'=> 'flat',
         'Outline' => 'outline',
      )
    
));

vc_add_param("vc_tta_accordion", array(

      'type' => 'dropdown',
      'param_name' => 'style',
      "heading" => "Style",
      'value' => array(

        'Default' => 'default',
        'Classic'=> 'classic',
        'Modern' => 'modern',
        'Flat'=> 'flat',
         'Outline' => 'outline',
      )
    
));

vc_add_param("vc_tta_tour", array(

      'type' => 'dropdown',
      'param_name' => 'style',
      "heading" => "Style",

      'value' => array(

        'Default' => 'default',
        'Classic'=> 'classic',
        'Modern' => 'modern',
        'Flat'=> 'flat',
         'Outline' => 'outline',
      )
    
));

vc_add_param("vc_tabs", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Style",

  "param_name" => "style",

  "value" => array(

    "Classic" => "style_2",

    "Modern" => "style_1"

  )

));

vc_add_param("vc_tabs", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Style",

  "param_name" => "style",

  "value" => array(

    "Classic" => "style_2",

    "Modern" => "style_1"

  )

));



vc_add_param("vc_tabs", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Position",

  "param_name" => "position",

  "value" => array(

    "Top" => "top",

    "Left" => "left"

  )

));

vc_add_param("vc_tabs", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Open Tab",

  "param_name" => "open_tab",

  "value" => '1'

));



vc_add_param("vc_accordion", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Style",

  "param_name" => "style",

  "value" => array(

    "With circle in left" => "style_1",

    "Title with Background" => "style_2",

    "Simple" => "style_3"

  )

));



vc_add_param("vc_accordion_tab", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Open?",

  "param_name" => "open",

  "value" => array("Check to make this accordion open" => true ),

));

vc_add_param("vc_column_text", array (

      'heading' => 'Block Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

));

vc_remove_param("vc_tabs", "interval"); 

//vc_remove_param("vc_column_text", "css_animation");

vc_remove_param("vc_accordion", "collapsible");

vc_remove_param("vc_accordion", "interval");

vc_remove_param("vc_accordion", "active_tab");


vc_map( array (

  'base' => 'counter',

  'name' => 'Animated Counter',

  'icon' => get_template_directory_uri().'/includes/core/icons/counter.png',

  'description' => 'Animated counter with Icon in top',

  'params' => 

  array (

    array (

      'heading' => 'Number',

      'admin_label' => true,

      'param_name' => 'number',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Title',

      'admin_label' => true,

      'param_name' => 'text',

      'type' => 'textfield',

      'value' => ''

    ),

    array (

      'heading' => 'Icon',

      'param_name' => 'icon',

      'type' => 'iconpicker',

        'settings' => array (

        'emptyIcon' => false,

        'type' => 'amosicons',

        'iconsPerpage' => 100,
      ),

    ),

  ),

  'category' => 'Amos Elements',

));




vc_map( array (

  'base' => 'media',

  'name' => 'Media',

  'icon' => get_template_directory_uri().'/includes/core/icons/media.png',

  'description' => 'Add Image or Video with custom size',

  'params' => 

  array (


    array (

      'heading' => 'Select type of media:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'type',

      'value' => 

      array (

        'Image' => 'image',

        'Video' => 'video'

      ),

      'type' => 'dropdown',

    ),


    array (

      'heading' => 'Image:',

      'admin_label' => true,

      'param_name' => 'image',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'image',

        ),

      ),

    ),


    array (

      'heading' => 'Video:',

      'admin_label' => false,

      'description' => 'Add Youtibe, Vimeo or Hosted Video(.mp4 or .webm format) links.',

      'param_name' => 'video',

      'type' => 'textfield',

      'value' => 'https://www.youtube.com/watch?v=bTqVqk7FSmY',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

    ),

    array (

      'heading' => 'Featured Image:',

      'admin_label' => false,

      'description' => 'Add feature image for the video media.',

      'param_name' => 'featured_image_video',

      'type' => 'textfield',

      'value' => '',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

    ),


    array (

      'heading' => 'Alignment:',

      'admin_label' => false,

      'param_name' => 'alignment',

      'type' => 'dropdown',

      'value' => 

      array (

        'Left' => 'left',

        'center' => 'center',

        'Right' => 'right',

      ),

    ),


    array (

      'heading' => 'Specify Width (px):',

      'admin_label' => false,

      'param_name' => 'width',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'alignment',

        'value' => 

        array (

          0 => 'center',

        ),

      ),

    ),



    array (

      'heading' => 'Animation',

      'admin_label' => false,

      'param_name' => 'animation',

      'type' => 'dropdown',

      'value' => 

      array (

        'Show From Left' => 'left',

        'Show From Right' => 'right',

        'Show from Top' => 'top',

        'Show From Bottom' => 'bottom',

        'None' => 'none',

      ),

    ),

      array(

      'heading' => 'Set a shadow around the services image',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'shadow',

      'type' => 'dropdown',

      'value' => array(

          'Enable' =>'yes',

          'Disable' => 'no'

        ),


      ),

      array (

      'heading' => 'Video play button align:',

      'admin_label' => false,

      'description' => 'Select the alignment of the video play button.',

      'param_name' => 'button_align',

      'type' => 'dropdown',

      'value' => array(

          'Center' =>'center',

          'Left' => 'left',
          'Right' => 'right'

        ),
      

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

    ),




  ),

  'category' => 'Amos Elements',

));



vc_map( array (

  'base' => 'button',

  'name' => 'Button',

  'icon' => get_template_directory_uri().'/includes/core/icons/button.png',

  'description' => 'Get the styles from theme options.',

  'params' => 

  array (

    
      array (

      'heading' => 'Button Type',

      'admin_label' => false,

      'param_name' => 'btn_type',

      'type' => 'dropdown',

      'value' => 

      array (

        'Default' => 'default',

        'Bordered with effect' => 'bordered_btn',

        'Read More Link' => 'read_more_btn'


      ),

    ),

    array (

      'heading' => 'Title',

      'admin_label' => true,

      'param_name' => 'title',

      'type' => 'textfield',

      'value' => '',

    ),

    array (

      'heading' => 'Link',

      'admin_label' => true,

      'param_name' => 'link',

      'value' => '#',

      'type' => 'textfield'



    ),


    array (

      'heading' => 'Icon',

      'admin_label' => true,

      'param_name' => 'icon',

      'type' => 'iconpicker',

        'settings' => array (

        'emptyIcon' => false,

        'type' => 'amosicons',

        'iconsPerpage' => 100,
      ),

      'dependency' => 

      array (

        'element' => 'btn_type',

        'value' => 'default'

        

      ),

    ),

    array (

      'heading' => 'Align',

      'admin_label' => false,

      'param_name' => 'align',

      'type' => 'dropdown',

      'value' => 

      array (

        'Left' => 'left',

        'Right' => 'right',

        'Center' => 'center'

      ),

    ),

    array (

      'heading' => 'Second Button ?',

      'admin_label' => true,

      'description' => '',

      'value' => 

      array (

        'No' => 'no',

        'Yes' => 'yes',

      ),

      'param_name' => 'button_bool',

      'type' => 'dropdown',

      

    ),

    array (

      'heading' => 'Second Button Type',

      'admin_label' => false,

      'param_name' => 'second_btn_type',

      'type' => 'dropdown',

      'value' => 

      array (

        'Default' => 'default',

        'Bordered with effect' => 'bordered_btn',

        'Read More Link' => 'read_more_btn'


      ),
       'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),

 

    array (

      'heading' => 'Button 2 Title',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button_2_title',

      'type' => 'textfield',

      'value'   => '',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),

   

    array (

      'heading' => 'Button 2 Link',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button_2_link',

      'type' => 'textfield',

      'value'   => '#',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),

  ),

  'category' => 'Amos Elements',

));


vc_remove_param("vc_column", "el_class");

vc_add_param("vc_column", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Do you want animation for this column ?",
      "value" => array("Enable?" => "true" ),
      "param_name" => "enable_animation",
      "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Select Animation",
      "param_name" => "animation",
      "value" => array_flip(amos_animations()),
      "dependency" => Array('element' => "enable_animation", 'not_empty' => true)
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Animation Delay",
      "param_name" => "delay",
      "admin_label" => false,
      "description" => "",
      "dependency" => Array('element' => "enable_animation", 'not_empty' => true)
));

vc_add_param("vc_column", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Centered Content",
      "value" => array("Centered Content Horizontal" => "true" ),
      "param_name" => "centered_cont",
      "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "checkbox",
      "class" => "",  
      "heading" => "Centered Content Vertical",
      "value" => array("Centered Content Vertical" => "true" ),
      "param_name" => "centered_cont_vertical",
      "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Assign Padding to this column",
      "param_name" => "column_padding",
      "value" => '',
      "description" => "Use this in case you have created a full width content row. For ex: 10%"
));


vc_add_param("vc_column", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Background Color",
      "param_name" => "background_color",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Background Color Opacity",
      "param_name" => "background_color_opacity",
      "value" => '1'
      
));

vc_add_param("vc_column", array(
      "type" => "attach_image",
      "class" => "",
      "heading" => "Background Image",
      "param_name" => "background_image",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Font Color",
      "param_name" => "font_color",
      "value" => "",
      "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Extra Class Name",
      "param_name" => "el_class",
      "value" => ""
));

vc_remove_param("vc_column_inner", "el_class");

vc_add_param("vc_column_inner", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Do you want animation for this column ?",
      "value" => array("Enable?" => "true" ),
      "param_name" => "enable_animation",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Select Animation",
      "param_name" => "animation",
      "value" => array_flip(amos_animations()),
      "dependency" => Array('element' => "enable_animation", 'not_empty' => true)
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Animation Delay",
      "param_name" => "delay",
      "admin_label" => false,
      "description" => "",
      "dependency" => Array('element' => "enable_animation", 'not_empty' => true)
));

vc_add_param("vc_column_inner", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Centered Content Horizontal",
      "value" => array("Centered Content Horizontal" => "true" ),
      "param_name" => "centered_cont",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Centered Content Vertical",
      "value" => array("Centered Content Vertical" => "true" ),
      "param_name" => "centered_cont_vertical",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Assign Padding to this column",
      "param_name" => "column_padding",
      "value" => '',
      "description" => "Use this in case you have created a full width content row. For ex: 10%"
));


vc_add_param("vc_column_inner", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Background Color",
      "param_name" => "background_color",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Background Color Opacity",
      "param_name" => "background_color_opacity",
      "value" => '1'
      
));

vc_add_param("vc_column_inner", array(
      "type" => "attach_image",
      "class" => "",
      "heading" => "Background Image",
      "param_name" => "background_image",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column_inner", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Font Color",
      "param_name" => "font_color",
      "value" => "",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Extra Class Name",
      "param_name" => "el_class",
      "value" => ""
));
vc_map( array (

  'base' => 'slideshow',

  'name' => 'Slideshow',

  'icon' => get_template_directory_uri().'/includes/core/icons/slideshow.png',

  'description' => 'Flexslider Slideshow',

  'params' => 

  array (

    array (

      'heading' => 'Select slides',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'slides',

      'type' => 'attach_images'

    ),

    array (
      'heading' => 'Image Size',

      'description' => '',

      'param_name' => 'image_size',

      'type' => 'dropdown',

      'value' => $image_sizes_
    ),

    array(

      'heading' => 'Enable shadow',

      'description' => 'Add shadow for the slider',

      'param_name' => 'shadow',

      'type' => 'dropdown',

      'value' => array(

          'Yes' => 'yes',

          'No' => 'no'

        ), 


      ),

  ),

  'category' => 'Amos Elements',

));
vc_add_param("vc_text_separator", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Element width",

  "param_name" => "el_width",

  "value" => array(

    "100%" => "100",

    "80%" => "80",

    "50%" => "50",

    "30%" => "30",

    "20%" => "20",

    "15%" => "15"      

  )

));

class WPBakeryShortCode_Plain_Text extends WPBakeryShortCode {



}

class WPBakeryShortCode_Separator extends WPBakeryShortCode {



}

class WPBakeryShortCode_Wave_divider extends WPBakeryShortCode {



}



class WPBakeryShortCode_Recent_Portfolio extends WPBakeryShortCode {



}



class WPBakeryShortCode_Recent_News extends WPBakeryShortCode {



}



class WPBakeryShortCode_Latest_Blog extends WPBakeryShortCode {



}



class WPBakeryShortCode_Home_Blog extends WPBakeryShortCode {



}



class WPBakeryShortCode_Faq extends WPBakeryShortCode {



}



class WPBakeryShortCode_Staff extends WPBakeryShortCode {



}



class WPBakeryShortCode_Slideshow extends WPBakeryShortCode {



}



class WPBakeryShortCode_Single_Testimonial extends WPBakeryShortCode {



}

class WPBakeryShortCode_Testimonial_Carousel extends WPBakeryShortCode {



}

class WPBakeryShortCode_Testimonial_Cycle extends WPBakeryShortCode {



}



class WPBakeryShortCode_Clients extends WPBakeryShortCode {



}



class WPBakeryShortCode_Textbar extends WPBakeryShortCode {



}



class WPBakeryShortCode_Services_Small extends WPBakeryShortCode {



}



class WPBakeryShortCode_Services_Medium extends WPBakeryShortCode {



}


class WPBakeryShortCode_Services_Large extends WPBakeryShortCode {



}




class WPBakeryShortCode_Services_Media extends WPBakeryShortCode {



}



class WPBakeryShortCode_Media extends WPBakeryShortCode {



}




class WPBakeryShortCode_Chart_Skill extends WPBakeryShortCode {

           

}



class WPBakeryShortCode_Skills extends WPBakeryShortCodesContainer  {

           

}



class WPBakeryShortCode_Skill extends WPBakeryShortCode {

           

}



class WPBakeryShortCode_List extends WPBakeryShortCodesContainer {

           

}



class WPBakeryShortCode_List_Item extends WPBakeryShortCode {

           

}



class WPBakeryShortCode_Page_Intro extends WPBakeryShortCode {



}


class WPBakeryShortCode_Countdown extends WPBakeryShortCode {



}



class WPBakeryShortCode_Google_Map extends WPBakeryShortCode {



}


class WPBakeryShortCode_Counter extends WPBakeryShortCode {

}

class WPBakeryShortcode_Price_List extends WPBakeryShortCodesContainer{
      
}

class WPBakeryShortcode_Price_List_Item extends WPBakeryShortCode{
      
}




class WPBakeryShortCode_Block_Title extends WPBakeryShortCode {

}

class WPBakeryShortCode_Staff_Carousel extends WPBakeryShortCode {

}

class WPBakeryShortCode_Button extends WPBakeryShortCode {

}

class WPBakeryShortCode_Services_Steps extends WPBakeryShortCode {

}

class WPBakeryShortCode_Services_Text extends WPBakeryShortCode {

}

?>
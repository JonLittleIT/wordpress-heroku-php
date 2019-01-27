<?php 


/**

||-> Shortcode: Featured Product

*/
function modeltheme_shortcode_featured_product($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                       =>'',
            'category_text_color'             =>'',
            'product_name_text_color'         =>'',
            'background_color'                =>'',
            'price_text_color'                =>'',
            'button_background_color1'        =>'',
            'button_background_color2'        =>'',
            'button_text_color'               =>'',
            'button_text_color_hover'         =>'',
            'button_text'                     =>'',
            'select_product'                  =>''
        ), $params ) );
    

    $html = '';

    $html .= '<style type="text/css" scoped>
                .featured_product_shortcode {
                    background-color: '.$background_color.' !important;
                }
                .featured_product_shortcode .featured_product_categories {
                    color: '.$category_text_color.';
                }
                .featured_product_shortcode .featured_product_categories a {
                    color: '.$category_text_color.';
                }
                .featured_product_shortcode .featured_product_name a {
                    color: '.$product_name_text_color.';
                }
                .featured_product_shortcode .featured_product_price span {
                    color: '.$price_text_color.';
                }
                .featured_product_shortcode .featured_product_price del span {
                    color: '.$price_text_color.';
                }
                .featured_product_shortcode .featured_product_price ins span {
                    color: '.$price_text_color.';
                }
                .featured_product_shortcode .featured_product_button {
                    color: '.$button_text_color.';
                }
                .featured_product_shortcode .featured_product_button:hover {
                    color: '.$button_text_color_hover.';
                }
                .featured_product_shortcode .featured_product_button {
                  background: '.esc_attr($button_background_color1).' !important; /* Old browsers */
                  background: -moz-linear-gradient(top, '.esc_attr($button_background_color1).' 0%, '.esc_attr($button_background_color1).' 0%, '.esc_attr($button_background_color1).' 0%, '.esc_attr($button_background_color1).' 0%, '.esc_attr($button_background_color2).' 100%, '.esc_attr($button_background_color2).' 100%, '.esc_attr($button_background_color2).' 100%) !important; /* FF3.6-15 */
                  background: -webkit-linear-gradient(top, '.esc_attr($button_background_color1).' 0%,'.esc_attr($button_background_color1).' 0%,'.esc_attr($button_background_color1).' 0%,'.esc_attr($button_background_color1).' 0%,'.esc_attr($button_background_color2).' 100%,'.esc_attr($button_background_color2).' 100%,'.esc_attr($button_background_color2).' 100%) !important; /* Chrome10-25,Safari5.1-6 */
                  background: linear-gradient(to bottom, '.esc_attr($button_background_color1).' 0%,'.esc_attr($button_background_color1).' 0%,'.esc_attr($button_background_color1).' 0%,'.esc_attr($button_background_color1).' 0%,'.esc_attr($button_background_color2).' 100%,'.esc_attr($button_background_color2).' 100%,'.esc_attr($button_background_color2).' 100%) !important; /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.esc_attr($button_background_color1).', endColorstr='.esc_attr($button_background_color2).',GradientType=0 ) !important; /* IE6-9 */
                  transform: scale(1.0);
                  transition: all 400ms ease-in-out 0s;
                  -ms-transformtransition: all 400ms ease-in-out 0s;
                  -webkit-transformtransition: all 400ms ease-in-out 0s;
                }
                .featured_product_shortcode .featured_product_button {
                  transform: scale(1.03);
                  transition: all 400ms ease-in-out 0s;
                  -ms-transformtransition: all 400ms ease-in-out 0s;
                  -webkit-transformtransition: all 400ms ease-in-out 0s;
                }
              </style>';


    $html .= '<div class="featured_product_shortcode col-md-12 wow '.$animation.'">';
      $args_blogposts = array(
              'posts_per_page'   => 1,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
              ); 

      $blogposts = get_posts($args_blogposts);


      foreach ($blogposts as $blogpost) {
      global $product;
      $product = new WC_Product($select_product);
      $content_post = get_post($select_product);
      $content = $content_post->post_content;
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);


        $html .= '<div class="featured_product_details_holder  col-md-6">';
          $html.='<h5 class="featured_product_categories">'.get_the_term_list( $select_product, 'product_cat', '', ', ' ).'</h5>';
          $html.='<h1 class="featured_product_name">
                    <a href="'.get_permalink($select_product).'">'.get_the_title($select_product).'</a>
                  </h1>';
          $html.='<h2 class="featured_product_price">'.$product->get_price_html().'</h2>';
          $html.='<div class="featured_product_description">'.modeltheme_excerpt_limit($content, 40).' ...'.'</div>';
          // $html.='<a class="featured_product_button" href="'.get_permalink($select_product).'" target="_blank">'.$button_text.'</a>';
          $html.='<a class="featured_product_button" href="'.get_permalink($select_product).'?add-to-cart='.$select_product.'" target="_blank">'.$button_text.'</a>';

        $html .= '</div>';

        $html .= '<div class="featured_product_image_holder col-md-6">';
          if ( has_post_thumbnail( $select_product ) ) {
              $attachment_ids[0] = get_post_thumbnail_id( $select_product );
              $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' );   
              $html.='<img class="featured_product_image" src="'.$attachment[0].'" alt="'.get_the_title($select_product).'" />';
             }
        $html .= '</div>';

      }
    $html .= '</div>';
    return $html;
}
add_shortcode('featured_product', 'modeltheme_shortcode_featured_product');

/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( array(
     "name" => esc_attr__("MT - Featured Product", 'modeltheme'),
     "base" => "featured_product",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Write Product ID", 'modeltheme' ),
          "param_name" => "select_product",
          "value" => "",
          "description" => esc_attr__( "Enter product ID", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Featured product background color", 'modeltheme' ),
          "param_name" => "background_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the background color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product category color", 'modeltheme' ),
          "param_name" => "category_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for categories", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product name color", 'modeltheme' ),
          "param_name" => "product_name_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for product name", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product price color", 'modeltheme' ),
          "param_name" => "price_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for price", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Button text", 'modeltheme' ),
          "param_name" => "button_text",
          "value" => "",
          "description" => esc_attr__( "Enter button text", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 1", 'modeltheme' ),
          "param_name" => "button_background_color1",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -1 for the button", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 2", 'modeltheme' ),
          "param_name" => "button_background_color2",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -2 for the button", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button text color ", 'modeltheme' ),
          "param_name" => "button_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the text color for the button", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button hover text color ", 'modeltheme' ),
          "param_name" => "button_text_color_hover",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the hover text color for the button", 'modeltheme' )
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => 'fadeInLeft',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
      )
  ));
}

?>
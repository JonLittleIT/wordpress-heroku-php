<?php 
/**
||-> Shortcode: Portfolio Grid
*/
function modeltheme_shortcode_portfolio_grid($params, $content) {
    extract( shortcode_atts( 
        array(
            'filters'			            => '',
            'filters_alignment'			  => '',
            'filters_label'           => '',
            'filters_label_all'			  => '',
            'number'                  => '',
            'metas'                   => '',
            'spacing_between_items'   => '',
            'columns'                 => '',
            'order'                 => '',
            'grid_type'                 => ''
        ), $params ) );


    // STARTING HTML
    $html = '';

    // STARTING ISOTOPE FILTERS
    if ($filters && $filters == 'show') {
	    $html .= '<div class="bar '.esc_attr($filters_alignment).'">
      					  <div class="filter">';
      						  if ($filters_label) {
      						  	$html .= '<span class="filter__label">'.esc_attr($filters_label).'</span>';
      						  }

                    if ($filters_label_all) {
                      $filters_all = $filters_label_all;
                    }else{
                      $filters_all = __('All', 'modeltheme');
                    }

                    $args_cats = array (
                        'post_type' => 'portfolio', //your custom post type
                        'taxonomy' => 'portfolios',
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => 1 //shows empty categories
                    );
                    $categories = get_categories( $args_cats );
                    if ($categories) {
                      $html .= '<button class="action filter__item filter__item--selected" data-filter="*">'.esc_attr($filters_all).'</button>';
                      foreach ($categories as $category) {   
                        $html .= '<button class="action filter__item" data-filter=".'.$category->slug.'"><span class="action__text">'.$category->name.'</span></button>';
                      }
                    }

      				$html .= '
      					  </div>
      				  </div>';
    }

    $overlay_class = '';
    if ($grid_type == 'grid_overlay_fancybox') {
      $overlay_class = 'grid_overlay_fancybox_holder';
    }

    $items_styling = '';
    $items_col_class = '';
    if ($spacing_between_items) {
      $items_styling .= 'padding: '.$spacing_between_items.';';
    }
    if ($columns == '1') {
      // $items_styling .= 'width: 100% !important;';
      $items_col_class .= 'cols-desktop-1 cols-tablets-portrait-1 cols-tablets-landscape-1 cols-mobile-1';
    }elseif ($columns == '2') {
      // $items_styling .= 'width: 50% !important;';
      $items_col_class .= 'cols-desktop-2 cols-tablets-portrait-1 cols-tablets-landscape-2 cols-mobile-1';
    }elseif ($columns == '3') {
      // $items_styling .= 'width: 33.33333% !important;';
      $items_col_class .= 'cols-desktop-3 cols-tablets-portrait-1 cols-tablets-landscape-3 cols-mobile-1';
    }elseif ($columns == '4') {
      // $items_styling .= 'width: 25% !important;';
      $items_col_class .= 'cols-desktop-4 cols-tablets-portrait-1 cols-tablets-landscape-3 cols-mobile-1';
    }elseif ($columns == '5') {
      // $items_styling .= 'width: 20% !important;';
      $items_col_class .= 'cols-desktop-5 cols-tablets-portrait-1 cols-tablets-landscape-3 cols-mobile-1';
    }elseif ($columns == '6') {
      // $items_styling .= 'width: 16.66666% !important;';
      $items_col_class .= 'cols-desktop-6 cols-tablets-portrait-1 cols-tablets-landscape-3 cols-mobile-1';
    }else{
      // $items_styling .= 'width: 25% !important;';
      $items_col_class .= 'cols-desktop-4 cols-tablets-portrait-1 cols-tablets-landscape-3 cols-mobile-1';
    }

    // STARTING GRID ELEMENTS
    $html .= '<div class="grid grid--loading mt-grid-portfolio-shortcode '.esc_attr($overlay_class).'">
                <img class="grid__loader" src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'mt-portfolio-grid/images/grid.svg" width="60" alt="" />
                <div class="grid__sizer '.esc_attr($items_col_class).'" style="'.esc_attr($items_styling).'"></div>';

                  // STARTING DBQUERY
                  if ($orderby == 'post_name' || $orderby == 'post_date') {
                    $args_blogposts = array(
                      'posts_per_page'   => -1,
                      'orderby'          => $orderby,
                      'order'            => $order,
                      'post_type'        => 'portfolio',
                      'post_status'      => 'publish' 
                    ); 
                  }else{
                    $args_blogposts = array(
                      'posts_per_page'   => -1,
                      'orderby'          => $orderby,
                      'post_type'        => 'portfolio',
                      'post_status'      => 'publish' 
                    ); 
                  }

                  $blogposts = get_posts($args_blogposts);

                  $i = 0;
                  foreach ($blogposts as $blogpost) {
                    $i++;

                    #metaboxes
                    $metabox_member_phone = get_post_meta( $blogpost->ID, 'smartowl_member_phone', true );

                    #thumbnail
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ),'modeltheme_about_480x600' );
                  
                    $post_terms = '';
                    $terms = get_the_terms( $blogpost->ID, 'portfolios' );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        $draught_links = array();
                        foreach ( $terms as $term ) {
                            $draught_links[] = $term->slug;
                        }
                        $on_draught = join( " ", $draught_links );
                        $post_terms = $on_draught;
                    }


                    $grid_combination = array("1", "10");

                    if (in_array($i, $grid_combination)) {
                        // $html .= '<div style="'.$items_styling.'" class="grid__item grid__item--size-a '.$post_terms.' portfolio-no-'.$i.' id-'.$blogpost->ID.'">';
                        $html .= '<div style="'.esc_attr($items_styling).'" class="grid__item '.esc_attr($items_col_class).' '.esc_attr($post_terms).' mt-portfolio-cols-'.esc_attr($columns).' portfolio-no-'.esc_attr($i).' id-'.$blogpost->ID.'">';
                    }else{
                        $html .= '<div style="'.esc_attr($items_styling).'" class="grid__item '.esc_attr($items_col_class).' '.esc_attr($post_terms).' mt-portfolio-cols-'.esc_attr($columns).' portfolio-no-'.esc_attr($i).' id-'.$blogpost->ID.'">';
                    }


                      if ($grid_type == 'grid_slider') {
                        $html .= '<div class="slider">';
                          $html .= '<div class="slider__item">
                                      <img src="'. esc_url($thumbnail_src[0]) . '" alt="" />
                                    </div>';
                          global  $dynamic_featured_image;
                          $featured_images = $dynamic_featured_image->get_featured_images( $blogpost->ID );

                          //Loop through the image to display your image
                          if( !is_null($featured_images) ){
                              $medias = array();
                              foreach($featured_images as $images){
                                  $attachment_id = $images['attachment_id'];
                                  $medias[] = $attachment_id;
                              }
                              foreach($medias as $media){
                                  $multiple_featured_image1 = wp_get_attachment_url( $media, 'full' );
                                  $html .= '<div class="slider__item"><img src="'.esc_url($multiple_featured_image1).'" alt="" /></div>';
                              }
                          } 
                        $html .= '</div>';

                        // Metas
                        if ($metas && $metas == 'show') {
                          $html .= '<h3 class="post-title">
                                      <a href="'.get_permalink($blogpost->ID).'">'.$blogpost->post_title.'</a>
                                    </h3>';

                          $html .= '<div class="clearfix"></div>';
                          $html .= '<div class="mt-portfolio-metas text-left">';
                            $html .= '<i class="icon-tag"></i>'.get_the_term_list( $blogpost->ID, 'portfolios', '', ', ' );
                          $html .= '</div>';
                        }
                        $html .= '</div>';
                      }elseif ($grid_type == 'grid_overlay_fancybox' || $grid_type == 'grid_clickable_image') {
                          if ($grid_type == 'grid_overlay_fancybox') {
                            $html .= '<a class="'.esc_attr($grid_type).'" href="'. esc_url($thumbnail_src[0]) . '">';
                          }else{
                            $html .= '<a class="'.esc_attr($grid_type).'" href="'.get_permalink($blogpost->ID).'">';
                          }

                          $html .= '<img src="'. esc_url($thumbnail_src[0]) . '" alt="'.get_permalink($blogpost->ID).'" />';
                          $html .= '<div class="mt-portfolio-grid-overlay">';
                            $html .= '<div class="flex">';
                              $html .= '<div class="flex-center">';
                                $html .= '<i class="icon-size-fullscreen icons"></i>';
                              $html .= '</div>';
                            $html .= '</div>';
                          $html .= '</div>';
                        $html .= '</a>';

                        // Metas
                        if ($metas && $metas == 'show') {
                          $html .= '<h3 class="post-title">
                                      <a href="'.get_permalink($blogpost->ID).'">'.$blogpost->post_title.'</a>
                                    </h3>';

                          $html .= '<div class="clearfix"></div>';
                          $html .= '<div class="mt-portfolio-metas text-left">';
                            $html .= '<i class="icon-tag"></i>'.get_the_term_list( $blogpost->ID, 'portfolios', '', ', ' );
                          $html .= '</div>';
                        }
                        $html .= '</div>';
                      }
                                  
                  }

    $html .= '</div>';

    return $html;
}
add_shortcode('mt_portfolio_grid', 'modeltheme_shortcode_portfolio_grid');

/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    plugin_dir_url( dirname( __FILE__ ) ) . '/../vc-shortcodes.inc.arrays.php';

	$post_category_tax = get_terms('category');
	$post_category = array();
	foreach ( $post_category_tax as $term ) {
		$post_category[$term->name] = $term->slug;
	}

    vc_map( array(
     "name" => esc_attr__("MT - Portfolio Grid", 'modeltheme'),
     "base" => "mt_portfolio_grid",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
           "group" => "General",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Grid Type"),
           "param_name" => "grid_type",
           "std" => '',
           "value" => array(
              esc_attr__('Slider on Grid')     => 'grid_slider',
              esc_attr__('Clickable Image')     => 'grid_clickable_image',
              esc_attr__('Overlay + Fancybox')     => 'grid_overlay_fancybox'
           ),
          "description" => esc_attr__( "Show or Hide Portfolio Metas (Title/Category)", 'modeltheme' )
        ),
        array(
          "group" => "General",
          "type" => "textfield",
          "holder" => "div",
          "heading" => esc_attr__( "Spacing Between items", 'modeltheme' ),
          "param_name" => "spacing_between_items",
          "description" => __( "Enter Spacing Between items (<strong>Eg: 15px</strong>)", 'modeltheme' )
        ),
        // array(
        //   "group" => "General",
        //   "type" => "textfield",
        //   "holder" => "div",
        //   "heading" => esc_attr__( "Number of posts", 'modeltheme' ),
        //   "param_name" => "number",
        //   "description" => esc_attr__( "Enter number of blog post to show.", 'modeltheme' )
        // ),
        array(
           "group" => "Metas",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Metas Status"),
           "param_name" => "metas",
           "std" => '',
           "value" => array(
              esc_attr__('Show Metas')     => 'show',
              esc_attr__('Hide Metas')     => 'hide'
           ),
          "description" => esc_attr__( "Show or Hide Portfolio Metas (Title/Category)", 'modeltheme' )
        ),
        array(
           "group" => "General",
           "type" => "dropdown",
           "holder" => "div",
           "heading" => esc_attr__("Items Per Row"),
           "param_name" => "columns",
           "value" => array(
            esc_attr__('Select Columns Per Row')     => '4',
            esc_attr__('1 column')     => '1',
            esc_attr__('2 columns')     => '2',
            esc_attr__('3 columns')     => '3',
            esc_attr__('4 columns')     => '4',
            esc_attr__('5 columns')     => '5',
            esc_attr__('6 columns')     => '6',
           )
        ),
        array(
          "group" => "General",
          "type" => "dropdown",
          "holder" => "div",
          "heading" => esc_attr__("Order By"),
          "param_name" => "orderby",
          "value" => array(
            esc_attr__('Title')     => 'post_name',
            esc_attr__('Date')     => 'post_date',
            esc_attr__('Random')     => 'rand',
            esc_attr__('Relevance')     => 'relevance',
          ),
        ),
        array(
          "group" => "General",
          "type" => "dropdown",
          "holder" => "div",
          "heading" => esc_attr__("Order"),
          "param_name" => "order",
          "value" => array(
            esc_attr__('DESC')     => 'DESC',
            esc_attr__('ASC')     => 'ASC',
          ),
          "dependency" => array(
            'element' => 'orderby',
            'value' => array( 'post_name', 'post_date' ),
          ),
        ),
        array(
           "group" => "Filters",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Filters Status"),
           "param_name" => "filters",
           "std" => '',
           "value" => array(
              esc_attr__('Show Isotope Filters')     => 'show',
              esc_attr__('Hide Isotope Filters')     => 'hide'
           )
        ),
        array(
          "group" => "Filters",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Filters Label", 'modeltheme' ),
          "param_name" => "filters_label",
          "value" => "",
          "description" => esc_attr__( "Enter a Label to be shown in front of the Filters(Eg: Filters: )", 'modeltheme' )
        ),
        array(
          "group" => "Filters",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "'All Filters' Label", 'modeltheme' ),
          "param_name" => "filters_label_all",
          "value" => "",
          "description" => esc_attr__( "Enter a Label 'All Filters' button", 'modeltheme' )
        ),
        array(
           "group" => "Filters",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Filters Alignment"),
           "param_name" => "filters_alignment",
           "std" => '',
           "value" => array(
            esc_attr__('Center')     => 'text-center',
            esc_attr__('Left')     => 'text-left',
            esc_attr__('Right')     => 'text-right',
           )
        ),


        // array(
        //    "type" => "dropdown",
        //    "group" => "Options",
        //    "holder" => "div",
        //    "class" => "",
        //    "heading" => esc_attr__("Select Blog Category"),
        //    "param_name" => "category",
        //    "description" => esc_attr__("Please select blog category"),
        //    "std" => 'Default value',
        //    "value" => $post_category
        // ),

      )
  ));
}

?>
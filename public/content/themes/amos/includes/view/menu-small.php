<?php global $amos_redata; ?>
<?php
class custom_walker_menu_small extends Walker {

  

    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );


    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );


    var $columns = 0;

    var $max_columns = 0;


    var $rows = 1;


    var $rowsCounter = array();


    var $mega_active = 0;


    function start_lvl(&$output, $depth = 0, $args = array() ) {

      $indent = str_repeat("\t", $depth);

      if($depth === 0) $output .= "\n{replace_one}\n";

      $class = '';

      if($depth == 0 && !$this->mega_active)

        $class = 'non_mega_menu';

      

        

      $output .= "\n$indent<ul class=\"sub-menu $class\">\n";

    }


    function end_lvl(&$output, $depth = 0, $args= array()) {

      $indent = str_repeat("\t", $depth);

      $output .= "$indent</ul>\n";

      

      if($depth === 0) 

      {

        if($this->mega_active)

        {



          $output .= "\n</div>\n";


          $output = str_replace("{replace_one}", "<div class='amos_custom_menu_mega_menu amos_mega".$this->max_columns."'>", $output);

          

          foreach($this->rowsCounter as $row => $columns)

          {

            $output = str_replace("{current_row_".$row."}", "simplecustom_menu_columns".$columns, $output);

          }

          

          $this->columns = 0;

          $this->max_columns = 0;

          $this->rowsCounter = array();

          

        }

        else

        {

          $output = str_replace("{replace_one}", "", $output);

        }

      }

    }


    function start_el(&$output, $item, $depth = 0, $args = array(),  $current_object_id = 0) {

      global $wp_query;

      

      //set maxcolumns

      if( is_object($args) && !isset($args->max_columns)) $args->max_columns = 6;



      

      $item_output = $li_text_block_class = $column_class = "";

      
      $bg_img = '';

      if($depth === 0)

      { 

        $this->mega_active = get_post_meta( $item->ID, '_menu-item-custom_amos-megamenu', true);
  
        $bg = get_post_meta( $item->ID, '_menu-item-custom_amos-megamenu_bg', true);

        if(!empty($bg) )
          $bg_img = $bg;  
      }

      

      

      if($depth === 1 && $this->mega_active)

      {

        $this->columns ++;

        

        //check if we have more than $args['max_columns'] columns or if the user wants to start a new row

        if($this->columns > $args->max_columns)

        {

          $this->columns = 1;

          

        }

         

        $this->rowsCounter[$this->rows] = $this->columns;

        

        if($this->max_columns < $this->columns) $this->max_columns = $this->columns;

        

        

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        

        if($title != "-" && $title != '"-"') //fallback for people who copy the description o_O

        {

          $item_output .= "<h6>".$title."</h6>";

        }

        

        $column_class  = ' {current_row_'.$this->rows.'}';

        

        if($this->columns == 1)

        {

          $column_class  .= " amos_custom_menu_first_col";

        }

      }

      

      else

      {

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';

        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';

        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';      

      
        if(is_object($args)){
          $item_output .= $args->before;

          $item_output .= '<a'. $attributes .'>';

          $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

          $item_output .= '</a>';

          $item_output .= $args->after;
        }

      }
      
      

      

      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

      $class_names = $value = '';

  

      $classes = empty( $item->classes ) ? array() : (array) $item->classes;

  

      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

      $class_names = ' class="'.$li_text_block_class. esc_attr( $class_names ) . $column_class.'"';

  

      $output .= $indent . '<li id="responsive-menu-item-'. $item->ID . '"' . $value . $class_names .' data-bg="'.$bg_img.'">';

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }


    function end_el(&$output, $item, $depth = 0, $args= array()) {

      $output .= "</li>\n";

    }

}
?>
<div class="row-fluid">
  <div class="menu-small">
    
    <?php
      $menu_name = 'main';
      
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ]) && !is_null($locations[$menu_name]) && $locations[$menu_name] != null ) {
        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<ul class="menu mobile-menu">';

        foreach ( (array) $menu_items as $key => $menu_item ) {

            $title = $menu_item->title;
            $url = $menu_item->url;
            $menu_list .= '<li><a href="' . esc_url($url) . '">' . $title . '</a></li>';
        }
        $menu_list .= '</ul>';
        } else {
        
        $menu_list = '<ul><li>Menu "' . esc_attr($menu_name) . '" not defined.</li></ul>';
        } 
        
        if($amos_redata['menu_presets'] != 'h5'):
          $args = array("theme_location" => "main", "menu_id" => 'mobile-menu', "container" => false, 'walker'  => new custom_walker_menu_small()); 
          wp_nav_menu($args); 
        else:
          $args = array("theme_location" => "left", "menu_id" => 'mobile-menu', "container" => false, 'walker'  => new custom_walker_menu_small()); 
          wp_nav_menu($args); 

          $args = array("theme_location" => "right", "menu_id" => 'mobile-menu', "container" => false,  'walker'  => new custom_walker_menu_small()); 
          wp_nav_menu($args);  
        endif;
        
    ?>
    
  </div> 
</div>
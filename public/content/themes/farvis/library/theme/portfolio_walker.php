<?php 

class farvis_Portfolio_Walker extends Walker_Category {
   function start_el(&$output, $category,  $depth=0, $args=array(),  $id=0) {
		extract($args);
 		
		$cat_name = esc_attr( $category->name );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		$link = '<a class="btn" ';
		
		
		$class = $category->slug;
		if ( !empty($current_category) ) {
			$_current_category = get_term( $current_category, $category->taxonomy );
			if ( $category->term_id == $current_category )
				$class .=  ' active';
			elseif ( $category->term_id == $_current_category->parent )
				$class .=  ' current-cat-parent';
		}
		$link .= 'data-filter=".'.strtolower($class).' "';
		
		
		$link .= '>';
		$link .= $cat_name . '<i class="fa fa-angle-down"></i></a>';
		$output .= "\t$link\n";
		
	}
}
     
	 
class farvis_Portfolio_Walker2 extends Walker_Category {
    function start_el(&$output, $category,  $depth=0, $args=array(),  $id=0) {
		extract($args);
 		
		$cat_name = esc_attr( $category->name );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		$link = '<a href="'.esc_attr(get_term_link($category->slug, 'portfolio_category')).' " ';
	
		
		$dataoption = $category->slug;
		$class = '';
		if ( !empty($current_category) ) {
			$_current_category = get_term( $current_category, $category->taxonomy );
			if ( $category->term_id == $current_category )
				$class .=  'active';
			elseif ( $category->term_id == $_current_category->parent )
				$class .=  ' current-cat-parent';
		}
		$link .=  ' class="'.esc_attr($class).'"';
		
		
		$link .= '>';
		$link .= $cat_name . '</a>';
		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$output .= ">$link\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}
}   


class farvis_Isotope_Category_Walker extends Walker_Category {
	 public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
            $cat_name = apply_filters(
                    'list_cats',
                esc_attr( $category->name ),
                    $category
            );

            $link = '<a href="#" data-filter=".'.esc_attr($category->slug).'"';
            if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
                    /**
                 * Filter the category description for display.
                     *
                     * @since 1.2.0
                 *
                     * @param string $description Category description.
                     * @param object $category    Category object.
                 */
                $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        }

        $link .= '>';
        $link .= $cat_name . '</a>';
        if ( 'list' == $args['style'] ) {
                $output .= "\t<li";
                $class = 'cat-item cat-item-' . esc_attr($category->term_id);
                if ( ! empty( $args['current_category'] ) ) {
                        $_current_category = get_term( $args['current_category'], $category->taxonomy );
                        if ( $category->term_id == $args['current_category'] ) {
                                $class .=  ' current-cat';
                        } elseif ( $category->term_id == $_current_category->parent ) {
                                $class .=  ' current-cat-parent';
                        }
                }
                $output .=  ' class="' . esc_attr($class) . '"';
                $output .= ">$link\n";
        } else {
                $output .= "\t$link<br />\n";
        }
	}
}         

?>
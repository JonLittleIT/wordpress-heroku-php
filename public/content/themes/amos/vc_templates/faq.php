<?php		
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * @var $faq_cat
 * Shortcode class
 * @var $this WPBakeryShortCode_Faq
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
	$output = '<div class="">';
        if($faq_cat == 0){
            $args = array(
                'taxonomy'  => 'faq_entries',
                'hide_empty'=> 0
            );

            $categories = get_categories($args);


	



             if(count($categories) > 0 && $faq_cat == 0){

                $output .='<!-- Portfolio Filter --><nav id="faq-filter" class="">';
                   $output .= '<ul class="">';
                     $output .= '<li class="active all"><a href="#"  data-filter="*">'.__('View All', 'amos').'</a><span></span></li>';
                        
                    foreach($categories as $cat):
                        
                           $output .= '<li class="other"><a href="#" data-filter=".'.esc_attr($cat->category_nicename).'">'.esc_attr($cat->cat_name).'</a><span></span></li>';    
                        
                    endforeach;
                    
                    $output .='</ul>';
                $output .= '</nav>';
           }
        }
       $nr = rand(0, 5000);
       
    $output .= '<div class="accordion faq '.esc_attr($style).'" id="accordion'.esc_attr($nr).'">';
       if((int) $faq_cat == 0)
            $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'faq' );                          
        else{
            $query_post = array('posts_per_page'=> 9999, 
                                'post_type'=> 'faq',
                                'tax_query' => array(   array(  'taxonomy'  => 'faq_entries', 
                                                                                    'field'     => 'id', 
                                                                                    'terms'     =>  $faq_cat,  
                                                                                    'operator'  => 'IN')) );
        }
	$i = 0;
       $loop = new WP_Query($query_post);
       if($loop->have_posts()){
            while($loop->have_posts()){
                $i++;
                $loop->the_post();
                $sort_classes = "";
                $item_categories = get_the_terms( get_the_ID(), 'faq_entries' );
            
                if(is_object($item_categories) || is_array($item_categories))
                {
                    foreach ($item_categories as $cat)
                    {
                        $sort_classes .= $cat->slug.' ';
                    }
                }
                   
                    $output .= '<div class="accordion-group '.esc_attr($sort_classes).'">';
                        $output .= '<div class="accordion-heading '.( ($i == 1)?'in_head':'' ).'">';
                        $id = rand(0, 50000);
                            $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.esc_attr($nr).'" href="#toggle'.esc_attr($id).'">';
                                $output .= get_the_title();
                            $output .= '</a>';
                        $output .= '</div>';
                        $output .= '<div id="toggle'.esc_attr($id).'" class="accordion-body '.( ($i == 1)?'in':'' ).' collapse ">';
                            $output .= '<div class="accordion-inner">';
                                $output .= get_the_content();
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                
                


            }

        }
        $output .= '</div>';
        
        $output .= '</div>';
        echo amos_output($output);
?>
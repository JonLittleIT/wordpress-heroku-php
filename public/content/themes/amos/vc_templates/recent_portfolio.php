<?php
 /**
 * Shortcode attributes
 * @var $atts
 * @var $from_where
 * @var $category
 * @var $dynamic_cat
 * @var $mode
 * @var $columns
 * @var $style
 * @var $space
 * @var $rows
 * @var $carousel
 * @var $with_filter
 * @var $pagination
 * Shortcode class
 * @var  WPBakeryShortCode_Recent_Portfolio
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

ob_start();

global $amos_redata;    

        $output = '<div class="recent_portfolio wpb_content_element">';
     
        if(!isset($rows))

          $rows = 1;
        

        $grid = 'three-cols';

        switch($columns){

            case '3':

                $grid = 'three-cols';

                break;

            case '2':

                $grid = 'two-cols';

                break;

            case '4':

                $grid = 'four-cols';

                break;

            case '5':

                $grid = 'five-cols';

                break;
        }

        $posts_per_page = 9999;

        if($rows == 1){

            if($carousel == 'yes' || $pagination == 'yes')
                $coe = 9999;
            else
                $coe = (int) $columns;

        }else{

            $coe = $columns*(int)$rows; 

        }

        if($from_where == 'all_cat'){

            $query_post = array('posts_per_page'=> $coe, 'post_type'=> 'portfolio' );

        }else{

           $category = get_term($category, "portfolio_entries");

           $query_post = array('posts_per_page'=> $coe, 'post_type'=> 'portfolio',  'taxonomy' => 'portfolio_entries', 'portfolio_entries' => $category->slug );

        }

       query_posts($query_post);

        global $used_for_element;

        $used_for_element['style'] = $style;
        $used_for_element['columns'] = $columns;
        $used_for_element['carousel'] = $carousel;
        
        if(!empty($pagination))
            $used_for_element['pagination'] = $pagination;


        if($mode== 'parallax')
        $carousel == 'no';
        ?>

        <?php if($with_filter == 'yes'): ?>
        <!-- Portfolio Filter -->
                    <?php $output .= '<nav id="portfolio-filter" class="control '.$amos_redata['filter_align'].'">
                        <ul class="">
                            <li class="filter active all" data-filter="all"><a href="#" onclick="return false;" class="filter active" data-filter="all">';
                            $output .= 'View All';
                            $output .= '</a></li>';
                          
                            $category = get_terms('portfolio_entries'); 
                           

                           foreach($category as $cat): ?>
                               
                                <?php  if(is_object($cat)): ?>
                                <?php $output .= '<li class="other filter"  data-filter=".'. esc_attr($cat->slug) .'"><a href="#" onclick="return false;" class="filter" data-filter=".'. esc_attr($cat->slug) .'">'. esc_html($cat->name) .'</a></li>';?>
                            <?php endif; ?>
                            <?php  endforeach; ?>
                        <?php $output .= '</ul>';?>
                    <?php $output .= '</nav>';?>
        <?php endif;?>    

                    <?php
        $output .= '<section id="portfolio-preview-items" class="row '.esc_attr($space).' '.esc_attr($mode).' '.esc_attr($grid).'" data-cols="'.esc_attr($columns).'">';?>

        <?php if($with_filter == 'yes'): ?>
        <?php $output .= '<div class="filterable row">';?>
        <?php endif;?>


        <?php if($rows == 1 && $carousel == 'yes' && $mode != 'parallax'){ 

            $output .= '<div class="portfolio_carousel owl-carousel owl-theme"  data-carousel="true" data-slidenr="'.esc_attr($columns).'">'; 

         

        }


        if($mode == 'grid') 
                
            get_template_part('includes/view/portfolio/loop', 'grid');

        else if($mode == 'masonry')
            
            get_template_part('includes/view/portfolio/loop', 'masonry');

        else if($mode == 'pinterest')
            
            get_template_part('includes/view/portfolio/loop', 'pinterest');

        else if($mode == 'parallax')
            
            get_template_part('includes/view/portfolio/loop', 'parallax');
                        
        wp_reset_query();

        

        $output .= ob_get_clean();

        if($rows == 1 && $carousel == 'yes' && $mode != 'parallax'){  
        $output .= '</div>'; 
        
         }?>
        
        <?php if($with_filter == 'yes'): ?>
        <?php $output .= '</div>'; ?>
        <?php endif;?>
        <?php $output .= '</section>';

         

        wp_reset_postdata();

        $output .= '</div>';


        echo amos_output($output);


?>
<?php

class amos_slideshow{
    
    
    var $slides = array();
    var $post_id;
    var $slide_number;
    var $slide_type;
    var $slide_options = array();
    var $custom_header_html = "";
    var $custom_footer_html = "";
    var $slide_ul_class = "";
    var $slide_container_class = "";
    var $slide_element_class = ""; 
    var $before_render_media = "";
    var $after_render_media = "";
    var $before_elements = "";
    var $after_elements = "";
    var $slide_container_id = "";
    var $media_img_data = array();
    var $before_container_html = "";
    var $after_container_html = "";
    var $additional_attr = "";
    var $layout = "";
    var $ex_style = '';
    var $img_size = array('width'=>940,'height'=>600);

    function __construct($post_id = false, $slide_type = ""){
        global $amos_redata;

        if(!$post_id) 
            $post_id = amos_get_post_id();
        if(!$post_id) 
            return false;

        $this->post_id = $post_id;
        if(isset($amos_redata['gallery']) && $amos_redata['gallery'])
            $this->slides = $amos_redata['gallery'];
        if(isset($amos_redata['slider_type']) && $amos_redata['slider_type'])
            $this->slide_type = $amos_redata['slider_type'];

        if($slide_type != ""){
            $this->slide_type = $slide_type;
        }
        if(isset($amos_redata['slider_layout']) && $amos_redata['slider_layout'])
             $this->options['slideshow_layout'] = $amos_redata['slider_layout'];

        if($this->slide_type == 'amos_news'){
            $this->options['featured_1'] = $amos_redata['amos_news_featured_1'];
            $this->options['featured_2'] = $amos_redata['amos_news_featured_2'];
        }

        $this->slide_number = $this->slidecount();
        if($this->slide_number)
            $this->media_img_data = array_fill(0, $this->slide_number+1, "");
        if($this->slide_type == "")
            return false;
        if($this->slide_type != 'layerslider' && $this->slide_type != 'revolution' && $this->slide_type != 'amos' && $this->slide_type != '' && $this->slide_type != 'none' )
            $this->{$this->slide_type}();
        else{
            $this->options['layer_slider_id'] = is_numeric($amos_redata['layerslider'])+1;
            $this->slide_number = 5;
            $this->options['revolution_alias'] = $amos_redata['revslider'];
            $this->options['amos_slider_id'] = $amos_redata['amos_slider'];
        }
        if($this->slide_number == 0)
            return false;
        
            
        return true;
        
    }
    

    function setCustomHeaderHtml($html = ""){
        $this->custom_header_html = $html;
    }
    
    function slidecount(){
        if(is_array($this->slides))
            return count($this->slides);
        return 0;
    }

    function display($force_display = false){
        if($this->slide_type == 'flexslider')
            return $this->render_slideshow();
        elseif($this->slide_type == 'layerslider')
            return $this->layerslider();
        elseif($this->slide_type == 'revolution')
            return $this->revolution();
        elseif($this->slide_type == 'amos')
            return $this->simple();
        elseif($this->slide_type == 'amos_news')
            return $this->amos_news();
        elseif($this->slide_type == 'gallery_carousel')
            return $this->gallery_carousel();
    }
    

    function render_slideshow(){
        if(post_password_required($this->post_id)){ return false; }
        $output = "";
        $i = 0;
        $output .= $this->before_container_html;
        if($this->slide_number){
        
            $output .= '<div class="slideshow_container '.esc_attr($this->slide_container_class).' slide_layout_'.esc_attr($this->options['slideshow_layout']).'" id="'.esc_attr($this->slide_container_id).'flex" '.esc_attr($this->additional_attr).'>';
            $output .= $this->custom_header_html;
            $output .= '    <ul class="'.esc_attr($this->slide_ul_class).' slide_'.esc_attr($this->slide_type).'">';
            $output .= $this->before_elements;
            if(is_array($this->slides) || is_object($this->slides)){
                foreach($this->slides as $slide):
                    
                    $i++;
                    $image = "";
                    if(!empty($slide['attachment_id']))
                    {   
                        $m_d = '';
                        if(isset($this->media_img_data[$i]) && !empty($this->media_img_data[$i]))
                            $m_d = $this->media_img_data[$i];
                        $image_string = amos_image_by_id($slide['attachment_id'], $this->img_size, 'image', $m_d); 
                        if(!$image_string) $image_string = $slide['attachment_id'];
                        if(isset($slide['url']) && $slide['url'] != 'http://')
                        {
                            $image = "<a href='".esc_url($slide['url'])."'>".$image_string."</a>";
                        }else
                            $image = $image_string;
                    }
                    
                    $output .= "<li class='".esc_attr($this->slide_element_class)." slide_element slide".$i." frame".$i."'>";
                        if(!is_array($this->before_render_media))
                            $output .=           $this->before_render_media;
                        else
                            $output .=           $this->before_render_media[$i];
                        $output .=           $image;
                        $output .=           $this->after_render_media;
                        if(isset($slide['title']) && strlen($slide['title']) > 1){
                            $output .= $this->after_render_media; $output .= '<div class="captionss">';
                   $output .= '<p class="flex-caption" data-effect-in="fadeInLeft" data-effect-out="fadeOutRight"><span>'.esc_attr($slide['title']).'</span></p>';
                               if(isset($slide['description']) && strlen($slide['description']) > 1)
                    $output .= '<p class="flex-caption" data-effect-in="fadeInLeft" data-effect-out="fadeOutRight"><span>'.esc_attr($slide['description']).'</span></p>';
                   $output .='</div>';
                }
                    $output .= "        </li>";
                    
                
                
                
                endforeach;
            }
                
            $output .= $this->after_elements;
            $output .= "    </ul>";
            $output .= $this->custom_footer_html;
           
            $output .= "</div>";
            $output .= $this->after_container_html;
            
        }
        return $output;
        
    }
    

    function flexslider(){
        $this->slide_container_class = 'flexslider';
        $this->slide_ul_class = "slides";     
    }

    function layerslider(){
       return do_shortcode('[layerslider id="'.$this->options['layer_slider_id'].'"]');
    }
 
    function revolution(){
    
       return do_shortcode('[rev_slider '.$this->options['revolution_alias'].']');
    }

    function simple(){
        if(class_exists('AmosSlider')){
            if(!empty($this->options['amos_slider_id'])){
                $slider = new AmosSlider($this->options['amos_slider_id']);
                $slider->output();
            }    
        }
    }

    function amos_news(){
        $output = '<div class="amos_news_slider">';    
            $output .= '<div class="amos_slider_swiper">';
                $output .= '<div class="amos_slider_wrapper">';
                    $output .= '<div class="amos-slider-container swiper-parent swiper_slider amos_slider"  data-slidenumber="1">';
                        $output .= '<div class="pagination-parent nav-simple nav-slider">
                                        <a class="prev" href="">
                                            <span class="icon-wrap"><i class="linea-arrows-left"></i></span>
                                            <div class="text">'.__('PREV','amos').'</div>
                                        </a>
                                        <a class="next" href="">
                                            <span class="icon-wrap"><i class="linea-arrows-right"></i></span>
                                            <div class="text">'.__('NEXT','amos').'</div>
                                        </a>
                                    </div>';
                        $output .= '<div class="swiper-wrapper">';
                            
                            $args = array(
                                'post__not_in' => array($this->options['featured_1'], $this->options['featured_2']),
                                'orderby' => 'date',
                                'posts_per_page' => 5
                            );

                            $query_args = new WP_Query($args);

                            if ($query_args->have_posts()) :

                                while ($query_args->have_posts()) : $query_args->the_post();

                                    $output .= '<div class="swiper-slide" style="background-image:url('.esc_url(amos_image_by_id(get_post_thumbnail_id(), '', 'url')).');">';
                                        $output .= '<div class="overlay"></div>';
                                        $output .= '<h1 class="animated with_animation" data-animation="fadeInUp"><a href="'.get_permalink().'">'.get_the_title().'</a></h1>';
                                        $output .= '<p>'.amos_text_limit(get_the_content(), 16).'</p>';
                                    $output .= '</div>';

                                endwhile;

                            endif;

                            wp_reset_postdata();

                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="featured_posts">';
                $args1 = array(
                    'post__in' => array($this->options['featured_1'], $this->options['featured_2'])
                );
                
                $query_second = new WP_Query($args1);

                if ($query_second->have_posts()) :

                    while ($query_second->have_posts()) : $query_second->the_post();

                        $id = get_the_ID();

                        $output .= '<div class="featured" style="background-image:url('.esc_url(amos_image_by_id(get_post_thumbnail_id(), 'amos_staff', 'url')).');">';
                            $output .= '<div class="overlay"></div>';
                            $output .= '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
                            $output .= '<p>'.amos_text_limit(get_the_content(), 12).'</p>';
                        $output .= '</div>';
                        

                    endwhile;

                endif;

                wp_reset_postdata();
                
            $output .= '</div>'; 
        $output .= '</div>';

        return $output;
    }
    
    function gallery_carousel(){
        global $amos_redata;
        $output = '';
        if(isset($amos_redata['amos_slider_height']) && $amos_redata['amos_slider_height'] != '100%')
            $height = $amos_redata['amos_slider_height'];
        elseif(! isset($amos_redata['amos_slider_height']))
            $height = '450';
        else
            $height = 'fullscreen';
        $output .= '<div class="amos_gallery_carousel '.esc_attr($amos_redata['gallery_effect']).'" data-height="'.esc_attr($height).'" style="'.(($height == 'fullscreen')?'':'height:'.esc_attr($height).'px').'">';
            $output .= '<div class="loading"><i class="moon-spinner icon-spin"></i></div>';
            $output .= '<div class="amos_slider_swiper">';
                $output .= '<div class="amos_slider_wrapper">';
                    $output .= '<div class="amos-slider-container swiper-parent swiper_slider amos_swiper_gallery">';
                        $output .= '<div class="pagination-parent nav-simple nav-slider">
                                        <a class="prev" href="">
                                            <span class="icon-wrap"><span></span></span>
                                            <div class="text">'.__('PREV','amos').'</div>
                                        </a>
                                        <a class="next" href="">
                                            <span class="icon-wrap"><span></span></span>
                                            <div class="text">'.__('NEXT','amos').'</div>
                                        </a>
                                    </div>';
                        $output .= '<div class="swiper-wrapper">'; 
                        
                        if($this->slide_number){
                            
                            foreach($this->slides as $slide):

                                if(!empty($slide['attachment_id'])){
                                    $image = wp_get_attachment_image_src( $slide['attachment_id'], array('3000', '3000') );
                                    if(!isset($ex_style))
                                        $ex_style = "";
                                    $output .= '<div class="swiper-slide" '.$ex_style.'>';
                                    
                                        $output .= '<a href="'.esc_url($slide['url']).'"><img src="'.esc_url($image[0]).'"   /></a>';
                                        $output .= '<div class="info">';
                                            $output .= '<h3>'.$slide['title'].'</h3>';
                                            $output .= '<p>'.$slide['description'].'</p>';
                                        $output .= '</div>'; 
                                    $output .= '</div>';
                                }

                            endforeach;

                        }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>'; 
            $output .= '</div>';   
        $output .= '</div>';

        return $output;
    }
    
}





?>
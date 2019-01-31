<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $slides
 * @var $image_size
 * Shortcode class
 * @var  WPBakeryShortCode_Slideshow
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


    if($shadow == 'yes')
        $add_shadow = 'shadow_box';

    $output = '<div class="slideshow '.$add_shadow.' wpb_content_element">';
        $slides = explode(',', $slides);
       
        $slides_ = array();

        if(count($slides) > 0):
            foreach($slides as $s):
                $slides_[] = array('attachment_id' => $s);
            endforeach;
        
            $slide = new amos_slideshow(false, 'flexslider');
            $slide->slide_number = count($slides);
            $slide->img_size = $image_size;
            $slide->slides = $slides_;
            $output .= $slide->display();
        endif;

    $output .= '</div>';

    echo amos_output($output);
?>
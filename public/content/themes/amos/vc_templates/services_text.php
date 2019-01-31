<?php        
 /**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $title_2
 * @var $content
 * @var $dynamic_content_link
 * Shortcode class
 * @var  WPBakeryShortCode_Services_Text
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


        $output = '<div class=" services_text wpb_content_element">';
        $output .= '<span class="icon"><span class="first_letter">'.esc_html(substr($title, 0, 1)).'</span></span>';
            $output .= '<span class="divider"><span class="line"></span></span>';
            $output .= '<div class="content">';
            if($dynamic_content_link && $dynamic_content_link != '#')
            	$output .= '<h4><a href="'.esc_html($dynamic_content_link).'">'.esc_html($title).'</a></h4>';
            else
                $output .= '<h4>'.esc_html($title).'</h4>';

                $output .= '<div class="title_2">'.esc_html($title_2).'</div>';
                $output .= '<p>'.do_shortcode($content).'</p>';
            $output .= '</div>';
        $output .= '</div>';
        echo amos_output($output);
?>
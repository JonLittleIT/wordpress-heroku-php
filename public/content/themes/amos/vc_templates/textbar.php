<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $icon
 * @var $button_bool
 * @var $button_title
 * @var $button_link
 * @var $style
 * @var $extra_class
 * @var $font_italic
 * Shortcode class
 * @var  WPBakeryShortCode_Textbar
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

        global $amos_redata;
        $output = '<div class="textbar '.esc_attr($style).' wpb_content_element ">';
        if ($font_italic == 'yes')
            $italic = 'class="ital"';
        $output .= '<h2 '.$font_italic.'>'.do_shortcode($title).'</h2>';
        if(isset($button_bool) && $button_bool == 'yes')
            $output .= '<a href="'.esc_url($button_link).'" class="btn-bt '.esc_attr($amos_redata['overall_button_style'][0]).'"><span>'.esc_attr($button_title).'</span>';
		
		if($icon != '')
		$output .= '<i class="'.esc_attr($icon).'"></i>';

		$output .= '</a>';
        $output .= '</div>';
        echo amos_output( $output );

?>
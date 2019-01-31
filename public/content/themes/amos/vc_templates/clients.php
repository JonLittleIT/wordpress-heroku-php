<?php

global $amos_redata;
 /**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $carousel
 * @var $dark_light
 * Shortcode class
 * @var $this WPBakeryShortCode_Client
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

	if(!isset($carousel))
        $carousel = 'no';

    $clients = array();

    if($dark_light == 'dark')
        $clients = $amos_redata['clients_dark'];
    else
        $clients = $amos_redata['clients_light'];


    $output = '<div class="'.esc_attr($dark_light).'_clients clients_el">';
     /*if($carousel == 'yes')
            $output .= '<div class="pagination"><a href="#" class="prev"><i class="lnr lnr-chevron-left"></i></a><a href="#" class="next"><i class="lnr lnr-chevron-right"></i></a></div>';
    */
       
        $output .= '<section class="row clients '.(($carousel=="yes")?"clients_caro owl-carousel owl-theme":"").'" >';

                    foreach($clients as $client):                            

                            $output .= '<div class="item">';

                                $output .= '<a href="'.esc_url($client['url']).'" title="'.esc_attr($client['title']).'">';

                                $output .= wp_get_attachment_image( $client['attachment_id'], 'full' );

                                $output .= '</a>';

                            $output .= '</div>';

                    endforeach;

        $output .= '</section>';

    $output .= '</div>';

    echo amos_output($output);
?>
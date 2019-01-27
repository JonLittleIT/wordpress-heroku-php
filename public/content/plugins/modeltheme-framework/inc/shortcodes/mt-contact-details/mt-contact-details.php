<?php

/**

||-> Shortcode: Contact Details

*/
function modeltheme_shortcode_contact_details($params, $content) {
    extract( shortcode_atts( 
        array(
            'contact_details_background_color'  => '',
            'contact_details_text_color'        => '',
            'contact_address'                   => '',
            'contact_phone'                     => '',
            'contact_email'                     => '',
            'option1_social_icon'               => '',
            'option1_social_link'               => '',
            'option2_social_icon'               => '',
            'option2_social_link'               => '',
            'option3_social_icon'               => '',
            'option3_social_link'               => '',
            'option4_social_icon'               => '',
            'option4_social_link'               => ''

        ), $params ) );
    $html = '';

    
	    $html .= '<div class="row contact_details_container_shortcode" style="background-color: '.$contact_details_background_color.'; color: '.$contact_details_text_color.';">';
		  		$html .= '<div class="container">';

			  		$html .= '<div class="vc_col-md-3 text-center contact_details_address">';
				  		$html .= '<h5 class="contact_details_address_title">Address</h5>';
				  		$html .= '<p class="contact_details_address_content" style="color: '.$contact_details_text_color.';">'.$contact_address.'</p>';
			  		$html .= '</div>';
			  		$html .= '<div class="vc_col-md-3 text-center contact_details_phone">';
				  		$html .= '<h5 class="contact_details_phone_title">Phone</h5>';
				  		$html .= '<p class="contact_details_phone_content" style="color: '.$contact_details_text_color.';">'.$contact_phone.'</p>';
			  		$html .= '</div>';
			  		$html .= '<div class="vc_col-md-3 text-center contact_details_email">';
				  		$html .= '<h5 class="contact_details_email_title">Email</h5>';
				  		$html .= '<p class="contact_details_email_content" style="color: '.$contact_details_text_color.';">'.$contact_email.'</p>';
			  		$html .= '</div>';
			  		$html .= '<div class="vc_col-md-3 text-center contact_details_social">';
				  		$html .= '<h5 class="contact_details_social_title">Social Media</h5>';

				  		$html .= '<ul class="contact_social-links">';
						if ( isset($option1_social_icon) && $option1_social_link != '' ) {
						    $html .= '<li><a href="'.$option1_social_link.'" class="contact_details_social_option1"><i class="'.$option1_social_icon.'" style="color: '.$contact_details_text_color.';"></i></a></li>';
						}
						if ( isset($option2_social_icon) && $option2_social_link != '' ) {
						    $html .= '<li><a href="'.$option2_social_link.'" class="contact_details_social_option2"><i class="'.$option2_social_icon.'" style="color: '.$contact_details_text_color.';"></i></a></li>';
						}
						if ( isset($option3_social_icon) && $option3_social_link != '' ) {
						    $html .= '<li><a href="'.$option3_social_link.'" class="contact_details_social_option3"><i class="'.$option3_social_icon.'" style="color: '.$contact_details_text_color.';"></i></a></li>';
						}
						if ( isset($option4_social_icon) && $option4_social_link != '' ) {
						    $html .= '<li><a href="'.$option4_social_link.'" class="contact_details_social_option4"><i class="'.$option4_social_icon.'" style="color: '.$contact_details_text_color.';"></i></a></li>';
						}
						$html .= '</ul>';
			  		$html .= '</div>';

		  		$html .= '</div>';

	    $html .= '</div>';
	    
    return $html;
}
add_shortcode('contact_details', 'modeltheme_shortcode_contact_details');



/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {


    #Social Media list
	$social_media_list = array(
	  'fa fa-facebook'  => 'fa fa-facebook',
	  'fa fa-twitter'   => 'fa fa-twitter',
	  'fa fa-pinterest' => 'fa fa-pinterest',
	  'fa fa-youtube'   => 'fa fa-youtube',
	  'fa fa-google'    => 'fa fa-google',
	  'fa fa-linkedin'  => 'fa fa-linkedin'

	);

    vc_map( 
        array(
            "name" => esc_attr__("MT - Contact Details", 'modeltheme'),
            "base" => "contact_details",
            "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
            "icon" => "smartowl_shortcode",
            "params" => array(
                array(
                   "group" => "Options",
                   "type" => "textfield",
                   "holder" => "div",
                   "class" => "",
                   "heading" => esc_attr__("Enter address: ", 'modeltheme'),
                   "param_name" => "contact_address",
                   "value" => "",
                   "description" => ""
                ),
                array(
                   "group" => "Options",
                   "type" => "textfield",
                   "holder" => "div",
                   "class" => "",
                   "heading" => esc_attr__("Enter phone: ", 'modeltheme'),
                   "param_name" => "contact_phone",
                   "value" => "",
                   "description" => ""
                ),
                array(
                   "group" => "Options",
                   "type" => "textfield",
                   "holder" => "div",
                   "class" => "",
                   "heading" => esc_attr__("Enter email: ", 'modeltheme'),
                   "param_name" => "contact_email",
                   "value" => "",
                   "description" => ""
                ),
                array(
                  "group" => "Options",
		          "type" => "dropdown",
		          "heading" => esc_attr__("Social icon", 'modeltheme'),
		          "param_name" => "option1_social_icon",
		          "std" => ' ',
		          "holder" => "div",
		          "class" => "",
		          "description" => "",
		          "value" => $social_media_list
		        ),
		        array(
		           "group" => "Options",
                   "type" => "textfield",
                   "holder" => "div",
                   "class" => "",
                   "heading" => esc_attr__("Enter link for option 1: ", 'modeltheme'),
                   "param_name" => "option1_social_link",
                   "value" => "",
                   "description" => ""
                ),
		        array(
		          "group" => "Options",
		          "type" => "dropdown",
		          "heading" => esc_attr__("Social icon", 'modeltheme'),
		          "param_name" => "option2_social_icon",
		          "std" => ' ',
		          "holder" => "div",
		          "class" => "",
		          "description" => "",
		          "value" => $social_media_list
		        ),
		        array(
		           "group" => "Options",
                   "type" => "textfield",
                   "holder" => "div",
                   "class" => "",
                   "heading" => esc_attr__("Enter link for option 2: ", 'modeltheme'),
                   "param_name" => "option2_social_link",
                   "value" => "",
                   "description" => ""
                ),
		        array(
		          "group" => "Options",
		          "type" => "dropdown",
		          "heading" => esc_attr__("Social icon", 'modeltheme'),
		          "param_name" => "option3_social_icon",
		          "std" => ' ',
		          "holder" => "div",
		          "class" => "",
		          "description" => "",
		          "value" => $social_media_list
		        ),
		        array(
		           "group" => "Options",
                   "type" => "textfield",
                   "holder" => "div",
                   "class" => "",
                   "heading" => esc_attr__("Enter link for option 3: ", 'modeltheme'),
                   "param_name" => "option3_social_link",
                   "value" => "",
                   "description" => ""
                ),
		        array(
		          "group" => "Options",
		          "type" => "dropdown",
		          "heading" => esc_attr__("Social icon", 'modeltheme'),
		          "param_name" => "option4_social_icon",
		          "std" => ' ',
		          "holder" => "div",
		          "class" => "",
		          "description" => "",
		          "value" => $social_media_list
		        ),
		        array(
		           "group" => "Options",
                   "type" => "textfield",
                   "holder" => "div",
                   "class" => "",
                   "heading" => esc_attr__("Enter link for option 4: ", 'modeltheme'),
                   "param_name" => "option4_social_link",
                   "value" => "",
                   "description" => ""
                ),
                array(
                  "group" => "Styling",
		          "type" => "colorpicker",
		          "class" => "",
		          "heading" => esc_attr__( "Background color for this section", 'modeltheme' ),
		          "param_name" => "contact_details_background_color",
		          "value" => '', //Default color
		          "description" => esc_attr__( "Choose background color for this section", 'modeltheme' )
		        ),
		        array(
		          "group" => "Styling",
		          "type" => "colorpicker",
		          "class" => "",
		          "heading" => esc_attr__( "Text color for this section", 'modeltheme' ),
		          "param_name" => "contact_details_text_color",
		          "value" => '', //Default color
		          "description" => esc_attr__( "Choose text color for this section", 'modeltheme' )
		        )
            ))
    );
}

?>
<?php

/**

||-> Shortcode: Contact Form01

*/
function modeltheme_shortcode_contact01($params, $content) {

    extract( shortcode_atts( 
        array(
            'animation'                 => '',
            'contact_button_color'      => '',
            'contact_button_background' => ''
        ), $params ) );

    global $eaglewp_redux;
    
    $html = '';
        $html .= '<form method="POST" class="row wow '.$animation.'" id="contact01_form" novalidate="novalidate">';
          $html .= '<div class="content">';

            $html .= '<div class="vc_col-md-12 first_set_inputs">';

              #First Name
              $html .= '<div class="first_name_input">';
                $html .= '<span class="input input--kohana">';
                  $html .= '<label for="input-4" class="input__label input__label--kohana">';
                    $html .= '<i class="fa fa-user icon icon--kohana"></i>';
                    $html .= '<span class="input__label-content input__label-content--kohana">First Name</span>';
                  $html .= '</label>';
                  $html .= '<input autocomplete="off" type="text" id="input-4" class="input__field input__field--kohana" name="user_first_name">';
                $html .= '</span>';
              $html .= '</div>';

              

              #Last Name
              $html .= '<div class="last_name_input">';
                $html .= '<span class="input input--kohana">';
                  $html .= '<label for="input-8" class="input__label input__label--kohana">';
                    $html .= '<i class="fa fa fa-user icon icon--kohana"></i>';
                    $html .= '<span class="input__label-content input__label-content--kohana">Last Name</span>';
                  $html .= '</label>';
                  $html .= '<input autocomplete="off" type="text" id="input-8" class="input__field input__field--kohana" name="user_last_name">';
                $html .= '</span>';
              $html .= '</div>';



              #Email Address
              $html .= '<div class="email_input">';
                $html .= '<span class="input input--kohana">';
                  $html .= '<label for="input-5" class="input__label input__label--kohana">';
                    $html .= '<i class="fa fa-envelope icon icon--kohana"></i>';
                    $html .= '<span class="input__label-content input__label-content--kohana">Email Address</span>';
                  $html .= '</label>';
                  $html .= '<input autocomplete="off" type="email" id="input-5" class="input__field input__field--kohana" name="user_email">';
                $html .= '</span>';
              $html .= '</div>';


              #Subject
                $html .= '<div class="subject_input">';
                  $html .= '<span class="input input--kohana">';
                    $html .= '<label for="input-6" class="input__label input__label--kohana">';
                      $html .= '<i class="fa fa-pencil-square-o icon icon--kohana"></i>';
                      $html .= '<span class="input__label-content input__label-content--kohana">Subject</span>';
                    $html .= '</label>';
                    $html .= '<input autocomplete="off" type="text" id="input-6" class="input__field input__field--kohana" name="user_subject">';
                  $html .= '</span>';
                $html .= '</div>';



              #Message
              $html .= '<div class="message_input">';
                $html .= '<span class="input input--kohana">';
                  $html .= '<label for="input-7" class="input__label textarea__label input__label--kohana textarea__label--kohana">';
                    $html .= '<i class="fa fa-comments icon icon--kohana"></i>';
                    $html .= '<span class="input__label-content input__label-content--kohana">Message</span>';
                  $html .= '</label>';
                  $html .= '<input autocomplete="off" type="text" id="input-7" class="input__field textarea__field input__field--kohana textarea__field--kohana" name="user_message">';
                $html .= '</span>';
              $html .= '</div>';

            $html .= '</div>';




            

              $html .= '<div class="vc_col-md-3 contact_button text-center">';
                  $html .= '
                  
                  <button name="contact_me" type="submit" class="contact_us_button_class vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-custom" style="background-color:'.$contact_button_background.'; color:'.$contact_button_color.';">Send</button>';

              $html .= '</div>';
          $html .= '</div>';

          if (isset($_POST['contact_me'])) {
            $to = $eaglewp_redux['mt_contact_email'];
            $form_user_first_name = $_POST['user_first_name'];
            $form_user_last_name = $_POST['user_last_name'];
            $form_user_email = $_POST['user_email'];
            $form_subject = $_POST['user_subject'];
            $form_comment = $_POST['user_message'];
            $message = '';
            $message .= "From: " .  $form_user_first_name . $form_user_last_name . "\r\n";
            $message .= "Email: " . $form_user_email . "\r\n" . "\r\n";
            $message .= $form_comment . "\r\n";
            $message .= $form_subject . "\r\n";
            $headers = 'From: ' . $form_user_first_name . $form_user_last_name . '<'. $form_user_email . '>';
            if( mail( $to, $form_subject, $message, $headers ) ) {
                $html .= "<p class='text-center' style='color: #fff; margin-top:15px;'>Your email has been sent! Thank you!</p>";
            }else{
                $html .= "<p class='text-center' style='color: #fff; margin-top:15px;'>Your mail was not sent! Sorry about that!</p>";
            }
          }

        // $html .= '<div class="success_message alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><a href="#" class="alert-link">'.__('Thank you! We\'ll get back to you as soon as possible.','modeltheme').'</a></div>';
        $html .= '</form>';
    return $html;
}
add_shortcode('shortcode_contact01', 'modeltheme_shortcode_contact01');



/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( array(
     "name" => esc_attr__("MT - Contact", 'modeltheme'),
     "base" => "shortcode_contact01",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Contact button background", 'modeltheme' ),
          "param_name" => "contact_button_background",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose contact button background", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Contact button color", 'modeltheme' ),
          "param_name" => "contact_button_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose contact button color", 'modeltheme' )
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
      )
    ));
}

?>
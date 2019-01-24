<?php if(!empty($settings->enable_form)): ?>
<?php 
$subscribe_callback_ajax_url = html_entity_decode(wp_nonce_url(admin_url().'admin-ajax.php?action=seed_cspv5_subscribe_callback','seed_cspv5_subscribe_callback')); 
$ref='';



// Get form settings
$form_settings_name = 'seed_cspv5_'.$page_id.'_form';
$form_settings = get_option($form_settings_name);
if(!empty($form_settings)){
    $form_settings = maybe_unserialize($form_settings);
}



?>
<?php if($settings->emaillist == 'feedburner'){
			//  Emaillist Settings
	        $settings_name = 'seed_cspv5_'.$settings->page_id.'_'.$settings->emaillist;
	        $e_settings = get_option($settings_name);
	        $e_settings = maybe_unserialize($e_settings);
	        extract($e_settings);
			$output .= '<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri='.esc_attr($feedburner_addr).'\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true">';
			$output .= '<input type="hidden" value="'.esc_attr($feedburner_addr).'" name="uri"/>';
			$output .= '<input type="hidden" name="loc" value="'.esc_attr($feedburner_local).'"/>';
			// Output form fields
			$output .= '<div id="cspio-field-wrapper">';
			$output .= '<div class="row">';
			if(1 == 0){
				$output .= '<div class="col-md-12"><div class="input-group"><input id="cspio-email" name="email" class="form-control input-lg form-el" type="text" placeholder="'.esc_attr($settings->txt_email_field).'"/>';
				$output .= '<span class="input-group-btn"><button id="cspio-subscribe-btn" type="submit" class="btn btn-lg btn-primary">'.esc_html($settings->txt_subscribe_button).'</button></span></div></div>';
			}else{
				$output .= '<div class="col-md-12 seperate"><div class="input-group"><input id="cspio-email" name="email" class="form-control input-lg form-el" type="text" placeholder="'.esc_attr($settings->txt_email_field).'"/>';
				$output .= '<span class="input-group-btn"><button id="cspio-subscribe-btn" type="submit" class="btn btn-lg btn-primary">'.esc_html($settings->txt_subscribe_button).'</button></span></div></div>';
			}
			$output .= '</div>';

			$output .= '</div>';
			$output .= '</form>';
			echo $output;
}elseif($settings->emaillist == 'gravityforms'){
				//  Emaillist Settings
	        $settings_name = 'seed_cspv5_'.$settings->page_id.'_'.$settings->emaillist;
	        $e_settings = get_option($settings_name);
	        $e_settings = maybe_unserialize($e_settings);
	        extract($e_settings);
			if(class_exists('RGFormsModel')){
				if(!empty($gravityforms_form_id)){
				ob_start();
				gravity_form($gravityforms_form_id, false, false, false, '', apply_filters('seed_cspv5_gf_ajax', false));
				$dump = ob_get_contents();
				ob_end_clean();

				$output = $dump;
				echo $output;
				}
			}
}elseif($settings->emaillist == 'ninjaforms'){
					//  Emaillist Settings
	        $settings_name = 'seed_cspv5_'.$settings->page_id.'_'.$settings->emaillist;
	        $e_settings = get_option($settings_name);
	        $e_settings = maybe_unserialize($e_settings);
	        extract($e_settings);
			if(class_exists('Ninja_Forms')){
				if(!empty($ninjaforms_form_id)){
				ob_start();
				Ninja_Forms()->display( $ninjaforms_form_id );
				$dump = ob_get_contents();
				ob_end_clean();

				$output = $dump;
				echo $output;
				}
			}
}elseif($settings->emaillist == 'mymail'){
				//  Emaillist Settings
	        $settings_name = 'seed_cspv5_'.$settings->page_id.'_'.$settings->emaillist;
	        $e_settings = get_option($settings_name);
	        $e_settings = maybe_unserialize($e_settings);
	        extract($e_settings);
	         $output = '';
		    if(class_exists('mymail')){
		        if(!empty($mymail_form_id)){
		            $output = mymail_form($mymail_form_id, 100, true);
		        }else{
		            $output = mymail_form(0, 100, false);
		        }
		    }elseif(class_exists('mailster')){
	        	$form = mailster( 'form' )->id( $mymail_form_id );
				$output = $form->render( false );
		    }
		    echo $output;

}elseif($settings->emaillist == 'htmlwebform'){
				//  Emaillist Settings
	        $settings_name = 'seed_cspv5_'.$settings->page_id.'_'.$settings->emaillist;
	        $e_settings = get_option($settings_name);
	        $e_settings = maybe_unserialize($e_settings);
	        extract($e_settings);

		if(!empty($html_integration)){
				$html_integration = do_shortcode($html_integration);
			echo  $html_integration;
		}
}else{ ?>
<form id="cspio-form" action="<?php echo 'test'; ?>" method="post">
<input id="cspio-ref" name="ref" type="hidden" value="" />
<input id="cspio-href" name="href" type="hidden" value="" />
<input id="cspio-lang" name="lang" type="hidden" value="<?php echo (isset($_GET['lang']))? $_GET['lang']:'' ?>" />
<input id="cspio-page_id" name="page_id" type="hidden" value="<?php echo $page->id; ?>" />
<input id="cspio-comment" name="comment" type="hidden" value="" />
			<?php
				$alert = '';
				if(!empty($seed_cspio_post_result['msg'])){
					$alert = $seed_cspio_post_result['msg'];
				}
				$class = '';
				if(!empty($seed_cspio_post_result['msg_class'])){
					$class = $seed_cspio_post_result['msg_class'];
				}
				if(!empty($alert)){
					$output .= '<div id="cspio-alert" class="alert '.$class.'">'.$alert.'</div>';
				}
			?>
		
			<div id="cspio-field-wrapper">

			<div class="row">

			<?php if(!empty($settings->enable_recaptcha)){ ?>
				<div class="col-md-12">
					<!-- Recaptcha -->
					<p>
					<div class="g-recaptcha" data-sitekey="<?php echo $settings->recaptcha_site_key ?>"></div>
					</p>
				</div>
			<?php } ?>



			<?php 
			if(empty($form_settings)){ 
			?>
			    <?php if(!empty($settings->display_name) && $settings->display_name == '1'){ ?>
					<div class="col-md-12"><input id="cspio-name" name="name" class="form-control input-lg form-el" type="text" placeholder="<?php echo esc_attr($settings->txt_name_field); ?>"/></div>
				<?php } ?>
			<?php } ?>

			<?php 
				//if(seed_cspv5_cu('fb')){
				if(!empty($form_settings)){ 
					foreach($form_settings as $k => $v){
						if(is_array($v)){
							if($v['name'] != 'email'){
								if($v['name'] == 'name'){
									if(!empty($settings->display_name) && $settings->display_name == '1'){
			?><div class="col-md-12"><input id="cspio-name" name="name" class="form-control input-lg form-el" type="text" placeholder="<?php echo esc_attr($settings->txt_name_field); ?>"/></div>

			<?php }}else{
				if(!empty($v['visible']) && $v['visible'] == 'on'){
					if(seed_cspv5_cu('fb')){
				?>
			<div class="col-md-12"><input id="cspio-<?php echo $v['name'] ?>" name="<?php echo $v['name'] ?>" class="form-control input-lg form-el" type="text" placeholder="<?php echo esc_attr($v['label']); ?>"/></div>


			<?php }}}}}}}?>

			<?php if(1 == 0) { ?>
				<div class="col-md-12"><div class="input-group"><input id="cspio-email" name="email" class="form-control input-lg form-el" type="text" placeholder="<?php echo esc_attr($settings->txt_email_field); ?>"/>
				<span class="input-group-btn"><button id="cspio-subscribe-btn" type="submit" class="btn btn-lg btn-primary form-el noglow"><?php echo esc_html($settings->txt_subscribe_button); ?></button></span></div></div>
			<?php }else{ ?>
				<div class="col-md-12 seperate"><div class="input-group"><input id="cspio-email" name="email" class="form-control input-lg form-el" type="email" placeholder="<?php echo esc_attr($settings->txt_email_field); ?>" required/>
				<span class="input-group-btn"><button id="cspio-subscribe-btn" type="submit" class="btn btn-lg btn-primary form-el noglow"><?php echo esc_html($settings->txt_subscribe_button); ?></button></span></div></div>
			<?php } ?>
			</div>
			</div>

			</form>
<span id="cspio-privacy-policy-txt"><?php echo $settings->privacy_policy_link_text; ?></span>
<script>
function send_request(){
		jQuery.ajax({
	    url: "<?php echo $subscribe_callback_ajax_url; ?>",
	    dataType: "jsonp",
	    timeout: 30000,
	    data: jQuery("#cspio-form").serialize(),
	 
	    // Work with the response
	    success: function( response ) {
	        //console.log( response); // server response
	        //console.log( response.status);
	        // Sucess or Already Subscribed
	        if(response.status == '200' || response.status == '409'){
		        // Replace Content
		        <?php if($settings->show_sharebutton_on == 'front'){ ?>
		        jQuery("#cspio-sharebuttons").fadeOut(200);
		        <?php } ?>

		        jQuery("#cspio-privacy-policy-txt,#cspio-description,#cspio-headline").fadeOut(200);
		        jQuery( "#cspio-form,#cspio-countdown,#cspio-progressbar" ).fadeOut(200).promise().done(function() {
		        	if(return_user){
		        		jQuery('#cspio-content').show();
		        	}
		        	jQuery( "#cspio-form" ).replaceWith( response.html ).hide().fadeIn();
		        });

		        // Set cookie if new user and user comes back
		        jQuery.cookie('email', jQuery("#cspio-email").val(), { expires: 365 } );
	    	}

	    	// Validation Error
	    	if(response.status == '400'){
	    		jQuery('#cspio-alert').remove();
	    		jQuery(response.html).hide().appendTo("#cspio-field-wrapper").fadeIn();
				//$('#cspio-field-wrapper').before(response.html).done().find('#cspio-alert').hide().fadeIn();
	    	}
	    	
	    	// Other error display html
	        if(response.status == '500'){
				alert(response.html);
	    	}

	    },
	    error: function(jqXHR, textStatus, errorThrown) {
        	alert(textStatus);
    	}
	});
}

jQuery( "#cspio-subscribe-btn" ).click(function( event ) {
	//if($("form")[0].checkValidity()){
	event.preventDefault();
	send_request()
	//}
});

// Read ref param if present
var ref = jQuery.url().param('ref');
jQuery("#cspio-ref").val(ref);
jQuery("#cspio-href").val(location.href);


if(return_user){
	jQuery('#cspio-email').val(email_cookie);
	jQuery('#cspio-name').val(email_cookie);
	send_request();
}



// Disbale Button on Submit
jQuery(document)
.ajaxStart(function () {
    jQuery("#cspio-subscribe-btn").attr('disabled','disabled');
    jQuery("#cspio-email").addClass('cspio-loading');
})
.ajaxStop(function () {
    jQuery("#cspio-subscribe-btn").removeAttr('disabled');
    jQuery("#cspio-email").removeClass('cspio-loading');
});

</script>
<?php } ?>
<?php endif; ?>
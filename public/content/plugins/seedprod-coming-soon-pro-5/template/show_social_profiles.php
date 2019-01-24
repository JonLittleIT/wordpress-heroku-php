<?php 
if(!empty($settings->enable_socialprofiles)){ 
	if(!empty($settings->social_profiles)){ 
	$upload_dir = wp_upload_dir();	
?>
		<div id="cspio-socialprofiles">
		<?php foreach($settings->social_profiles as $k => $v){ ?>
			<?php

			if(is_multisite()){
				$dirpath = $upload_dir['basedir'].'/seedprod/'.get_current_blog_id().'/icons-'.$settings->page_id.'/'.strtolower(str_replace("fa-","",$v->icon)).'.png';
				$path = $upload_dir['baseurl'].'/seedprod/'.get_current_blog_id().'/icons-'.$settings->page_id.'/'.strtolower(str_replace("fa-","",$v->icon)).'.png';
			}else{
				$dirpath = $upload_dir['basedir'].'/seedprod/icons-'.$settings->page_id.'/'.strtolower(str_replace("fa-","",$v->icon)).'.png';
				$path = $upload_dir['baseurl'].'/seedprod/icons-'.$settings->page_id.'/'.strtolower(str_replace("fa-","",$v->icon)).'.png';
			}

			//check url for custom icon
            $icon_image = '';
            $url_split = explode("|",$v->url);
            $v->url = $url_split[0];
            if(!empty($url_split[1])){
                //check for icon
                if(substr( $url_split[1], 0, 3 ) === "fa-"){
                    $v->icon = $url_split[1];
                }
                //check for custom image
                if(substr( $url_split[1], 0, 4 ) === "http"){
                    $icon_image = $url_split[1];
                }

            }
			
			if (filter_var($v->url, FILTER_VALIDATE_EMAIL)) {
				$v->url = "mailto:".str_replace("mailto:","",$v->url);
			}elseif($v->icon == 'fa-skype'){
				$v->url = "skype:".str_replace(array("skype:",'?call'),"",$v->url).'?call';
			}elseif($v->icon == 'fa-phone'){
				$v->url = "tel:".str_replace(array("tel:",'?call'),"",$v->url).'?call';
			}else{
				
				if (filter_var($v->url, FILTER_VALIDATE_URL) === false) {
					$v->url = "http://".$v->url;
				}
			}

			if(file_exists($dirpath)){
			?>
			<a href="<?php echo $v->url; ?>" target="_blank"><img src="<?php echo $path; ?>"></a>
			<?php }else{ ?>

			<?php if(empty($icon_image)){
            ?>

            <a href="<?php echo $v->url; ?>" target="_blank"><i class="fa <?php echo $v->icon; ?> <?php echo $settings->social_profiles_size; ?>"></i></a>
            <?php 
            }else{
            ?>

            <a href="<?php echo $v->url; ?>" target="_blank"><img src="<?php echo $icon_image; ?>"></a>

            <?php
            } ?>



			<?php } ?>
		<?php } ?>
		</div>
<?php	    
	}
}
?>

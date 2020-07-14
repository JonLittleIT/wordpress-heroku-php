<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

function woohoo_admin_theme()
{
	global $bd_options, $wp_cats;
	$i=0;

	?>
    <div id="message_success" style="display:none;" class="notification fade">
        <!--By: https://codepen.io/haniotis/pen/KwvYLO -->
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
    </div>

    <div id="message_wait" style="display:none;" class="notification fade">
        <span class="notification_icon"></span>
        <i class="fa fa-spinner fa-spin"></i>
    </div>

    <div id="message_error" style="display:none;" class="notification bd_alert fade">
        <span class="notification_icon"></span>
        <i class="fa fa-times"></i>
    </div>

    <form name="setting_form" id="setting_form" action="/" method="get" accept-charset="utf-8">
        <div id="bd-panel">

            <div id="bd-main" class="bd-main">
                <div class="clear"></div>
                <div id="bd-panel-tabs">
                    <div id="bd-logo"></div>

                    <ul>
						<?php
						if ( is_array( $bd_options ) ) {
							foreach( $bd_options as $k => $v ) {
								echo '<li class="'. $k .'"><a href="#'. $k .'" >'. ucfirst( str_replace( "_", " ", $k ) ) .'</a></li>';
							}
						}
						?>
                    </ul>
                </div><!-- tabs/-->
                <div class="bd-panel-tabs-bg"></div><!-- tabs bg -->

                <div id="bd-panel-container">
                    <div id="bd-header">
                        <div id="bd-inputs">
                            <input name="save" class="bdaia-btn color3" type="submit" value="Save Changes" />
                            <script type="text/javascript">
                                function is_confirm()
                                {
                                    if( confirm( 'Are you sure ?' ) ){
                                        window.location='admin.php?page=mypanel&do=reset';
                                    } else {
                                        return false;
                                    }
                                }
                            </script>
                            <input name="reset" class="bdaia-btn color1" type="button" onclick="return(is_confirm());" value="Reset All Options" />
                        </div>
                    </div>

					<?php
					if( is_array( $bd_options ) ){
						$list_sum = array();
						foreach( $bd_options as $k => $v ){
							$sub_item = 0; ?>
                            <div class="box_tabs_container" id="<?php echo $k; ?>">
                                <h1 id="bd-top-title"><?php echo ucfirst(str_replace("_"," ",$k)); ?></h1>
                                <div class="tab_content">
									<?php
									if(is_array($v)){
										foreach($v as $key => $input){
											if(isset($input['name']) and $input['name'] != ''){
												woohoo_get_admin_tab($input);
											} else { ?>
                                                <div class="bd_item" id="elm_<?php echo $key; ?>">
													<?php
													foreach($input as $sub) {
														woohoo_get_admin_tab($sub,false);
													}
													?>
                                                </div>
												<?php
											}
										}
									}
									?>
                                </div>
								<?php unset($sub_item); ?>
                            </div>
							<?php
						}
					}
					?>

                </div>
            </div>

            <div id="bd-footer" class="bd_footer">
                <input name="save" class="bdaia-btn color3 bdaia-btn-save" type="submit" value="Save Changes" />
                <script type="text/javascript">
                    function is_confirm()
                    {
                        if( confirm( 'Are you sure ?' ) ){
                            window.location='admin.php?page=mypanel&do=reset';
                        } else {
                            return false;
                        }
                    }
                </script>
                <input name="reset" class="bdaia-btn color1" type="button" onclick="return(is_confirm());" value="Reset All Options" />
            </div>
        </div>
    </form>
	<?php

}
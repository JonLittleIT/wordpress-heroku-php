<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action( 'admin_footer', 'woohoo_admin_footer_function' );
function woohoo_admin_footer_function()
{
	if ( isset( $_GET['page'] ) && $_GET['page'] == 'bdaia_demo_content' )
	{
		require_once( get_template_directory() . '/framework/admin/framework-note.php' );
	}
}

function woohoo_get_demos()
{
	return array (
		'default_options' 	=> get_template_directory() . '/framework/demos/theme_options_default.txt',
		'default' 			=> array(
			'title'			=>	'Default Demo',
			'files' 		=> 	get_template_directory().'/framework/demos/default/',
			'logo' 			=> 	get_template_directory_uri().'/framework/demos/default/thumb.jpg',
			'url' 			=> 	'http://woo.bdayh.com',
			'options'		=>	get_template_directory() . '/framework/demos/default/theme_options.txt',
			'xml'			=>	get_template_directory() . '/framework/demos/default/data.xml',
			'categories'	=>	get_template_directory() . '/framework/demos/default/categories_options.json',
			'widgets'		=>	get_template_directory() . '/framework/demos/default/widgets.json',
			'home'			=>	'Home',
			'woocommerce'	=>	array(
									'active'	=> true,
									'pages'		=> array(
										'woocommerce_shop_page_id'              => 'Shop',
										'woocommerce_cart_page_id'              => 'Cart',
										'woocommerce_checkout_page_id'          => 'Checkout',
										'woocommerce_pay_page_id'               => 'Pay',
										'woocommerce_thanks_page_id'            => 'Order Received',
										'woocommerce_myaccount_page_id'         => 'My Account',
										'woocommerce_edit_address_page_id'      => 'Edit My Address',
										'woocommerce_view_order_page_id'        => 'View Order',
										'woocommerce_change_password_page_id'   => 'Change Password',
										'woocommerce_logout_page_id'            => 'Logout',
										'woocommerce_lost_password_page_id'     => 'Lost Password'
									)
								),
			'menus'			=>	array(
									'main'	=> 'primary',
									'top'	=> 'topmenu'
								),
			'categories_id'	=>	array(
									2	=>	'world',
									3	=>	'entertainment',
									4	=>	'tech',
									5	=>	'lifestyle',
									6	=>	'sports',
									8	=>	'travel',
								),
		),
		'tech' 			=> array(
			'title'			=>	'tech Demo',
			'files' 		=> 	get_template_directory().'/framework/demos/tech/',
			'logo' 			=> 	get_template_directory_uri().'/framework/demos/tech/thumb.jpg',
			'url' 			=> 	'http://woo.bdayh.com/woo-tech/',
			'options'		=>	get_template_directory() . '/framework/demos/tech/theme_options.txt',
			'xml'			=>	get_template_directory() . '/framework/demos/tech/data.xml',
			'categories'	=>	get_template_directory() . '/framework/demos/tech/categories_options.json',
			'widgets'		=>	get_template_directory() . '/framework/demos/tech/widgets.json',
			'home'			=>	'Home',
			'woocommerce'	=>	array(
				'active'	=> false
			),
			'menus'			=>	array(
				'Main'	=> 'primary',
				'Top'	=> 'topmenu',
				'Top'	=> 'footer_menu'
			),
			'categories_id'	=>	array(
				10	=>	'news',
				15	=>	'reviews',
				9	=>	'social-media',
				4	=>	'tech',
				5	=>	'apps-software',
				6	=>	'cars',
				8	=>	'gadgets',
				7	=>	'mobile'
			),
		),
		'health' 			=> array(
			'title'			=>	'health Demo',
			'files' 		=> 	get_template_directory().'/framework/demos/health/',
			'logo' 			=> 	get_template_directory_uri().'/framework/demos/health/thumb.jpg',
			'url' 			=> 	'http://woo.bdayh.com/woo-health/',
			'options'		=>	get_template_directory() . '/framework/demos/health/theme_options.txt',
			'xml'			=>	get_template_directory() . '/framework/demos/health/data.xml',
			'categories'	=>	get_template_directory() . '/framework/demos/health/categories_options.json',
			'widgets'		=>	get_template_directory() . '/framework/demos/health/widgets.json',
			'home'			=>	'Home',
			'woocommerce'	=>	array(
				'active'	=> false
			),
			'menus'			=>	array(
				'main'	=> 'primary',
				'top'	=> 'topmenu'
			),
			'categories_id'	=>	array(
				3	=>	'bdaia-recipes',
				6	=>	'bdaia-desserts-snacks',
				4	=>	'bdaia-juices',
				5	=>	'bdaia-smoothies',
			),
		),
		'fashion' 			=> array(
			'title'			=>	'fashion Demo',
			'files' 		=> 	get_template_directory().'/framework/demos/fashion/',
			'logo' 			=> 	get_template_directory_uri().'/framework/demos/fashion/thumb.jpg',
			'url' 			=> 	'http://woo.bdayh.com/woo-fashion/',
			'options'		=>	get_template_directory() . '/framework/demos/fashion/theme_options.txt',
			'xml'			=>	get_template_directory() . '/framework/demos/fashion/data.xml',
			'categories'	=>	get_template_directory() . '/framework/demos/fashion/categories_options.json',
			'widgets'		=>	get_template_directory() . '/framework/demos/fashion/widgets.json',
			'home'			=>	'Home',
			'woocommerce'	=>	array(
				'active'	=> false
			),
			'menus'			=>	array(
				'main'	=> 'primary'
			),
			'categories_id'	=>	array(
				12	=>	'bdaia-celebrity-style',
				7	=>	'bdaia-highlights',
				11	=>	'bdaia-cosmopolitan',
				10	=>	'bdaia-fashion-shows',
				8	=>	'bdaia-new-arrivals',
				9	=>	'bdaia-spring-essentials',
			),
		),
		'sport' 			=> array(
			'title'			=>	'sport Demo',
			'files' 		=> 	get_template_directory().'/framework/demos/sport/',
			'logo' 			=> 	get_template_directory_uri().'/framework/demos/sport/thumb.jpg',
			'url' 			=> 	'http://woo.bdayh.com/woo-sport/',
			'options'		=>	get_template_directory() . '/framework/demos/sport/theme_options.txt',
			'xml'			=>	get_template_directory() . '/framework/demos/sport/data.xml',
			'categories'	=>	get_template_directory() . '/framework/demos/sport/categories_options.json',
			'widgets'		=>	get_template_directory() . '/framework/demos/sport/widgets.json',
			'home'			=>	'Home',
			'woocommerce'	=>	array(
				'active'	=> false
			),
			'menus'			=>	array(
				'main'	=> 'primary'
			),
			'categories_id'	=>	array(
				7	=>	'bdaia-sports-news',
				5	=>	'bdaia-football',
				8	=>	'bdaia-golf',
				9	=>	'bdaia-video',
			),
		),
		'blog1' 			=> array(
			'title'			=>	'blog1 Demo',
			'files' 		=> 	get_template_directory().'/framework/demos/blog1/',
			'logo' 			=> 	get_template_directory_uri().'/framework/demos/blog1/thumb.jpg',
			'url' 			=> 	'http://woo.bdayh.com/woo-blog1/',
			'options'		=>	get_template_directory() . '/framework/demos/blog1/theme_options.txt',
			'xml'			=>	get_template_directory() . '/framework/demos/blog1/data.xml',
			'categories'	=>	get_template_directory() . '/framework/demos/blog1/categories_options.json',
			'widgets'		=>	get_template_directory() . '/framework/demos/blog1/widgets.json',
			'home'			=>	'Home',
			'woocommerce'	=>	array(
				'active'	=> false
			),
			'menus'			=>	array(
				'main'	=> 'primary'
			),
			'categories_id'	=>	array(
				2	=>	'bdaia-lifestyle',
				3	=>	'bdaia-travel',
				4	=>	'bdaia-photography',
			),
		),
		'blog2' 			=> array(
			'title'			=>	'blog2 Demo',
			'files' 		=> 	get_template_directory().'/framework/demos/blog2/',
			'logo' 			=> 	get_template_directory_uri().'/framework/demos/blog2/thumb.jpg',
			'url' 			=> 	'http://woo.bdayh.com/woo-blog2/',
			'options'		=>	get_template_directory() . '/framework/demos/blog2/theme_options.txt',
			'xml'			=>	get_template_directory() . '/framework/demos/blog2/data.xml',
			'categories'	=>	get_template_directory() . '/framework/demos/blog2/categories_options.json',
			'widgets'		=>	get_template_directory() . '/framework/demos/blog2/widgets.json',
			'home'			=>	'Home',
			'woocommerce'	=>	array(
				'active'	=> false
			),
			'menus'			=>	array(
				'main'	=> 'primary'
			),
			'categories_id'	=>	array(
				3	=>	'bdaia-lifestyle',
				4	=>	'bdaia-travel',
				2	=>	'bdaia-photography',
			),
		),
	);
}

function woohoo_demo_content_body()
{
	$current_demo	=	get_option('_the_demo');
	wp_enqueue_script('noty', get_template_directory_uri().'/framework/demos/assets/noty/packaged/jquery.noty.packaged.min.js', array('jquery'), 0.1, false);
	wp_enqueue_script('noty', get_template_directory_uri().'/framework/demos/assets/noty/themes/bootstrap.js', array('jquery'), 0.1, false);
	wp_enqueue_script('demos', get_template_directory_uri().'/framework/demos/custom.js', array('jquery', 'noty'), 0.1, false);
	wp_enqueue_style( 'animate',  get_template_directory_uri() . '/framework/demos/assets/animate.min.css' );
?>


<?php if ( bd_updater()->is_active() ) { ?>
    <div class="bdaia-demos-page">
        <div class="wrap">
            <h1>Woohoo Demos</h1>
            <br class="clear" >
            <div class="alert">
                Error
            </div>
            <br class="clear" >
            <div class="theme-browser rendered">
                <div class="themes">
					<?php
					foreach(woohoo_get_demos()	as	$demo => $params) {
						if($demo	==	'default_options'){continue;}
						?>
                        <div class="theme demo_theme theme-<?php echo $demo ?>" style="cursor: default">
                            <div class="theme-screenshot">
                                <img src="<?php echo $params['logo']; ?>" alt="<?php echo $demo ?>" />
                            </div>
                            <div class="theme-name">
                                <div class="theme-actions">
                                    <a class="bdaia-btn color2" href="<?php echo $params['url']; ?>" target="_blank">Preview</a>
                                    <a class="bdaia-btn color3 install-demo" href="#" data-demo="<?php echo $demo ?>">Install</a>
                                    <a class="bdaia-btn color1 uninstall-demo" href="#" data-demo="<?php echo $demo ?>">Uninstall</a>
                                </div>
                            </div>
                            <div class="theme-name" style="text-align: center; display: none"><?php echo $demo ?> demo</div>
                        </div><!--END/-->
					<?php } ?>

                    <br class="clear">
                </div>
            </div>
        </div>
    </div>
<?php }  ?>

	<style type="text/css">
		div.bdaia-demos-page {
			position: relative;
			margin: 25px auto 0 5px;
		}
		div.bdaia-demos-page .theme-browser .theme .theme-name {
			position: relative;
			text-transform: uppercase;
		}
		div.bdaia-demos-page .theme-browser .theme .theme-actions {
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)" !important;
			opacity: 1 !important;
		}
        div.bdaia-demos-page .theme-browser .theme .theme-actions {
            height: 41px;
        }
		.uninstall-demo, .bdaia-demos-page .alert{
			display:none !important;
		}
		.demo_theme.theme-<?php echo $current_demo['the_demo']; ?> .uninstall-demo{
			display:inline-block !important;
		}
		.demo_theme.theme-<?php echo $current_demo['the_demo']; ?> .install-demo{
			display:none !important;
		}

		.page_loading {
				display:none;
				background: #053d4e;
				overflow: hidden;
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background: linear-gradient( to bottom right, rgba(6, 0, 255, 0.3), rgba(255, 0, 0, 0.3));
		}

		.page_loading .success {
				display:none;
		}
		.page_loading .success h1 {
			color: #fff;
			text-align: center;
			line-height: 50px;
			margin-top: 80px !important;
		}
		.page_loading .success h4 {
			color: #fff;
			text-align: center;
			margin-top: 20px !important;
		}
		.page_loading .container {
				position: absolute;
				top: 50%;
				-webkit-transform: translateY(-50%);
				-ms-transform: translateY(-50%);
				transform: translateY(-50%);
				width: 100%;
		}

		.page_loading .right {
				float: left;
				color: #FFF;
				width: 50%;
				text-align: right;
		}

		.page_loading .left {
				float: left;
				color: #7a7a7a;
				width: 50%;
				text-align: right;
				-moz-transform: scale(-1, 1);
				-webkit-transform: scale(-1, 1);
				-o-transform: scale(-1, 1);
				-ms-transform: scale(-1, 1);
				transform: scale(-1, 1);
				margin-top: 40px;
		}

		.page_loading h1,
		.page_loading h4 {
				-webkit-transition: opacity .25s;
				-moz-transition: opacity .25s;
				-o-transition: opacity .25s;
				-ms-transition: opacity .25s;
				transition: opacity .25s;
				font-family: "FARCRY", Verdana, Tahoma;
		}

		.page_loading h1 {
				font-size: 6vw;
		}

		.page_loading h4 {
				font-size: 3vw;
		}

		.page_loading h4:first-child {
				margin-bottom: -2vw;
		}

		.page_loading h4:last-child {
				margin-top: -1.7vw;
		}

	</style>
	<?php
}


/*
 * Demo installer
 */
add_action( 'wp_ajax_demo_install', 'woohoo_demo_installer' );
function woohoo_demo_installer()
{
	$wp_registered_widgets = $GLOBALS['wp_registered_widgets'];
    //global $wp_registered_widgets;
	set_time_limit(240);
	
	$demos		=	woohoo_get_demos();
	$the_demo 	=	$_POST['the_demo'];
	
	//Remove the previous demo
	woohoo_demo_uninstaller();
	
	// Delete default wordpress data
	$hello_post_id	=	get_page_by_title( 'Hello world!', OBJECT, 'post' );
	if(isset($hello_post_id->ID)){wp_delete_post( $hello_post_id->ID, true );} // remove hello world post

	$sample_page_id	=	get_page_by_title( 'Sample Page', OBJECT, 'page' );
	if(isset($sample_page_id->ID)){wp_delete_post( $sample_page_id->ID, true );} // remove sample page

	// remove the default widgets
	update_option('sidebars_widgets', '');
	
	// import categories's options
	$categories_options = $demos[$the_demo]['categories'];
	
	// Import data (Posts, Pages, Custom post types, Menus, Images)
	if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
		
		$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		include $wp_importer;
	}

	//if ( ! class_exists('WP_Import') ) {
	//	$wp_import = WP_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php';
	//	include $wp_import;
	//}

	if ( ! class_exists('WP_Import') ) {
		$wp_import = get_template_directory() . '/framework/admin/wordpress-importer/wordpress-importer.php';
		include $wp_import;
	}
	
	$importer 	= new WP_Import();
	$xml 		= $demos[$the_demo]['xml'];
	
	$importer->fetch_attachments = true;
	ob_start();
	$importer->import($xml);
	ob_end_clean();

	flush_rewrite_rules();


}


add_action( 'wp_ajax_menu_install', 'woohoo_menu_installer' );
function woohoo_menu_installer()
{
	$demos		=	woohoo_get_demos();
	$the_demo	=	$_POST['the_demo'];

	/* Import Woocommerce Options */
	$woocommerce	=	$demos[$the_demo]['woocommerce'];
	if($woocommerce['active']	==	true){
		
		foreach($woocommerce['pages'] as $name => $title) {
			$the_page = get_page_by_title( $title );
			if(isset( $the_page ) && $the_page->ID) {
				update_option($name, $the_page->ID);
			}
		}
	}
	
	/* Set default homepage */
	$homepage = get_page_by_title( $demos[$the_demo]['home'] );
	if(isset($homepage) && $homepage->ID) {
		update_option('show_on_front', 'page');
		update_option('page_on_front', $homepage->ID);
	}
	
	/* import categories's options */
	$categories_options = $demos[$the_demo]['categories'];
	
	woohoo_import_categories_options( $categories_options,$the_demo );

	
	/* Import Theme Options Setting */
	woohoo_import_options($demos[$the_demo]['options']);


	/* Assign menus locations */
	$menus_locations	=	$demos[$the_demo]['menus'];
	foreach($menus_locations as $name => $location) {
		woohoo_menu_locations($name, $location);
	}

}

add_action( 'wp_ajax_widgets_install', 'woohoo_widgets_installer' );
function woohoo_widgets_installer()
{


	$demos		=	woohoo_get_demos();
	$params 	= 	array(
						'the_demo' => $_POST['the_demo'],
						'prev_demo' => get_option('_the_demo')
					);

	if( WP_Filesystem() )
	{
		global $wp_filesystem;
		$widgets        = $wp_filesystem->get_contents( $demos[$params['the_demo']]['widgets'] );
		$widgets_data   = $widgets;

		woohoo_import_widgets( $widgets_data );
	}

	/* Add the demo    */
	update_option('_the_demo', $params);


}

function woohoo_menu_locations($menu_name, $location)
{
	$menu		=	wp_get_nav_menu_object($menu_name);
	$menu_id	=	$menu->term_id;

	$menu_locations_array = get_theme_mod('nav_menu_locations');
	if(!is_array($menu_locations_array))
    {
	    $menu_locations_array = array();
    }
	// activate the menu only if it's not already active
	if (!isset($menu_locations_array[$location]) or $menu_locations_array[$location] != $menu_id)
	{
		$menu_locations_array[$location] = $menu_id;
		set_theme_mod('nav_menu_locations', $menu_locations_array);
	}
	return $menu_id;
}

/*
 * Function to import theme options
 */
function woohoo_import_options($file_path)
{
	if( WP_Filesystem() )
	{
		global $wp_filesystem;
		$file_contents  = $wp_filesystem->get_contents( $file_path, true );
		$options        = unserialize( @base64_decode( $file_contents ) );
		update_option( 'bdayh_setting', serialize( $options ) );
	}
}

/*
 * Function to import widgets
 * Widget Settings Importer/Exporter
 * https://github.com/voceconnect/widget-data
 */
function woohoo_import_widgets($data)
{
	$json_data = json_decode( $data, true );

	$sidebar_data = $json_data[0];
	$widget_data = $json_data[1];


	$widgets = array();

	foreach ( $widget_data as $widget_data_title => $widget_data_value )
	{

		$widgets[ $widget_data_title ] = array();
		foreach( $widget_data_value as $widget_data_key => $widget_data_array )
		{
			if( is_int( $widget_data_key ) )
			{
				$widgets[$widget_data_title][$widget_data_key] = 'on';
			}
		}
	}

	unset($widgets[""]);

	foreach ( $sidebar_data as $title => $sidebar )
	{
		$count = count( $sidebar );
		for ( $i = 0; $i < $count; $i++ ) {
			$widget = array( );
			$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
			$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
			if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
				unset( $sidebar_data[$title][$i] );
			}
		}
		$sidebar_data[$title] = array_values( $sidebar_data[$title] );
	}

	foreach ( $widgets as $widget_title => $widget_value ) {
		foreach ( $widget_value as $widget_key => $widget_value ) {
			$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
		}
	}

	$sidebar_data = array( array_filter( $sidebar_data ), $widgets );


	woohoo_parse_import_data( $sidebar_data );
}

function woohoo_parse_import_data( $import_array )
{
	$wp_registered_sidebars = $GLOBALS['wp_registered_sidebars'];

	$sidebars_data = $import_array[0];
	$widget_data = $import_array[1];

	$sidebars_widgets = get_option( 'sidebars_widgets' );




	if (! $sidebars_widgets) {
		$sidebars_widgets = array();
	}
	$new_widgets = array( );
	$current_sidebars = array();


	foreach ( $sidebars_data as $import_sidebar => $woohoo_import_widgets )
	{
		foreach ( $woohoo_import_widgets as $import_widget )
		{


			//if the sidebar exists
			if ( isset( $wp_registered_sidebars[$import_sidebar] ) )
			{



				$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );

				$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
				$current_widget_data = get_option( 'widget_' . $title );

				$new_widget_name = woohoo_get_new_widget_name( $title, $index );
				$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

				if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
					while ( array_key_exists( $new_index, $new_widgets[$title] ) )
                    {
						$new_index++;
					}
				}

				    $current_sidebars[$import_sidebar][] = $title . '-' . $new_index;



				if ( array_key_exists( $title, $new_widgets ) )
				{
					$new_widgets[$title][$new_index] = $widget_data[$title][$index];
					$multiwidget = $new_widgets[$title]['_multiwidget'];
					unset( $new_widgets[$title]['_multiwidget'] );
					$new_widgets[$title]['_multiwidget'] = $multiwidget;
				}
				else
                {
					$current_widget_data[$new_index] = $widget_data[$title][$index];

					$current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;

					$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;

					$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;

					unset( $current_widget_data['_multiwidget'] );

					$current_widget_data['_multiwidget'] = $multiwidget;

					$new_widgets[$title] = $current_widget_data;

				}

			}
		}
	}



	if ( isset( $new_widgets ) && isset( $current_sidebars ) )
	{
		update_option( 'sidebars_widgets', $current_sidebars );

		foreach ( $new_widgets as $title => $content )
			update_option( 'widget_' . $title, $content );

		return true;
	}

	return false;
}
function woohoo_get_new_widget_name( $widget_name, $widget_index ) {
	$current_sidebars = get_option( 'sidebars_widgets' );

	if(!is_array($current_sidebars))
    {
	    $current_sidebars = array();
    }

	$all_widget_array = array( );

	if(isset($current_sidebars) && $current_sidebars != '')
	{
		foreach ( $current_sidebars as $sidebar => $widgets )
		{
			if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' )
			{
				foreach ( $widgets as $widget )
				{
					$all_widget_array[] = $widget;
				}
			}
		}
	}

	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) )
    {
		$widget_index++;
	}

	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}


/*
 * Function to import wp options
 * WP Options Importer
 * https://wordpress.org/plugins/options-importer/
 */
function woohoo_import_categories_options($data, $the_demo = null)
{
	$demos		        = woohoo_get_demos();

	if( WP_Filesystem() )
	{
		global $wp_filesystem;
		$file_contents  = $wp_filesystem->get_contents( $data );
		$import_data    = json_decode( $file_contents, true );

		foreach($import_data['options']	as	$option_name =>	$value){
			if($the_demo	!=	null){
				foreach($demos[$the_demo]['categories_id']	as	$id => $name){
					if($option_name	==	'bd_cat_'.$id){
						$Obj = get_category_by_slug($name);
						$idObj = $Obj->term_id;
					}
				}
			}
			$option_value = maybe_unserialize( $value );
			update_option( 'bd_cat_'.$idObj, $option_value, 'no' );
		}
	}
}


/*
 * Demo uninstaller
 */
add_action( 'wp_ajax_demo_uninstall', 'woohoo_demo_uninstaller' );
function woohoo_demo_uninstaller()
{
	set_time_limit(240);

	$demos		=	woohoo_get_demos();
	$the_demo 	=	$_POST['the_demo'];

	$demos_posts_id 		=	get_option('demos_posts_id');
	$demos_categories_id 	=	get_option('demos_categories_id');
	$demos_menus_id 		=	get_option('demos_menus_id');

	if(get_option('_the_demo') == false){
		$prev_sidebar	=	get_option('sidebars_widgets');
		update_option('prev_sidebars_widgets', $prev_sidebar);

		$prev_options	=	get_option('bdayh_setting');
		update_option('prev_bdayh_setting', $prev_options);
	}
	$prev_sidebars_widgets	=	get_option('prev_sidebars_widgets');
	$prev_theme_options		=	get_option('prev_bdayh_setting');

	//remove pages and posts attachments
	$demo_posts	=	$demos_posts_id;
	if(is_array($demo_posts)){
		foreach($demo_posts	as	$post){
			$args = array('post_parent' => $post);
			$post_attachments = get_children($args);
			if($post_attachments) {
				foreach ($post_attachments as $attachment) {
				  wp_delete_attachment($attachment->ID, true);
				}
			}
			wp_delete_post( $post, true );
		}
	}
	//remove pages and posts attachments
	$demo_categories	=	$demos_categories_id;
	if(is_array($demo_categories)){
		foreach($demo_categories	as	$cat_id){
			delete_option( 'bd_cat_'.$cat_id ); //delete category options
			wp_delete_category($cat_id, true);
		}
	}
	//remove menu items
	$demo_menus	=	$demos_menus_id;
	if(is_array($demo_menus)){
		foreach($demo_menus	as	$item){
			wp_delete_post( $item, true );
			wp_delete_nav_menu($item, true);
		}
	}


	delete_option('_the_demo'); // reset the demo

	// reset theme options
	if(get_option('prev_bdayh_setting') == false){
		woohoo_import_options($demos['default_options']);
	}else{
		update_option('bdayh_setting', $prev_theme_options);
	}
	
	update_option('demos_posts_id', ''); // remove added posts
	update_option('demos_categories_id', ''); // remove added categories
	update_option('demos_menus_id', ''); // remove added menu items
	update_option('sidebars_widgets', $prev_sidebars_widgets); // reset widgets
	// reset front page
	update_option('show_on_front', 'posts');
	update_option('page_on_front', 0);
	// reset woocommerce options
	update_option('woocommerce_shop_page_id', '');
	update_option('woocommerce_cart_page_id', '');
	update_option('woocommerce_checkout_page_id', '');
	update_option('woocommerce_pay_page_id', '');
	update_option('woocommerce_thanks_page_id', '');
	update_option('woocommerce_myaccount_page_id', '');
	update_option('woocommerce_edit_address_page_id', '');
	update_option('woocommerce_view_order_page_id', '');
	update_option('woocommerce_change_password_page_id', '');
	update_option('woocommerce_logout_page_id', '');
	update_option('woocommerce_lost_password_page_id', '');
	
}

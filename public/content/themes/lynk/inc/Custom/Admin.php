<?php

namespace Awps\Custom;

use Awps\Api\Settings;
use Awps\Api\Callbacks\SettingsCallback;

/**
 * Admin
 * use it to write your admin related methods by tapping the settings api class.
 */
class Admin
{
	const PAGE_SETTINGS_KEY = 'jvbpd_page_setting';
	/**
	 * Store a new instance of the Settings API Class
	 * @var class instance
	 */
	public $settings;

	/**
	 * Callback class
	 * @var class instance
	 */
	public $callback;
	public $cache_categories;
	public static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->settings = new Settings();
		$this->callback = new SettingsCallback();
	}

	/**
     * register default hooks and actions for WordPress
     * @return
     */
	public function register()
	{
		$this->enqueue()->pages()->settings()->sections()->fields()->register_settings();
		$this->enqueue_faq( new Settings() );
		$this->load_admin_helper();
		$this->load_admin_wizard();

		self::$instance = $this;
		add_action( 'admin_init', Array( $this, 'tsettings_register' ) );
		add_action( 'wp_ajax_jvbpd_theme_settings_save', Array( $this, 'tsettings_save' ) );

		add_action('add_meta_boxes', Array($this, 'custom_meta_boxes'));
		add_action('save_post', Array($this, 'save_custom_meta_boxes'));

		add_filter( 'wp_setup_nav_menu_item', array( $this, 'apparence_menu_define_vars' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'apparence_menu_save_vars' ), 10, 3 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'apparence_menu_walker' ), 10, 2 );
		add_action( 'wp_content_panel_nav_menu_item', array( $this, 'apparence_menu_append_option' ), 10, 2 );


	}

	/**
	 * Trigger the register method of the Settings API Class
	 * @return
	 */
	private function register_settings() {
		$this->settings->register();
	}

	/**
	 * Enqueue scripts in specific admin pages
	 * @return $this
	 */
	private function enqueue()
	{
		// Scripts multidimensional array with styles and scripts
		$scripts = array(
			'script' => array(
				'jquery',
				'media_uplaoder',
				get_template_directory_uri() . '/assets/dist/js/admin.js',
			),
			'style' => array(
				get_template_directory_uri() . '/assets/dist/css/admin.css',
				'wp-color-picker'
			)
		);

		// Pages array to where enqueue scripts
		$pages = array( 'toplevel_page_awps' );

		// Enqueue files in Admin area
		$this->settings->admin_enqueue( $scripts, $pages );

		return $this;
	}

	/**
	 * Enqueue only to a specific page different from the main enqueue
	 * @param  Settings $settings 	a new instance of the Settings API class
	 * @return
	 */
	private function enqueue_faq( Settings $settings )
	{
		// Scripts multidimensional array with styles and scripts
		$scripts = array(
			'style' => array(
				get_template_directory_uri() . '/assets/dist/css/admin.css',
			)
		);

		// Pages array to where enqueue scripts
		$pages = array( 'awps_page_awps_faq' );

		// Enqueue files in Admin area
		$settings->admin_enqueue( $scripts, $pages )->register();
	}

	public function load_template( $args=Array(), $param=Array() ) {
		$options = shortcode_atts(
			Array(
				'once' => true,
				'ext' => '.php',
				'path' => get_template_directory() . '/views/',
				'sub' => false,
				'name' => '',
			), $args
		);

		if( is_array( $param ) ) {
			extract( $param );
		}

		$filePath = Array();
		$filePath[] = $options[ 'path' ];

		if( !empty( $options[ 'sub' ] ) ) {
			$filePath[] = $options[ 'sub' ];
		}

		$filePath[] = $options[ 'name' ];
		$fileName = sprintf( '%1$s%2$s', join( '/', $filePath ), $options[ 'ext' ] );

		if( file_exists( $fileName ) ) {
			if( $options[ 'once' ] ) {
				require_once( $fileName );
			}else{
				require( $fileName );
			}
		}
	}

	/**
	 * Register admin pages and subpages at once
	 * @return $this
	 */
	private function pages()
	{
		$admin_pages = array(
			array(
				'page_title' => 'AWPS Admin Page',
				'menu_title' => 'AWPS',
				'capability' => 'manage_options',
				'menu_slug' => 'awps',
				'callback' => array( $this->callback, 'admin_index' ),
				'icon_url' => get_template_directory_uri() . '/assets/dist/images/admin-icon.png',
				'position' => 110,
			)
		);

		$admin_subpages = array(
			array(
				'parent_slug' => 'awps',
				'page_title' => 'Awps FAQ',
				'menu_title' => 'FAQ',
				'capability' => 'manage_options',
				'menu_slug' => 'awps_faq',
				'callback' => array( $this->callback, 'admin_faq' )
			)
		);

		// Create multiple Admin menu pages and subpages
		$this->settings->addPages( $admin_pages )->withSubPage( 'Settings' )->addSubPages( $admin_subpages );

		return $this;
	}

	/**
	 * Register settings in preparation of custom fields
	 * @return $this
	 */
	private function settings()
	{
		// Register settings
		$args = array(
			array(
				'option_group' => 'awps_options_group',
				'option_name' => 'first_name',
				'callback' => array( $this->callback, 'awps_options_group' )
			),
			array(
				'option_group' => 'awps_options_group',
				'option_name' => 'awps_test2'
			)
		);

		$this->settings->add_settings( $args );

		return $this;
	}

	/**
	 * Register sections in preparation of custom fields
	 * @return $this
	 */
	private function sections()
	{
		// Register sections
		$args = array(
			array(
				'id' => 'awps_admin_index',
				'title' => 'Settings',
				'callback' => array( $this->callback, 'awps_admin_index' ),
				'page' => 'awps'
			)
		);

		$this->settings->add_sections( $args );

		return $this;
	}

	/**
	 * Register custom admin fields
	 * @return $this
	 */
	private function fields()
	{
		// Register fields
		$args = array(
			array(
				'id' => 'first_name',
				'title' => 'First Name',
				'callback' => array( $this->callback, 'first_name' ),
				'page' => 'awps',
				'section' => 'awps_admin_index',
				'args' => array(
					'label_for' => 'first_name',
					'class' => ''
				)
			)
		);

		$this->settings->add_fields( $args );

		return $this;
	}

	private function load_admin_helper() {
		$helperPath = dirname( __FILE__ ) . '/Admin-Helper.php';
		if( file_exists( $helperPath ) ) {
			require_once( $helperPath );
		}
	}

	private function load_admin_wizard() {
		$helperPath = dirname( __FILE__ ) . '/Admin-Wizard.php';
		if( file_exists( $helperPath ) ) {
			require_once( $helperPath );
		}
	}

	private function order_pages( $pages, $_pages ) {
		return $pages[ 'priority' ] - $_pages[ 'priority' ];
	}

	private function getPages() {
		$pages = apply_filters(
			'jvbpd_theme_setting_pages',
			Array(
				'general' => Array( esc_html__( "General", 'jvbpd' ), false , 'priority' => 0 ),
				//'logo' => Array( esc_html__( "Logo", 'jvbpd' ), false , 'priority' => 10 ),
				//'font' => Array( esc_html__( "Fonts", 'jvbpd' ), false, 'priority' => 20 ),
				'header' => Array( esc_html__( "Header", 'jvbpd' )	, false, 'priority' => 30 ),
				// 'post' => Array( esc_html__( "Post", 'jvbpd' )	, false, 'priority' => 35 ),
				//'portfolio'	=> Array( esc_html__( "Portfolio", 'jvbpd' ), false, 'priority' => 39 ),
				'footer' => Array( esc_html__( "Footer", 'jvbpd' ), false, 'priority' => 40 ),
				// 'api' => Array( esc_html__( "API", 'jvbpd' ), false, 'priority' => 50 ),
				//'contact' => Array( esc_html__( "Contact Info", 'jvbpd' ), false, 'priority' => 60 ),
				'custom' => Array( esc_html__( "Custom CSS / JS", 'jvbpd' ), false, 'priority' => 70 ),
				'import' => Array( esc_html__( "Import / Export", 'jvbpd' ), false, 'priority' => 80 ),
			)
		);
		uasort( $pages, Array( $this, 'order_pages' ) );
		return $pages;
	}

	public function tsettings_register() {
		register_setting( 'jvbpd_settings', 'jvbpd_themes_settings' );
	}

	public function tsettings_save() {
		check_ajax_referer( 'jvbpd_theme_settings_save', '_nonce' );
		$arrOptions = isset( $_POST[ 'jvbpd_ts' ] ) ? array_map( 'stripslashes_deep', $_POST[ 'jvbpd_ts' ] ) : Array();
		update_option( 'jvbpd_themes_settings' , $arrOptions );
		die( json_encode( Array( 'state' => 'OK', 'code' => maybe_serialize( $arrOptions ) ) ) );

	}

	public function enqueue_script() {
		wp_enqueue_style( 'javo-settings-style', get_template_directory_uri() . '/assets/dist/css/admin.css' );
		wp_register_script( 'javo-settings', get_template_directory_uri() . '/assets/dist/js/backend.js', Array( 'jquery' ) );
		wp_localize_script( 'javo-settings', 'jvbpd_ts_variable', Array(
			'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'strReset' => esc_html__( "Warning : All option results remove and Style initialize.\nContinue?", 'jvbpd' ),
			'strImport' => esc_html__( "Warning : Change option. can`t option restore. \nContinue?", 'jvbpd' ),
		) );
		wp_add_inline_script( 'javo-settings', 'jQuery(function($){ $(document).trigger( "javo:theme_settings_after" ); });' );
		wp_enqueue_script( 'javo-settings' );
	}

	public function settings_page_initialize() {
		/* Need script and style load */
		wp_enqueue_media();
		wp_enqueue_script( 'colorpicker' );
		add_action( 'admin_footer', Array( $this,  'enqueue_script' ) );

		$current = explode("-", $_GET['page']);
		$pages = $this->getPages();

		// Variable initialize
		$content = "";
		$add_tabs = "";

		// Repeat create tab menus items
		foreach($pages as $page=>$value){
			$active = ($page == $current)? " nav-tab-active" : "";
			$add_tabs .= sprintf("<li class='javo-opts-group-tab-link-li'>
				<a href='javascript:void(0);' class='javo-opts-group-tab-link-a' tar='%s'>
				%s %s</a></li>"
				, $page
				, $value[1]
				, strtoupper( $value[0] )
			);
		}

		$objThsFile	= pathinfo( __FILE__ );
		do_action( 'jvbpd_admin_helper_page_header' );
		do_action( 'jvbpd_admin_helper_' . $objThsFile[ 'filename' ] . ' _header' ); ?>
		<!-- Theme settings options form -->

		<form id="jvbpd_ts_form" name="jvbpd_theme_settings_form" onsubmit="return false">
			<div class="jvbpd_ts_header_div">
				<div class="jvbpd_ts_header logo">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/dist/images/jv-logo1.png' ); ?>">
				</div>
				<?php
					/* Get Javo Theme Information */
					$theme_data = wp_get_theme();
					echo "<div class='javo-version-info'><span>By&nbsp;&nbsp;".$theme_data['Author']."</Author></span>";
					echo "<span>&nbsp;&nbsp;V&nbsp;".$theme_data['Version']."</Author></span></div>";
				?>
				<div class="jvbpd_ts_header save_area">
					<a href="<?php echo esc_url( apply_filters( 'jvbpd_doc_url', '' ) ); ?>" target="_blank" class="button button-default">
						<?php esc_html_e('Documentation', 'jvbpd' );?>
					</a>
					<input value="Save Settings" class="button button-primary jvbpd_btn_ts_save" type="button">
				</div>
			</div>

			<div id="javo-opts-sidebar">
				<ul id="javo-opts-group-menu">
					<?php printf($add_tabs);?>
				</ul>
			</div>
			<div id="javo-opts-main">
				<?php
				// Tabs contents includes

				/*
				global
					$jvbpd_tso
					, $jvbpd_ts_map
					, $jvbpd_ts_archive
					, $jvbpd_ts_dashboard;
				//$jvbpd_ts_map			= new jvbpd_array( (Array)$jvbpd_tso->get('map', Array() ) );
				// $jvbpd_ts_archive		= new jvbpd_array( (Array)$jvbpd_tso->get('archive', Array() ) );
				// $jvbpd_ts_dashboard	= new jvbpd_array( (Array)$jvbpd_tso->get('dashboard', Array() ) ); */


				if( !empty( $pages ) ) : foreach( $pages as $index => $page ) {
					$templatePathArgs = Array( get_template_directory(), 'views', 'admin', ucfirst( $index ) );
					$templatePath = join( '/', $templatePathArgs ) . '.php';
					if( isset( $page[ 'external' ] ) ) {
						$templatePath = $page[ 'external' ];
					}
					if( file_exists( $templatePath ) ) {
						require_once( $templatePath );
					}
				} endif; ?>
			</div>
			<div class="javo-opts-footer">
				<input name="jvbpd_themes_update" value="<?php echo esc_attr( md5( date( "y-m-d" ) ) );?>" type="hidden">
			</div>

			<div class="jvbpd-ts-message">
				<div class="message-content">

					<div class="jvbpd-message status-process">
						<span class="spinner"></span>
						<span><?php esc_html_e( "Processing...", 'jvbpd' ); ?></span>
					</div>

					<div class="jvbpd-message status-ok">
						<span class="icon"></span>
						<span><?php esc_html_e( "Saved", 'jvbpd' ); ?></span>
					</div>

					<div class="jvbpd-message status-fail">
						<span class="icon"></span>
						<span><?php esc_html_e( "Failed", 'jvbpd' ); ?></span>
					</div>

				</div>
			</div>
			<input type="hidden" name="action" value="jvbpd_theme_settings_save">
			<input type="hidden" name="_nonce" value="<?php echo wp_create_nonce( 'jvbpd_theme_settings_save' ); ?>">
		</form>

		<!-- Reset & Import Form -->
		<form method="post" action="options.php" id="javo-ts-admin-form">
			<?php settings_fields( 'jvbpd_settings' );?>
			<input type="hidden" name="jvbpd_themes_settings" id="javo-ts-admin-field">
		</form>

		<!-- Item Refresh Form -->
		<form id="jvbpd_tso_map_item_refresh" method="post">
			<input type="hidden" name="lang">
			<input type="hidden" name="jvbpd_items_refresh_" value="refresh">
		</form>

		<!-- Item Unserialize Form -->
		<form id="jvbpd_tso_map_item_unserial" method="post">
			<input type="hidden" name="lang">
			<input type="hidden" name="jvbpd_items_unserial_" value="unserial">
		</form>

		<?php
		do_action( 'jvbpd_admin_helper_' . $objThsFile[ 'filename' ] . ' _footer' );
		do_action( 'jvbpd_admin_helper_page_footer' );
	}

	public function custom_meta_boxes() {
		$metaBoxes = Array(
			'custom-sidebars' => Array(
				'title' => esc_html__("Custom sidebars", 'jvfrmtd'),
				'cb' => Array($this, 'meta_box_custom_sidebar'),
				'post_type' => 'page',
			),
		);
		foreach($metaBoxes as $boxID => $boxMeta){
			add_meta_box('jvbpd-'.$boxID, $boxMeta['title'], $boxMeta['cb'], $boxMeta['post_type'], 'normal', 'high');
		}
	}

	public function meta_box_custom_sidebar() {
		$metaSidebars = get_post_meta(get_the_ID(), self::PAGE_SETTINGS_KEY, true);
		foreach(
			Array(
				'sidebar_left' => Array(
					'label' => esc_html__( "Left Sidebar", 'jvfrmtd' ),
					'note' => esc_html__( "It shows when there is at least one menu. otherwise, it doesn't show.", 'jvfrmtd' ),
				),
				'sidebar_member' => Array(
					'label' => esc_html__( "Member Sidebar", 'jvfrmtd' ),
					'note' => esc_html__( "It works when required plugins ('Core', 'BuddyPress') are actived. For groups, group component in BuddyPress needs to be actived.", 'jvfrmtd' ),
				),
			) as $strOptionName => $strOptionMeta
		) {
			$thisValue = isset($metaSidebars[$strOptionName]) ? $metaSidebars[$strOptionName] : false; ?>
			<h4 class="pull-left"><?php echo esc_html( $strOptionMeta[ 'label' ] ); ?></h4>
			<fieldset class="inner margin-20-0 <?php if($strOptionMeta[ 'label' ]=='Member Sidebar') echo 'margin-custom-28-0'; ?>">
				<select name="jvbpd_mb[<?php echo esc_attr( $strOptionName ); ?>]">
					<?php
					foreach(
						Array(
							'' => esc_html__( "Default as theme settings", 'jvfrmtd' ),
							'disabled' => esc_html__( "Disable", 'jvfrmtd' ),
							'enabled' => esc_html__( "Enable", 'jvfrmtd' ),
						) as $strOption => $strOptionLabel
					) {
						printf(
							'<option value="%1$s"%3$s>%2$s</option>',
							$strOption, $strOptionLabel, selected( $strOption == $thisValue, true, false )
						);
					} ?>
				</select>
				<?php printf( '<div class="description">%1$s : %2$s</div>', esc_html__( "Note", 'jvfrmtd' ), $strOptionMeta[ 'note' ] ); ?>
			</fieldset>
			<?php
		}
	}

	public function save_custom_meta_boxes($post_id) {
		if( !is_admin() ) {
			return;
		}
		if(isset($_POST['jvbpd_mb'])) {
			update_post_meta($post_id, self::PAGE_SETTINGS_KEY, $_POST['jvbpd_mb']);
		}
	}

	public function apparence_menu_define_vars( $_mnu_item ) {
		if( ! isset( $_mnu_item->ID ) ){
			return $_mnu_item;
		}
		$_mnu_item->anchor = get_post_meta( $_mnu_item->ID, '_menu_item_anchor', true );
		$_mnu_item->scrollspy = get_post_meta( $_mnu_item->ID, '_menu_item_scrollspy', true );
		$_mnu_item->nav_icon = get_post_meta( $_mnu_item->ID, '_menu_item_icon', true );
		$_mnu_item->wide_menu = get_post_meta( $_mnu_item->ID, '_wide_menu', true );
		$_mnu_item->nav_bg = get_post_meta( $_mnu_item->ID, '_nav_bg', true );
		$_mnu_item->wide_menu_category = get_post_meta( $_mnu_item->ID, '_wide_menu_category', true );
		$_mnu_item->wide_menu_listing_category = get_post_meta( $_mnu_item->ID, '_wide_menu_listing_category', true );
		$_mnu_item->wide_menu_post_type = get_post_meta( $_mnu_item->ID, '_wide_menu_post_type', true );
		$_mnu_item->wide_menu_module = get_post_meta( $_mnu_item->ID, '_wide_menu_module', true );
		return $_mnu_item;
	}

	public function apparence_menu_save_vars($_mnu_ID, $_mnu_item_ID, $args) {
		/*
		$arrOptions = Array(
			'_menu_item_anchor', '_menu_item_scrollspy', '_menu_item_icon', '_wide_menu', '_nav_bg', '_wide_menu_category',
		); */
		if(!is_admin()) {
			return;
		}
		$arrOptions = Array('_menu_item_icon', '_wide_menu', '_wide_menu_module', '_wide_menu_post_type', '_wide_menu_category', '_wide_menu_listing_category');
		foreach( $arrOptions as $optionName ) {
			$strValue = isset(  $_POST[ $optionName ][ $_mnu_item_ID ] ) ? $_POST[ $optionName ][ $_mnu_item_ID ] : false;
			update_post_meta( $_mnu_item_ID, $optionName, $strValue );
		}
	}

	public function apparence_menu_walker(){
		$walkerPath = get_template_directory() . '/inc/Api/Callbacks/AdminCustomWalkerCallback.php';
		if(file_exists($walkerPath)){
			require_once($walkerPath);
		}
		return 'Walker_Nav_Menu_Edit_Custom';
	}

	public function apparence_menu_append_option($item, $item_id) {
		$this->load_template(Array('name' => 'Edit-Menu', 'sub' => 'admin', 'once'=> false), Array('jvbpdAdmin'=> self::$instance, 'item' => $item, 'item_id' => $item_id));
	}

	public function getNavField( $item_id=0, $item_field_key=''  ){
		return sprintf( '%s[%s]', $item_field_key, $item_id );
   }
}
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Ekommart_Elementor' ) ) :

	/**
	 * The Ekommart Elementor Integration class
	 */
	class Ekommart_Elementor {
		private $suffix = '';

		public function __construct() {
			$this->suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			add_action( 'wp', [ $this, 'register_auto_scripts_frontend' ] );
			add_action( 'elementor/init', array( $this, 'add_category' ) );
			add_action( 'wp_enqueue_scripts', [ $this, 'add_scripts' ], 15 );
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'include_widgets' ) );
			add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'add_js' ] );

			// Custom Animation Scroll
			add_filter( 'elementor/controls/animations/additional_animations', [ $this, 'add_animations_scroll' ] );

			// Elementor Fix Noitice WooCommerce
			add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'woocommerce_fix_notice' ) );

			// Backend
			add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'add_scripts_editor' ] );
			add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'add_style_editor' ], 99 );
//
//			// Add Icon Custom
			add_action( 'elementor/icons_manager/native', [ $this, 'add_icons_native' ] );
			add_action( 'elementor/controls/controls_registered', [ $this, 'add_icons' ] );

			if ( ! ekommart_is_elementor_pro_activated() ) {
				require trailingslashit( get_template_directory() ) . 'inc/elementor/custom-css.php';
			}

			// Fix Parallax granular-controls-for-elementor
			if ( function_exists( 'granular_get_options' ) ) {
				if ( 'yes' === granular_get_options( 'granular_editor_parallax_on', 'granular_editor_settings', 'no' ) ) {
					add_action( 'elementor/frontend/section/after_render', [
						$this,
						'granular_editor_after_render'
					], 10, 1 );
				}
			}
			add_filter( 'elementor/fonts/additional_fonts', [ $this, 'update_google_fonts' ] );
		}

		public function update_google_fonts( $fonts ) {
			$fonts["Bebas Neue"] = 'googlefonts';

			return $fonts;
		}

		public function granular_editor_after_render( $element ) {
			$settings = $element->get_settings();
			if ( $element->get_settings( 'section_parallax_on' ) == 'yes' ) {
				$type        = $settings['parallax_type'];
				$and_support = $settings['android_support'];
				$ios_support = $settings['ios_support'];
				$speed       = $settings['parallax_speed'];
				?>

				<script type="text/javascript">
					(function ($) {
						"use strict";
						var granularParallaxElementorFront = {
							init: function () {
								elementorFrontend.hooks.addAction('frontend/element_ready/global', granularParallaxElementorFront.initWidget);
							},
							initWidget: function ($scope) {
								$('.elementor-element-<?php echo esc_js( $element->get_id() ); ?>').jarallax({
									type: '<?php echo esc_js( $type ); ?>',
									speed: <?php echo esc_js( $speed ); ?>,
									keepImg: true,
									imgSize: 'cover',
									imgPosition: '50% 0%',
									noAndroid: <?php echo esc_js( $and_support ); ?>,
									noIos: <?php echo esc_js( $ios_support ); ?>
								});
							}
						};
						$(window).on('elementor/frontend/init', granularParallaxElementorFront.init);
					}(jQuery));
				</script>

			<?php }
		}

		public function add_js() {
			global $ekommart_version;
			wp_enqueue_script( 'ekommart-elementor-frontend', get_theme_file_uri( '/assets/js/elementor-frontend.js' ), [], $ekommart_version );
		}

		public function add_style_editor() {
			global $ekommart_version;
			wp_enqueue_style( 'ekommart-elementor-editor-icon', get_theme_file_uri( '/assets/css/admin/elementor/icons.css' ), [], $ekommart_version );
		}

		public function add_scripts_editor() {
			global $ekommart_version;
//			wp_enqueue_script( 'ekommart-elementor-admin-editor', get_theme_file_uri( '/assets/js/elementor/editor/backend.js' ), [], $ekommart_version, true );
		}

		public function add_scripts() {
			global $ekommart_version;
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			wp_enqueue_style( 'ekommart-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $ekommart_version );
			wp_style_add_data( 'ekommart-elementor', 'rtl', 'replace' );

//			Dark Version
            if ( ekommart_get_theme_option( 'site_mode', 'light' ) === 'dark' ) {
                wp_enqueue_style('ekommart-elementor-dark-style', get_template_directory_uri() . '/assets/css/woocommerce/dark-elementor.css', array(), $ekommart_version);
            }

			// Add Scripts
			wp_register_script( 'tweenmax', get_theme_file_uri( '/assets/js/vendor/TweenMax.min.js' ), array( 'jquery' ), '1.11.1' );
			wp_register_script( 'parallaxmouse', get_theme_file_uri( '/assets/js/vendor/jquery-parallax.js' ), array( 'jquery' ), $ekommart_version );

			if ( ekommart_elementor_check_type( 'animated-bg-parallax' ) ) {
				wp_enqueue_script( 'tweenmax' );
				wp_enqueue_script( 'jquery-panr', get_theme_file_uri( '/assets/js/vendor/jquery-panr' . $suffix . '.js' ), array( 'jquery' ), '0.0.1' );
			}
		}


		public function register_auto_scripts_frontend() {
            global $ekommart_version;
            wp_register_script('ekommart-elementor-animated-headline', get_theme_file_uri('/assets/js/elementor/animated-headline.js'), array('jquery','elementor-frontend'), $ekommart_version, true);
            wp_register_script('ekommart-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $ekommart_version, true);
            wp_register_script('ekommart-elementor-countdown', get_theme_file_uri('/assets/js/elementor/countdown.js'), array('jquery','elementor-frontend'), $ekommart_version, true);
            wp_register_script('ekommart-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $ekommart_version, true);
            wp_register_script('ekommart-elementor-product-deal', get_theme_file_uri('/assets/js/elementor/product-deal.js'), array('jquery','elementor-frontend'), $ekommart_version, true);
            wp_register_script('ekommart-elementor-product-tab', get_theme_file_uri('/assets/js/elementor/product-tab.js'), array('jquery','elementor-frontend'), $ekommart_version, true);
            wp_register_script('ekommart-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $ekommart_version, true);
            wp_register_script('ekommart-elementor-tabs', get_theme_file_uri('/assets/js/elementor/tabs.js'), array('jquery','elementor-frontend'), $ekommart_version, true);
            wp_register_script('ekommart-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $ekommart_version, true);
           
        }

		public function add_category() {
			Elementor\Plugin::instance()->elements_manager->add_category(
				'ekommart-addons',
				array(
					'title' => esc_html__( 'Ekommart Addons', 'ekommart' ),
					'icon'  => 'fa fa-plug',
				),
				1 );
		}

		public function add_animations_scroll( $animations ) {
			$animations['Ekommart Animation'] = [
				'opal-move-up'    => 'Move Up',
				'opal-move-down'  => 'Move Down',
				'opal-move-left'  => 'Move Left',
				'opal-move-right' => 'Move Right',
				'opal-flip'       => 'Flip',
				'opal-helix'      => 'Helix',
				'opal-scale-up'   => 'Scale',
				'opal-am-popup'   => 'Popup',
			];

			return $animations;
		}

		/**
		 * @param $widgets_manager Elementor\Widgets_Manager
		 */
		public function include_widgets( $widgets_manager ) {
			$files = glob( get_theme_file_path( '/inc/elementor/widgets/*.php' ) );
			foreach ( $files as $file ) {
				if ( file_exists( $file ) ) {
					require_once $file;
				}
			}

//			 Button
			add_action( 'elementor/element/button/section_style/after_section_end', function ( $element, $args ) {
				/** @var \Elementor\Element_Base $element */
				$element->update_control( 'button_type', [
					'options' => [
						''        => esc_html__( 'Default', 'ekommart' ),
						'primary' => esc_html__( 'Primary', 'ekommart' ),
						'info'    => esc_html__( 'Info', 'ekommart' ),
						'success' => esc_html__( 'Success', 'ekommart' ),
						'warning' => esc_html__( 'Warning', 'ekommart' ),
						'danger'  => esc_html__( 'Danger', 'ekommart' ),
					],
				] );
			}, 10, 2 );

			// Heading
			add_action( 'elementor/element/heading/section_title_style/after_section_end', function ( $element, $args ) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control( 'title_color', [
					'scheme' => [],
				] );
			}, 10, 2 );

			// Counter
			add_action( 'elementor/element/counter/section_number/after_section_end', function ( $element, $args ) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control( 'title_color', [
					'scheme' => [],
				] );
			}, 10, 2 );

			// Toggle
			add_action( 'elementor/element/toggle/section_toggle_style_title/after_section_end', function ( $element, $args ) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control( 'title_color', [
					'scheme' => [],
				] );

				$element->update_control( 'tab_active_color', [
					'scheme' => [],
				] );
			}, 10, 2 );

			// Image Box
			add_action( 'elementor/element/image-box/section_style_content/after_section_end', function ( $element, $args ) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control( 'title_color', [
					'scheme' => [],
				] );

				$element->update_control( 'title_typography', [
					'scheme' => [],
				] );

				$element->update_control( 'description_color', [
					'scheme' => [],
				] );

				$element->update_control( 'description_typography', [
					'scheme' => [],
				] );
			}, 10, 2 );

			// Icon Box
			add_action( 'elementor/element/icon-box/section_style_content/after_section_end', function ( $element, $args ) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control( 'primary_color', [
					'scheme' => [],
				] );

				$element->update_control( 'title_color', [
					'scheme' => [],
				] );

				$element->update_control( 'title_typography', [
					'scheme' => [],
				] );

				$element->update_control( 'description_color', [
					'scheme' => [],
				] );

				$element->update_control( 'description_typography', [
					'scheme' => [],
				] );
			}, 10, 2 );

			// Icon List
			add_action( 'elementor/element/icon-list/section_text_style/after_section_end', function ( $element, $args ) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control( 'icon_color', [
					'scheme' => [],
				] );

				$element->update_control( 'text_color', [
					'scheme'    => [],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text' => 'color: {{VALUE}};',
					],
				] );

				$element->update_control( 'text_color_hover', [
					'scheme'    => [],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
					],
				] );

				$element->update_control( 'icon_typography', [
					'scheme'    => [],
					'selectors' => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text',
				] );

				$element->update_control( 'divider_color', [
					'scheme'  => [],
					'default' => ''
				] );

			}, 10, 2 );


		}

		public function woocommerce_fix_notice() {
			if ( ekommart_is_woocommerce_activated() ) {
				remove_action( 'woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5 );
				remove_action( 'woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10 );
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
				remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
				remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );
				remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10 );
				remove_action( 'woocommerce_account_content', 'woocommerce_output_all_notices', 10 );
				remove_action( 'woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10 );
			}
		}

		public function add_icons( $manager ) {
            $new_icons = json_decode( '{"ekommart-icon-badge-percent":"badge-percent","ekommart-icon-adobe":"adobe","ekommart-icon-amazon":"amazon","ekommart-icon-android":"android","ekommart-icon-angular":"angular","ekommart-icon-apper":"apper","ekommart-icon-apple":"apple","ekommart-icon-atlassian":"atlassian","ekommart-icon-behance":"behance","ekommart-icon-bitbucket":"bitbucket","ekommart-icon-bitcoin":"bitcoin","ekommart-icon-bity":"bity","ekommart-icon-bluetooth":"bluetooth","ekommart-icon-btc":"btc","ekommart-icon-centos":"centos","ekommart-icon-chrome":"chrome","ekommart-icon-codepen":"codepen","ekommart-icon-cpanel":"cpanel","ekommart-icon-discord":"discord","ekommart-icon-dochub":"dochub","ekommart-icon-docker":"docker","ekommart-icon-dribbble":"dribbble","ekommart-icon-dropbox":"dropbox","ekommart-icon-drupal":"drupal","ekommart-icon-ebay":"ebay","ekommart-icon-facebook":"facebook","ekommart-icon-figma":"figma","ekommart-icon-firefox":"firefox","ekommart-icon-google-plus":"google-plus","ekommart-icon-google":"google","ekommart-icon-grunt":"grunt","ekommart-icon-gulp":"gulp","ekommart-icon-html5":"html5","ekommart-icon-jenkins":"jenkins","ekommart-icon-joomla":"joomla","ekommart-icon-link-brand":"link-brand","ekommart-icon-linkedin":"linkedin","ekommart-icon-mailchimp":"mailchimp","ekommart-icon-opencart":"opencart","ekommart-icon-paypal":"paypal","ekommart-icon-pinterest-p":"pinterest-p","ekommart-icon-reddit":"reddit","ekommart-icon-skype":"skype","ekommart-icon-slack":"slack","ekommart-icon-snapchat":"snapchat","ekommart-icon-spotify":"spotify","ekommart-icon-trello":"trello","ekommart-icon-twitter":"twitter","ekommart-icon-vimeo":"vimeo","ekommart-icon-whatsapp":"whatsapp","ekommart-icon-wordpress":"wordpress","ekommart-icon-yoast":"yoast","ekommart-icon-youtube":"youtube","ekommart-icon-clock":"clock","ekommart-icon-angle-down":"angle-down","ekommart-icon-angle-left":"angle-left","ekommart-icon-angle-right":"angle-right","ekommart-icon-angle-up":"angle-up","ekommart-icon-arrow-circle-down":"arrow-circle-down","ekommart-icon-arrow-circle-left":"arrow-circle-left","ekommart-icon-arrow-circle-right":"arrow-circle-right","ekommart-icon-arrow-circle-up":"arrow-circle-up","ekommart-icon-bars":"bars","ekommart-icon-caret-down":"caret-down","ekommart-icon-caret-left":"caret-left","ekommart-icon-caret-right":"caret-right","ekommart-icon-caret-up":"caret-up","ekommart-icon-cart-empty":"cart-empty","ekommart-icon-check-square":"check-square","ekommart-icon-chevron-circle-left":"chevron-circle-left","ekommart-icon-chevron-circle-right":"chevron-circle-right","ekommart-icon-chevron-down":"chevron-down","ekommart-icon-chevron-left":"chevron-left","ekommart-icon-chevron-right":"chevron-right","ekommart-icon-chevron-up":"chevron-up","ekommart-icon-circle":"circle","ekommart-icon-cloud-download-alt":"cloud-download-alt","ekommart-icon-comment":"comment","ekommart-icon-comments":"comments","ekommart-icon-contact":"contact","ekommart-icon-credit-card":"credit-card","ekommart-icon-dot-circle":"dot-circle","ekommart-icon-edit":"edit","ekommart-icon-envelope":"envelope","ekommart-icon-expand-alt":"expand-alt","ekommart-icon-external-link-alt":"external-link-alt","ekommart-icon-eye":"eye","ekommart-icon-file-alt":"file-alt","ekommart-icon-file-archive":"file-archive","ekommart-icon-filter":"filter","ekommart-icon-folder-open":"folder-open","ekommart-icon-folder":"folder","ekommart-icon-free_ship":"free_ship","ekommart-icon-frown":"frown","ekommart-icon-gift":"gift","ekommart-icon-grip-horizontal":"grip-horizontal","ekommart-icon-heart-fill":"heart-fill","ekommart-icon-heart":"heart","ekommart-icon-history":"history","ekommart-icon-home":"home","ekommart-icon-info-circle":"info-circle","ekommart-icon-instagram":"instagram","ekommart-icon-level-up-alt":"level-up-alt","ekommart-icon-long-arrow-alt-down":"long-arrow-alt-down","ekommart-icon-long-arrow-alt-left":"long-arrow-alt-left","ekommart-icon-long-arrow-alt-right":"long-arrow-alt-right","ekommart-icon-long-arrow-alt-up":"long-arrow-alt-up","ekommart-icon-map-marker-check":"map-marker-check","ekommart-icon-meh":"meh","ekommart-icon-minus-circle":"minus-circle","ekommart-icon-mobile-android-alt":"mobile-android-alt","ekommart-icon-money-bill":"money-bill","ekommart-icon-pencil-alt":"pencil-alt","ekommart-icon-plus-circle":"plus-circle","ekommart-icon-plus":"plus","ekommart-icon-quote":"quote","ekommart-icon-random":"random","ekommart-icon-reply-all":"reply-all","ekommart-icon-reply":"reply","ekommart-icon-search-plus":"search-plus","ekommart-icon-search":"search","ekommart-icon-shield-check":"shield-check","ekommart-icon-shopping-basket":"shopping-basket","ekommart-icon-shopping-cart":"shopping-cart","ekommart-icon-sign-out-alt":"sign-out-alt","ekommart-icon-smile":"smile","ekommart-icon-spinner":"spinner","ekommart-icon-square":"square","ekommart-icon-star":"star","ekommart-icon-store":"store","ekommart-icon-sync":"sync","ekommart-icon-tachometer-alt":"tachometer-alt","ekommart-icon-th-large":"th-large","ekommart-icon-th-list":"th-list","ekommart-icon-thumbtack":"thumbtack","ekommart-icon-times-circle":"times-circle","ekommart-icon-times":"times","ekommart-icon-trophy-alt":"trophy-alt","ekommart-icon-truck":"truck","ekommart-icon-user-headset":"user-headset","ekommart-icon-user-shield":"user-shield","ekommart-icon-user":"user","ekommart-icon-headphones-alt":"headphones-alt","ekommart-icon-map-marker-alt":"map-marker-alt","ekommart-icon-mitten":"mitten","ekommart-icon-paw-alt":"paw-alt","ekommart-icon-payment_1":"payment_1","ekommart-icon-payment_2":"payment_2","ekommart-icon-payment_3":"payment_3","ekommart-icon-payment_4":"payment_4","ekommart-icon-payment_5":"payment_5","ekommart-icon-payment_6":"payment_6","ekommart-icon-phone-rotary":"phone-rotary","ekommart-icon-rings-wedding":"rings-wedding","ekommart-icon-rocket":"rocket","ekommart-icon-shapes":"shapes","ekommart-icon-tire":"tire","ekommart-icon-tracking_1":"tracking_1","ekommart-icon-tracking_2":"tracking_2","ekommart-icon-tracking_3":"tracking_3","ekommart-icon-tshirt":"tshirt","ekommart-icon-tv":"tv","ekommart-icon-volleyball-ball":"volleyball-ball"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

		public function add_icons_native( $tabs ) {
			global $ekommart_version;
			$tabs['opal-custom'] = [
				'name'          => 'ekommart-icon',
				'label'         => esc_html__( 'Ekommart Icon', 'ekommart' ),
				'prefix'        => 'ekommart-icon-',
				'displayPrefix' => 'ekommart-icon-',
				'labelIcon'     => 'fab fa-font-awesome-alt',
				'ver'           => $ekommart_version,
				'fetchJson'     => get_theme_file_uri( '/inc/elementor/icons.json' ),
				'native'        => true,
			];

			return $tabs;
		}
	}

endif;

return new Ekommart_Elementor();

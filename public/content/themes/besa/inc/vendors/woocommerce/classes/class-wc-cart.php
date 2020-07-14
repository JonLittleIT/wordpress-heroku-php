<?php
if ( ! defined( 'ABSPATH' ) || !class_exists('WooCommerce') ) {
	exit;
}

if ( ! class_exists( 'Besa_Cart' ) ) :


	class Besa_Cart  {

		static $instance;

		/**
		 * @return osf_WooCommerce
		 */
		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Besa_Cart ) ) {
				self::$instance = new Besa_Cart();
			}

			return self::$instance;
		}

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 *
		 */
		public function __construct() {

			/*Cart modal*/
			add_action( 'wp_ajax_besa_add_to_cart_product', array( $this, 'woocommerce_cart_modal'), 10 );
			add_action( 'wp_ajax_nopriv_besa_add_to_cart_product', array( $this, 'woocommerce_cart_modal'), 10 );
			add_action( 'wp_footer', array( $this, 'add_to_cart_modal_html'), 20 );

			add_filter( 'besa_cart_position', array( $this, 'woocommerce_cart_position'), 10 ,1 );  

			add_filter( 'body_class', array( $this, 'body_classes_cart_postion' ), 40, 1 );

			/*Mobile add to cart message html*/
			add_filter( 'wc_add_to_cart_message_html', array( $this, 'add_to_cart_message_html_mobile'), 10, 1 );

			/*Show Add to Cart on mobile*/
			add_filter( 'besa_show_cart_mobile', array( $this, 'show_cart_mobile'), 10, 1 );
			add_filter( 'body_class', array( $this, 'body_classes_show_cart_mobile'), 10, 1 );
		}

		public function add_to_cart_modal_html() {
			if( is_account_page() || is_checkout() || ( function_exists('is_vendor_dashboard') && is_vendor_dashboard() ) ) return;        
		    ?>
		    <div id="tbay-cart-modal" tabindex="-1" role="dialog" aria-hidden="true">
		        <div class="modal-dialog modal-lg">
		            <div class="modal-content">
		                <div class="modal-body">
		                    <div class="modal-body-content"></div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <?php    
		}


		public function woocommerce_cart_modal() {
			wc_get_template( 'content-product-cart-modal.php' , array( 'product_id' => (int)$_GET['product_id'], 'product_qty' => (int)$_GET['product_qty'] ) ); 
			die;
		}

		public function woocommerce_cart_position() {
			if( wp_is_mobile() ) { 
	            return 'right'; 
	        }

	        $position_array = array("popup", "left", "right", "no-popup");

	        $position = besa_tbay_get_config('woo_mini_cart_position', 'popup');

	        $position = ( isset($_GET['ajax_cart']) ) ? $_GET['ajax_cart'] : $position;

	        $position =  (!in_array($position, $position_array)) ? besa_tbay_get_config('woo_mini_cart_position', 'popup') : $position;

	        return $position;
		}


		public function body_classes_cart_postion( $classes ) {
			$position = apply_filters( 'besa_cart_position', 10,2 ); 

	        $class = ( isset($_GET['ajax_cart']) ) ? 'ajax_cart_'.$_GET['ajax_cart'] : 'ajax_cart_'.$position;

	        $classes[] = trim($class);

	        return $classes;
		}


		public function add_to_cart_message_html_mobile( $message ) {
			if ( isset( $_REQUEST['besa_buy_now'] ) && $_REQUEST['besa_buy_now'] == true ) {
	            return __return_empty_string();
	        }

	        if ( wp_is_mobile() && ! intval( besa_tbay_get_config('enable_buy_now', false) ) ) {
	            return __return_empty_string();     
	        } else {
	            return $message;
	        }
		}

		public function show_cart_mobile() {
			$active = besa_tbay_get_config('enable_add_cart_mobile', false);

	        $active = (isset($_GET['add_cart_mobile'])) ? $_GET['add_cart_mobile'] : $active;

	        return $active;
		}

		public function body_classes_show_cart_mobile( $classes ) {
	 		$class = '';
	        $active = apply_filters( 'besa_show_cart_mobile', 10,2 );
	        if( isset($active) && $active ) {  
	            $class = 'tbay-show-cart-mobile';
	        }

	        $classes[] = trim($class);

	        return $classes;
		}

	}
endif;


if ( !function_exists('besa_cart') ) {
	function besa_cart() { 
		return Besa_Cart::getInstance();
	}
	besa_cart();
}
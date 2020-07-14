<?php
if ( ! defined( 'ABSPATH' ) || !class_exists('WooCommerce') ) {
	exit;
}

if ( ! class_exists( 'Besa_Shop_WooCommerce' ) ) :


	class Besa_Shop_WooCommerce  {

		static $instance;

		/**
		 * @return osf_WooCommerce
		 */
		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Besa_Shop_WooCommerce ) ) {
				self::$instance = new Besa_Shop_WooCommerce();
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

			add_action( 'woocommerce_archive_description', array( $this, 'shop_category_image'), 2 );
			add_action('woocommerce_before_main_content', array( $this, 'shop_remove_des_image'), 20);

			/*Shop page*/
			add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_display_modes'), 40 );
			add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_filter_before') , 1 );
			add_action( 'woocommerce_before_shop_loop', array( $this, 'content_shop_filter_before') , 15 );
			add_action( 'woocommerce_before_shop_loop', array( $this, 'content_shop_filter_after') , 70 );
			add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_filter_after') , 70 );

			add_action( 'besa_woo_template_main_before', array( $this, 'shop_product_top_sidebar'), 50 );

			add_filter( 'loop_shop_per_page', array( $this, 'shop_per_page'), 10 );
			add_filter( 'loop_shop_columns', array( $this, 'shop_columns'), 10 );

			add_action( 'besa_tbay_after_shop_loop_item_title', array( $this, 'add_slider_image'), 10 );

			/*display image mode*/
			add_filter( 'besa_woo_display_image_mode', array( $this, 'get_display_image_mode'), 10, 1 );

			add_filter( 'besa_woo_config_product_layout', array( $this, 'product_layout_style') );

			add_action('woocommerce_before_shop_loop_item_title', array( $this, 'the_display_image_mode'), 10);

			/*swatches*/
			add_action( 'besa_woo_after_shop_loop_item_caption', array( $this, 'the_woocommerce_variable'), 10 );
			add_action( 'besa_woo_list_after_short_description', array( $this, 'the_woocommerce_variable'), 5 );
			add_action( 'besa_woo_before_shop_loop_item_caption', array( $this, 'grid_variable_swatches_pro'), 10 );
			add_action( 'besa_woo_list_after_short_description', array( $this, 'list_variable_swatches_pro'), 5 );

			/*Shop load more*/
			add_action('wp_ajax_nopriv_tbay_more_post_ajax', array( $this, 'shop_load_more'), 10);
			add_action('wp_ajax_tbay_more_post_ajax', array( $this, 'shop_load_more'), 10);

			/*Shop filter config*/
			add_action( 'init', array( $this, 'shop_filter_config'), 10 );

			/*Shop Query*/
			add_action( 'woocommerce_product_query', array( $this, 'product_per_page_query'), 10, 2 );
			add_action( 'woocommerce_product_query', array( $this, 'product_category_query'),30 ,2 );

			/*Load more shop pagination*/
			add_action('wp_ajax_nopriv_tbay_pagination_more_post_ajax', array( $this, 'pagination_more_post_ajax'), 10);
			add_action('wp_ajax_tbay_pagination_more_post_ajax', array( $this, 'pagination_more_post_ajax'), 10);
 
			/*Load more shop grid*/
			add_action('wp_ajax_nopriv_tbay_grid_post_ajax', array( $this, 'ajax_load_more_grid_product'), 10);
			add_action('wp_ajax_tbay_grid_post_ajax', array( $this, 'ajax_load_more_grid_product'), 10);

			/*Load more shop list*/
			add_action('wp_ajax_nopriv_tbay_list_post_ajax', array( $this, 'ajax_load_more_list_product'), 10);
			add_action('wp_ajax_tbay_list_post_ajax', array( $this, 'ajax_load_more_list_product'), 10);

			/*Display category image on category archive*/
			add_action('woocommerce_before_main_content', array( $this, 'shop_product_top_archive'), 10);


			add_filter( 'besa_woo_subcat', array( $this, 'subcat_archives'), 10, 1 );
			add_filter( 'besa_woocommerce_sub_categories', array( $this, 'show_product_subcategories'), 10, 1 );

			add_filter( 'besa_sidebar_top_archive', array( $this, 'sidebar_top_archive_active'), 10, 1 );

			add_filter( 'woocommerce_show_page_title' , array( $this, 'remove_title_product_archives_active'), 10, 1 );

			add_filter( 'besa_woo_config_display_mode', array( $this, 'display_modes_active'), 10, 1 );

			/*The YITH BRAND*/
			add_action('besa_woo_before_shop_loop_item_caption', array( $this, 'the_brands_the_name') , 10);
			add_action('besa_woo_before_shop_list_caption', array( $this, 'the_brands_the_name') , 10);

			/** Add recent view */
			add_action( 'woocommerce_after_main_container', array( $this, 'recent_viewed') , 0 );
		}

		public function shop_display_modes() {

			$active  = apply_filters( 'besa_woo_config_display_mode', 10,2 );

	        if ( !$active || !wc_get_loop_prop( 'is_paginated' ) || ( !woocommerce_products_will_display() && !besa_woo_is_vendor_page() ) ) {
	            return;
	        }
	        
			$woo_mode      = besa_tbay_woocommerce_get_display_mode();

	        $grid = ($woo_mode == 'grid') ? 'active' : '';
	        $list = ($woo_mode == 'list') ? 'active' : '';

	        ?>
	        <div class="display-mode-warpper">
	        	<span><?php esc_html_e('View: ','besa'); ?></span>
	            <a href="javascript:void(0);" id="display-mode-grid" class="display-mode-btn <?php echo esc_attr($grid); ?>" title="<?php esc_attr_e('Grid','besa'); ?>" ><i class="fas fa-th-large"></i></a>
	            <a href="javascript:void(0);" id="display-mode-list" class="display-mode-btn list <?php echo esc_attr($list); ?>" title="<?php esc_attr_e('List','besa'); ?>" ><i class="fas fa-th-list"></i></a>
	        </div>

	        <?php
		}

		public function shop_filter_before() {
			$notproducts =  ( besa_is_check_hidden_filter() ) ? ' hidden' : '';

	        echo '<div class="tbay-filter'. esc_attr( $notproducts ) . '">';
		}

		public function shop_filter_after() {	
			echo '</div>';
		}
		
		public function content_shop_filter_before() {
	        echo '<div class="main-filter d-flex justify-content-end">';
		}

		public function content_shop_filter_after() {	
			echo '</div>';
		}

		public function shop_product_top_sidebar() {

			$sidebar_configs = besa_tbay_get_woocommerce_layout_configs();

	        if( !is_product()  && isset($sidebar_configs['product_top_sidebar']) && $sidebar_configs['product_top_sidebar'] ) {
	            ?>

	            <?php if(is_active_sidebar('product-top-sidebar')) : ?>
	                <div class="product-top-sidebar">
	                    <div class="container">
	                        <div class="content">
	                            <?php dynamic_sidebar('product-top-sidebar'); ?>
	                        </div>
	                    </div>
	                </div>
	            <?php endif;
	        } 

		}

		public function shop_per_page() {

			if( isset($_GET['product_per_page']) && is_numeric($_GET['product_per_page']) ) {
	            $value = $_GET['product_per_page']; 
	        } else {
	            $value = besa_tbay_get_config('number_products_per_page', 12);          
	        }

	        if ( is_numeric( $value ) && $value ) {
	            $number = absint( $value );
	        }
	        return $number;

		}

		public function shop_columns() {

			if( isset($_GET['product_columns']) && is_numeric($_GET['product_columns']) ) {
	            $value = $_GET['product_columns']; 
	        } else {
	          $value = besa_tbay_get_config('product_columns', 4);          
	        }

	        if ( in_array( $value, array(1, 2, 3, 4, 5, 6) ) ) {
	            $number = $value;
	        }

	        return $number;

		}

		public function add_slider_image() {

			if( wp_is_mobile() ) return;

	        $images_mode   = apply_filters( 'besa_woo_display_image_mode', 10,2 );

	        if( $images_mode == 'slider' ) {
	            echo besa_tbay_woocommerce_get_silder_product_thumbnail();
	        }

		}

		public function get_display_image_mode( $mode ) {
			$mode = besa_tbay_get_config('product_display_image_mode', 'one');

			$mode = (isset($_GET['display_image_mode'])) ? $_GET['display_image_mode'] : $mode;

			if( wp_is_mobile() ) $mode = 'one';

			return $mode;
		}

		public function the_display_image_mode() {

		 	$images_mode   = apply_filters( 'besa_woo_display_image_mode', 10,2 );

	        if( wp_is_mobile() ) $images_mode = 'one';

	        switch ($images_mode) {
	            case 'one':
	                echo woocommerce_get_product_thumbnail();
	                break;        

	            case 'two':
	                echo besa_tbay_woocommerce_get_two_product_thumbnail();
	                break;
	                
	            case 'slider':
	                echo '';
	                break;
	            
	            default:
	                echo woocommerce_get_product_thumbnail();
	                break;
	        }

		}

		public function the_woocommerce_variable() {
			global $product;

	        $active = apply_filters( 'besa_enable_variation_selector', 10,2 );

	        if( $product->is_type( 'variable' ) && class_exists( 'Woo_Variation_Swatches' ) && $active  ) {

	            ?>
	            	<?php echo besa_swatches_list() ?>
	            <?php

	        }
		}

		public function grid_variable_swatches_pro() {

			if ( class_exists( 'Woo_Variation_Swatches_Pro' )  ) {
			    add_action( 'besa_woo_after_shop_loop_item_caption', 'wvs_pro_archive_variation_template', 10 ); 
			}

		}

		public function list_variable_swatches_pro() {
			if ( class_exists( 'Woo_Variation_Swatches_Pro' ) ) {
	            add_action( 'woocommerce_after_shop_loop_item_title', 'wvs_pro_archive_variation_template', 20 ); 
	        }
		}

		public function shop_load_more() {

	 		global $woocommerce_loop,$product_load_more; 

	        $columns                    =   (isset($_POST["columns"])) ? $_POST["columns"] : 4;
	        $layout                     =   (isset($_POST["layout"])) ? $_POST["layout"] : '';
	        $number                     =   (isset($_POST["number"])) ? $_POST["number"] : 8;
	        $type                       =   (isset($_POST["type"])) ? $_POST["type"] : 'featured_product';
	        $paged                      =   (isset($_POST["paged"])) ? $_POST["paged"] : 1;
	        $category                   =   (isset($_POST["category"])) ? $_POST["category"] : '';
	        $screen_desktop             =   (isset($_POST["screen_desktop"])) ? $_POST["screen_desktop"] : '';
	        $screen_desktopsmall        =   (isset($_POST["screen_desktopsmall"])) ? $_POST["screen_desktopsmall"] : '';
	        $screen_tablet              =   (isset($_POST["screen_tablet"])) ? $_POST["screen_tablet"] : '';
	        $screen_mobile              =   (isset($_POST["screen_mobile"])) ? $_POST["screen_mobile"] : '';


	        $product_item = isset($product_item) ? $product_item : 'inner';


	        if(empty($category)) {
	            $category = -1;
	        }

	        $offset         = $number*3;
	        $number_load    = $columns*3;

	        $woocommerce_loop['columns'] = $columns;

	        $product_load_more['class'] = 'variable-load-more-'.$paged;

	        if((strpos($category, ',') !== false )) {
	            $categories = explode(',', $category); 
	            $loop = besa_tbay_get_products( $categories, $type , $paged, $number_load, '', '', $number, $offset );
	        } else {

	            if( $category == -1 ) {
	                $loop = besa_tbay_get_products( '', $type , $paged, $number_load, '', '', $number, $offset );
	            } else {
	              $loop = besa_tbay_get_products( array($category), '' , $paged, $number_load, '', '', $number, $offset );  
	            } 

	        } 

	        $count = 0;


	        if($loop->have_posts()) :
	        ob_start();

	             while ( $loop->have_posts() ) : $loop->the_post(); ?>

	                <?php 

	                    wc_get_template( 'content-products.php', array('product_item' => $product_item,'columns' => $columns,'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile) );

	                ?>


	                <?php $count++; ?>
	            <?php endwhile; ?>
	        <?php endif;

	        wp_reset_postdata();

	        $posts = ob_get_clean();

	        if($paged >= $loop->max_num_pages || $number_load > $loop->post_count )
	            $result['check'] = false;
	        else
	            $result['check'] = true;

	        $result['posts'] = $posts;
	        print_r(json_encode($result));
	        exit();

		}

		public function shop_category_image() {
			$active = apply_filters( 'besa_woo_pro_des_image', 10,2 );
			if( !$active ) return;

			if ( is_product_category() && !is_search()  ){
				global $wp_query;
				$cat = $wp_query->get_queried_object();
				$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );
				if ( $image ) {
					echo '<img src="' . esc_url($image) . '" alt="' . esc_attr( $cat->name) . '" />';
				}
			}
		}

		function shop_remove_des_image() { 
			$active = apply_filters( 'besa_woo_pro_des_image', 10,2 );
	
		    if ( !$active ) {
				remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
				remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
		   }
		}

		public function product_type_fillter(){
	        $default = 'best_selling';
	        $options = array(
	            'best_selling'      => esc_html__('Best Selling', 'besa'),
	            'featured_product'  => esc_html__('Featured Products', 'besa'),
	            'recent_product'    => esc_html__('Recent Products', 'besa'),
	            'on_sale'           => esc_html__('On Sale', 'besa'),
	            'random_product'    => esc_html__('Random Products', 'besa')
	        );
	        $name = 'product_type';
	        besa_woocommerce_product_fillter($options, $name, $default);
	    }
	    public  function product_per_page_fillter(){
	        $columns = besa_tbay_get_config('product_columns', 4);
	        $default = besa_tbay_get_config('number_products_per_page');
	        $options= array();
	        for($i=1; $i<=5; $i++){
	            $options[$i*$columns] =  $i*$columns.' '.esc_html__( ' products', 'besa');
	        }
	        $options['-1'] = esc_html__('All products', 'besa' );
	        $name = 'product_per_page';
	        besa_woocommerce_product_fillter($options, $name, $default);
	    }
	    public function product_category_fillter(){

	        $taxonomy       = 'product_cat';
	        $orderby        = 'name';  
	        $pad_counts     = 0;      // 1 for yes, 0 for no
	        $hierarchical   = 1;      // 1 for yes, 0 for no   
	        $empty          = 0;
	        $posts_per_page =  -1;

	        $args = array(
	            'taxonomy'       => $taxonomy, 
	            'orderby'        => $orderby,
	            'posts_per_page' => $posts_per_page,
	            'pad_counts'     => $pad_counts,
	            'hierarchical'   => $hierarchical,
	            'hide_empty'     => $empty
	        );

	        $all_categories = get_categories( $args );

	        $options = array();
	        $class = array();
	        $options['-1'] = esc_html__('All Categories', 'besa' );
	        $class[] = 'level-0';
	        $default = esc_html__('All Categories', 'besa' );
	        foreach ($all_categories as $cat) {
	            if($cat->category_parent == 0) {
	                $cat_name   =   $cat->name;    
	                $cat_id     =   $cat->term_id;    
	                $cat_slug   =   $cat->slug;    
	                $count      =   $cat->count;
	                $level      =   0;

	                $options[$cat_slug]      =  $cat_name.'('.$count.')';
	                $class[]                 = 'level-'.$level;

	                $taxonomy       =   'product_cat';
	                $orderby        =   'name';  
	                $pad_counts     =   0;      // 1 for yes, 0 for no
	                $hierarchical   =   1;      // 1 for yes, 0 for no   
	                $empty          =   0;
	                $posts_per_page =  -1;


	                $args2 = array(
	                        'child_of'      => 0,
	                        'parent'         => $cat_id,
	                        'taxonomy'       => $taxonomy, 
	                        'orderby'        => $orderby,
	                        'posts_per_page' => $posts_per_page,
	                        'pad_counts'     => $pad_counts,
	                        'hierarchical'   => $hierarchical,
	                        'hide_empty'     => $empty
	                );

	                $sub_cats = get_categories( $args2 );


	                if($sub_cats) {
	                    $level ++;

	                    foreach($sub_cats as $sub_category) {

	                        $sub_cat_name               =   $sub_category->name;    
	                        $sub_cat_id                 =   $sub_category->term_id;    
	                        $sub_cat_slug               =   $sub_category->slug;    
	                        $sub_count                  =   $sub_category->count;
	                        $class[]                    =  'level-'.$level;

	                        $options[$sub_cat_slug]     =  $sub_cat_name.'('.$sub_count.')';


	                        $taxonomy       =   'product_cat';
	                        $orderby        =   'name';  
	                        $pad_counts     =   0;      // 1 for yes, 0 for no
	                        $hierarchical   =   1;      // 1 for yes, 0 for no   
	                        $empty          =   0;
	                        $posts_per_page =  -1;


	                        $args2 = array(
	                                'child_of'      => 0,
	                                'parent'         => $sub_cat_id,
	                                'taxonomy'       => $taxonomy, 
	                                'orderby'        => $orderby,
	                                'posts_per_page' => $posts_per_page,
	                                'pad_counts'     => $pad_counts,
	                                'hierarchical'   => $hierarchical,
	                                'hide_empty'     => $empty
	                        );

	                        $sub_cats = get_categories( $args2 );


	                        if($sub_cats) {
	                            $level ++;

	                            foreach($sub_cats as $sub_category) {

	                                $sub_cat_name               =   $sub_category->name;    
	                                $sub_cat_id                 =   $sub_category->term_id;    
	                                $sub_cat_slug               =   $sub_category->slug;    
	                                $sub_count                  =   $sub_category->count;
	                                $class[]                    =  'level-'.$level;

	                                $options[$sub_cat_slug]     =  $sub_cat_name.'('.$sub_count.')';
	                            }
	                        }

	                    }
	                }

	            }
	        }
	                        
	        $name = 'product_category';

	        besa_woocommerce_product_fillter($options, $name, $default, $class);
	    }
		public function shop_filter_config() {
			if( isset($_GET['product_type_fillter'])  ) {
	            $product_type_fillter = $_GET['product_type_fillter'];
	        } else {
	            $product_type_fillter = besa_tbay_get_global_config('product_type_fillter');
	        }        

	        if( isset($_GET['product_per_page_fillter'])  ) {
	            $product_per_page_fillter = $_GET['product_per_page_fillter'];
	        } else {
	            $product_per_page_fillter = besa_tbay_get_global_config('product_per_page_fillter');
	        }        

	        if( isset($_GET['product_category_fillter'] )  ) {
	            $product_category_fillter = $_GET['product_category_fillter'];
	        } else {
	            $product_category_fillter = besa_tbay_get_global_config('product_category_fillter');
	        }

	        if ( $product_type_fillter ) {
	            add_action( 'woocommerce_product_query', array( $this, 'product_type_query'), 20 ,2 );
	            add_action('woocommerce_before_shop_loop', array( $this, 'product_type_fillter'), 25);
	        }

	        if ( $product_per_page_fillter ) {
	            add_action('woocommerce_before_shop_loop', array( $this, 'product_per_page_fillter'), 25);
	        }

	        if ( $product_category_fillter ) {
	            add_action('woocommerce_before_shop_loop', array( $this, 'product_category_fillter'), 25);
	        }
		}

		public function product_per_page_query( $q ) {
			$default            = besa_tbay_get_config('number_products_per_page');
			$product_per_page   = besa_woocommerce_get_fillter('product_per_page',$default);
			if ( function_exists( 'woocommerce_products_will_display' ) && $q->is_main_query() ) :
				$q->set( 'posts_per_page', $product_per_page );
			endif;
		}
		public function product_type_query( $q ) {
	        $name = 'product_type';
	        $default = 'recent_products';

	        $product_type = besa_woocommerce_get_fillter($name, $default);
	        $args    = besa_woocommerce_meta_query($product_type);
	        $queries = array('meta_key', 'orderby', 'order', 'post__in', 'tax_query', 'meta_query');
	        if ( function_exists( 'woocommerce_products_will_display' ) && $q->is_main_query() ) :
	            foreach($queries as $query){
	                if(isset($args[$query])){
	                    $q->set( $query, $args[$query] );
	                }
	            }
	        endif;
		}
		
		public function product_category_query( $q ) {

			$default            = -1;
	        $product_cat        = besa_woocommerce_get_fillter('product_category',$default);


	        $tax_query = (array) $q->get( 'tax_query' );

	        $tax_query[] = array(
	                'posts_per_page' => -1,
	                'tax_query' => array(
	                    'relation' => 'AND',
	                    array(
	                        'taxonomy' => 'product_cat',
	                        'field' => 'slug',
	                        'terms' => $product_cat
	                    )
	                ),
	                'post_type' => 'product',
	                'orderby' => 'title,'
	        );


	        if ( function_exists( 'woocommerce_products_will_display' ) && $q->is_main_query() && $product_cat != -1 ) :
	           $q->set( 'tax_query', $tax_query );
	        endif;

		}

		public function pagination_more_post_ajax() {
			// prepare our arguments for the query
	        $args = json_decode( stripslashes( $_POST['query'] ), true );
	        $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	        $args['post_status'] = 'publish';

	        $shown_des = true;
	     
	        // it is always better to use WP_Query but not here
	        query_posts( $args );
	      
	        if( have_posts() ) :
	     
	            while( have_posts() ): the_post();
	     
	                wc_get_template( 'content-product.php', array('shown_des' => $shown_des));

	     
	            endwhile;
	     
	        endif;
	        die; // here we exit the script and even no wp_reset_query() required!
		}

		public function ajax_load_more_grid_product() {
			// prepare our arguments for the query
	        $args = json_decode( stripslashes( $_POST['query'] ), true );
	     
	        // it is always better to use WP_Query but not here
	        query_posts( $args );

	        $list = 'grid';
	      
	        if( have_posts() ) :
	     
	            while( have_posts() ): the_post();
	     
	                wc_get_template( 'content-product.php', array('list' => $list));

	     
	            endwhile;
	     
	        endif;
	        die; // here we exit the script and even no wp_reset_query() required!
		}

		public function shop_product_top_archive() {
			if( !is_product() && !is_search() ){
	            $active = apply_filters( 'besa_sidebar_top_archive', 10,2 );
	            $active = ( is_search() ) ? false : $active; 
	            $sidebar_id = 'product-top-archive';

	            if( $active && is_active_sidebar($sidebar_id) ) { ?> 
	                <aside id="sidebar-top-archive" class="sidebar top-archive-content">
	                <?php dynamic_sidebar($sidebar_id); ?>
	            </aside>
	            <?php }
	        }
		}

		public function product_layout_style() {
	        $type_array   = apply_filters( 'besa_get_template_product', 10,1 );
	        $type = besa_tbay_get_config('product_layout_style', 'v1'); 

	        $type = (isset($_GET['product_layout_style'])) ? $_GET['product_layout_style'] : $type;
	        
	        if (!in_array( $type, $type_array)) $type = 'v1';
	  
	        if( apply_filters( 'besa_product_layout_mobile', wp_is_mobile() ) ) {
	            $type = 'v1';
	        }
	        

	        return $type;
		}

		public function ajax_load_more_list_product() {
	 		// prepare our arguments for the query
	        $args = json_decode( stripslashes( $_POST['query'] ), true );
	     
	        // it is always better to use WP_Query but not here
	        query_posts( $args );

	        $list = 'list'; 
	     
	        if( have_posts() ) :
	     
	            while( have_posts() ): the_post();
	     
	                wc_get_template( 'content-product.php', array('list' => $list));

	     
	            endwhile;
	     
	        endif;
	        die; // here we exit the script and even no wp_reset_query() required!
		}

		public function subcat_archives() {
	        $active = (isset($_GET['subcat'])) ? (boolean)$_GET['subcat'] : (boolean)$active;

	        return $active;
		}

		public function show_product_subcategories( $loop_html = '' ) {
			if ( wc_get_loop_prop( 'is_shortcode' ) && ! WC_Template_Loader::in_content_filter() ) {
	            return $loop_html;
	        }

	        $display_type = woocommerce_get_loop_display_mode();

	        // If displaying categories, append to the loop.
	        if ( 'subcategories' === $display_type || 'both' === $display_type ) {
	            ob_start();
	            woocommerce_output_product_categories( array(
	                'parent_id' => is_product_category() ? get_queried_object_id() : 0,
	            ) );
	            $loop_html .= ob_get_clean();

	            if ( 'subcategories' === $display_type ) {
	                wc_set_loop_prop( 'total', 0 );

	                // This removes pagination and products from display for themes not using wc_get_loop_prop in their product loops.  @todo Remove in future major version.
	                global $wp_query;

	                if ( $wp_query->is_main_query() ) {
	                    $wp_query->post_count    = 0;
	                    $wp_query->max_num_pages = 0;
	                }
	            }
	        }

	        return $loop_html;
		}

		public function sidebar_top_archive_active( $active ) {
	 		$active = besa_tbay_get_config('show_product_top_archive', false);

	        $active = (isset($_GET['product_top_archive'])) ? (boolean)$_GET['product_top_archive'] : (boolean)$active;

	        return $active;
		}

		public function title_product_archives_active( ) {
	 		$active = besa_tbay_get_config('title_product_archives', false);

	        $active = (isset($_GET['title_product_archives'])) ? (boolean)$_GET['title_product_archives'] : (boolean)$active;

	        return $active;
		}

		public function remove_title_product_archives_active() {
			$active = $this->title_product_archives_active();

	        $active = ( is_search() ) ? true : $active; 

	        return $active;
		}


		public function display_modes_active() {
	 		$active = besa_tbay_get_config('enable_display_mode', true);

	        $active = (isset($_GET['enable_display_mode'])) ? (boolean)$_GET['enable_display_mode'] : (boolean)$active;

	        return $active;
		}


		public function the_brands_the_name() {
			if( !besa_tbay_get_config('enable_brand', false) ) return;

	        $brand = '';
	        if( class_exists( 'YITH_WCBR' ) ) {

	            global $product;

	            $terms = wp_get_post_terms($product->get_id(),'yith_product_brand');

	            if($terms && defined( 'YITH_WCBR' ) && YITH_WCBR) {

	                $brand  .= '<ul class="show-brand">';

	                foreach ($terms as $term) {
	                    
	                    $name = $term->name;
	                    $url = get_term_link( $term->slug, 'yith_product_brand' );

	                    $brand  .= '<li><a href="'. esc_url($url) .'">'. esc_html($name) .'</a></li>';

	                }

	                $brand  .= '</ul>';
	            }
	        
	        }

	        echo  trim($brand);
		}

		public function recent_viewed() {
			besa_tbay_wc_the_recently_viewed();
		}

	}
endif;


if ( !function_exists('besa_shop_wooCommerce') ) {
	function besa_shop_wooCommerce() { 
		return Besa_Shop_WooCommerce::getInstance();
	}
	besa_shop_wooCommerce();
}
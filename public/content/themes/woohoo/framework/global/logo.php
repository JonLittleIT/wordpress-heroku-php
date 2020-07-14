<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

global $post;
if( is_category() || is_single() )
{
	if( is_category() ) $category_id = get_query_var('cat') ;
	if( is_single() )
	{
		$categories = get_the_category( get_the_ID() );
		if( !empty( $categories[0]->term_id ) ) $category_id = $categories[0]->term_id;
	}

	if( !empty( $category_id ) ) {
		$cat_options = get_option("bd_cat_$category_id");
	}

	if( isset($cat_options['logo_displays']) ){
		$cat_dis = $cat_options['logo_displays'];
	}
}

##
$cat_logo_title = "";
if( isset( $cat_dis['logo_title'] ) ){
	$cat_logo_title = $cat_dis['logo_title'];
}

##
$cat_logo_image = "";
if( isset( $cat_dis['logo_image'] ) ){
	$cat_logo_image = $cat_dis['logo_image'];
}

##
$cat_logoText = "";
if( isset( $cat_options['logoText'] ) ){
	$cat_logoText = $cat_options['logoText'];
}

##
$cat_tagline = "";
if( isset( $cat_options['tagline'] ) ){
	$cat_tagline = $cat_options['tagline'];
}

##
$cat_taglineText = "";
if( isset( $cat_options['taglineText'] ) ){
	$cat_taglineText = $cat_options['taglineText'];
}

##
$cat_logo_upload = "";
if( isset( $cat_options['logo_upload'] ) ){
	$cat_logo_upload = $cat_options['logo_upload'];
}

##
$cat_logo_retina = "";
if( isset( $cat_options['logo_retina'] ) ){
	$cat_logo_retina = $cat_options['logo_retina'];
}

##
$cat_retina_logo_width = "";
if( isset( $cat_options['retina_logo_width'] ) ){
	$cat_retina_logo_width = $cat_options['retina_logo_width'];
}

##
$cat_logo_displays = "";
if( isset( $cat_options['logo_displays'] ) ){
	$cat_logo_displays = $cat_options['logo_displays'];
}

$logo_top      = woohoo_get_option( 'margin_logo_top' );
$logo_right    = woohoo_get_option( 'margin_logo_right' );
$logo_bottom   = woohoo_get_option( 'margin_logo_bottom' );
$logo_left     = woohoo_get_option( 'margin_logo_left' );

$logo_text_color     = woohoo_get_option( 'logo_text_color' );

$logo_css ='';
if( !empty( $logo_top ) || !empty( $logo_bottom ) || !empty( $logo_right ) || !empty( $logo_left ) || !empty( $logo_text_color ) ) {
	$logo_css = ' style="';
	if( !empty( $logo_top ) ) $logo_css .= ' margin-top:'.$logo_top.'px !important;';
	if( !empty( $logo_bottom ) ) $logo_css .= ' margin-bottom:'.$logo_bottom.'px !important;';
	if( !empty( $logo_right ) ) $logo_css .= ' margin-right:'.$logo_right.'px !important;';
	if( !empty( $logo_left ) ) $logo_css .= ' margin-left:'.$logo_left.'px !important;';
	$logo_css .= '"';
}

?>

<?php
if( !empty($cat_options['logo_displays']) ){
	?>
    <div class="logo site--logo"<?php echo $logo_css; ?>>
		<?php
		if ( !is_single() && !is_category() && !is_tag() ) :
			if ( is_home() || is_front_page() ) :
				echo '<h1 class="site-title">';
			else :
				echo '<h2 class="site-title">';
			endif;
		else :
			echo '<h2 class="site-title">';
		endif;
		?>
		<?php if( $cat_logo_displays == 'logo_image' ) { ?>
			<?php
			if( $cat_logo_upload ) {
				$logo = $cat_logo_upload;
			} else {
				$logo = get_template_directory_uri() .'/images/logo/default.svg';
			}

			if( $cat_logo_retina ) {
				$logo_retina        = $cat_logo_retina;
				$logo_retina_width  = $cat_retina_logo_width;
			}
			?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo('name'); ?>">
                <img src="<?php echo esc_url($logo) ; ?>" alt="<?php bloginfo('name'); ?>" />
            </a>
		<?php if( $cat_logo_retina ) { ?>
            <script>
                jQuery(document).ready( function($)
                {
                    var retina = window.devicePixelRatio > 1 ? true : false;

                    if ( retina )
                    {
                        jQuery( '.site--logo img' ).attr( 'src', '<?php echo esc_js( $logo_retina ); ?>' );
                        jQuery( '.site--logo img' ).attr( 'width', '<?php echo esc_js( $logo_retina_width ); ?>' );
                    }
                } );
            </script>
		<?php } ?>
		<?php } else { ?>

            <a rel="home" class="site-name" href="<?php echo esc_url(home_url()); ?>/"<?php if( !empty( $logo_text_color ) ) echo ' style="color:'.$logo_text_color.' !important;"'; ?>><?php echo single_cat_title( '', false ); ?></a>

			<?php if( $cat_tagline == true ){ ?>
            <span class="site-tagline">
                <?php
                if( $cat_taglineText ){
	                echo stripslashes( $cat_taglineText );
                } else {
	                bloginfo( 'description' );
                } // END Blog Tage Line ?>
            </span>
		<?php } ?>
		<?php } ?>
		<?php
		if ( !is_single() && !is_category() && !is_tag() ) :
			if ( is_home() || is_front_page() ) :
				echo '</h1>';
			else :
				echo '</h2>';
			endif;
		else :
			echo '</h2>';
		endif;
		?>
    </div><!-- End Logo -->
<?php }  else { ?>
    <div class="logo site--logo"<?php echo $logo_css ?>>
		<?php
		if ( !is_single() && !is_category() && !is_tag() ) :
			if ( is_home() || is_front_page() ) :
				echo '<h1 class="site-title">';
			else :
				echo '<h2 class="site-title">';
			endif;
		else :
			echo '<h2 class="site-title">';
		endif;
		?>
		<?php if( woohoo_get_option( 'logo_displays' ) == 'logo_image' ) { ?>
			<?php
			$logo = '';
			if( woohoo_get_option( 'logo_upload' ) ) {
				$logo = woohoo_get_option( 'logo_upload' );
			} else {
				$logo = get_template_directory_uri() .'/images/logo/default.svg';
			}

			$logo_retina = '';
			$logo_retina_width = '';

			if( woohoo_get_option( 'logo_retina' ) ) {
				$logo_retina        = woohoo_get_option( 'logo_retina' );
				$logo_retina_width  = woohoo_get_option( 'retina_logo_width' );
			}
			?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo('name'); ?>">
                <img src="<?php echo esc_url($logo) ; ?>" alt="<?php bloginfo('name'); ?>" />
            </a>
		<?php if( woohoo_get_option( 'logo_retina' ) ) { ?>
            <script>
                jQuery(document).ready( function($)
                {
                    var retina = window.devicePixelRatio > 1 ? true : false;

                    if ( retina )
                    {
                        jQuery( '.site--logo img' ).attr( 'src', '<?php echo esc_js( $logo_retina ); ?>' );
                        jQuery( '.site--logo img' ).attr( 'width', '<?php echo esc_js( $logo_retina_width ); ?>' );
                    }
                } );
            </script>
		<?php } ?>
		<?php } else { ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-name"<?php if( !empty( $logo_text_color ) ) echo ' style="color:'.$logo_text_color.' !important;"'; ?>>
				<?php
				if( woohoo_get_option( 'logoText' ) ){
					echo stripslashes( woohoo_get_option( 'logoText' ) );
				} else {
					bloginfo('name');
				} // END Blog Name ?>
            </a>
			<?php if( woohoo_get_option( 'logo_tagline' ) == 1 ){ ?>
            <span class="site-tagline">
                <?php
                if( woohoo_get_option( 'taglineText' ) ){
	                echo stripslashes( woohoo_get_option( 'taglineText' ) );
                } else {
	                bloginfo( 'description' );
                } // END Blog Tage Line ?>
            </span>
		<?php } ?>
		<?php } ?>
		<?php
		if ( !is_single() && !is_category() && !is_tag() ) :
			if ( is_home() || is_front_page() ) :
				echo '</h1>';
			else :
				echo '</h2>';
			endif;
		else :
			echo '</h2>';
		endif;
		?>
    </div><!-- End Logo -->
<?php } ?>
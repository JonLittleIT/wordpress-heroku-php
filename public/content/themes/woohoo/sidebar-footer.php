<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

$footer_widgets     = woohoo_get_option( 'footerWidgets' );
$footer_widgets_col = woohoo_get_option( 'footerWidgetsColumns' );

if( $footer_widgets_col == "col_two" ) $foo_class = " footer-col-two";
elseif( $footer_widgets_col == "col_three" ) $foo_class = " footer-col-three";
elseif( $footer_widgets_col == "col_four" ) $foo_class = " footer-col-four";

if(  $footer_widgets ) { ?>

	<?php
	/**
	 * Sub Footer
	 * ========================================================= */

	$footer_bg                  = woohoo_get_option( 'bdaia_footer_bg' );
	$footer_text_color          = woohoo_get_option( 'bdaia_footer_text_color' );
	$footer_text_hover_color    = woohoo_get_option( 'bdaia_footer_text_hover_color' );

	$footer_css = "";
	if( !empty( $footer_bg['color'] ) || !empty( $footer_bg['img'] ) ) { $footer_css  = ' style ="';
		if( !empty( $footer_bg['color'] ) ) $footer_css .= 'background-color:'.$footer_bg['color'].';';
		if( !empty( $footer_bg['img'] ) ) $footer_css .= 'background-image: url('.$footer_bg['img'].');';
		if( !empty( $footer_bg['repeat'] ) ) $footer_css .= 'background-repeat:'.$footer_bg['repeat'].';';
		if( !empty( $footer_bg['attachment'] ) ) $footer_css .= 'background-attachment:'.$footer_bg['attachment'].';';
		if( !empty( $footer_bg['hor'] ) || !empty( $header_bg['ver'] ) ) $footer_css .= 'background-position:'.$footer_bg['hor'].' '.$footer_bg['ver'].';';
		$footer_css .= '"';
	}

	$footer_sc = "";
	if( !empty( $footer_text_color ) || !empty( $footer_text_hover_color ) ) { $footer_sc  = '<style type="text/css">';
		if( !empty( $footer_text_color ) ) $footer_sc .= 'div.bdaia-footer .bwb-article-content-wrapper footer, div.bdaia-footer p, div.bdaia-footer p.block-exb, div.bdaia-footer div.bdaia-footer-widgets a, div.bdaia-footer div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner span.bdayh-date{color: '.$footer_text_color.';}';
		if( !empty( $footer_text_hover_color ) ) $footer_sc .= 'div.bdaia-footer div.bdaia-footer-widgets a:hover{color: '.$footer_text_hover_color.';}';
		$footer_sc .= '</style>';
	}

	echo $footer_sc;
	?>
	<div class="bdaia-footer-widgets"<?php echo $footer_css; ?>>
		<div class="bd-container">
			<div class="bdaia-footer-widgets-area<?php echo esc_attr( $foo_class ); ?>">

				<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) { ?>
					<div id="footer-first" class="footer-widget-inner">
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</div>
				<?php } ?>

				<?php if( $footer_widgets_col == 'col_two' || $footer_widgets_col == 'col_three' || $footer_widgets_col == 'col_four' ) { if ( is_active_sidebar( 'second-footer-widget-area' ) ) { ?>
					<div id="footer-second" class="footer-widget-inner">
						<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
					</div>
				<?php } } ?>

				<?php if( $footer_widgets_col == 'col_three' || $footer_widgets_col == 'col_four' ) { if ( is_active_sidebar( 'third-footer-widget-area' ) ) { ?>
					<div id="footer-third" class="footer-widget-inner">
						<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
					</div>
				<?php } } ?>

				<?php if( $footer_widgets_col == 'col_four' ) { if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) { ?>
					<div id="footer-fourth" class="footer-widget-inner">
						<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
					</div>
				<?php } } ?>

			</div>
		</div>
	</div><!--Widgets/-->

<?php } ?>
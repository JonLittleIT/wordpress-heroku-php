<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) exit( 'Direct script access denied.' );

require_once ( get_template_directory() . '/foxpush/class.php'                            );




/**
 * Fox Push Scripts
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_foxpush_scripts' ) )
{
	add_action( 'admin_enqueue_scripts', 'woohoo_foxpush_scripts', 100 );
	function woohoo_foxpush_scripts()
	{
		$version            = woohoo_get_theme_version();
		$p_uri              = trailingslashit( get_template_directory_uri() );
		$foxpush_domain     = woohoo_get_option( 'foxpush_domain'   );
		$foxpush_api        = woohoo_get_option( 'foxpush_api'      );

		//wp_enqueue_script( 'woohoo-foxpush-chart', $p_uri . 'foxpush/js/chart.js', array( 'jquery' ), $version, false   );
		wp_enqueue_script( 'woohoo-foxpush', $p_uri . 'foxpush/js/foxpush.js', array( 'jquery' ), $version, true        );

	}
}





/**
 * Fox Push code
 * ----------------------------------------------------------------------------- */
if( ! function_exists( 'woohoo_foxpush_code' ))
{
	add_action( 'wp_footer', 'woohoo_foxpush_code' );
	function woohoo_foxpush_code()
	{
		$web_notification   = woohoo_get_option( 'web_notification' );

		if ( $web_notification )
		{
			$foxpush_domain     = woohoo_get_option( 'foxpush_domain'   );
			$foxpush_api        = woohoo_get_option( 'foxpush_api'      );
			$foxpush            = new FOXPUSH_API( $foxpush_domain, $foxpush_api );
			$code               = $foxpush->get_user_code();

			if ( !empty( $foxpush_domain ) || !empty( $foxpush_api ) )
			{
				$code = apply_filters( 'woohoo_foxpushcode', $code );
				wp_add_inline_script( 'woohoo-main', $code );
			}
			else {
				return false;
			}
		}
	}
}




/**
 * Fox Push Options
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_get_foxpush' ) )
{
	add_action( 'woohoo_get_foxpush', 'woohoo_get_foxpush' );
	function woohoo_get_foxpush()
	{
		$foxpush_domain     = woohoo_get_option( 'foxpush_domain'   );
		$foxpush_api        = woohoo_get_option( 'foxpush_api'      );

		$foxpush    = new FOXPUSH_API( $foxpush_domain, $foxpush_api );
		$stats      = $foxpush->get_publisher_stats();
		$chart      = $foxpush->get_daily_chart();

		if ( ! $foxpush->isset_error )
		{
			$total_subscribers  = number_format( $stats['total_subscribers'] );
			$total_campaigns    = number_format( $stats['total_campaigns'] );
			$total_views        = number_format( $stats['total_views'] );
			$total_clicks       = number_format( $stats['total_clicks'] );
		}
		else {
			echo '';
		}
		?>

		<?php if ( $foxpush_domain || $foxpush_api ) { ?>
			<div id="fox-push-stats-wrapper" class="bdaia-box-panel text-center" style="margin-bottom: 0">
				<div class="bd-subtitle-two"><span>STATISTICS</span></div>
					<?php if( ! empty( $stats ) && is_array( $stats ) ){ ?>
						<div id="fox-push-stats">
							<div class="bdaia-row">
								<div class="bdaia-col-md-3">
									<span><small>SUBSCRIBERS</small></span>
									<div class="bdaia-large-count"><?php if (  !empty( $total_subscribers ) ) echo ( $total_subscribers ); ?></div>
								</div>

								<div class="bdaia-col-md-3">
									<span><small>CAMPAIGNS</small></span>
									<div class="bdaia-large-count"><?php if (  !empty( $total_campaigns ) ) echo ( $total_campaigns ); ?></div>
								</div>

								<div class="bdaia-col-md-3">
									<span><small>TOTAL VIEWS</small></span>
									<div class="bdaia-large-count"><?php if (  !empty( $total_views ) ) echo ( $total_views ); ?></div>
								</div>

								<div class="bdaia-col-md-3">
									<span><small>TOTAL CLICKS</small></span>
									<div class="bdaia-large-count"><?php if (  !empty( $total_clicks ) ) echo ( $total_clicks ); ?></div>
								</div>
							</div>
						</div>
					<?php } ?>

				<?php if( ! empty( $chart ) && is_array( $chart ) ){ ?>
					<div id="fox-push-charts">
						<script type="text/javascript" src="//www.gstatic.com/charts/loader.js"></script>
						<script type="text/javascript">
                            google.charts.load('current', {
                                callback: function () {
                                    drawChart();
                                    window.addEventListener('resize', drawChart, false);
                                },
                                packages:['corechart']
                            });

                            //google.charts.load('current', {'packages':['corechart']});
                            //google.charts.setOnLoadCallback(drawChart);

                            //.web_notification a
							/*google.charts.load('current', {
							 callback: function () {
							 drawChart();
							 jQuery(window).resize(drawChart);
							 },
							 packages:['corechart']
							 });*/

                            jQuery(document).ready( function($)
                            {
                                jQuery(window).resize(function(){
                                    drawChart();
                                });
                            });

		                    function drawChart()
		                    {
		                        var data = google.visualization.arrayToDataTable([
		                            ['Date', 'Subscribers'],
									<?php
									foreach ( $chart as $k => $v)
									{
										echo "['".$k."',  ".$v."],";
									}
									?>
		                        ]);

		                        var options = {
                                    //maxValue : 5,
                                   // minValue : 0,
                                    isStacked: true,
		                            curveType: 'function',
                                    legend: {
                                        position: 'bottom'
                                    },
                                    //width: '100%',
		                            //width: document.getElementById('fox-push-charts').offsetWidth,
                                    width : 550,
		                            height: 400,
		                            chartArea: {'width': '95%', 'left':'8%', 'top':'12%', 'right':'2%'},
                                    //chartArea:{width:"90%",height:"80%"},
                                    //'legend':'left',
                                    //'title':'My Big Pie Chart',
                                    'is3D':true,
		                            //legend: { position: 'bottom' },
		                            hAxis: {
                                        viewWindow: {
                                            min: 0,
                                            max: 31
                                        },
                                        //ticks: [0, 5, 10, 15, 29],
                                        viewWindowMode: 'pretty',

                                        format: 'short',
		                                textStyle: {
		                                    color: '#afafaf',
		                                    fontSize: 11,
		                                    fontName: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif'
		                                },
                                        //count: 5,
			                            //viewWindowMode: 'pretty',
			                            slantedText: true
		                            },

		                            vAxis: {
		                                textStyle: {
		                                    color: '#888',
		                                    fontSize: 16,
		                                    fontName: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif'
		                                },
		                                gridlines: {color: '#eee'
		                                },
		                                baselineColor: '#999'
		                            },

		                            reverseCategories: true,
		                            colors: ['#65b70e']
		                        };

			                    var container = document.getElementById('curve_chart');
                                var chart = new google.visualization.LineChart(container);
                                chart.draw(data, options);
                            }
						</script>
						<div id="curve_chart"></div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php
	}
}
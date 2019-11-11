<?php

/* The template for displaying the footer */

global $aqura_data;



$aqura_footer_layout = array_key_exists('aqura_footer__style__layout', $aqura_data) ? $aqura_data['aqura_footer__style__layout'] : '';



?>

	

		</div>

	</div>



	<?php if ( $aqura_footer_layout == '1' || is_null($aqura_footer_layout) ): ?>

		<!-- ========== START FOOTER-TYPE-1 ========== -->

		<footer class="footer-type-1" style="background-color: <?php echo esc_attr( $aqura_data['aqura_footer__style__bg_color'] ); ?>;">

			<div class="container">

				<div class="row">

					<div class="col-sm-3">

						<?php if ( ($aqura_data['aqura_footer__copyrights__on_off'] != false) && array_key_exists('aqura_footer__copyrights__on_off', $aqura_data) ): ?>

							<div class="copyright">

								<a href="<?php if ( $aqura_data['aqura_footer__copyrights__link'] != '' ) echo esc_url($aqura_data['aqura_footer__copyrights__link']); ?>" class="copyright-content">

									<?php

										echo '&copy; ' . esc_html($aqura_data['aqura_footer__copyrights__text']);

										echo date_i18n( esc_html__( ' Y' , 'aqura' ) );

									?>

								</a>

							</div>

						<?php endif ?>

					</div><!-- end col-sm-3 -->

					<div class="col-sm-6">

						<?php if (array_key_exists('aqura_footer__social_icons__on_off', $aqura_data) && ($aqura_data['aqura_footer__social_icons__on_off'] != false) ): ?>

							<ul class="footer-type-1-social clearfix">

								<?php if( isset( $aqura_data['aqura_footer__social_icons__icon'] ) && shortcode_exists( 'aqura_footer_social_icon' ) ){

									foreach($aqura_data['aqura_footer__social_icons__icon'] as $aqura_icon) {

										echo do_shortcode($aqura_icon);

									}

								} ?>

							</ul><!-- end social-media-header -->

						<?php endif ?>

					</div><!-- end col-sm-6 -->

					<div class="col-sm-3">

						<?php if ( ($aqura_data['aqura_footer__go_to_top__on_off'] != false) && array_key_exists('aqura_footer__go_to_top__on_off', $aqura_data) ): ?>

							<div class="goTop" id="back-to-top">

								<span><i class="fa fa-angle-up"></i></span>

								<a class="go-top-content" href="#">

									<?php echo esc_html( $aqura_data['aqura_footer__go_to_top__text'] ? $aqura_data['aqura_footer__go_to_top__text'] : esc_html__( 'Go Top' , 'aqura' ) ); ?>

								</a>

							</div>

						<?php endif ?>

					</div><!-- end col-sm-3 -->

				</div><!-- end row -->

			</div><!-- end ctonainer -->

		</footer><!-- end footer-type-1 -->

		<!-- ========== END FOOTER-TYPE-1 ========== -->

	<?php elseif ( $aqura_footer_layout == '2' ): ?>

		<!-- ========== START FOOTER-TYPE-2 ========== -->

		<div class="footer-type-2" style="background-color: <?php echo esc_attr( $aqura_data['aqura_footer__background_color'] ); ?>;background: url(<?php echo esc_url( $aqura_data['aqura_footer__background_image']['url'] ); ?>);">

			<div class="container">

				<div class="row">

					<div class="col-sm-4">

						<div class="footer-widget">

							<h4 class="left">

								<?php echo esc_html__( 'Contact Us' , 'aqura' ); ?>

							</h4>

							<?php

							$aqura_footer__contact__management 	= $aqura_data['aqura_footer__contact__management'];

							$aqura_footer__contact__booking 	= $aqura_data['aqura_footer__contact__booking'];

							$aqura_footer__contact__phone 		= $aqura_data['aqura_footer__contact__phone'];

							?>

							<?php if ( ( $aqura_footer__contact__management != '' ) || ( $aqura_footer__contact__booking != '' ) || ( $aqura_footer__contact__phone != '' ) ): ?>

							<ul class="agency clearfix">

								<?php if ( $aqura_footer__contact__management != '' ): ?>

								<li>

									<?php echo esc_html__( 'Management:' , 'aqura' ); ?>

									<a href="mailto:<?php echo esc_attr( $aqura_footer__contact__management ); ?>">

										<?php echo esc_html( $aqura_footer__contact__management ); ?>

									</a>

								</li>

								<?php endif;

								if ( $aqura_footer__contact__booking != '' ): ?>

								<li>

									<?php echo esc_html__( 'Booking:' , 'aqura' ); ?>

									<a href="mailto:<?php echo esc_attr( $aqura_footer__contact__booking ); ?>">

										<?php echo esc_html( $aqura_footer__contact__booking ); ?>

									</a>

								</li>

								<?php endif;

								if ( $aqura_footer__contact__phone != '' ): ?>

								<li>

									<?php echo esc_html__( 'Phone:' , 'aqura' ); ?>

									<a href="tel:<?php echo esc_html( $aqura_footer__contact__phone ); ?>">

										<?php echo esc_html( $aqura_footer__contact__phone ); ?>

									</a>

								</li>

								<?php endif; ?>

							</ul>

							<?php endif ?>

							<?php if( class_exists('MailChimp') && ( $aqura_data['mailchimp-api'] !='' ) ) { ?>

								<div class="newsletter">

									<h6>

										<?php echo esc_html__( 'Stay in Touch' , 'aqura' ) ?>

									</h6>

									<form action="<?php echo get_permalink(); ?>" method="post">

										<input type="mail" id="mailchimp-email" name="mailchimp-email" placeholder="<?php echo esc_html__( 'Email address...' , 'aqura' ) ?>" required>

										<p class="form-submit">

											<?php wp_nonce_field( 'subscribe-user_'.get_the_ID(), '_theme-subscribe' ); ?>

											<input type="submit" class="submit" value="<?php echo esc_html__( 'Subscribe' , 'aqura' ) ?>">

										</p>

									</form>

								</div><!-- end newsletter -->

							<?php } ?>

							<ul class="social clearfix">

								<?php if( isset( $aqura_data['aqura_footer__contact__icons'] ) ){

									foreach($aqura_data['aqura_footer__contact__icons'] as $aqura_icon) {

										echo do_shortcode($aqura_icon);

									}

								} ?>

							</ul>

						</div><!-- end footer-widget -->

					</div><!-- end col-sm-4 -->

					<div class="col-sm-4">

						<div class="footer-type-2-logo">

							<?php if ( $aqura_data['aqura_footer__logo']['url'] != '' ): ?>

								<a href="<?php echo esc_url( home_url( '/' ) ); ?>">

									<img src="<?php echo esc_url( $aqura_data['aqura_footer__logo']['url'] ); ?>" alt="<?php echo get_bloginfo('name'); ?>">

								</a>

							<?php endif ?>

						</div><!-- end footer-type-2-logo -->

					</div><!-- end col-sm-4 -->

					<div class="col-sm-4">

						<div class="footer-widget">

							<h4 class="right clearfix">

								<?php echo esc_html__( 'Twitter Feed' , 'aqura' ); ?>

							</h4>

							<?php

							$aqura_footer__twitter_user = $aqura_data['aqura_footer__twitter_user'];

							if ( function_exists('getTweets') && ( $aqura_footer__twitter_user != '' ) ) {



								$aqura_tweets_displayed = $aqura_data['aqura_footer__twitter_number_of_posts'];

								$aqura_tweets_displayed = $aqura_tweets_displayed ? $aqura_tweets_displayed : 2;



								$aqura_tweets = getTweets($aqura_footer__twitter_user, $aqura_tweets_displayed);



								foreach($aqura_tweets as $tweet) {



									if ( $tweet['text'] ) {



										$the_tweet 		= $tweet['text'];

										$the_tweet_date = $tweet['created_at'];

										$the_tweet_date = explode(' ', trim($the_tweet_date)); ?>

										

										<ul class="twitter clearfix">

											<li><?php echo esc_html( $the_tweet ); ?></li>

											<li><i class="fa fa-twitter" aria-hidden="true"></i><?php echo esc_html( $the_tweet_date[0] . ' ' . $the_tweet_date[1] . ' ' . $the_tweet_date[2] ); ?></li>

										</ul>



									<?php }

								}



							}

							?>

						</div><!-- end footer-widget -->

					</div><!-- end col-sm-4 -->

				</div><!-- end row -->

			</div><!-- end container -->

		</div><!-- end footer-type-2 -->

		<!-- ========== END FOOTER-TYPE-2 ========== -->

	<?php else: ?>

		<!-- ========== START FOOTER-TYPE-1 ========== -->

		<footer class="footer-type-1">

			<div class="container">

				<div class="row">

					<div class="col-sm-3">

						<div class="copyright">

							<a class="copyright-content">

								<?php

									echo '&copy; ';

									echo date_i18n( esc_html__( ' Y' , 'aqura' ) );

								?>

							</a>

						</div>

					</div><!-- end col-sm-3 -->

					<div class="col-sm-6"></div><!-- end col-sm-6 -->

					<div class="col-sm-3">

						<div class="goTop" id="back-to-top">

							<span><i class="fa fa-angle-up"></i></span>

							<a class="go-top-content" href="#">

								<?php echo esc_html__( 'Go Top' , 'aqura' ); ?>

							</a>

						</div>

					</div><!-- end col-sm-3 -->

				</div><!-- end row -->

			</div><!-- end ctonainer -->

		</footer><!-- end footer-type-1 -->

		<!-- ========== END FOOTER-TYPE-1 ========== -->

	<?php endif; ?>



<?php wp_footer(); ?>



</body>

</html>


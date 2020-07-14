<div class="bdaia-author-box">

	<div class="authorBlock-avatar">
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 150 ); ?></a>
	</div>

	<div class="authorBlock-header">

		<h3 class="authorBlock-header-title">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?>
		</h3>

		<p class="authorBlock-header-bio">
			<?php the_author_meta( 'description' ); ?>
		</p>

		<div class="authorBlock-meta bdaia-social-io-colored">
			<div class="bdaia-social-io bdaia-social-io-size-32">
				<?php if ( get_the_author_meta( 'url' ) ) : ?>
					<a class="bdaia-io-url-home" href="<?php the_author_meta( 'url' ); ?>"><span class="bdaia-io bdaia-io-home3"></span></a>
				<?php endif ?>

				<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
					<a class="bdaia-io-url-twitter" href="http://www.twitter.com/<?php the_author_meta( 'twitter' ); ?>"><span class="bdaia-io bdaia-io-twitter"></span></a>
				<?php endif ?>

				<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
					<a class="bdaia-io-url-facebook" href="<?php the_author_meta( 'facebook' ); ?>"><span class="bdaia-io bdaia-io-facebook"></span></a>
				<?php endif ?>

				<?php if ( get_the_author_meta( 'instagram' ) ) : ?>
					<a class="bdaia-io-url-instagram" href="<?php the_author_meta( 'instagram' ); ?>"><span class="bdaia-io bdaia-io-instagram"></span></a>
				<?php endif ?>

				<?php if ( get_the_author_meta( 'google' ) ) : ?>
					<a class="bdaia-io-url-google-plus" href="https://plus.google.com/<?php the_author_meta( 'google' ); ?>?rel=author"><span class="bdaia-io bdaia-io-google-plus"></span></a>
				<?php endif ?>

				<?php if ( get_the_author_meta( 'youtube' ) ) : ?>
					<a class="bdaia-io-url-youtube" href="<?php the_author_meta( 'youtube' ); ?>"><span class="bdaia-io bdaia-io-youtube"></span></a>
				<?php endif ?>

				<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
					<a class="bdaia-io-url-linkedin" href="<?php the_author_meta( 'linkedin' ); ?>"><span class="bdaia-io bdaia-io-linkedin2"></span></a>
				<?php endif ?>

				<?php if ( get_the_author_meta( 'pinterest' ) ) : ?>
					<a class="bdaia-io-url-pinterest" href="<?php the_author_meta( 'pinterest' ); ?>"><span class="bdaia-io bdaia-io-social-pinterest"></span></a>
				<?php endif ?>

				<?php if ( get_the_author_meta( 'flickr' ) ) : ?>
					<a class="bdaia-io-url-flickr" href="<?php the_author_meta( 'flickr' ); ?>"><span class="bdaia-io bdaia-io-flickr2"></span></a>
				<?php endif ?>

				<?php if ( get_the_author_meta( 'dribbble' ) ) : ?>
					<a class="bdaia-io-url-dribbble" href="<?php the_author_meta( 'dribbble' ); ?>"><span class="bdaia-io bdaia-io-dribbble"></span></a>
				<?php endif ?>
			</div>
		</div>

	</div>
</div>
<!-- END Author Box. -->
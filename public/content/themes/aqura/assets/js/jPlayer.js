jQuery('.trak-item audio').attr('data-state','pause');

var pauseIf,
	jPlayerPausePlay = 'pause';

jQuery("#mesh-main-player").jPlayer({
	ready: function () {

		if ( jQuery('.playlist-wrapper .jp-playlist .trak-item').length > 0 ) {

			var $this = jQuery('.playlist-wrapper .jp-playlist .about-list').next();
				audioSrc = $this.data('audio'),
				audtioTitle = $this.find('audio').attr('title'),
				audtioThumb = $this.data('thumbnail'),
				audtioArtist = $this.data('artist');

			jQuery('.mesh-main-player .mesh-artist').text(audtioArtist);

			jQuery('.mesh-main-player .mesh-thumbnail img').attr('src',audtioThumb);

			$this.addClass('active');

			$this.find('audio').attr('data-state','pause');

			jQuery('.jp-jplayer').attr({
				'data-state':'pause',
				'data-audio-src':audioSrc
			});

			jQuery("#mesh-main-player").jPlayer("setMedia", {
				title: audtioTitle,
				m4a: audioSrc
			});

		}

	},
	swfPath: '../dist/jplayer',
	solution: 'html, flash',
	supplied: 'm4a, oga',
	preload: 'metadata',
	volume: 0.8,
	muted: false,
	backgroundColor: '#000000',
	cssSelectorAncestor: '#mesh-main-player-content',
	cssSelector: {
		play: '.mesh-play',
		pause: '.mesh-pause',
		// stop: '.jp-stop',
		seekBar: '.mesh-seek-bar',
		playBar: '.mesh-seek-bar > div',
		mute: '.mesh-mute',
		unmute: '.mesh-unmute',
		volumeBar: '.mesh-volume-bar',
		volumeBarValue: '.mesh-volume-bar-value',
		// volumeMax: '.jp-volume-max',
		// playbackRateBar: '.jp-playback-rate-bar',
		// playbackRateBarValue: '.jp-playback-rate-bar-value',
		currentTime: '.mesh-current-time',
		duration: '.mesh-duration',
		title: '.mesh-title',
		// fullScreen: '.jp-full-screen',
		// restoreScreen: '.jp-restore-screen',
		// repeat: '.jp-repeat',
		// repeatOff: '.jp-repeat-off',
		// gui: '.jp-gui',
		// noSolution: '.jp-no-solution'
	},
	errorAlerts: false,
	warningAlerts: false,
	ended: function() {

	   var playingSongParent = jQuery('.trak-item.active');

		if ( playingSongParent.next().length > 0 ) {

			var parentForFind = playingSongParent.next(),
				songTitle = parentForFind.find('audio').attr('title'),
				songSrc = parentForFind.data('audio'),
				soundThumb = parentForFind.data('thumbnail'),
				audtioArtist = parentForFind.data('artist'),
				jPlayerPausePlay = jQuery('.jp-jplayer').attr('data-state');

			jQuery('.mesh-main-player .mesh-artist').text(audtioArtist);

			jQuery('.trak-item').removeClass('active playing');

			parentForFind.addClass('active playing');

			jQuery('.mesh-thumbnail img').attr('src',soundThumb);

			jQuery("#mesh-main-player").jPlayer("setMedia", {
				title: songTitle,
				m4a: songSrc
			}).jPlayer("play");

			parentForFind.find('audio').attr('data-state','play');

			jQuery('.jp-jplayer').attr({
				'data-state':'play',
				'data-audio-src':songSrc
			});


		} else {

			playingSongParent.removeClass('playing');

			playingSongParent.find('audio').attr('data-state','pause');

		};

	},
	play: function() {

		jQuery('.trak-item.active').addClass('playing');

		jQuery('.trak-item.active').find('audio').attr('data-state','play');

		jQuery('.jp-jplayer').attr('data-state','play');

	},
	pause: function() {

		jQuery('.trak-item.active').removeClass('playing');

		jQuery('.trak-item.active').find('audio').attr('data-state','pause');

		jQuery('.jp-jplayer').attr('data-state','pause');

	}
});

var playerPlayOne = {

	init: function(){

		jQuery('.trak-item .play-pause-button:not([data-loadedJS="true"])').each(function(){

			jQuery(this).attr('data-loadedJS', 'true');

			jQuery(this).on('click',function(){
				jQuery('.main-music-player').removeClass('hide-player');
				if ( jQuery(this).parent().hasClass('active') ) {} else {

					jQuery('.trak-item').removeClass('active playing');
					jQuery('.trak-item audio').data('state','pause');
					jQuery('.jp-jplayer').attr('data-state','pause');

				}

				var parentForFind = jQuery(this).parent(),
					songTitle = parentForFind.find('audio').attr('title'),
					songSrc = parentForFind.data('audio'),
					soundThumb = parentForFind.data('thumbnail'),
					audtioArtist = parentForFind.data('artist'),
					findItemByTitlteClick = jQuery('.trak-item.active[data-audio="' + songSrc + '"][data-artist="' + audtioArtist + '"][data-thumbnail="' + soundThumb + '"]'),
					jPlayerPausePlay = jQuery(this).parent().find('audio').attr('data-state'),
					pauseIf = jQuery('.jp-jplayer').attr('data-audio-src');

				if ( pauseIf == songSrc ) {

					if ( jPlayerPausePlay == 'play' ) {

						if ( parentForFind.hasClass('active') ) {

							jQuery("#mesh-main-player").jPlayer("pause");

							parentForFind.removeClass('playing');

							parentForFind.find('audio').attr('data-state','pause');

							jQuery('.jp-jplayer').attr('data-state','pause');

							findItemByTitlteClick.addClass('active');
							findItemByTitlteClick.removeClass('playing');

						} else {

							jQuery('.trak-item').removeClass('active playing');

							parentForFind.addClass('active playing');

							var audtioArtist = parentForFind.data('artist');

							jQuery('.mesh-main-player .mesh-artist').text(audtioArtist);

							jQuery("#mesh-main-player").jPlayer("setMedia", {
								title: songTitle,
								m4a: songSrc
							}).jPlayer("play");

							parentForFind.find('audio').attr('data-state','play');

							jQuery('.jp-jplayer').attr({
								'data-state':'play',
								'data-audio-src':songSrc
							});

							findItemByTitlteClick.addClass('active playing');

							var playingSongParent = jQuery('.trak-item.active'),
								soundThumb = parentForFind.data('thumbnail');

							jQuery('.mesh-thumbnail img').attr('src',soundThumb);

						}

					} else if ( jPlayerPausePlay == 'pause' ) {

						if ( parentForFind.hasClass('active') ) {

							jQuery("#mesh-main-player").jPlayer("play");

							parentForFind.addClass('playing');

							parentForFind.find('audio').attr('data-state','play');

							jQuery('.jp-jplayer').attr('data-state','play');

							findItemByTitlteClick.addClass('active playing');

						} else {

							jQuery('.trak-item').removeClass('active playing');

							parentForFind.addClass('active playing');

							var audtioArtist = parentForFind.data('artist');

							jQuery('.mesh-main-player .mesh-artist').text(audtioArtist);

							jQuery("#mesh-main-player").jPlayer("setMedia", {
								title: songTitle,
								m4a: songSrc
							}).jPlayer("play");

							parentForFind.find('audio').attr('data-state','play');

							jQuery('.jp-jplayer').attr({
								'data-state':'play',
								'data-audio-src':songSrc
							});

							findItemByTitlteClick.addClass('active playing');

							var playingSongParent = jQuery('.trak-item.active'),
								soundThumb = parentForFind.data('thumbnail');

							jQuery('.mesh-thumbnail img').attr('src',soundThumb);

						}

					};

				} else {

					jQuery('.trak-item').removeClass('active playing');

					parentForFind.addClass('active playing');

					var audtioArtist = parentForFind.data('artist');

					jQuery('.mesh-main-player .mesh-artist').text(audtioArtist);

					jQuery("#mesh-main-player").jPlayer("setMedia", {
						title: songTitle,
						m4a: songSrc
					}).jPlayer("play");

					parentForFind.find('audio').attr('data-state','play');

					jQuery('.jp-jplayer').attr({
						'data-state':'play',
						'data-audio-src':songSrc
					});

					findItemByTitlteClick.addClass('active playing');

					var playingSongParent = jQuery('.trak-item.active'),
						soundThumb = parentForFind.data('thumbnail');

					jQuery('.mesh-thumbnail img').attr('src',soundThumb);

				};

			});

		});

	},

	playPrevStong: function(){

		jQuery('.mesh-prev').on('click',function(){

			var playingSongParent = jQuery('.trak-item.active');

			if ( playingSongParent.prev().length > 0 ) {

				var parentForFind = playingSongParent.prev(),
					songTitle = parentForFind.find('audio').attr('title'),
					songSrc = parentForFind.data('audio'),
					soundThumb = parentForFind.data('thumbnail'),
					audtioArtist = parentForFind.data('artist'),
					jPlayerPausePlay = jQuery('.jp-jplayer').attr('data-state');

				jQuery('.mesh-main-player .mesh-artist').text(audtioArtist);

				jQuery('.trak-item').removeClass('active playing');

				parentForFind.addClass('active playing');

				jQuery('.mesh-thumbnail img').attr('src',soundThumb);

				jQuery("#mesh-main-player").jPlayer("setMedia", {
					title: songTitle,
					m4a: songSrc
				}).jPlayer("play");

				parentForFind.find('audio').attr('data-state','play');

				jQuery('.jp-jplayer').attr({
					'data-state':'play',
					'data-audio-src':songSrc
				});

			};

		});

	},

	playNextSong: function(){

		jQuery('.mesh-next').on('click',function(){

			var playingSongParent = jQuery('.trak-item.active');

			if ( playingSongParent.next().length > 0 ) {

				var parentForFind = playingSongParent.next(),
					songTitle = parentForFind.find('audio').attr('title'),
					songSrc = parentForFind.data('audio'),
					soundThumb = parentForFind.data('thumbnail'),
					audtioArtist = parentForFind.data('artist'),
					jPlayerPausePlay = jQuery('.jp-jplayer').attr('data-state');

				jQuery('.mesh-main-player .mesh-artist').text(audtioArtist);

				jQuery('.trak-item').removeClass('active playing');

				parentForFind.addClass('active playing');

				jQuery('.mesh-thumbnail img').attr('src',soundThumb);

				jQuery("#mesh-main-player").jPlayer("setMedia", {
					title: songTitle,
					m4a: songSrc
				}).jPlayer("play");

				parentForFind.find('audio').attr('data-state','play');

				jQuery('.jp-jplayer').attr({
					'data-state':'play',
					'data-audio-src':songSrc
				});

			};

		});

	}

}

jQuery(document).ready(function(){

	playerPlayOne.init();
	playerPlayOne.playPrevStong();
	playerPlayOne.playNextSong();

	jQuery('.hide-player-button').on('click',function(){

		jQuery('.main-music-player').toggleClass('hide-player');

	});

	jQuery('.trak-item audio').bind('canplay',function(){

		var seconds = jQuery(this)[0].duration;
		var duration = moment.duration(seconds, "seconds");
		
		var time = "";
		var hours = duration.hours();
		var minutes = duration.minutes();
		var seconds = duration.seconds();
		if (hours > 0) { time = hours + ":" ; }

		if ( minutes < 10 ) {

			minutes = '0' + minutes;

		}

		if ( seconds < 10 ) {

			seconds = '0' + seconds;

		}
		
		time = time + minutes + ":" + seconds;
		jQuery(this).parent().find('.trak-duration').text(time);

	});

	jQuery(window).scroll(function(){

		var aS = jQuery(window).scrollTop(),
			wH = jQuery(window).height(),
			dH = jQuery(document).height(),
			pM = jQuery('.main-music-player');

		if ( aS >= ( dH - wH ) ) {

			pM.addClass('hide-player-footer');

		} else {

			pM.removeClass('hide-player-footer');

		}

	});

	// jQuery(window).scroll(function() {    
	// 	var scroll = jQuery(window).scrollTop();
		
	// 	if (scroll >= 100 ) {
	// 		jQuery(".main-music-player").addClass("active", 1000);

	// 	}
	// 	else{
	// 		jQuery(".main-music-player").removeClass("active");
	// 	}
	// });


});

jQuery(document).ready(function(){ 
	jQuery(window).on("scroll",function() {

	    if(jQuery(this).scrollTop() > 500) 
	        jQuery(".main-music-player").addClass("active");
	    else 
	        jQuery(".main-music-player").removeClass("active");
	});
});


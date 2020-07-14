/*
 * Information::
 */
jQuery().ready(function() {

	/*
	 *	Installing new demo
	 */
	jQuery('.demo_theme').on('click', '.install-demo', function(e) {
		e.preventDefault();
		var demo 			= jQuery(this).data('demo');

		jQuery('.bdaia-modal-outer.install .bdaia-btn').attr('data-demo', demo);
		jQuery('.bdaia-modal-outer.install').addClass('bdaia-active');
	});

	jQuery('.bdaia-modal-outer.install').on('click', '.bdaia-btn.bdaia-btn-cancel', function(e) {
		jQuery('.bdaia-modal-outer.install').removeClass('bdaia-active');
	});
	+
	jQuery('.bdaia-modal-outer.install').on('click', '.bdaia-btn.bdaia-btn-confirm', function(e) {

		var demo 			= jQuery(this).data('demo');

		jQuery('.bdaia-confirm').slideUp('slow');
		jQuery('.bdaia-modal-outer.install').addClass('bdaia-processing');

		//Perpare
		jQuery('.theme-'+demo+' .page_loading').css('display', 'block');
		var randoms = window.document.getElementsByClassName("randoms");
		for (i = 0; i < randoms.length; i++)
				changeWord(randoms[i]);

		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			cache:false,
			data: {action: 'demo_install',the_demo: demo},
			dataType: 'json',
			success: function(data, textStatus, XMLHttpRequest) {
				jQuery('.step_1 .uil-ring-css').slideUp('slow');
				jQuery('.step_1 .fa').slideDown('slow');
				_ajax_import_step_2(demo);
				jQuery('.step_2 .uil-ring-css').slideDown('slow');
			},
			error: function(MLHttpRequest, textStatus, errorThrown){
				jQuery('.bdaia-demos-page .alert').css('display', 'block');
			}
		});

	});

	/*
	 *	Uninstalling new demo
	 */
	jQuery('.demo_theme').on('click', '.uninstall-demo', function(e) {
		e.preventDefault();
		var demo 			= jQuery(this).data('demo');

		jQuery('.bdaia-modal-outer.uninstall .bdaia-btn').attr('data-demo', demo);
		jQuery('.bdaia-modal-outer.uninstall').addClass('bdaia-active');
	});

	jQuery('.bdaia-modal-outer.uninstall').on('click', '.bdaia-btn.bdaia-btn-cancel', function(e) {
		jQuery('.bdaia-modal-outer.uninstall').removeClass('bdaia-active');
	});
	+
	jQuery('.bdaia-modal-outer.uninstall').on('click', '.bdaia-btn.bdaia-btn-confirm', function(e) {

		var demo 			= jQuery(this).data('demo');

		jQuery('.bdaia-confirm').slideUp('slow');
		jQuery('.bdaia-modal-outer.uninstall').addClass('bdaia-processing');

		//Perpare
		jQuery('.theme-'+demo+' .page_loading').css('display', 'block');
		var randoms = window.document.getElementsByClassName("randoms");
		for (i = 0; i < randoms.length; i++) changeWord(randoms[i]);
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			cache:false,
			data: {action: 'demo_uninstall',the_demo: demo},
			dataType: 'json',
			success: function(data, textStatus, XMLHttpRequest) {
				jQuery('.remove .uil-ring-css').slideUp('slow');
				jQuery('.remove .fa').slideDown('slow');
				jQuery('.preloader-dotline').slideUp('slow');
				jQuery('.bdaia-progress-title.processing').text('Removed Successfully');
				jQuery('.theme-'+demo+' .page_loading .container').slideUp('slow').fadeOut(function() {
					jQuery('.theme-'+demo+' .page_loading .success').slideDown('slow').fadeIn();
				});
				jQuery('.theme-'+demo+' .page_loading .container').slideUp('slow').fadeOut(function() {
					jQuery('.theme-'+demo+' .page_loading .success').slideDown('slow').fadeIn();
				});
				setTimeout(function(){
					window.location.reload();
				}, 6000);
			},
			error: function(MLHttpRequest, textStatus, errorThrown){
				jQuery('.bdaia-demos-page .alert').css('display', 'block');
			}
		});

	});
});

function _ajax_import_step_2(demo){
	jQuery.ajax({
		type: 'POST',
		url: ajaxurl,
		cache:false,
		data: {action: 'menu_install',the_demo: demo},
		dataType: 'json',
		success: function(data, textStatus, XMLHttpRequest) {
			jQuery('.step_2 .uil-ring-css').slideUp('slow');
			jQuery('.step_2 .fa').slideDown('slow');
			_ajax_import_step_3(demo);
			jQuery('.step_3 .uil-ring-css').slideDown('slow');
		},
		error: function(MLHttpRequest, textStatus, errorThrown){
			jQuery('.bdaia-demos-page .alert').css('display', 'block');
		}
	});
}

function _ajax_import_step_3(demo){
	jQuery.ajax({
		type: 'POST',
		url: ajaxurl,
		cache:false,
		data: {action: 'widgets_install',the_demo: demo},
		dataType: 'json',
		success: function(data, textStatus, XMLHttpRequest) {
			jQuery('.step_3 .uil-ring-css').slideUp('slow');
			jQuery('.step_3 .fa').slideDown('slow');
			jQuery('.preloader-dotline').slideUp('slow');
			jQuery('.bdaia-progress-title.processing').text('Imported Successfully');
			jQuery('.theme-'+demo+' .page_loading .container').slideUp('slow').fadeOut(function() {
				jQuery('.theme-'+demo+' .page_loading .success').slideDown('slow').fadeIn();
			});
			setTimeout(function(){
				window.location.reload();
			}, 5000);
		},
		error: function(MLHttpRequest, textStatus, errorThrown){
			jQuery('.bdaia-demos-page .alert').css('display', 'block');
		}
	});
}


function changeWord(a) {
	var words = ["LOADING", "MOM", "FRIENDS", "HUNT", "INSANITY", "DAD", "LICK", "BROTHER", "WAKE", "GIRLFRIEND", "TATAU", "MAN", "HOME"];
	a.style.opacity = '0.1';
	a.innerHTML = words[getRandomInt(0, words.length - 1)];
	setTimeout(function() {
			a.style.opacity = '1';
	}, 425);
	setTimeout(function() {
			changeWord(a);
	}, getRandomInt(500, 800));
}


function getRandomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
}
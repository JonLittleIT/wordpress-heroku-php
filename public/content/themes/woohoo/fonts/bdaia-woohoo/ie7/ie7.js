/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'bdaia-woohoo\'">' + entity + '</span>' + html;
	}
	var icons = {
		'bdaia-io-envato': '&#xe970;',
		'bdaia-io-okru': '&#xe96f;',
		'bdaia-io-bolt': '&#xe964;',
		'bdaia-io-flame': '&#xe965;',
		'bdaia-io-bolt2': '&#xe966;',
		'bdaia-io-eye3': '&#xe954;',
		'bdaia-io-forrst': '&#xe905;',
		'bdaia-io-home': '&#xe906;',
		'bdaia-io-home2': '&#xe907;',
		'bdaia-io-home3': '&#xe908;',
		'bdaia-io-newspaper': '&#xe909;',
		'bdaia-io-image': '&#xe90a;',
		'bdaia-io-images': '&#xe90b;',
		'bdaia-io-camera': '&#xe90c;',
		'bdaia-io-headphones': '&#xe90d;',
		'bdaia-io-play': '&#xe90e;',
		'bdaia-io-mic': '&#xe90f;',
		'bdaia-io-book': '&#xe910;',
		'bdaia-io-file-text': '&#xe911;',
		'bdaia-io-files-empty': '&#xe912;',
		'bdaia-io-file-text2': '&#xe913;',
		'bdaia-io-cart': '&#xe914;',
		'bdaia-io-phone': '&#xe915;',
		'bdaia-io-envelop': '&#xe916;',
		'bdaia-io-pushpin': '&#xe917;',
		'bdaia-io-location2': '&#xe918;',
		'bdaia-io-clock': '&#xe955;',
		'bdaia-io-alarm': '&#xe956;',
		'bdaia-io-calendar': '&#xe957;',
		'bdaia-io-bubbles4': '&#xe919;',
		'bdaia-io-user': '&#xe91a;',
		'bdaia-io-quotes-left': '&#xe91b;',
		'bdaia-io-quotes-right': '&#xe91c;',
		'bdaia-io-spinner10': '&#xe91d;',
		'bdaia-io-search': '&#xe91e;',
		'bdaia-io-key2': '&#xe91f;',
		'bdaia-io-cog': '&#xe920;',
		'bdaia-io-rocket': '&#xe921;',
		'bdaia-io-fire': '&#xe967;',
		'bdaia-io-bin': '&#xe922;',
		'bdaia-io-power': '&#xe968;',
		'bdaia-io-menu': '&#xe923;',
		'bdaia-io-link': '&#xe924;',
		'bdaia-io-eye': '&#xe925;',
		'bdaia-io-enter': '&#xe926;',
		'bdaia-io-exit': '&#xe927;',
		'bdaia-io-volume-high': '&#xe928;',
		'bdaia-io-amazon': '&#xe929;',
		'bdaia-io-google': '&#xe92a;',
		'bdaia-io-google-plus': '&#xe92b;',
		'bdaia-io-facebook': '&#xe92c;',
		'bdaia-io-instagram2': '&#xe92d;',
		'bdaia-io-whatsapp2': '&#xe971;',
		'bdaia-io-spotify': '&#xe92e;',
		'bdaia-io-telegram': '&#xe973;',
		'bdaia-io-twitter': '&#xe92f;',
		'bdaia-io-rss': '&#xe930;',
		'bdaia-io-youtube': '&#xe931;',
		'bdaia-io-youtube2': '&#xe932;',
		'bdaia-io-vimeo': '&#xe933;',
		'bdaia-io-flickr2': '&#xe934;',
		'bdaia-io-dribbble': '&#xe935;',
		'bdaia-io-behance': '&#xe936;',
		'bdaia-io-deviantart': '&#xe937;',
		'bdaia-io-wordpress': '&#xe938;',
		'bdaia-io-blogger': '&#xe939;',
		'bdaia-io-tumblr': '&#xe93a;',
		'bdaia-io-appleinc': '&#xe93b;',
		'bdaia-io-soundcloud': '&#xe93c;',
		'bdaia-io-skype': '&#xe93d;',
		'bdaia-io-reddit': '&#xe93e;',
		'bdaia-io-linkedin2': '&#xe93f;',
		'bdaia-io-lastfm': '&#xe940;',
		'bdaia-io-delicious': '&#xe941;',
		'bdaia-io-stumbleupon': '&#xe942;',
		'bdaia-io-xing2': '&#xe943;',
		'bdaia-io-yelp': '&#xe944;',
		'bdaia-io-paypal': '&#xe945;',
		'bdaia-io-lightning': '&#xe969;',
		'bdaia-io-linegraph': '&#xe96a;',
		'bdaia-io-star': '&#xe900;',
		'bdaia-io-like': '&#xe901;',
		'bdaia-io-heart': '&#xe902;',
		'bdaia-io-eye2': '&#xe903;',
		'bdaia-io-bubble': '&#xe904;',
		'bdaia-io-shuffle': '&#xe96b;',
		'bdaia-io-star-outline': '&#xe946;',
		'bdaia-io-star2': '&#xe947;',
		'bdaia-io-social-pinterest': '&#xe948;',
		'bdaia-io-trending_up': '&#xe96c;',
		'bdaia-io-access_time': '&#xe958;',
		'bdaia-io-chevron_left': '&#xe949;',
		'bdaia-io-chevron_right': '&#xe94a;',
		'bdaia-io-eye4': '&#xe959;',
		'bdaia-io-instagram': '&#xe974;',
		'bdaia-io-whatsapp': '&#xe972;',
		'bdaia-io-line-chart': '&#xe96d;',
		'bdaia-io-random': '&#xe96e;',
		'bdaia-io-eye5': '&#xe95a;',
		'bdaia-io-angle-down': '&#xe95b;',
		'bdaia-io-angle-up': '&#xe95c;',
		'bdaia-io-angle-right': '&#xe95d;',
		'bdaia-io-angle-left': '&#xe95e;',
		'bdaia-io-angle-double-down': '&#xe95f;',
		'bdaia-io-angle-double-up': '&#xe960;',
		'bdaia-io-angle-double-right': '&#xe961;',
		'bdaia-io-angle-double-left': '&#xe962;',
		'bdaia-io-angle-double-left2': '&#xe963;',
		'bdaia-io-openid': '&#xe94b;',
		'bdaia-io-digg': '&#xe94c;',
		'bdaia-io-cross': '&#xe94d;',
		'bdaia-io-log-out': '&#xe94e;',
		'bdaia-io-controller-play': '&#xe94f;',
		'bdaia-io-vk': '&#xe950;',
		'bdaia-io-grooveshark': '&#xe951;',
		'bdaia-io-evernote': '&#xe952;',
		'bdaia-io-chevron-up': '&#xe953;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/bdaia-io-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());

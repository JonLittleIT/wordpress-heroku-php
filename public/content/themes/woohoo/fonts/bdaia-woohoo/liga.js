/* A polyfill for browsers that don't support ligatures. */
/* The script tag referring to this file must be placed before the ending body tag. */

/* To provide support for elements dynamically added, this script adds
   method 'icomoonLiga' to the window object. You can pass element references to this method.
*/
(function () {
    'use strict';
    function supportsProperty(p) {
        var prefixes = ['Webkit', 'Moz', 'O', 'ms'],
            i,
            div = document.createElement('div'),
            ret = p in div.style;
        if (!ret) {
            p = p.charAt(0).toUpperCase() + p.substr(1);
            for (i = 0; i < prefixes.length; i += 1) {
                ret = prefixes[i] + p in div.style;
                if (ret) {
                    break;
                }
            }
        }
        return ret;
    }
    var icons;
    if (!supportsProperty('fontFeatureSettings')) {
        icons = {
            'envato': '&#xe970;',
            'okru': '&#xe96f;',
            'home': '&#xe906;',
            'house': '&#xe906;',
            'home2': '&#xe907;',
            'house2': '&#xe907;',
            'home3': '&#xe908;',
            'house3': '&#xe908;',
            'newspaper': '&#xe909;',
            'news': '&#xe909;',
            'image': '&#xe90a;',
            'picture': '&#xe90a;',
            'images': '&#xe90b;',
            'pictures': '&#xe90b;',
            'camera': '&#xe90c;',
            'photo': '&#xe90c;',
            'headphones': '&#xe90d;',
            'headset': '&#xe90d;',
            'play': '&#xe90e;',
            'video': '&#xe90e;',
            'mic': '&#xe90f;',
            'microphone': '&#xe90f;',
            'book': '&#xe910;',
            'read': '&#xe910;',
            'file-text': '&#xe911;',
            'file': '&#xe911;',
            'files-empty': '&#xe912;',
            'files': '&#xe912;',
            'file-text2': '&#xe913;',
            'file4': '&#xe913;',
            'cart': '&#xe914;',
            'purchase': '&#xe914;',
            'phone': '&#xe915;',
            'telephone': '&#xe915;',
            'envelop': '&#xe916;',
            'mail': '&#xe916;',
            'pushpin': '&#xe917;',
            'pin': '&#xe917;',
            'location2': '&#xe918;',
            'map-marker2': '&#xe918;',
            'clock': '&#xe955;',
            'time2': '&#xe955;',
            'alarm': '&#xe956;',
            'time4': '&#xe956;',
            'calendar': '&#xe957;',
            'date': '&#xe957;',
            'bubbles4': '&#xe919;',
            'comments4': '&#xe919;',
            'user': '&#xe91a;',
            'profile2': '&#xe91a;',
            'quotes-left': '&#xe91b;',
            'ldquo': '&#xe91b;',
            'quotes-right': '&#xe91c;',
            'rdquo': '&#xe91c;',
            'spinner10': '&#xe91d;',
            'loading11': '&#xe91d;',
            'search': '&#xe91e;',
            'magnifier': '&#xe91e;',
            'key2': '&#xe91f;',
            'password2': '&#xe91f;',
            'cog': '&#xe920;',
            'gear': '&#xe920;',
            'rocket': '&#xe921;',
            'jet': '&#xe921;',
            'fire': '&#xe967;',
            'flame': '&#xe967;',
            'bin': '&#xe922;',
            'trashcan': '&#xe922;',
            'power': '&#xe968;',
            'lightning': '&#xe968;',
            'menu': '&#xe923;',
            'list3': '&#xe923;',
            'link': '&#xe924;',
            'chain': '&#xe924;',
            'eye': '&#xe925;',
            'views': '&#xe925;',
            'enter': '&#xe926;',
            'signin': '&#xe926;',
            'exit': '&#xe927;',
            'signout': '&#xe927;',
            'volume-high': '&#xe928;',
            'volume': '&#xe928;',
            'amazon': '&#xe929;',
            'brand': '&#xe929;',
            'google': '&#xe92a;',
            'brand2': '&#xe92a;',
            'google-plus': '&#xe92b;',
            'brand5': '&#xe92b;',
            'facebook': '&#xe92c;',
            'brand10': '&#xe92c;',
            'instagram': '&#xe92d;',
            'brand12': '&#xe92d;',
            'whatsapp': '&#xe971;',
            'brand13': '&#xe971;',
            'spotify': '&#xe92e;',
            'brand14': '&#xe92e;',
            'telegram': '&#xe973;',
            'brand15': '&#xe973;',
            'twitter': '&#xe92f;',
            'brand16': '&#xe92f;',
            'feed2': '&#xe930;',
            'rss': '&#xe930;',
            'youtube': '&#xe931;',
            'brand21': '&#xe931;',
            'youtube2': '&#xe932;',
            'brand22': '&#xe932;',
            'vimeo': '&#xe933;',
            'brand24': '&#xe933;',
            'flickr2': '&#xe934;',
            'brand28': '&#xe934;',
            'dribbble': '&#xe935;',
            'brand31': '&#xe935;',
            'behance': '&#xe936;',
            'brand32': '&#xe936;',
            'deviantart': '&#xe937;',
            'brand34': '&#xe937;',
            'wordpress': '&#xe938;',
            'brand44': '&#xe938;',
            'blogger': '&#xe939;',
            'brand47': '&#xe939;',
            'tumblr': '&#xe93a;',
            'brand49': '&#xe93a;',
            'apple': '&#xe93b;',
            'brand53': '&#xe93b;',
            'soundcloud': '&#xe93c;',
            'brand58': '&#xe93c;',
            'skype': '&#xe93d;',
            'brand60': '&#xe93d;',
            'reddit': '&#xe93e;',
            'brand61': '&#xe93e;',
            'linkedin2': '&#xe93f;',
            'brand65': '&#xe93f;',
            'lastfm': '&#xe940;',
            'brand66': '&#xe940;',
            'delicious': '&#xe941;',
            'brand68': '&#xe941;',
            'stumbleupon': '&#xe942;',
            'brand69': '&#xe942;',
            'xing2': '&#xe943;',
            'brand75': '&#xe943;',
            'yelp': '&#xe944;',
            'brand78': '&#xe944;',
            'paypal': '&#xe945;',
            'brand79': '&#xe945;',
          '0': 0
        };
        delete icons['0'];
        window.icomoonLiga = function (els) {
            var classes,
                el,
                i,
                innerHTML,
                key;
            els = els || document.getElementsByTagName('*');
            if (!els.length) {
                els = [els];
            }
            for (i = 0; ; i += 1) {
                el = els[i];
                if (!el) {
                    break;
                }
                classes = el.className;
                if (/bdaia-io-/.test(classes)) {
                    innerHTML = el.innerHTML;
                    if (innerHTML && innerHTML.length > 1) {
                        for (key in icons) {
                            if (icons.hasOwnProperty(key)) {
                                innerHTML = innerHTML.replace(new RegExp(key, 'g'), icons[key]);
                            }
                        }
                        el.innerHTML = innerHTML;
                    }
                }
            }
        };
        window.icomoonLiga();
    }
}());

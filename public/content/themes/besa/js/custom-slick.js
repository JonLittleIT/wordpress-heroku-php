'use strict';

class Carousel {
  CarouselSlick() {
    var _this = this;

    jQuery(".owl-carousel[data-carousel=owl]:visible").each(function () {
      let _this2 = jQuery(this);

      if (!_this2.hasClass("slick-initialized")) {
        if (!jQuery.browser.mobile) {
          _this2.slick(_this._getSlickConfigOption(this));
        } else if (!_this2.data('unslick')) {
          _this2.slick(_this._getSlickConfigOption(this));
        }
      }

      if (_this2.hasClass('instagram-feed') && _this2.hasClass("slick-initialized")) {
        _this2.slick('unslick');

        _this2.slick(_this._getSlickConfigOption(this));
      }
    });
  }

  _getSlickConfigOption(el) {
    var slidesToShow = jQuery(el).data('items'),
        rows = jQuery(el).data('rows') ? parseInt(jQuery(el).data('rows')) : 1,
        desktop = jQuery(el).data('desktopslick') ? jQuery(el).data('desktopslick') : slidesToShow,
        desktopsmall = jQuery(el).data('desktopsmallslick') ? jQuery(el).data('desktopsmallslick') : slidesToShow,
        tablet = jQuery(el).data('tabletslick') ? jQuery(el).data('tabletslick') : slidesToShow,
        landscape = jQuery(el).data('landscapeslick') ? jQuery(el).data('landscapeslick') : 2,
        mobile = jQuery(el).data('mobileslick') ? jQuery(el).data('mobileslick') : 2;
    let enonumber = slidesToShow < jQuery(el).children().length ? true : false,
        enonumber_mobile = 2 < jQuery(el).children().length ? true : false;
    let pagination = enonumber ? Boolean(jQuery(el).data('pagination')) : false,
        nav = enonumber ? Boolean(jQuery(el).data('nav')) : false,
        loop = enonumber ? Boolean(jQuery(el).data('loop')) : false,
        auto = enonumber ? Boolean(jQuery(el).data('auto')) : false;
    var _config = {};
    _config.dots = pagination;
    _config.arrows = nav;
    _config.infinite = loop;
    _config.speed = 1000;
    _config.autoplay = auto;
    _config.autoplaySpeed = jQuery(el).data('autospeed') ? jQuery(el).data('autospeed') : 2000;
    _config.cssEase = 'ease';
    _config.slidesToShow = slidesToShow;
    _config.slidesToScroll = slidesToShow;
    _config.mobileFirst = true;
    _config.vertical = false;
    _config.prevArrow = '<button type="button" class="slick-prev"><i class="icon-arrow-left icons"></i></button>';
    _config.nextArrow = '<button type="button" class="slick-next"><i class="icon-arrow-right icons"></i></button>';
    _config.rtl = jQuery('html').attr('dir') == 'rtl';

    if (rows > 1) {
      _config.slidesToShow = 1;
      _config.slidesToScroll = 1;
      _config.rows = rows;
      _config.slidesPerRow = slidesToShow;
      var settingsFull = {
        slidesPerRow: slidesToShow
      },
          settingsDesktop = {
        slidesPerRow: desktop
      },
          settingsDesktopsmall = {
        slidesPerRow: desktopsmall
      },
          settingsTablet = {
        slidesPerRow: tablet
      },
          settingsLandscape = jQuery(el).data('unslick') ? "unslick" : {
        slidesPerRow: landscape
      },
          settingsMobile = jQuery(el).data('unslick') ? "unslick" : {
        slidesPerRow: mobile
      };
    } else {
      var settingsFull = {
        slidesToShow: slidesToShow,
        slidesToScroll: slidesToShow
      },
          settingsDesktop = {
        slidesToShow: desktop,
        slidesToScroll: desktop
      },
          settingsDesktopsmall = {
        slidesToShow: desktopsmall,
        slidesToScroll: desktopsmall
      },
          settingsTablet = {
        slidesToShow: tablet,
        slidesToScroll: tablet
      },
          settingsLandscape = jQuery(el).data('unslick') ? "unslick" : {
        slidesToShow: landscape,
        slidesToScroll: landscape
      },
          settingsMobile = jQuery(el).data('unslick') ? "unslick" : {
        slidesToShow: mobile,
        slidesToScroll: mobile
      };
    }

    var settingsArrows = jQuery(el).data('nav') ? {
      arrows: false,
      dots: enonumber_mobile
    } : '';
    settingsLandscape = jQuery(el).data('unslick') ? settingsLandscape : jQuery.extend(true, settingsLandscape, settingsArrows);
    settingsMobile = jQuery(el).data('unslick') ? settingsMobile : jQuery.extend(true, settingsMobile, settingsArrows);
    _config.responsive = [{
      breakpoint: 1600,
      settings: settingsFull
    }, {
      breakpoint: 1199,
      settings: settingsDesktop
    }, {
      breakpoint: 991,
      settings: settingsDesktopsmall
    }, {
      breakpoint: 767,
      settings: settingsTablet
    }, {
      breakpoint: 575,
      settings: settingsLandscape
    }, {
      breakpoint: 0,
      settings: settingsMobile
    }];
    return _config;
  }

  getSlickTabs() {
    var _this = this;

    jQuery('ul.nav-tabs li a').on('shown.bs.tab', event => {
      let carouselItemTab = jQuery(jQuery(event.target).attr("href")).find(".owl-carousel[data-carousel=owl]:visible");
      let carouselItemDestroy = jQuery(jQuery(event.relatedTarget).attr("href")).find(".owl-carousel[data-carousel=owl]");

      if (carouselItemDestroy.hasClass("slick-initialized")) {
        carouselItemDestroy.slick('unslick');
      }

      if (!carouselItemTab.hasClass("slick-initialized")) {
        carouselItemTab.slick(_this._getSlickConfigOption(carouselItemTab));
      }
    });
  }

  sellerProductTabs() {
  }

}

class Slider {
  tbaySlickSlider() {
    jQuery('.style-horizontal, .style-vertical').find('.flex-control-thumbs').each(function () {
      if (jQuery(this).children().length == 0) {
        return;
      }

      var _config = {};
      _config.vertical = jQuery(this).parents(".style-horizontal").length < 1;
      _config.slidesToShow = jQuery(this).parent('.woocommerce-product-gallery').data('columns');
      _config.infinite = false;
      _config.focusOnSelect = true;
      _config.settings = "unslick";
      _config.prevArrow = '<span class="owl-prev"></span>';
      _config.nextArrow = '<span class="owl-next"></span>';
      _config.rtl = jQuery('body').hasClass('rtl');
      _config.responsive = [{
        breakpoint: 1200,
        settings: {
          vertical: false,
          slidesToShow: 4
        }
      }];
      jQuery(this).slick(_config);
    });
  }

}

class Layout {
  tbaySlickLayoutSlide() {
    if (jQuery('.tbay-slider-for').length > 0) {
      var _configfor = {};
      var _confignav = {};
      _configfor.rtl = _confignav.rtl = jQuery('body').hasClass('rtl');
      _configfor.slidesToShow = 1;
      var number_table = 1;

      if (jQuery('.tbay-slider-for').data('number') > 0) {
        _configfor.slidesToShow = jQuery('.tbay-slider-for').data('number');
        number_table = jQuery('.tbay-slider-for').data('number') - 1;
      }

      _configfor.arrows = true;
      _configfor.infinite = true;
      _configfor.slidesToScroll = 1;
      _configfor.prevArrow = '<span class="slick-prev"><i class="icon-arrow-left icons"></i></span>';
      _configfor.nextArrow = '<span class="slick-next"><i class="icon-arrow-right icons"></i></span>';
      _configfor.responsive = [{
        breakpoint: 1025,
        settings: {
          vertical: false,
          slidesToShow: number_table
        }
      }, {
        breakpoint: 480,
        settings: {
          vertical: false,
          slidesToShow: 1
        }
      }];
      jQuery('.tbay-slider-for').slick(_configfor);

      if (jQuery('.single-product .tbay-slider-for .slick-slide').length) {
        jQuery('.single-product .tbay-slider-for .slick-track').addClass('woocommerce-product-gallery__image single-product-main-image');
      }
    }
  }

}

class Slider_gallery {
  tbay_slider_gallery() {
    var _config = {};
    _config.slidesToShow = 1;
    _config.slidesToScroll = 1;
    _config.prevArrow = '<button type="button" class="slick-prev"><i class="tb-icon tb-icon-chevron-left"></i></button>';
    _config.nextArrow = '<button type="button" class="slick-next"><i class="tb-icon tb-icon-chevron-right"></i></button>';
    this.tbay_slider_gallery_hover(_config);
    jQuery(document.body).on('tbay_gallery_resize', () => {
      jQuery('.tbay-product-slider-gallery').each(function (index, value) {
        if (jQuery(this).hasClass("slick-initialized")) {
          jQuery(this).slick('unslick');
          jQuery(this).removeAttr('style');
        }
      });
    });
  }

  tbay_slider_gallery_hover(_config) {
    jQuery('.has-slider-gallery').find('.product-image').hover(function (e) {
      let _this = jQuery(e.currentTarget);

      if (!_this.next('.tbay-product-slider-gallery').hasClass("slick-initialized")) {
        _this.next('.tbay-product-slider-gallery').css('height', _this.parent().outerHeight());

        _this.next('.tbay-product-slider-gallery').slick(_config);
      }
    });
  }

}

jQuery(document).ready(function () {
  var carousel = new Carousel();
  var slider = new Slider();
  var layout = new Layout();
  var slider_gallery = new Slider_gallery();
  carousel.CarouselSlick();
  carousel.getSlickTabs();
  slider.tbaySlickSlider();
  layout.tbaySlickLayoutSlide();
  slider_gallery.tbay_slider_gallery();
});
jQuery(document.body).on('tbay_display_mode', () => {
  var slider_gallery = new Slider_gallery();
  slider_gallery.tbay_slider_gallery();
});
jQuery(window).on('load', function () {
  jQuery(document.body).on('tbay_instagramfeed_slick', () => {
    var carousel = new Carousel();
    carousel.CarouselSlick();
  });
});
jQuery(document.body).on('tbay_quick_view', () => {
  var carousel = new Carousel();
  carousel.CarouselSlick();
});

var CustomSlickHandler = function (jQueryscope, jQuery) {
  var carousel = new Carousel();
  carousel.CarouselSlick();
};

jQuery(window).on('elementor/frontend/init', function () {
  if (jQuery.isArray(besa_settings.elements_ready.slick)) {
    jQuery.each(besa_settings.elements_ready.slick, function (index, value) {
      elementorFrontend.hooks.addAction('frontend/element_ready/besa-' + value + '.default', CustomSlickHandler);
    });
  }
});

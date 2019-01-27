/* ======================= imagesLoaded Plugin ===============================

 https://github.com/desandro/imagesloaded
 
 $('#my-container').imagesLoaded(myFunction)
 execute a callback when all images have loaded.
 needed because .load() doesn't work on cached images
 
 callback function gets image collection as argument
 this is the container
 
 original: MIT license. Paul Irish. 2010.
 contributors: Oren Solomianik, David DeSandro, Yiannis Chatzikonstantinou
 
 blank image data-uri bypasses webkit log warning (thx doug jones)
 */

! function(a) {
    var c, f, g, b = a.event,
        d = {
            _: 0
        },
        e = 0;
    c = b.special.throttledresize = {
        setup: function() {
            a(this).on("resize", c.handler)
        },
        teardown: function() {
            a(this).off("resize", c.handler)
        },
        handler: function(h, i) {
            var j = this,
                k = arguments;
            f = !0, g || (setInterval(function() {
                e++, (e > c.threshold && f || i) && (h.type = "throttledresize", b.dispatch.apply(j, k), f = !1, e = 0), e > 9 && (a(d).stop(), g = !1, e = 0)
            }, 30), g = !0)
        },
        threshold: 0
    }
}(jQuery), $ = jQuery;
var BLANK = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
$.fn.imagesLoaded = function(a) {
    function i() {
        var d = $(g),
            f = $(h);
        c && (h.length ? c.reject(e, d, f) : c.resolve(e)), $.isFunction(a) && a.call(b, e, d, f)
    }

    function j(a, b) {
        a.src !== BLANK && -1 === $.inArray(a, f) && (f.push(a), b ? h.push(a) : g.push(a), $.data(a, "imagesLoaded", {
            isBroken: b,
            src: a.src
        }), d && c.notifyWith($(a), [b, e, $(g), $(h)]), e.length === f.length && (setTimeout(i), e.off(".imagesLoaded")))
    }
    var b = this,
        c = $.isFunction($.Deferred) ? $.Deferred() : 0,
        d = $.isFunction(c.notify),
        e = b.find("img").add(b.filter("img")),
        f = [],
        g = [],
        h = [];
    return $.isPlainObject(a) && $.each(a, function(b, d) {
        "callback" === b ? a = d : c && c[b](d)
    }), e.length ? e.on("load.imagesLoaded error.imagesLoaded", function(a) {
        j(a.target, "error" === a.type)
    }).each(function(a, b) {
        var c = b.src,
            d = $.data(b, "imagesLoaded");
        return d && d.src === c ? void j(b, d.isBroken) : b.complete && void 0 !== b.naturalWidth ? void j(b, 0 === b.naturalWidth || 0 === b.naturalHeight) : void((b.readyState || b.complete) && (b.src = BLANK, b.src = c))
    }) : i(), c ? c.promise(b) : b
};
var Grid = function() {
    function n(c) {
        a = jQuery(".og-grid"), m.minHeight = a.attr("data-minheight") ? parseInt(a.attr("data-minheight"), 10) : m.minHeight, b = a.children("li"), m = jQuery.extend(!0, {}, m, c), a.imagesLoaded(function() {
            o(!0), q(), p()
        })
    }

    function o(a) {
        b.each(function() {
            var b = jQuery(this);
            b.data("offsetTop", b.offset().top), a && b.data("height", b.height())
        })
    }

    function p() {
        b.on("click", "span.og-close", function() {
            return u(), !1
        }).children("a").on("click", function(a) {
            var d = jQuery(this).parent();
            return c === b.index(d) ? u() : r(d), !1
        }), g.on("debouncedresize", function() {
            e = 0, d = -1, o(), q(), void 0 !== $.data(this, "preview") && u()
        })
    }

    function q() {
        h = {
            width: g.width(),
            height: g.height()
        }
    }

    function r(a) {
        var b = jQuery.data(this, "preview"),
            c = a.data("offsetTop");
        if (e = 0, void 0 !== b) {
            if (d === c) return b.update(a), !1;
            c > d && (e = b.height), u()
        }
        d = c, b = jQuery.data(this, "preview", new v(a)), b.open()
    }

    function s(a) {
        b = b.add(a), a.each(function() {
            var a = jQuery(this);
            a.data({
                offsetTop: a.offset().top,
                height: a.height()
            })
        })
    }

    function t() {
        b.empty()
    }

    function u() {
        c = -1, jQuery.data(this, "preview").close(), jQuery.removeData(this, "preview")
    }

    function v(a) {
        this.$item = a, this.expandedIdx = b.index(a), this.create(), this.update()
    }
    var h, a = jQuery(".og-grid"),
        b = a.children("li"),
        c = -1,
        d = -1,
        e = 0,
        f = 10,
        g = $(window),
        i = $("html, body"),
        j = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd",
            msTransition: "MSTransitionEnd",
            transition: "transitionend"
        },
        k = j[Modernizr.prefixed("transition")],
        l = Modernizr.csstransitions,
        m = {
            minHeight: 60,
            speed: 350,
            easing: "ease"
        };
    return v.prototype = {
        create: function() {
            this.$title = jQuery("<h3></h3>"), this.$price = jQuery(""), this.$description = jQuery("<p></p>"), this.$href = jQuery('<a href="#">Learn more</a>'), this.$or = jQuery(""), this.$addtocart = jQuery(""), this.$addtohref = this.$addtocart, this.$details = jQuery('<div class="og-details"></div>').append(this.$title, this.$price, this.$description, this.$href, this.$or, this.$addtocart), this.$loading = jQuery('<div class="og-loading"></div>'), this.$fullimage = jQuery('<div class="og-fullimg"></div>').append(this.$loading), this.$closePreview = jQuery('<span class="og-close"></span>'), this.$previewInner = jQuery('<div class="og-expander-inner"></div>').append(this.$closePreview, this.$fullimage, this.$details), this.$previewEl = jQuery('<div class="og-expander"></div>').append(this.$previewInner), this.$item.append(this.getEl()), l && this.setTransition()
        },
        update: function(a) {
            if (a && (this.$item = a), -1 !== c) {
                b.eq(c).removeClass("og-expanded"), jQuery(".og-expanded").each(function() {
                    jQuery(this).removeClass("og-expanded")
                }), this.$item.addClass("og-expanded"), this.positionPreview()
            }
            c = b.index(this.$item);
            var e = this.$item.children("a"),
                f = {
                    href: e.attr("href"),
                    largesrc: e.data("largesrc"),
                    price: e.data("price"),
                    addtohref: e.data("addtohref"),
                    title: e.data("title"),
                    description: e.data("description")
                };
            this.$title.html(f.title), this.$price.html(f.price), this.$description.html(f.description), this.$href.attr("href", f.href), this.$href.html(e.attr("lm-button-text")), this.$addtohref.attr("href", f.addtohref), this.$addtohref.html(e.attr("ac-button-text"));
            var g = this;
            void 0 !== g.$largeImg && g.$largeImg.remove(), g.$fullimage.is(":visible") && (this.$loading.show(), jQuery("<img/>").load(function() {
                var a = jQuery(this);
                a.attr("src") === g.$item.children("a").data("largesrc") && (g.$loading.hide(), g.$fullimage.find("img").remove(), g.$largeImg = a.fadeIn(350), jQuery.browser.msie && g.$largeImg.width("auto").height("auto"), g.$fullimage.append(g.$largeImg))
            }).attr("src", f.largesrc))
        },
        open: function() {
            setTimeout(jQuery.proxy(function() {
                this.setHeights(), this.positionPreview()
            }, this), 25)
        },
        close: function() {
            var a = this,
                c = function() {
                    l && jQuery(this).off(k), a.$item.removeClass("og-expanded"), jQuery(".og-expanded").each(function() {
                        jQuery(this).removeClass("og-expanded")
                    }), a.$previewEl.remove()
                };
            return setTimeout(jQuery.proxy(function() {
                void 0 !== this.$largeImg && this.$largeImg.fadeOut("fast"), this.$previewEl.css("height", 0);
                var a = b.eq(this.expandedIdx);
                console.log(a), a.css("height", a.data("height")).on(k, c), l || c.call()
            }, this), 25), !1
        },
        calcHeight: function() {
            var a = h.height - this.$item.data("height") - f,
                b = h.height;
            a < m.minHeight && (a = m.minHeight, b = m.minHeight + this.$item.data("height") + f), this.height = a, this.itemHeight = b
        },
        setHeights: function() {
            var a = this,
                b = function() {
                    l && a.$item.off(k), a.$item.addClass("og-expanded")
                };
            this.calcHeight(), this.$previewEl.css("height", this.height), this.$item.css("height", this.itemHeight).on(k, b), l || b.call()
        },
        positionPreview: function() {
            var a = this.$item.data("offsetTop"),
                b = this.$previewEl.offset().top - e,
                c = this.height + this.$item.data("height") + f <= h.height ? a : this.height < h.height ? b - (h.height - this.height) : b;
            i.animate({
                scrollTop: c
            }, m.speed)
        },
        setTransition: function() {
            this.$previewEl.css("transition", "height " + m.speed + "ms " + m.easing), this.$item.css("transition", "height " + m.speed + "ms " + m.easing)
        },
        getEl: function() {
            return this.$previewEl
        }
    }, {
        init: n,
        addItems: s,
        clearItems: t
    }
}(jQuery);
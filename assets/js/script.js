/**
 * Theme Front end main js
 *
 */

(function($) {

    /**
     * Slick Slider Options
     * @type {Object}
     */
    function init() {
        console.log("init."), initPlugins(), setTimeout(function() {
            var a = $(".main aside.sidebar"),
                b = $(".main section.content"),
                c = parseInt(a.height()),
                d = parseInt(b.height());
            d >= c && a.height(c + (d - c))
        }, 1e3), initEvents()
    }

    function initPlugins() {
        console.log("Plugins fired."), $(".js-newsbar-functionality").typed({
            stringsElement: $("#typed-strings"),
            typeSpeed: 10,
            backSpeed: 0,
            backDelay: 1500,
            loop: !0,
            showCursor: !1
        });
        /*var a = $(".owl-carousel");
        a.owlCarousel({
            autoWidth: !0,
            slideBy: "page",
            nav: !0,
            navText: ["قبلی", "بعدی"]
        }), a.on("refresh.owl.carousel", function() {
            var a = $(".owl-item.active");
            a.slice(a.length - a.length / 2, a.length).addClass("fromLast"), a.eq(-3).addClass("last")
        }), a.on("translate.owl.carousel", function(a) {
            $(".owl-item.fromLast").removeClass("fromLast"), $(".owl-item.last").removeClass("last")
        }), a.on("translated.owl.carousel", function(a) {
            var b = $(".owl-item.active");
            b.slice(b.length - b.length / 2, b.length).addClass("fromLast"), b.eq(-3).addClass("last")
        }), window.owl = a, $(".fancybox").fancybox({
            maxWidth: 800,
            maxHeight: 600,
            fitToView: !1,
            width: "70%",
            height: "70%",
            autoSize: !1
        })*/
    }

    function initEvents() {
        function a(a) {
            $(window).width() < 768 && a && (window.flag = !1, console.log("Events destroyed."), window.owl.trigger("destroy.owl.carousel").removeClass("owl-carousel owl-loaded"))
        }

        function b() {
            c.toggleClass("isNavigationOpen"), c.hasClass("isNavigationOpen") ? $(".menu-container").stop().fadeIn() : $(".menu-container").stop().fadeOut()
        }
        console.log("Events fired.");
        var c = $("body");
        $(".toggle-navigation").on("click", function(a) {
            b(), a.preventDefault()
        }), $('[href="#contactForm"]').on("click", function(a) {
            b(), a.preventDefault()
        }), $(".menu-container .list-menu a").on("click", function(a) {
            $(this).parent().hasClass("menu-item-has-children") && a.preventDefault()
        }), window.flag = !0, $(window).on("resize", throttle(function() {
            a(window.flag)
        }, 100)), a(window.flag)
    }

    function throttle(a, b) {
        var c = !0;
        return function(d) {
            c && (c = !1, setTimeout(function() {
                c = !0
            }, b), a(d))
        }
    }

    function onchangeSelect(a, b) {
        "" !== window.location.search ? window.location.search.match(/orderby=([^&#]*)/) && "orderby" === b ? window.location.href = window.location.search.replace(/orderby=([^&#]*)/, "orderby=" + a.value) : window.location.search.match(/postperpage=([^&#]*)/) && "postperpage" === b ? window.location.href = window.location.search.replace(/postperpage=([^&#]*)/, "postperpage=" + a.value) : window.location.href = window.location.search + "&" + b + "=" + a.value : window.location.href = window.location.href + "?" + b + "=" + a.value
    }
    $(document).ready(function() {
        "use strict";
        init()
    }), $(function() {
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                var a = $(this.hash);
                if (a = a.length ? a : $("[name=" + this.hash.slice(1) + "]"), a.length) return $("html, body").animate({
                    scrollTop: a.offset().top
                }, 1e3), !1
            }
        })
    });
    var forEach = function(a, b, c) {
        for (var d = 0; d < a.length; d++) b.call(c, d, a[d])
    };

})(jQuery);

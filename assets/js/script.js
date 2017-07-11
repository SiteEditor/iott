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

    var _closeVNav = function(){
        var c = $("body");
        c.toggleClass("isNavigationOpen"), c.hasClass("isNavigationOpen") ? $(".menu-container").stop().fadeIn() : $(".menu-container").stop().fadeOut()
    };

    function initEvents() {

        function a(a) {
            $(window).width() < 768 && a && (window.flag = !1, console.log("Events destroyed."), window.owl.trigger("destroy.owl.carousel").removeClass("owl-carousel owl-loaded"))
        }

        console.log("Events fired.");
        var c = $("body");
        $(".toggle-navigation").on("click", function(a) {
            _closeVNav(), a.preventDefault()
        }), $('[href="#contactForm"]').on("click", function(a) {
            _closeVNav(), a.preventDefault()
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

    $(document).ready(function() {
        "use strict";

        init();

        /**
         * Vertical Menu Accordion
         */
        var _SedVMenu = $('#sed_iott_header_vertical_menu');

        _SedVMenu.find('li.menu-item.menu-item-has-children > a').click(function(e){

            e.preventDefault();

            var $this = $(this);

            if ($this.next().hasClass('active')) {
                $this.next().removeClass('active');
                $this.next().slideUp(350);
            } else {
                $this.parent().parent().find('li .sub-menu').removeClass('active');
                $this.parent().parent().find('li .sub-menu').slideUp(350);
                $this.next().addClass('active');
                $this.next().slideDown(350);
            }

        });

        _SedVMenu.find('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {

                var a = $(this.hash);

                if ( a.length || $("[name=" + this.hash.slice(1) + "]").length ) {

                    _closeVNav();

                }
            }
        });

        var _onchangeSelect = function ( val , b ) {
            "" !== window.location.search ? window.location.search.match(/orderby=([^&#]*)/) && "orderby" === b ? window.location.href = window.location.search.replace(/orderby=([^&#]*)/, "orderby=" + val) : window.location.search.match(/postperpage=([^&#]*)/) && "postperpage" === b ? window.location.href = window.location.search.replace(/postperpage=([^&#]*)/, "postperpage=" + val) : window.location.href = window.location.search + "&" + b + "=" + val : window.location.href = window.location.href + "?" + b + "=" + val
        };

        $(".iott-change-sort-select").on("change" , function(){

            _onchangeSelect( $(this).val() , $(this).data("value") );

        });


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

    var scrollbarContainer =  $(".sed_iott_header_vertical_menu_wrap"),
        scrollbarHeight =  $( window ).height() - 340;  

    scrollbarContainer.css({
        height : scrollbarHeight + 'px', 
    });
    

    scrollbarContainer.mCustomScrollbar({
        autoHideScrollbar:true ,
        advanced:{
            updateOnBrowserResize:true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
            updateOnContentResize:true,
        },
        scrollButtons:{
            enable:true
        },
    });

    var scrollbarContainer_2 =  $(".menu-container .left-panel"),
        scrollbarHeight_2 =  $( window ).height();  

    scrollbarContainer_2.css({
        height : scrollbarHeight_2 + 'px', 
    });
    

    scrollbarContainer_2.mCustomScrollbar({
        autoHideScrollbar:true ,
        advanced:{
            updateOnBrowserResize:true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
            updateOnContentResize:true,
        },
        scrollButtons:{
            enable:true
        },
    });



    var $rtl = ( $("body").hasClass("rtl-body") ) ? true : false;

    $(".features .slider-wrap > .carousel").livequery(function(){

        $(this).slick({
            //mobileFirst         : true ,
            arrows              : true,
            slidesToShow        : 6,
            slidesToScroll      : 6,
            dots                : true,
            //centerMode          : false,
            rtl                 : $rtl,
            //swipe               : true ,
            touchMove           : true ,
            infinite            : false, 
            prevArrow : '<span class="slide-nav-bt slide-prev custom-btn custom-btn-secondary"><i class="fa fa-angle-left"></i></span>',
            nextArrow : '<span class="slide-nav-bt slide-next custom-btn custom-btn-secondary"><i class="fa fa-angle-right"></i></span>',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 6,  
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    });


    $(".customers .slider-wrap > .carousel").livequery(function(){

        $(this).slick({
            mobileFirst         : true ,
            arrows              : true,
            slidesToShow        : 6,
            slidesToScroll      : 6,
            dots                : false,
            //centerMode          : false,
            rtl                 : $rtl,
            //swipe               : true ,
            touchMove           : true ,
            infinite            : false, 
            prevArrow : '<span class="slide-nav-bt slide-prev custom-btn custom-btn-secondary"><i class="fa fa-angle-left"></i></span>',
            nextArrow : '<span class="slide-nav-bt slide-next custom-btn custom-btn-secondary"><i class="fa fa-angle-right"></i></span>',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 6,  
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    });    

    $(".timeline .slider-wrap > .carousel").livequery(function(){

        $(this).slick({
            mobileFirst         : true ,
            arrows              : true,
            slidesToShow        : 16,
            slidesToScroll      : 16,
            dots                : false,
            //centerMode          : false,
            rtl                 : $rtl,
            //swipe               : true ,
            touchMove           : true ,
            infinite            : false, 
            prevArrow : '<span class="slide-nav-bt slide-prev custom-btn custom-btn-secondary"><i class="fa fa-angle-left"></i></span>',
            nextArrow : '<span class="slide-nav-bt slide-next custom-btn custom-btn-secondary"><i class="fa fa-angle-right"></i></span>',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 16,
                        slidesToScroll: 16,  
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    });    

    $(".productSections .slider-wrap > .carousel").livequery(function(){

        $(this).slick({
            mobileFirst         : true ,
            arrows              : false,
            slidesToShow        : 4,
            slidesToScroll      : 4,
            dots                : true,
            //centerMode          : false,
            rtl                 : $rtl,
            //swipe               : true ,
            touchMove           : true ,
            infinite            : false, 
            prevArrow : '<span class="slide-nav-bt slide-prev custom-btn custom-btn-secondary"><i class="fa fa-angle-left"></i></span>',
            nextArrow : '<span class="slide-nav-bt slide-next custom-btn custom-btn-secondary"><i class="fa fa-angle-right"></i></span>',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,  
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    });     


    $('.single-product-thumbnails-slider .slider-wrap > .carousel').slick({
        rtl                 : $rtl,
        slidesToShow        : 1,
        slidesToScroll      : 1,
        arrows              : false,
        fade                : true,
        asNavFor            : '.single-product-nav-slider .slider-wrap > .carousel'
    });
 

    $('.single-product-nav-slider .slider-wrap > .carousel').slick({
        rtl                 : $rtl,
        slidesToShow        : 3,
        slidesToScroll      : 1,
        asNavFor            : '.single-product-thumbnails-slider .slider-wrap > .carousel',
        arrows              : true,
        touchMove           : true ,
        infinite            : true, 
        prevArrow : '<span class="slide-nav-bt slide-prev custom-btn custom-btn-secondary"><i class="fa fa-angle-left"></i></span>',
        nextArrow : '<span class="slide-nav-bt slide-next custom-btn custom-btn-secondary"><i class="fa fa-angle-right"></i></span>',
        //centerMode          : true,
        focusOnSelect       : true
    });
    


})(jQuery);

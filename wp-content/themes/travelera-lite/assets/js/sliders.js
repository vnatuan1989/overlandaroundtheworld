jQuery(document).ready(function($) {
    $('.owl-carousel').each( function() {
        var $carousel = $( this );
        var $loadingClass = $('.owl-carousel');
        var $dots = ($carousel.data("dots") !== undefined) ? $carousel.data("dots") : false;
        var $margin = ($carousel.data("margin") !== undefined) ? $carousel.data("margin") : 0;
        var $nav = ($carousel.data("nav") !== undefined) ? $carousel.data("nav") : true;
        var $rtl = ($carousel.data("rtl") !== undefined) ? $carousel.data("rtl") : false;
        var $items = ($carousel.data("items") !== undefined) ? $carousel.data("items") : 1;
        var $items_tablet = ($carousel.data("items-tablet") !== undefined) ? $carousel.data("items-tablet") : 1;
        var $items_mobile_landscape = ($carousel.data("items-mobile-landscape") !== undefined) ? $carousel.data("items-mobile-landscape") : 1;
        var $items_mobile_portrait = ($carousel.data("items-mobile-portrait") !== undefined) ? $carousel.data("items-mobile-portrait") : 1;
        $carousel.owlCarousel ({
            autoplay:           false,
            autoplayTimeout:    3000,
            autoplayHoverPause: true,
            autoHeight:         false,
            loop:               true,
            margin:             $margin,
            items:              $items,
            nav:                $nav,
            navText:            ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            dots:               $dots,
            rtl:                $rtl,
            responsiveClass:    true,
            responsive: {
                0:{
                    items: $items_mobile_portrait,
                },
                480:{
                    items: $items_mobile_landscape,
                },
                768:{
                    items: $items_tablet,
                },
                1024:{
                    items: $items,
                }
            },
            onInitialize : function(){
                $loadingClass.removeClass('loading');
            },

        });
    });
});
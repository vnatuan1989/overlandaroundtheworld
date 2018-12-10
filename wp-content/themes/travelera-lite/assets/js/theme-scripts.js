(function ($, window) {
    "use strict";

    // Responsive Navigation Menu
    //--------------------------------------------//
    function travelera_responsive_menu() {
        $(".mobile-menu ul li").has('ul').prepend("<span class='side-sub-menu'><i class='fa fa-angle-down'></i></span>");

        $('.mobile-menu ul li .side-sub-menu').on("click", function(){
            $(this).next().next().slideToggle(300);
            if ($(this).children().hasClass('fa-angle-down')) {
                $(this).children().removeClass('fa-angle-down').addClass('fa-angle-up');
            } else {
                $(this).children().removeClass('fa-angle-up').addClass('fa-angle-down');
            }
        });

        $(".menu-btn").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            $("html").toggleClass("openNav");
        });
    
        $(document).on( 'click', function ( e ) {
            var mouseclick = $(e.target);
            if ( mouseclick.hasClass('mobile-menu') || mouseclick.parents().hasClass('mobile-menu') || mouseclick.parents().hasClass('side-sub-menu') ) {
                return;
            }
            else {
                $('html').removeClass("openNav");
            }
        } );
    };

    // Tabs
    //--------------------------------------------//
    function travelera_tabs() {
        "use strict";
        $("#tabs li").on("click", function(){
            $("#tabs li").removeClass('active');
            $(this).addClass("active");
            $(".tab-content").hide();
            var selected_tab = $(this).find("a").attr("href");
            $(selected_tab).fadeIn();
            return false;
        });
    };

    // Back to Top Button
    //--------------------------------------------//
    function travelera_scroll_top() {
        var offset = 220;
        var duration = 500;
        $(window).scroll(function() {
            if ($(this).scrollTop() > offset) {
                $('.back-to-top').fadeIn(duration);
            } else {
                $('.back-to-top').fadeOut(duration);
            }
        });

        $('.back-to-top').on("click", function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop: 0}, duration);
            return false;
        })
    };

    // Cover Image
    //--------------------------------------------//
    function travelera_cover_image() {
        $('.cover-image').each(function(){
            var $bgobj = $(this); // assigning the object

            $(window).scroll(function() {
                var yPos = -($(window).scrollTop() / $bgobj.data('speed')); 

                // Put together our final background position
                var coords = '50% '+ yPos + 'px';

                // Move the background
                $bgobj.css({ backgroundPosition: coords });
            }); 
        });    
    };

    // Header Search
    //--------------------------------------------//
    function travelera_header_search() {
        var search_open = '.main-header .search-open';
        var search_close = '.modal-search .search-close';
        $( search_open ).on( 'click', function ( e ) {
            $('.modal-search').fadeIn(400);
            $('.modal-search').find('.s').focus();
        });
        $( search_close ).on( 'click', function ( e ) {
            $('.modal-search').fadeOut(400);
        });
        $( document ).on( 'keydown', function ( e ) {
            if ( e.keyCode === 27 ) {
                $( '.modal-search' ).fadeOut(400);
            }
        });
    };

    function travelera_scripts() {
        travelera_responsive_menu();
        travelera_tabs();
        travelera_scroll_top();
        travelera_cover_image();
        travelera_header_search();
    }

    $(document).ready(travelera_scripts);
})(jQuery, window);
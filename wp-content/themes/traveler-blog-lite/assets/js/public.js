jQuery(function($) {	
    
	var $window = $(window),
		$body = $('body'),
		$navBar = $('.navbar'),
		clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click';

	

	//sticky Header
	function stickyHeader() {
		$(window).scroll(function() {
			if ($("div").hasClass("header-content")) {

				if ($(window).scrollTop() > 200) {
					$(".site-header").css("margin-top", $(".header-content").height());
					$(".site-header").addClass("sticky-header");

					if ($("body").hasClass("admin-bar")) {
						$(".header-content").css("position", "fixed");
						$(".header-content").css("top", $window.width() < 783 ? "46px" : "32px");
					} else {
						$(".header-content").css("position", "fixed");
						$(".header-content").css("top", "0");
					}
				} else {
					$(".site-header").removeClass("sticky-header");
					$(".site-header").css("margin-top", "0");
					$(".header-content").css("position", "relative");
					$(".header-content").css("top", "0");
				}

				if ($(window).width() < 601 && $("body").hasClass("admin-bar")) {
					if ($(window).scrollTop() > 46) {
						$(".header-content").css("position", "fixed");
						$(".header-content").css("top", "0");
					} else {
						$(".site-header").css("margin-top", "0");
						$(".header-content").css("position", "relative");
						$(".header-content").css("top", "0");
					}
				}

			}
		})
	}

	

	function toggleMobileMenu() {
		var $body = $('body'),
			mobileClass = 'mobile-menu-open',
			clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click',
			transitionEnd = 'transitionend webkitTransitionEnd otransitionend MSTransitionEnd';

		// Click to show mobile menu.
		$('.menu-toggle').on(clickEvent, function(event) {

			event.preventDefault();
			event.stopPropagation(); // Do not trigger click event on '.wrapper' below.
			if ($body.hasClass(mobileClass)) {
				return;
			}
			$body.addClass(mobileClass);
		});

		// When mobile menu is open, click on page content will close it.
		$('.site,.mobile_close_icons')
			.on(clickEvent, function(event) {
				if (!$body.hasClass(mobileClass)) {
					return;
				}
				event.preventDefault();
				$body.removeClass(mobileClass).addClass('animating');
			})
			.on(transitionEnd, function() {
				$body.removeClass('animating');
			});
	}

	/**
	 * Add toggle dropdown icon for mobile menu.
	 * @param $container
	 */
	function initMobileNavigation($container) {

		// Add dropdown toggle that displays child menu items.
		var $dropdownToggle = $('<span class="dropdown-toggle fa fa-angle-down"></span>');

		$container.find('.menu-item-has-children > a').after($dropdownToggle);

		// Toggle buttons and sub menu items with active children menu items.
		$container.find('.current-menu-ancestor > .sub-menu').show();
		$container.find('.current-menu-ancestor > .dropdown-toggle').addClass('toggled-on');
		$container.on(clickEvent, '.dropdown-toggle', function(e) {
			e.preventDefault();
			$(this).toggleClass('toggled-on');
			$(this).next('ul').toggle();
		});
	}

	/**
	 * Scroll to top
	 */
	function scrollToTop() {
		var $window = $(window),
			$button = $('.scroll-to-top');
		$window.scroll(function() {
			$button[$window.scrollTop() > 100 ? 'removeClass' : 'addClass']('hidden');
		});
		$button.on('click', function(e) {
			e.preventDefault();
			$('body, html').animate({
				scrollTop: 0
			}, 500);
		});
	}

	function hideMobileMenuOnDesktops() {
		$window.on( 'resize', function () {
			if ( $window.width() > 992 ) {
				$body.removeClass('mobile-menu-open');
			}
		} )
	}

	
	stickyHeader();
	scrollToTop();	
	toggleMobileMenu();
	initMobileNavigation($('.mobile-menu'));
	hideMobileMenuOnDesktops();	
	
	 /* Initialize masonry */
	jQuery('.post-loop-wrap').each(function( index ) {
		
		var obj_id = jQuery(this).attr('id');
		/* Creating object */
		var masonry_param_obj = {itemSelector: '.traveler-blog-lite-masonry'};
		
		jQuery('#'+obj_id).imagesLoaded(function() {
			$('#'+obj_id).masonry(masonry_param_obj);
		});
	});     
	
	jQuery(".blog-design-latest-post .latest-carousel-post-slider").owlCarousel({
		loop:true,
		items:1,
		margin:10,
		nav:true,	
		dots: false,
	});
	/* Header Search JS Start */
	jQuery(document).on('click', '[data-traveler-blog-lite-1]', function() {
	    var options = jQuery(this).data('traveler-blog-lite-1');
	        if (!options.content.target) {
	            options.content.target = '#traveler-blog-lite-modal-1';
	        }
	        new Custombox.modal(options).open();
	}); 
	/* Header Search JS End */
		
});
jQuery(document).ready(function() {
	var stickyNavTop = jQuery('.main-nav').offset().top;

	var stickyNav = function(){
		var scrollTop = jQuery(window).scrollTop(); 
		if (scrollTop > stickyNavTop ) { 
			jQuery('.main-nav').addClass('stickymenu');
		} else {
			jQuery('.main-nav').removeClass('stickymenu'); 
		}
	};

	stickyNav();

	// Hide Header on on scroll down
	var didScroll;
	var lastScrollTop = 0;
	var delta = 5;
	var navbarHeight = jQuery('.main-nav').offset().top;

	var navbarHeight = navbarHeight + 200;

	jQuery(window).scroll(function(event){
	    didScroll = true;
		stickyNav();
	});

	setInterval(function() {
	    if (didScroll) {
	        hasScrolled();
	        didScroll = false;
	    }
	}, 250);

	function hasScrolled() {
	    var st = jQuery(this).scrollTop();
	    
	    // Make sure they scroll more than delta
	    if(Math.abs(lastScrollTop - st) <= delta)
	        return;
	    
	    // If they scrolled down and are past the navbar, add class .nav-up.
	    // This is necessary so you never see what is "behind" the navbar.
	    if (st > lastScrollTop && st > navbarHeight){
	        // Scroll Down
	        jQuery('.main-nav').removeClass('nav-down').addClass('nav-up');
	    } else {
	        // Scroll Up
	        if(st + jQuery(window).height() < jQuery(document).height()) {
	            jQuery('.main-nav').removeClass('nav-up').addClass('nav-down');
	        }
	    }
	    
	    lastScrollTop = st;
	}
});
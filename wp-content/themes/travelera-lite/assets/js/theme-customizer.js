(function( $ ) {
	"use strict";
	
	// Copyright Text
	wp.customize( 'copyright_text', function( value ) {
		value.bind( function( to ) {
			$( '.copyright-text' ).text( to );
		});
	});
	
	// Color Scheme
	wp.customize( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			$( '.menu-btn, .post-meta .post-cats, .read-more, .search-button, .comment-reply-link, .pagination span, #wp-calendar caption, #commentform #submit' ).css( 'background', to );
		} );
	});
	wp.customize( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			$( '.post-date .fa, .post-author .fa, .post-comments .fa, .edit-link .fa' ).css( 'color', to );
		} );
	});
	wp.customize( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			$( '.pagination span' ).css( 'color', to );
		} );
	});

	// Header Background Color
	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-header' ).css( 'background-color', to );
		} );
	});

	// Logo Color
	wp.customize( 'logo_color', function( value ) {
		value.bind( function( to ) {
			$( '#logo a' ).css( 'color', to );
		} );
	});
    
	// Navigation Link Color
	wp.customize( 'nav_links_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-menu a' ).css( 'color', to );
		} );
	});
    
    /*-----------------------------------------------------------*
    * Typography
    *-----------------------------------------------------------*/
    
    var arr = {
        logo: '#logo',
        menu: '.nav-menu',
        headings: '.post-content h1,.post-content h2,.post-content h3,.post-content h4,.post-content h5,.post-content h6,.post-nav-link',
        entry_title: '.entry-title',
        single_title: '.single .entry-title',
        post_meta: '.post-meta, .post-cats',
        post_content: '.post-content',
        widgets_title: '.section-heading, .post-nav-title',
    };
    
    jQuery.each(arr, function (index, valuee) {
        wp.customize( index + '_font_style', function( value ) {
            value.bind( function( to ) {
                $( valuee ).css( 'font-style', to );
            } );
        });
        
        wp.customize( index + '_font_weight', function( value ) {
            value.bind( function( to ) {
                $( valuee ).css( 'font-weight', to );
            } );
        });
        
        wp.customize( index + '_text_transform', function( value ) {
            value.bind( function( to ) {
                $( valuee ).css( 'text-transform', to );
            } );
        });
        
        wp.customize( index + '_font_size', function( value ) {
            value.bind( function( to ) {
                $( valuee ).css( 'font-size', to );
            } );
        });
        
        wp.customize( index + '_line_height', function( value ) {
            value.bind( function( to ) {
                $( valuee ).css( 'line-height', to );
            } );
        });
    });

})( jQuery );

jQuery(document).ready(function($) {
	
	// For Slider
	$( '.iscwp-gallery-slider' ).each(function( index ) {
		
		var slider_id   = $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.iscwp-gallery-slider-wrp').find('.iscwp-gallery-slider-conf').attr('data-conf'));
		
		jQuery('#'+slider_id).slick({
			dots			: (slider_conf.dots) == "true" ? true : false,
			infinite		: (slider_conf.loop) == "true" ? true : false,
			arrows			: (slider_conf.arrows) == "true" ? true : false,
			speed			: parseInt(slider_conf.speed),
			autoplay		: (slider_conf.autoplay) == "true" ? true : false,
			autoplaySpeed	: parseInt(slider_conf.autoplay_interval),
			slidesToShow	: parseInt(slider_conf.slidestoshow),
			slidesToScroll	: parseInt(slider_conf.slidestoscroll),
			rtl             : (Iscw.is_rtl == 1) ? true : false,
			mobileFirst    	: (Iscw.is_mobile == 1) ? true : false,
			responsive 		: [{
				breakpoint 	: 1023,
				settings 	: {
					slidesToShow 	: (parseInt(slider_conf.slidestoshow) > 3) ? 3 : parseInt(slider_conf.slidestoshow),
					slidesToScroll 	: 1,
					infinite 		: (slider_conf.loop) == "true" ? true : false,
					dots 			: (slider_conf.dots) == "true" ? true : false,
				}
			},{
				breakpoint	: 767,	  			
				settings	: {
					slidesToShow 	: (parseInt(slider_conf.slidestoshow) > 2) ? 2 : parseInt(slider_conf.slidestoshow),
					slidesToScroll 	: 1,
					infinite 		: (slider_conf.loop) == "true" ? true : false,
					dots 			: (slider_conf.dots) == "true" ? true : false,
				}
			},
			{
				breakpoint	: 479,
				settings	: {
					slidesToShow 	: 1,
					slidesToScroll 	: 1,
					dots 			: false,
					infinite 		: (slider_conf.loop) == "true" ? true : false,
				}
			},
			{
				breakpoint	: 319,
				settings	: {
					slidesToShow 	: 1,
					slidesToScroll 	: 1,
					dots 			: false,
					infinite 		: (slider_conf.loop) == "true" ? true : false,
				}
			}]
		});
	});

	// Popup Gallery
	$( '.iscwp-popup-gallery' ).each(function( index ) {
		
		var gallery_id 	= $(this).attr('id');
		
		if( typeof(gallery_id) !== 'undefined' && gallery_id != '' ) {
			
			var user 		= $(this).attr('data-user');
			var popup_conf 	= $.parseJSON( $(this).closest('.iscwp-main-wrp').find('.wp-iscwp-popup-conf').attr('data-conf') );

			$('#'+gallery_id).magnificPopup({
				delegate: 'a.iscwp-img-link',
				type: 'inline',
				mainClass: 'iscwp-mfp-popup',
				tLoading: 'Loading image #%curr%...',
				gallery: {
					enabled : (popup_conf.popup_gallery) == "true" ? true : false,
				},
				callbacks: {
					change: function() {

						var popup_obj 		= this.content;
						var media_shortcode = popup_obj.attr('data-shortcode');

						if( media_shortcode ) {
							
							popup_obj.find('.iscwp-loader').fadeIn();
							popup_obj.find('.iscwp-error').remove();

							// Creating object
							var shortcode_obj = {};

							// Creating object
							$.each(popup_conf, function (key,val) {
								shortcode_obj[key] = val;
							});

							var data = {
					            action  		: 'iscw_get_media_data',
					            shortcode   	: media_shortcode,
					            user 			: user,
					            shrt_param 		: shortcode_obj
					        };

					        $.post(Iscw.ajaxurl, data, function(response) {
					        	var result = jQuery.parseJSON(response);

					        	if(result.success == 1) {
					        		popup_obj.find('.iscwp-loader').hide();
					        		popup_obj.find('.iscwp-popup-body').html(result.data);
					        		popup_obj.removeAttr('data-shortcode');
					        	} else {
					        		popup_obj.find('.iscwp-loader').hide();
					        		popup_obj.find('.iscwp-popup-body').html('<div class="iscwp-error">'+result.msg+'</div>');
					        	}
					        });
					    }
					}
				}
			});
		}
	});
});
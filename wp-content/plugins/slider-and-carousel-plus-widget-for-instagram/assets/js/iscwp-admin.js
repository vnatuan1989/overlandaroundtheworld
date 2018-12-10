jQuery(document).ready(function($) {
	
	$(document).on('click', '.iscwp-crl-cache', function() {


		var current_obj = $(this);

		var user_name = current_obj.attr('data-user');

		current_obj.attr('disabled','disabled');
		current_obj.parent().find('.spinner').css('visibility', 'visible');

		var data = {
            action  		: 'iscw_clear_cache',
            user_name   	: user_name,
        };

        $.post(ajaxurl,data,function(response) {

        	var result = jQuery.parseJSON(response);

        	if( result.success == 1 ) {

        		current_obj.closest('.inside').find('.iscwp-msg-wrap').html(result.msg).fadeIn().delay(300).fadeOut();

				current_obj.closest('tr.iscwp-user').fadeOut(300, function(){
					$(this).remove();
				});

				var tr_cnt = current_obj.closest('table').find('tr').length

				if(tr_cnt <= 2){
					current_obj.closest('table').find('tr.iscwp-user-empty').fadeIn(300);
				}
			}

			current_obj.removeAttr('disabled','disabled');
			current_obj.parent().find('.spinner').css('visibility', '');
        });
	});

	$(document).on('click', '.iscwp-crl-all-cache', function() {

		var current_obj = $(this);

		current_obj.attr('disabled','disabled');
		current_obj.closest('#general').find('#iscwp-cache-user table tr input').attr('disabled','disabled');

		var data = {
            action  : 'iscw_clear_all_cache',
        };

        $.post(ajaxurl,data,function(response) {

        	var result = jQuery.parseJSON(response);

        	if( result.success == 1 ) {

        		current_obj.closest('#general').find('#iscwp-cache-user').find('.iscwp-msg-wrap').html(result.msg).fadeIn().delay(300).fadeOut();

				current_obj.closest('#general').find('#iscwp-cache-user table tr.iscwp-user*').fadeOut(300, function(){
					$(this).remove();
				});

				current_obj.closest('#general').find('#iscwp-cache-user table tr.iscwp-user-empty').fadeIn(300);
			}

			current_obj.removeAttr('disabled','disabled');
			current_obj.parent().find('.spinner').css('visibility', '');
        });
	});
});
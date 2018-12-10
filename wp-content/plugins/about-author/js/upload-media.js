var uploadID = ''; 
jQuery(document).on("click", ".upload_image_button", function() {
	uploadID = jQuery(this).prev('input'); /*grab the specific input*/
	imgID = jQuery(this).next('img');
	formfield = jQuery('.upload').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	window.send_to_editor = function(html) {	
		imgurl = jQuery(html).attr('src');
		if(!(imgurl)) {
			imgurl = jQuery('img', html).attr('src');
		}
		uploadID.val(imgurl); /*assign the value to the input*/
		imgID.attr('src',imgurl);
		tb_remove();
	};		
	return false;
});
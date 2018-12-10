<?php
/**
 * 'iscw-grid' Shortcode
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function iscw_grid( $atts, $content = null ) {
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'username'							=> '',
		'grid'    							=> 2,
		'instagram_link_text' 				=> __('View On Instagram','slider-and-carousel-plus-widget-for-instagram'),
		'limit'								=> '',
		'popup_gallery'						=> 'true',
		'show_caption'						=> 'true',
		'popup'								=> 'true',
		'show_likes_count'					=> 'true',
		'show_comments_count'				=> 'true',
		'gallery_height'                   	=> '',
		'image_fit'							=> 'true',
		'offset'							=> '',
	), $atts, 'iscwp-grid'));

	$username						= !empty($username)					? $username 						: '';
	$grid 							= (!empty($grid) && $grid <= 12) 	? $grid 							: '3';
	$instagram_link_text 			= !empty($instagram_link_text)		? $instagram_link_text : __('View On Instagram','slider-and-carousel-plus-widget-for-instagram');
	$limit 							= ($limit != '')					? $limit 							: 20;
	$popup_gallery					= ($popup_gallery == 'true')		? 'true'							: 'false';
	$show_caption					= ($show_caption == 'false')		? 'false'							: 'true';
	$popup							= ($popup == 'false')				? 'false'							: 'true';
	$show_likes_count				= ($show_likes_count == 'false')	? 'false'							: 'true';
	$show_comments_count			= ($show_comments_count == 'false')	? 'false'							: 'true';
	$grid_cls 						= "iscwp-grid-".$grid;
	$image_fit			            = ($image_fit == 'false')			? false                              : true;
	
	$offset 						= (is_numeric($offset) && $offset >= 0)	? $offset 						: '';
	$offset_css						= ($offset != '')					? "padding:{$offset}px;"			: '';
	
	$gallery_height 		    	= (!empty($gallery_height)) 		? $gallery_height 				    : '';
	$height_css 				    = (!empty($gallery_height))		? "style='height:{$gallery_height}px;'" : '';
	$img_size						= iscw_img_size( $grid );

	// If no username is passed then return
	if( empty($username) ) {
		return $content;
	}
	
	// Enqueue required script
	if( $popup == 'true' ) {
	
		wp_enqueue_script('wpos-magnific-script');
		wp_enqueue_script('iscwp-public-js');

		// Popup Configuration
		$popup_conf = compact( 'popup_gallery', 'show_likes_count', 'show_comments_count', 'show_caption', 'instagram_link_text' );
	}
	
	// Taking some variables
	$popup_html 			= '';
	$loop_count				= 1;
	$count 					= 1;
	$unique					= iscw_get_unique();
	$popup_cls 				= ($popup == 'true') 	? 'iscwp-popup-gallery' 	: '';
	$image_fit_class	    = ($image_fit) 	        ? 'iscwp-image-fit' : '';
	$main_cls 				= "iscwp-cnt-wrp iscwp-col-{$grid} iscwp-columns";

	$instagram_link_main	= 'https://www.instagram.com/';
	$instagram_data 	 	= iscw_get_user_media( $username );
	$insta_user_media		= !empty($instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges']) ? $instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges'] : '';

	// User details
	$userdata 				= array();
	$userdata = array(
		'username' 			=>	(isset($instagram_data['iscwp_user_data']['username']) && $instagram_data['iscwp_user_data']['username']) ? $instagram_data['iscwp_user_data']['username'] : '',
		'full_name'			=>	(isset($instagram_data['iscwp_user_data']['full_name']) && $instagram_data['iscwp_user_data']['full_name']) ? $instagram_data['iscwp_user_data']['full_name'] : '',
		'profile_picture'	=>	(isset($instagram_data['iscwp_user_data']['profile_pic_url']) && $instagram_data['iscwp_user_data']['profile_pic_url']) ? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
	);
	
	ob_start();

	if( !empty($insta_user_media) ) { ?>
		
		<div class="iscwp-main-wrp iscwp-clearfix">			
			<div id="iscwp-gallery-<?php echo $unique; ?>" class="iscwp-gallery-grid <?php echo $popup_cls.' '.$image_fit_class; ?> <?php echo $grid_cls; ?> iscwp-clearfix" data-user="<?php echo $username; ?>">
				<div class="iscwp-outer-wrap iscwp-clearfix">					
					<?php foreach ($insta_user_media as $iscwp_key => $iscwp_data) {

						$iscwp_data 		= iscw_insta_image_data( $iscwp_data );
						$img_shortcode 		= $iscwp_data['shortcode'];
						$gallery_img_src 	= isset( $iscwp_data['thumbnail_resources'][$img_size] ) ? $iscwp_data['thumbnail_resources'][$img_size] : $iscwp_data['display_url'];
						$iscwp_likes 		= iscw_format_number( $iscwp_data['like_count'] );
						$iscwp_comments 	= iscw_format_number( $iscwp_data['comment_count'] );
						$instagram_link 	= $iscwp_data['link'];
						$img_caption 		= $iscwp_data['caption'];
						$iscwp_link_value 	= ($popup =='true') ? '#wp-iscwp-popup-'.$unique.'-'.$count : $instagram_link ;

						// Getting media data
						$media_data 	= iscw_user_media_data( $username, $img_shortcode );
						$location 		= isset($media_data['location']) 		? $media_data['location'] 		: '';						
						$video_url		= isset($media_data['video_url']) 		? $media_data['video_url'] 		: '';
						$popup_attr 	= (!$media_data) ? "data-shortcode='{$img_shortcode}'" : '';

						$wrpper_cls			= ($loop_count == 1) ? $main_cls.' iscwp-first' : $main_cls;
						
						include( ISCW_DIR . '/templates/design-1.php' );

						// Creating Popup HTML
						if( $popup == 'true' ) {
							ob_start();
							include( ISCW_DIR . '/templates/popup/popup.php' );
							$popup_html .= ob_get_clean();
						}

						if( $limit == $count) {
							break;
						}

						$count++;
						$loop_count++; // Increment loop count for grid
						
						// Reset loop count
						if( $loop_count == $grid ) {
							$loop_count = 0;
						}
					} ?>
				</div>
			</div>

			<?php if($popup == 'true') { ?>
				<div class="wp-iscwp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
			<?php } ?>
		</div>
	<?php }

	echo $popup_html; // Printing popup html
	$content .= ob_get_clean();
	return $content;
}

// 'iscwp-grid' shortcode
add_shortcode('iscwp-grid', 'iscw_grid');
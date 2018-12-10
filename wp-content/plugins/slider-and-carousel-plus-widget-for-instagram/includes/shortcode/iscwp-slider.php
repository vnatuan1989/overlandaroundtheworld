<?php
/**
 * 'iscwp-slider' Shortcode
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function iscw_slider( $atts, $content = null ) {
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'username'							=> '',
		'instagram_link_text' 				=> __('View On Instagram','slider-and-carousel-plus-widget-for-instagram'),
		'limit'								=> '',
		'popup_gallery'						=> 'true',
		'show_caption'						=> 'true',
		'popup'								=> 'true',
		'show_likes_count'					=> 'true',
		'show_comments_count'				=> 'true',
		'slidestoshow' 						=> '3',
		'slidestoscroll' 					=> '1',
		'loop' 								=> 'true',
		'dots'     							=> 'true',
		'arrows'     						=> 'true',
		'autoplay'     						=> 'true',
		'autoplay_interval' 				=> '3000',
		'speed'             				=> '300',
		'gallery_height'                   => '',
		'image_fit'							=> 'true',	
		'offset'							=> '',
	), $atts, 'iscwp-slider'));
	
	$username						= !empty($username)					? $username 						: '';
	$instagram_link_text			= !empty($instagram_link_text)		? $instagram_link_text 				: '';
	$limit 							= ($limit != '')					? $limit 							: 20;
	$popup_gallery					= ($popup_gallery == 'true')		? 'true'							: 'false';
	$show_caption					= ($show_caption == 'false')		? 'false'							: 'true';
	$popup							= ($popup == 'false')				? 'false'							: 'true';
	$show_likes_count				= ($show_likes_count == 'false')	? 'false'							: 'true';
	$show_comments_count			= ($show_comments_count == 'false')	? 'false'							: 'true';
	$slidestoshow 					= !empty($slidestoshow) 			? $slidestoshow 					: 3;
	$slidestoshow 					= ($limit <= $slidestoshow) 		? $limit 							: $slidestoshow;
	$slidestoscroll 				= !empty($slidestoscroll) 			? $slidestoscroll 					: 1;
	$loop 							= ( $loop == 'false' ) 				? 'false' 							: 'true';
	$dots 							= ( $dots == 'false' ) 				? 'false' 							: 'true';
	$arrows 						= ( $arrows == 'false' ) 			? 'false' 							: 'true';
	$autoplay 						= ( $autoplay == 'false' ) 			? 'false' 							: 'true';
	$autoplay_interval 				= (!empty($autoplay_interval)) 		? $autoplay_interval 				: 3000;
	$speed 							= (!empty($speed)) 					? $speed 							: 300;
	$image_fit			            = ($image_fit == 'false')		? false                              : true;
	$gallery_height 		    	= (!empty($gallery_height)) 		? $gallery_height 				    : '';
	$height_css 					= (!empty($gallery_height))		? "style='height:{$gallery_height}px;'" : '';
	$offset 						= (is_numeric($offset) && $offset >= 0)	? $offset 						: '';
	$offset_css						= ($offset != '')					? "padding:{$offset}px;"			: '';


	// If no username is passed then return
	if( empty($username) ) {
		return $content;
	}	

	// Enqueue required script
	if( $popup == 'true' ) {
		wp_enqueue_script('wpos-magnific-script');
		$popup_conf = compact( 'popup_gallery', 'show_likes_count', 'show_comments_count', 'show_caption', 'instagram_link_text' );
	}

	wp_enqueue_script('wpos-slick-jquery');
	wp_enqueue_script('iscwp-public-js');
	
	// Taking some variables
	$popup_html 			= '';
	$loop_count				= 1;

	$count 					= 1;	
	$unique					= iscw_get_unique();
	$popup_cls 				= ($popup == 'true') ? 'iscwp-popup-gallery' : '';
	$main_cls 				= "iscwp-cnt-wrp";
	$wrpper_cls				= $main_cls;
	$image_fit_class	    = ($image_fit) ? 'iscwp-image-fit' : '';
	$img_size				= iscw_img_size( $slidestoshow );

	$instagram_link_main 	= 'https://www.instagram.com/';
	$instagram_data 	 	= iscw_get_user_media( $username );
	$insta_user_media		= !empty($instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges']) ? $instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges'] : '';

	$userdata = array(
		'username' 			=>	(isset($instagram_data['iscwp_user_data']['username']) && $instagram_data['iscwp_user_data']['username']) ? $instagram_data['iscwp_user_data']['username'] : '',
		'full_name'			=>	(isset($instagram_data['iscwp_user_data']['full_name']) && $instagram_data['iscwp_user_data']['full_name']) ? $instagram_data['iscwp_user_data']['full_name'] : '',
		'profile_picture'	=>	(isset($instagram_data['iscwp_user_data']['profile_pic_url']) && $instagram_data['iscwp_user_data']['profile_pic_url']) ? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
	);

	// Slider configuration
	$slider_conf = compact('slidestoshow', 'slidestoscroll', 'loop', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed');

	ob_start();

	//if data there
	if( !empty($insta_user_media) ) { ?>

		<div class="iscwp-gallery-slider-wrp iscwp-clearfix iscwp-main-wrp ">
			<div id="iscwp-gallery-<?php echo $unique; ?>" class="iscwp-gallery-slider slidestoshow-<?php echo $slidestoshow; ?> <?php echo $popup_cls.' '.$image_fit_class; ?>" data-user="<?php echo $username; ?>"><?php

				foreach ($insta_user_media as $iscwp_key => $iscwp_data) {
					
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
					
					include( ISCW_DIR . '/templates/design-1.php' );

					 // Creating Popup HTML
					if( $popup == 'true' ) {
						ob_start();
						include( ISCW_DIR . '/templates/popup/popup.php' );
						$popup_html .= ob_get_clean();
					}
					
					if( $limit == $count ) {
						break;
					}
					
					$count++;
					$loop_count++; // Increment loop count for grid
				} ?>
			</div>
			<div class="iscwp-gallery-slider-conf iscwp-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>

			<?php if($popup == 'true') { ?>
				<div class="wp-iscwp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
			<?php } ?>
		</div>
	<?php }

	echo $popup_html; // Printing popup html
	$content .= ob_get_clean();

	return $content;
}

// 'iscwp-slider' shortcode
add_shortcode('iscwp-slider', 'iscw_slider');
<?php
/**
 * Public Class
 *
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.2
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Iscw_Public {

	function __construct() {

		// Ajax call to update attachment data
		add_action( 'wp_ajax_iscw_get_media_data', array($this, 'iscw_get_media_data') );
		add_action( 'wp_ajax_nopriv_iscw_get_media_data', array( $this, 'iscw_get_media_data') );
	}

	/**
	 * Get Insta Media Data
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.1
	 */
	function iscw_get_media_data() {

		// Taking passed data
		extract( $_POST['shrt_param'] );
		$shortcode 	= trim($_POST['shortcode']);
		$username 	= trim($_POST['user']);

		// Taking some defaults		
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'instagram-slider-and-carousel-plus-widget');

		if( $shortcode && $username ) {

			$transient_key 		= "wp_iscwp_media_data_{$username}";

			$stored_transient 	= get_transient( $transient_key ); // Getting cache value
			$stored_transient	= !empty($stored_transient) ? json_decode($stored_transient, true) : array();

			if( $stored_transient === false || empty($stored_transient[$shortcode]) ) {

				$api_url 		= "https://www.instagram.com/p/{$shortcode}/?__a=1";
				$response_data 	= iscw_insta_request( $api_url );

				if( $response_data['body'] ) {
					
					$response_arr 					= json_decode($response_data['body'], true);
					$stored_transient[$shortcode]	= $response_arr;

					// Stored media data into cache
					set_transient( $transient_key, json_encode($stored_transient), 172800 );
				}
			}

			// Getting user data for popup info
			$instagram_link_main 	= 'https://www.instagram.com/';
			$instagram_data 		= iscw_get_user_media( $username );
			$insta_user_media 		= !empty($instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges']) ? $instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges'] : '';

			if( $insta_user_media ) {

				// User details
				$userdata = array(
					'username' 			=>	(!empty($instagram_data['iscwp_user_data']['username'])) 			? $instagram_data['iscwp_user_data']['username'] 		: '',
					'full_name'			=>	(!empty($instagram_data['iscwp_user_data']['full_name'])) 			? $instagram_data['iscwp_user_data']['full_name'] 		: '',
					'profile_picture'	=>	(!empty($instagram_data['iscwp_user_data']['profile_pic_url']) ) 	? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
				);

				$media_node_data 	= wp_list_pluck( $insta_user_media, 'node' );
				$media_id_data 		= wp_list_pluck( $media_node_data, 'shortcode' );
				$media_ref_key 		= array_search($shortcode, $media_id_data);
				$media_ref_data		= isset($insta_user_media[$media_ref_key]) ? $insta_user_media[$media_ref_key] : '';

				$iscwp_data 		= iscw_insta_image_data( $media_ref_data );						
				$gallery_img_src 	= $iscwp_data['standard_img'];
				$iscwp_likes 		= iscw_format_number( $iscwp_data['like_count'] );
				$iscwp_comments 	= iscw_format_number( $iscwp_data['comment_count'] );
				$instagram_link 	= $iscwp_data['link'];
				$img_caption 		= $iscwp_data['caption'];						

				// Getting media data
				$media_data 	= iscw_user_media_data( $username, $shortcode );
				$location 		= isset($media_data['location']) 		? $media_data['location'] 		: '';
				$comment_data 	= isset($media_data['comment_data']) 	? $media_data['comment_data'] 	: '';
				$video_url		= isset($media_data['video_url']) 		? $media_data['video_url'] 		: '';

				ob_start();
				include( ISCW_DIR . '/templates/popup/design-1.php' );
				$data = ob_get_clean();

				$result['success'] 	= 1;
				$result['data'] 	= $data;
				$result['msg'] 		= __('Success', 'instagram-slider-and-carousel-plus-widget');
			}

		} // End of check username and shortcode

		echo json_encode( $result );
		exit;
	}
}

$Iscw_public = new Iscw_Public();
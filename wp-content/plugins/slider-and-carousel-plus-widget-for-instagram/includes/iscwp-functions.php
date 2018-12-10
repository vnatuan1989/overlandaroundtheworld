<?php
/**
 * Plugin generic functions file
 *
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get unique number
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0
 */ 
 function iscw_get_unique() {
    static $unique = 0;
    $unique++;

    return $unique;
}

/**
 * Function to get grid column based on grid
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_grid_column( $grid = '' ) {
	
	if($grid == '2') {
		$grid_clmn = '6';
	} else if($grid == '3') {
		$grid_clmn = '4';
	}  else if($grid == '4') {
		$grid_clmn = '3';
	} else if ($grid == '1') {
		$grid_clmn = '12';
	} else {
		$grid_clmn = '12';
	}
	return $grid_clmn;
}

/**
 * Function to get format number
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_format_number($number) {  
    if($number >= 1000) {
       return floor($number/1000) . "k";   // NB: you will want to round this  
    }  
    else {  
        return $number;  
    }  
}

/**
 * API Function for instagram request
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0
 */
function iscw_insta_request( $api_url, $args = array() ) {

	// Taking some defaults
	$result				= array();
	$response_cookies	= array();

	// If API URL is there
	if( $api_url ) {

		// API args
		$api_args	= array(
						'timeout' 		=> 15,
						'sslverify' 	=> false,
						'user-agent'  	=> 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36',
						'headers'		=> array(
												'Origin' 		=> 'https://www.instagram.com',
            									'Referer' 		=> 'https://www.instagram.com',
            									'Connection' 	=> 'close',
            									'Host'			=> 'www.instagram.com'
							 				)
					);
		if (!empty($args['headers'])) {
	        $args['headers'] = array_merge($api_args['headers'], $args['headers']);
	    }
		$api_args = wp_parse_args( $args, $api_args );

		// Getting Data
		$response = wp_remote_get( $api_url, $api_args );

		// make sure the response came back okay
		if ( !is_wp_error( $response ) || wp_remote_retrieve_response_code($response) === 200 ) {

			$response_body = wp_remote_retrieve_body($response);

			// Cookies
			if( $response['cookies'] ) {
				foreach ($response['cookies'] as $cookie_key => $cookie_data) {
					$response_cookies[ $cookie_data->name ] = $cookie_data->value;
				}
			}
		}
	}

	$result = array(
					'cookies' 	=> $response_cookies,
    				'body' 		=> isset($response_body) ? $response_body : '',
				);
	return $result;
}

/**
 * Function to get user info and media
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0
 */
function iscw_get_user_media( $username, $limit = 60, $cache = true ) {

	// If no username then simply return
	if( empty($username) ) {
		return false;
	}

	// Taking some defaults
	$result_data		= array();
	$response_matches	= array();
	$transient_key 		= "wp_iscwp_media_{$username}";
	$username 			= !empty($username) ? trim($username) 	: '';
	$limit 				= !empty($limit) 	? trim($limit) 		: 60;
	$limit				= ($limit >= 60)	? 60				: $limit;

	$stored_transient 	= get_transient( $transient_key ); // Getting cache value
	$stored_transient	= !empty($stored_transient) ? json_decode($stored_transient, true) : false;

	if( $stored_transient === false || (!$cache) ) {

		$api_url 		= "https://www.instagram.com/{$username}/";
		$response_data 	= iscw_insta_request( $api_url );

		preg_match('#window\._sharedData\s*=\s*(.*?)\s*;\s*</script>#', $response_data['body'], $response_matches);

		if( isset($response_matches[1]) ) {
			
			$page_data = json_decode($response_matches[1], true);
			
			if ( $page_data || !empty($page_data['entry_data']['ProfilePage'][0]['graphql']['user']) ) {
				$user_data = $page_data['entry_data']['ProfilePage'][0]['graphql']['user'];

				// If user is not private
				if ( !$user_data['is_private'] ) {

					/*// API URL Data
					$api_url	= "https://www.instagram.com/graphql/query/";
					$api_url	= add_query_arg( array(
													'query_id' 	=> '17888483320059182',
			                                        'id' 		=> $user_data['id'],
			                                        'first' 	=> $limit
												), $api_url );

					// API args
					$api_args = array();
					$api_args['headers'] = array(
											'X-Csrftoken' 		=> isset($response_data['cookies']['csrftoken']) ? $response_data['cookies']['csrftoken'] : '',
											'X-Requested-With' 	=> 'XMLHttpRequest',
											'X-Instagram-Ajax' 	=> '1'
										);
					$api_args['cookies'] = array_merge( $response_data['cookies'], array(
																					'ig_or' => 'landscape-primary',
																					'ig_pr' => '1',
																					'ig_vh' => rand(500, 1000),
																					'ig_vw' => rand(1100, 2000),
																				));

					$query_res = iscw_insta_request( $api_url, $api_args );*/

					// If we are getting the data
					//if( !empty($query_res['body']) ) {

						// Only store keys to remove stored cache in case
						$cache_transient 			= get_option( 'wp_iscwp_cache_transient', array() );
						$cache_transient[$username] = $transient_key;
						$cache_transient 			= array_unique($cache_transient);
						update_option( 'wp_iscwp_cache_transient', $cache_transient );

						$result_data['iscwp_data'] 			= $user_data;
						$result_data['iscwp_user_data'] 	= iscw_get_user_details( $user_data ); // Getting user details
						set_transient( $transient_key, json_encode($result_data), 172800 );
					//}
				}
			}
		}

	} else {
		$result_data = $stored_transient;
	}

	return $result_data;
}

/**
 * Function to get user media data
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0
 */
function iscw_user_media_data( $username, $media_shortcode = false ) {

	// If empty username then return
	if( empty($username) ) {
		return false;
	}

	$result 			= false;
	$count 				= 1;
	$comment_limit		= 5;
	$transient_key 		= "wp_iscwp_media_data_{$username}";

	$stored_transient 	= get_transient( $transient_key ); // Getting cache value
	$stored_transient	= !empty($stored_transient) ? json_decode($stored_transient, true) : false;

	// If data is not cached
	if( empty($stored_transient) ) {
		return false;
	}

	if( $media_shortcode && !empty($stored_transient[$media_shortcode]) ) {
		$result = $stored_transient[$media_shortcode];
	} elseif ( !$media_shortcode ) {
		$result = $stored_transient;
	}

	// If result is not blank then process it
	if( !empty($result) ) {
		
		$media_data = isset($result['graphql']['shortcode_media']) ? $result['graphql']['shortcode_media'] : '';

		$result = array(
					'id' 			=> isset($media_data['id']) 					? $media_data['id'] 					: '',
					'shortcode'		=> isset($media_data['shortcode']) 				? $media_data['shortcode'] 				: '',
					'type'			=> isset($media_data['__typename'])				? $media_data['__typename'] 			: '',
					'taken_time'	=> isset($media_data['taken_at_timestamp']) 	? $media_data['taken_at_timestamp'] 	: '',
					'display_url'	=> isset($media_data['display_url']) 			? $media_data['display_url'] 			: '',
					'is_video'		=> isset($media_data['is_video']) 				? $media_data['is_video'] 				: '',
					'video_url'		=> isset($media_data['video_url']) 				? $media_data['video_url'] 				: '',
					'like_count'	=> isset($media_data['edge_media_preview_like']['count'])	? $media_data['edge_media_preview_like']['count'] : '',
					'link'			=> isset($media_data['shortcode']) 				? 'https://www.instagram.com/p/'.$media_data['shortcode'] 	: '',
					'comment_count'	=> isset($media_data['edge_media_to_comment']['count'])	? $media_data['edge_media_to_comment']['count'] 	: '',
					'caption'		=> isset($media_data['edge_media_to_caption']['edges'][0]['node']['text']) ? $media_data['edge_media_to_caption']['edges'][0]['node']['text'] : '',
					'location'		=> !empty($media_data['location']['name']) ? $media_data['location']['name'] : '',
				);
	}

	return $result;
}

/**
 * Function to gather instagram information
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0
 */
function iscw_insta_image_data( $media_data = array() ) {

	// Taking some defaults
	$media_data = isset($media_data['node']) ? $media_data['node'] : '';

	$result = array(
					'id' 			=> isset($media_data['id']) 					? $media_data['id'] 					: '',
					'shortcode'		=> isset($media_data['shortcode']) 				? $media_data['shortcode'] 				: '',
					'taken_time'	=> isset($media_data['taken_at_timestamp']) 	? $media_data['taken_at_timestamp'] 	: '',
					'display_url'	=> isset($media_data['display_url']) 			? $media_data['display_url'] 			: '',
					'thumbnail_url'	=> isset($media_data['thumbnail_src']) 			? $media_data['thumbnail_src'] 			: '',
					'is_video'		=> isset($media_data['is_video']) 				? $media_data['is_video'] 				: '',
					'type'			=> isset($media_data['__typename'])				? $media_data['__typename'] 			: '',
					'link'			=> isset($media_data['shortcode']) 				? 'https://www.instagram.com/p/'.$media_data['shortcode'] 	: '',
					'like_count'	=> isset($media_data['edge_media_preview_like']['count']) ? $media_data['edge_media_preview_like']['count'] : '',
					'comment_count'	=> isset($media_data['edge_media_to_comment']['count'])	? $media_data['edge_media_to_comment']['count'] 	: '',
					'caption'		=> isset($media_data['edge_media_to_caption']['edges'][0]['node']['text']) ? $media_data['edge_media_to_caption']['edges'][0]['node']['text'] : '',
				);
	
	// Taking all size of thumbnails
	if( !empty( $media_data['thumbnail_resources'] ) ) {
		$result['thumbnail_resources'] = wp_list_pluck( $media_data['thumbnail_resources'], 'src', 'config_width' );
	}

	return $result;
}

/**
 * Function to get user details
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0
 */
function iscw_get_user_details( $user_details = '' ) {

	// Taking some defaults
	$result	= array();

	if( $user_details ) {

		// Taking only needed data
		$result['id']				= $user_details['id'];
		$result['is_private']		= $user_details['is_private'];
		$result['username']			= $user_details['username'];
		$result['full_name'] 		= $user_details['full_name'];
		$result['profile_pic_url'] 	= $user_details['profile_pic_url'];
	}
	return $result;
}

/**
 * Function to image size according to grid
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.3
 */
function iscw_img_size( $grid = '' ) {

	switch ( $grid ) {
		case 1:
			$width = false;
			break;

		case 2:
		case 3:
			$width = 640;
			break;

		case 4:
		case 5:
		case 6:
		case 7:
		case 8:
			$width = 320;
			break;

		case 9:
		case 10:
		case 11:
		case 12:
			$width = 320;
			break;

		default:
			$width = 150;
			break;
	}
	return $width;
}

/**
 * Function resize instagram images
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.4
 */
function iscw_resize_insta_image($url, $width = false, $height = false) {

    // If height or width is not there then return URL
    if( !$width || !$height ) {
    	return $url;
    }

    if (preg_match('#/s\d+x\d+/#', $url)) {
        return preg_replace('/\/vp\//', '/', preg_replace('#/s\d+x\d+/#', '/s' . $width . 'x' . $height . '/', $url));
    } else if (preg_match('#/e\d+/#', $url)) {
        return preg_replace('/\/vp\//', '/', preg_replace('#/e(\d+)/#', '/s' . $width . 'x' . $height . '/e$1/', $url));
    } else if (preg_match('#(\.com/[^/]+)/#', $url)) {
        return preg_replace('/\/vp\//', '/', preg_replace('#(\.com/[^/]+)/#', '$1/s' . $width . 'x' . $height . '/', $url));
    }
	return null;
}
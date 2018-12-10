<?php
/**
 * traveler_blog_lite_Recommendation Class
 * 
 * Handles the recommended plugin functionality.
 * 
 * @package Traveler Blog Lite
 * @since 1.0
 */

// Plugin recomendation class
require_once( TRAVELER_BLOG_LITE_DIR . '/includes/plugins/class-tgm-plugin-activation.php' );

class traveler_blog_lite_Recommendation {

	function __construct() {
		
		// Action to add recomended plugins
		add_action( 'tgmpa_register', array($this, 'traveler_blog_lite_recommend_plugin') );
	}

	/**
	 * Recommend Plugins
	 * 
	 * @package Traveler Blog Lite
	 * @since 1.0
	 */
	function traveler_blog_lite_recommend_plugin() {	   
		
		$plugins = array(	       
	        array(
	            'name'               => __('Instagram Slider and Carousel Plus Widget', 'traveler-blog-lite'),
	            'slug'               => 'slider-and-carousel-plus-widget-for-instagram',
	            'required'           => false,
	        )
	    );
		
	    tgmpa( $plugins);
	}
}

$traveler_blog_lite_recommendation = new traveler_blog_lite_Recommendation();
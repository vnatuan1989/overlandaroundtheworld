<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Iscw_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'iscw_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'iscw_front_script') );
		
		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'iscw_admin_style') );
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'iscw_admin_script') );

	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_front_style() {

		// Registring and enqueing font awesome css
		if( !wp_style_is( 'wpos-font-awesome', 'registered' ) ) {
			wp_register_style( 'wpos-font-awesome', ISCW_URL.'assets/css/font-awesome.min.css', null, ISCW_VERSION );
			wp_enqueue_style( 'wpos-font-awesome' );
		}

		// Registring and enqueing magnific css
		if( !wp_style_is( 'wpos-magnific-style', 'registered' ) ) {
			wp_register_style( 'wpos-magnific-style', ISCW_URL.'assets/css/magnific-popup.css', array(), ISCW_VERSION );
			wp_enqueue_style( 'wpos-magnific-style');
		}

		// Registring and enqueing slick css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', ISCW_URL.'assets/css/slick.css', array(), ISCW_VERSION );
			wp_enqueue_style( 'wpos-slick-style');	
		}
		
		// Registring and enqueing public css
		wp_register_style( 'iscwp-public-css', ISCW_URL.'assets/css/iscwp-public.css', null, ISCW_VERSION );
		wp_enqueue_style( 'iscwp-public-css' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_front_script() {

		// Registring magnific popup script
		if( !wp_script_is( 'wpos-magnific-script', 'registered' ) ) {
			wp_register_script( 'wpos-magnific-script', ISCW_URL.'assets/js/jquery.magnific-popup.min.js', array('jquery'), ISCW_VERSION, true );
		}
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', ISCW_URL.'assets/js/slick.min.js', array('jquery'), ISCW_VERSION, true );
		}

		// Registring public script 
		wp_register_script( 'iscwp-public-js', ISCW_URL.'assets/js/iscwp-public.js', array('jquery'), ISCW_VERSION, true );
		wp_localize_script( 'iscwp-public-js', 'Iscw', array(
															'ajaxurl' 	=> admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
															'is_mobile' =>	(wp_is_mobile()) 	? 1 : 0,
															'is_rtl' 	=>	(is_rtl()) 			? 1 : 0,
														));
		
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_admin_style( $hook ) {

		$pages_array = array('toplevel_page_iscwp-settings');

		if( in_array($hook, $pages_array) ) {
			
			wp_register_style( 'iscwp-admin-style', ISCW_URL.'assets/css/iscwp-admin.css', array(), ISCW_VERSION );
			wp_enqueue_style( 'iscwp-admin-style');
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_admin_script( $hook ) {

		$pages_array = array('toplevel_page_iscwp-settings');

		if( in_array($hook, $pages_array) ) {
			
			wp_register_script( 'iscwp-admin-script', ISCW_URL.'assets/js/iscwp-admin.js', array('jquery'), ISCW_VERSION, true );
			wp_enqueue_script('iscwp-admin-script');
		}
	}
}

$iscwp_script = new Iscw_Script();
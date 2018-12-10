<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Iscw_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'iscw_register_menu') );

		// Admin Prior Process
		add_action ( 'admin_init', array($this, 'iscw_admin_init_process') );

		// Ajax call to update attachment data
		add_action( 'wp_ajax_iscw_clear_cache', array($this, 'iscw_clear_cache'));
		add_action( 'wp_ajax_nopriv_iscw_clear_cache',array( $this, 'iscw_clear_cache'));

		// Ajax call to update attachment data
		add_action( 'wp_ajax_iscw_clear_all_cache', array($this, 'iscw_clear_all_cache'));
		add_action( 'wp_ajax_nopriv_iscw_clear_all_cache',array( $this, 'iscw_clear_all_cache'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'iscw_plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_register_menu() {
		// Main Setting Page
		add_menu_page(__('Insta Feed - WPOS', 'slider-and-carousel-plus-widget-for-instagram'), __('Insta Feed - WPOS', 'slider-and-carousel-plus-widget-for-instagram'), 'manage_options', 'iscwp-settings', array($this, 'iscw_main_page'), 'dashicons-camera' );

		// Getting Started Page
		add_submenu_page( 'iscwp-settings', __('Getting Started', 'slider-and-carousel-plus-widget-for-instagram'), __('Getting Started', 'slider-and-carousel-plus-widget-for-instagram'), 'manage_options', 'iscw-designs', 'iscw_designs_page' );

		// Register plugin premium page
		add_submenu_page( 'iscwp-settings', __('Upgrade to PRO - Insta Feed', 'slider-and-carousel-plus-widget-for-instagram'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'slider-and-carousel-plus-widget-for-instagram').'</span>', 'manage_options', 'iscw-premium', array($this, 'iscw_premium_page') );

		// Register plugin hire us page
		add_submenu_page( 'iscwp-settings', __('Hire Us', 'slider-and-carousel-plus-widget-for-instagram'), '<span style="color:#2ECC71">'.__('Hire Us', 'slider-and-carousel-plus-widget-for-instagram').'</span>', 'manage_options', 'iscw-hireus', array($this, 'iscw_hireus_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_main_page() {
		include_once( ISCW_DIR . '/includes/admin/settings/iscwp-settings.php' );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.4
	 */
	function iscw_premium_page() {
		include_once( ISCW_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.4.3
	 */
	function iscw_hireus_page() {		
		include_once( ISCW_DIR . '/includes/admin/settings/hire-us.php' );
	}

	/**
	 * Admin Prior Process
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_admin_init_process() {

		// If plugin notice is dismissed
		if( isset($_GET['message']) && $_GET['message'] == 'iscw-plugin-notice' ) {
			set_transient( 'iscw_install_notice', true, 604800 );
		}

		// Register Settings
		register_setting( 'iscw_plugin_options', 'iscw_options');
	}

	/**
	 * delete user cache
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_clear_cache(){

		extract($_POST);

		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'slider-and-carousel-plus-widget-for-instagram');

		if(isset($user_name) && $user_name != ''){

			$transient 			= "wp_iscwp_media_{$user_name}";
			$dlt_transient 		= delete_transient( $transient );
			$media_transient 	= delete_transient("wp_iscwp_media_data_{$user_name}");

			if( $dlt_transient ) {

				$users 				= get_option('wp_iscwp_cache_transient');
				$srch_user 			= array_search($transient,$users);
				unset($users[$srch_user]);

				update_option( 'wp_iscwp_cache_transient', $users );
				
				$result['success'] 	= 1;
				$result['msg'] 		= __('Cache Cleared', 'slider-and-carousel-plus-widget-for-instagram');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Fulsh all user cache
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_clear_all_cache(){

		extract($_POST);

		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'slider-and-carousel-plus-widget-for-instagram');

		$users = get_option('wp_iscwp_cache_transient');

		if($users) {

			foreach ($users as $transt_key => $transient) {				

				delete_transient( $transient );
				delete_transient("wp_iscwp_media_data_{$transt_key}");
				
				$srch_user = array_search($transient, $users);
				unset($users[$srch_user]);
				
				update_option( 'wp_iscwp_cache_transient', $users );
			}
			
			$result['success'] 	= 1;
			$result['msg'] 		= __('Cache Cleared', 'slider-and-carousel-plus-widget-for-instagram');
		} else {
			$result['msg'] 		= __('Sorry, no data found', 'slider-and-carousel-plus-widget-for-instagram');
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to unique number value
	 * 
	 * @package Slider and Carousel Plus Widget Instagram
	 * @since 1.0.0
	 */
	function iscw_plugin_row_meta( $links, $file ) {
		
		if ( $file == ISCW_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('http://docs.wponlinesupport.com/slider-and-carousel-plus-widget-for-instagram/') . '" title="' . esc_attr( __( 'View Documentation', 'slider-and-carousel-plus-widget-for-instagram' ) ) . '" target="_blank">' . __( 'Docs', 'slider-and-carousel-plus-widget-for-instagram' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/wordpress-support/') . '" title="' . esc_attr( __( 'Premium Support - For any Customization', 'slider-and-carousel-plus-widget-for-instagram' ) ) . '" target="_blank">' . __( 'Premium Support', 'slider-and-carousel-plus-widget-for-instagram' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$iscw_admin = new Iscw_Admin();
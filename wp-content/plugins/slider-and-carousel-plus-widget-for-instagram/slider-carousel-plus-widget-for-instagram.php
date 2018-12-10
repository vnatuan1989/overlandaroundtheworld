<?php
/**
 * Plugin Name: Instagram Slider and Carousel Plus Widget
 * Plugin URI: https://www.wponlinesupport.com
 * Text Domain: instagram-slider-carousel-plus-widget
 * Domain Path: /languages/
 * Description: Easy to display your instagram photo in Grid, slider, carousel and widget.
 * Author: WP Online Support
 * Version: 1.4.5
 * Author URI: https://www.wponlinesupport.com
 *
 * @package WordPress
 * @author WP Online Support
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Basic plugin definitions
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
if( !defined( 'ISCW_VERSION' ) ) {
	define( 'ISCW_VERSION', '1.4.5' ); // Version of plugin
}
if( !defined( 'ISCW_DIR' ) ) {
	define( 'ISCW_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'ISCW_URL' ) ) {
	define( 'ISCW_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'ISCW_PLUGIN_BASENAME' ) ) {
	define( 'ISCW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$iscw_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$iscw_lang_dir = apply_filters( 'iscw_languages_directory', $iscw_lang_dir );
	
	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'slider-and-carousel-plus-widget-for-instagram' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'slider-and-carousel-plus-widget-for-instagram', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( ISCW_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'slider-and-carousel-plus-widget-for-instagram', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'slider-and-carousel-plus-widget-for-instagram', false, $iscw_lang_dir );
	}
}
add_action('plugins_loaded', 'iscw_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'iscw_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'iscw_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_install() {

	// Deactivate free version
	if( is_plugin_active('instagram-slider-and-carousel-plus-widget-pro/instagram-slider-carousel-plus-widget-pro.php') ) {
		add_action('update_option_active_plugins', 'iscw_deactivate_premium_version');
	}
}

/**
 * Deactivate free plugin
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_deactivate_premium_version() {
	deactivate_plugins('instagram-slider-and-carousel-plus-widget-pro/instagram-slider-carousel-plus-widget-pro.php', true);
}

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_uninstall() {
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_admin_notice() {

	global $pagenow;    

	// If PRO plugin is active and free plugin exist
	$dir                = WP_PLUGIN_DIR . '/instagram-slider-and-carousel-plus-widget-pro/instagram-slider-carousel-plus-widget-pro.php';
	$notice_link        = add_query_arg( array('message' => 'iscw-plugin-notice'), admin_url('plugins.php') );
	$notice_transient   = get_transient( 'iscw_install_notice' );

	if ( $notice_transient == false &&  $pagenow == 'plugins.php' && file_exists($dir) && current_user_can( 'install_plugins' ) ) {
		echo '<div class="updated notice" style="position:relative;">
				<p>
					<strong>'.sprintf( __('Thank you for activating %s', 'slider-and-carousel-plus-widget-for-instagram'), 'Instagram Slider and Carousel Plus Widget').'</strong>.<br/>
					'.sprintf( __('It looks like you had PRO version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'slider-and-carousel-plus-widget-for-instagram'), '<strong>(<em>Instagram Slider and Carousel Plus Widget PRO</em>)</strong>' ).'
				</p>
				<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
			</div>';      
	}
}

add_action( 'admin_notices', 'iscw_admin_notice');

// Functions file
require_once( ISCW_DIR . '/includes/iscwp-functions.php' );

// Script Class File
require_once( ISCW_DIR . '/includes/class-iscwp-script.php' );

// Admin Class
require_once( ISCW_DIR . '/includes/admin/class-iscwp-admin.php' );

// Public class
require_once( ISCW_DIR . '/includes/class-iscwp-public.php' );

// Shortcode File
require_once( ISCW_DIR . '/includes/shortcode/iscwp-slider.php' );
require_once( ISCW_DIR . '/includes/shortcode/iscwp-grid.php' );

// Widget Files
require_once( ISCW_DIR . '/includes/widgets/class-instagram-grid-widget.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( ISCW_DIR . '/includes/admin/iscwp-how-it-work.php' );
}

/* Plugin Wpos Analytics Data Starts */
function wpos_analytics_anl42_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'            => 42,
							'file'          => plugin_basename( __FILE__ ),
							'name'          => 'Instagram Slider and Carousel Plus Widget',
							'slug'          => 'instagram-slider-and-carousel-plus-widget',
							'type'          => 'plugin',
							'menu'          => 'iscwp-settings',
							'text_domain'   => 'instagram-slider-carousel-plus-widget',
							'promotion'		=> array(
													'bundle' => array(
														'name'	=> 'Download FREE 50 Plugins, 10+ Themes and Dashboard Plugin',
														'desc'	=> 'Download FREE 50 Plugins, 10+ Themes and Dashboard Plugin',
														'file'	=> 'https://www.wponlinesupport.com/latest/wpos-free-50-plugins-plus-12-themes.zip'
													)
												),
							'offers'		=> array(
													'trial_premium' => array(
															1 => array(
																	'image' => 'http://analytics.wponlinesupport.com/?anylc_img=42',
																),
													),
												),
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl42_load();
/* Plugin Wpos Analytics Data Ends */
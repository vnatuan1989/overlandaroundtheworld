<?php // phpcs:ignore

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Bootstrap_Weglot;

/**
 * Only use for get one context
 *
 * @since 2.0
 */
abstract class Context_Weglot {

	/**
	 * @static
	 * @since 2.0
	 * @var Bootstrap_Weglot|null
	 */
	protected static $context;

	/**
	 * Create context if not exist
	 *
	 * @static
	 * @since 2.0
	 * @return void
	 */
	public static function weglot_get_context() {
		if ( null !== self::$context ) {
			return self::$context;
		}

		self::$context = new Bootstrap_Weglot();

		$services = [
			'\WeglotWP\Services\Button_Service_Weglot',
			'\WeglotWP\Services\Request_Url_Service_Weglot',
			'\WeglotWP\Services\Option_Service_Weglot',
			'\WeglotWP\Services\Redirect_Service_Weglot',
			'\WeglotWP\Services\Language_Service_Weglot',
			'\WeglotWP\Services\Replace_Url_Service_Weglot',
			'\WeglotWP\Services\Multisite_Service_Weglot',
			'\WeglotWP\Services\Replace_Link_Service_Weglot',
			'\WeglotWP\Services\Migration_Service_Weglot',
			'\WeglotWP\Services\Dom_Listeners_Service_Weglot',
			'\WeglotWP\Services\Parser_Service_Weglot',
			'\WeglotWP\Third\Woocommerce\WC_Translate_Weglot',
			'\WeglotWP\Third\Woocommerce\WC_Active_Weglot',
			'\WeglotWP\Third\Amp\Amp_Service_Weglot',
			'\WeglotWP\Services\User_Api_Service_Weglot',
			'\WeglotWP\Services\Other_Translate_Service_Weglot',
			'\WeglotWP\Services\Dom_Checkers_Service_Weglot',
			'\WeglotWP\Services\Custom_Url_Service_Weglot',
			'\WeglotWP\Services\Generate_Switcher_Service_Weglot',
			'\WeglotWP\Services\Email_Translate_Service_Weglot',
			'\WeglotWP\Services\Translate_Service_Weglot',
			'\WeglotWP\Services\Private_Language_Service_Weglot',
			'\WeglotWP\Services\Href_Lang_Service_Weglot',
		];

		self::$context->set_services( $services );

		$actions = [
			'\WeglotWP\Actions\Email_Translate_Weglot',
			'\WeglotWP\Actions\Register_Widget_Weglot',
			'\WeglotWP\Actions\Admin\Pages_Weglot',
			'\WeglotWP\Actions\Admin\Plugin_Links_Weglot',
			'\WeglotWP\Actions\Admin\Options_Weglot',
			'\WeglotWP\Actions\Admin\Admin_Enqueue_Weglot',
			'\WeglotWP\Actions\Admin\Customize_Menu_Weglot',
			'\WeglotWP\Actions\Admin\Permalink_Weglot',
			'\WeglotWP\Actions\Front\Translate_Page_Weglot',
			'\WeglotWP\Actions\Front\Front_Enqueue_Weglot',
			'\WeglotWP\Actions\Front\Shortcode_Weglot',
			'\WeglotWP\Actions\Front\Redirect_Log_User_Weglot',
			'\WeglotWP\Actions\Migration_Weglot',
			'\WeglotWP\Third\Woocommerce\WC_Filter_Urls_Weglot',
			'\WeglotWP\Third\Amp\Amp_Enqueue_Weglot',
			'\WeglotWP\Actions\Admin\Metabox_Url_Translate_Weglot',
		];

		self::$context->set_actions( $actions );

		return self::$context;
	}
}


/**
 * Init plugin
 * @since 2.0
 * @version 2.0.1
 * @return void
 */
function weglot_init() {
	if ( function_exists( 'apache_get_modules' ) && ! in_array( 'mod_rewrite', apache_get_modules() ) ) { //phpcs:ignore
		add_action( 'admin_notices', [ '\WeglotWP\Notices\Rewrite_Module_Weglot', 'admin_notice' ] );
	}

	if ( ! function_exists( 'curl_version' ) ) {
		add_action( 'admin_notices', [ '\WeglotWP\Notices\Curl_Weglot', 'admin_notice' ] );
	}

	if ( ! function_exists( 'json_last_error' ) ) {
		add_action( 'admin_notices', [ '\WeglotWP\Notices\Json_Function_Weglot', 'admin_notice' ] );
	}

	load_plugin_textdomain( 'weglot', false, WEGLOT_DIR_LANGUAGES );

	Context_Weglot::weglot_get_context()->init_plugin();
}

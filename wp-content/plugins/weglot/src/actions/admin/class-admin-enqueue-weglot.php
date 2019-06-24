<?php

namespace WeglotWP\Actions\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Models\Hooks_Interface_Weglot;
use WeglotWP\Helpers\Helper_Pages_Weglot;
use WeglotWP\Helpers\Helper_Tabs_Admin_Weglot;

/**
 * Enqueue CSS / JS on administration
 *
 * @since 2.0
 *
 */
class Admin_Enqueue_Weglot implements Hooks_Interface_Weglot {

	/**
	 * @since 2.0
	 */
	public function __construct() {
		$this->language_services   = weglot_get_service( 'Language_Service_Weglot' );
		$this->option_services     = weglot_get_service( 'Option_Service_Weglot' );
		$this->user_api_services   = weglot_get_service( 'User_Api_Service_Weglot' );
	}

	/**
	 * @see Hooks_Interface_Weglot
	 *
	 * @since 2.0
	 * @return void
	 */
	public function hooks() {
		add_action( 'admin_enqueue_scripts', [ $this, 'weglot_admin_enqueue_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'weglot_admin_enqueue_scripts_metaboxes' ] );
	}

	/**
	 * @since 2.1.0
	 *
	 * @return void
	 * @param mixed $page
	 */
	public function weglot_admin_enqueue_scripts_metaboxes( $page ) {
		if ( ! in_array( $page, [ 'post.php' ] ) ) { //phpcs:ignore
			return;
		}

		wp_enqueue_script( 'weglot-admin-metaboxes-js', WEGLOT_URL_DIST . '/metaboxes-js.js', [ 'jquery' ] );
		wp_enqueue_style( 'weglot-admin-css', WEGLOT_URL_DIST . '/css/admin-css.css', [], WEGLOT_VERSION );
	}


	/**
	 * Register CSS and JS
	 *
	 * @see admin_enqueue_scripts
	 * @since 2.0
	 * @param string $page
	 * @return void
	 */
	public function weglot_admin_enqueue_scripts( $page ) {
		if ( ! in_array( $page, [ 'toplevel_page_' . Helper_Pages_Weglot::SETTINGS ], true ) ) {
			return;
		}

		wp_enqueue_script( 'weglot-admin-selectize-js', WEGLOT_URL_DIST . '/selectize.js', [ 'jquery', 'jquery-ui-sortable' ] );

		wp_enqueue_script( 'weglot-admin', WEGLOT_URL_DIST . '/admin-js.js', [ 'weglot-admin-selectize-js' ], [], WEGLOT_VERSION );

		$user_info        = $this->user_api_services->get_user_info();
		$plans            = $this->user_api_services->get_plans();
		$limit            = 1000;
		if (
			isset( $user_info['plan'] ) &&
			$user_info['plan'] <= 0 ||
			isset( $user_info['plan'] ) &&
			in_array( $user_info['plan'], $plans['starter_free']['ids'] ) // phpcs:ignore
		) {
			$limit = $plans['starter_free']['limit_language'];
		} elseif (
			isset( $user_info['plan'] ) &&
			in_array( $user_info['plan'], $plans['business']['ids'] ) // phpcs:ignore
		) {
			$limit = $plans['business']['limit_language'];
		}

		wp_localize_script( 'weglot-admin', 'weglot_languages', [
			'available' => $this->language_services->get_languages_available( [
				'sort' => true,
			] ),
			'limit'     => $limit,
			'plans'     => $this->user_api_services->get_plans(),
			'original'  => weglot_get_original_language(),
		]);

		wp_enqueue_style( 'weglot-admin-css', WEGLOT_URL_DIST . '/css/admin-css.css', [], WEGLOT_VERSION );

		wp_enqueue_style( 'weglot-css', WEGLOT_URL_DIST . '/css/front-css.css', [], WEGLOT_VERSION );
		wp_localize_script( 'weglot-admin', 'weglot_css', [
			'inline'   => $this->option_services->get_css_custom_inline(),
			'flag_css' => $this->option_services->get_option( 'flag_css' ),
		]);
	}
}

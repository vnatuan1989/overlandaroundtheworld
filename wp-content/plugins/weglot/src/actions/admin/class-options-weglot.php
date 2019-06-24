<?php

namespace WeglotWP\Actions\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Helpers\Helper_Tabs_Admin_Weglot;

use WeglotWP\Models\Hooks_Interface_Weglot;

/**
 * Sanitize options after submit form
 *
 * @since 2.0
 */
class Options_Weglot implements Hooks_Interface_Weglot {

	/**
	 * @since 2.0
	 */
	public function __construct() {
		$this->option_services   = weglot_get_service( 'Option_Service_Weglot' );
		$this->user_api_services = weglot_get_service( 'User_Api_Service_Weglot' );
	}

	/**
	 * @see Hooks_Interface_Weglot
	 *
	 * @since 2.0
	 * @return void
	 */
	public function hooks() {
		add_action( 'admin_init', [ $this, 'weglot_options_init' ] );
		$api_key = $this->option_services->get_option( 'api_key' );
		if ( empty( $api_key ) && ( ! isset( $_GET['page'] ) || strpos( $_GET['page'], 'weglot-settings' ) === false) ) { // phpcs:ignore
			//We don't show the notice if we are on Weglot configuration
			add_action( 'admin_notices', [ '\WeglotWP\Notices\No_Configuration_Weglot', 'admin_notice' ] );
		}
	}

	/**
	 * Activate plugin
	 *
	 * @return void
	 */
	public function activate() {
		update_option( 'weglot_version', WEGLOT_VERSION );
		$options            = $this->option_services->get_options();

		$this->option_services->set_options( $options );
	}

	/**
	 * Register setting options
	 *
	 * @see admin_init
	 * @since 2.0
	 *
	 * @return void
	 */
	public function weglot_options_init() {
		register_setting( WEGLOT_OPTION_GROUP, WEGLOT_SLUG, [ $this, 'sanitize_options' ] );
	}

	/**
	 * Callback register_setting for sanitize options
	 *
	 * @since 2.0
	 *
	 * @param array $options
	 * @return array
	 */
	public function sanitize_options( $options ) {
		$tab         = ( isset( $_POST['tab'] ) ) ? $_POST['tab'] : null; //phpcs:ignore
		$options_bdd = $this->option_services->get_options();

		$new_options = wp_parse_args( $options, $options_bdd );

		switch ( $tab ) {
			case Helper_Tabs_Admin_Weglot::SETTINGS:
				$new_options = $this->sanitize_options_settings( $new_options, $options );

				if ( $options_bdd['has_first_settings'] ) {
					$new_options['has_first_settings']      = false;
					$new_options['show_box_first_settings'] = true;
				} else {
					$new_options = $this->sanitize_options_appearance( $new_options, $options );
					$new_options = $this->sanitize_options_advanced( $new_options, $options );
				}
				break;
			case Helper_Tabs_Admin_Weglot::CUSTOM_URLS:
				if (null === $options) {
					$new_options['custom_urls'] = [];
				}
				break;
		}

		return $new_options;
	}

	/**
	 * @since 2.0
	 * @version 2.0.6
	 * @param array $new_options
	 * @param array $options
	 * @return array
	 */
	public function sanitize_options_settings( $new_options, $options ) {
		$user_info        = $this->user_api_services->get_user_info( $new_options['api_key'] );
		$plans            = $this->user_api_services->get_plans();
		$options_bdd      = $this->option_services->get_options();

		$old_destination_languages = array_diff( $options_bdd['destination_language'], $new_options['destination_language'] );

		if ( ! empty( $old_destination_languages ) ) {
			foreach ( $old_destination_languages as $destination_language ) {
				$nav_menu = get_page_by_title( sprintf( '[weglot_menu_title-%s]', $destination_language ), 'OBJECT', 'nav_menu_item' ); //phpcs:ignore
				if ( ! $nav_menu ) {
					continue;
				}
				wp_delete_post( $nav_menu->ID, true );
			}
		}

		// Limit language
		if (
			$user_info['plan'] <= 0 ||
			in_array( $user_info['plan'], $plans['starter_free']['ids'] ) // phpcs:ignore
		) {
			$new_options['destination_language'] = array_splice( $options['destination_language'], 0, $plans['starter_free']['limit_language'] );
		} elseif (
			in_array( $user_info['plan'], $plans['business']['ids'] ) // phpcs:ignore
		) {
			$new_options['destination_language'] = array_splice( $options['destination_language'], 0, $plans['business']['limit_language'] );
		}

		if ( isset( $options['exclude_urls'] ) ) {
			$new_options['exclude_urls'] = array_filter( $options['exclude_urls'], function( $value ) {
				return '' !== $value;
			} );
		} else {
			$new_options['exclude_urls'] = [];
		}

		if ( isset( $options['exclude_blocks'] ) ) {
			$new_options['exclude_blocks'] = array_filter( $options['exclude_blocks'], function( $value ) {
				return '' !== $value;
			} );
		} else {
			$new_options['exclude_blocks'] = [];
		}

		return $new_options;
	}

	/**
	 * @since 2.0
	 * @param array $new_options
	 * @param array $options
	 * @return array
	 */
	public function sanitize_options_advanced( $new_options, $options ) {
		$new_options['auto_redirect']               = isset( $options['auto_redirect'] ) ? 1 : 0;
		$new_options['email_translate']             = isset( $options['email_translate'] ) ? 1 : 0;
		$new_options['translate_amp']               = isset( $options['translate_amp'] ) ? 1 : 0;
		$new_options['private_mode']['active']      = isset( $options['private_mode']['active'] ) ? 1 : 0;

		$languages = weglot_get_languages_configured();

		foreach ( $languages as $key => $lang) {
			$new_options['private_mode'][ $lang->getIso639() ] = isset( $options['private_mode'][  $lang->getIso639() ] ) ? 1 : 0;
		}

		return $new_options;
	}

	/**
	 * @since 2.0
	 * @param array $new_options
	 * @param array $options
	 * @return array
	 */
	public function sanitize_options_appearance( $new_options, $options ) {
		$new_options['is_menu']      = isset( $options['is_menu'] ) ? 1 : 0;
		$new_options['is_fullname']  = isset( $options['is_fullname'] ) ? 1 : 0;
		$new_options['with_name']    = isset( $options['with_name'] ) ? 1 : 0;
		$new_options['is_dropdown']  = isset( $options['is_dropdown'] ) ? 1 : 0;
		$new_options['with_flags']   = isset( $options['with_flags'] ) ? 1 : 0;

		$new_options['type_flags']      = isset( $options['type_flags'] ) ? $options['type_flags'] : '0';
		$new_options['override_css']    = isset( $options['override_css'] ) ? $options['override_css'] : '';
		$new_options['flag_css']        = isset( $options['flag_css'] ) ? $options['flag_css'] : '';

		return $new_options;
	}
}

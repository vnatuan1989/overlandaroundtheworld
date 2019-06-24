<?php

namespace WeglotWP\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Migration service
 *
 * @since 2.0
 */
class Migration_Service_Weglot {

	/**
	 * @since 2.0
	 */
	public function __construct() {
		$this->option_services           = weglot_get_service( 'Option_Service_Weglot' );
	}

	/**
	 * Update V1 to V2 plugin
	 * @since 2.0
	 * @return void
	 */
	public function update_v200() {
		$api_key               = get_option( 'project_key' );
		$original_language     = get_option( 'original_l' );
		$destination_language  = get_option( 'destination_l' );
		$auto_switch           = get_option( 'wg_auto_switch' );
		$wg_exclude_amp        = get_option( 'wg_exclude_amp' );
		$override_css          = get_option( 'override_css' );
		$flag_css              = get_option( 'flag_css' );
		$with_flags            = get_option( 'with_flags' );
		$type_flags            = get_option( 'type_flags' );
		$with_name             = get_option( 'with_name' );
		$is_dropdown           = get_option( 'is_dropdown' );
		$is_fullname           = get_option( 'is_fullname' );
		$is_menu               = get_option( 'is_menu' );
		$exclude_url           = get_option( 'exclude_url' );
		$exclude_blocks        = get_option( 'exclude_blocks' );
		$rtl_ltr_style         = get_option( 'rtl_ltr_style' );
		$allowed               = get_option( 'wg_allowed' );

		$destination_language    = explode( ',', $destination_language );
		$exclude_blocks          = empty( $exclude_blocks ) ? [] : explode( ',', $exclude_blocks );
		$exclude_url             = empty( $exclude_url ) ? [] : explode( ',', $exclude_url );

		$new_options = [
			'api_key'                    => $api_key,
			'original_language'          => $original_language,
			'destination_language'       => empty( $destination_language ) ? [] : $destination_language,
			'translate_amp'              => ( 'on' === $wg_exclude_amp ) ? false : true,
			'exclude_blocks'             => empty( $exclude_blocks ) ? [] : $exclude_blocks,
			'exclude_urls'               => $exclude_url,
			'auto_redirect'              => ( 'on' === $auto_switch ) ? true : false,
			'email_translate'            => false,
			'flag_css'                   => $flag_css,
			'is_fullname'                => ( 'on' === $is_fullname ) ? true : false,
			'with_name'                  => ( 'on' === $with_name ) ? true : false,
			'is_dropdown'                => ( 'on' === $is_dropdown ) ? true : false,
			'type_flags'                 => $type_flags,
			'with_flags'                 => ( 'on' === $with_flags ) ? true : false,
			'override_css'               => $override_css,
			'has_first_settings'         => false,
			'show_box_first_settings'    => false,
			'allowed'                    => $allowed,
			'rtl_ltr_style'              => $rtl_ltr_style,
			'is_menu'                    => ( 'on' === $is_menu ) ? true : false,
		];

		$this->option_services->set_options( $new_options );
		update_option( 'weglot_version', WEGLOT_VERSION );
	}

	/**
	 * Update 2.2.0 > 2.3.0
	 * @since 2.3.0
	 * @return void
	 */
	public function update_v230() {
		$private_mode = weglot_get_option( 'private_mode' );

		if ( $private_mode ) {
			$destination_language                  = weglot_get_destination_language();
			$new_options                           = weglot_get_options();
			$new_options['private_mode']           = [];
			$new_options['private_mode']['active'] = true;

			foreach ( $destination_language as $key => $lang ) {
				$new_options['private_mode'][ $lang ] = true;
			}

			$this->option_services->set_options( $new_options );
			update_option( 'weglot_version', WEGLOT_VERSION );
		}
	}
}


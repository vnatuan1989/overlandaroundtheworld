<?php

namespace WeglotWP\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Weglot\Util\Url;
use Weglot\Util\Server;


/**
 * Private_Language_Service_Weglot
 *
 * @since 2.3.0
 */
class Private_Language_Service_Weglot {
	protected $role_private_mode = 'administrator';

	/**
	 * @since 2.3.0
	 */
	public function __construct() {
		$this->option_services           = weglot_get_service( 'Option_Service_Weglot' );
	}

	/**
	 * @since 2.3.0
	 *
	 * @param string $key_lang
	 * @return boolean
	 */
	public function is_active_private_mode_for_lang( $key_lang ) {
		$private_mode_languages    = $this->option_services->get_option( 'private_mode' );
		if ( ! $private_mode_languages['active'] ) {
			return false;
		}

		unset( $private_mode_languages['active'] );
		foreach ( $private_mode_languages as $lang => $lang_active ) {
			if ( $key_lang === $lang && $lang_active && ! current_user_can( $this->role_private_mode ) ) {
				return true;
			}
		}

		return false;
	}
}



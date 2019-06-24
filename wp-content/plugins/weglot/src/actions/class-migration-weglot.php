<?php

namespace WeglotWP\Actions;

defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

use WeglotWP\Models\Hooks_Interface_Weglot;

/**
 * Migration Weglot
 *
 * @since 2.0
 */
class Migration_Weglot implements Hooks_Interface_Weglot {


	/**
	 * @since 2.0
	 */
	public function __construct() {
		$this->migration_services   = weglot_get_service( 'Migration_Service_Weglot' );
	}


	/**
	 * @see HooksInterface
	 * @return void
	 */
	public function hooks() {
		if ( ! defined( 'WEGLOT_LATEST_VERSION' ) && ! defined( 'WEGLOT_VERSION' ) ) {
			return;
		}

		$weglot_version = get_option( 'weglot_version' );
		if ( ! $weglot_version && version_compare( WEGLOT_LATEST_VERSION, '2.0', '<' ) ) {
			$this->migration_services->update_v200();
		}

		if ( $weglot_version && version_compare( $weglot_version, '2.2.0', '>=' ) && version_compare( $weglot_version, '2.3.0', '<' ) ) {
			$this->migration_services->update_v230();
		}
	}
}

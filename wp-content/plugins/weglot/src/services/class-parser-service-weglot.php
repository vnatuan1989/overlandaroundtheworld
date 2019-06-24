<?php

namespace WeglotWP\Services;

use WeglotWP\Models\Hooks_Interface_Weglot;


use Weglot\Client\Client;
use Weglot\Parser\Parser;
use Weglot\Util\Url;
use Weglot\Util\Server;
use Weglot\Parser\ConfigProvider\ServerConfigProvider;
use Weglot\Parser\ConfigProvider\ConfigProviderInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Parser abstraction
 *
 * @since 2.0
 */
class Parser_Service_Weglot {

	/**
	 * @since 2.0
	 */
	public function __construct() {
		$this->option_services               = weglot_get_service( 'Option_Service_Weglot' );

		if ( '2' === WEGLOT_LIB_PARSER ) {
			$this->dom_listeners_services        = weglot_get_service( 'Dom_Listeners_Service_Weglot' );
		} else {
			$this->dom_checkers_services        = weglot_get_service( 'Dom_Checkers_Service_Weglot' );
		}

		$this->request_url_services          = weglot_get_service( 'Request_Url_Service_Weglot' );
	}

	/**
	 * @since 2.0
	 * @version 2.2.2
	 * @return array
	 */
	public function get_parser() {
		$exclude_blocks = $this->option_services->get_exclude_blocks();
		if ( ! empty( $exclude_blocks ) ) {
			$exclude_blocks = array_map( function( $item ) {
				return $this->request_url_services->url_to_relative( $item );
			}, $exclude_blocks);
		}

		$api_key        = $this->option_services->get_option( 'api_key' );
		$config         = apply_filters( 'weglot_parser_config_provider', new ServerConfigProvider() );
		if ( ! ( $config instanceof ConfigProviderInterface ) ) {
			$config = new ServerConfigProvider();
		}
		$client         = new Client( $api_key );

		if ( '2' === WEGLOT_LIB_PARSER ) {
			$listeners = $this->dom_listeners_services->get_dom_listeners();
			$parser    = new Parser( $client, $config, $exclude_blocks, $listeners );
		} else {
			$parser    = new Parser( $client, $config, $exclude_blocks );
			$parser->getDomCheckerProvider()->addCheckers( $this->dom_checkers_services->get_dom_checkers() );
			$ignored_nodes = apply_filters( 'weglot_get_parser_ignored_nodes', $parser->getIgnoredNodesFormatter()->getIgnoredNodes() );

			$parser->getIgnoredNodesFormatter()->setIgnoredNodes( $ignored_nodes );
		}

		return $parser;
	}
}

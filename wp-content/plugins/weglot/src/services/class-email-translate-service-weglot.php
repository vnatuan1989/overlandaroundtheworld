<?php

namespace WeglotWP\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


use Weglot\Client\Client;
use Weglot\Parser\Parser;
use Weglot\Parser\ConfigProvider\ServerConfigProvider;

/**
 * @since 2.3.0
 */
class Email_Translate_Service_Weglot {

	/**
	 * @since 2.3.0
	 */
	public function __construct() {
		$this->option_services           = weglot_get_service( 'Option_Service_Weglot' );
	}


	/**
	 * Translate email with parser
	 * @version 2.3.0
	 * @param array $args
	 * @param string $language
	 * @return array
	 */
	public function translate_email( $args, $language ) {
		$api_key            = $this->option_services->get_option( 'api_key' );

		if ( ! $api_key ) {
			return $args;
		}

		try {
			$original_language  = weglot_get_original_language();
			$exclude_blocks     = $this->option_services->get_exclude_blocks();

			$config             = new ServerConfigProvider();
			$client             = new Client( $api_key );
			$parser             = new Parser( $client, $config, $exclude_blocks );
			$translated_subject = $parser->translate( '<p>' . $args['subject'] . '</p>', $original_language, $language ); //phpcs:ignore

			$config             = new ServerConfigProvider();
			$client             = new Client( $api_key );
			$parser             = new Parser( $client, $config, $exclude_blocks );
			$translated_message = $parser->translate( $args['message'], $original_language, $language ); //phpcs:ignore

			return [
				'subject' => $translated_subject,
				'message' => $translated_message,
			];
		} catch ( \Exception $e ) {
			return $args;
		}
	}
}




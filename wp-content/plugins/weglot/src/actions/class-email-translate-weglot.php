<?php

namespace WeglotWP\Actions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Models\Hooks_Interface_Weglot;



/**
 * Translate Emails who use wp_mail
 *
 * @since 2.0
 *
 */
class Email_Translate_Weglot implements Hooks_Interface_Weglot {

	/**
	 * @since 2.0
	 */
	public function __construct() {
		$this->option_services               = weglot_get_service( 'Option_Service_Weglot' );
		$this->request_url_services          = weglot_get_service( 'Request_Url_Service_Weglot' );
		$this->email_translate_services      = weglot_get_service( 'Email_Translate_Service_Weglot' );
	}

	/**
	 * @see Hooks_Interface_Weglot
	 *
	 * @since 2.0
	 * @return void
	 */
	public function hooks() {
		add_filter( 'wp_mail', [ $this, 'weglot_translate_emails' ], 10, 1 );
	}

	/**
	 * Translate emails
	 *
	 * @since 2.0
	 * @param array $args
	 * @return array
	 */
	public function weglot_translate_emails( $args ) {
		$translate_email = $this->option_services->get_option( 'email_translate' );
		if ( ! $translate_email ) {
			return $args;
		}

		$current_and_original_language   = weglot_get_current_and_original_language();

		$message_and_subject = [
			'subject' => $args['subject'],
			'message' => $args['message'],
		];

		$message_and_subject_translated = false;

		if ( $current_and_original_language['current'] !== $current_and_original_language['original'] ) {
			$message_and_subject_translated = $this->email_translate_services->translate_email( $message_and_subject, $current_and_original_language['current'] );
		} elseif ( isset( $_SERVER['HTTP_REFERER'] ) ) { //phpcs:ignore
			$url                     = $this->request_url_services
											->create_url_object( $_SERVER['HTTP_REFERER'] ); //phpcs:ignore

			$choose_current_language = $url->detectCurrentLanguage();
			if ( $choose_current_language !== $current_and_original_language['original'] ) { //If language in referer
				$message_and_subject_translated = $this->email_translate_services->translate_email( $message_and_subject, $choose_current_language );
			} elseif ( strpos( $_SERVER['HTTP_REFERER'], 'wg_language=' ) !== false ) { //phpcs:ignore
				//If language in parameter

				$pos                         = strpos( $_SERVER['HTTP_REFERER'], 'wg_language=' ); //phpcs:ignore
				$start                       = $pos + strlen( 'wg_language=' );
				$choose_current_language     = substr( $_SERVER['HTTP_REFERER'], $start, 2 ); //phpcs:ignore
				if ( $choose_current_language && $choose_current_language !== $current_and_original_language['original'] ) {
					$message_and_subject_translated = $this->email_translate_services->translate_email( $message_and_subject, $choose_current_language );
				}
			}
		}

		if ( $message_and_subject_translated && strpos( $message_and_subject_translated['subject'], '</p>' ) !== false ) {
			$pos             = strpos( $message_and_subject_translated['subject'], '</p>' ) + 4;
			$args['subject'] = substr( $message_and_subject_translated['subject'], 3, $pos - 7 );
			$args['message'] = $message_and_subject_translated['message'];
		}

		return $args;
	}
}

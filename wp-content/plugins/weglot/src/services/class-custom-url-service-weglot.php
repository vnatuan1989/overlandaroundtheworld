<?php

namespace WeglotWP\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom URL services
 *
 * @since 2.3.0
 */
class Custom_Url_Service_Weglot {

	/**
	 * @since 2.3.0
	 */
	public function __construct() {
		$this->option_services           = weglot_get_service( 'Option_Service_Weglot' );
		$this->request_url_services      = weglot_get_service( 'Request_Url_Service_Weglot' );
	}

	/**
	 * @since 2.3.0
	 * @param string $key_code
	 * @return string
	 */
	public function get_link( $key_code ) {
		global $post;
		$weglot_url                = $this->request_url_services->get_weglot_url();
		$request_without_language  = array_filter( explode( '/', $weglot_url->getPath() ), 'strlen' );
		$index_entries             = count( $request_without_language );
		$custom_urls               = $this->option_services->get_option( 'custom_urls' );
		$url_lang                  = $weglot_url->getForLanguage( $key_code );
		$original_language         = weglot_get_original_language();

		$condition_test_custom_url = isset( $request_without_language[ $index_entries ] ) && ! is_admin() && ! empty( $custom_urls ) && ! is_post_type_archive() && ! is_category() && ! is_tax() && ! is_archive();

		if ( apply_filters( 'weglot_condition_test_custom_url', $condition_test_custom_url ) ) {
			$slug_in_work             = $request_without_language[ $index_entries ];

			// Search from original slug
			$key_slug = false;
			if ( isset( $custom_urls[ $key_code ] ) && $post ) {
				$key_slug = array_search( $post->post_name, $custom_urls[ $key_code ] ); //phpcs:ignore
			}
			if ( false !== $key_slug ) {
				$url_lang = str_replace( $slug_in_work, $key_slug, $url_lang );
			} else {
				if ( $post ) {
					$url_lang = str_replace( $slug_in_work, $post->post_name, $url_lang );
				}
			}
		}

		$link_button = apply_filters( 'weglot_link_language', $url_lang, $key_code );

		$link_button = preg_replace( '#\?no_lredirect=true$#', '', $link_button ); // Remove ending "?no_lredirect=true"

		return apply_filters( 'weglot_get_link_with_key_code', $link_button );
	}


	/**
	 * @since 2.3.0
	 * @return string
	 * @param mixed $key_code
	 */
	public function get_link_button_with_key_code( $key_code ) {
		$link_button = $this->get_link( $key_code );

		if ( weglot_has_auto_redirect() && strpos( $link_button, 'no_lredirect' ) === false && ( is_home() || is_front_page() ) && $key_code === $original_language ) {
			$link_button .= '?no_lredirect=true';
		}

		return apply_filters( 'weglot_get_link_button_with_key_code', $link_button );
	}
}

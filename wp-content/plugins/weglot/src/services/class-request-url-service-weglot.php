<?php

namespace WeglotWP\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Weglot\Util\Url;
use Weglot\Util\Server;


/**
 * Request URL
 *
 * @since 2.0
 */
class Request_Url_Service_Weglot {
	/**
	 * @since 2.0
	 *
	 * @var string
	 */
	protected $weglot_url = null;

	/**
	 * @since 2.0
	 */
	public function __construct() {
		$this->option_services           = weglot_get_service( 'Option_Service_Weglot' );
		$this->amp_services              = weglot_get_service( 'Amp_Service_Weglot' );
	}

	/**
	 * Use for abstract \Weglot\Util\Url
	 *
	 * @param string $url
	 * @return Weglot\Util\Url
	 */
	public function create_url_object( $url ) {
		return new Url(
			$url,
			$this->option_services->get_option( 'original_language' ),
			weglot_get_destination_languages(),
			$this->get_home_wordpress_directory()
		);
	}

	/**
	 * @since 2.0
	 *
	 * @return string
	 */
	public function init_weglot_url() {
		$exclude_urls_option = $this->option_services->get_exclude_urls();

		if ( ! empty( $exclude_urls_option ) ) {
			$exclude_urls_option = array_map( function( $item ) {
				return $this->url_to_relative( $item );
			}, $exclude_urls_option);
		}

		$this->weglot_url = new Url(
			$this->get_full_url(),
			$this->option_services->get_option( 'original_language' ),
			weglot_get_destination_languages(),
			$this->get_home_wordpress_directory()
		);

		$this->weglot_url->setExcludedUrls( $exclude_urls_option );

		return $this;
	}

	/**
	 * Get request URL in process
	 * @since 2.0
	 * @param boolean $cache
	 * @return \Weglot\Util\Url
	 */
	public function get_weglot_url( $cache = true ) {
		if ( null === $this->weglot_url || ! $cache ) {
			$this->init_weglot_url();
		}

		return $this->weglot_url;
	}

	/**
	 * Abstraction of \Weglot\Util\Url
	 * @since 2.0
	 * @param boolean $with_filter
	 * @return string
	 */
	public function get_current_language( $with_filter = true ) {
		if ( wp_doing_ajax() && isset( $_SERVER['HTTP_REFERER'] ) ) { //phpcs:ignore
			$current_language = $this->create_url_object( $_SERVER['HTTP_REFERER'] )->detectCurrentLanguage(); //phpcs:ignore
		} else {
			$current_language = $this->get_weglot_url()->detectCurrentLanguage();
		}

		if ( $with_filter ) {
			return apply_filters( 'weglot_translate_current_language', $current_language );
		}

		return $current_language;
	}

	/**
	 * Abstraction of \Weglot\Util\Url
	 * @since 2.0
	 *
	 * @return boolean
	 */
	public function is_translatable_url() {
		return $this->get_weglot_url()->isTranslable() && $this->is_eligible_url( $this->get_full_url() );
	}


	/**
	 * @since 2.0
	 *
	 * @return string
	 * @param mixed $use_forwarded_host
	 */
	public function get_full_url( $use_forwarded_host = false ) {
		return Server::fullUrl($_SERVER, $use_forwarded_host); //phpcs:ignore
	}

	/**
	 * @since 2.0.4
	 *
	 * @return string
	 * @param mixed $use_forwarded_host
	 */
	public function get_full_url_no_language( $use_forwarded_host = false ) {
		return $this->create_url_object( $this->get_full_url() )->getForLanguage( weglot_get_original_language() );
	}


	/**
	 * @todo : Change this when weglot-php included
	 *
	 * @param string $code
	 * @return boolean
	 */
	public function is_language_rtl( $code ) {
		$rtls = [ 'ar', 'he', 'fa' ];
		if ( in_array( $code, $rtls, true ) ) {
			return true;
		}

		return false;
	}

	/**
	 * @since 2.0
	 *
	 * @return string|null
	 */
	public function get_home_wordpress_directory() {
		$opt_siteurl   = trim( get_option( 'siteurl' ), '/' );
		$opt_home      = trim( get_option( 'home' ), '/' );
		if ( empty( $opt_siteurl ) || empty( $opt_home ) ) {
			return null;
		}

		if (
			( substr( $opt_home, 0, 7 ) === 'http://' && strpos( substr( $opt_home, 7 ), '/' ) !== false) || ( substr( $opt_home, 0, 8 ) === 'https://' && strpos( substr( $opt_home, 8 ), '/' ) !== false ) ) {
			$parsed_url = parse_url( $opt_home ); // phpcs:ignore
			$path       = isset( $parsed_url['path'] ) ? $parsed_url['path'] : '/';
			return $path;
		}

		return null;
	}


	/**
	 * Is eligible URL
	 * @since 2.0
	 * @param string $url
	 * @return boolean
	 */
	public function is_eligible_url( $url ) {
		$url = urldecode( $this->url_to_relative( $url ) );
		//Format exclude URL
		$exclude_urls_option = weglot_get_exclude_urls();

		if ( ! empty( $exclude_urls_option ) ) {
			$exclude_urls_option    = implode( ',', $exclude_urls_option );
			$exclude_urls_option    = preg_replace( '#\s+#', ',', trim( $exclude_urls_option ) );

			$excluded_urls  = explode( ',', $exclude_urls_option );
			foreach ( $excluded_urls as $key => $ex_url ) {
				$excluded_urls[$key] = $this->url_to_relative( $ex_url ); //phpcs:ignore
			}
			$exclude_urls_option = implode( ',', $excluded_urls );
		}

		$exclusions = preg_replace( '#\s+#', ',', $exclude_urls_option );

		$list_regex = [];
		if ( ! empty( $exclusions ) ) {
			$list_regex  = explode( ',', $exclusions );
		}

		$translate_amp = weglot_get_translate_amp_translation();

		if ( ! $translate_amp ) {
			$list_regex[] = $this->amp_services->get_regex();
		}

		$path_without_language = array_filter( explode( '/', $url ), 'strlen' );
		$index_entries         = count( $path_without_language );
		$custom_urls           = $this->option_services->get_option( 'custom_urls' );
		$current_language      = $this->get_current_language();

		$url_path_custom = null;
		if ( ! empty( $custom_urls ) && isset( $custom_urls[ $current_language ] ) && isset( $path_without_language[ $index_entries ] ) && isset( $custom_urls[ $current_language ][ $path_without_language[ $index_entries ] ] ) ) {
			$url_path_custom = '/' . $custom_urls[ $current_language ][ $path_without_language[ $index_entries ] ] . '/';
		}

		foreach ( $list_regex as $regex ) {
			$str           = $this->escape_slash( $regex );
			$prepare_regex = sprintf( '/%s/', $str );

			if ( preg_match( $prepare_regex, $url ) === 1 ) {
				return apply_filters( 'weglot_is_eligible_url', false, $url );
			}

			if ( null !== $url_path_custom && preg_match( $prepare_regex, $url_path_custom ) === 1 ) {
				return apply_filters( 'weglot_is_eligible_url', false, $url );
			}
		}

		return apply_filters( 'weglot_is_eligible_url', true, $url );
	}

	/**
	 * @since 2.0
	 *
	 * @param string $str
	 * @return string
	 */
	public function escape_slash( $str ) {
		return str_replace( '/', '\/', $str );
	}


	/**
	 * @since 2.0
	 *
	 * @param string $url
	 * @return string
	 */
	public function url_to_relative( $url ) {
		if ( ( substr( $url, 0, 7 ) === 'http://' ) || ( substr( $url, 0, 8 ) === 'https://' ) ) {
			// the current link is an "absolute" URL - parse it to get just the path
			$parsed   = wp_parse_url( $url );
			$path     = isset( $parsed['path'] ) ? $parsed['path'] : '';
			$query    = isset( $parsed['query'] ) ? '?' . $parsed['query'] : '';
			$fragment = isset( $parsed['fragment'] ) ? '#' . $parsed['fragment'] : '';

			if ( $this->get_home_wordpress_directory() ) {
				$relative = str_replace( $this->get_home_wordpress_directory(), '', $path );

				return ( empty( $relative ) ) ? '/' : $relative;
			}

			return $path . $query . $fragment;
		}
		return $url;
	}
}



<?php

namespace WeglotWP\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option services
 *
 * @since 2.0
 */
class Option_Service_Weglot {

	/**
	 * @var array
	 */
	protected $options_default = [
		'api_key'                    => '',
		'original_language'          => 'en',
		'destination_language'       => [],
		'translate_amp'              => false,
		'exclude_blocks'             => [],
		'exclude_urls'               => [],
		'auto_redirect'              => false,
		'email_translate'            => false,
		'is_fullname'                => false,
		'with_name'                  => true,
		'is_dropdown'                => true,
		'type_flags'                 => 0,
		'with_flags'                 => true,
		'override_css'               => '',
		'has_first_settings'         => true,
		'show_box_first_settings'    => false,
		'rtl_ltr_style'              => '',
		'allowed'                    => true,
		'custom_urls'                => [],
		'flag_css'                   => '',
		'private_mode'               => [
			'active' => false,
		],
	];

	/**
	 * Get options default
	 *
	 * @since 2.0
	 * @return array
	 */
	public function get_options_default() {
		return $this->options_default;
	}

	/**
	 * @since 2.0
	 * @version 2.2.2
	 * @return array
	 */
	public function get_options() {
		return apply_filters( 'weglot_get_options', wp_parse_args( get_option( WEGLOT_SLUG ), $this->get_options_default() ) );
	}

	/**
	 * @since 2.0
	 * @param string $name
	 * @return array
	 */
	public function get_option( $name ) {
		$options = $this->get_options();
		if ( ! array_key_exists( $name, $options ) ) {
			return null; // @TODO : throw exception
		}

		return $options[ $name ];
	}

	/**
	 * @since 2.0
	 * @return array
	 */
	public function get_exclude_blocks() {
		$exclude_blocks     = $this->get_option( 'exclude_blocks' );
		$exclude_blocks[]   = '#wpadminbar';
		$exclude_blocks[]   = '#query-monitor';

		return apply_filters( 'weglot_exclude_blocks', $exclude_blocks );
	}

	/**
	 * @since 2.0.4
	 * @return array
	 */
	public function get_destination_languages() {
		$destination_languages     = $this->get_option( 'destination_language' );

		return apply_filters( 'weglot_destination_languages', $destination_languages );
	}

	/**
	 * @since 2.0
	 * @return array
	 */
	public function get_exclude_urls() {
		$exclude_urls     = $this->get_option( 'exclude_urls' );
		$exclude_urls[]   = '/wp-login.php';
		$exclude_urls[]   = '/sitemaps_xsl.xsl';
		$exclude_urls[]   = '/sitemaps.xml';

		return apply_filters( 'weglot_exclude_urls', $exclude_urls );
	}

	/**
	 * @since 2.0
	 *
	 * @return string
	 */
	public function get_css_custom_inline() {
		return apply_filters( 'weglot_css_custom_inline', $this->get_option( 'override_css' ) );
	}

	/**
	 * @since 2.0
	 *
	 * @return string
	 */
	public function get_flag_css() {
		return apply_filters( 'weglot_flag_css', $this->get_option( 'flag_css' ) );
	}


	/**
	 * @since 2.0
	 * @param array $options
	 * @return Option_Service_Weglot
	 */
	public function set_options( $options ) {
		update_option( WEGLOT_SLUG, $options );
		return $this;
	}

	/**
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return Option_Service_Weglot
	 */
	public function set_option_by_key( $key, $value ) {
		$options         = $this->get_options();
		$options[ $key ] = $value;
		$this->set_options( $options );
		return $this;
	}
}

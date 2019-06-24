<?php

namespace WeglotWP\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * @since 2.3.0
 */
class Generate_Switcher_Service_Weglot {

	/**
	 * @since 2.3.0
	 */
	public function __construct() {
		$this->option_services            = weglot_get_service( 'Option_Service_Weglot' );
		$this->request_url_services       = weglot_get_service( 'Request_Url_Service_Weglot' );
		$this->language_services          = weglot_get_service( 'Language_Service_Weglot' );
		$this->custom_url_services        = weglot_get_service( 'Custom_Url_Service_Weglot' );
		$this->button_services            = weglot_get_service( 'Button_Service_Weglot' );
	}

	/**
	 * @since 2.3.0
	 *
	 * @param string $dom
	 * @return string
	 */
	public function replace_div_id( $dom ) {
		if ( strpos( $dom, '<div id="weglot_here"></div>' ) === false ) {
			return $dom;
		}

		$button_html  = $this->button_services->get_html( 'weglot-shortcode' );
		$dom          = str_replace( '<div id="weglot_here"></div>', $button_html, $dom );

		return apply_filters( 'weglot_replace_div_id', $dom );
	}

	/**
	 * @since 2.3.0
	 *
	 * @param string $dom
	 * @return string
	 */
	public function replace_weglot_menu( $dom ) {
		if ( strpos( $dom, '[weglot_menu' ) === false ) {
			return $dom;
		}

		$languages_configured = $this->language_services->get_languages_configured();
		$options              = $this->option_services->get_options();
		$is_fullname          = $options['is_fullname'];
		$with_name            = $options['with_name'];

		$url                  = $this->request_url_services->get_weglot_url();

		foreach ( $languages_configured as $language ) {
			$shortcode_title                        = sprintf( '\[weglot_menu_title-%s\]', $language->getIso639() );
			$shortcode_title_without_bracket        = sprintf( 'weglot_menu_title-%s', $language->getIso639() );
			$shortcode_title_html                   = str_replace( '\[', '%5B', $shortcode_title );
			$shortcode_title_html                   = str_replace( '\]', '%5D', $shortcode_title_html );
			$shortcode_url                          = sprintf( '(http|https):\/\/\[weglot_menu_current_url-%s\]', $language->getIso639() );
			$shortcode_url_html                     = str_replace( '\[', '%5B', $shortcode_url );
			$shortcode_url_html                     = str_replace( '\]', '%5D', $shortcode_url_html );

			$name = $this->button_services->get_name_with_language_entry( $language );

			$dom                  = preg_replace( '#' . $shortcode_title . '#i', $name, $dom );
			$dom                  = preg_replace( '#' . $shortcode_title_html . '#i', $name, $dom );
			$dom                  = preg_replace( '#' . $shortcode_title_without_bracket . '#i', $name, $dom );

			$link_menu = $this->custom_url_services->get_link_button_with_key_code( $language->getIso639() );

			// Compatibility Menu HTTPS if not work. Since 2.0.6
			if (
					(
						is_ssl() ||
						isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] // phpcs:ignore
					) &&
					strpos( $link_menu, 'https://' ) === false
				) {
				$link_menu = str_replace( 'http', 'https', $link_menu );
			}

			$dom                  = preg_replace( '#' . $shortcode_url . '#i', $link_menu, $dom );
			$dom                  = preg_replace( '#' . $shortcode_url_html . '#i', $link_menu, $dom );
		}

		$dom .= sprintf( '<!--Weglot %s-->', WEGLOT_VERSION );

		return apply_filters( 'weglot_replace_weglot_menu', $dom );
	}

	/**
	 * @since 2.3.0
	 *
	 * @param string $dom
	 * @return string
	 */
	public function render_default_button( $dom ) {
		if ( strpos( $dom, sprintf( '<!--Weglot %s-->', WEGLOT_VERSION ) ) !== false ) {
			return $dom;
		}

		// Place the button if not in the page
		$button_html  = $this->button_services->get_html( 'weglot-default' );
		$dom          = ( strpos( $dom, '</body>' ) !== false) ? str_replace( '</body>', $button_html . ' </body>', $dom ) : str_replace( '</footer>', $button_html . ' </footer>', $dom );

		return apply_filters( 'weglot_render_default_button', $dom );
	}

	/**
	 * @since 2.3.0
	 * @param string $dom
	 * @return string
	 */
	public function generate_switcher_from_dom( $dom ) {
		$dom = $this->replace_div_id( $dom );
		$dom = $this->replace_weglot_menu( $dom );
		$dom = $this->render_default_button( $dom );

		return apply_filters( 'weglot_generate_switcher_from_dom', $dom );
	}
}

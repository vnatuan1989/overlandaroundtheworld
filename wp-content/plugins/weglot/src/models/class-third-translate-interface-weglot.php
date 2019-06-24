<?php

namespace WeglotWP\Models;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Third translate
 *
 * @since 2.0
 *
 */
interface Third_Translate_Interface_Weglot {
	public function translate_words( $content );
}

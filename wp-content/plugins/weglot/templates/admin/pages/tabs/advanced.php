<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Weglot\Client\Client;

use WeglotWP\Helpers\Helper_Tabs_Admin_Weglot;

$options_available = [
	'exclude_urls' => [
		'key'         => 'exclude_urls',
		'label'       => __( 'Exclusion URL', 'weglot' ),
		'description' => __( 'Add URL that you want to exclude from translations. You can use regular expression to match multiple URLs. ', 'weglot' ),
	],
	'exclude_blocks' => [
		'key'         => 'exclude_blocks',
		'label'       => __( 'Exclusion Blocks', 'weglot' ),
		'description' => __( 'Enter the CSS selector of blocks you don\'t want to translate (like a sidebar, a menu, a paragraph etc...', 'weglot' ),
	],
	'auto_redirect' => [
		'key'         => 'auto_redirect',
		'label'       => __( 'Auto redirection', 'weglot' ),
		'description' => __( 'Check if you want to redirect users based on their browser language.', 'weglot' ),
	],
	'email_translate' => [
		'key'         => 'email_translate',
		'label'       => __( 'Translate email', 'weglot' ),
		'description' => __( 'Check to translate all emails who use function wp_mail', 'weglot' ),
	],
	'translate_amp' => [
		'key'         => 'translate_amp',
		'label'       => __( 'Translate AMP', 'weglot' ),
		'description' => __( 'Translate AMP page', 'weglot' ),
	],
	'private_mode' => [
		'key'         => 'private_mode',
		'label'       => __( 'Private mode', 'weglot' ),
		'description' => __( 'Only admin users can be view translation', 'weglot' ),
	],
];

$languages = weglot_get_languages_configured();
foreach ($languages as $key => $value) {
	if ($value->getIso639() === weglot_get_original_language() ) {
		unset( $languages[$key] );
	}
}

?>

<h3><?php esc_html_e( 'Translation Exclusion (Optional)', 'weglot' ); ?> </h3>
<hr>
<p><?php esc_html_e( 'By default, every page is translated. You can exclude parts of a page or a full page here.', 'weglot' ); ?></p>
<table class="form-table">
    <tbody>
    <tr valign="top">
        <th scope="row" class="titledesc">
            <label for="<?php echo esc_attr( $options_available['exclude_urls']['key'] ); ?>">
                <?php echo esc_html( $options_available['exclude_urls']['label'] ); ?>
            </label>
            <p class="sub-label"><?php echo esc_html( $options_available['exclude_urls']['description'] ); ?></p>
        </th>
        <td class="forminp forminp-text">
            <div id="container-<?php echo esc_attr( $options_available['exclude_urls']['key'] ); ?>">
                <?php
				if ( ! empty( $this->options[ $options_available['exclude_urls']['key'] ] ) ) :
					foreach ( $this->options[ $options_available['exclude_urls']['key'] ] as $option ) :
						?>
                        <div class="item-exclude">
                            <input
                                    type="text"
                                    placeholder="/my-awesome-url"
                                    name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['exclude_urls']['key'] ) ); ?>[]"
                                    value="<?php echo esc_attr( $option ); ?>"
                            >
                            <button class="js-btn-remove js-btn-remove-exclude-url">
                                <span class="dashicons dashicons-minus"></span>
                            </button>
                        </div>
                        <?php
					endforeach;
				endif; ?>
            </div>
            <button id="js-add-exclude-url" class="btn btn-soft"><?php esc_html_e( 'Add an URL to exclude', 'weglot' ); ?></button>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row" class="titledesc">
            <label for="<?php echo esc_attr( $options_available['exclude_blocks']['key'] ); ?>">
                <?php echo esc_html( $options_available['exclude_blocks']['label'] ); ?>
            </label>
            <p class="sub-label"><?php echo esc_html( $options_available['exclude_blocks']['description'] ); ?></p>
        </th>
        <td class="forminp forminp-text">
            <div id="container-<?php echo esc_attr( $options_available['exclude_blocks']['key'] ); ?>">
                <?php
				if ( ! empty( $this->options[ $options_available['exclude_blocks']['key'] ] ) ) :
					foreach ( $this->options[ $options_available['exclude_blocks']['key'] ] as $option ) :
						?>
                        <div class="item-exclude">
                            <input
                                    type="text"
                                    placeholder=".my-class"
                                    name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['exclude_blocks']['key'] ) ); ?>[]"
                                    value="<?php echo esc_attr( $option ); ?>"
                            >
                            <button class="js-btn-remove js-btn-remove-exclude">
                                <span class="dashicons dashicons-minus"></span>
                            </button>
                        </div>
                        <?php
					endforeach;
				endif; ?>
            </div>
            <button id="js-add-exclude-block" class="btn btn-soft"><?php esc_html_e( 'Add a block to exclude', 'weglot' ); ?></button>
        </td>
    </tr>
    </tbody>
</table>

<h3><?php esc_html_e( 'Other options (Optional)', 'weglot' ); ?></h3>
<hr>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $options_available['auto_redirect']['key'] ); ?>">
					<?php echo esc_html( $options_available['auto_redirect']['label'] ); ?>
				</label>
			</th>
			<td class="forminp forminp-text">
				<input
					name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['auto_redirect']['key'] ) ); ?>"
					id="<?php echo esc_attr( $options_available['auto_redirect']['key'] ); ?>"
					type="checkbox"
					<?php checked( $this->options[ $options_available['auto_redirect']['key'] ], 1 ); ?>
				>
				<p class="description"><?php echo esc_html( $options_available['auto_redirect']['description'] ); ?></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $options_available['email_translate']['key'] ); ?>">
					<?php echo esc_html( $options_available['email_translate']['label'] ); ?>
				</label>
			</th>
			<td class="forminp forminp-text">
				<input
					name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['email_translate']['key'] ) ); ?>"
					id="<?php echo esc_attr( $options_available['email_translate']['key'] ); ?>"
					type="checkbox"
					<?php checked( $this->options[ $options_available['email_translate']['key'] ], 1 ); ?>
				>
				<p class="description"><?php echo esc_html( $options_available['email_translate']['description'] ); ?></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $options_available['translate_amp']['key'] ); ?>">
					<?php echo esc_html( $options_available['translate_amp']['label'] ); ?>
				</label>
			</th>
			<td class="forminp forminp-text">
				<input
					name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['translate_amp']['key'] ) ); ?>"
					id="<?php echo esc_attr( $options_available['translate_amp']['key'] ); ?>"
					type="checkbox"
					<?php checked( $this->options[ $options_available['translate_amp']['key'] ], 1 ); ?>
				>
				<p class="description"><?php echo esc_html( $options_available['translate_amp']['description'] ); ?></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $options_available['private_mode']['key'] ); ?>">
					<?php echo esc_html( $options_available['private_mode']['label'] ); ?>
				</label>
			</th>
			<td class="forminp forminp-text">
				<input
					id="<?php echo esc_attr( $options_available['private_mode']['key'] ); ?>"
					name="<?php echo esc_attr( sprintf( '%s[%s][active]', WEGLOT_SLUG, $options_available['private_mode']['key'] ) ); ?>"
					type="checkbox"
					<?php checked( $this->options[ $options_available['private_mode']['key'] ]['active'], 1 ); ?>
				>
				<p class="description"><?php echo esc_html( $options_available['private_mode']['description'] ); ?></p>
				<div id="private-mode-detail">
					<?php foreach ( $languages as $key => $lang):
						$checked_value = isset( $this->options[ $options_available['private_mode']['key'] ][ $lang->getIso639() ] ) ? $this->options[ $options_available['private_mode']['key'] ][ $lang->getIso639() ] : null;
					?>
						<div class="private-mode-detail-lang">
							<input
								name="<?php echo esc_attr( sprintf( '%s[%s][%s]', WEGLOT_SLUG, $options_available['private_mode']['key'], $lang->getIso639() ) ); ?>"
								id="<?php echo esc_attr( sprintf( '%s[%s][%s]', WEGLOT_SLUG, $options_available['private_mode']['key'], $lang->getIso639() ) ); ?>"
								type="checkbox"
								class="private-mode-lang--input"
								<?php checked( $checked_value, 1 ); ?>
							/>
							<label for="<?php echo esc_attr( sprintf( '%s[%s][%s]', WEGLOT_SLUG, $options_available['private_mode']['key'], $lang->getIso639() ) ); ?>">
								<?php
								// translators: 1 Local name language
								esc_html_e( sprintf( "Make '%s' a private langauge", $lang->getLocalName() ), 'weglot' ); ?>
							</label>
						</div>
					<?php endforeach; ?>
				</div>
			</td>
		</tr>
	</tbody>
</table>

<div class="notice notice-info is-dismissible">
	<p>
		<?php esc_html_e( 'If you need any help, you can contact us via email us at support@weglot.com.', 'weglot' ); ?>
	</p>
	<p>
		<?php esc_html_e( 'You can also return to version 1.13.1 by clicking on the button below', 'weglot' ); ?>
	</p>
	<p>
		<a href="<?php echo wp_nonce_url( admin_url( 'admin-post.php?action=weglot_rollback' ), 'weglot_rollback' ); //phpcs:ignore ?>" class="button">
			<?php echo esc_html__( 'Re-install version 1.13.1', 'weglot' ); ?>
		</a>
	</p>
</div>

<template id="tpl-exclusion-url">
    <div class="item-exclude">
        <input
                type="text"
                placeholder="/my-awesome-url"
                name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['exclude_urls']['key'] ) ); ?>[]"
                value=""
        >
        <button class="js-btn-remove js-btn-remove-exclude">
            <span class="dashicons dashicons-minus"></span>
        </button>
    </div>
</template>

<template id="tpl-exclusion-block">
    <div class="item-exclude">
        <input
                type="text"
                placeholder=".my-class"
                name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['exclude_blocks']['key'] ) ); ?>[]"
                value=""
        >
        <button class="js-btn-remove js-btn-remove-exclude">
            <span class="dashicons dashicons-minus"></span>
        </button>
    </div>
</template>

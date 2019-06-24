<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use WeglotWP\Helpers\Helper_Tabs_Admin_Weglot;

$options_available = [
	'api_key' => [
		'key'         => 'api_key',
		'label'       => __( 'API Key', 'weglot' ),
		'description' => __( 'Log in to <a target="_blank" href="https://weglot.com/register-wordpress">Weglot</a> to get your API key.', 'weglot' ),
	],
	'original_language' => [
		'key'         => 'original_language',
		'label'       => __( 'Original language', 'weglot' ),
		'description' => 'What is the original (current) language of your website?',
	],
	'destination_language' => [
		'key'         => 'destination_language',
		'label'       => __( 'Destination languages', 'weglot' ),
		'description' => 'Choose languages you want to translate into. Supported languages can be found <a target="_blank" href="https://weglot.com/translation-api#languages_code">here</a>.',
	],
];


$languages          = $this->language_services->get_languages_available( [
	'sort' => true,
] );
$user_info          = $this->user_api_services->get_user_info();
$plans              = $this->user_api_services->get_plans();

?>

<h3><?php esc_html_e( 'Main configuration', 'weglot' ); ?></h3>
<hr>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $options_available['api_key']['key'] ); ?>">
					<?php echo esc_html( $options_available['api_key']['label'] ); ?>
				</label>
				<p class="sub-label"><?php echo $options_available['api_key']['description']; //phpcs:ignore ?></p>
			</th>
			<td class="forminp forminp-text">
				<input
					name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['api_key']['key'] ) ); ?>"
					id="<?php echo esc_attr( $options_available['api_key']['key'] ); ?>"
					type="text"
					required
					placeholder="wg_XXXXXXXXXXXX"
					value="<?php echo esc_attr( $this->options[ $options_available['api_key']['key'] ] ); ?>"
				>
				<br>
				<?php if ( $this->options['has_first_settings'] ) {
	?>
				<p class="description"><?php echo esc_html_e( 'If you don\'t have an account, you can create one in 20 seconds !', 'weglot' ); ?></p>
				<?php
}  ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $options_available['original_language']['key'] ); ?>">
					<?php echo esc_html( $options_available['original_language']['label'] ); ?>
				</label>
					<p class="sub-label"><?php echo $options_available['original_language']['description']; //phpcs:ignore ?></p>
			</th>
			<td class="forminp forminp-text">
				<select
					class="weglot-select weglot-select-original"
					name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['original_language']['key'] ) ); ?>"
					id="<?php echo esc_attr( $options_available['original_language']['key'] ); ?>"
				>
					<?php foreach ( $languages as $language ) : ?>
						<option
							value="<?php echo esc_attr( $language->getIso639() ); ?>"
							<?php selected( $language->getIso639(), $this->options[ $options_available['original_language']['key'] ] ); ?>
						>
							<?php esc_html_e( $language->getEnglishName(), 'weglot'); //phpcs:ignore ?>
						</option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $options_available['destination_language']['key'] ); ?>">
					<?php echo esc_html( $options_available['destination_language']['label'] ); ?>
				</label>
				<p class="sub-label"><?php echo $options_available['destination_language']['description']; //phpcs:ignore ?></p>
			</th>

			<td class="forminp forminp-text">
				<select
					class="weglot-select weglot-select-destination"
					style="display:none"
					name="<?php echo esc_attr( sprintf( '%s[%s]', WEGLOT_SLUG, $options_available['destination_language']['key'] ) ); ?>[]"
					id="<?php echo esc_attr( $options_available['destination_language']['key'] ); ?>"
					multiple="true"
					required
				>
					<?php foreach ( $this->options[ $options_available['destination_language']['key'] ] as $language ) :
						$languages[ $language ]; ?>
						<option
							value="<?php echo esc_attr( $language ); ?>"
							selected="selected"
						>
							<?php echo esc_html( $language ); ?>
						</option>
					<?php endforeach; ?>

					<?php foreach ( $languages as $language ) : ?>
						<option
							value="<?php echo esc_attr( $language->getIso639() ); ?>"
							<?php selected( true, in_array( $language->getIso639(), $this->options[ $options_available['destination_language']['key'] ], true ) ); ?>
						>
							<?php echo esc_html( $language->getLocalName() ); ?>
						</option>
					<?php endforeach; ?>
				</select>

				<?php
				if ( $user_info && isset( $user_info['plan'] ) && $user_info['plan'] <= 0 ) {
					?>
						<p class="description">
							<?php // translators: 1 HTML Tag, 2 HTML Tag ?>
							<?php echo sprintf( esc_html__( 'On the free plan, you can choose one language and use a maximum of 2000 words. If you need more, please %1$supgrade your plan%2$s.', 'weglot' ), '<a target="_blank" href="https://dashboard.weglot.com/billing/upgrade">', '</a>' ); ?>
						</p>
					<?php
				} elseif ( isset( $user_info['plan'] ) && in_array( $user_info['plan'], $plans['starter_free']['ids'] ) ) { //phpcs:ignore
					?>
						<p class="description">
							<?php // translators: 1 HTML Tag, 2 HTML Tag ?>
							<?php echo sprintf( esc_html__( 'On the Starter plan, you can choose one language. If you need more, please %1$supgrade your plan%2$s.', 'weglot' ), '<a target="_blank" href="https://dashboard.weglot.com/billing/upgrade">', '</a>' ); ?>
						</p>
					<?php
				} elseif ( isset( $user_info['plan'] ) && in_array( $user_info['plan'], $plans['business']['ids'] ) ) { //phpcs:ignore
					?>
						<p class="description">
							<?php // translators: 1 HTML Tag, 2 HTML Tag ?>
							<?php echo sprintf( esc_html__( 'On the Business plan, you can choose five languages. If you need more, please %1$supgrade your plan%2$s.', 'weglot' ), '<a target="_blank" href="https://dashboard.weglot.com/billing/upgrade">', '</a>' ); ?>
						</p>
					<?php
				}
				?>
			</td>
		</tr>
	</tbody>
</table>


<?php if ( ! $this->options['has_first_settings'] && $this->options['show_box_first_settings'] ) : ?>
	<?php $this->option_services->set_option_by_key( 'show_box_first_settings', false ); // remove showbox ?>
	<div id="weglot-box-first-settings" class="weglot-box-overlay">
		<div class="weglot-box">
			<a class="weglot-btn-close"><?php esc_html_e( 'Close', 'weglot' ); ?></a>
			<h3 class="weglot-box--title"><?php esc_html_e( 'Well done! Your website is now multilingual.', 'weglot' ); ?></h3>
			<p class="weglot-box--text"><?php esc_html_e( 'Go on your website, there is a language switcher bottom right. Try it :)', 'weglot' ); ?></p>
			<a class="button button-primary" href="<?php echo esc_attr( home_url() ); ?>" target="_blank">
				<?php esc_html_e( 'Go on my front page.', 'weglot' ); ?>
			</a>
			<p class="weglot-box--subtext"><?php esc_html_e( 'Next step, customize the language button as you want and manually edit your translations directly in your Weglot account.', 'weglot' ); ?></p>
		</div>
	</div>
	<?php
	if ( $this->options[ $options_available['destination_language']['key'] ] && count( $this->options[ $options_available['destination_language']['key'] ] ) > 0 ) :
		?>
		<iframe
			style="visibility:hidden;"
			src="<?php echo esc_url( sprintf( '%s/%s', home_url(), $this->options[ $options_available['destination_language']['key'] ][0] ) ); ?>/" width="1" height="1">
		</iframe>
	<?php endif; ?>
<?php endif; ?>

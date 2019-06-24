<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Helpers\Helper_Tabs_Admin_Weglot;


?>

<div id="wrap-weglot">
	<div class="wrap">
		<form method="post" id="mainform" action="<?php echo esc_url( admin_url( 'options.php' ) ); ?>">
			<?php


			switch ( $this->tab_active ) {
				case Helper_Tabs_Admin_Weglot::SETTINGS:
				default:
					include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/settings.php';
					if ( ! $this->options['has_first_settings'] ) {
						include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/appearance.php';
						include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/advanced.php';
					}

					break;
				case Helper_Tabs_Admin_Weglot::STATUS:
					include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/status.php';
					break;
				case Helper_Tabs_Admin_Weglot::CUSTOM_URLS:
					include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/custom-urls.php';
					break;
			}

			if ( ! in_array( $this->tab_active, [ Helper_Tabs_Admin_Weglot::STATUS ], true ) ) {
				settings_fields( WEGLOT_OPTION_GROUP );
				submit_button();
			}
			?>
			<input type="hidden" name="tab" value="<?php echo esc_attr( $this->tab_active ); ?>">
		</form>
		<?php if ( ! $this->options['has_first_settings'] ) {
				?>
		<hr>
		<a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/weglot?rate=5#postform">
			<?php esc_html_e( 'Love Weglot? Give us 5 stars on WordPress.org :)', 'weglot' ); ?>
		</a>
		<i class="fa fa-question-circle question-icon" aria-hidden="true"></i>
		<p class="weglot-five-stars">
			<?php
				// translators: 1 HTML Tag, 2 HTML Tag
				echo sprintf( esc_html__( 'If you need any help, you can contact us via email us at support@weglot.com.', 'weglot' ), '<a href="https://weglot.com/" target="_blank">', '</a>' );
				echo  '<br>';
				// translators: 1 HTML Tag, 2 HTML Tag
				echo sprintf( esc_html__( 'You can also check our %1$sFAQ%2$s', 'weglot' ), '<a href="http://support.weglot.com/" target="_blank">', '</a>' ); ?>
		</p>
        <?php
			} ?>
	</div>
	<?php
	if ( ! $this->options['has_first_settings'] ) :
		?>
		<div class="weglot-infobox">
			<h3><?php esc_html_e( 'Where are my translations?', 'weglot' ); ?></h3>
			<div>
				<p><?php esc_html_e( 'You can find all your translations in your Weglot account:', 'weglot' ); ?></p>
				<a href="<?php esc_html_e( 'https://dashboard.weglot.com/translations/', 'weglot' ); ?>" target="_blank" class="weglot-editbtn">
					<?php esc_html_e( 'Edit my translations', 'weglot' ); ?>
				</a>
			</div>
		</div>
		<?php
	endif;
	?>
</div>


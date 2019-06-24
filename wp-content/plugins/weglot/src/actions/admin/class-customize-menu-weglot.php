<?php

namespace WeglotWP\Actions\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Models\Hooks_Interface_Weglot;
use WeglotWP\Helpers\Helper_Pages_Weglot;

/**
 *
 * @since 2.0
 *
 */
class Customize_Menu_Weglot implements Hooks_Interface_Weglot {

	/**
	 * @since 2.0
	 */
	public function __construct() {
		$this->language_services          = weglot_get_service( 'Language_Service_Weglot' );
		$this->option_services            = weglot_get_service( 'Option_Service_Weglot' );
		$this->request_url_services       = weglot_get_service( 'Request_Url_Service_Weglot' );
		$this->button_services            = weglot_get_service( 'Button_Service_Weglot' );
		$this->private_language_services  = weglot_get_service( 'Private_Language_Service_Weglot' );
		return $this;
	}

	/**
	 * @see Hooks_Interface_Weglot
	 *
	 * @since 2.0
	 * @return void
	 */
	public function hooks() {
		if ( ! $this->option_services->get_option( 'allowed' ) ) {
			return;
		}

		add_action( 'admin_head-nav-menus.php', [ $this, 'add_nav_menu_meta_boxes' ] );
		add_filter( 'nav_menu_link_attributes', [ $this, 'add_nav_menu_link_attributes' ], 10, 2 );
		add_filter( 'nav_menu_css_class', [ $this, 'add_nav_menu_css_class' ], 10, 2 );

		add_filter( 'megamenu_nav_menu_css_class', [ $this, 'add_nav_menu_css_class' ], 10, 2 );

		if ( $this->option_services->get_option( 'is_menu' ) ) {
			add_filter( 'wp_nav_menu_items', [ $this, 'weglot_fallback_menu' ] );
		}
	}

	/**
	 * @since 2.0
	 * @param string $items
	 * @return string
	 */
	public function weglot_fallback_menu( $items ) {
		$button = $this->button_services->get_html();
		$items .= $button;

		return $items;
	}

	/**
	 * @since 2.0
	 * @version 2.0.2
	 * @see nav_menu_link_attributes
	 * @param array $classes
	 * @param object $item
	 * @return void
	 */
	public function add_nav_menu_css_class( $classes, $item ) {
		$str              = 'weglot_menu_title-';
		if ( strpos( $item->post_name, $str ) !== false ) {
			$lang = explode( '-', substr( $item->post_name, strlen( $str ) ) );

			if ( ! $this->request_url_services->is_translatable_url() || ! weglot_current_url_is_eligible() || $this->private_language_services->is_active_private_mode_for_lang( $lang[0] ) ) {
				$classes[] = apply_filters( 'weglot_nav_menu_link_class', 'weglot-hide' );
				return $classes;
			}

			$options      = $this->option_services->get_options();
			$with_flags   = $options['with_flags'];
			$type_flags   = $options['type_flags'];

			$flag_class   = $with_flags ? 'weglot-flags ' : '';
			$flag_class .= '0' === $type_flags ? '' : 'flag-' . $type_flags . ' ';

			$classes[] = apply_filters( 'weglot_nav_menu_link_class', $flag_class . $lang[0] );
		}

		return $classes;
	}

	/**
	 * @since 2.0
	 * @see nav_menu_link_attributes
	 * @param array $attrs
	 * @param object $item
	 * @return void
	 */
	public function add_nav_menu_link_attributes( $attrs, $item ) {
		$str              = 'weglot_menu_title-';
		if ( strpos( $item->post_name, $str ) !== false ) {
			$current_language = $this->request_url_services->get_current_language();

			if ( ! $this->request_url_services->is_translatable_url() || ! weglot_current_url_is_eligible() ) {
				$attrs['style'] = 'display:none';
				return $attrs;
			}

			if ( ! isset( $attrs['class'] ) ) {
				$attrs['class'] = '';
			}

			$attrs['class'] .= ' weglot-lang';

			$attrs['data-wg-notranslate'] = 'true';
		}

		return $attrs;
	}

	/**
	 * @since 2.0
	 *
	 * @return void
	 */
	public function add_nav_menu_meta_boxes() {
		add_meta_box( 'weglot_nav_link', __( 'Weglot switcher', 'weglot' ), [ $this, 'nav_menu_links' ], 'nav-menus', 'side', 'low' );
	}

	/**
	 * Output menu links.
	 * @since 2.0
	 * @see add_meta_box weglot_nav_link
	 */
	public function nav_menu_links() {
		$languages_configured = $this->language_services->get_languages_configured();

		$languages_configured = apply_filters( 'weglot_custom_nav_menu_items', $languages_configured ); ?>
		<div id="posttype-weglot-languages" class="posttypediv">
			<div id="tabs-panel-weglot-endpoints" class="tabs-panel tabs-panel-active">
				<ul id="weglot-endpoints-checklist" class="categorychecklist form-no-clear">
					<?php
					$i = 1;
		foreach ( $languages_configured as $key => $language ) : //phpcs:ignore
						?>
						<li>
							<label class="menu-item-title">
								<input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-object-id]" value="<?php echo esc_attr( $i ); ?>" /> <?php echo esc_html( $language->getEnglishName() ); ?>
							</label>
							<input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-type]" value="custom" />
							<input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-title]" value="[weglot_menu_title-<?php echo esc_attr( $language->getIso639() ); ?>]" />
							<input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-url]" value="[weglot_menu_current_url-<?php echo esc_attr( $language->getIso639() ); ?>]" />
							<input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-classes]" />
						</li>
						<?php
						$i++;
		endforeach; //phpcs:ignore ?>
				</ul>
			</div>
			<p class="button-controls">
				<span class="list-controls">
					<a href="<?php echo esc_url( admin_url( 'nav-menus.php?page-tab=all&selectall=1#posttype-weglot-languages' ) ); ?>" class="select-all"><?php esc_html_e( 'Select all', 'weglot' ); ?></a>
				</span>
				<span class="add-to-menu">
					<button type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to menu', 'weglot' ); ?>" name="add-post-type-menu-item" id="submit-posttype-weglot-languages"><?php esc_html_e( 'Add to menu', 'weglot' ); ?></button>
					<span class="spinner"></span>
				</span>
			</p>
		</div>
		<?php
	}
}


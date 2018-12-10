<?php
/**
 * Designs and Plugins Feed
 *
 * @package  Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to display plugin design HTML
 * 
 * @package  Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_designs_page() {

	$wpos_feed_tabs = iscw_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap pap-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'page' => 'iscw-designs', 'tab' => $tab_key), admin_url('admin.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="pap-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				iscw_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo iscw_get_plugin_design( 'plugins-feed' );
			} else {
				echo iscw_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .pap-tab-cnt-wrp -->

	</div><!-- end .pap-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = iscw_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'pap_' . $active_tab;
	$url 			= isset($wpos_feed_tabs[$active_tab]['url']) 			? $wpos_feed_tabs[$active_tab]['url'] 				: '';
	$transient_time = isset($wpos_feed_tabs[$active_tab]['transient_time']) ? $wpos_feed_tabs[$active_tab]['transient_time'] 	: 172800;
	$cache 			= get_transient( $transient_key );
	
	if ( false === $cache ) {
		
		$feed 			= wp_remote_get( esc_url_raw( $url ), array( 'timeout' => 120, 'sslverify' => false ) );
		$response_code 	= wp_remote_retrieve_response_code( $feed );
		
		if ( ! is_wp_error( $feed ) && $response_code == 200 ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( $transient_key, $cache, $transient_time );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'slider-and-carousel-plus-widget-for-instagram' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'slider-and-carousel-plus-widget-for-instagram'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'slider-and-carousel-plus-widget-for-instagram'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('Hire Us', 'slider-and-carousel-plus-widget-for-instagram'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/wpos-offers.php',
													'transient_key'		=> 'wpos_offers_feed',
													'transient_time'	=> 86400,
												)
					);
	return $wpos_feed_tabs;
}

/**
 * Function to get 'How It Works' HTML
 *
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */
function iscw_howitwork_page() { ?>
	
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.pap-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.pap-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
			
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								
								<h3 class="hndle">
									<span><?php _e( 'How It Works - Display and Shortcode', 'slider-and-carousel-plus-widget-for-instagram' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started', 'slider-and-carousel-plus-widget-for-instagram'); ?></label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: This plugin create a Insta Feed - WPOS tab in WordPress menu section', 'slider-and-carousel-plus-widget-for-instagram'); ?></li>
														<li><?php _e('Step-2: Now, paste below shortcode in any post or page and your Instagram images listing is ready !!!', 'slider-and-carousel-plus-widget-for-instagram'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'slider-and-carousel-plus-widget-for-instagram'); ?></label>
												</th>
												<td>
													<span class="pap-shortcode-preview">[iscwp-slider username="instagram"]</span> – <?php _e('Instagram Slider', 'slider-and-carousel-plus-widget-for-instagram'); ?> <br/>
													<span class="pap-shortcode-preview">[iscwp-grid username="instagram"]</span> – <?php _e('Instagram Grid', 'slider-and-carousel-plus-widget-for-instagram'); ?>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
				
				<!--Upgrad to Pro HTML -->
				<div id="postbox-container-1" class="postbox-container">
					<div class="metabox-holder wpos-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox" style="">
									
								<h3 class="hndle">
									<span><?php _e( 'Need Support?', 'slider-and-carousel-plus-widget-for-instagram' ); ?></span>
								</h3>
								<div class="inside">
									<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'slider-and-carousel-plus-widget-for-instagram'); ?></p> <br/>
									<a class="button button-primary wpos-button-full" href="http://docs.wponlinesupport.com/slider-and-carousel-plus-widget-for-instagram/" target="_blank"><?php _e('Documentation', 'slider-and-carousel-plus-widget-for-instagram'); ?></a>
									<p><a class="button button-primary wpos-button-full" href="http://demo.wponlinesupport.com/instagram-slider-and-carousel-plus-widget-demo/" target="_blank"><?php _e('Demo for Designs', 'slider-and-carousel-plus-widget-for-instagram'); ?></a></p>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<div class="metabox-holder wpos-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<h3 class="hndle">
									<span><?php _e('Need PRO Support?', 'slider-and-carousel-plus-widget-for-instagram'); ?></span>
								</h3>
								<div class="inside">
									<p><?php _e('Hire our experts for any WordPress task.', 'slider-and-carousel-plus-widget-for-instagram'); ?></p>
									<p><a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/wordpress-support/" target="_blank"><?php _e('Know More', 'slider-and-carousel-plus-widget-for-instagram'); ?></a></p>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'slider-and-carousel-plus-widget-for-instagram' ); ?></span>
									</h3>									
									<div class="inside">										
										<p><?php _e( 'Enjoyed this plugin? You can help by rate this plugin', 'slider-and-carousel-plus-widget-for-instagram' ); ?> <a href="https://wordpress.org/support/plugin/slider-and-carousel-plus-widget-for-instagram/reviews/" target="_blank">5 stars!</a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }
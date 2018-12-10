<?php
/**
 * Settings Page
 *
 * @package Slider and Carousel Plus Widget Instagram
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap iscwp-settings-form-settings">

	<h2><?php _e( 'Insta Feed Settings', 'slider-and-carousel-plus-widget-for-instagram' ); ?></h2><br />

	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
		<p>'.__("Your changes saved successfully.", "slider-and-carousel-plus-widget-for-instagram").'</p>
			  </div>';
	}
	?>

	<form action="options.php" method="POST" id="iscwp-settings-form-settings-form" class="iscwp-settings-form-settings-form">

		<!-- Flush Settings Starts -->
		<div id="iscwp-settings-cache-user" class="post-box-container iscwp-settings-form-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<div class="hndle iscwp-cache-all-user">
							
							<h3 class="">
								<span><?php _e( 'Flush Caches', 'slider-and-carousel-plus-widget-for-instagram' ); ?></span>
							</h3>
							
							<input type="button" value="Flush all Caches" class="button button-primary iscwp-crl-all-cache">
						</div>

						<div class="inside iscwp-cache-user" id="iscwp-cache-user">
						
							<table class="form-table iscwp-settings-form-general-sett-tbl">
								<tbody>
								<?php $users = get_option('wp_iscwp_cache_transient');
								if($users) {
									foreach ($users as $user) {
									$user 		= explode('_', $user);
									$user_key	= end($user);
								?>
										<tr class="iscwp-user">
											<th scope="row">
												<b><?php echo $user_key; ?></b>
											</th>
											<td>
												<div class="iscwp-ajax-btn-wrap">
													<input type="button" value="<?php _e('Clear Cache', 'slider-and-carousel-plus-widget-for-instagram'); ?>" class="button button-secondary iscwp-crl-cache" data-user="<?php echo $user_key; ?>">
													<span class="spinner"></span>
												</div>
											</td>
										</tr>
									<?php } 
								} ?>
								<tr class="iscwp-user-empty <?php if($users){ echo 'iscwp-user-hide'; } ?>">
									<td>
										<?php _e('No cache data found.', 'slider-and-carousel-plus-widget-for-instagram') ?>
									</td>
								</tr>
								</tbody>
							</table>
							<div class="iscwp-msg-wrap"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Flush Settings end -->
	</form><!-- end .iscwp-settings-form-settings-form -->
</div><!-- end .iscwp-settings-form-settings -->
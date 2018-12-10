<div id="wp-iscwp-popup-<?php echo $unique.'-'.$count; ?>" class="wp-iscwp-popup-box iscwp-popup-design-1 wp-iscwp-popup-content mfp-hide" <?php echo $popup_attr; ?>>

	<a href="javascript:void(0);" class="wp-iscwp-popup-close wp-iscwp-close-btn mfp-close" title="Close (Esc)"></a>

	<div class="iscwp-loader">
		<div class="iscwp-loading-bar"></div><div class="iscwp-loading-bar"></div><div class="iscwp-loading-bar"></div><div class="iscwp-loading-bar"></div>
	</div>

	<div class="iscwp-popup-body">
	<?php if( $media_data ) { include( ISCW_DIR . '/templates/popup/design-1.php' ); } ?>
	</div>
</div>
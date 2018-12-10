<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_style( 'respport-banner', WEBLIZAR_ABOUT_ME_PLUGIN_URL . 'css/aatp-banner.css' );
$aap_imgpath = WEBLIZAR_ABOUT_ME_PLUGIN_URL . "settings/images/aatp_pro.png";
?>
<div class="wb_plugin_feature notice  is-dismissible">
    <div class="wb_plugin_feature_banner default_pattern pattern_ ">
        <div class="wb-col-md-6 wb-col-sm-12 box">
            <div class="ribbon"><span>Go Pro</span></div>
            <img class="wp-img-responsive" src="<?php echo $aap_imgpath; ?>" alt="img">
        </div>
        <div class="wb-col-md-6 wb-col-sm-12 wb_banner_featurs-list">
            <span class="gp_banner_head"><h2><?php _e( 'About Author Pro Features', WL_ABTM_TXT_DM ); ?> </h2></span>
            <ul>
                <li><?php _e( 'More Profile Image Layout', WL_ABTM_TXT_DM ); ?></li>
                <li><?php _e( 'Profile Header background', WL_ABTM_TXT_DM ); ?></li> 
                <li><?php _e( 'Multiple Author Widget', WL_ABTM_TXT_DM ); ?></li>
                <li><?php _e( 'Multiple Author Shortcode', WL_ABTM_TXT_DM ); ?></li>
                <li><?php _e( '10 Design Author Template', WL_ABTM_TXT_DM ); ?></li>
                <li><?php _e( 'Multiple Author Image Layout', WL_ABTM_TXT_DM ); ?></li>
                <li><?php _e( '8 Type of Hover Animations', WL_ABTM_TXT_DM ); ?></li>
                <li><?php _e( 'More Social Media Settings', WL_ABTM_TXT_DM ); ?></li>
                <li><?php _e( 'Responsive Design & Many More', WL_ABTM_TXT_DM ); ?></li>
                
            </ul>
            <div class="wp_btn-grup">
                <a class="wb_button-primary" href="http://demo.weblizar.com/about-author-pro/"
                   target="_blank"><?php _e( 'View Demo', WL_ABTM_TXT_DM ); ?></a>
                <a class="wb_button-primary" href="https://weblizar.com/plugins/about-author-pro/"
                   target="_blank"><?php _e( 'Buy Now', WL_ABTM_TXT_DM ); ?> $15</a>
            </div>

        </div>
    </div>
</div>
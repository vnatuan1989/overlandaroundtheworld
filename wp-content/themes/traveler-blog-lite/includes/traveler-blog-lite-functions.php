<?php
/**
 * Functions File
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update theme default settings
 * 
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_default_settings() {

	$default_settings = array(		
									
                                    'menu_bar_bg_clr'                   => '#fff',
                                    'menu_bar_link_clr'                 => '#000',
                                    'menu_bar_linkh_clr'                => '#2d53fe',
                                    'continue_read_clr'                 => '#000',
                                    'continue_read_hvr_clr'             => '#2d53fe',
                                    'h1_clr'                       		=> '#000000',
                                    'h2_clr'                       		=> '#000000',
                                    'h3_clr'                       		=> '#000000',
                                    'h4_clr'                       		=> '#000000',
                                    'h5_clr'                       		=> '#000000',
                                    'h6_clr'                       		=> '#000000',
                                    'link_clr'                          => '#000000',
                                    'hover_link_clr'                    => '#2d53fe', 
                                    'blog_layout_grid'					=> 4,
                                    'blog_excerpt_length'               => 20,
                                    'blog_show_content'					=> 1,
                                    'blog_show_date'                    => 1,
                                    'blog_show_author'                  => 1,
                                    'blog_show_cat'                     => 1,
                                    'blog_show_tags'                    => 1,
									'blog_show_comment'                 => 1,
									'blog_show_readmore'                => 1,
																
									'show_search'						=> 1,

									'cat_layout_grid'					=> 4,                          
									'cat_excerpt_length'				=> 20,
									'cat_show_content'					=> 1,  
                                    'cat_show_date'                     => 1,
                                    'cat_show_author'                   => 1,
                                    'cat_show_cat'                      => 1,                                 
                                    'cat_show_tags'                     => 1,                                   
									'cat_show_comment'                  => 1,
									'cat_show_readmore'                 => 1,                                  
                                    'single_post_fet_img'               => 1,
                                    'related_post_show'                 => 0,
                                    'related_post_title'                => __('More from', 'traveler-blog-lite') ,                                                                                     
                                    
                                    'dispable_slider'                   => 0,
									'number_of_lastestpost'             => 3,
									'select_category_for_slider'        => 1,
									
                                    'footer_social'                     => 0,
                                    'header_social'                     => 0,
                                    'facebook'                          => '',
                                    'twitter'                           => '',
                                    'linkedin'                          => '',
                                    'behance'                           => '',
                                    'dribbble'                          => '',
                                    'instagram'                         => '',
                                    'youtube'                           => '',
                                    'pinterest'                         => '',
                                    'copyright'                         => __('Blog Design Theme', 'traveler-blog-lite'),
                                   
                            );

	return apply_filters('traveler_blog_lite_options_default_values', $default_settings );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_esc_attr($data) {
    return esc_attr( $data );
}

/**
 * Function to excerpt length
 * 
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_excerpt_length( $length ) 
{
	if ( is_admin() ) {
		return $length;
	}

	$blog_excerpt_length 	= traveler_blog_lite_get_theme_mod( 'blog_excerpt_length' );	
	$cat_excerpt_length 	= traveler_blog_lite_get_theme_mod( 'cat_excerpt_length' );
	
	if ( is_home() || is_front_page() ) {
		 return $blog_excerpt_length;
	} elseif( is_category() || is_archive() ) {
		 return $cat_excerpt_length;
	} else {
			return $blog_excerpt_length;
	}
		
}
add_filter( 'excerpt_length', 'traveler_blog_lite_excerpt_length', 999 );

/**
 * Function to excerpt more
 * 
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_excerpt_more( $more ) {
	if ( ! is_admin() ) {	
		return '&hellip;';
	}	
}
add_filter('excerpt_more', 'traveler_blog_lite_excerpt_more');


/**
 * Function to get footer sidebar widget class
 * 
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_footer_widgets_cls( $sidebar_id ) {	
	global $_wp_sidebars_widgets;	
	
	$sidebars_widgets_count = $_wp_sidebars_widgets;

	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) {

		$widget_count 	= count( $sidebars_widgets_count[ $sidebar_id ] );
		$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );

		if ( $widget_count == 2 ) {			
			$widget_classes .= ' traveler-blog-lite-col-6';
		} elseif  ( $widget_count == 3 ) {			
			$widget_classes .= ' traveler-blog-lite-col-4';
		} elseif ( $widget_count == 4 ) {			
			$widget_classes .= ' traveler-blog-lite-col-3';
		}  elseif ( $widget_count == 5 ) {			
			$widget_classes .= ' traveler-blog-lite-col-5c';
		}  elseif ( $widget_count == 6 ) {			
			$widget_classes .= ' traveler-blog-lite-col-2';
		} else {			
			$widget_classes .= ' traveler-blog-lite-col-12';
		}
		return $widget_classes;
	}
}



/**
 * Function to get customizer value
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_get_theme_mod( $mod = '' ) {
	
	$default_settings 	= traveler_blog_lite_default_settings();
	$default_val 		= isset($default_settings[ $mod ]) ? $default_settings[ $mod ] : '';
    
        return get_theme_mod( $mod, $default_val );
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_sanitize_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'traveler_blog_lite_sanitize_clean', $var );
	} else {
		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash($data);
	}
}

/**
 * Checkbox sanitization callback.
 */
function traveler_blog_lite_sanitize_checkbox( $checked ) {
	return ( ( !empty( $checked ) ) ? true : false );
}

/**
 * Select sanitization callback.
 * 
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize URL
 * 
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_sanitize_url( $url ) {
	return esc_url_raw( trim($url) );
}

/**
 * Handles the footer copy right text
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_footer_copyright() {
	
	$current_year 	= date( 'Y', current_time('timestamp') );
	$copyright_text = traveler_blog_lite_get_theme_mod( 'copyright' );
	$copyright_text = str_replace('{year}', $current_year, $copyright_text);

	return apply_filters( 'traveler_blog_lite_footer_copyright', $copyright_text);

}

/**
 * Social icon Footer
 *
 * @package traveler_blog_lite
 * @since 1.0
 */

function traveler_blog_lite_get_footer_social_icon() {

		$facebook 		= traveler_blog_lite_get_theme_mod( 'facebook' ); 
		$twitter 		= traveler_blog_lite_get_theme_mod( 'twitter' );
		$linkedin 		= traveler_blog_lite_get_theme_mod( 'linkedin' );
		$behance 		= traveler_blog_lite_get_theme_mod( 'behance' );   
		$dribbble 		= traveler_blog_lite_get_theme_mod( 'dribbble' );
		$instagram 		= traveler_blog_lite_get_theme_mod( 'instagram' );
		$youtube 		= traveler_blog_lite_get_theme_mod( 'youtube' );
		$pinterest      = traveler_blog_lite_get_theme_mod( 'pinterest' );
		

     	if(!empty($facebook) ) { ?>	
       		<a href="<?php echo esc_url($facebook); ?>" title="<?php esc_attr_e('Facebook','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-facebook-icon"><i class="fa fa-facebook"></i> <span class="wpiclt-social-text"><?php esc_html_e( 'Facebook', 'traveler-blog-lite' ); ?></span></a>
		<?php } 
		if(!empty($twitter) ) { ?>	
			<a href="<?php echo esc_url($twitter); ?>" title="<?php esc_attr_e('Twitter','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-twitter-icon"><i class="fa fa-twitter"></i> <span class="wpiclt-social-text"><?php esc_html_e( 'Twitter', 'traveler-blog-lite' ); ?></span></a>
		<?php } 
		if(!empty($linkedin) ) { ?>	
			<a href="<?php echo esc_url($linkedin); ?>" title="<?php esc_attr_e('LinkedIn','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-linkedin-icon"><i class="fa fa-linkedin"></i> <span class="wpiclt-social-text"><?php esc_html_e( 'LinkedIn', 'traveler-blog-lite' ); ?></span></a>
		<?php } 
		if(!empty($youtube)) { ?>		
			<a href="<?php echo esc_url($youtube); ?>" title="<?php esc_attr_e('YouTube','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-youtube-icon"><i class="fa fa-youtube"></i> <span class="wpiclt-social-text"><?php esc_html_e( 'YouTube', 'traveler-blog-lite' ); ?></span></a>				
		<?php } 
		if(!empty($instagram) ) { ?>		
			<a href="<?php echo esc_url($instagram); ?>" title="<?php esc_attr_e('Instagram','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-instagram-icon"><i class="fa fa-instagram"></i> <span class="wpiclt-social-text"><?php esc_html_e( 'Instagram', 'traveler-blog-lite' ); ?></span></a>				
		<?php } 
		if(!empty($behance) ) { ?>		
			<a href="<?php echo esc_url($behance); ?>" title="<?php esc_attr_e('Behance','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-behance-icon"><i class="fa fa-behance"></i> <span class="wpiclt-social-text"><?php esc_html_e( 'Behance', 'traveler-blog-lite' ); ?></span></a>				
		<?php } 

		if(!empty($dribbble) ) { ?>		
			<a href="<?php echo esc_url($dribbble); ?>" title="<?php esc_attr_e('Dribbble','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-dribbble-icon"><i class="fa fa-dribbble"></i> <span class="wpiclt-social-text"><?php esc_html_e( 'Dribbble', 'traveler-blog-lite' ); ?></span></a>				
		<?php } 

		if(!empty($pinterest) ) { ?>		
			<a href="<?php echo esc_url($pinterest); ?>" title="<?php esc_attr_e('Pinterest','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-pinterest-icon"><i class="fa fa-pinterest"></i> <span class="wpiclt-social-text"><?php esc_html_e( 'Pinterest', 'traveler-blog-lite' ); ?></span></a>				
		<?php }

}

/**
 * Mobile Social icon header
 *
 * @package traveler_blog_lite
 * @since 1.0
 */
function traveler_blog_lite_get_header_social_icon() {

		$facebook 		= traveler_blog_lite_get_theme_mod( 'facebook' ); 
		$twitter 		= traveler_blog_lite_get_theme_mod( 'twitter' );
		$linkedin 		= traveler_blog_lite_get_theme_mod( 'linkedin' );
		$behance 		= traveler_blog_lite_get_theme_mod( 'behance' );   
		$dribbble 		= traveler_blog_lite_get_theme_mod( 'dribbble' );
		$instagram 		= traveler_blog_lite_get_theme_mod( 'instagram' );
		$youtube 		= traveler_blog_lite_get_theme_mod( 'youtube' );
		$pinterest      = traveler_blog_lite_get_theme_mod( 'pinterest' );
		

     	if(!empty($facebook) ) { ?>   
	            <a href="<?php echo esc_url($facebook); ?>" title="<?php esc_attr_e('Facebook','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-facebook-icon"><i class="fa fa-facebook"></i></a>
	    <?php } 
	    if(!empty($twitter) ) { ?>  
	            <a href="<?php echo esc_url($twitter); ?>" title="<?php esc_attr_e('Twitter','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-twitter-icon"><i class="fa fa-twitter"></i></a>
	    <?php } 
	    if(!empty($linkedin) ) { ?> 
	            <a href="<?php echo esc_url($linkedin); ?>" title="<?php esc_attr_e('LinkedIn','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-linkedin-icon"><i class="fa fa-linkedin"></i></a>
	    <?php } 
	    if(!empty($youtube)) { ?>       
	            <a href="<?php echo esc_url($youtube); ?>" title="<?php esc_attr_e('YouTube','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-youtube-icon"><i class="fa fa-youtube"></i></a>             
	    <?php } 
	    if(!empty($instagram) ) { ?>        
	            <a href="<?php echo esc_url($instagram); ?>" title="<?php esc_attr_e('Instagram','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-instagram-icon"><i class="fa fa-instagram"></i></a>             
	    <?php } 
	    if(!empty($behance) ) { ?>      
	            <a href="<?php echo esc_url($behance); ?>" title="<?php esc_attr_e('Behance','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-behance-icon"><i class="fa fa-behance"></i></a>             
	    <?php } 
	    if(!empty($dribbble) ) { ?>     
	            <a href="<?php echo esc_url($dribbble); ?>" title="<?php esc_attr_e('Dribbble','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-dribbble-icon"><i class="fa fa-dribbble"></i></a>             
	    <?php }
	    if(!empty($pinterest) ) { ?>      
                <a href="<?php echo esc_url($pinterest); ?>" title="<?php esc_attr_e('Pinterest','traveler-blog-lite'); ?>" target="_blank" class="wpiclt-sn-icon wpiclt-pinterest-icon"><i class="fa fa-pinterest"></i></a>             
	    <?php }

}

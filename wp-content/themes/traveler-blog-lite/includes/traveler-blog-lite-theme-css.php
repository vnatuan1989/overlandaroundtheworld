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
 * Add css to head 
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_theme_dynemic_css() {	

	// Menu bar Bg Color
	$menu_bar_bg_clr = traveler_blog_lite_get_theme_mod( 'menu_bar_bg_clr' );
	 
	// Action to add theme dynemic CSS	// Menu bar Link Color
	$menu_bar_link_clr = traveler_blog_lite_get_theme_mod( 'menu_bar_link_clr' );
	
	// Menu bar Link Hover Color
	$menu_bar_linkh_clr = traveler_blog_lite_get_theme_mod( 'menu_bar_linkh_clr' );
	 
	// Heading Color
	$h1_clr = traveler_blog_lite_get_theme_mod( 'h1_clr' );
	$h2_clr = traveler_blog_lite_get_theme_mod( 'h2_clr' );
	$h3_clr = traveler_blog_lite_get_theme_mod( 'h3_clr' );
	$h4_clr = traveler_blog_lite_get_theme_mod( 'h4_clr' );
	$h5_clr = traveler_blog_lite_get_theme_mod( 'h5_clr' );
	$h6_clr = traveler_blog_lite_get_theme_mod( 'h6_clr' );	
	
	// Link Color
	$link_clr = traveler_blog_lite_get_theme_mod( 'link_clr' );
	 
	// Link Hover Color
	$hover_link_clr = traveler_blog_lite_get_theme_mod( 'hover_link_clr' );	

	//read more button
	$continue_read_clr 	= traveler_blog_lite_get_theme_mod( 'continue_read_clr' );
	$continue_read_hvr_clr 	= traveler_blog_lite_get_theme_mod( 'continue_read_hvr_clr' );

?>

<style>
.header-content,.main-navigation ul#primary-menu ul{background: <?php echo esc_attr($menu_bar_bg_clr); ?>; }
.main-navigation ul ul li{border-bottom:<?php echo esc_attr($menu_bar_bg_clr); ?>; }

.main-navigation ul li a,.main-navigation ul li ul a{color:<?php echo esc_attr($menu_bar_link_clr); ?>;}
.header-search .search-field:focus, .header-search .search-field:active{color:<?php echo esc_attr($menu_bar_link_clr); ?>;}

.main-navigation ul ul.sub-menu a:hover{background:  <?php echo esc_attr($menu_bar_bg_clr); ?>;}
.main-navigation .current-menu-item a, .header-content .traveler-blog-lite-sn a:hover, .header-content .traveler-blog-lite-sn a:focus, .header-content .traveler-blog-lite-sn a:active{color:<?php echo esc_attr($menu_bar_linkh_clr); ?>;} 
.main-navigation a:hover, .main-navigation .current-menu-item .children a:hover, .main-navigation .current-menu-item .sub-menu a:hover { color: <?php echo esc_attr($menu_bar_linkh_clr); ?>;}

.entry-content .link-more a.more-link{	color: <?php echo esc_attr($continue_read_clr); ?>}
.entry-content .link-more a.more-link:hover,.site-content .hentry.format-quote a.more-link:hover{color: <?php echo esc_attr($continue_read_hvr_clr); ?>;}
.widget ul li a{color: <?php echo esc_attr($link_clr); ?>;}
.widget ul li a:hover{color: <?php echo esc_attr($hover_link_clr); ?>;}
h1,h1.entry-title{	color: <?php echo esc_attr($h1_clr); ?>;}
h2, h2.page-title, h2.entry-title a:link, h2 a, h2 a:visited{	color: <?php echo esc_attr($h2_clr); ?>;}
h2.entry-title a:hover, .site-content a:hover, .site-content a:active, .site-content .hentry.format-quote a:hover{color: <?php echo esc_attr($hover_link_clr); ?>;}
h3, footer h3{color: <?php echo esc_attr($h3_clr); ?>;}
h4{	color: <?php echo esc_attr($h4_clr); ?>;}
h5{	color: <?php echo esc_attr($h5_clr); ?>;}
h6{	color: <?php echo esc_attr($h6_clr); ?>;}

</style>
<?php }
// Action to add theme dynemic CSS
add_action( 'wp_head', 'traveler_blog_lite_theme_dynemic_css' );
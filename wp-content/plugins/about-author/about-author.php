<?php
/**
* Plugin Name: About Author
* Version: 1.3.3
* Description: Display Blog Author Information In Style
* Author: Weblizar
* Author URI: https://weblizar.com/plugins/about-author-pro/
* Plugin URI: https://weblizar.com/plugins/about-author-pro/
*/

define("WEBLIZAR_ABOUT_ME_PLUGIN_URL", plugin_dir_url(__FILE__));
define('WL_ABTM_TXT_DM', 'WL_ABTM_TXT_DM');
add_filter( 'widget_text', 'do_shortcode' );

add_action( 'plugins_loaded', 'WL_ABTM_TXT_DM' );
/**
 * Load plugin textdomain.
 */
function WL_ABTM_TXT_DM() {
	load_plugin_textdomain( 'WL_ABTM_TXT_DM', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action('admin_menu', 'aa_submenu_settings_page');
function aa_submenu_settings_page() {
	add_submenu_page('edit.php?post_type=about_author', 'Author Settings', 'Author Settings', 'administrator', 'author-settings', 'author_settings_function');
	add_submenu_page('edit.php?post_type=about_author', 'Help and Support', 'Help and Support', 'administrator', 'help-and-support', 'about_author_help_suppot_function');
	add_submenu_page('edit.php?post_type=about_author', 'Recommendation', 'Recommendation', 'administrator', 'weblizar-plugin-recommendation', 'weblizar_plugin_recommendation');
}

add_action( 'admin_enqueue_scripts', 'aa_color_picker' );
function aa_color_picker( $hook ) {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker');
}
function about_author_help_suppot_function() {
	require_once("help-and-support.php");
}

function weblizar_plugin_recommendation(){
	//css
	wp_enqueue_style('rp-recom-css', WEBLIZAR_ABOUT_ME_PLUGIN_URL.'css/recom.css');
	require_once("recommendations.php");
}

function author_settings_function() {
	require_once("author-settings.php");
}

// Add settings link on plugin page
function author_settings_link($links, $author_plugin_file) {
	static $author_plugin_name;
	if (!isset($author_plugin_name))
		$author_plugin_name = plugin_basename(__FILE__); 
	if ($author_plugin_name == $author_plugin_file) {
		$author_settings_link = array('Settings' => '<a href="edit.php?post_type=about_author&page=author-settings">' . __('Settings', 'General') . '</a>');
		$author_pro_link = array('Get Pro' => '<a style="font-weight:700; color:#e35400" href="https://weblizar.com/plugins/about-author-pro/" target="_blank">Go Pro</a>');
		$links = array_merge($author_settings_link, $links);
		$links = array_merge($author_pro_link, $links);
	}
	return $links;
}
add_filter( 'plugin_action_links', 'author_settings_link', 10, 5 );

class About_Author_Shorcode_And_Widget
{
	public function __construct() {
		if (is_admin()) {
			add_action('init', array(&$this, 'AboutmeShortcode'));
			add_action('add_meta_boxes', array(&$this, 'Add_all_About_m_e_meta_boxes'),1);
			add_action('admin_enqueue_scripts', array(&$this,'my_about_me_style_files'),1);
			add_action('about_me_save_post', array(&$this, 'About_me_Save_Settings'),1);
			add_action('save_post', array(&$this, 'Abt_Save_fag_meta_box_save'), 9, 1);
		}
	}

	public function my_about_me_style_files($hook) {
		if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php') {
			return;
		}
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('theme-preview');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('upload_media_widget', WEBLIZAR_ABOUT_ME_PLUGIN_URL .'js/upload-media.js', array('jquery'));
		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

			
		// code-mirror css & js for custom css section
		wp_enqueue_style('author_codemirror-css', WEBLIZAR_ABOUT_ME_PLUGIN_URL.'css/codemirror/codemirror.css');
		wp_enqueue_style('author_blackboard', WEBLIZAR_ABOUT_ME_PLUGIN_URL.'css/codemirror/blackboard.css');
		wp_enqueue_style('author_show-hint-css', WEBLIZAR_ABOUT_ME_PLUGIN_URL.'css/codemirror/show-hint.css');
		
		wp_enqueue_script('author_codemirror-js',WEBLIZAR_ABOUT_ME_PLUGIN_URL.'css/codemirror/codemirror.js',array('jquery'));
		wp_enqueue_script('author_css-js',WEBLIZAR_ABOUT_ME_PLUGIN_URL.'css/codemirror/aa-css.js',array('jquery'));
		wp_enqueue_script('author_css-hint-js',WEBLIZAR_ABOUT_ME_PLUGIN_URL.'css/codemirror/css-hint.js',array('jquery'));
	}

	// Register Custom Post Type
	public function AboutmeShortcode() {
		$labels = array (
			'name' 					=> 'About Author',
			'singular_name' 		=> 'About Author',
			'menu_name' 			=> 'About Author',
			'add_new' 				=> 'Add New',
			'add_new_item' 			=> 'Add New',
			'edit_item' 			=>'Edit About Author',
			'new_item' 				=> 'New About Author',
			'view_item' 			=> 'View About Author',
			'search_items' 			=> 'Search About Author',
			'not_found' 			=> 'No About Author Shortcode Found',
			'not_found_in_trash' 	=> 'No About Author Shortcode in Trash',
			'parent_item_colon' 	=> 'Parent About Author:',
			'all_items' 			=> 'All Shortcodes',
		);

		$args = array(
			'labels' 			=> $labels,
			'hierarchical' 		=> false,
			'supports' 			=> array( 'title'),
			'public' 			=> false,
			'show_ui' 			=> true,
			'show_in_menu' 		=> true,
			'menu_position' 	=> 65,
			'menu_icon' 		=> 'dashicons-id',
			'show_in_nav_menus' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'has_archive' 		=> true,
			'query_var' 		=> true,
			'can_export' 		=> true,
			'rewrite' 			=> false,
			'capability_type' 	=>'post'
		);
		register_post_type( 'about_author', $args );
		add_filter( 'manage_edit-about_author_columns', array(&$this, 'about_author_columns' )) ;
		add_action( 'manage_about_author_posts_custom_column', array(&$this, 'about_author_manage_columns' ), 10, 2 );
	}

	function about_author_columns( $columns ){
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'About Author' ),
			'shortcode' => __( 'About Author Shortcode' ),
			'date' => __( 'Date' )
			);
		return $columns;
	}

	function about_author_manage_columns( $column, $post_id ){
		global $post;
		switch( $column ) {
			case 'shortcode' :
			echo '<input type="text" value="[ABTM id='.$post_id.']" readonly="readonly" />';
			break;
			default :
			break;
		}
	}

    //add metaboxes
	public function Add_all_About_m_e_meta_boxes() {
		add_meta_box( __(' Add Images', 'WL_ABTM_TXT_DM'), __('Select Template', 'WL_ABTM_TXT_DM'), array(&$this, 'about_me_meta_box_setting_function'), 'about_author', 'normal', 'low' );
		add_meta_box ( __('Add Settings', 'WL_ABTM_TXT_DM'), __('Add settings', 'WL_ABTM_TXT_DM'), array(&$this, 'me_meta_box_setting_function'), 'about_author', 'normal', 'low');
		add_meta_box ( __('Copy Shortcode', 'WL_ABTM_TXT_DM'), __('Copy Shortcode', 'WL_ABTM_TXT_DM'), array(&$this, 'ABTM_shotcode_meta_box_function'), 'about_author', 'side', 'low');
		add_meta_box(__('UpgradetoAboutAuthorPro','WL_ABTM_TXT_DM') , __('About Author Pro', 'WL_ABTM_TXT_DM'), array(&$this,'abtm_about_author_pro_meta_box'), 'about_author', 'side', 'low');
		add_meta_box ( __('Preview Shortcode', 'WL_ABTM_TXT_DM'), __('Preview Shortcode', 'WL_ABTM_TXT_DM'), array(&$this, 'ab_preview_box'), 'about_author', 'side', 'low');
		add_meta_box(__('Activate About Author Widget','WL_ABTM_TXT_DM') , __('Activate About Author Widget', 'WL_ABTM_TXT_DM'), array(&$this,'abtm_use_widget_meta_box'), 'about_author', 'side', 'low');
		
	}

	//add setting page of general settings
	public function about_me_meta_box_setting_function($post) {
		require("settings/template-settings.php");
	}
	public function me_meta_box_setting_function($post) {
		require("settings/general-settings.php");
	}

    //display short code on custom post type page
	public function ABTM_shotcode_meta_box_function() { ?>
	<p><?php _e("Use below shortcode in any Page/Post to publish your author information", 'WL_ABTM_TXT_DM');?></p>
	<input readonly="readonly" type="text" value="<?php echo "[ABTM id=".get_the_ID()."]"; ?>">
	<?php
}

public function ab_preview_box() {
	if(isset($_REQUEST['post'])) {
		echo '
		<div style="text-align:center;padding:10px 0;">
			<h3>Click here to preview</h3>
			<input alt="#TB_inline?height=700&amp;width=750&amp;inlineId=A_B_t_Popup1" title="About Author shortcode and widget preview" class="button-primary thickbox" type="button" value="Preview" />
		</div>
		';
		$ABT=$_REQUEST['post'];
		echo '
		<div id="A_B_t_Popup1"  style="width:100%;height:100%;display:none"> <h2>Preview</h2>'.do_shortcode( '[ABTM id="'.$ABT.'"]').'</div>';
	} else  {
		echo "<h4>Please save first to check preview.</h4> ";
	}
}

public function abtm_use_widget_meta_box() { ?>
	<div>
		<p><?php _e('To activate widget into any widget area', 'WL_ABTM_TXT_DM' ); ?></p>
		<p align="center"><a class="button button-primary button-hero" href="<?php get_site_url();?>./widgets.php" ><?php _e('Click Here', 'WL_ABTM_TXT_DM' ); ?></a> </p>
		<p><?php _e('Find', 'WL_ABTM_TXT_DM' ); ?> <b>About Author Widget</b> <?php _e('Place it to your widget area. Select any About Author Shortcode from the dropdown and save widget.', 'WL_ABTM_TXT_DM' ); ?></p>
	</div>
	<?php
}

public function abtm_about_author_pro_meta_box(){
	wp_enqueue_style('author_dashboard-css', WEBLIZAR_ABOUT_ME_PLUGIN_URL.'css/dashboard.css');
	$imgpath = WEBLIZAR_ABOUT_ME_PLUGIN_URL."settings/images/aatp.jpg";
	?>
	 <div class="">          
            <div class="update_pro_button"><a target="_blank" href="https://weblizar.com/plugins/about-author-pro/">Buy Now $15</a></div> 
                <div class="update_pro_image">
                    <img class="aatp_getpro img-responsive" src="<?php echo $imgpath; ?>">
                </div>
            <div class="update_pro_button">
                <a class="upg_anch" target="_blank" href="https://weblizar.com/plugins/about-author-pro/">Buy Now $15</a>
            </div>
        </div>
	<?php
}

//save data in database
public function Abt_Save_fag_meta_box_save($PostID) {
	if(isset($_POST['About_me_user_name']) && isset($_POST['About_me_web_site_name'])) {
		$profile_user_image = sanitize_text_field($_POST['profile_user_image']);
		$user_header_image = sanitize_text_field($_POST['user_header_image']);
		$About_me_bg_color =  sanitize_text_field($_POST['About_me_bg_color']);
		$About_me_user_name = stripslashes_deep($_POST['About_me_user_name']);
		$About_me_user_name=str_replace("\\", "",$About_me_user_name);
		$About_me_web_site_name =  sanitize_text_field($_POST['About_me_web_site_name']);
		$About_me_dis_cription =  stripslashes_deep($_POST['About_me_dis_cription']);
		$About_me_dis_cription=str_replace("\\", "",$About_me_dis_cription);
		$followfb =  sanitize_text_field($_POST['followfb']);
		$followgoogle =  sanitize_text_field($_POST['followgoogle']);
		$followinsta =  sanitize_text_field($_POST['followinsta']);
		$followlinkdln =  sanitize_text_field($_POST['followlinkdln']);
		$followpint =  sanitize_text_field($_POST['followpint']);
		$followtwit =  sanitize_text_field($_POST['followtwit']);
		$bodr =  sanitize_text_field($_POST['bodr']);
		$img_bdr_type = sanitize_text_field($_POST['img_bdr_type']);
		$bdr_size = sanitize_text_field($_POST['bdr_size']);
		$img_bdr_color = sanitize_text_field($_POST['img_bdr_color']);
		$name_font_size = sanitize_text_field($_POST['name_font_size']);
		$name_Color = sanitize_text_field($_POST['name_Color']);
		$weblink_font_size = sanitize_text_field($_POST['weblink_font_size']);
		$weblink_text_color = sanitize_text_field($_POST['weblink_text_color']);
		$dis_font_size = sanitize_text_field($_POST['dis_font_size']);
		$dis_text_color = sanitize_text_field($_POST['dis_text_color']);
		$PGPP_Font_Style = sanitize_text_field($_POST['PGPP_Font_Style']);
		$About_me_social_color =sanitize_text_field($_POST['About_me_social_color']);
		$About_me_custom_css = sanitize_text_field($_POST['About_me_custom_css']);
		$Tem_pl_at_e = sanitize_text_field($_POST['Tem_pl_at_e']);
		$Social_icon_size = sanitize_text_field($_POST['Social_icon_size']);

		$ABTArray[] = array(
			'About_me_bg_color' => $About_me_bg_color,
			'About_me_user_name' => $About_me_user_name,
			'About_me_web_site_name' => $About_me_web_site_name,
			'About_me_dis_cription' => $About_me_dis_cription,
			'followfb' => $followfb,
			'followgoogle' => $followgoogle,
			'followinsta' => $followinsta,
			'followlinkdln' =>$followlinkdln,
			'followpint' =>$followpint,
			'followtwit' =>$followtwit,
			'bodr' =>$bodr,
			'img_bdr_type' =>$img_bdr_type,
			'bdr_size' =>$bdr_size,
			'img_bdr_color' =>$img_bdr_color,
			'name_font_size' =>$name_font_size,
			'name_Color' =>$name_Color,
			'weblink_font_size' =>$weblink_font_size,
			'weblink_text_color' =>$weblink_text_color,
			'dis_font_size' =>$dis_font_size,
			'dis_text_color' =>$dis_text_color,
			'PGPP_Font_Style' =>$PGPP_Font_Style,
			'profile_user_image' =>$profile_user_image,
			'user_header_image' =>$user_header_image,
			'About_me_social_color' =>$About_me_social_color,
			'About_me_custom_css' =>$About_me_custom_css,
			'Tem_pl_at_e' =>$Tem_pl_at_e,
			'Social_icon_size' =>$Social_icon_size,
			);
		$abt_Settings = "abt_Settings_".$PostID;
		update_post_meta($PostID, $abt_Settings, serialize($ABTArray));
	}
}
} // end of class

//create object of About_Author_Shorcode_And_Widget class
global $About_Author_Shorcode_And_Widget;
$About_Author_Shorcode_And_Widget = new About_Author_Shorcode_And_Widget();

//include short code file
require_once("about-author-use-shortcode.php");

// include widget code file
require_once("about-author-widget-code.php");
add_action('media_buttons_context', 'aa_add_rpg_custom_button');
add_action('admin_footer', 'aa_add_rpg_inline_popup_content');

//add media button fuction
function aa_add_rpg_custom_button($context) {
	$container_id = 'AMSA';
	$title =  __('Select About Author Shortcode to insert with content','WL_ABTM_TXT_DM') ;
	$context = '<a class="button button-primary thickbox"  title="'. __("Select About Author Shortcode to insert into content",'WL_ABTM_TXT_DM').'"
	href="#TB_inline?width=400&inlineId='.$container_id.'">
	'. __("About Author Shortcode And Widget","'WL_ABTM_TXT_DM'").'
	</a>';
	return $context;
}

function aa_add_rpg_inline_popup_content() { ?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#Ab_tm_insert').on('click', function() {
				var id = jQuery('#Ab_Tm_ME option:selected').val();
				window.send_to_editor('<p>[ABTM id=' + id + ']</p>');
				tb_remove();
			})
		});
	</script>
	<div id="AMSA" style="display:none;">
		<?php $all_posts = wp_count_posts( 'about_author')->publish;
		if(!$all_posts==null) {?>
		<h3><?php _e('Select About Author Shortcode And Widget To Insert Into Post','WL_ABTM_TXT_DM');?></h3>
		<select id="Ab_Tm_ME">
			<?php
			global $wpdb;
			$A_B_T_shortcodegallerys = $wpdb->get_results("SELECT post_title, ID FROM $wpdb->posts WHERE post_status = 'publish'	AND post_type='about_author' ");
			foreach ($A_B_T_shortcodegallerys as $A_B_T_shortcodegallery) {
				if($A_B_T_shortcodegallery->post_title) { $title_var=$A_B_T_shortcodegallery->post_title;} else { $title_var="(no title)"; }
				echo "<option value='".$A_B_T_shortcodegallery->ID."'>".$title_var."</option>";
			} ?>
		</select>
		<button class='button primary' id='Ab_tm_insert'><?php _e('Insert About Author Shortcode','WL_ABTM_TXT_DM');?></button>
		<?php } else { ?>
			<h1 align="center"> No About Author Shortcode Found </h1><?php
		}
		?>
	</div>
	<?php
}

function fb_add_custom_user_profile_fields( $user ) { ?>
	<h3><?php _e('Social Profile Information', 'your_textdomain'); ?></h3>
	<table class="form-table">
		<tr>
			<th>
				<label><a target="_blank" style="text-decoration: none;"><i class="fa fa-facebook web_lizar_Social_icon"></i></a>Facebook</label>
			</th>
			<td><input id="followfb" name="followfb" type="text" value="<?php echo esc_attr( get_the_author_meta( 'followfb', $user->ID ) ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th>
				<label><a target="_blank" style="text-decoration: none;"><i class="fa fa-twitter web_lizar_Social_icon"></i></a>Twitter</label>
			</th>
			<td><input id="followtwit" name="followtwit" type="text" value="<?php echo esc_attr( get_the_author_meta( 'followtwit', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th>
				<label><a target="_blank" style="text-decoration: none;"><i class="fa fa-google-plus  web_lizar_Social_icon"  ></i></a> Google</label>
			</th>
			<td>
				<input id="followgoogle" name="followgoogle" type="text"   value="<?php echo esc_attr( get_the_author_meta( 'followgoogle', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th>
				<label><a target="_blank" style="text-decoration: none;"> <i class="fa fa-linkedin web_lizar_Social_icon"></i></a>LinkedIn</label>
			</th>
			<td>
				<input id="followlinkdln" name="followlinkdln" type="text"  value="<?php echo esc_attr( get_the_author_meta( 'followlinkdln', $user->ID ) ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th>
				<label><a target="_blank" style="text-decoration: none;"><i class="fa fa-instagram web_lizar_Social_icon" ></i></a> Instagram</label>
			</th>
			<td>
				<input id="followinsta" name="followinsta" type="text" value="<?php echo esc_attr( get_the_author_meta( 'followinsta', $user->ID ) ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th>
				<label><a target="_blank" style="text-decoration: none;"><i class="fa fa-pinterest web_lizar_Social_icon" ></i></a> Instagram</label>
			</th>
			<td>
				<input id="followpint" name="followpint" type="text" value="<?php echo esc_attr( get_the_author_meta( 'followpint', $user->ID ) ); ?>" class="regular-text" />
			</td>
		</tr>
	</table>
	<?php
}

function fb_save_custom_user_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;
	$metas = array(
		'followfb' =>sanitize_text_field($_POST['followfb']),
		'followgoogle' =>sanitize_text_field($_POST['followgoogle']),
		'followinsta' =>sanitize_text_field($_POST['followinsta']),
		'followlinkdln' =>sanitize_text_field($_POST['followlinkdln']),
		'followtwit' =>sanitize_text_field($_POST['followtwit']),
		'followpint' =>sanitize_text_field($_POST['followpint']),
		);
	foreach($metas as $key => $value) {
		update_user_meta( $user_id, $key, $value );
	}
}

add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );

function load_author_info_after_page_content($content) {
	if (!is_single()  && get_post_type( $post = get_post() ) == "page") {
		$ABio_settings = unserialize(get_option('author_info_Settings'));
		$use_page=$ABio_settings[0]['Author_short_code'];
		$switch_off_page = $ABio_settings[0]['switch_off_page'];
		if($switch_off_page=='yes') {
			if($use_page) {
				$content .= do_shortcode( '[ABINFO id='. $use_page.']' );
			}
		}
	}
	return $content;
}
add_filter( "the_content", "load_author_info_after_page_content", 20 );

function load_author_info_after_post_content($content){
	if (is_single() && get_post_type( $post = get_post() ) == "post") {
		$ABio_settings = unserialize(get_option('author_info_Settings'));
		$use_page=$ABio_settings[0]['Author_short_code'];
		$switch_off_post = $ABio_settings[0]['switch_off_post'];
		if($switch_off_post=='yes') {
			if($use_page) {
				$content .= do_shortcode( '[ABINFO id='. $use_page.']' );
			}
		}
	}
	return $content;
}
add_filter( "the_content", "load_author_info_after_post_content", 20);
require_once("author-setting/about-author-use-shortcode2.php");

// Review Notice Box
add_action( "admin_notices", "review_admin_notice_aatp_free" );
function review_admin_notice_aatp_free() {
	global $pagenow;
	$aatp_screen = get_current_screen();
	if ( $pagenow == 'edit.php' && $aatp_screen->post_type == "about_author" ) {
		include( 'aatp-banner.php' );
	}
}

?>
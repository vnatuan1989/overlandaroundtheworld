<?php
if(isset($_POST['submit'])) {
	$Author_short_code = sanitize_text_field($_POST['Author_short_code']);
	$switch_off_name = sanitize_text_field($_POST['switch_off_name']);
	$switch_off_web = sanitize_text_field($_POST['switch_off_web']);
	$switch_off_bio_info = sanitize_text_field($_POST['switch_off_bio_info']);
	$switch_off_page = sanitize_text_field($_POST['switch_off_page']);
	$switch_off_post = sanitize_text_field($_POST['switch_off_post']);
	$auther_lbl_text = stripslashes($_POST['auther_lbl_text']);
	$Author_bg_color = sanitize_text_field($_POST['Author_bg_color']);
	$Author_Color = sanitize_text_field($_POST['Author_Color']);
	$auther_lbl_text_font = sanitize_text_field($_POST['auther_lbl_text_font']);
	$Author_PGPP_Font_Style = sanitize_text_field($_POST['Author_PGPP_Font_Style']);

	$ABio_Array[] = array(
		'Author_short_code' => $Author_short_code,
		'switch_off_name' => $switch_off_name,
		'switch_off_web' => $switch_off_web,
		'switch_off_bio_info' => $switch_off_bio_info,
		'switch_off_page' => $switch_off_page,
		'switch_off_post' => $switch_off_post,
		'auther_lbl_text' => $auther_lbl_text,
		'Author_bg_color' => $Author_bg_color,
		'Author_Color' => $Author_Color,
		'auther_lbl_text_font' => $auther_lbl_text_font,
		'Author_PGPP_Font_Style' => $Author_PGPP_Font_Style,
	);
	update_option('author_info_Settings', serialize($ABio_Array));
}

$ABio_settings = unserialize(get_option('author_info_Settings'));
if(count($ABio_settings[0])) {
	$Author_short_code = $ABio_settings[0]['Author_short_code'];
	$switch_off_name = $ABio_settings[0]['switch_off_name'];
	$switch_off_web = $ABio_settings[0]['switch_off_web'];
	$switch_off_bio_info = $ABio_settings[0]['switch_off_bio_info'];
	$switch_off_page = $ABio_settings[0]['switch_off_page'];
	$switch_off_post = $ABio_settings[0]['switch_off_post'];

	if(isset($ABT_Settings[0]['auther_lbl_text'])){
		$auther_lbl_text = $ABT_Settings[0]['auther_lbl_text'];
	}else{
		$auther_lbl_text = "Author Bio";
	}


	if(isset($ABT_Settings[0]['auther_lbl_text_font'])){
		$auther_lbl_text_font = $ABT_Settings[0]['auther_lbl_text_font'];
	}else{
		$auther_lbl_text_font = "";
	}

	
	$Author_bg_color = $ABio_settings[0]['Author_bg_color'];
	$Author_Color = $ABio_settings[0]['Author_Color'];
	
	$Author_PGPP_Font_Style = $ABio_settings[0]['Author_PGPP_Font_Style'];
}
?>
<script>
jQuery(document).ready(function() {
	jQuery('input.my-color-picker').wpColorPicker();
});
function outputUpdate(vol) {
	jQuery("span.volum").text(vol);
}
</script>
<style>
.lbl {
	float:left;
	width:100%;
	margin-right:0.7em;
	padding-top:0.3em;
	padding-bottom:0.3em;
	text-align:center;
	font-weight:bold;background-color:#00b9eb;font-size:20px;
	color:white;
}
.slidecontainer {
		width: 100%;
	}

.slider {
    -webkit-appearance: none;
    margin-bottom: 10px;
    width: 30% !important;
    height: 15px;
    border-radius: 5px;   
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%; 
    background: #00b9eb;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}
</style>
<div class="row-fluid pricing-table pricing-three-column" style="margin-top: 10px; display:block; width:100%; overflow:hidden; background:white; box-shadow: 0 0 5px hsla(0, 0%, 20%, 0.3);padding-bottom:70px">
	<form method="post" action="">
		<div class="plan-name" style="margin-top:20px;text-align: center;">
			<h2 style="font-weight: bold;font-size: 36px;padding-top: 30px;padding-bottom: 10px;color:#D9534F;"><?php _e('Author Settings', 'WL_ABTM_TXT_DM' ); ?></h2>
		</div>
		<table class="form-table" style="margin-left:20px; width: 98%;"  >
			<tr><td colspan="2"><label class="lbl"> <?php _e('Display Author Settings', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
			<tr>
				<?php if(!isset($switch_off_page)) { $switch_off_page = "yes"; }?>
				<th><?php _e('On page', 'WL_ABTM_TXT_DM' ); ?></th>
				<td>
					<input type="radio" name="switch_off_page" id="switch_off_page" value="yes" <?php checked( 'yes', $switch_off_page ); ?> ><?php _e('Yes', 'WL_ABTM_TXT_DM' ); ?>
					<input type="radio" name="switch_off_page" id="switch_off_page" value="no" <?php checked( 'no', $switch_off_page ); ?>><?php _e('No', 'WL_ABTM_TXT_DM' ); ?>
				</td>
			</tr>
				<?php if(!isset($switch_off_post)) { $switch_off_post = "yes"; }?>
				<th><?php _e('On post', 'WL_ABTM_TXT_DM' ); ?></th>
				<td><input type="radio" name="switch_off_post" id="switch_off_post" value="yes" <?php checked( 'yes', $switch_off_post ); ?> ><?php _e('Yes', 'WL_ABTM_TXT_DM' ); ?>
					<input type="radio" name="switch_off_post" id="switch_off_post" value="no" <?php checked( 'no', $switch_off_post ); ?>><?php _e('No', 'WL_ABTM_TXT_DM' ); ?></td>
				</tr>
				<tr>
					<td colspan="2"><label class="lbl"><?php _e('Select Template Style', 'WL_ABTM_TXT_DM' ); ?></label></td>
				</tr>
				<?php if(!isset($Author_short_code)) { $Author_short_code = "1"; }?>
				<?php	$ABT_CPT_Name = "about_author";
				$ABT_All_Posts = wp_count_posts( $ABT_CPT_Name )->publish;
				global $All_ABTM;
				$All_ABTM = array('post_type' => $ABT_CPT_Name, 'orderby' => 'ASC', 'posts_per_page' => $ABT_All_Posts);
				$All_ABTM = new WP_Query( $All_ABTM );
				?>
			<tr>
				<th><?php _e('Choose one', 'WL_ABTM_TXT_DM' ); ?></th>
				<td>
					<select id="Author_short_code" name="Author_short_code">
						<option value="1">Select Any Shortcode</option>
						<?php
						if( $All_ABTM->have_posts() ) {	 ?>
							<?php
							while ( $All_ABTM->have_posts() ) : $All_ABTM->the_post();
							$PostId = get_the_ID();
							$PostTitle = get_the_title($PostId);
							?>
							<option value="<?php echo $PostId; ?>" <?php if($Author_short_code==$PostId) echo 'selected="selected"'; ?>><?php if($PostTitle) echo $PostTitle; else _e("No Title", WL_ABTM_TXT_DM); ?></option>
							<?php endwhile; ?>
						<?php
							} else  {
								echo "<option>Sorry! No Author Shortcode Created Yet.</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><label class="lbl"><?php _e('Display On Post OR Page', 'WL_ABTM_TXT_DM' ); ?></label></td>
			</tr>
			<tr>
				<th><?php _e('Name', 'WL_ABTM_TXT_DM' ); ?></th>
				<?php if(!isset($switch_off_name)) { $switch_off_name = "yes"; }?>
				<td><input type="radio" name="switch_off_name" id="switch_off_name" value="yes" <?php checked( 'yes', $switch_off_name ); ?> ><?php _e('Yes', 'WL_ABTM_TXT_DM' ); ?>
				<input type="radio" name="switch_off_name" id="switch_off_name" value="no" <?php checked( 'no', $switch_off_name ); ?>><?php _e('No', 'WL_ABTM_TXT_DM' ); ?></td>
			</tr>
			<tr>
				<th><?php _e('Website Name', 'WL_ABTM_TXT_DM' ); ?></th>
				<td>
					<?php if(!isset($switch_off_web)) { $switch_off_web = "yes"; }?>
					<input type="radio" name="switch_off_web" id="switch_off_web" value="yes" <?php checked( 'yes', $switch_off_web ); ?> ><?php _e('Yes', 'WL_ABTM_TXT_DM' ); ?>
					<input type="radio" name="switch_off_web" id="switch_off_web" value="no" <?php checked( 'no', $switch_off_web ); ?> > <?php _e('No', 'WL_ABTM_TXT_DM' ); ?>
				</td>
			</tr>
			<tr>
				<th><?php _e('Biographical Info', 'WL_ABTM_TXT_DM' ); ?></th>
				<td>
					<?php if(!isset($switch_off_bio_info)) { $switch_off_bio_info = "yes"; }?>
					<input type="radio" name="switch_off_bio_info" id="switch_off_bio_info" value="yes" <?php checked( 'yes', $switch_off_bio_info ); ?>><?php _e('Yes', 'WL_ABTM_TXT_DM' ); ?>
					<input type="radio" name="switch_off_bio_info" id="switch_off_bio_info" value="no" <?php checked( 'no', $switch_off_bio_info ); ?>><?php _e('No', 'WL_ABTM_TXT_DM' ); ?>
				</td>
			</tr>
			<tr>
				<tr><td colspan="2"><label class="lbl"><?php _e('Author label settings', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
				<tr>
					<th><?php _e('Author label text', 'WL_ABTM_TXT_DM' ); ?></th>
					<?php if(!isset($auther_lbl_text)) { $auther_lbl_text = "Author Bio"; }?>
					<td>	<input type="text" name="auther_lbl_text" id="auther_lbl_text" value="<?php echo esc_attr($auther_lbl_text); ?>"/></td>
				</tr>

				<tr>
					<th><label><?php _e('Font size', 'WL_ABTM_TXT_DM' ); ?></label></th>
					<td>
						<input  type="range" class="slider" min="12" max="32" step="1" value="<?php if(!isset($auther_lbl_text_font)) { echo  esc_attr($auther_lbl_text_font = "20"); } else { echo esc_attr($auther_lbl_text_font); } ?>" data-orientation="vertical" id="auther_lbl_text_font"name="auther_lbl_text_font"  oninput="outputUpdate(value);" />
						<span style="width: 25px; height: 30px; margin:auto; display: inline-block; border: 2px solid gray; vertical-align: middle; border-radius: 8px; background-color:#FFFFFF;text-align:center;font-size:20px;margin-left:20px;margin-bottom:20px;" id="auther_lbl_text_font" name="auther_lbl_text_font" class="volum" ><?php echo esc_attr($auther_lbl_text_font); ?><span>
					</td>
				</tr>
				<tr>
					<th><label ><?php _e('Background Color', 'WL_ABTM_TXT_DM' ); ?> </label> </th>
					<td>
						<p><input  type="text" class="my-color-picker" id="Author_bg_color" name="Author_bg_color" value="<?php if(!isset($Author_bg_color)) {	echo esc_attr($Author_bg_color = "#dd3333"); 	} else { echo esc_attr($Author_bg_color); }?>"/><p>
					</td>
				</tr>
				<tr>
					<th><label><?php _e('Font Color', 'WL_ABTM_TXT_DM' ); ?></label></th>
					<td><p><input class="my-color-picker" id="Author_Color" name="Author_Color" type="text"  value="<?php 	if(!isset($Author_Color)) { echo esc_attr($Author_Color = "#ffffff"); } else { echo esc_attr($Author_Color); } ?>"></p></td>
				</tr>
				<tr>
					<th><label><?php _e('Font Family', 'WL_ABTM_TXT_DM' ); ?></label></th>
					<td><?php if(!isset($Author_PGPP_Font_Style)) { $Author_PGPP_Font_Style = "Courier New"; }?>
						<select  name="Author_PGPP_Font_Style" id="Author_PGPP_Font_Style" class="standard-dropdown" >
							<optgroup label="Default Fonts">
								<option value="Arial" <?php selected($Author_PGPP_Font_Style, 'Arial' ); ?>>Arial</option>
								<option value="Arial Black" <?php selected($Author_PGPP_Font_Style, 'Arial Black' ); ?>>Arial Black</option>
								<option value="Courier New" <?php selected($Author_PGPP_Font_Style, 'Courier New' ); ?>>Courier New</option>
								<option value="cursive" <?php selected($Author_PGPP_Font_Style, 'cursive' ); ?>>Cursive</option>
								<option value="fantasy" <?php selected($Author_PGPP_Font_Style, 'fantasy' ); ?>>Fantasy</option>
								<option value="Georgia" <?php selected($Author_PGPP_Font_Style, 'Georgia' ); ?>>Georgia</option>
								<option value="Grande"<?php selected($Author_PGPP_Font_Style, 'Grande' ); ?>>Grande</option>
								<option value="Helvetica Neue" <?php selected($Author_PGPP_Font_Style, 'Helvetica Neue' ); ?>>Helvetica Neue</option>
								<option value="Impact" <?php selected($Author_PGPP_Font_Style, 'Impact' ); ?>>Impact</option>
								<option value="Lucida" <?php selected($Author_PGPP_Font_Style, 'Lucida' ); ?>>Lucida</option>
								<option value="Lucida Console"<?php selected($Author_PGPP_Font_Style, 'Lucida Console' ); ?>>Lucida Console</option>
								<option value="monospace" <?php selected($Author_PGPP_Font_Style, 'monospace' ); ?>>Monospace</option>
								<option value="Open Sans" <?php selected($Author_PGPP_Font_Style, 'Open Sans' ); ?>>Open Sans</option>
								<option value="Palatino" <?php selected($Author_PGPP_Font_Style, 'Palatino' ); ?>>Palatino</option>
								<option value="sans" <?php selected($Author_PGPP_Font_Style, 'sans' ); ?>>Sans</option>
								<option value="sans-serif" <?php selected($Author_PGPP_Font_Style, 'sans-serif' ); ?>>Sans-Serif</option>
								<option value="Tahoma" <?php selected($Author_PGPP_Font_Style, 'Tahoma' ); ?>>Tahoma</option>
								<option value="Times New Roman"<?php selected($Author_PGPP_Font_Style, 'Times New Roman' ); ?>>Times New Roman</option>
								<option value="Trebuchet MS" <?php selected($Author_PGPP_Font_Style, 'Trebuchet MS' ); ?>>Trebuchet MS</option>
								<option value="Verdana" <?php selected($Author_PGPP_Font_Style, 'Verdana' ); ?>>Verdana</option>
							</optgroup>
							<optgroup label="Google Fonts">
								<?php
		                            // fetch the Google font list
									$google_font_token = "AIzaSyBmvWUL5IR3vTH0pf5dTGOSP6iiXnNpfl4";
		                            $google_api_url = "https://www.googleapis.com/webfonts/v1/webfonts?key=$google_font_token";
		                           $response_font_api = wp_remote_retrieve_body( wp_remote_get($google_api_url, array('sslverify' => false )));
		                           if(!is_wp_error( $response_font_api ) ) {
		                                $fonts_list = json_decode($response_font_api,  true);
		                                // that's it
		                                if(is_array($fonts_list)) {
		                                	if(isset($fonts_list['items'])){
				                                    $g_fonts = $fonts_list['items'];
				                                    foreach( $g_fonts as $g_font) { $font_name = $g_font['family']; ?><option value="<?php echo $font_name; ?>" <?php selected($Author_PGPP_Font_Style, $font_name ); ?>><?php echo $font_name; ?></option><?php 
				                                    }
			                                	} 
			                            	} else {
			                                    echo "<option disabled>Error to fetch Google fonts.</option>";
			                                    echo "<option disabled>Google font will not available in offline mode.</option>";
			                                }
		                            } 
		                        ?>
							</optgroup>	
						</select>
						<p class="description"><?php _e('Choose a caption font style.', WL_ABTM_TXT_DM)?></p>
					</td>
				</tr>
			</tr>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit"  value="save" id="save" class="button-primary" style="font-size: 18px;width:7%;height:10%;"></td>
				<!--<td><a href= "<?php $user_ID = get_current_user_id(); echo get_edit_user_link( $user_ID ) ?>"  data-toggle="tooltip" title="Click on link to fill author profile information" class="button-primary" style="font-size: 18px;">Update Social Profile</a></td>-->
			</tr>
		</table>
	</form>
</div>
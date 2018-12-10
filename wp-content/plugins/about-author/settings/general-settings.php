<?php
$postid=$post->ID;
$abt_Settings = "abt_Settings_".$postid;
$ABT_Settings = unserialize(get_post_meta($postid, $abt_Settings, true));
if(isset($ABT_Settings[0])) {

	if(isset($ABT_Settings[0]['About_me_bg_color'])){
		$About_me_bg_color = $ABT_Settings[0]['About_me_bg_color'];
	}else{
		$About_me_bg_color = "#dd3333";
	}

	if(isset($ABT_Settings[0]['About_me_user_name'])){
		$About_me_user_name = $ABT_Settings[0]['About_me_user_name'];
	}else{
		$About_me_user_name = "Weblizar";
	}

	if(isset($ABT_Settings[0]['About_me_web_site_name'])){
		$About_me_web_site_name = $ABT_Settings[0]['About_me_web_site_name'];
	}else{
		$About_me_web_site_name = "";
	}

	if(isset($ABT_Settings[0]['About_me_dis_cription'])){
		$About_me_dis_cription = $ABT_Settings[0]['About_me_dis_cription'];
	}else{
		$About_me_dis_cription = "";
	}

	if(isset($ABT_Settings[0]['followpint'])){
		$followpint = $ABT_Settings[0]['followpint'];
	}else{
		$followpint = "";
	}

	if(isset($ABT_Settings[0]['About_me_social_color'])){
		$About_me_social_color = $ABT_Settings[0]['About_me_social_color'];
	}else{
		$About_me_social_color = "";
	}

	if(isset($ABT_Settings[0]['About_me_custom_css'])){
		$About_me_custom_css = $ABT_Settings[0]['About_me_custom_css'];
	}else{
		$About_me_custom_css = "";
	}

	
	$followfb = $ABT_Settings[0]['followfb'];
	$followgoogle = $ABT_Settings[0]['followgoogle'];
	$followinsta = $ABT_Settings[0]['followinsta'];
	$followlinkdln = $ABT_Settings[0]['followlinkdln'];
	$followtwit = $ABT_Settings[0]['followtwit'];
	$bodr = $ABT_Settings[0]['bodr'];
	$img_bdr_type = $ABT_Settings[0]['img_bdr_type'];
	$bdr_size = $ABT_Settings[0]['bdr_size'];
	$img_bdr_color = $ABT_Settings[0]['img_bdr_color'];
	$name_font_size = $ABT_Settings[0]['name_font_size'];
	$name_Color = $ABT_Settings[0]['name_Color'];
	$weblink_font_size = $ABT_Settings[0]['weblink_font_size'];
	$weblink_text_color = $ABT_Settings[0]['weblink_text_color'];
	$dis_font_size = $ABT_Settings[0]['dis_font_size'];
	$dis_text_color = $ABT_Settings[0]['dis_text_color'];
	$PGPP_Font_Style = $ABT_Settings[0]['PGPP_Font_Style'];
	$Tem_ous = $ABT_Settings[0]['Tem_pl_at_e'];
	$Social_icon_size = $ABT_Settings[0]['Social_icon_size'];
}
?>
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
label > input  {
	display:none;
}
label > input + img{ /* IMAGE STYLES */
	cursor:pointer;
	border:2px solid transparent;
}
label > input:checked + img{ /* (CHECKED) IMAGE STYLES */
	border:5px double #000000;
}
.widefat {
	width: 50%;
}
.fa
{
	color:#00A0D2;
	font-size:20px;
	display: inline-block;
}
</style>
<script>
	jQuery(document).ready(function()
	{
		jQuery('.my-color-picker').wpColorPicker();
	});
	function outputUpdate(vol)
	{
		jQuery("span.volum").text(vol);
	}
	function outputUpdate2(vol2)
	{
		jQuery("span.volum2").text(vol2);
	}
	function outputUpdate3(vol3)
	{
		jQuery("span.volum3").text(vol3);
	}
	function outputUpdate4(vol4)
	{
		jQuery("span.volum4").text(vol4);
	}
	function Social_icon_size_outputUpdate(vol5)
	{
		jQuery("span.volum5").text(vol5);
	}
</script>
<?php
if(!isset($Tem_ous)) { $Tem_ous = "11"; }
if($Tem_ous =='11' || $Tem_ous =='12' || $Tem_ous =='13' || $Tem_ous =='14' || $Tem_ous =='15' || $Tem_ous =='16' || $Tem_ous =='17' || $Tem_ous =='18') {
	$d_n_t="";
} else  {
	$d_n_t= 'display:none;';
}
?>
<table class="form-table"  >
	<tr><td colspan="2"><label class="lbl"><?php _e('Profile Image Layout', 'WL_ABTM_TXT_DM' ); ?></label></td>
	</tr>
	<tr>
		<th colspan="2">  <label>
			<?php if(!isset($bodr)) { $bodr = "1"; }?>
			<input id="bodr" name="bodr" type="radio" value="1"  <?php checked( '1', $bodr ); ?> style="display:none;"/>
			<img src="<?php echo WEBLIZAR_ABOUT_ME_PLUGIN_URL.'settings/images/pic2.png'; ?>"  />
		</label>
		<label>
			<input id="bodr" name="bodr" type="radio" value="3" <?php checked( '3', $bodr ); ?> style="display:none;"/>
			<img src="<?php echo WEBLIZAR_ABOUT_ME_PLUGIN_URL.'settings/images/pic3.png'; ?>"/>
		</label>
	</th>
	</tr>
	<tr><td colspan="2"><label class="lbl"><?php _e('Profile Image Layout settings', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
	<th><label><?php _e('Border style', 'WL_ABTM_TXT_DM'); ?></label></th>
	<td> <?php if(!isset($img_bdr_type)) { 	$img_bdr_type = "solid"; }?>
		<select name="img_bdr_type" id="img_bdr_type">
			<?php  $options_bdr_type = array('none','solid');
			foreach ($options_bdr_type as $option_bdr_type_img) {
				echo '<option
				value="' . esc_attr($option_bdr_type_img) . '"
				id="' . esc_attr($option_bdr_type_img) . '"',
				$img_bdr_type == $option_bdr_type_img ? ' selected="selected"' : '', '>',
				$option_bdr_type_img, '</option>';
			}
			?>
		</select>
	</td>
	</tr>
	<tr>
	<th><label><?php _e('Border size', 'WL_ABTM_TXT_DM' ); ?></label></th>
	<td><input type="range" class="slider" min="1" max="10" step="1" value="<?php if(!isset($bdr_size)) {	echo	esc_attr($bdr_size = "5"); } else {	echo esc_attr($bdr_size);} ?>" data-orientation="vertical" id="bdr_size"name="bdr_size"  oninput="outputUpdate4(value);" />
		<span style="width: 25px; height: 30px; margin:auto; display: inline-block; border: 2px solid gray; vertical-align: middle; border-radius: 8px; background-color:#FFFFFF;text-align:center;font-size:20px;margin-left:20px;margin-bottom:20px;;"
		id="img_bdr_span_value" name="img_bdr_span_value" class="volum4" ><?php echo esc_attr($bdr_size);?><span></td>
	</tr>
	<tr>
		<th><label><?php _e('Border Color', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><p><input class="my-color-picker" id="img_bdr_color" name="img_bdr_color" type="text"  value="<?php if(!isset($img_bdr_color)) { 	echo	esc_attr($img_bdr_color = "#ffffff"); } else	{ 	echo esc_attr($img_bdr_color); }?>"> </p></td>
	</tr>
	<tr class="co_lo_hi_d" style="<?php echo esc_attr($d_n_t); ?>">
		<td colspan="2">
			<label class="lbl"><?php _e('BackgroundColor option', 'WL_ABTM_TXT_DM' ); ?></label>
		</td>
	</tr>

	<tr class="co_lo_hi_d" style=" <?php echo esc_attr($d_n_t); ?>"   >
		<th><label ><?php _e('BackgroundColor', 'WL_ABTM_TXT_DM' ); ?></label> </th>
		<td><p><input  type="text" class="my-color-picker" id="About_me_bg_color" name="About_me_bg_color" value="<?php if(!isset($About_me_bg_color)) {	echo	esc_attr($About_me_bg_color = "#dd3333"); 	} else { echo esc_attr($About_me_bg_color); }?>"/><p>
		</td>
	</tr>

	<tr> <td colspan="2"><label class="lbl"><?php _e('Name Text Settings', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
	<tr>
		<th><label> <?php _e('Name Text', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><input class="widefat"  id="About_me_user_name" name="About_me_user_name" type="text" value="<?php if(!isset($About_me_user_name)) { echo esc_attr($About_me_user_name = "About_me_web_site_name "); } else { echo esc_attr($About_me_user_name); } ?>"  />
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Font size', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><input class="slider" type="range" min="12" max="40" step="1" value="<?php if(!isset($name_font_size)) { echo esc_attr($name_font_size = "20"); } else { echo esc_attr($name_font_size); } ?>" data-orientation="vertical" id="name_font_size"name="name_font_size"  oninput="outputUpdate(value);" /> <span style="width: 25px; height: 30px; margin:auto; display: inline-block; border: 2px solid gray; vertical-align: middle; border-radius: 8px; background-color:#FFFFFF;text-align:center;font-size:20px;margin-left:20px;margin-bottom:20px;" id="name_set_span_value" name="name_set_span_value" class="volum" ><?php echo esc_attr($name_font_size);?><span>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Color', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><p><input class="my-color-picker" id="name_Color" name="name_Color" type="text"  value="<?php 	if(!isset($name_Color)) { echo esc_attr($name_Color = "#ffffff"); } else { echo esc_attr($name_Color); } ?>"></p></td>
	</tr>

	<tr><td colspan="2"><label class="lbl"><?php _e('Website Text Settings', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
	<tr>
		<th><label> <?php _e('Website Name Text', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><input class="widefat" id="About_me_web_site_name"  name="About_me_web_site_name" type="text" value="<?php if(!isset($About_me_web_site_name))  { echo esc_attr($About_me_web_site_name = "http://www.About_me_web_site_name .com"); } else { echo esc_attr($About_me_web_site_name); } ?>" /></td>
	</tr>
	<tr>
		<th><label><?php _e('Font size', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><input type="range" class="slider" min="12" max="40" step="1" value="<?php if(!isset($weblink_font_size))  { echo esc_attr($weblink_font_size = "20"); } else { echo esc_attr($weblink_font_size); } ?>" data-orientation="vertical" id="weblink_font_size" name="weblink_font_size"   oninput="outputUpdate2(value);"> <span style="width: 25px; height: 30px; margin:auto; display: inline-block; border: 2px solid gray; vertical-align: middle; border-radius: 8px; background-color:#FFFFFF;text-align:center;font-size:20px;margin-left:20px;margin-bottom:20px;"id="weblink_set_span_value"name="weblink_set_span_value"class="volum2" ><?php echo esc_attr($weblink_font_size);?><span>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Website Link Color', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><input class="my-color-picker" id="weblink_text_color" name="weblink_text_color" type="text"  value="<?php if(!isset($weblink_text_color)) { echo esc_attr($weblink_text_color = "#ffffff"); } else { echo esc_attr($weblink_text_color); } ?>"></td>
	</tr>
	<tr><td colspan="2"><label class="lbl"><?php _e('Description Text Settings', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
	<tr>
		<th><label> <?php _e('Description Text', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><textarea class="widefat" id="About_me_dis_cription" name="About_me_dis_cription" maxlength="325" style="height:160px;"><?php if(!isset($About_me_dis_cription)) {	echo htmlentities($About_me_dis_cription = "About_me_web_site_name  Creators of Premium WordPress Minimalist WordPress Themes For Creatives"); } else { echo htmlentities($About_me_dis_cription);}?></textarea>
			<p class="description"><b><?php _e('Note: Maximum words for Description are 325.','WL_ABTM_TXT_DM')?><b></p>
		</td>

	</tr>
	<tr>
		<th><label><?php _e('Font size', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><input class="slider" type="range" min="12" max="40" step="1" value="<?php if(!isset($dis_font_size)) { echo esc_attr($dis_font_size = "20"); } else { echo esc_attr($dis_font_size); } ?>" data-orientation="vertical" id="dis_font_size" name="dis_font_size" oninput="outputUpdate3(value);"> <span style="width: 25px; height: 30px; margin:auto; display: inline-block; border: 2px solid gray; vertical-align: middle; border-radius: 8px; background-color:#FFFFFF;text-align:center;font-size:20px;margin-left:20px;margin-bottom:20px;" id="dis_set_span_value" name="dis_set_span_value" class="volum3" ><?php echo esc_attr($dis_font_size);?><span></td>
	</tr>
	<tr>
		<th><label><?php _e('Description Text Color', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><input class="my-color-picker" id="dis_text_color" name="dis_text_color" type="text"  value="<?php if(!isset($dis_text_color)) { echo esc_attr($dis_text_color = "#ffffff"); } else { echo esc_attr($dis_text_color); } ?>"></td>
	</tr>

	<tr><td colspan="2"><label class="lbl"><?php _e('Social link Settings', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
	<tr>
		<th><label><a target="_blank" style="text-decoration: none;"><i class="fa fa-facebook web_lizar_Social_icon"></i></a>&nbsp<?php _e('Facebook', 'WL_ABTM_TXT_DM' ); ?> </label></th>
		<td><input class="widefat" id="followfb" name="followfb" type="text" value="<?php if(!isset($followfb)) { echo	esc_attr($followfb = "https://www.facebook.com/Weblizar-1440510482872657/"); } else { echo esc_attr($followfb); } 	?>" />
		</td>
	</tr>
	<tr>
		<th> <label> <a target="_blank" style="text-decoration: none;"><i class="fa fa-twitter web_lizar_Social_icon"></i></a>&nbsp<?php _e('Twitter', 'WL_ABTM_TXT_DM' ); ?> </label></th>
		<td><input class="widefat" id="followtwit" name="followtwit" type="text"  value="<?php if(!isset($followtwit)) { echo	esc_attr($followtwit = "https://twitter.com/weblizar"); } else { echo esc_attr($followtwit); } ?>"/>
		</td>
	</tr>
	<tr>
		<th><label><a target="_blank" style="text-decoration: none;"><i class="fa fa-google-plus  web_lizar_Social_icon"  ></i></a>&nbsp <?php _e('Google', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td><input class="widefat" id="followgoogle" name="followgoogle" type="text"   value="<?php 	if(!isset($followgoogle)) {	echo	esc_attr($followgoogle = "https://plus.google.com/100920322672659513870/posts"); } else {	echo esc_attr($followgoogle); }?>"/>
		</td>
	</tr>
	<tr>
		<th><label><a target="_blank" style="text-decoration: none;"><i class="fa fa-linkedin web_lizar_Social_icon"></i></a>&nbsp<?php _e('LinkedIn', 'WL_ABTM_TXT_DM' ); ?> </label></th>
		<td><input class="widefat" id="followlinkdln" name="followlinkdln" type="text"  value="<?php if(!isset($followlinkdln)) { echo esc_attr($followlinkdln = "https://in.linkedin.com/in/weblizar"); 	}	else	{ echo esc_attr($followlinkdln); } ?>" />
		</td>
	</tr>
	<tr>
		<th><label><a target="_blank" style="text-decoration: none;"><i class="fa fa-pinterest web_lizar_Social_icon"></i></a>&nbsp<?php _e('Pinterest', 'WL_ABTM_TXT_DM' ); ?> </label></th>
		<td><input class="widefat" id="followpint" name="followpint" type="text"  value="<?php if(!isset($followpint)) { echo esc_attr($followpint = "https://in.pinterest.com/"); 	}	else	{ echo esc_attr($followpint); } ?>" />
		</td>
	</tr>

	<tr>
		<th><label><a target="_blank" style="text-decoration: none;"> <i class="fa fa-instagram web_lizar_Social_icon" ></i></a>&nbsp<?php _e('Instagram', 'WL_ABTM_TXT_DM' ); ?> </label>
		</th>
		<td><input class="widefat" id="followinsta" name="followinsta" type="text" value="<?php if(!isset($followinsta)) { echo esc_attr($followinsta = "https://www.instagram.com/?hl=en"); } else { echo esc_attr($followinsta); }?>" />
		</td>
	</tr>

	<tr><td colspan="2"><label class="lbl"><?php _e('Social Link Color', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
	<tr>
		<th><label> <?php _e('Color', 'WL_ABTM_TXT_DM' ); ?></label> </th>
		<td><p><input  type="text" class="my-color-picker" id="About_me_social_color" name="About_me_social_color" value="<?php if(!isset($About_me_social_color)) { echo	esc_attr($About_me_social_color = "#ffffff"); } else { echo esc_attr($About_me_social_color); } ?>"/></p></td>
		</tr>
		<tr><td colspan="2"><label class="lbl"><?php _e('Social icon size', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
		<tr>
			<th><label><?php _e('Size', 'WL_ABTM_TXT_DM' ); ?></label> </th>
			<td><input class="slider" type="range" min="15" max="40" step="1" value="<?php if(!isset($Social_icon_size)) { echo esc_attr($Social_icon_size = "20"); } else { echo esc_attr($Social_icon_size); } ?>" data-orientation="vertical" id="Social_icon_size"name="Social_icon_size"  oninput="Social_icon_size_outputUpdate(value);" /> <span style="width: 25px; height: 30px; margin:auto; display: inline-block; border: 2px solid gray; vertical-align: middle; border-radius: 8px; background-color:#FFFFFF;text-align:center;font-size:20px;margin-left:20px;margin-bottom:20px;" id="Social_icon_set_span_value" name="Social_icon_set_span_value" class="volum5" ><?php echo esc_attr($Social_icon_size);?><span>
			</td>
		</tr>

		<tr><td colspan="2"><label class="lbl"><?php _e('Font Family', 'WL_ABTM_TXT_DM' ); ?></label></td></tr>
		<tr>
			<th><label><?php _e('Font Family', 'WL_ABTM_TXT_DM' ); ?></label></th>
			<td>	<?php if(!isset($PGPP_Font_Style)) { $PGPP_Font_Style = "Courier New"; }?>
				<select  name="PGPP_Font_Style" id="PGPP_Font_Style" class="standard-dropdown" >
					<optgroup label="Default Fonts">
						<option value="Arial" <?php selected($PGPP_Font_Style, 'Arial' ); ?>>Arial</option>
                        <option value="Arial Black" <?php selected($PGPP_Font_Style, 'Arial Black' ); ?>>Arial Black</option>
                        <option value="Courier New" <?php selected($PGPP_Font_Style, 'Courier New' ); ?>>Courier New</option>
                        <option value="cursive" <?php selected($PGPP_Font_Style, 'cursive' ); ?>>Cursive</option>
                        <option value="fantasy" <?php selected($PGPP_Font_Style, 'fantasy' ); ?>>Fantasy</option>
                        <option value="Georgia" <?php selected($PGPP_Font_Style, 'Georgia' ); ?>>Georgia</option>
                        <option value="Grande"<?php selected($PGPP_Font_Style, 'Grande' ); ?>>Grande</option>
                        <option value="Helvetica Neue" <?php selected($PGPP_Font_Style, 'Helvetica Neue' ); ?>>Helvetica Neue</option>
                        <option value="Impact" <?php selected($PGPP_Font_Style, 'Impact' ); ?>>Impact</option>
                        <option value="Lucida" <?php selected($PGPP_Font_Style, 'Lucida' ); ?>>Lucida</option>
                        <option value="Lucida Console"<?php selected($PGPP_Font_Style, 'Lucida Console' ); ?>>Lucida Console</option>
                        <option value="monospace" <?php selected($PGPP_Font_Style, 'monospace' ); ?>>Monospace</option>
                        <option value="Open Sans" <?php selected($PGPP_Font_Style, 'Open Sans' ); ?>>Open Sans</option>
                        <option value="Palatino" <?php selected($PGPP_Font_Style, 'Palatino' ); ?>>Palatino</option>
                        <option value="sans" <?php selected($PGPP_Font_Style, 'sans' ); ?>>Sans</option>
                        <option value="sans-serif" <?php selected($PGPP_Font_Style, 'sans-serif' ); ?>>Sans-Serif</option>
                        <option value="Tahoma" <?php selected($PGPP_Font_Style, 'Tahoma' ); ?>>Tahoma</option>
                        <option value="Times New Roman"<?php selected($PGPP_Font_Style, 'Times New Roman' ); ?>>Times New Roman</option>
                        <option value="Trebuchet MS" <?php selected($PGPP_Font_Style, 'Trebuchet MS' ); ?>>Trebuchet MS</option>
                        <option value="Verdana" <?php selected($PGPP_Font_Style, 'Verdana' ); ?>>Verdana</option>
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
				                                    foreach( $g_fonts as $g_font) { $font_name = $g_font['family']; ?><option value="<?php echo $font_name; ?>" <?php selected($PGPP_Font_Style, $font_name ); ?>><?php echo $font_name; ?></option><?php 
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
				<p class="description">
					<?php _e('Choose a caption font style.','WL_ABTM_TXT_DM')?>
				</p>
			</td>
		</tr>
		<tr>
		<td colspan="2">
			<label class="lbl"><?php _e('Custom CSS', 'WL_ABTM_TXT_DM' ); ?></label></td>
		</tr>
		<tr>
			<th><label ><?php _e('Custom CSS', 'WL_ABTM_TXT_DM' ); ?></label> </th>
			<td><textarea class="widefat" id="About_me_custom_css" name="About_me_custom_css"><?php if(!isset($About_me_custom_css)) {	echo esc_textarea($About_me_custom_css = ""); } else { echo esc_textarea($About_me_custom_css);}?></textarea>
				<p class="description">
					<?php _e('Enter any custom css you want to apply on this shortcode.','WL_ABTM_TXT_DM')?>
				</p>
				<p class="custnote">Note: Please Do Not Use <b>Style</b> Tag With Custom CSS</p>
			</td>
		</tr>
</table>

<script>
jQuery(document).ready(function($){
	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() < 200) {
			jQuery('#smoothup') .fadeOut();
		} else {
			jQuery('#smoothup') .fadeIn();
		}
	});
	jQuery('#smoothup').on('click', function(){
		jQuery('html, body').animate({scrollTop:0}, 'fast');
		return false;
	});
});

jQuery(document).ready(function(){
	var editor = CodeMirror.fromTextArea(document.getElementById("About_me_custom_css"), {
		lineWrapping: true,
		lineNumbers: true,
		styleActiveLine: true,
		matchBrackets: true,
		hint:true,
		theme : 'blackboard',
		extraKeys: {"Ctrl-Space": "autocomplete"},
	});
});
</script>
<a href="#top" id="smoothup" title="Back to top"></a>
<style>
	.custnote{
		background-color: rgba(23, 31, 22, 0.64);
		color: #fff;
		width: 348px;
		border-radius: 5px;
		padding-right: 5px;
		padding-left: 5px;
		padding-top: 2px;
		padding-bottom: 2px;
	}
	#smoothup {
		height: 50px;
		width: 50px;
		position:fixed;
		bottom:50px;
		right:250px;
		text-indent:-9999px;
		display:none;
		background: url("<?php echo WEBLIZAR_ABOUT_ME_PLUGIN_URL.'settings/images/up.png'; ?>");
		-webkit-transition-duration: 0.4s;
		-moz-transition-duration: 0.4s; transition-duration: 0.4s;
	}

	#smoothup:hover {
		-webkit-transform: rotate(360deg) }
		background: url('') no-repeat;
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
}</style>
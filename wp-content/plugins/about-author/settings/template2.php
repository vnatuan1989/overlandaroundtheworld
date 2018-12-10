<?php
$postid=$post->ID;
$abt_Settings = "abt_Settings_".$postid;
$ABT_Settings = unserialize(get_post_meta( $post->ID,  $abt_Settings, true));
if(isset($ABT_Settings[0])) {
	$profile_user_image = $ABT_Settings[0]['profile_user_image'];
	$user_header_image = $ABT_Settings[0]['user_header_image'];
}
?>
<style>
.text_in_put {
	width: 80%;
}
.tr-center {
	text-align: center;
}
</style>
<table>
	<tr class="tr-center"><th><span style=" font-size: 30px;font-family: Courier New;"><?php _e('Template Style 2', 'WL_ABTM_TXT_DM' ); ?></span></th></tr>
	<tr><th>&nbsp </th></tr>
	<tr class="tr-center">
		<td><img src="<?php echo WEBLIZAR_ABOUT_ME_PLUGIN_URL.'settings/images/temp22.png'; ?>" /></td>
	</tr>
</table>

<table class="form-table">
	<th id="lbl_id">
	<label><?php _e('Upload profile Image', 'WL_ABTM_TXT_DM' ); ?></label>
	</th >
	<td id="In_put_id">
		<input type="text" class="text_in_put"  id="profile_user_image"  name="profile_user_image" placeholder="<?php _e('No media selected!','WL_ABTM_TXT_DM')?>" readonly name="upload_image"   value="<?php  if(!isset($profile_user_image))  {  echo	esc_url($profile_user_image =WEBLIZAR_ABOUT_ME_PLUGIN_URL.'settings/images/1.jpg');  }  else  {  echo esc_url($profile_user_image);  }	?>" />
		<input type="button" value="<?php _e('Upload','WL_ABTM_TXT_DM')?>"  class="button-primary upload_image_button"/>
		<img  src="<?php echo esc_url($profile_user_image); ?>"  width="150" height="150" style="margin:auto; margin-top:10px; display: inline-block; border: 4px double #000000; vertical-align: middle; border-radius: 22px" />
		<p class="description"><b> <?php _e('*Upload profile image size should be 200*200 pixel maximum and 150*150 minimum', 'WL_ABTM_TXT_DM' ); ?><b>  </p>
	</td>
	<tr>
		<td></td>
	</tr>

	<tr>
		<th id="up_load_header_img"><label><?php _e('Upload Header Background Image', 'WL_ABTM_TXT_DM' ); ?></label></th>
		<td id="in_put_text_hide">
		<input type="text" class="text_in_put"   id="user_header_image" name="user_header_image" placeholder="<?php _e('No media selected!','WL_ABTM_TXT_DM')?>" name="upload_image"  readonly  value="<?php  if(!isset($user_header_image)) {   echo	esc_url($user_header_image = WEBLIZAR_ABOUT_ME_PLUGIN_URL.'settings/images/header_r.jpg');  } else  { echo esc_url($user_header_image);  }	 ?>"/>
		<input type="button" value="<?php _e('Upload','WL_ABTM_TXT_DM')?>"  class="button-primary  upload_image_button"/>
		<img  src="<?php echo esc_url($user_header_image); ?>"  width="150" height="150" style="margin:auto; margin-top:10px; display: inline-block; border: 4px double #000000; vertical-align: middle; border-radius: 22px" />
		<p class="description"><b> <?php _e('*Upload header background image size should be 800*150 pixel maximum and 600*150 minimum', 'WL_ABTM_TXT_DM' ); ?><b>  </p>
		</td>
	</tr>

	<tr>
		<td></td>
	</tr>
</table>
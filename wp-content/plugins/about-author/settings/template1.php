<?php
$postid = $post->ID;
$abt_Settings = "abt_Settings_".$postid;
$ABT_Settings = unserialize(get_post_meta( $post->ID, $abt_Settings, true));
if(isset($ABT_Settings[0])) {
	$profile_user_image = $ABT_Settings[0]['profile_user_image'];
}
?>
<style>
.text_in_put {
	width: 80%;
}
.tr-center  {
	text-align: center;
}
</style>
 <table>
 	<tr class="tr-center"><th><span style=" font-size: 30px;font-family: Courier New;"><?php _e('Template Style 1', 'WL_ABTM_TXT_DM' ); ?></span></th></tr>
 	<tr><th>&nbsp </th></tr>
 	<tr class="tr-center">
 		<td>
 			<img src="<?php echo WEBLIZAR_ABOUT_ME_PLUGIN_URL.'settings/images/temp11.png'; ?>" />
 		</td>
 	</tr>
 </table>
<table class="form-table">
	<tr>
		<th id="lbl_id">
			<label><?php _e('Upload profile Image', 'WL_ABTM_TXT_DM' ); ?></label>
		</th>
		<td id="In_put_id">
			<input type="text" class="text_in_put"  id="profile_user_image"  name="profile_user_image" placeholder="<?php _e('No media selected!','WL_ABTM_TXT_DM')?>" readonly name="upload_image"   value="<?php  if(!isset($profile_user_image)){ echo	esc_url($profile_user_image =WEBLIZAR_ABOUT_ME_PLUGIN_URL.'settings/images/1.jpg'); } else { echo esc_url($profile_user_image);  } ?>"  />
			<input type="button" value="<?php _e('Upload','WL_ABTM_TXT_DM')?>"  class="button-primary upload_image_button"  />
			<img  src="<?php echo esc_url($profile_user_image); ?>"  width="150" height="150" style="margin:auto; margin-top:10px; display: inline-block; border: 4px double #000000; vertical-align: middle; border-radius: 22px" />
			<p class="description"><b> <?php _e('*Upload profile Image size should be 200*200 pixel maximum and 150*150 minimum', 'WL_ABTM_TXT_DM' ); ?><b> </p>
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
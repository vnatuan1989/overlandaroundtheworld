<?php
$postid=$post->ID;
$abt_Settings = "abt_Settings_".$postid;
$ABT_Settings = unserialize(get_post_meta( $post->ID,  $abt_Settings, true));
if(isset($ABT_Settings[0])) {
	//$profile_user_image = $ABT_Settings[0]['profile_user_image'];
	//$user_header_image = $ABT_Settings[0]['user_header_image'];
	$Tem_pl_at_e = $ABT_Settings[0]['Tem_pl_at_e'];
} else {
	$Tem_pl_at_e = "11";
}
?>
<script>
function dis_play_ed(vol) {
	if(vol=="11") {
		jQuery("#t_m_p_l_1").show();
		jQuery("#t_m_p_l_2").hide();
		jQuery("#t_m_p_l_3").hide();
		jQuery("#t_m_p_l_4").hide();
		jQuery("#t_m_p_l_5").hide();
		jQuery("#t_m_p_l_6").hide();
		jQuery("#t_m_p_l_7").hide();
		jQuery("#t_m_p_l_8").hide();
		jQuery("#t_m_p_l_9").hide();
		jQuery("#t_m_p_l_10").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").show();
	} else if(vol=="12") {
		jQuery("#t_m_p_l_2").show();
		jQuery("#t_m_p_l_1").hide();
		jQuery("#t_m_p_l_3").hide();
		jQuery("#t_m_p_l_4").hide();
		jQuery("#t_m_p_l_5").hide();
		jQuery("#t_m_p_l_6").hide();
		jQuery("#t_m_p_l_7").hide();
		jQuery("#t_m_p_l_8").hide();
		jQuery("#t_m_p_l_9").hide();
		jQuery("#t_m_p_l_10").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").show();
	} else if(vol=="13") {
		jQuery("#t_m_p_l_3").show();
		jQuery("#t_m_p_l_1").hide();
		jQuery("#t_m_p_l_2").hide();
		jQuery("#t_m_p_l_4").hide();
		jQuery("#t_m_p_l_5").hide();
		jQuery("#t_m_p_l_6").hide();
		jQuery("#t_m_p_l_7").hide();
		jQuery("#t_m_p_l_8").hide();
		jQuery("#t_m_p_l_9").hide();
		jQuery("#t_m_p_l_10").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").show();
	} else if(vol=="14") {
		jQuery("#t_m_p_l_4").show();
		jQuery("#t_m_p_l_1").hide();
		jQuery("#t_m_p_l_2").hide();
		jQuery("#t_m_p_l_3").hide();
		jQuery("#t_m_p_l_5").hide();
		jQuery("#t_m_p_l_6").hide();
		jQuery("#t_m_p_l_7").hide();
		jQuery("#t_m_p_l_8").hide();
		jQuery("#t_m_p_l_9").hide();
		jQuery("#t_m_p_l_10").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").show();
	} else if(vol=="15") {
		jQuery("#t_m_p_l_5").show();
		jQuery("#t_m_p_l_1").hide();
		jQuery("#t_m_p_l_2").hide();
		jQuery("#t_m_p_l_3").hide();
		jQuery("#t_m_p_l_4").hide();
		jQuery("#t_m_p_l_6").hide();
		jQuery("#t_m_p_l_7").hide();
		jQuery("#t_m_p_l_8").hide();
		jQuery("#t_m_p_l_9").hide();
		jQuery("#t_m_p_l_10").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").show();
	} else if(vol=="16") {
		jQuery("#t_m_p_l_6").show();
		jQuery("#t_m_p_l_1").hide();
		jQuery("#t_m_p_l_2").hide();
		jQuery("#t_m_p_l_3").hide();
		jQuery("#t_m_p_l_4").hide();
		jQuery("#t_m_p_l_5").hide();
		jQuery("#t_m_p_l_7").hide();
		jQuery("#t_m_p_l_8").hide();
		jQuery("#t_m_p_l_9").hide();
		jQuery("#t_m_p_l_10").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").show();
	} else if(vol=="17") {
		jQuery("#t_m_p_l_7").show();
		jQuery("#t_m_p_l_1").hide();
		jQuery("#t_m_p_l_2").hide();
		jQuery("#t_m_p_l_3").hide();
		jQuery("#t_m_p_l_4").hide();
		jQuery("#t_m_p_l_6").hide();
		jQuery("#t_m_p_l_5").hide();
		jQuery("#t_m_p_l_8").hide();
		jQuery("#t_m_p_l_9").hide();
		jQuery("#t_m_p_l_10").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").show();
	} else if(vol=="18") {
		jQuery("#t_m_p_l_8").show();
		jQuery("#t_m_p_l_1").hide();
		jQuery("#t_m_p_l_2").hide();
		jQuery("#t_m_p_l_3").hide();
		jQuery("#t_m_p_l_4").hide();
		jQuery("#t_m_p_l_6").hide();
		jQuery("#t_m_p_l_5").hide();
		jQuery("#t_m_p_l_7").hide();
		jQuery("#t_m_p_l_9").hide();
		jQuery("#t_m_p_l_10").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").show();
	} else if(vol=="19") {
		jQuery("#t_m_p_l_9").show();
		jQuery("#t_m_p_l_1").hide();
		jQuery("#t_m_p_l_2").hide();
		jQuery("#t_m_p_l_3").hide();
		jQuery("#t_m_p_l_4").hide();
		jQuery("#t_m_p_l_6").hide();
		jQuery("#t_m_p_l_5").hide();
		jQuery("#t_m_p_l_7").hide();
		jQuery("#t_m_p_l_8").hide();
		jQuery("#t_m_p_l_10").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").hide();
	} else if(vol=="20") {
		jQuery("#t_m_p_l_10").show();
		jQuery("#t_m_p_l_1").hide();
		jQuery("#t_m_p_l_2").hide();
		jQuery("#t_m_p_l_3").hide();
		jQuery("#t_m_p_l_4").hide();
		jQuery("#t_m_p_l_6").hide();
		jQuery("#t_m_p_l_5").hide();
		jQuery("#t_m_p_l_7").hide();
		jQuery("#t_m_p_l_8").hide();
		jQuery("#t_m_p_l_9").hide();
		jQuery("#show_di_v").hide();
		jQuery("tr.co_lo_hi_d").hide();
	}
}
</script>
<style>
.lbl_temp {
	font-size: 15px;
	font-family: Courier New;
	margin-right: 0px;
	font-weight: bold;
}
label > input {
	display:none;
}
label > input + span {
	cursor:pointer;
	border:5px solid transparent;
}
label > input:checked + span {
	display:inline;
	background: #2580a2 url("<?php echo WEBLIZAR_ABOUT_ME_PLUGIN_URL.'settings/images/hover.png'; ?>") right center no-repeat;
	padding-right: 30px;
	border: 3px solid #000;
	padding-top: 10px;
	padding-bottom: 10px;
	padding-left: 30px;
}
li {
	padding-bottom:10px;
	color: #fff;
	margin: 0;
	padding: 12px 0px;
}
#temp_menu {
	font-weight: bolder;
}
#cssmenu {
	background: #333;
	list-style: none;
	margin: 0;
	padding: 0;
	float:left;
	height: auto;
	width: auto;
	margin-right: 150px;
}
</style>
<div  id='cssmenu' align="center" >
	<ul id="temp_menu">
		<li>
			<label class="lbl_temp arrow-left ">
				<input id="Tem_pl_at_e"name="Tem_pl_at_e" type="radio" value="11"  onclick=" dis_play_ed(this.value);"  <?php checked( '11',$Tem_pl_at_e ); ?> style="display:none;" />
				<span><?php _e('Template 1', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="12" onclick="dis_play_ed(this.value);"   <?php checked( '12',$Tem_pl_at_e ); ?> style="display:none;"/>
				<span><?php _e('Template 2', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="13" onclick="dis_play_ed(this.value);"   <?php checked( '13',$Tem_pl_at_e ); ?> style="display:none;"/>
				<span><?php _e('Template 3', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="14" onclick="dis_play_ed(this.value);"   <?php checked( '14',$Tem_pl_at_e ); ?> style="display:none;"/>
				<span><?php _e('Template 4', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="15" onclick="dis_play_ed(this.value);"   <?php checked( '15',$Tem_pl_at_e ); ?> style="display:none;"/>
				<span><?php _e('Template 5', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="16" onclick="dis_play_ed(this.value);"   <?php checked( '16',$Tem_pl_at_e ); ?> style="display:none;"/>
				<span><?php _e('Template 6', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="17" onclick="dis_play_ed(this.value);"   <?php checked( '17',$Tem_pl_at_e ); ?> style="display:none;"/>
				<span><?php _e('Template 7', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="18" onclick="dis_play_ed(this.value);"   <?php checked( '18',$Tem_pl_at_e ); ?> style="display:none;"/>
				<span><?php _e('Template 8', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="19" onclick="dis_play_ed(this.value);"   <?php checked( '19',$Tem_pl_at_e ); ?> style="display:none;"/>
				<span><?php _e('Template 9', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="20" onclick="dis_play_ed(this.value);"   <?php checked( '20',$Tem_pl_at_e ); ?> style="display:none;"/>
				<span><?php _e('Template 10', 'WL_ABTM_TXT_DM' ); ?></span>
			</label>
		</li>
	</ul>
</div>


<div id="t_m_p_l_1">
	<?php
	include("template1.php"); ?>
</div>

<div id="t_m_p_l_2">
	<?php
	include("template2.php"); ?>
</div>

<div id="t_m_p_l_3">
	<?php
	include("template3.php"); ?>
</div>

<div id="t_m_p_l_4">
	<?php
	include("template4.php"); ?>
</div>

<div id="t_m_p_l_5">
	<?php
	include("template5.php"); ?>
</div>

<div id="t_m_p_l_6">
	<?php
	include("template6.php"); ?>
</div>

<div id="t_m_p_l_7">
	<?php
	include("template7.php"); ?>
</div>

<div id="t_m_p_l_8">
	<?php
	include("template8.php"); ?>
</div>

<div id="t_m_p_l_9">
	<?php
	include("template9.php"); ?>
</div>

<div id="t_m_p_l_10">
	<?php
	include("template10.php"); ?>
</div>

<div id="show_di_v">
	<?php
	if($Tem_pl_at_e=='11') {
		include("template1.php");
	} elseif($Tem_pl_at_e=='12') {
		include("template2.php");
	}  elseif($Tem_pl_at_e=='13') {
		include("template3.php");
	} elseif($Tem_pl_at_e=='14') {
		include("template4.php");
	} elseif($Tem_pl_at_e=='15') {
		include("template5.php");
	} elseif($Tem_pl_at_e=='16') {
		include("template6.php");
	} elseif($Tem_pl_at_e=='17') {
		include("template7.php"); 
	} elseif($Tem_pl_at_e=='18') {
		include("template8.php");
	} elseif($Tem_pl_at_e=='19') {
		include("template9.php");
	} elseif($Tem_pl_at_e=='20') {
		include("template10.php");
	}
	?>
</div>
<script>
	jQuery("#t_m_p_l_1").hide();
	jQuery("#t_m_p_l_2").hide();
	jQuery("#t_m_p_l_3").hide();
	jQuery("#t_m_p_l_4").hide();
	jQuery("#t_m_p_l_5").hide();
	jQuery("#t_m_p_l_6").hide();
	jQuery("#t_m_p_l_7").hide();
	jQuery("#t_m_p_l_8").hide();
	jQuery("#t_m_p_l_9").hide();
	jQuery("#t_m_p_l_10").hide();
</script>
<?php add_shortcode( 'ABTM', 'ABOUTMEUSER' );
function ABOUTMEUSER( $Id ) {
	ob_start();
	if(isset($Id['id'])) {
		/**
		 * Load About Author Custom Post Type
		 */
		$ABTM_CPT_Name = "about_author";
		$AllABTM = array(  'p' => $Id['id'], 'post_type' => $ABTM_CPT_Name, 'orderby' => 'ASC', 'post_status' => 'publish');
		$loop = new WP_Query( $AllABTM );

		while ( $loop->have_posts() ) : $loop->the_post();

		$ID = get_the_ID();
		$abt_Settings = "abt_Settings_".$ID;
		$ABT_M_sets = unserialize(get_post_meta( $ID, $abt_Settings, true));
		if(is_array($ABT_M_sets)){
			foreach($ABT_M_sets as $ABT_Settings) {
				$p_o_s_t=$ID;
				$profile_user_image= $ABT_Settings['profile_user_image'];
				$user_header_image = $ABT_Settings['user_header_image'];
				$About_me_bg_color= $ABT_Settings['About_me_bg_color'];
				$About_me_user_name= $ABT_Settings['About_me_user_name'];
				$About_me_web_site_name= $ABT_Settings['About_me_web_site_name'];
				$About_me_dis_cription=$ABT_Settings['About_me_dis_cription'];
				$followfb=  $ABT_Settings['followfb'];
				$followgoogle=  $ABT_Settings['followgoogle'];
				$followinsta=  $ABT_Settings['followinsta'];
				$followlinkdln=  $ABT_Settings['followlinkdln'];
				$followpint=  $ABT_Settings['followpint'];
				$followtwit=  $ABT_Settings['followtwit'];
				$bodr =  $ABT_Settings['bodr'];
				$img_bdr_type =  $ABT_Settings['img_bdr_type'];
				$bdr_size =  $ABT_Settings['bdr_size'];
				$img_bdr_color =  $ABT_Settings['img_bdr_color'];
				$name_font_size =  $ABT_Settings['name_font_size'];
				$name_Color =  $ABT_Settings['name_Color'];

				$weblink_font_size =  $ABT_Settings['weblink_font_size'];
				$weblink_text_color =  $ABT_Settings['weblink_text_color'];

				$dis_font_size =  $ABT_Settings['dis_font_size'];
				$dis_text_color =  $ABT_Settings['dis_text_color'];

				$name_font_family = $ABT_Settings['PGPP_Font_Style'];
				$About_me_social_color = $ABT_Settings['About_me_social_color'];
				$About_me_custom_css = $ABT_Settings['About_me_custom_css'];
				$Tem_pl_at_e = $ABT_Settings['Tem_pl_at_e'];
				$Social_icon_size = $ABT_Settings['Social_icon_size'];
				$Us_sr_H_der_img_Witdh="100";
				$Us_sr_H_der_img_High="100";
				$my_hea_der_im_g=" ";
				if ($bodr == true ) {
					if($bodr=='1') {
						$my_bodr="border-radius:50% 50% 50% 50%";
					}
					if($bodr=='2') {
						$my_bodr="border-radius:10% 50% 10% 50%";
					}
					if($bodr=='3') {
						$my_bodr="border-radius:0% 0% 0% 0%";
					}
					if($bodr=='4') {
						$my_bodr="border-radius:10% 60% 10% 10%";
					}
					if($bodr=='5') {
						$my_bodr="border-radius:60% 60% 10% 10%";

					}
					if($bodr=='6') {
						$my_bodr="border-radius:100% 0% 0% 0%";

					}
					if($bodr=='7') {
						$my_bodr="border-radius:100% 0% 0% 500%";

					}
					if($bodr=='8') {
						$my_bodr="border-radius:50% 50% 50% 50% / 60% 60% 40% 40%";
					}
				}
				if($Tem_pl_at_e=='11') {
					include("shortcode-files/template1-shortcode.php");
				}
				if($Tem_pl_at_e=='12') {
					include("shortcode-files/template2-shortcode.php");
				}
				if($Tem_pl_at_e=='13') {
					echo "<div align='center' style='color: #b94a48;background-color: #f2dede; border-color: #b94a48;margin: 0px; display: block;height: 100px;'>
					<div style='position: relative;  top: 40%;font-weight: bolder;font-size: 100%;'>Sorry! Template Style 3 Available In Pro Plugin<br>Template Style 1 And Template Style 2 Available In This Plugin</div>
				</div>";
				}
				if($Tem_pl_at_e=='14') {
					echo "<div align='center' style='color: #b94a48;background-color: #f2dede; border-color: #b94a48;margin: 0px; display: block;height: 100px;'>
					<div style='position: relative;  top: 40%;font-weight: bolder;font-size: 100%;'>Sorry! Template Style 4 Available In Pro Plugin<br>Template Style 1 And Template Style 2 Available In This Plugin</div>
				</div>";
				}
				if($Tem_pl_at_e=='15') {
					echo "<div align='center' style='color: #b94a48;background-color: #f2dede; border-color: #b94a48;margin: 0px; display: block;height: 100px;'>
					<div style='position: relative;  top: 40%;font-weight: bolder;font-size: 100%;'>Sorry! Template Style 5 Available In Pro Plugin<br>Template Style 1 And Template Style 2 Available In This Plugin</div>
				</div>";
				}
				if($Tem_pl_at_e=='16') {
					echo "<div align='center' style='color: #b94a48;background-color: #f2dede; border-color: #b94a48;margin: 0px; display: block;height: 100px;'>
					<div style='position: relative;  top: 40%;font-weight: bolder;font-size: 100%;'>Sorry! Template Style 6 Available In Pro Plugin<br>Template Style 1 And Template Style 2 Available In This Plugin</div>
				</div>";
				}
				if($Tem_pl_at_e=='17') {
					echo "<div align='center' style='color: #b94a48;background-color: #f2dede; border-color: #b94a48;margin: 0px; display: block;height: 100px;'>
					<div style='position: relative;  top: 40%;font-weight: bolder;font-size: 100%;'>Sorry! Template Style 7 Available In Pro Plugin<br>Template Style 1 And Template Style 2 Available In This Plugin</div>
				</div>";
				}
				if($Tem_pl_at_e=='18') {
					echo "<div align='center' style='color: #b94a48;background-color: #f2dede; border-color: #b94a48;margin: 0px; display: block;height: 100px;'>
					<div style='position: relative;  top: 40%;font-weight: bolder;font-size: 100%;'>Sorry! Template Style 8 Available In Pro Plugin<br>Template Style 1 And Template Style 2 Available In This Plugin</div>
				</div>";
				}
				if($Tem_pl_at_e=='19') {
					echo "<div align='center' style='color: #b94a48;background-color: #f2dede; border-color: #b94a48;margin: 0px; display: block;height: 100px;'>
					<div style='position: relative;  top: 40%;font-weight: bolder;font-size: 100%;'>Sorry! Template Style 9 Available In Pro Plugin<br>Template Style 1 And Template Style 2 Available In This Plugin</div>
				</div>";
				}
				if($Tem_pl_at_e=='20') {
					echo "<div align='center' style='color: #b94a48;background-color: #f2dede; border-color: #b94a48;margin: 0px; display: block;height: 100px;'>
					<div style='position: relative;  top: 40%;font-weight: bolder;font-size: 100%;'>Sorry! Template Style 10 Available In Pro Plugin<br>Template Style 1 And Template Style 2 Available In This Plugin</div>
				</div>";
				}
			  }	// end of foreach
		 }// end of is_array
		endwhile;
	} else {
		echo "<div align='center' class='alert alert-danger'>".__("Sorry! Invalid About me Shortcode Embedded", WL_ABTM_TXT_DM )."</div>";
	}
	wp_reset_query();
	return ob_get_clean();
}?>
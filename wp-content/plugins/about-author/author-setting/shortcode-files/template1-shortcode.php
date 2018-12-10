<?php
$ABT_Settings = unserialize(get_option('author_info_Settings'));
if(count($ABT_Settings[0]))
{
	$switch_off_name = $ABT_Settings[0]['switch_off_name'];
	$switch_off_bio_info = $ABT_Settings[0]['switch_off_bio_info'];
	$switch_off_web = $ABT_Settings[0]['switch_off_web'];
	$switch_off_bio_info = $ABT_Settings[0]['switch_off_bio_info'];
	$switch_off_page = $ABT_Settings[0]['switch_off_page'];
	$switch_off_post = $ABT_Settings[0]['switch_off_post'];
	$auther_lbl_text = $ABT_Settings[0]['auther_lbl_text'];
	$Author_bg_color = $ABT_Settings[0]['Author_bg_color'];
	$Author_Color = $ABT_Settings[0]['Author_Color'];
	$auther_lbl_text_font = $ABT_Settings[0]['auther_lbl_text_font'];
	$Author_PGPP_Font_Style = $ABT_Settings[0]['Author_PGPP_Font_Style'];
}

?>
<style>
	@import url('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
	.menu li a:before {
		font-family: FontAwesome;
		speak: none;
		text-indent: 0em;
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
	#A_b_t_main_<?php echo  esc_attr($p_o_s_t); ?>.web_lizar_main_div
	{
		width:auto;
		height:auto;
		border:1px solid #ccc;
		background-color:<?php echo  esc_attr($About_me_bg_color);?>;
		overflow: hidden;
	}

	#A_b_t_img_<?php echo  esc_attr($p_o_s_t); ?>.web_lizar_image_div
	{
		margin-top: 35px;
	}
	#A_b_t_img_<?php echo  esc_attr($p_o_s_t); ?> img
	{
		height: 130px;
		width: 130px;
		<?php echo  esc_attr($my_bodr); ?>;
		border:<?php echo  esc_attr($bdr_size),"px"," ", esc_attr($img_bdr_type)," ", esc_attr($img_bdr_color); ?>;
		float: none;
		margin: 0 0em 0em 0;
		padding: 0px !important;
	}
	#A_b_t_name_div_<?php echo  esc_attr($p_o_s_t); ?> .web_lizar_user_name_div
	{
		margin-top: 25px
	}

	#A_b_t_name_div_<?php echo  esc_attr($p_o_s_t); ?> h3.name_user
	{
		color:<?php echo  esc_attr($name_Color); ?>;
		font-size:<?php echo  esc_attr($name_font_size); ?>px;
		font-family:<?php echo   esc_attr($name_font_family); ?> !important;
		margin-bottom: 0px;
		word-wrap:break-word;
		text-align: center;
	    font-weight: normal;	
	}

	#A_b_t_discription_div_<?php echo  esc_attr($p_o_s_t); ?>.web_lizar_discription_div
	{
		padding-left: 10px;
		padding-right: 10px;
		padding-bottom:0px !important;
		margin-top: 25px;
	}

	#A_b_t_discription_div_<?php echo  esc_attr($p_o_s_t); ?> p
	{
		color:<?php echo  esc_attr($dis_text_color); ?>;
		font-size:<?php echo  esc_attr($dis_font_size); ?>px;
		font-family:<?php echo   esc_attr($name_font_family); ?>;
		margin-bottom: 0em;
		word-wrap:break-word;
		text-align: center !important;
		line-height: normal !important;
	}
	#A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?>.web_lizar_social_icon_div_use
	{
		padding-left: 10px;
		padding-right: 10px;
		margin-top: 25px;
		height: auto;
	}


	#A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?> a>span.web_lizar_Social_icon
	{
		color:<?php echo  esc_attr($About_me_social_color); ?> !important;
        margin: 5px;
		font-family: FontAwesome;
		border-bottom:0;
		font-size:<?php echo  esc_attr($Social_icon_size);?>px;
	}
	#A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?> a
	{
		border-bottom: 0;
	}
	#A_b_t_web_link_div_auther<?php echo  esc_attr($p_o_s_t); ?>
	{
		margin-top: 25px ;
	}

	#A_b_t_web_link_div_auther<?php echo  esc_attr($p_o_s_t); ?> a.web_lizar_web_link
	{
		color:<?php echo  esc_attr($weblink_text_color); ?> !important;
		font-size:<?php echo  esc_attr($weblink_font_size);?>px;
		font-family:<?php echo   esc_attr($name_font_family); ?>;
		border-bottom: 0;
		word-wrap:break-word;
	}
	#A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?> a.icon
	{
		text-decoration:none;
		box-shadow: none !important;

	}
	#A_b_t_web_link_div_auther<?php echo  esc_attr($p_o_s_t) ; ?> a.icon
	{
		text-decoration:none;
		box-shadow: none !important;
	}

	#A_b_t_info_container_<?php echo  esc_attr($p_o_s_t); ?>.web_lizar_info_cotainer
	{
		margin-bottom: 40px;
	}
	#auther_bio_info.weblizar_auther_bio_info
	{   
		color:<?php echo  esc_attr($Author_Color); ?> !important;
		font-size:<?php echo  esc_attr($auther_lbl_text_font);?>px;
		font-family:<?php echo   esc_attr($Author_PGPP_Font_Style); ?> !important;
		background-color:<?php echo  esc_attr($Author_bg_color);?>;
		margin-bottom: 20px;
		height:auto;
		text-align: center;
	    padding: 10px;
        line-height: normal;
		}
</style>

<style type="text/css">
	<?php echo 	esc_attr($About_me_custom_css); ?>
</style>
<h1 id="auther_bio_info"  class="weblizar_auther_bio_info" align="center"><?php echo esc_attr($auther_lbl_text); ?></h1>
<div class="web_lizar_main_div " id="A_b_t_main_<?php echo  esc_attr($p_o_s_t); ?>">
	<div align="center" class="web_lizar_image_div " id="A_b_t_img_<?php echo  esc_attr($p_o_s_t); ?>" >
		<?php   $user_info = get_userdata($user_ID );  $pro_fi_le=$user_info->user_email; ?> <?php  echo get_avatar( $pro_fi_le, 130 );  ?>
	</div>
	<div id="A_b_t_info_container_<?php echo  esc_attr($p_o_s_t); ?>" class="web_lizar_info_cotainer" >

		<?php if($switch_off_name=='yes') {	?>
		<div align="center" class="web_lizar_user_name_div" id="A_b_t_name_div_<?php echo  esc_attr($p_o_s_t); ?>" >
			<h3 class="name_user" > <?php echo  esc_attr($About_me_user_name); ?> </h3>
		</div>
		<?php  } ?>

		<?php if($switch_off_bio_info=='yes') {	?>
		<div align="center" class="web_lizar_discription_div" id="A_b_t_discription_div_<?php echo  esc_attr($p_o_s_t); ?>"  >
			<p><?php echo  esc_attr($About_me_dis_cription); ?></p>
		</div>
		<?php  } ?>

		<div class="web_lizar_social_icon_div_use" id="A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?>"  align="center">
			<?php   if($followbitbucket !=="")
			{
				?>
				<a  class="icon " href="<?php echo  esc_url($followbitbucket); ?>" target="_blank" style="text-decoration: none;">
					<span id="bitbucket_jqs" class="fa fa-bitbucket web_lizar_Social_icon"  ></span>
				</a>
				<?php
			}
			?>
			<?php if($followdropbox !=="")
			{
				?>
				<a class="icon"  href="<?php echo esc_url($followdropbox); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-dropbox web_lizar_Social_icon"></span>
				</a>
				<?php
			}
			?>
			<?php if($followfb !=="")
			{
				?>

				<a class="icon"  href="<?php echo esc_url($followfb); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-facebook web_lizar_Social_icon"></span>
				</a>
				<?php
			}
			?>
			<?php if($followflicker !=="")
			{
				?>
				<a class="icon" href="<?php echo esc_url($followflicker); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-flickr web_lizar_Social_icon" ></span>
				</a>
				<?php
			}
			?>
			<?php   if($followgithub !=="")
			{
				?>
				<a class="icon"  href="<?php echo esc_url($followgithub); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-github web_lizar_Social_icon"></span>
				</a>
				<?php
			}
			?>
			<?php if($followgoogle !=="")
			{
				?>
				<a class="icon" href="<?php echo esc_url($followgoogle); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-google-plus  web_lizar_Social_icon"  ></span>
				</a>
				<?php
			}
			?>
			<?php if($followinsta !=="")
			{
				?>
				<a class="icon"  href="<?php echo esc_url($followinsta); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-instagram web_lizar_Social_icon" ></span>
				</a>
				<?php
			}
			?>
			<?php if($followlinkdln !=="")
			{
				?>
				<a class="icon"  href="<?php echo esc_url($followlinkdln); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-linkedin web_lizar_Social_icon">
					</span>
				</a>
				<?php
			}
			?>
			<?php   if($followpint !=="")
			{
				?>
				<a class="icon"  href="<?php echo esc_url($followpint); ?>" target="_blank" style="text-decoration: none;">
					<span  class="fa fa-pinterest web_lizar_Social_icon" >
					</span>
				</a>
				<?php
			}
			?>
			<?php   if($followtumbler !=="")
			{
				?>
				<a class="icon" href="<?php echo esc_url($followtumbler); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-tumblr web_lizar_Social_icon" >
					</span>
				</a>
				<?php
			}
			?>
			<?php   if($followtwit !=="")
			{
				?>

				<a class="icon"  href="<?php echo esc_url($followtwit); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-twitter web_lizar_Social_icon">
					</span>
				</a>
				<?php
			}
			?>

			<?php   if($followtVk !=="")
			{
				?>
				<a class="icon" href="<?php echo esc_url($followtVk); ?>" target="_blank" style="text-decoration: none;">
					<span class="fa fa-vk web_lizar_Social_icon"  >
					</span>
				</a>
				<?php
			}
			?>
		</div>

		<?php if($switch_off_web=='yes') {	?>
		<div align="center"  id="A_b_t_web_link_div_auther<?php echo  esc_attr($p_o_s_t); ?>" ><a target="_blank" class="web_lizar_web_link icon" href="<?php echo esc_url($About_me_web_site_name); ?>"><?php echo esc_attr($About_me_web_site_name); ?></a>
		</div>
		<?php  }?>
	</div>
</div>
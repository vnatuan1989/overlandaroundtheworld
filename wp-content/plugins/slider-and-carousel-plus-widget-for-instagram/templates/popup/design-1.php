<div class="iscwp-left-panel">
	<?php if( !empty($iscwp_data['is_video']) ) { ?>
		<video id="iscwp-player-<?php echo $count; ?>" class="iscwp-video" controls preload="false" poster="<?php echo $iscwp_data['display_url']; ?>">
			<source src="<?php echo $video_url; ?>" type="video/mp4"></source>
		</video>
	<?php } else { ?>
		<img class="iscwp-popup-img" src="<?php echo esc_url($iscwp_data['display_url']); ?>" alt="" />
	<?php } ?>
</div>

<div class="iscwp-right-panel">

	<div class="iscwp-user-head-box">

		<div class="iscwp-user-head-box-inner">
			<a class="iscwp-user-img" href="<?php echo $instagram_link_main.$username;?>" target="_blank">
				<img src="<?php echo $userdata['profile_picture'];?>" class="iscwp-img-user" alt="profile picture">
			</a>

			<a href="<?php echo $instagram_link_main.$username;?>" class="iscwp-username" target="_blank">
				<?php echo $userdata['username'];?>
			</a>

			<a href="<?php echo $instagram_link;?>" class="iscwp-view-on-insta-link" target="_blank">
				<?php esc_html_e($instagram_link_text); ?>
			</a>
		</div>

		<div class="iscwp-popup-meta">

			<?php if($show_likes_count == 'true') { ?>
				<div class="iscwp-popup-meta-row iscwp-popup-heart">
					<span class="likes"> <i class="fa fa-heart" aria-hidden="true"></i> <?php echo $iscwp_likes;?> </span>
				</div>
			<?php }

			if($show_comments_count == 'true') { ?>
				<div class="iscwp-popup-meta-row  iscwp-popup-heart-comment">
					<span class="comments"> <i class="fa fa-comment" aria-hidden="true"></i> <?php echo $iscwp_comments;?> </span>
				</div>
			<?php } ?>

			<?php if( !empty($location) ) { ?>
				<div class="iscwp-popup-meta-row">
					<span class="location">
						<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $location; ?>
					</span>
				</div>
			<?php } ?>
		</div>

		<?php if( isset($img_caption) && $show_caption == 'true') { ?>
			<div class="iscwp-caption-text">
				<?php echo nl2br( $img_caption ); ?>
			</div>
		<?php } ?>
	</div>
</div>
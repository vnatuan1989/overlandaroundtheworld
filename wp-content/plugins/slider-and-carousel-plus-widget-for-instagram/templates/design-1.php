<div class="<?php echo $wrpper_cls; ?>" data-item-index="<?php echo $count; ?>" style="<?php echo $offset_css; ?>" >
	<div class="iscwp-inr-wrp">		
		<div class="iscwp-inr-wrp-content">		
			<div class="iscwp-img-wrp" <?php echo $height_css; ?> >
				<?php if($instagram_link) { ?>
					<img class="iscwp-img" src="<?php echo $gallery_img_src ?>" title="title" alt="" />
					<?php if($show_likes_count =='true' || $show_comments_count == 'true') { ?>
						<div class="iscwp-meta">
							<div class="iscwp-meta-inner-wrap">
									<?php if($show_likes_count == 'true' && $iscwp_likes > 0) { ?>
										<div class="iscwp-likes-num<?php if($iscwp_comments <= 0){ echo ' iscwp-only-likes'; } ?>">
										<i class="fa fa-heart faa-pulse animated" aria-hidden="true"></i> <span><?php echo $iscwp_likes;?></span>
										</div>
									<?php } ?>
									<?php if($show_comments_count == 'true' && $iscwp_comments > 0){ ?>
										<div class="iscwp-meta-comment">
											<i class="fa fa-comment" aria-hidden="true"></i> <span><?php echo $iscwp_comments; ?></span>
					 					</div>
					 				<?php } ?>
				 			</div>
						</div>
					<?php } ?>
					<a class="iscwp-img-link" data-mfp-src="<?php echo $iscwp_link_value; ?>" href="javascript:void(0)" target="_blank" ></a>
				<?php } else { ?>
					<img class="iscwp-img" src="<?php echo $gallery_img_src ?>" title="title" alt="alter" />
				<?php } ?>
			</div>
		</div>
	</div>
</div>
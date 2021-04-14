<?php
	$author_info_box   = esc_attr(mixtape_qodef_options()->getOptionValue('blog_author_info'));
	$author_info_email = esc_attr(mixtape_qodef_options()->getOptionValue('blog_author_info_email'));
	$social_networks   = mixtape_qodef_get_user_custom_fields();
?>
<?php if($author_info_box === 'yes') { ?>
	<div class="qodef-author-description">
		<div class="qodef-author-description-inner">
			<div class="qodef-author-description-image">
				<?php echo mixtape_qodef_kses_img(get_avatar(get_the_author_meta( 'ID' ), 130)); ?>
			</div>
			<div class="qodef-author-description-text-holder">
				<h4 class="qodef-author-name">
					<?php
						if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
							echo esc_html__('Written By: ', 'mixtapewp') . esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
						} else {
							echo esc_html__('Written By: ', 'mixtapewp') . esc_attr(get_the_author_meta('display_name'));
						}
					?>
				</h4>
				<?php if($author_info_email === 'yes' && is_email(get_the_author_meta('email'))){ ?>
					<p class="qodef-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="qodef-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
				<?php if(is_array($social_networks) && count($social_networks)){ ?>
					<div class="qodef-author-social-icons clearfix">
						<?php foreach($social_networks as $network){ ?>
							<a itemprop="url" href="<?php echo esc_url($network['link'])?>" target="_blank">
								<?php echo mixtape_qodef_icon_collections()->renderIcon($network['class'], 'font_awesome'); ?>
							</a>
						<?php }?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
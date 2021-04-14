<div class="qodef-album-track-list <?php echo esc_attr($alb_skin); ?>" id="<?php echo esc_attr($random_id); ?>">
<?php
	$i = 1;
	foreach($tracks as $track):?>
		<div class="qodef-album-track" data-track-order="<?php echo esc_attr($i); ?>">
			<span class="qodef-at-title">
				<?php if(isset($track['title']) && $track['title'] != '') : ?>
					<span class="qodef-at-number"><?php echo esc_attr($i).'. '; ?></span><?php echo esc_attr($track['title']); ?>
				<?php endif; ?>
			</span>
			<span class="qodef-at-time"><?php echo esc_attr($track['track_time']); ?></span>
			<a class="qodef-at-play-button">
				<audio src="<?php echo esc_url($track['track_file']); ?>"></audio>
				<i class="arrow_triangle-right qodef-at-play-icon"></i><i class="icon_pause qodef-at-pause-icon"></i>
			</a>
			<span class="qodef-at-video-button-holder">
				<?php if(isset($track['video_link']) && $track['video_link'] != '') : ?>
					<a class="qodef-at-video-button" href="<?php echo esc_url($track['video_link']); ?>" data-rel="prettyPhoto" >
						<i class="fa fa-video-camera"></i>
					</a>
				<?php endif; ?>
			</span>
			<span class="qodef-at-download-holder">
				<?php if(isset($track['free_download']) && $track['free_download'] == 'yes') : ?>
					<a href="<?php echo esc_url($track['track_file']); ?>" class="qodef-at-download" download><i class="fa fa-download"></i></a>
				<?php endif; ?>
			</span>
		</div>
<?php
		$i++;
	endforeach;
?>
</div>
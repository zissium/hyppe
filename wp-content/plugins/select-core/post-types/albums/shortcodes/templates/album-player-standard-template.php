<div class="qodef-audio-player-wrapper <?php echo esc_attr($player_classes) ?>"  <?php qodef_core_inline_style($player_styles); ?> >
	<div id= "qodef-player-<?php echo esc_attr($player_id); ?>" class="jp-jplayer"></div>
	<?php if ($full_width_bg == 'yes'): ?>
		<div class="qodef-grid-section">
		<div class="clearfix qodef-section-inner">
	<?php endif; ?>
	<div id= "qodef-player-container-<?php echo esc_attr($player_id); ?>" class="qodef-audio-player-holder" data-album-id="<?php echo esc_attr($album); ?>">
		<div class="qodef-audio-player-info-holder">
			<?php if(has_post_thumbnail($album)) : ?>
				<div class="qodef-audio-player-image-holder">
					<?php echo get_the_post_thumbnail($album, 'thumbnail') ?>
				</div>
			<?php endif; ?>
			<div class="qodef-audio-player-text-holder">
				<span class="qodef-audio-player-title"></span>
				<span class="qodef-audio-player-album"></span>
			</div>
		</div>
		<div class="qodef-audio-player-controls-holder">

			<div class="jp-audio player-box">
				<div class="jp-gui jp-interface">
					<ul class="jp-controls">
						<li <?php qodef_core_inline_style($nav_buttons_styles); ?>><a class="jp-previous" ><i class="fa fa-fast-backward"></i></a></li><li <?php qodef_core_inline_style($play_button_styles); ?>><a class="jp-play" ><i class="fa fa-play"></i><i class="fa fa-pause"></i></a></li><li <?php qodef_core_inline_style($nav_buttons_styles); ?>><a class="jp-next" ><i class="fa fa-fast-forward"></i></a></li>
					</ul>
				</div>
				<div class="jp-type-playlist">
					<div class="jp-playlist">
						<ul class="tracks-list">
							<li></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="qodef-audio-player-time-holder">
			<div class="qodef-audio-player-progress-holder">
				<div class="jp-audio player-box">
					<div class="jp-gui jp-interface">
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="qodef-audio-player-current-time-holder">
				<div class="jp-audio player-box">
					<div class="jp-gui jp-interface">
						<div class="time-box">
							<span class="jp-current-time"></span>/<span class="jp-duration"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="qodef-audio-player-volume-holder">
			<div class="jp-volume-controls">
				<a class="jp-mute" role="button" tabindex="0"><i class="fa fa-volume-up" aria-hidden="true"></i><i class="fa fa-volume-off" aria-hidden="true"></i></a>
				<span class="jp-volume-bar">
					<span class="jp-volume-bar-value"></span>
				</span>
			</div>
		</div>
	</div>
	<?php if ($full_width_bg == 'yes'): ?>
		</div>
		</div>
	<?php endif; ?>
</div>
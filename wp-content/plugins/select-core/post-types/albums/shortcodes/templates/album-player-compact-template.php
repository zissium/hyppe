<div class="qodef-audio-player-wrapper <?php echo esc_attr($player_classes) ?>" >
	<div id= "qodef-player-<?php echo esc_attr($player_id); ?>" class="jp-jplayer"></div>
	<div id= "qodef-player-container-<?php echo esc_attr($player_id); ?>" class="qodef-audio-player-holder qodef-audio-player-compact " data-album-id="<?php echo esc_attr($album); ?>" <?php qodef_core_inline_style($player_styles); ?>>

		<div class = "qodef-audio-player-main-holder">
			<div class="qodef-audio-player-controls-holder">
				<div class="jp-audio player-box">
					<div class="jp-gui jp-interface">
						<ul class="jp-controls">
							<li <?php qodef_core_inline_style($nav_buttons_styles); ?>><a class="jp-previous" ><i class="fa fa-fast-backward"></i></a></li><!--
							--><li <?php qodef_core_inline_style($play_button_styles); ?>><a class="jp-play" ><i class="fa fa-play qodef-play-button"></i><i class="fa fa-pause qodef-pause-button"></i></a></li><!--
							--><li <?php qodef_core_inline_style($nav_buttons_styles); ?>><a class="jp-next" ><i class="fa fa-fast-forward"></i></a></li>
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
            <div class="qodef-audio-player-progress-holder">
                <div class="jp-audio player-box qodef-player-box ">
                    <div class="jp-gui jp-interface">
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="qodef-audio-player-details-holder">
				<div class= "qodef-audio-player-details">
					<div class="qodef-audio-player-text-holder">
                        <span class="qodef-audio-player-title"></span>
                        <span class="qodef-audio-player-album"></span>
                    </div>
					<div class="qodef-audio-player-time">
						<div class="jp-audio player-box">
							<div class="jp-gui jp-interface">
								<div class="time-box">
									<span class="jp-current-time"></span>/<span class="jp-duration"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
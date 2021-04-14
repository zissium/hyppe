<div class="qodef-artist">
    <?php
    $artist_params = array();
	$artist_params['animate'] = 'hover';
	$artist_params['cd_case_image'] = get_term_meta ($artist->term_id, 'artist_image', true );

    echo mixtape_qodef_execute_shortcode('qodef_album_disc',$artist_params);
    ?>
	<div class="qodef-artist-text-holder">
		<h6 class="qodef-artist-stage">
            <?php echo esc_attr(get_term_meta ($artist->term_id, 'artist_stage', true )); ?>
        </h6>
		<h4 class="qodef-artist-title">
				<?php echo esc_attr($artist->name); ?>
		</h4>
	</div>
</div>
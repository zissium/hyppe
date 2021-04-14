<div class="qodef-audio-playlist-holder">
	<?php
	$embed = wp_oembed_get( $playlist_url );
	print mixtape_qodef_get_module_part( $embed );
	?>
</div>

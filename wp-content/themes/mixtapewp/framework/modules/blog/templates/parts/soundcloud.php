<div class="qodef-blog-soundcloud-holder">
	<?php
	$audiolink = get_post_meta( get_the_ID(), "qodef_post_audio_soundcloud_link_meta", true );
	$embed     = wp_oembed_get( $audiolink );
	print mixtape_qodef_get_module_part( $embed );
	?>
</div>
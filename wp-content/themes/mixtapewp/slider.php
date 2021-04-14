<?php
$mixtape_qodef_slider_shortcode = get_post_meta(mixtape_qodef_get_page_id(), 'qodef_page_slider_meta', true);
if (!empty($mixtape_qodef_slider_shortcode)) { ?>
	<div class="qodef-slider">
		<div class="qodef-slider-inner">
			<?php echo do_shortcode(wp_kses_post($mixtape_qodef_slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php } ?>
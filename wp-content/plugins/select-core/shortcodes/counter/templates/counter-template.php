<?php
/**
 * Counter shortcode template
 */
?>
<div class="qodef-counter-holder <?php echo esc_attr($counter_holder_classes); ?>" <?php echo mixtape_qodef_get_inline_style($counter_holder_styles); ?>>

	<span class="qodef-counter <?php echo esc_attr($type) ?>" <?php echo mixtape_qodef_get_inline_style($counter_styles); ?>>
		<?php echo esc_attr($digit); ?>
	</span>
	<?php if($title != '') { ?>
		<<?php echo esc_html($title_tag); ?> class="qodef-counter-title" <?php echo mixtape_qodef_get_inline_style($title_styles); ?>>
			<?php echo esc_attr($title); ?>
		</<?php echo esc_html($title_tag);; ?>>
	<?php } ?>
	<?php if ($text != "") { ?>
		<p class="qodef-counter-text" <?php echo mixtape_qodef_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
	<?php } ?>

</div>
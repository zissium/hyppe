<div class="qodef-testimonial-content qodef-testimonials<?php echo esc_attr($current_id) ?>">
	<?php if (has_post_thumbnail($current_id)) { ?>
		<div class="qodef-testimonial-image-holder">
			<?php esc_html(the_post_thumbnail($current_id)) ?>
		</div>
	<?php } ?>
	<div class="qodef-testimonial-content-inner">
		<div class="qodef-testimonial-text-holder">
			<div class="qodef-testimonial-text-inner">
				<?php if($show_title == "yes" && $title != ''){ ?>
					<h3 class="qodef-testimonial-title">
						<?php echo esc_html($title) ?>
					</h3>
				<?php }?>
				<p class="qodef-testimonial-text"><?php echo trim($text) ?></p>
				<?php if ($show_author == "yes") { ?>
					<div class = "qodef-testimonial-author">
						<h4 class="qodef-testimonial-author-text"><?php echo esc_html($author)?>
							<?php if($show_position == "yes" && $job !== ''){ ?>
								<span class="qodef-testimonials-job"><?php echo esc_html($job)?></span>
							<?php }?>
						</h4>
					</div>
				<?php } ?>				
			</div>
		</div>
	</div>	
</div>

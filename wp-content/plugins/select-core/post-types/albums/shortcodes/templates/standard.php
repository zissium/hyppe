<div class="qodef-album">
	<div class = "qodef-album-image-holder">
		<a href="<?php echo esc_url($album_link); ?>">
			<?php
				echo get_the_post_thumbnail(get_the_ID(),'full');
			?>				
		</a>
	</div>
	<div class="qodef-album-text-holder">
		<h4 class="qodef-album-title">
			<a href="<?php echo esc_url($album_link); ?>">
				<?php echo esc_attr(get_the_title()); ?>
			</a>	
		</h4>
	</div>
</div>
<?php if($query_results->max_num_pages>1){ ?>
	<div class="qodef-albums-list-paging">
		<span class="qodef-albums-list-load-more">
			<?php 
				echo mixtape_qodef_get_button_html(array(
					'link' => 'javascript: void(0)',
					'text' => esc_html__('Show more', 'qodef-cpt')
				));
			?>
		</span>
	</div>
<?php }
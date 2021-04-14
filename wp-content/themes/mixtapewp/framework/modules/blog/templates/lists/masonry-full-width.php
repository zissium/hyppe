<?php mixtape_qodef_get_module_template_part('templates/lists/parts/filter', 'blog'); ?>
<div class="qodef-blog-holder qodef-blog-type-masonry qodef-masonry-full-width qodef-masonry-pagination-<?php echo mixtape_qodef_options()->getOptionValue('masonry_pagination'); ?>">
	<div class="qodef-blog-masonry-grid-sizer"></div>
	<div class="qodef-blog-masonry-grid-gutter"></div>
	<?php
	if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
		mixtape_qodef_get_post_format_html($blog_type);
	endwhile;
	else:
		mixtape_qodef_get_module_template_part('templates/parts/no-posts', 'blog');
	endif;
	?>
</div>
<?php
if(mixtape_qodef_options()->getOptionValue('pagination') == 'yes') {

	$pagination_type = mixtape_qodef_options()->getOptionValue('masonry_pagination');
	if($pagination_type == 'load-more' || $pagination_type == 'infinite-scroll'){
		if(get_next_posts_page_link($blog_query->max_num_pages)){ ?>
			<div class="qodef-blog-<?php echo esc_attr($pagination_type); ?>-button-holder">
					<span class="qodef-blog-<?php echo esc_attr($pagination_type); ?>-button" data-rel="<?php echo esc_attr($blog_query->max_num_pages); ?>">
						<?php
						echo mixtape_qodef_get_button_html(array(
							'link' => get_next_posts_page_link($blog_query->max_num_pages),
							'text' => esc_html__('Show more', 'mixtapewp')
						));
						?>
					</span>
			</div>
		<?php }
	}
}
?>
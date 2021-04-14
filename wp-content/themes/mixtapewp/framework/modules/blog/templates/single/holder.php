<?php if(($sidebar == "default")||($sidebar == "")) : ?>
	<div class="qodef-blog-holder qodef-blog-single">
		<?php mixtape_qodef_get_single_html(); ?>
	</div>
<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
	<div <?php echo mixtape_qodef_sidebar_columns_class(); ?>>
		<div class="qodef-column1 qodef-content-left-from-sidebar">
			<div class="qodef-column-inner">
				<div class="qodef-blog-holder qodef-blog-single">
					<?php mixtape_qodef_get_single_html(); ?>
				</div>
			</div>
		</div>
		<div class="qodef-column2">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
	<div <?php echo mixtape_qodef_sidebar_columns_class(); ?>>
		<div class="qodef-column1">
			<?php get_sidebar(); ?>
		</div>
		<div class="qodef-column2 qodef-content-right-from-sidebar">
			<div class="qodef-column-inner">
				<div class="qodef-blog-holder qodef-blog-single">
					<?php mixtape_qodef_get_single_html(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
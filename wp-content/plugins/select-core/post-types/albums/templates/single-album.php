<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <div class="qodef-core-album-content">
        <div class="qodef-core-album-title-holder">
            <h1><?php the_title(); ?></h1>
        </div>
        <?php if(has_post_thumbnail()) { ?>
            <div class="qodef-core-album-thumb-holder">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php } ?>
        <div class="qodef-core-album-content">
            <?php the_content(); ?>
        </div>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
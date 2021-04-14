

<div class="qodef-album" >
    <div class="qodef-album-inner" >
        <?php /*<a class="qodef-album-link" href="<?php echo esc_url($album_link); ?>"></a>*/?>
        <a class="qodef-album-link" data-toggle="modal" data-target="#wp-modal-<?= get_the_ID();?>"></a>
        <div class = "qodef-album-image-holder">
            <?php
            echo get_the_post_thumbnail(get_the_ID(),'full');
            ?>
        </div>
        <div class="qodef-album-text-overlay">
            <div class="qodef-album-text-overlay-inner">
                <div class="qodef-album-text-holder">
                    <?php
                    echo ($artist_html);
                    ?>
                    <h4 class="qodef-album-title">
                        <?php echo esc_attr(get_the_title()); ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($show_stores == 'yes'):
        $stores = get_post_meta(get_the_ID(), 'qodef_store_name', true);
        $stores_links = get_post_meta(get_the_ID(), 'qodef_store_link', true);
        $i = 0;
        ?>
        <?php if(is_array($stores) && count($stores) > 0 && implode($stores) != ''): ?>
        <div class="qodef-album-stores clearfix">
            <?php
            foreach($stores as $store) :
                if ( strpos($stores_list, $store) !== false ): ?>

                    <span class="qodef-album-store">
						<?php if(isset($stores_links[$i]) && $stores_links[$i]) : ?>
                            <a class="qodef-album-store-link" href="<?php echo esc_url($stores_links[$i]); ?>" target = "_blank">
								<?php echo qodef_fn_single_stores_names_and_images($store, 'image'); ?>
							</a>
                        <?php else: ?>
                            <?php echo qodef_fn_single_stores_names_and_images($store, 'image'); ?>
                        <?php endif; ?>
					</span>
                <?php
                endif;
                $i++;
            endforeach;
            ?>
        </div>
    <?php endif;
    endif; ?>
    <div class="modal" id="wp-modal-<?= get_the_ID();?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="clearfix">
                        <div class="pull-left" style="width:40%;">
                            <?php
                            echo get_the_post_thumbnail(get_the_ID(),'full');
                            ?>
                        </div>
                        <div class="pull-right" style="width:60%;">
                                <div class="albumlist brand"><span class="albumsabel">品牌:</span><?php echo mixtape_qodef_get_module_template_part('templates/single/parts/artist','albums'); ?></div>
                                <div class="albumlist label"><span class="albumsabel">合作领域:</span><?php echo mixtape_qodef_get_module_template_part('templates/single/parts/label','albums'); ?></div>
                                <div class="albumlist createat"><span class="albumsabel">开始时间:</span><?php echo mixtape_qodef_get_module_template_part('templates/single/parts/date','albums'); ?></div>
                                <div class="albumlist area"><span class="albumsabel">国家/地区:</span> <?php echo mixtape_qodef_get_module_template_part('templates/single/parts/genre','albums'); ?></div>
                                <div class="albumlist effect"><span class="albumsabel">效果:</span> <?php echo mixtape_qodef_get_module_template_part('templates/single/parts/people','albums'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(function(){
            jQuery("#wp-modal-<?= get_the_ID();?>").insertAfter('body');
        });
    </script>
</div>
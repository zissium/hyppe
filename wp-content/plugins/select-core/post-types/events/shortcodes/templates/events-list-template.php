<div class="qodef-event-content qodef-events<?php echo esc_attr(get_the_ID()) ?>" <?php qodef_core_inline_style($border_color_style); ?> >
	<div class="qodef-event-date-holder" <?php qodef_core_inline_style($text_color_style); ?>>
		<?php  if (!empty($date)) { ?>
			<div class="qodef-event-date-holder-left">
                            <span class="qodef-event-day-number-holder">
                                <?php echo date( 'd' , strtotime( $date ) ); ?>
                            </span>
			</div>
			<div class="qodef-event-date-holder-right">
                            <span class="qodef-event-day-holder">
                                <?php echo date_i18n( 'M' , strtotime( $date ) ); ?>
                            </span>
                            <span class="qodef-event-month-holder">
                                <?php echo date_i18n( 'D' , strtotime( $date ) ); ?>
                            </span>
			</div>
		<?php }  ?>


	</div>
	<div class="qodef-event-title-holder">
		<<?php echo esc_attr($title_tag); ?> class="qodef-event-title" <?php qodef_core_inline_style($text_color_style); ?>>
		<a href="<?php echo esc_url(get_permalink(get_the_ID())) ?>" target="_blank">
			<?php echo esc_html($title); ?>
		</a>
        </<?php echo esc_attr($title_tag); ?>>
    </div>
    <div class="qodef-event-buy-tickets-holder">
        <?php

        if($tickets_status == 'available'){ ?>
			<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" class="qodef-event-buy-tickets-button" <?php qodef_core_inline_style($text_color_style); ?>>
                <span><?php echo esc_html__( 'buy tickets','qodef-cpt' ); ?></span>
            </a>
        <?php
        }
        else if($tickets_status == 'sold')
        {
        ?>
            <span class="qodef-event-sold-out-holder" <?php qodef_core_inline_style($text_color_style); ?>>
            <?php  echo esc_html__( 'sold out!','qodef-cpt' ); ?>
            </span>
        <?php
        }
        else {
        ?>
            <span class="qodef-event-sold-out-holder" <?php qodef_core_inline_style($text_color_style); ?>>
            <?php  echo esc_html__( 'free!','qodef-cpt' ); ?>
            </span>
        <?php
        }
        ?>
    </div>
</div>
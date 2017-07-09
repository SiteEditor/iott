<?php
if (($current_month != iott_get_field('event_month')) && iott_get_field('event_month')) {
    $current_month = iott_get_field('event_month'); ?>
    <div class="day day-big <?php echo iott_get_field('event_color'); ?>">
        <div class="date"><span><?php echo iott_get_field('event_month'); ?></span></div>
    </div>
<?php } ?>

<div class="day <?php if (iott_get_field('event_is_active')) { echo "day--isSelected"; } ?> <?php echo iott_get_field('event_color'); ?>">
    <div class="date">
        <span>
            <?php iott_the_field( 'event_day' ); ?>
        </span>
    </div>

    <div class="hover">
        <span class="line"></span>

        <div class="hover-desc">

            <?php
            $event_logo_id = iott_get_field('event_image');

            $img = get_sed_attachment_image_html( $event_logo_id , "medium" );

            if ( ! $img ) {
                $img = array();
                $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
            }
            ?>

            <?php if (!iott_get_field('event_is_active')) { ?>

                <div class="image">

                    <?php echo $img['thumbnail'] ; ?>

                </div>

                <div class="text">
                    <p><?php the_excerpt(); ?></p>
                </div>

                <div class="title">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <span class="day-num"><?php iott_the_field('event_day'); ?></span>
                        <h6><?php the_title(); ?></h6>
                    </a>
                </div>

            <?php } else { ?>

                <div class="title">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <span class="day-num"><?php iott_the_field('event_day'); ?></span>
                        <h6><?php the_title(); ?></h6>
                    </a>
                </div>

                <div class="image">
                    <?php echo $img['thumbnail'] ; ?>
                   <!-- <img src="<?php //iott_the_field('event_image'); ?>" alt="<?php //the_title(); ?>"> -->
                </div>

                <div class="text">
                    <div><?php the_excerpt(); ?></div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>

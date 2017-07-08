<?php
if (($current_month != get_field('event_month')) && get_field('event_month')) {
    $current_month = get_field('event_month'); ?>
    <div class="day day-big <?php echo get_field('event_color'); ?>">
        <div class="date"><span><?php echo get_field('event_month'); ?></span></div>
    </div>
<?php } ?>

<div class="day <?php if (get_field('event_is_active')) { echo "day--isSelected"; } ?> <?php echo get_field('event_color'); ?>">
    <div class="date"><span><?php the_field('event_day'); ?></span></div>

    <div class="hover">
        <span class="line"></span>

        <div class="hover-desc">

            <?php if (!get_field('event_is_active')) { ?>

                <div class="image">
                    <img src="<?php the_field('event_image'); ?>" alt="<?php the_title(); ?>">
                </div>

                <div class="text">
                    <p><?php the_excerpt(); ?></p>
                </div>

                <div class="title">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <span class="day-num"><?php the_field('event_day'); ?></span>
                        <h6><?php the_title(); ?></h6>
                    </a>
                </div>

            <?php } else { ?>

                <div class="title">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <span class="day-num"><?php the_field('event_day'); ?></span>
                        <h6><?php the_title(); ?></h6>
                    </a>
                </div>

                <div class="image">
                    <img src="<?php the_field('event_image'); ?>" alt="<?php the_title(); ?>">
                </div>

                <div class="text">
                    <p><?php the_excerpt(); ?></p>
                </div>

            <?php } ?>

        </div>
    </div>
</div>

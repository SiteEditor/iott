<div class="item">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
            <?php the_post_thumbnail('s4x3'); ?>
        <?php endif; ?>

        <div class="caption">
            <h5><?php the_title(); ?><hr class="little-separator" /><span><?php the_field('subtitle'); ?></span></h5>
            <p><?php the_excerpt(); ?></p>
        </div>
    </a>
</div>

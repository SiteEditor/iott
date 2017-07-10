<?php

if ( ! empty( $title ) ) {
    echo $args['before_title'] . $title . $args['after_title'];
}

if ( $nsfp_query->have_posts() ) : ?>

    <ul>
        <?php while ( $nsfp_query->have_posts() ) : $nsfp_query->the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>&nbsp;
                <?php if ( $show_date ) : ?>
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                <?php endif; ?>
            </li>
        <?php endwhile; ?>
    </ul>

    <?php wp_reset_postdata(); ?>

<?php endif; ?>

<div class="banners">

    <a class="image">
        <img src="http://stars.starsideas.org/wp-content/uploads/2015/06/1-image1.jpg" alt="">
        <span class="play-icon"></span>
    </a>
  
    <a class="title text-center">بایگانی ویدیوها</a>
    
</div>
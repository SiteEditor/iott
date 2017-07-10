
<div class="img-lists-element">
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

    <aside class="img-lists-element-inner">                

        <div class="img-lists-item">
            <a href="" class="img-lists-thumbnail">
                <img src="http://stars.starsideas.org/wp-content/uploads/2015/06/1-image1-150x150.jpg"> 
            </a>
            <div class="img-lists-content">
                <a class="img-lists-heading" href=""> Custom Style 1 </a>
                <div class="img-lists-text">A WordPress Custom Style Custom Style Commenter on Hello world4!</div>
            </div>
        </div>
        <div class="img-lists-item">
            <a href="" class="img-lists-thumbnail">
                <img src="http://stars.starsideas.org/wp-content/uploads/2015/06/2-slid-150x150.jpg"> 
            </a>
            <div class="img-lists-content">
                <a class="img-lists-heading" href=""> Custom Style 2 </a>
                <div class="img-lists-text">A WordPress Custom Style Custom Style Commenter on Hello world4!</div>
            </div>
        </div>

        <div class="img-lists-item">
            <a href="" class="img-lists-thumbnail">
                <img src="http://stars.starsideas.org/wp-content/uploads/2015/06/3-video1-150x150.jpg"> 
            </a>
            <div class="img-lists-content">
                <a class="img-lists-heading" href=""> Custom Style 3 </a>
                <div class="img-lists-text">A WordPress Custom Style Custom Style Commenter on Hello world4!</div>
            </div>
        </div>

        <div class="img-lists-item">
            <a href="" class="img-lists-thumbnail">
                <img src="http://stars.starsideas.org/wp-content/uploads/2015/06/1-image1-150x150.jpg"> 
            </a>
            <div class="img-lists-content">
                <a class="img-lists-heading" href=""> Custom Style 4 </a>
                <div class="img-lists-text">A WordPress Custom Style Custom Style Commenter on Hello world4!</div>
            </div>
        </div>

    </aside>
</div>
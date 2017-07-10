<div class="featured-post-widget-style2">

    <?php

    if ( ! empty( $title ) ) {
        echo $args['before_title'] . $title . $args['after_title'];
    }

    if ( $nsfp_query->have_posts() ) : ?>

        <div class="banners">
            <?php while ( $nsfp_query->have_posts() ) : $nsfp_query->the_post(); ?>

                <div class="banner">

                    <?php
                    $link = $link_to_archive ? get_post_type_archive_link( $post_type ) : get_the_permalink();

                    $title = $link_to_archive && !empty( $replace_title ) ? $replace_title : get_the_title();
                    ?>

                    <a href="<?php echo $link; ?>" class="image">
                        <?php
                        $attachment_id = get_post_thumbnail_id( get_the_ID() );

                        $img = get_sed_attachment_image_html( $attachment_id , "medium");

                        if ( ! $img ) {
                            $img = array();
                            $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                        }

                        echo $img['thumbnail'];

                        ?>
                    </a>

                    <a class="title text-center" href="<?php echo $link; ?>"><?php echo $title; ?></a>

                    <?php if ( $show_date ) : ?>
                        <span class="post-date"><?php echo get_the_date(); ?></span>
                    <?php endif; ?>

                </div>

            <?php endwhile; ?>
        </div>

        <?php wp_reset_postdata(); ?>

    <?php endif; ?>

</div>
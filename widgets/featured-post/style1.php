<div class="img-lists-element featured-post-widget-style1">

    <?php
    if ( ! empty( $title ) ) {
        echo $args['before_title'] . $title . $args['after_title'];
    }

    if ( $nsfp_query->have_posts() ) : ?>

        <aside class="img-lists-element-inner">

            <?php while ( $nsfp_query->have_posts() ) : $nsfp_query->the_post(); ?>

                <div class="img-lists-item">
                    <a href="<?php the_permalink(); ?>" class="img-lists-thumbnail">
                        <?php
                        $attachment_id = get_post_thumbnail_id( get_the_ID() );

                        $img = get_sed_attachment_image_html( $attachment_id , "thumbnail");

                        if ( ! $img ) {
                            $img = array();
                            $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                        }

                        echo $img['thumbnail'];

                        ?>
                    </a>
                    <div class="img-lists-content">
                        
                        <a class="img-lists-heading" href="<?php the_permalink(); ?>"> 
                        <?php 
                        
                        $title = get_the_title();
                          
                        if( strlen($title) > 35 ){                                         
                            $title = mb_substr( $title , 0, 35 )."...";
                        }
                        
                        echo $title; 
                        
                        ?> 
                        </a>
                        
                        <?php if ( $show_date ) : ?>
                            <div class="img-lists-text"><span class="post-date"><?php echo get_the_date(); ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endwhile; ?>

        </aside>

        <?php wp_reset_postdata(); ?>

    <?php endif; ?>

</div>
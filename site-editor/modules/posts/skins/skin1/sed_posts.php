<div <?php echo $sed_attrs; ?> class="module module-posts module-posts-skin1 <?php echo $class; ?> ">

    <?php

    $custom_query = new WP_Query( $args );

    if ( $custom_query->have_posts() ){

        ?>

        <section class="newsbar">

            <div class="sed-row-boxed">

                <ul class="hidden" id="typed-strings">

                    <?php
                    // Start the Loop.
                    while ( $custom_query->have_posts() ){
                        $custom_query->the_post();

                        include dirname(__FILE__) . '/content.php';

                    }

                    ?>

                </ul>

                <div class="row">

                    <div class="col-sm-8 col-lg-9">
                        <span class="newsbar__title"><?php echo $title;?>: </span>
                        <span class="virtual-list-item js-newsbar-functionality"></span>
                    </div>

                    <div class="col-sm-4 col-lg-3">

                        <div class="newsbar__description text-left">
                            <?php

                            $link = get_post_type_archive_link( $args['post_type'] );

                            if( !empty( $taxonomy ) && !empty( $terms ) ){

                                $terms = is_string( $terms ) && !empty( $terms ) ? explode( "," , $terms ) : array();

                                if( isset( $terms[0] ) ){

                                    $link = get_term_link( get_term( $terms[0] ) , $taxonomy );

                                }

                            }

                            $link = esc_attr( esc_url( $link ) );

                            $lik_start = sprintf(  '<a href="%1$s" title="%2$s">', $link , __("click here" , "iott") );

                            $link_end = '</a>';

                            echo sprintf(
                                __('For more information %1$s click here %2$s',"iott") ,
                                $lik_start,
                                $link_end
                            );

                            ?>
                        </div>

                    </div>
                </div>

            </div>

        </section>

        <?php

        wp_reset_postdata();

    }else{ ?>
        
        <div class="not-found-post">
            <p><?php echo __("Not found result" , "site-editor" ); ?> </p>
        </div>
        
    <?php 
        
    }
    
    wp_reset_query();
    
    ?>
    
</div>
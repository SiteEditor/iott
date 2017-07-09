<div <?php echo $sed_attrs; ?> class="module module-posts module-posts-skin3 <?php echo $class; ?> ">

    <section class="timeline">

        <?php
        if( $show_title ) {
            ?>
            <div class="timeLineHeader">
                <h3><?php echo $title;?></h3>
            </div>
            <?php
        }
        ?>

        <?php
        $custom_query = new WP_Query( $args );

        if ( $custom_query->have_posts() ){

            ?>

            <div class="sed-row-doxed">
                <div class="slider-wrap">
                    <div class="days carousel">

                        <?php
                        // Start the Loop.
                        $current_month = '';

                        while ( $custom_query->have_posts() ){
                            $custom_query->the_post();

                            include dirname(__FILE__) . '/content.php';

                        }

                        ?>

                    </div>
                </div>
            </div>

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

    </section>

</div>
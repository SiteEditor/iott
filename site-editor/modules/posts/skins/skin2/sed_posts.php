<div <?php echo $sed_attrs; ?> class="module module-posts module-posts-skin2 <?php echo $class; ?> ">

    <?php
    if( $show_title ) {
        ?>
        <div class="posts-entry-title"><?php echo $title;?></div>
        <?php
    }

    $custom_query = new WP_Query( $args );

    if ( $custom_query->have_posts() ){

        ?>

        <section class="customers">
            <div class="slider-wrap">
                <div class="carousel">

                    <?php
                    // Start the Loop.
                    while ( $custom_query->have_posts() ){
                        $custom_query->the_post();

                        include dirname(__FILE__) . '/content.php';

                    }

                    ?>

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
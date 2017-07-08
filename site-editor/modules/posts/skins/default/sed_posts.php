<div <?php echo $sed_attrs; ?> class="module module-posts module-posts-default <?php echo $class; ?> ">

    <?php
    if( $show_title ) {
        ?>
        <div class="posts-entry-title"><?php echo $title;?></div>
        <?php
    }

    $custom_query = new WP_Query( $args );

    if ( $custom_query->have_posts() ){

        ?>

        <div class="sed-raw-about-images">

            <?php
            // Start the Loop.
            while ( $custom_query->have_posts() ){
                $custom_query->the_post();

                include dirname(__FILE__) . '/content.php';

            }

            ?>

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
    
</div>
<div class="personnel" <?php if ( '' !== get_the_post_thumbnail() ) { ?> style="background-image: url('<?php the_post_thumbnail_url('full');?>')" <?php } ?>>

    <?php
    if ( '' !== get_the_post_thumbnail() ) {
        ?>

        <img src="<?php the_post_thumbnail_url('full');?>" alt="">

        <?php
    }
    ?>

    <div class="inner-wrapper">

        <div class="name">
            <?php the_title();?>
        </div>

        <div class="title">
            <?php
            $job = get_post_meta( get_the_ID() , 'wpcf-bio_job' , true );

            echo apply_filters( 'the_title' , $job );
            ?>
        </div>

        <div class="splitter"></div>

        <div class="excerpt">
            <p>
               <?php the_content();?>
            </p>
        </div>

        <div class="social">
            <?php
            $facebook = get_post_meta( get_the_ID() , 'wpcf-bio_facebook' , true );

            if( !empty( $facebook ) ) {
                ?>
                <a href="<?php echo esc_attr( esc_url( $facebook ) );?>"><i class="fa fa-facebook"></i></a>
                <?php
            }

            $google_plus = get_post_meta( get_the_ID() , 'wpcf-bio_google_plus' , true );

            if( !empty( $google_plus ) ) {
                ?>
                <a href="<?php echo esc_attr( esc_url( $google_plus ) );?>"><i class="fa fa-google-plus"></i></a>

                <?php
            }

            $linkedin = get_post_meta( get_the_ID() , 'wpcf-bio_linkedin' , true );

            if( !empty( $linkedin ) ) {
                ?>
                <a href="<?php echo esc_attr( esc_url( $linkedin ) );?>"><i class="fa fa-linkedin"></i></a>

                <?php
            }

            $instagram = get_post_meta( get_the_ID() , 'wpcf-bio_instagram' , true );

            if( !empty( $instagram ) ) {
                ?>
                <a href="<?php echo esc_attr( esc_url( $instagram ) );?>"><i class="fa fa-instagram"></i></a>

                <?php
            }

            $telegram = get_post_meta( get_the_ID() , 'wpcf-bio_telegram' , true );

            if( !empty( $telegram ) ) {

                ?>
                <a href="<?php echo esc_attr( esc_url( $telegram ) );?>"><i class="fa fa-telegram"></i></a>
                <?php

            }
            ?>
        </div>

    </div>

</div>


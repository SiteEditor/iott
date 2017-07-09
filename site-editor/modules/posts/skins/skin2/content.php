<div class="item">
    <a href="<?php iott_the_field('customer_link_url'); ?>" title="<?php the_title(); ?>">
        <?php

        $attachment_id   = get_post_thumbnail_id();
        
        $img = get_sed_attachment_image_html( $attachment_id , "" , "220X160" );

        if ( ! $img ) {
            $img = array();
            $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
        }

        echo $img['thumbnail'];

        ?>
    </a>
</div>

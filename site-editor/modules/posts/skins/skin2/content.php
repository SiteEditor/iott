<div>
    <a href="<?php the_field('customer_link_url'); ?>" title="<?php the_title(); ?>">
        <?php

        $img = get_sed_attachment_image_html( $attachment_id , $images_size );

        if ( ! $img ) {
            $img = array();
            $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
        }

        echo $img['thumbnail'];

        ?>
    </a>
</div>

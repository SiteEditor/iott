<div class="item">

	<?php

    $attachment_id   = get_post_thumbnail_id();

	$img = get_sed_attachment_image_html( $attachment_id , "" , "320X240" );

	/*$attachment_full_src = wp_get_attachment_image_src( $attachment_id, 'full' ); 

	$attachment_full_src = $attachment_full_src[0];

	$excerpt_length = 50;

    $content_post = apply_filters('the_excerpt', get_the_excerpt());

    # FILTER EXCERPT LENGTH
    if( strlen( $content_post ) > $excerpt_length )
        $content_post = mb_substr( $content_post , 0 , $excerpt_length - 3 ) . '...';*/

    ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        	<?php 
		        if ( $img ) {
		        	echo $img['thumbnail'];
		        }
	        ?>

        <div class="caption">
            <h5><?php the_title(); ?><hr class="little-separator" /><span><?php iott_the_field('subtitle'); ?></span></h5>
        </div>
    </a>
</div>

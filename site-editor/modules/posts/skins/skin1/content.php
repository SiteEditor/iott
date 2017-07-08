<li>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php

        $post_title = get_the_title();

        if( strlen( $post_title ) > $excerpt_length ){

            $post_title = mb_substr( get_the_title(), 0, $excerpt_length ) . "...";

        }

        echo $post_title;

        ?>
    </a>
</li>

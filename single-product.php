<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area blog-content-area">
        <main id="main" class="site-main" role="main">
            <section class="content">
                <?php sed_iott_breadcrumbs(); ?>

                <?php 

                    /* Start the Loop */
                while ( have_posts() ) : the_post();
                    

                    ?>  

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="row">
                            <div class="col-md-4">

                                <?php
                                $product_gallery = iott_get_field( 'iott_product_gallery' );

                                $product_gallery = is_string( $product_gallery ) && !empty( $product_gallery ) ? explode( "," , $product_gallery ) : $product_gallery;

                                $product_gallery = is_array( $product_gallery ) ? $product_gallery : array();

                                if ( '' !== get_the_post_thumbnail() ){

                                    $post_thumbnail_id = get_post_thumbnail_id( $post_id );

                                    array_unshift( $product_gallery , $post_thumbnail_id );

                                }

                                $product_gallery = array_filter( $product_gallery , 'absint' );

                                ?>

                                <div class="single-product-thumbnails-slider">
                                    <div class="slider-wrap">
                                        <div class="carousel">

                                            <?php
                                            if( !empty( $product_gallery ) ) {
                                                foreach ($product_gallery AS $attach_id ) {

                                                    $img = get_sed_attachment_image_html( $attach_id , "large" );

                                                    if ( ! $img ) {
                                                        $img = array();
                                                        $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                                                    }

                                                    ?>

                                                    <div class="item">
                                                        <?php echo $img['thumbnail'];?>
                                                    </div>

                                                    <?php

                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="single-product-nav-slider">
                                    <div class="slider-wrap">
                                        <div class="carousel">

                                            <?php
                                            if( !empty( $product_gallery ) ) {
                                                foreach ($product_gallery AS $attach_id ) {

                                                    $img = get_sed_attachment_image_html( $attach_id , "thumbnail" );

                                                    if ( ! $img ) {
                                                        $img = array();
                                                        $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                                                    }

                                                    ?>

                                                    <div class="item">
                                                        <?php echo $img['thumbnail'];?>
                                                    </div>

                                                    <?php

                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-8">
                                <header class="entry-header">
                                    <h3>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <span><?php the_title(); ?></span>
                                            <small><?php iott_the_field('subtitle'); ?></small>
                                        </a>
                                    </h3>

                                    <?php $str = get_terms_string(get_the_ID(), 'product_category', 'دسته: ', ' '); ?>
                                    <?php $term = get_the_terms(get_the_ID(), 'product_category')[0]->term_id; ?>
                                    <div class="meta">
                                        <?php echo $str; the_tags("برچسب‌ها: ", "، "); ?>
                                    </div>
                                </header>

                                <section class="entry-content">
                                    <h3 class="sectionTitle">توضیحات محصول:</h3>

                                    <div class="entry">
                                        <?php the_content(); ?>
                                        <?php echo do_shortcode("[apss_share]"); ?>
                                    </div>

                                    <?php if (iott_get_field('link_video')) { ?>
                                    <div class="watchVideo">
                                        <a href="<?php iott_the_field('link_video'); ?>" class="fancybox" data-fancybox-type="iframe">مشاهده ویدیو</a>
                                    </div>
                                    <?php } ?>
                                </section>
                            </div>
                        </div>
                    </article>
                    <?php
                    endwhile; // End of the loop.
                ?>

                <?php
                $related_products = (array)iott_get_field( 'related_products' ); 
                $related_products = array_filter( $related_products );
               
                if( !empty( $related_products ) ){
                ?>
                <section class="productSections relatedProducts">
                    <h4 class="sectionTitle"><span>محصولات مرتبط</span></h4>

                    <div class="slider-wrap">
                        <div class="carousel">
                            <?php
                            $args = array(
                                'post_type' => 'product',
                                //'showposts' => 18,
                                'post__in'  => $related_products,
                                'orderby'   => 'post__in'
                            );
                            ?>
                            <?php query_posts($args); while (have_posts()) : the_post(); ?>
                            <div class="item">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                        <?php the_post_thumbnail('s1x1'); ?>
                                    <?php endif; ?>

                                    <div class="caption">
                                        <h5><?php the_title(); ?><hr class="little-separator" /><span><?php iott_the_field('subtitle'); ?></span></h5>
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                </a>
                            </div>
                            <?php endwhile; wp_reset_query(); ?>
                        </div>
                    </div>
                </section>
                <?php } 

                $suggestion_products = (array)iott_get_field( 'suggestion_products' );
                $suggestion_products = array_filter( $suggestion_products );

                if( !empty( $suggestion_products ) ){
                ?>

                <section class="productSections selectedProducts">
                    <h4 class="sectionTitle"><span>محصولات پیشنهادی</span></h4>

                    <?php
                    

                    $args = array(
                        'post_type' => 'product',
                        //'showposts' => 18,
                        'post__in'  => $suggestion_products,
                        'orderby'   => 'post__in'
                    );
                    ?>
                    <div class="slider-wrap">
                        <div class="carousel" data-flickity='{"percentPosition": false, "rightToLeft": true, "cellAlign": "right", "autoPlay": 15000, "groupCells": true }'> <!-- "contain": true, "wrapAround": true, -->
                            <?php query_posts( $args ); while (have_posts()) : the_post(); ?>
                            <div class="item">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                        <?php the_post_thumbnail('s1x1'); ?>
                                    <?php endif; ?>

                                    <div class="caption">
                                        <h5><?php the_title(); ?><hr class="little-separator" /><span><?php iott_the_field('subtitle'); ?></span></h5>
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                </a>
                            </div>
                            <?php endwhile; wp_reset_query(); ?>
                        </div>
                    </div>
                </section>

                <?php } ?>

            </section>
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
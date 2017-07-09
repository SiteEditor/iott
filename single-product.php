<?php get_header(); ?>

    <main class="main">
        <div class="container">
            <div class="col-sm-3">
                <?php get_sidebar(); ?>
            </div>

            <div class="col-sm-9">
                <section class="content">
                    <?php sed_iott_breadcrumbs(); ?>

                    <?php if (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="row">
                            <div class="col-md-4">
                                <?php if ('' !== get_the_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('s1x1'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-8">
                                <header class="entry-header">
                                    <h3>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <span><?php the_title(); ?></span>
                                            <small><?php the_field('subtitle'); ?></small>
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

                                    <?php if (get_field('link_video')) { ?>
                                    <div class="watchVideo">
                                        <a href="<?php the_field('link_video'); ?>" class="fancybox" data-fancybox-type="iframe">مشاهده ویدیو</a>
                                    </div>
                                    <?php } ?>
                                </section>
                            </div>
                        </div>
                    </article>
                    <?php
                    else : 
                        echo "صفحه مورد نظر یافت نشد.";
                    endif; ?>

                    <section class="productSections relatedProducts">
                        <h4 class="sectionTitle"><span>محصولات مرتبط</span></h4>

                        <div class="slider-wrap">
                            <div class="carousel" data-flickity='{"percentPosition": false, "rightToLeft": true, "cellAlign": "right", "autoPlay": 15000, "groupCells": true }'> <!-- "contain": true, "wrapAround": true, -->
                                <?php $args = array('post_type' => 'product', 'showposts' => 18, 'tax_query' => array(array('taxonomy' => 'product_category', 'terms' => $term, 'field' => 'term_id'))); ?>
                                <?php query_posts($args); while (have_posts()) : the_post(); ?>
                                <div class="item">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                            <?php the_post_thumbnail('s1x1'); ?>
                                        <?php endif; ?>

                                        <div class="caption">
                                            <h5><?php the_title(); ?><hr class="little-separator" /><span><?php the_field('subtitle'); ?></span></h5>
                                            <p><?php the_excerpt(); ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php endwhile; wp_reset_query(); ?>
                            </div>
                        </div>
                    </section>

                    <section class="productSections selectedProducts">
                        <h4 class="sectionTitle"><span>محصولات پیشنهادی</span></h4>

                        <div class="slider-wrap">
                            <div class="carousel" data-flickity='{"percentPosition": false, "rightToLeft": true, "cellAlign": "right", "autoPlay": 15000, "groupCells": true }'> <!-- "contain": true, "wrapAround": true, -->
                                <?php query_posts("post_type=product&showposts=18&orderby=rand"); while (have_posts()) : the_post(); ?>
                                <div class="item">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                            <?php the_post_thumbnail('s1x1'); ?>
                                        <?php endif; ?>

                                        <div class="caption">
                                            <h5><?php the_title(); ?><hr class="little-separator" /><span><?php the_field('subtitle'); ?></span></h5>
                                            <p><?php the_excerpt(); ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php endwhile; wp_reset_query(); ?>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </div>
    </main>

<?php get_footer(); ?>
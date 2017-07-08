<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <main class="main">
        <div class="container">
            <div class="col-sm-3">
                <?php get_sidebar(); ?>
            </div>

            <div class="col-sm-9">
                <section class="content">
                    <?php $i = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post row'); ?>>

                    <?php if (($i % 2) == 0) { ?>

                        <?php if (get_field('show_thumbnail')) { ?>

                        <div class="col-lg-12">
                            <header class="entry-header">
                                <div class="category">
                                    <?php the_category(); ?>
                                </div>

                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                <hr class="little-separator" />
                            </header>

                            <section class="entry-content">
                                <p class="excerpt"><?php the_excerpt(); ?></p>

                                <?php if (get_field('advertise_image') != null) { ?>
                                <div class="sponsor">
                                    <h6>Sponsored By:</h6>
                                    <a href="<?php the_field('advertise_link'); ?>" target="_blank"><img src="<?php the_field('advertise_image'); ?>" alt=""></a>
                                </div>
                                <?php } ?>

                                <div class="more-info">
                                    <a href="<?php the_permalink(); ?>" title="اطلاعات بیشتر در رابطه با <?php the_title(); ?>">اطلاعات بیشتر</a>
                                </div>
                            </section>
                        </div>

                        <?php } else { ?>

                        <div class="col-lg-6">
                            <?php if ('' !== get_the_post_thumbnail() && ! is_single()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('home'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6">
                            <header class="entry-header">
                                <div class="category">
                                    <?php the_category(); ?>
                                </div>

                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                <hr class="little-separator" />
                            </header>

                            <section class="entry-content">
                                <p class="excerpt"><?php the_excerpt(); ?></p>

                                <?php if (get_field('advertise_image') != null) { ?>
                                <div class="sponsor">
                                    <h6>Sponsored By:</h6>
                                    <a href="<?php the_field('advertise_link'); ?>" target="_blank"><img src="<?php the_field('advertise_image'); ?>" alt=""></a>
                                </div>
                                <?php } ?>

                                <div class="more-info">
                                    <a href="<?php the_permalink(); ?>" title="اطلاعات بیشتر در رابطه با <?php the_title(); ?>">اطلاعات بیشتر</a>
                                </div>
                            </section>
                        </div>

                        <?php } ?>

                    <?php } else { ?>

                        <?php if (get_field('show_thumbnail')) { ?>
                        <div class="col-lg-12">
                            <header class="entry-header">
                                <div class="category">
                                    <?php the_category(); ?>
                                </div>

                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                <hr class="little-separator" />
                            </header>

                            <section class="entry-content">
                                <p class="excerpt"><?php the_excerpt(); ?></p>

                                <div class="sponsor">
                                    <h6>Sponsored By:</h6>
                                    <a href="<?php the_field('advertise_link'); ?>" target="_blank"><img src="<?php the_field('advertise_image'); ?>" alt=""></a>
                                </div>

                                <div class="more-info">
                                    <a href="<?php the_permalink(); ?>" title="اطلاعات بیشتر در رابطه با <?php the_title(); ?>">اطلاعات بیشتر</a>
                                </div>
                            </section>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-6 hidden-lg">
                            <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('home'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6">
                            <header class="entry-header">
                                <div class="category">
                                    <?php the_category(); ?>
                                </div>

                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                <hr class="little-separator" />
                            </header>

                            <section class="entry-content">
                                <p class="excerpt"><?php the_excerpt(); ?></p>

                                <div class="sponsor">
                                    <h6>Sponsored By:</h6>
                                    <a href="<?php the_field('advertise_link'); ?>" target="_blank"><img src="<?php the_field('advertise_image'); ?>" alt=""></a>
                                </div>

                                <div class="more-info">
                                    <a href="<?php the_permalink(); ?>" title="اطلاعات بیشتر در رابطه با <?php the_title(); ?>">اطلاعات بیشتر</a>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-6 visible-lg">
                            <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('home'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php } ?>

                    <?php } ?>

                    </article>
                    <?php  $i++; endwhile;
                        wp_pagenavi();
                    else : 
                    endif; ?>
                </section>
            </div>
        </div>
    </main>

<?php get_footer();
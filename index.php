<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>

<div class="wrap">

    <?php

    $show_blog_archive_title = (bool)get_theme_mod( 'sed_show_blog_archive_title' , '1' );

    if( $show_blog_archive_title === true || site_editor_app_on() ) {

        $hide_class = ($show_blog_archive_title === false) ? "hide" : "";

        ?>

        <?php if (is_home() && !is_front_page()) : ?>
            <header class="page-header <?php echo esc_attr( $hide_class ) ;?>">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
        <?php else : ?>
            <header class="page-header <?php echo esc_attr( $hide_class ) ;?>">
                <h2 class="page-title"><?php _e('Blog', 'twentyseventeen'); ?></h2>
            </header>
        <?php endif; ?>

        <?php

    }

    ?>

    <div id="primary" class="content-area blog-content-area">
        <main id="main" class="site-main" role="main">

            <section class="content">
                <?php $i = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>

                <?php if (($i % 2) == 0) { ?>

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
                            <div class="excerpt" style="text-align:justify;"><?php the_excerpt(); ?></div>

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
                        <header class="entry-header">
                            <div class="category">
                                <?php the_category(); ?>
                            </div>

                            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                            <hr class="little-separator" />
                        </header>

                        <section class="entry-content">
                            <div class="excerpt" style="text-align:justify;"><?php the_excerpt(); ?></div>

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

                </article>
                <?php  $i++; endwhile;
                    wp_pagenavi();
                else :
                endif; ?>
            </section>

        </main><!-- #main -->
    </div><!-- #primary -->
        <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
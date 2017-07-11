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

    <div class="wrap">

        <?php if ( have_posts() ) : ?>

            <?php

            $show_blog_archive_title = (bool)get_theme_mod( 'sed_show_blog_archive_title' , '1' );

            $show_blog_archive_description = (bool)get_theme_mod( 'sed_show_blog_archive_description' , '1' );

            if( $show_blog_archive_title === true || $show_blog_archive_description === true || site_editor_app_on() ) {

                $hide_class = ($show_blog_archive_title === false && $show_blog_archive_description === false) ? "hide" : "";
                ?>

                <header class="page-header <?php echo esc_attr( $hide_class ) ;?>">

                    <?php

                    if( $show_blog_archive_title === true || site_editor_app_on() ) {

                        $hide_class = ($show_blog_archive_title === false) ? "hide" : "";

                        the_archive_title('<h1 class="page-title '. esc_attr( $hide_class ) .'">', '</h1>');

                    }

                    if( $show_blog_archive_description === true || site_editor_app_on() ) {

                        $hide_class = ($show_blog_archive_description === false) ? "hide" : "";

                        the_archive_description( '<div class="taxonomy-description '. esc_attr( $hide_class ) .'">', '</div>' );

                    }

                    ?>

                </header><!-- .page-header -->

            <?php } ?>

        <?php endif; ?>

        <div id="primary" class="content-area sed-blog-content blog-content-area">
            <main id="main" class="site-main" role="main">

                <section class="content">
                    <?php $i = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post row'); ?>>

                    <?php

                    ob_start();

                    the_excerpt();
                    
                    $excerpt = ob_get_clean();
                      
                    if( strlen($excerpt) > 250 ){                                         
                        $excerpt = mb_substr( $excerpt , 0, 250 )."...";
                    }
                            
                    ?>

                    <?php if (($i % 2) == 0) { ?>

                        <?php if (iott_get_field('show_thumbnail')) { ?>

                        <div class="col-lg-12">
                            <header class="entry-header">
                                <div class="category">
                                    <?php the_category(); ?>
                                </div>

                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                <hr class="little-separator" />
                            </header>

                            <section class="entry-content">
                                <p class="excerpt"><?php echo $excerpt ?></p>

                                <?php if ( !empty( iott_get_field('advertise_image') ) ) { ?>
                                <div class="sponsor">
                                    <h6>Sponsored By:</h6>
                                    <a href="<?php iott_the_field('advertise_link'); ?>" target="_blank"><?php the_sponsored_image( iott_get_field('advertise_image') ); ?></a>
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
                                <div class="excerpt"><?php echo $excerpt ?></div>

                                <?php if ( !empty( iott_get_field('advertise_image') ) ) { ?>
                                <div class="sponsor">
                                    <h6>Sponsored By:</h6>
                                    <a href="<?php iott_the_field('advertise_link'); ?>" target="_blank"><?php the_sponsored_image( iott_get_field('advertise_image') ); ?></a>
                                </div>
                                <?php } ?>

                                <div class="more-info">
                                    <a href="<?php the_permalink(); ?>" title="اطلاعات بیشتر در رابطه با <?php the_title(); ?>">اطلاعات بیشتر</a>
                                </div>
                            </section>
                        </div>

                        <?php } ?>

                    <?php } else { ?>

                        <?php if (iott_get_field('show_thumbnail')) { ?>
                        <div class="col-lg-12">
                            <header class="entry-header">
                                <div class="category">
                                    <?php the_category(); ?>
                                </div>

                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                <hr class="little-separator" />
                            </header>

                            <section class="entry-content">
                                <p class="excerpt"><?php echo $excerpt ?></p>

                                <?php if ( !empty( iott_get_field('advertise_image') ) ) { ?>
                                <div class="sponsor">
                                    <h6>Sponsored By:</h6>
                                    <a href="<?php iott_the_field('advertise_link'); ?>" target="_blank"><?php the_sponsored_image( iott_get_field('advertise_image') ); ?></a>
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
                                <div class="excerpt"><?php echo $excerpt ?></div>

                                <?php if ( !empty( iott_get_field('advertise_image') ) ) { ?>
                                <div class="sponsor">
                                    <h6>Sponsored By:</h6>
                                    <a href="<?php iott_the_field('advertise_link'); ?>" target="_blank"><?php the_sponsored_image( iott_get_field('advertise_image') ); ?></a>
                                </div>
                                <?php } ?>

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

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div><!-- .wrap -->

<?php get_footer();
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

                        <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

                                <?php if ('' !== get_the_post_thumbnail() && !iott_get_field('show_thumbnail')) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('single'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <header class="entry-header">
                                    <div class="category">
                                        <?php the_category(); ?>
                                    </div>

                                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

                                    <div class="meta"><?php the_time("d M Y"); ?> / <?php the_category('، '); ?> / <?php the_author(); ?></div>
                                </header>

                                <section class="entry-content">
                                    <?php if ( !empty( iott_get_field('advertise_image') ) ) { ?>
                                    <div class="sponsor">
                                        <h6>Sponsored By:</h6>
                                        <a href="<?php iott_the_field('advertise_link'); ?>" target="_blank"><?php the_sponsored_image( iott_get_field('advertise_image') ); ?></a>
                                    </div>
                                    <?php } ?>

                                    <hr class="little-separator" />

                                    <div class="entry">
                                        <?php the_content(); ?>
                                    </div>
                                </section>
                        </article>
                    <?php
                    endwhile; // End of the loop.
                ?>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
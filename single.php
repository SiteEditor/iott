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

    <main class="main">
        <div class="container">
            <div class="col-sm-3">
                <?php get_sidebar(); ?>
            </div>

            <div class="col-sm-9">
                <section class="content">
                    <?php armanam_breadcrumbs(); ?>

                    <?php if ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <?php if ('' !== get_the_post_thumbnail() && !get_field('show_thumbnail')) : ?>
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
                                <?php if (get_field('advertise_image') != null) { ?>
                                <div class="sponsor">
                                    <h6>Sponsored By:</h6>
                                    <a href="<?php the_field('advertise_link'); ?>" target="_blank"><img src="<?php the_field('advertise_image'); ?>" alt=""></a>
                                </div>
                                <?php } ?>

                                <hr class="little-separator" />

                                <div class="entry">
                                    <?php the_content(); ?>
                                </div>
                            </section>
                    </article>
                    <?php
                    else : 
                        echo "صفحه مورد نظر یافت نشد.";
                    endif; ?>
                </section>
            </div>
        </div>
    </main>

<?php get_footer();
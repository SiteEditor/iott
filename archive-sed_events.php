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

    <div id="primary" class="content-area blog-content-area">

        <main id="main" class="site-main" role="main">
            
            <section class="content">

                <div class="timeline-content-area <?php iott_the_field('event_color'); ?>">
    
                    <?php
    
                    $i = 0;
    
                    $current_day = '';
    
                    $current_month = '';
    
                    if ( have_posts() ) :
    
                        while ( have_posts() ) : the_post();
    
                            $event_logo_id = iott_get_field('event_image');
    
                            $img = get_sed_attachment_image_html( $event_logo_id , "medium" );
    
                            if ( ! $img ) {
                                $img = array();
                                $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                            }
    
                            $new_day = iott_get_field('event_day');
    
                            $new_month = iott_get_field('event_month');
    
                            $year = iott_get_field('event_year');
    
                            $year = !$year ? '' : $year;
    
                            if( $new_day && ( $new_day != $current_day || ( $new_month && $new_month != $current_month ) ) ){
    
                                $current_day = $new_day;
    
                                $current_month = $new_month;
    
    
                        ?>
                                <div class="date-wrap clearfix">
                                    <div class="date"><span><?php echo $new_day;?></span></div>
                                    <span class="line"></span>
                                    <div class="full-date-wrap">
                                        <span class="day-num"><?php echo $new_day;?></span>
                                        <span class="full-date"><?php echo $new_month . " " . $year;?></span>
                                    </div>
                                </div>
    
                            <?php } ?>
    
                            <div id="post-<?php the_ID(); ?>" <?php post_class('item-content'); ?>>
    
                                <div class="content-desc">
    
                                    <div class="title">
                                        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                    </div>
    
                                    <div class="image">
                                        <?php echo $img['thumbnail'] ; ?>
                                    </div>
    
                                    <hr class="little-separator">
    
                                    <div class="text">
                                        <div><?php the_excerpt(); ?></div>
                                    </div>
    
                                </div>
    
                            </div>
    
                        <?php
    
                        $i++;
    
                        endwhile;
    
                        wp_pagenavi();
    
                    endif;
                    ?>
    
                </div>
            
            </section>

        </main>

    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer();
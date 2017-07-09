<?php get_header(); ?>

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
                    <div class="row">
                        <div class="col-sm-12">
                            <?php sed_iott_breadcrumbs(); ?>
                        </div>
                    </div>

                    <div class="content__header">                        
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <form method="get" class="form-inline">
                                    <div class="form-group">
                                        <select class="iott-change-sort-select" name="productSortBy" data-value="orderby">
                                            <option value="data_desc" <?php if ($_GET['orderby'] == "data_desc") { echo "selected"; } ?>>تاریخ: نزولی</option>
                                            <option value="date_asc" <?php if ($_GET['orderby'] == "date_asc") { echo "selected"; } ?>>تاریخ: صعولی</option>
                                            <option value="title_asc" <?php if ($_GET['orderby'] == "title_asc") { echo "selected"; } ?>>بر اساس حروف الفبا: صعودی</option>
                                            <option value="title_desc" <?php if ($_GET['orderby'] == "title_desc") { echo "selected"; } ?>>بر اساس حروف الفبا: نزولی</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select class="iott-change-sort-select" name="productCount" data-value="postperpage">
                                            <option value="12" <?php if ($_GET['postperpage'] == "12") { echo "selected"; } ?>>نمایش در هر صفحه: ۱۲</option>
                                            <option value="24" <?php if ($_GET['postperpage'] == "24") { echo "selected"; } ?>>نمایش در هر صفحه: ۲۴</option>
                                            <option value="48" <?php if ($_GET['postperpage'] == "48") { echo "selected"; } ?>>نمایش در هر صفحه: ۴۸</option>
                                        </select>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <?php wp_pagenavi(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="col-sm-6 col-md-4">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                                <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php

                                                $attachment_id   = get_post_thumbnail_id();

                                                $img = get_sed_attachment_image_html( $attachment_id , "" , "400X400" );

                                            ?>
                                            <?php 
                                                if ( $img ) {
                                                    echo $img['thumbnail'];
                                                }
                                            ?>
                                            <?php //the_post_thumbnail('s1x1'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <header class="entry-header entry-header--archive">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <span><?php the_title(); ?></span>
                                        <small><?php iott_the_field('subtitle'); ?></small>
                                    </a>
                                </header>
                            </article>
                        </div>
                        <?php endwhile; ?>
                    </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <?php wp_pagenavi(); ?>
                            </div>
                        </div>
                        <?php else :
                            echo '<h2 class="text-center">صفحه مورد نظر یافت نشد!</h2>';
                        endif; ?>

                </section>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div><!-- .wrap -->

<?php get_footer();
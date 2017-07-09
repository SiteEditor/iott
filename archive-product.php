<?php get_header(); ?>

    <main class="main">
        <div class="container">
            <div class="col-sm-3">
                <?php get_sidebar(); ?>
            </div>

            <div class="col-sm-9">
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
                                        <select name="productSortBy" onchange="onchangeSelect(this, 'orderby');">
                                            <option value="data_desc" <?php if ($_GET['orderby'] == "data_desc") { echo "selected"; } ?>>تاریخ: نزولی</option>
                                            <option value="date_asc" <?php if ($_GET['orderby'] == "date_asc") { echo "selected"; } ?>>تاریخ: صعولی</option>
                                            <option value="title_asc" <?php if ($_GET['orderby'] == "title_asc") { echo "selected"; } ?>>بر اساس حروف الفبا: صعودی</option>
                                            <option value="title_desc" <?php if ($_GET['orderby'] == "title_desc") { echo "selected"; } ?>>بر اساس حروف الفبا: نزولی</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="productCount" onchange="onchangeSelect(this, 'postperpage');">
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
                                            <?php the_post_thumbnail('s1x1'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <header class="entry-header entry-header--archive">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <span><?php the_title(); ?></span>
                                        <small><?php the_field('subtitle'); ?></small>
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
            </div>
        </div>
    </main>

<?php get_footer(); ?>
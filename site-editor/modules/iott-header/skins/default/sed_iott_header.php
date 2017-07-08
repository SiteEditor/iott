<div <?php echo $sed_attrs; ?> class="module module-posts module-posts-default <?php echo $class; ?> ">

    <section class="menu-container">

        <div class="sed-row-boxed">
            <div class="right-panel pull-right">

                <ul class="list-menu list-unstyled">

                    <?php wp_nav_menu(array('theme_location' => 'top', 'container' => '', 'items_wrap' => '%3$s')); ?>

                    <li class="search-form-container">
                        <form role="search" method="get" class="search-form form" action="<?php echo esc_url(home_url('/')); ?>">
                            <button type="submit" class="form-control"></button>
                            <input type="search" class="form-control" value="<?php echo get_search_query(); ?>" name="s" />
                        </form>
                    </li>

                </ul>

                <div class="bottom-panel">
                    <a href="#close" class="closeMenu toggle-navigation"></a>
                    <div class="socials">
                        <ul class="list-unstyled">
                            <?php if( !empty( $social_instagram ) ) { ?><li><a href="<?php esc_attr( esc_url( $social_instagram ) ); ?>" title="<?php echo __("Instagram" , "iott" );?>" class="instagram"></a></li><?php } ?>
	                        <?php if( !empty( $social_linkdin ) ) { ?><li><a href="<?php esc_attr( esc_url( $social_linkdin ) ); ?>" title="<?php echo __("Linkdin" , "iott" );?>" class="linkdin"></a></li><?php } ?>
	                        <?php if( !empty( $social_googleplus )) { ?><li><a href="<?php esc_attr( esc_url( $social_googleplus ) ); ?>" title="<?php echo __("Google Plus" , "iott" );?>" class="google"></a></li><?php } ?>
	                        <?php if( !empty( $social_facebook ) ) { ?><li><a href="<?php esc_attr( esc_url( $social_facebook ) ); ?>" title="<?php echo __("Facebook" , "iott" );?>" class="facebook"></a></li><?php } ?>
                        </ul>!
                    </div>
                </div>

            </div>

            <div class="left-panel">
                <?php query_posts("post_type=product&showposts=12&cat=3033"); while (have_posts()) : the_post(); ?>
                    <div class="item">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail-wrap">
                                    <h6><span><?php echo __("View Product" , "iott" );?></span></h6>
                                    <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                        <?php the_post_thumbnail('s4x3'); ?>
                                    <?php endif; ?>
                                </a>
                            </div>

                            <div class="col-sm-7">
                                <div class="entry">
                                    <h5><?php the_title(); ?></h5>
                                    <h6><?php //the_field('subtitle'); ?></h6>
                                    <hr class="little-separator" />
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_query(); ?>
            </div>

        </div>

    </section>

    <header id="header">

        <div class="sed-row-boxed">

            <div class="logo">
                <h1>
                    <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('title'); ?>">
                        <?php
                        if( !empty( $site_logo ) ) {

                            $img = get_sed_attachment_image_html( $site_logo, 'full' );

                            if ( $img ) {
                                echo $img['thumbnail'];
                            }
                        }
                        ?>
                        <?php bloginfo('title'); ?>
                    </a>
                </h1>
                <h2><?php bloginfo('description'); ?></h2>
            </div>

            <div class="menu">
                <button class="toggle-navigation">
                    <span class="toggle-menu-hamburger-open"></span>
                    <span class="toggle-menu-hamburger-close"></span>
                </button>
            </div>

            <div class="clearfix"></div>

            <div class="socials">
                <ul class="list-unstyled">
                    <?php if( !empty( $social_instagram ) ) { ?><li><a href="<?php esc_attr( esc_url( $social_instagram ) ); ?>" title="<?php echo __("Instagram" , "iott" );?>" class="instagram"></a></li><?php } ?>
                    <?php if( !empty( $social_linkdin ) ) { ?><li><a href="<?php esc_attr( esc_url( $social_linkdin ) ); ?>" title="<?php echo __("Linkdin" , "iott" );?>" class="linkdin"></a></li><?php } ?>
                    <?php if( !empty( $social_googleplus )) { ?><li><a href="<?php esc_attr( esc_url( $social_googleplus ) ); ?>" title="<?php echo __("Google Plus" , "iott" );?>" class="google"></a></li><?php } ?>
                    <?php if( !empty( $social_facebook ) ) { ?><li><a href="<?php esc_attr( esc_url( $social_facebook ) ); ?>" title="<?php echo __("Facebook" , "iott" );?>" class="facebook"></a></li><?php } ?>
                </ul>
            </div>

        </div>

        <div class="banner">
            <?php echo do_shortcode('[rev_slider alias="'.$header_slider.'"]'); ?>
            <h3><?php //the_field('top_title', 'option'); ?></h3>
            <h5><?php //the_field('sec_title', 'option'); ?></h5>
            <!--<h5>برای اطلاعات بیشتر <a href="" title="اینجا">اینجا کلیک</a> کنید.</h5>-->
        </div>

    </header>
    
</div>
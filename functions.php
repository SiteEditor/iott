<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//

function iott_enqueue_styles() {

    wp_enqueue_style( 'iott-parent-style', get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'iott-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );

    //wp_enqueue_style( 'iott-main-style', get_stylesheet_directory_uri() . '/css/style.css' );

    wp_enqueue_script( "typed-js" , get_stylesheet_directory_uri() . '/assets/js/typed.js/dist/typed.min.js' , array( 'jquery' ) , "1.0.0" , true );

    /**
     * Theme Front end main js
     */
    wp_enqueue_script( "iott-script" , get_stylesheet_directory_uri() . '/assets/js/script.js' , array( 'jquery', 'carousel' , 'sed-livequery' , 'jquery-ui-accordion' ) , "1.0.0" , true );


    wp_enqueue_script('jquery-scrollbar');

    wp_enqueue_style('custom-scrollbar');

    wp_enqueue_style("carousel");

}

add_action( 'wp_enqueue_scripts', 'iott_enqueue_styles' , 0 );

add_action( 'after_setup_theme', 'sed_iott_theme_setup' );

function sed_iott_theme_setup() {

    load_child_theme_textdomain( 'iott', get_stylesheet_directory() . '/languages' );

    remove_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

}

function iott_excerpt_more( $link ) {
    if ( is_admin() ) {
        return $link;
    }

    return ' &hellip; ';
}
add_filter( 'excerpt_more', 'iott_excerpt_more' );

/**
 * Add Site Editor Modules
 *
 * @param $modules
 * @return mixed
 */
function sed_iott_add_modules( $modules ){

    global $sed_pb_modules;

    $module_name = "themes/sed-iott/site-editor/modules/iott-header/iott-header.php";
    $modules[$module_name] = $sed_pb_modules->get_module_data(get_stylesheet_directory() . '/site-editor/modules/iott-header/iott-header.php', true, true);

    $module_name = "themes/sed-iott/site-editor/modules/posts/posts.php";
    $modules[$module_name] = $sed_pb_modules->get_module_data(get_stylesheet_directory() . '/site-editor/modules/posts/posts.php', true, true);

    /*$module_name = "themes/sed-iott/site-editor/modules/iott-events/iott-events.php";
    $modules[$module_name] = $sed_pb_modules->get_module_data(get_stylesheet_directory() . '/site-editor/modules/iott-events/iott-events.php', true, true);
    */
    
    return $modules;

}

add_filter("sed_modules" , "sed_iott_add_modules" );


function sed_iott_breadcrumbs() {
    $delimiter     = '<span class="delimiter">/</span>';
    $name          = get_bloginfo('site_url'); //text for the 'Home' link
    $currentBefore = '<span class="current">';
    $currentAfter  = '</span>';

    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<div class="armanam_breadcrumbs">';
        global $post;
        $home = get_bloginfo('url');
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        if (is_category()) {
            global $wp_query;
            $cat_obj   = $wp_query->get_queried_object();
            $thisCat   = $cat_obj->term_id;
            $thisCat   = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0)
                echo (get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $currentBefore . '';
            single_cat_title();
            echo '' . $currentAfter;
        } //is_category()
        elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('d') . $currentAfter;
        } //is_day()
        elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('F') . $currentAfter;
        } //is_month()
        elseif (is_year()) {
            echo $currentBefore . get_the_time('Y') . $currentAfter;
        } //is_year()
        elseif (is_single() && !is_attachment() && is_singular('post')) {
            $cat = get_the_category();
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            // echo get_post_type($post->ID);
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } //is_single() && !is_attachment()
        elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat    = get_the_category($parent->ID);
            $cat    = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } //is_attachment()
        elseif (is_page() && !$post->post_parent) {
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } //is_page() && !$post->post_parent
        elseif (is_page() && $post->post_parent) {
            $parent_id   = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page          = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id     = $page->post_parent;
            } //$parent_id
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb)
                echo $crumb . ' ' . $delimiter . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } //is_page() && $post->post_parent
        elseif (is_search()) {
            echo $currentBefore . 'نتایج جست‌وجو: ' . get_search_query() . '' . $currentAfter;
        } //is_search()
        elseif (is_tag()) {
            echo $currentBefore . 'برچسب: ';
            single_tag_title();
            echo '' . $currentAfter;
        } //is_tag()
        elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $currentBefore . 'نویسنده: ' . $userdata->display_name . $currentAfter;
        } //is_author()
        elseif (is_404()) {
            echo $currentBefore . 'خطای ۴۰۴!' . $currentAfter;
        } //is_404()
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo "صفحه" . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        } //get_query_var('paged')
        echo '</div>';
    } //!is_home() && !is_front_page() || is_paged()
}

/*
 * Get post-type categories
 *
 * $id int require
 * $tax string require eg.: 'product_category'
 * $before string optional
 * $after string optional
 *
 * return str
 */
function get_terms_string($id, $tax, $before = null, $after = null) {
    $arr = get_the_terms($id, $tax);
    $str = '';
    $str .= $before;

    if( is_array( $arr ) ) {

        foreach ($arr as $key => $value) {
            $str .= "<a href='" . get_term_link($value->term_id) . "'>" . $value->name . "</a>";

            if (count($arr) != $key + 1) {
                $str .= "، ";
            }
        }

    }

    $str .= $after;
    return $str;
}


function iott_get_field( $key , $post_id = 0 ){

    global $post;

    $post_id = (int)$post_id;

    if( $post_id == 0 && $post ){

        $post_id = get_the_ID();

    }

    return get_post_meta( $post_id , $key , true );

}

function iott_the_field( $key , $post_id = 0 ){

    echo iott_get_field( $key , $post_id );

}


add_action( 'pre_get_posts', 'iott_per_page_query' );
/**
 * Customize category query using pre_get_posts.
 * 
 * @author     FAT Media <http://youneedfat.com>
 * @copyright  Copyright (c) 2013, FAT Media, LLC
 * @license    GPL-2.0+
 * @todo       Change prefix to theme or plugin prefix
 *
 */
function iott_per_page_query( $query ) {
  
    $taxonomy = is_tax() ? get_queried_object()->taxonomy:""; 
    
    $is_taxonomy = in_array( $taxonomy , array( 'product_category' , 'event_cat' , 'chart_cat' , 'video_cat' , 'infographic_cat' ) );
  
	if ( $query->is_main_query() && ! $query->is_feed() && ! is_admin() && $is_taxonomy  ) {
		$query->set( 'posts_per_page', '12' ); //Change this number to anything you like.
	}
	
	$post_type = $query->get('post_type');
	
	$is_post_type = in_array( $post_type , array( 'product' , 'sed_events' , 'chart' , 'iott_video' , 'sed_infographic' ) );

	if ( $query->is_main_query() && ! $query->is_feed() && ! is_admin() && $is_post_type && is_post_type_archive() ) {
		$query->set( 'posts_per_page', '12' ); //Change this number to anything you like.
	}
	
}

/*
 * Sort posts in a custom post-type
 */
function iott_custom_posttype_sort($query) {

    $post_type = $query->get('post_type'); //var_dump( $query );
    
    $taxonomy = is_tax() ? get_queried_object()->taxonomy:""; 
    
    $is_post_type = in_array( $post_type , array( 'product' , 'sed_events' , 'chart' , 'iott_video' , 'sed_infographic' ) );
    
    $is_taxonomy = in_array( $taxonomy , array( 'product_category' , 'event_cat' , 'chart_cat' , 'video_cat' , 'infographic_cat' ) );

    if ( ( $is_post_type || $is_taxonomy ) && $query->is_main_query() && !is_admin() ) {

        if( isset( $_GET['orderby'] ) && !empty( $_GET['orderby'] ) ) {

            $order_by = $_GET['orderby'];

            switch ( $order_by ) {
                case 'date_asc':
                    $query->set('orderby', 'date');
                    $query->set('order', 'ASC');
                    break;
                case 'data_desc':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
                case 'title_asc':
                    $query->set('orderby', 'title');
                    $query->set('order', 'ASC');
                    break;
                case 'title_desc':
                    $query->set('orderby', 'title');
                    $query->set('order', 'DESC');
                    break;

                default:
                    break;
            }

        }

        if( isset( $_GET['postperpage'] ) && !empty( $_GET['postperpage'] ) ) {

            $per_page = (int)$_GET['postperpage'];

            $query->set('posts_per_page', $per_page);

        }

    }
}

add_action('pre_get_posts', 'iott_custom_posttype_sort');


function iott_register_widgets() {

    if( class_exists('NS_Featured_Posts') ){

        unregister_widget( 'NSFP_Featured_Post_Widget'   );

        require_once( get_stylesheet_directory(). '/widgets/featured-post.php' );

        register_widget( 'Sed_Featured_Post_Widget' );

    }

}

add_action( 'widgets_init',  'iott_register_widgets' );

function the_sponsored_image( $attachment_id ){

    $img = get_sed_attachment_image_html( $attachment_id , "full");

    if ( ! $img ) {
        $img = array();
        $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
    }

    echo $img['thumbnail'];

}



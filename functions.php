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

}

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





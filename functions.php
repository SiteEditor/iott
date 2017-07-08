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





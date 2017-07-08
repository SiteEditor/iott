<?php
/*
Module Name: Posts
Module URI: http://www.siteeditor.org/modules/posts
Description: Module Posts For Page Builder Application
Author: Site Editor Team
Author URI: http://www.siteeditor.org
Version: 1.0.0
*/

/**
 * Class PBPostsShortcode
 */
class PBPostsShortcode extends PBShortcodeClass{

    /**
     * Register module with siteeditor.
     */
    function __construct() {
        parent::__construct( array(
                "name"        => "sed_posts",                               //*require
                "title"       => __("Posts","site-editor"),                 //*require for toolbar
                "description" => __("List of posts for built-in and custom post types","site-editor"),
                "icon"        => "icon-posts",                               //*require for icon toolbar
                "module"      =>  "posts"         //*require
                //"is_child"    =>  "false"       //for childe shortcodes like sed_tr , sed_td for table module
            ) // Args
        );

    }

    function get_atts(){

        $atts = array(
            //'title_length'          => 50,
            'show_title'                    => true,
            'title'                         => '',
            'excerpt_length'                => 50,
            'posts_per_page'                => 5,
            'offset'                        => 0,
            'post_type'                     => 'post' ,
            "taxonomy"                      => '',
            "terms"                         => '' ,
            "images_size"                   => 'thumbnail'
        );

        return $atts;

    }

    function add_shortcode( $atts , $content = null ){

        extract( $atts );

        $post_type = empty( $post_type ) ? 'post' : $post_type;

        $offset = (int)$offset;

        $posts_per_page = empty( $posts_per_page ) ? 5 : $posts_per_page;

        $args = array(
            'post_type'         =>  $post_type,
            'offset'            =>  $offset ,
            'posts_per_page'    =>  $posts_per_page
        );

        if( !empty( $taxonomy ) && !empty( $terms ) ){

            $args['tax_query'] = array();

            $terms = is_string( $terms ) && !empty( $terms ) ? explode( "," , $terms ) : array();

            $tax_args = array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $terms,
            );

            $args['tax_query'][] = $tax_args;

        }

        $args = apply_filters( 'sed_posts_module_query_args_filter' , $args , $this );

        $this->set_vars( array( "args" => $args ) );

    }
    
    /*function styles(){
        return array(
            array('posts-skin-default', get_stylesheet_directory_uri().'/site-editor/modules/posts/skins/default/css/style.css' ,'1.0.0' ) ,
        );
    }*/

    function shortcode_settings(){

        $this->add_panel( 'posts_settings_panel' , array(
            'title'               =>  __('Posts Settings',"site-editor")  ,
            'capability'          => 'edit_theme_options' ,
            'type'                => 'inner_box' ,
            'priority'            => 9 ,
            'btn_style'           => 'menu' ,
            'has_border_box'      => false ,
            'icon'                => 'sedico-setting' ,
            'field_spacing'       => 'sm'
        ) );

        $params = array();

        $params['images_size'] = array(
            "type"          => "image-size" ,
            "label"         => __("Image Size Field", "site-editor"),
            "description"   => __("This option allows you to set a title for your image.", "site-editor"),
            "panel"         => "posts_settings_panel" ,
        );

        $params['show_title'] = array(
            'label'             => __('Show Title', 'site-editor'),
            'type'              => 'switch',
            'choices'           => array(
                "on"       =>    "ON" ,
                "off"      =>    "OFF" ,
            ),
            "panel"         => "posts_settings_panel" ,
        );

        $params['title'] = array(
            "type"              => "text" ,
            "label"             => __("Title", "site-editor"),
            "description"       => __("Module Title", "site-editor"),
            "placeholder"       => __("Enter Module Title", "site-editor"),
            "panel"             => "posts_settings_panel",
            'dependency'    => array(
                'queries'  =>  array(
                    array(
                        "key"       => "show_title" ,
                        "value"     => true ,
                        "compare"   => "==="
                    )
                )
            )
        );

        $post_types = get_post_types( array( 'show_in_nav_menus' => true , 'public' => true ), 'object' );

        $post_types_choices = array();

        foreach ($post_types AS $post_type_name => $post_type) {

            $post_types_choices[$post_type_name] = $post_type->name;

        }

        $params['post_type'] = array(
            "type"          => "select" ,
            "label"         => __("Select Post Type", "site-editor"),
            "description"   => __("Select Type of Posts", "site-editor"),
            "choices"       =>  $post_types_choices,
            "panel"         => "posts_settings_panel" ,
        );

        $params['offset'] = array(
            "type"          => "number" ,
            "label"         => __("Offset", "site-editor"),
            "description"   => __("Start Posts Of this offset", "site-editor"),
            "js_params"     =>  array(
                "min"  =>  0 ,
            ),
            "panel"         => "posts_settings_panel"
        );

        $params['posts_per_page'] = array(
            "type"          => "number" ,
            "label"         => __("Number Of Posts", "site-editor"),
            "description"   => __("Number Of Posts", "site-editor"),
            "js_params"     =>  array(
                "min"  =>  1 ,
            ),
            "panel"         => "posts_settings_panel"
        );

        $params['excerpt_length'] = array(
            "type"          => "number" ,
            "label"         => __("Excerpt Length", "site-editor"),
            "description"   => __("Excerpt Length", "site-editor"),
            "js_params"     =>  array(
                "min"  =>  10 ,
            ),
            "panel"         => "posts_settings_panel"
        );

        $args = array(
            'public'   => true,
            //'_builtin' => true
        );

        $output = 'objects';
        $taxonomies = get_taxonomies( $args, $output );

        $taxonomies_choices = array( '' => __("Select Taxonomy" , "site-editor") );

        foreach ( $taxonomies  as $taxonomy ) {

            $taxonomies_choices[$taxonomy->name] = $taxonomy->labels->name;

        }

        $params['taxonomy'] = array(
            "type"          => "select" ,
            "label"         => __("Select Taxonomy", "site-editor"),
            "description"   => __("Select Taxonomy", "site-editor"),
            "choices"       => $taxonomies_choices,
            "panel"         => "posts_settings_panel" ,
        );

        foreach ( $taxonomies  as $taxonomy ) {

            $terms = get_terms( array(
                'taxonomy' => $taxonomy->name,
                'hide_empty' => false,
            ) );

            $terms_choices = array();

            if( !empty( $terms ) && is_array( $terms ) ) {

                //$terms_choices[0] = __("Select term" , "site-editor");

                foreach ( $terms as $term ) {

                    $terms_choices[$term->term_id] = $term->name;

                }

            }

            $params[$taxonomy->name . '_terms'] = array(
                "type"          => "multi-select" ,
                "label"         => __("Select Terms", "site-editor"),
                "description"   => __("Select Terms for current selected Taxonomy", "site-editor"),
                "choices"       => $terms_choices,
                "is_attr"       => true ,
                "attr_name"     => "terms" ,
                "panel"         => "posts_settings_panel" ,
                'dependency'    => array(
                    'queries'  =>  array(
                        array(
                            "key"       => "taxonomy" ,
                            "value"     => $taxonomy->name ,
                            "compare"   => "=="
                        )
                    )
                )
            );

        }

        $params['skin'] = array(
            "type"                => "skin" ,
            "label"               => __("Change skin", "site-editor"),
            'button_style'        => 'menu' ,
            'has_border_box'      => false ,
            'icon'                => 'sedico-change-skin' ,
            'field_spacing'       => 'sm' ,
            'priority'            => 540
        );

        $params['animation'] =  array(
            "type"                => "animation" ,
            "label"               => __("Animation Settings", "site-editor"),
            'button_style'        => 'menu' ,
            'has_border_box'      => false ,
            'icon'                => 'sedico-animation' ,
            'field_spacing'       => 'sm' ,
            'priority'            => 530 ,
        );

        $params['row_container'] = array(
            'type'          => 'row_container',
            'label'         => __('Module Wrapper Settings', 'site-editor')
        );

        return $params;

    }

}

new PBPostsShortcode();

global $sed_pb_app;                      

$sed_pb_app->register_module(array(
    "group"                 =>  "basic" ,
    "name"                  =>  "posts",
    "title"                 =>  __("Posts","site-editor"),
    "description"           =>  __("List of posts for built-in and custom post types","site-editor"),
    "icon"                  =>  "icon-posts",
    "type_icon"             =>  "font",
    "shortcode"             =>  "sed_posts",
    //"priority"              =>  10 ,
    "transport"             =>  "ajax" ,
));



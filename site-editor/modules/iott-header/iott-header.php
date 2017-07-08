<?php
/*
Module Name: Iott Header
Module URI: http://www.siteeditor.org/modules/iott-header
Description: Module Iott Header For Page Builder Application
Author: Site Editor Team
Author URI: http://www.siteeditor.org
Version: 1.0.0
*/

/**
 * Class PBIottHeader
 */
class PBIottHeader extends PBShortcodeClass{

    /**
     * Register module with siteeditor.
     */
    function __construct() {
        parent::__construct( array(
                "name"        => "sed_iott_header",                               //*require
                "title"       => __("Iott Header","site-editor"),                 //*require for toolbar
                "description" => __("List of iott-header for built-in and custom post types","site-editor"),
                "icon"        => "icon-header",                               //*require for icon toolbar
                "module"      =>  "iott-header"         //*require
                //"is_child"    =>  "false"       //for childe shortcodes like sed_tr , sed_td for table module
            ) // Args
        );

    }

    function get_atts(){

        $atts = array(
            //'title_length'          => 50,
        );

        return $atts;

    }

    function add_shortcode( $atts , $content = null ){


    }

    function shortcode_settings(){

        $this->add_panel( 'iott_header_settings_panel' , array(
            'title'               =>  __('Iott Header Settings',"site-editor")  ,
            'capability'          => 'edit_theme_options' ,
            'type'                => 'inner_box' ,
            'priority'            => 9 ,
            'btn_style'           => 'menu' ,
            'has_border_box'      => false ,
            'icon'                => 'sedico-setting' ,
            'field_spacing'       => 'sm'
        ) );

        $params = array(

            'row_container' => array(
                'type'                => 'row_container',
                'label'               => __('Module Wrapper Settings', 'site-editor')
            ),

        );

        return $params;

    }

}

new PBIottHeader();

global $sed_pb_app;                      

$sed_pb_app->register_module(array(
    "group"                 =>  "basic" ,
    "name"                  =>  "iott-header",
    "title"                 =>  __("Iott Header","site-editor"),
    "description"           =>  __("List of iott-header for built-in and custom post types","site-editor"),
    "icon"                  =>  "icon-header",
    "type_icon"             =>  "font",
    "shortcode"             =>  "sed_iott_header",
    //"priority"              =>  10 ,
    "transport"             =>  "ajax" ,
));



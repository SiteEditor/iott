<?php
/*
Module Name: Iott Rproducts
Module URI: http://www.siteeditor.org/modules/iott-rproducts
Description: Module Iott Rproducts For Page Builder Application
Author: Site Editor Team
Author URI: http://www.siteeditor.org
Version: 1.0.0
*/

/**
 * Class PBIottRproducts
 */
class PBIottRproducts extends PBShortcodeClass{

    /**
     * Register module with siteeditor.
     */
    function __construct() {
        parent::__construct( array(
                "name"        => "sed_iott_rproducts",                               //*require
                "title"       => __("Iott Rproducts","site-editor"),                 //*require for toolbar
                "description" => __("List of iott-rproducts for built-in and custom post types","site-editor"),
                "icon"        => "icon-header",                               //*require for icon toolbar
                "module"      =>  "iott-rproducts"         //*require
                //"is_child"    =>  "false"       //for childe shortcodes like sed_tr , sed_td for table module
            ) // Args
        );

    }

    function get_atts(){

        $atts = array(
            'social_instagram'          => '',
            'social_linkdin'            => '',
            'social_googleplus'         => '',
            'social_facebook'           => '',
            'site_logo'                 => '',
            'header_slider'             => '',
        );

        return $atts;

    }

    function add_shortcode( $atts , $content = null ){


    }

    function shortcode_settings(){

        $this->add_panel( 'iott_rproducts_settings_panel' , array(
            'title'               =>  __('Iott Rproducts Settings',"site-editor")  ,
            'capability'          => 'edit_theme_options' ,
            'type'                => 'inner_box' ,
            'priority'            => 9 ,
            'btn_style'           => 'menu' ,
            'has_border_box'      => false ,
            'icon'                => 'sedico-setting' ,
            'field_spacing'       => 'sm'
        ) );

        global $wpdb;
        $rs = $wpdb->get_results(
            "
          SELECT id, title, alias
          FROM " . $wpdb->prefix . "revslider_sliders
          ORDER BY id ASC LIMIT 999
          "
        );

        $revsliders = array( );
        if ( $rs ) {
            foreach ( $rs as $slider ) {
                $revsliders[ $slider->alias ] = $slider->title;
            }
        } else {
            $revsliders[ 0 ] = __( 'No sliders found', 'site-editor' );
        }


        $params = array(

            'social_instagram' => array(
                "type"          => "url" ,
                "label"         => __("Instagram Url", "site-editor"),
                "description"   => __("Your Instagram Profile Url", "site-editor"),
                "placeholder"   => __("E.g www.siteeditor.org", "site-editor"),
                "panel"         => "iott_rproducts_settings_panel" ,
            ),

            'social_linkdin' => array(
                "type"          => "url" ,
                "label"         => __("Linkedin Url", "site-editor"),
                "description"   => __("Your Linkedin Profile Url", "site-editor"),
                "placeholder"   => __("E.g www.siteeditor.org", "site-editor"),
                "panel"         => "iott_rproducts_settings_panel" ,
            ),

            'social_googleplus' => array(
                "type"          => "url" ,
                "label"         => __("Google Plus Url", "site-editor"),
                "description"   => __("Your Google Plus Profile Url", "site-editor"),
                "placeholder"   => __("E.g www.siteeditor.org", "site-editor"),
                "panel"         => "iott_rproducts_settings_panel" ,
            ),

            'social_facebook' => array(
                "type"          => "url" ,
                "label"         => __("Facebook Url", "site-editor"),
                "description"   => __("Your Facebook Profile Url", "site-editor"),
                "placeholder"   => __("E.g www.siteeditor.org", "site-editor"),
                "panel"         => "iott_rproducts_settings_panel" ,
            ),

            'site_logo' => array(
                "type"          => "image" ,
                "label"         => __("Logo", "site-editor"),
                "description"   => __("This option allows you to set a logo", "site-editor"),
                'remove_action' => true ,
                "panel"         => "iott_rproducts_settings_panel" ,
            ),

            'header_slider' => array(
                "type"          => "select" ,
                "label"         => __("Select Slider", "site-editor"),
                "choices"       =>  $revsliders,
                "panel"         => "iott_rproducts_settings_panel" ,
            ),

            'row_container' => array(
                'type'                => 'row_container',
                'label'               => __('Module Wrapper Settings', 'site-editor')
            ),

        );

        return $params;

    }

}

new PBIottRproducts();

global $sed_pb_app;                      

$sed_pb_app->register_module(array(
    "group"                 =>  "basic" ,
    "name"                  =>  "iott-rproducts",
    "title"                 =>  __("Iott Rproducts","site-editor"),
    "description"           =>  __("List of iott recent products for built-in and custom post types","site-editor"),
    "icon"                  =>  "icon-header",
    "type_icon"             =>  "font",
    "shortcode"             =>  "sed_iott_rproducts",
    //"priority"              =>  10 ,
    "transport"             =>  "ajax" ,
));



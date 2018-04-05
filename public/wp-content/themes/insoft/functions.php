<?php

class InsoftTheme{

    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'insoft_theme_setup']);
        add_action('wp_enqueue_scripts', [$this, 'load_insoft_theme_scripts']);
    }


    function insoft_theme_setup() {
        add_theme_support( 'post-thumbnails' );
        register_nav_menus( array(
            'primary' => __( 'Primary Menu' ),
            'left_sidebar' => __('Left sidebar menu'),
        ) );
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
        add_theme_support( 'custom-logo', array(
            'height'      => 43,
            'width'       => 265,
            'flex-height' => true,
            'flex-width'  => true,
        ) );
    }

    function load_insoft_theme_scripts() {
        wp_enqueue_style( 'main-css', get_stylesheet_uri() );
        wp_enqueue_style( 'insoft_theme_styles', get_template_directory_uri() . '/css/style.css' );
        wp_enqueue_script( 'jquery', true );
    }

}

new InsoftTheme();
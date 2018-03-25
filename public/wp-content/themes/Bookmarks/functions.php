<?php

class BookmarkTheme{

    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'football_theme_setup']);
        add_action('wp_enqueue_scripts', [$this, 'load_football_theme_scripts']);

        add_action( 'init', [$this, 'add_bookmark_page'] );
    }

    public function add_bookmark_page(){
        $bookmark_page = get_page_by_path('bookmarks');
        if ($bookmark_page) return true;

        $post_data = array(
            'post_title'    => 'bookmarks',
            'post_name'  => 'bookmarks',
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type' => 'page',
        );

        $post_id = wp_insert_post( wp_slash($post_data) );
    }

    function football_theme_setup() {
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

    function load_football_theme_scripts() {
        wp_enqueue_style( 'main-css', get_stylesheet_uri() );
        wp_enqueue_style( 'football_theme_styles', get_template_directory_uri() . '/css/style.css' );
        wp_enqueue_script( 'jquery', true );

        wp_register_script( 'football_theme_script',  get_template_directory_uri() . '/script/script.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'football_theme_script' );
    }

}

new BookmarkTheme();
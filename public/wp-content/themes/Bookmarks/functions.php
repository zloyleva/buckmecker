<?php


add_action('after_setup_theme', 'football_theme_setup');
add_action('wp_enqueue_scripts', 'load_football_theme_scripts');

function football_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu' ),
        'left_sidebar' => __('Left sidebar menu'),
    ) );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
//    add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat' ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 43,
        'width'       => 265,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}

function load_football_theme_scripts() {
    // Load our main stylesheet.
    wp_enqueue_style( 'main-css', get_stylesheet_uri() );
    wp_enqueue_style( 'football_theme_styles', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_script( 'jquery', true );

    wp_register_script( 'football_theme_script',  get_template_directory_uri() . '/script/script.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'football_theme_script' );
}

add_action( 'the_post', 'myhook_func' );
function myhook_func( & $post ){
    $user = wp_get_current_user();
    $post->foo = $user->ID .'-'. $post->ID;
    echo "akjsdhflkads";

}

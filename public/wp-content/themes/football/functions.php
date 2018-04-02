<?php

require_once 'Bukmeker.php';
require_once 'Championship.php';
require_once 'Left_sidebar_menu.php';
require_once 'Models/ChampionshipModel.php';
require_once 'Models/BukmekerModel.php';
require_once 'Post_type/PostType.php';
require_once 'Post_type/BukmekerPostType.php';

new Bukmeker();
new Championship();
new BukmekerPostType();


add_action('after_setup_theme', 'football_theme_setup');
add_action('wp_enqueue_scripts', 'load_football_theme_scripts');

function football_theme_setup()
{
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => __('Primary Menu'),
        'left_sidebar' => __('Left sidebar menu'),
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'));
    add_theme_support('custom-logo', array(
        'height' => 43,
        'width' => 265,
        'flex-height' => true,
        'flex-width' => true,
    ));
}

function load_football_theme_scripts()
{
    // Load our main stylesheet.
    wp_enqueue_style('main-css', get_stylesheet_uri());
    wp_enqueue_style('football_theme_styles', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style('editable-select_styles', '//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css');
    wp_enqueue_script('jquery', true);

    wp_register_script('football_theme_script', get_template_directory_uri() . '/script/script.js', array('jquery'), '1.0.0', true);
//    wp_register_script( 'recaptcha_theme_script',  'https://www.google.com/recaptcha/api.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script('football_theme_script');
//    wp_enqueue_script( 'recaptcha_theme_script' );

    wp_localize_script('jquery', 'football_ajax',
        array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('football_ajax_nonce')
        )
    );
}

add_filter('wp_revisions_to_keep', 'my_revisions_to_keep');
function my_revisions_to_keep($revisions)
{
    return 0;
}

add_action('wp_ajax_action', 'my_action_callback');
add_action('wp_ajax_nopriv_action', 'my_action_callback');

function my_action_callback()
{

    if (!(isset($_POST['bk_id']) && is_numeric($_POST['bk_id']))) {
        echo json_encode(['error' => 'wrong data']);
        die();
    }

    $bukmekers_id = sanitize_text_field($_POST['bk_id']);
    $current_bukmekers_users_count = get_post_meta($bukmekers_id, 'bukmekers_users_count');

    if (count($current_bukmekers_users_count) > 0 && $current_bukmekers_users_count[0] > -1) {
        $result = update_post_meta($bukmekers_id, 'bukmekers_users_count', $current_bukmekers_users_count[0] + 1);
    } else {
        $result = update_post_meta($bukmekers_id, 'bukmekers_users_count', 1);
    }

    if ($result) {
        BukmekerModel::getBuckmekersFromDB();
        $data = [
            'total_subscriptions' => BukmekerModel::getBukmekersCountOfSubscriptions(),
            'total_bukmekers' => BukmekerModel::getBukmekersCount(),
            'bukmekers_list' => BukmekerModel::getBuckmekersOrderByUserCount(),
        ];
    }

    echo json_encode([
        'data' => $data ?? '',
        'status' => $result
    ]);
    die();
}

add_action('wp_ajax_action_rate_your_bk', 'set_rate_your_bk');
add_action('wp_ajax_nopriv_action_rate_your_bk', 'set_rate_your_bk');

function set_rate_your_bk(){

    if ( ! isValidDataRateBk($_POST) ) {
        echo json_encode(['error' => 'wrong data rate']);
        die();
    }

    $bukmekers_id = sanitize_text_field($_POST['rate_bk_id']);
    $current_bukmekers_rate = get_post_meta($bukmekers_id, 'bukmekers_rate');

    echo json_encode([
        'data' => $_POST,
        'rate' => $current_bukmekers_rate,
        'status' => 'going'
    ]);
    die();
}
function isValidDataRateBk($data){
    return isset($data['rate_bk_id']) && is_numeric($data['rate_bk_id']) && isset($data['rate']) && is_numeric($data['rate']);
}
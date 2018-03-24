<?php

/**
 * Class Bucmeker
 */
class Bukmeker
{
    static private $bukmekers;
    static private $bukmekers_count;
    static private $bukmekers_count_of_subscriptions;

    public function __construct()
    {
        add_action('init', array($this, 'register_post_types'));
        add_action('add_meta_boxes', array($this, 'bukmekers_rate_custom_box'));
        add_action('add_meta_boxes', array($this, 'bukmekers_review_url_custom_box'));
        add_action('add_meta_boxes', array($this, 'bukmekers_users_count_custom_box'));

        add_action('save_post', array($this, 'bukmekers_save_postdata'));

        add_filter('wp_revisions_to_keep', array($this, 'my_revisions_to_keep'));
    }

    function my_revisions_to_keep($revisions)
    {
        return 0;
    }


    /**
     * Register BK post
     */
    function register_post_types()
    {
        register_post_type('bukmekers', array(
            'label' => null,
            'labels' => array(
                'name' => 'Букмекеры', // основное название для типа записи
                'singular_name' => 'Букмекер', // название для одной записи этого типа
                'add_new' => 'Добавить нового букмекера', // для добавления новой записи
                'add_new_item' => 'Добавление нового букмекера', // заголовка у вновь создаваемой записи в админ-панели.
                'edit_item' => 'Редактирование букмекера', // для редактирования типа записи
                'new_item' => 'Новый букмекер', // текст новой записи
                'view_item' => 'Смотреть букмекера', // для просмотра записи этого типа.
                'search_items' => 'Искать букмекера', // для поиска по этим типам записи
                'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
                'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
                'parent_item_colon' => '', // для родителей (у древовидных типов)
                'menu_name' => 'Букмекеры', // название меню
            ),
            'description' => '',
            'public' => true,
            'publicly_queryable' => null, // зависит от public
            'exclude_from_search' => null, // зависит от public
            'show_ui' => null, // зависит от public
            'show_in_menu' => null, // показывать ли в меню адмнки
            'show_in_admin_bar' => null, // по умолчанию значение show_in_menu
            'show_in_nav_menus' => null, // зависит от public
            'show_in_rest' => null, // добавить в REST API. C WP 4.7
            'rest_base' => null, // $post_type. C WP 4.7
            'menu_position' => null,
            'menu_icon' => 'dashicons-info',
            //'capability_type'   => 'post',
            //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
            //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
            'hierarchical' => false,
            'supports' => array('title', 'editor', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'taxonomies' => array(),
            'has_archive' => false,
            'rewrite' => true,
            'query_var' => true,
        ));
    }

    function bukmekers_users_count_custom_box()
    {
        $screens = array('bukmekers');
        add_meta_box('bukmekers_users_count', 'Количество подписчиков букмекера', array($this, 'bukmekers_users_count_meta_box_cb'), $screens);
    }

    function bukmekers_users_count_meta_box_cb($post, $meta)
    {
        $meta_values = get_post_meta($post->ID, 'bukmekers_users_count', true);

        echo '<label for="bukmekers_users_count_input">Количество подписчиков букмекера</label> ';
        echo '<input type="number" id= "bukmekers_users_count_input" name="bukmekers_users_count" min="0" value="' . $meta_values . '"" />';
    }


    function bukmekers_rate_custom_box()
    {
        $screens = array('bukmekers');
        add_meta_box('bukmekers_rate', 'Рейтинг букмекера', array($this, 'bukmekers_rate_meta_box_cb'), $screens);
    }

    function bukmekers_rate_meta_box_cb($post, $meta)
    {
        $screens = $meta['args'];

        $meta_values = get_post_meta($post->ID, 'bukmekers_rate', true);

        // Используем nonce для верификации
        wp_nonce_field(plugin_basename(__FILE__), 'myplugin_noncename');

        echo '<label for="bukmekers_rate_input">Рейтинг букмекера</label> ';
        echo '<input type="number" id= "bukmekers_rate_input" name="bukmekers_rate" min="0" max="100" value="' . $meta_values . '"" />';
    }

    public function bukmekers_review_url_custom_box()
    {
        $screens = array('bukmekers');
        add_meta_box('bukmekers_review_url', 'Ссылка на сайт букмекера', array($this, 'bukmekers_review_url_meta_box_cb'), $screens);
    }

    public function bukmekers_review_url_meta_box_cb($post, $meta)
    {
        $screens = $meta['args'];

        $meta_values = get_post_meta($post->ID, 'bukmekers_review_url', true);

        // Используем nonce для верификации
        wp_nonce_field(plugin_basename(__FILE__), 'myplugin_noncename');

        // Поля формы для введения данных
        echo '<label for="bbukmekers_review_url_input">Ссылка на сайт букмекера</label> ';
        echo '<input type="text" id= "bbukmekers_review_url_input" name="bukmekers_review_url" value="' . $meta_values . '"" />';
    }

    public function bukmekers_save_postdata($post_id)
    {

        $bukmekers_rate = 0;
        $bukmekers_users_count = 0;
        $bukmekers_review_url = '';

        if (isset($_POST['bukmekers_rate']) && $_POST['bukmekers_rate'] > 0)
            $bukmekers_rate = $_POST['bukmekers_rate'];

        if (isset($_POST['bukmekers_review_url']) && strlen($_POST['bukmekers_review_url']) > 3)
            $bukmekers_review_url = $_POST['bukmekers_review_url'];

        if (isset($_POST['bukmekers_users_count']) && $_POST['bukmekers_users_count'] > 0)
            $bukmekers_users_count = $_POST['bukmekers_users_count'];

        // если это автосохранение ничего не делаем
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        $bukmekers_rate = sanitize_text_field($bukmekers_rate);
        $bukmekers_review_url = sanitize_text_field($bukmekers_review_url);

        update_post_meta($post_id, 'bukmekers_rate', $bukmekers_rate);
        update_post_meta($post_id, 'bukmekers_review_url', $bukmekers_review_url);
        update_post_meta($post_id, 'bukmekers_users_count', $bukmekers_users_count);
    }

    /**
     * Get all publish Buckmekers from DB and hold results
     */
    static function getBuckmekersFromDB()
    {
        global $wpdb;

        $sql = "SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_name, {$wpdb->prefix}posts.guid, meta1.meta_value as bukmekers_rate, meta2.meta_value as bukmekers_review_url, meta3.meta_value as bukmekers_users_count 
                FROM {$wpdb->dbname}.{$wpdb->prefix}posts
                left join {$wpdb->dbname}.{$wpdb->prefix}postmeta as meta1 
                  on {$wpdb->prefix}posts.id = meta1.post_id and meta1.meta_key = 'bukmekers_rate'
                left join {$wpdb->dbname}.{$wpdb->prefix}postmeta as meta2 
                  on {$wpdb->prefix}posts.id = meta2.post_id and meta2.meta_key = 'bukmekers_review_url'
                left join {$wpdb->dbname}.{$wpdb->prefix}postmeta as meta3 
                  on {$wpdb->prefix}posts.id = meta3.post_id and meta3.meta_key = 'bukmekers_users_count'
                where post_type = 'bukmekers' and post_status = 'publish'
                ;";

        self::$bukmekers =  $wpdb->get_results($sql, ARRAY_A);
        self::countTheTotalNumberOfSubscriptions(self::$bukmekers);
    }

    private static function countTheTotalNumberOfSubscriptions($array){
        self::$bukmekers_count =  count($array);

        $count = 0;
        foreach($array as $item){
            $count += $item['bukmekers_users_count'];
        }

        self::$bukmekers_count_of_subscriptions = $count;
    }

    static function getBukmekersCount(){
        return self::$bukmekers_count;
    }

    static function getBukmekersCountOfSubscriptions(){
        return self::$bukmekers_count_of_subscriptions;
    }

    static function getBuckmekers(){
        return self::$bukmekers;
    }

    static function getBuckmekersOrderByRate(){
        return self::sortArray(self::$bukmekers, 'bukmekers_rate');
    }

    static function getBuckmekersOrderByUserCount(){
        return self::sortArray(self::$bukmekers, 'bukmekers_users_count');
    }

    static function sortArray($array, $sort_field){

        $temp_array = [];
        foreach($array as $item){
            $temp_array[] = $item[$sort_field];
        }
        array_multisort($temp_array, SORT_DESC, $array);

        return $array;
    }
}
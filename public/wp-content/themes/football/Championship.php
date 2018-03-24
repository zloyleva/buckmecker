<?php
class Championship{

    protected $meta_fields = [
        [
            'name'=>'championships_play_time',
            'title'=>'Дата игры',
            'label'=>'Дата игры(<i>пример: 02.08 в 21:45 МСК</i>)',
        ],
        [
            'name'=>'championships_prognoz_time',
            'title'=>'Прогноз на игру',
            'label'=>'Прогноз на игру(<i>пример: РС гол - да</i>)',
        ],
        [
            'name'=>'championships_koef',
            'title'=>'Коефициент на игру',
            'type'=>'number',
            'step'=>'0.01',
            'label'=>'Коефициент на игру(<i>пример: 1.91</i>)',
        ],
        [
            'name'=>'championships_tour',
            'title'=>'Турнир',
            'label'=>'Турнир(<i>пример: Ла Лига</i>)',
        ],
        [
            'name'=>'championships_prognoz_for_date',
            'title'=>'Прогноз на дату',
            'label'=>'Прогноз на дату(<i>пример: 11 февраля 2018</i>)',
        ],
        [
            'name'=>'championships_stavka',
            'title'=>'Ставка',
            'label'=>'Текст ставки(<i>Ставка: Реал Сосьедад забьет: да, с коэффициентом 1.44</i>)',
        ],
        [
            'name'=>'championships_prognoz_yes',
            'title'=>'Оценка прогноза. Да',
            'type'=>'number',
            'step'=>'1',
            'label'=>'Количество оценк прогноза "Да"',
        ],
        [
            'name'=>'championships_prognoz_no',
            'title'=>'Оценка прогноза. Нет',
            'type'=>'number',
            'step'=>'1',
            'label'=>'Количество оценк прогноза "Нет"',
        ],
        [
            'name'=>'championships_prognoz_ocenka',
            'title'=>'Оценка прогноза. Звездочки',
            'type'=>'number',
            'step'=>'0.1',
            'max'=>5,
            'label'=>'Оценка прогноза. Макс 5',
        ],
        [
            'name'=>'championships_prognoz_views',
            'title'=>'Количество просмотров',
            'type'=>'number',
            'step'=>'1',
            'label'=>'Количество просмотров прогноза',
        ]
    ];


    public function __construct()
    {
        add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'create_taxonomy') );

        foreach ($this->meta_fields as $meta_field){
            add_action( 'add_meta_boxes', array( $this, $meta_field['name'].'_custom_box' ));
        }

        add_action( 'save_post', array( $this, 'championships_save_postdata' ));

        add_filter( 'post_type_link', array( $this, 'championships_permalink' ), 10, 2 );
        add_filter( 'paginate_links', array( $this, 'add_first_page_link' ), 10, 1 );


    }

    function __call($func, $params){

        foreach ($this->meta_fields as $meta_field){
            if($this->isCustomBoxMethod($func,$meta_field['name'])){
                $screens = array('championships');
                add_meta_box($meta_field['name'], $meta_field['title'], array($this, $meta_field['name'] .'_meta_box_cb'), $screens);
            }
            if($this->isMetaBoxCallBackMethod($func,$meta_field['name'],$params)){
                $post = $params[0];
                $meta_values = get_post_meta($post->ID, $meta_field['name'], true);
                $max = (isset($meta_field['max']) && $meta_field['max'] > 0)?"max='{$meta_field['max']}'":'';
                $type = (isset($meta_field['type']) && $meta_field['type'] == 'number')?"type='number' min='0' {$max} step='{$meta_field['step']}'":"type='text'";
                echo "<label for='{$meta_field['name']}_input'>{$meta_field['label']}</label>";
                echo "<input {$type} id='{$meta_field['name']}_input' name='{$meta_field['name']}' value='{$meta_values}' />";
            }
        }
    }

    /**
     * @param $func
     * @param $meta_field
     * @return bool
     */
    protected function isCustomBoxMethod($func,$meta_field){
        return (strpos($func,'_custom_box') !== false) && (strpos($func, $meta_field) !== false);
    }

    /**
     * @param $func
     * @param $meta_field
     * @param $params
     * @return bool
     */
    protected function isMetaBoxCallBackMethod($func,$meta_field,$params){
        return (strpos($func,'_meta_box_cb') !== false) && (strpos($func, $meta_field) !== false) && ($params[0] instanceof WP_Post);
    }

    function add_first_page_link($link){

        if(!$link){
            $link = '?page=1';
        }
        return $link;
    }

    function register_post_types(){
        register_post_type('championships', array(
            'label'  => null,
            'labels' => array(
                'name'               => 'Чемпионаты', // основное название для типа записи
                'singular_name'      => 'Чемпионат', // название для одной записи этого типа
                'add_new'            => 'Добавить новый Чемпионат', // для добавления новой записи
                'add_new_item'       => 'Добавление нового Чемпионата', // заголовка у вновь создаваемой записи в админ-панели.
                'edit_item'          => 'Редактирование Чемпионата', // для редактирования типа записи
                'new_item'           => 'Новый Чемпионат', // текст новой записи
                'view_item'          => 'Смотреть Чемпионат', // для просмотра записи этого типа.
                'search_items'       => 'Искать Чемпионат', // для поиска по этим типам записи
                'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
                'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
                'parent_item_colon'  => '', // для родителей (у древовидных типов)
                'menu_name'          => 'Чемпионаты', // название меню
            ),
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => null, // зависит от public
            'exclude_from_search' => null, // зависит от public
            'show_ui'             => null, // зависит от public
            'show_in_menu'        => null, // показывать ли в меню адмнки
            'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
            'show_in_nav_menus'   => null, // зависит от public
            'show_in_rest'        => null, // добавить в REST API. C WP 4.7
            'rest_base'           => null, // $post_type. C WP 4.7
            'menu_position'       => null,
            'menu_icon'           => 'dashicons-info',
            //'capability_type'   => 'post',
            //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
            //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
            'hierarchical'        => false,
            'supports'            => array('title','editor','thumbnail','comments'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'taxonomies'          => array('championships_taxonomy'),
            'has_archive'         => 'championships',
            'rewrite' => array( 'slug'=>'championships/%championships_taxonomy%', 'with_front' => false ),
            'query_var'           => true,
        ) );
    }

    function create_taxonomy(){
        register_taxonomy('championships_taxonomy', array('championships'), array(
            'label'                 => '', // определяется параметром $labels->name
            'labels'                => array(
                'name'              => 'Категории чемпионатов',
                'singular_name'     => 'Категория чемпионатов',
                'search_items'      => 'Искать категорию чемпионатов',
                'all_items'         => 'Все категории чемпионатов',
                'view_item '        => 'Смотреть категорию чемпионатов',
                'parent_item'       => 'Parent Genre',
                'parent_item_colon' => 'Parent Genre:',
                'edit_item'         => 'Редактирование категории чемпионатов',
                'update_item'       => 'Update Genre',
                'add_new_item'      => 'Добавить новую категорию чемпионатов',
                'new_item_name'     => 'Новая категория чемпионатов',
                'menu_name'         => 'Категории чемпионатов',
            ),
            'description'           => '', // описание таксономии
            'public'                => true,
            'publicly_queryable'    => null, // равен аргументу public
            'show_in_nav_menus'     => true, // равен аргументу public
            'show_ui'               => true, // равен аргументу public
            'show_tagcloud'         => true, // равен аргументу show_ui
            'show_in_rest'          => null, // добавить в REST API
            'rest_base'             => null, // $taxonomy
            'hierarchical'          => false,
            'update_count_callback' => '',
            'rewrite'               => array( 'slug' => 'championships', 'with_front' => false ),
            //'query_var'             => $taxonomy, // название параметра запроса
            'capabilities'          => array(),
            'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
            'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
            '_builtin'              => false,
            'show_in_quick_edit'    => null, // по умолчанию значение show_ui
        ) );
    }

    function championships_permalink( $permalink, $post ){

        if( strpos($permalink, '%championships_taxonomy%') === FALSE )
            return $permalink;

        $terms = get_the_terms($post, 'championships_taxonomy');
        // если есть элемент заменим холдер
        if( ! is_wp_error($terms) && !empty($terms) && is_object($terms[0]) )
            $taxonomy_slug = $terms[0]->slug;
        else
            $taxonomy_slug = 'no-championships';

        return str_replace('%championships_taxonomy%', $taxonomy_slug, $permalink );
    }

    public function championships_save_postdata($post_id)
    {
        foreach ($this->meta_fields as $meta_field){
            $name = $meta_field['name'];
            ${$name} = ($this->isGetValidNumber($meta_field))?0:"";

            if ( $this->isValidData($meta_field) ){
                ${$name} = $_POST[$name];
            }
        }

        // если это автосохранение ничего не делаем
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        foreach ($this->meta_fields as $meta_field){
            $name = $meta_field['name'];
            update_post_meta($post_id, $name, sanitize_text_field(${$name}));
        }
    }

    /**
     * @param $meta_field
     * @return bool
     */
    protected function isValidData($meta_field){
        if( $this->isGetValidNumber($meta_field) ){
            return isset($_POST[$meta_field['name']]) && $_POST[$meta_field['name']] > 0;
        }else{
            return isset($_POST[$meta_field['name']]) && strlen($_POST[$meta_field['name']]) > 3;
        }
    }

    protected function isGetValidNumber($meta_field){
        return isset($meta_field['type']) && $meta_field['type'] == 'number';
    }
}
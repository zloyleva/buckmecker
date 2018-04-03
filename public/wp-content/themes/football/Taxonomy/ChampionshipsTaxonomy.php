<?php

class ChampionshipsTaxonomy extends Taxonomy{
    protected $taxonomy_type = 'championships_taxonomy';
    protected $taxonomy_labels = [
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
    ];
    protected $taxonomy_args_array = [
        'label'                 => '', // определяется параметром $labels->name
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
    ];
    protected $post_types_array = ['championships'];
}
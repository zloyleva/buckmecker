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
        foreach ($this->meta_fields as $meta_field){
            add_action( 'add_meta_boxes', array( $this, $meta_field['name'].'_custom_box' ));
        }

        add_action( 'save_post', array( $this, 'championships_save_postdata' ));
        add_action( 'save_post', array( $this, 'set_open_comment_for_championships'), 10, 3 );

        add_filter( 'post_type_link', array( $this, 'championships_permalink' ), 10, 2 );
        add_filter( 'paginate_links', array( $this, 'add_first_page_link' ), 10, 1 );
    }


    function set_open_comment_for_championships( $post_id, $post, $update ) {
        //if insert new post
        if(!$update && $post->post_type == 'championships'){
            remove_action( 'save_post', 'set_open_comment_for_championships' );
            wp_update_post( array( 'ID' => $post_id, 'comment_status' => 'open' ) );
            add_action( 'save_post', 'set_open_comment_for_championships' );
        }
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
<?php

/**
 * Class Bucmeker
 */
class Bukmeker
{
    protected $meta_fields = [
        [
            'name'=>'bukmekers_rate',
            'title'=>'Рейтинг букмекера',
            'type'=>'number',
            'step'=>'1',
            'label'=>'Рейтинг букмекера: ',
        ],
        [
            'name'=>'bukmekers_review_url',
            'title'=>'Ссылка на сайт букмекера',
            'label'=>'Ссылка на сайт букмекера: ',
        ],
        [
            'name'=>'bukmekers_users_count',
            'title'=>'Количество подписчиков букмекера',
            'type'=>'number',
            'step'=>'1',
            'label'=>'Количество подписчиков букмекера: ',
        ],
    ];

    public function __construct()
    {
        foreach ($this->meta_fields as $meta_field){
            add_action( 'add_meta_boxes', array( $this, $meta_field['name'].'_custom_box' ));
        }

        add_action('save_post', array($this, 'bukmekers_save_postdata'));
    }


    function __call($func, $params){

        foreach ($this->meta_fields as $meta_field){
            if($this->isCustomBoxMethod($func,$meta_field['name'])){
                $screens = array('bukmekers');
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

    public function bukmekers_save_postdata($post_id)
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
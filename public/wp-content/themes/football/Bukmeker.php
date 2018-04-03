<?php

/**
 * Class Bucmeker
 */
class Bukmeker extends PostMeta
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

    protected $post_type = 'bukmekers';

}
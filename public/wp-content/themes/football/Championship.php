<?php
class Championship extends PostMeta {

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

    protected $post_type = 'championships';


    public function __construct()
    {
        parent::__construct();

        add_filter( 'post_type_link', array( $this, 'championships_permalink' ), 10, 2 );
        add_filter( 'paginate_links', array( $this, 'add_first_page_link' ), 10, 1 );
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

}
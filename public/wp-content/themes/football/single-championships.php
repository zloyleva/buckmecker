<?php get_header(); ?>
<?php
$queried_object = get_queried_object();
$post = new ChampionshipModel();
$post_data = $post->getCurrentPostWithMetaForPage($queried_object->ID);
$post_data = $post_data[0];
$post_term = wp_get_post_terms( $queried_object->ID , 'championships_taxonomy');
$post_term = $post_term[0];

$total_championships_prognoz = $post_data['championships_prognoz_yes'] + $post_data['championships_prognoz_no'];
$percents_yes = ($post_data['championships_prognoz_yes'] != 0)?round($post_data['championships_prognoz_yes']*100/$total_championships_prognoz, 1):0;
$percents_no = ($post_data['championships_prognoz_no'] != 0)?round($post_data['championships_prognoz_no']*100/$total_championships_prognoz, 1):0;

$post->updateChampionsPageViewsCount($post_data['ID']);

?>
<pre>
    <?php

//    var_dump();
    ?>
</pre>
<!-- Main content start -->
<div class="container content single_championship">
    <div class="row">

        <?php get_sidebar( 'left' ); ?>

        <!--    Center: Content list Start   -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 center_content_list">
            <h1>
                <?php echo $post_data['post_title']?>:<br>
                Прогноз на <?php echo $post_data['championships_prognoz_for_date']?>
            </h1>

            <div class="single_post">
                <ol class="breadcrumb">
                    <li><a href="">Главная</a></li>
                    <li>Чемпионаты</li>
                    <li><a href="/championships/<?php echo $post_term->slug?>"><?= $post_term->name?></a></li>
                </ol>
                <div class="article_meta">
                    <div class="article_thumbnail matches">
                        <?php echo get_the_post_thumbnail($post_data['ID'],"full"); ?>
                    </div>
                    <div class="article_meta">
                        <div class="fist_column">
                            <div class="first_row">
                                <div class="item_image"><img src="/wp-content/themes/football/images/time.png"
                                                            alt=""></div>
                                <div class="item_text"><?php echo $post_data['championships_play_time']?></div>
                            </div>
                            <div class="second_row">
                                <div class="item_image"><img src="/wp-content/themes/football/images/tour.png"
                                                            alt=""></div>
                                <div class="item_text"><?php echo $post_data['championships_tour']?></div>
                            </div>
                        </div>
                        <div class="second_column">
                            <div class="first_row">
                                <div class="item_image"><img src="/wp-content/themes/football/images/prognoz.png"
                                                            alt=""></div>
                                <div class="item_text"><?php echo $post_data['championships_prognoz_time']?></div>
                            </div>
                            <div class="second_row">
                                <div class="item_image"><img src="/wp-content/themes/football/images/koef.png"
                                                            alt=""></div>
                                <div class="item_text"><?php echo $post_data['championships_koef']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="post_content">
                    <?php echo $post_data['post_content']; ?>
                    <div class="championships_stavka"><?php echo $post_data['championships_stavka']; ?></div>
                </div>

                <div class="prognoz_box">
                    <h3>Пройдёт ли прогноз?</h3>
                    <form action="">
                        <div class="radio_form_group">
                            <div class="yes_box">
                                <input id="prognoz_yes" name="prognoz_radio" type="radio" value="yes" checked><div class="marker"></div><label for="prognoz_yes" >Да</label>
                            </div>
                            <div class="no_box">
                                <input id="prognoz_no" name="prognoz_radio" type="radio" value="no"><div class="marker"></div><label for="prognoz_no">Нет</label>
                            </div>
                        </div>
                        <button class="send_prognoz_radio">Голосовать</button>
                        <a class="show_more" href="">Посмотреть результаты</a>
                    </form>
                    <div class="rate_result">
                        <div class="rate_result_box">
                            <div class="rate_result_yes">
                                <div class="slider_text"><b>Да</b> <i>(<?php echo $percents_yes;?>%, <?php echo $post_data['championships_prognoz_yes']; ?> голосов)</i></div>
                                <div class="slider_line">
                                    <div class="line" style="width: <?php echo $percents_yes;?>%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="rate_result_box">
                            <div class="rate_result_no">
                                <div class="slider_text"><b>Нет</b> <i>(<?php echo $percents_no; ?>%,  <?php echo $post_data['championships_prognoz_no']; ?> голосов)</i></div>
                                <div class="slider_line">
                                    <div class="line" style="width: <?php echo $percents_no; ?>%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="rate_result_result">
                            Всего проголосовало: <?php echo $post_data['championships_prognoz_yes'] + $post_data['championships_prognoz_no']; ?>
                        </div>
                    </div>
                </div>

                <div class="post_rate">
                    <h3 class="header_post_rate">Оценить прогноз</h3>
                    <div class="rate_stars_box">
                        <a class="rate_star" data-rate="1" href=""><i class="far fa-star"></i></a>
                        <a class="rate_star" data-rate="2" href=""><i class="far fa-star"></i></a>
                        <a class="rate_star" data-rate="3" href=""><i class="far fa-star"></i></a>
                        <a class="rate_star" data-rate="4" href=""><i class="far fa-star"></i></a>
                        <a class="rate_star" data-rate="5" href=""><i class="far fa-star"></i></a>
                    </div>
                </div>

                <div class="comment_list">
                    <h3 class="header_comment_list">Комментарии</h3>

                    <?php
                    $args = [
                        'post_id' => $post_data['ID'],
                    ];
                    if( $comments = get_comments( $args ) ){
                        $ru_months = array( 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' );
                        $en_months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
                        $html = '';
                        $i = 1;
                        foreach( $comments as $comment ){
                            $even = ($i % 2 == 0)?'odd':'';

                            $clean_date = str_replace($en_months,$ru_months, date('F d, Y',strtotime($comment->comment_date)));

                            $html .='<div class="comment_item '.$even.'">';
                            $html .='   <div class="content_box">';
                            $html .='       <div class="blue_sq"></div>';
                            $html .='       <div class="comment_meta">';
                            $html .='           <div class="comment_author">'.$comment->comment_author.'</div>';
                            $html .='           <div class="comment_date">'.$clean_date. ' в ' . date('H:m',strtotime($comment->comment_date)). '</div>';
                            $html .='       </div>';
                            $html .='   </div>';
                            $html .='   <div class="comment_content">';
                            $html .='       <div class="img"><img src="/wp-content/themes/football/images/reply.png"  alt=""></div>';
                            $html .='       <div class="comment_text">'.$comment->comment_content.'</div>';
                            $html .='   </div>';
                            $html .='</div>';

                            $i++;
                        }
                        echo $html;
                    }
                    ?>

                </div>

                <div class="comment_form">

                    <div class="comment-respond">

                        <?php
                        $commenter = wp_get_current_commenter();
                        $args = [
                            'fields'=>[
                                'author' => '<p class="comment-form-author">' .
                                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" aria-required="true" required="required" placeholder="Ваше имя">',
                                'email'  => '<p class="comment-form-email">'.
                                    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" aria-describedby="email-notes" aria-required="true" required="required" placeholder="Ваш e-mail" /></p>',
                                'url'    => '<p class="comment-form-url">' .
                                    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="Сайт" /></p>',
                            ],
                            'comment_field'=>'<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" required="required" placeholder="Текст сообщения"></textarea></p>',
                            'must_log_in'=>'',
                            'logged_in_as'=>'',
                            'comment_notes_before'=>'',
                            'title_reply'=>'Оставить комментарий',
                            'label_submit'=>'Отправить',
                            'submit_field'=>'<div class="form-submit">%1$s %2$s</div>'
                        ];
                        comment_form( $args, $post_data['ID'] );
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <!--    Center: Content list Start   -->

        <?php get_sidebar( 'right' ); ?>

    </div>
</div>

<?php get_footer(); ?>

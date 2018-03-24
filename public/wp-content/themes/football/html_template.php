<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--  Style for editable jQuery select  -->
    <link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css"
          rel="stylesheet">

    <script
            src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
            crossorigin="anonymous"></script>

    //reCaptcha
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <link rel="stylesheet" href="/wp-content/themes/football/css/style.css">
    <script src="/wp-content/themes/football/script/script.js"></script>
</head>
<body>

<!-- header section start -->
<div class="container-fluid header">
    <div class="row site_header">

        <div class="main_menu_control">

            <a class="logo_link" href="#">
                <img src="/wp-content/themes/football/images/logo.png" alt="">
            </a>
            <!--     Humburger button       -->
            <div class="humberger_menu">
                <img class="open_menu" src="/wp-content/themes/football/images/open-menu.png" alt="">
                <img class="close_menu" src="/wp-content/themes/football/images/close-menu.png" alt="">
            </div>

        </div>

        <ul class="menu_control">
            <li class="active"><a href="#">Главная</a></li>
            <li><a href="#">Букмекеры</a></li>
            <li><a href="#">Бонусы</a></li>
            <li><a href="#">Рейтинг БК</a></li>
            <li><a href="#">Mobile БК</a></li>
            <li><a href="#">Ставки</a></li>
            <li><a href="#">Стратегии</a></li>
            <li><a href="#">Справочник</a></li>
            <li><a href="#">О нас</a></li>
        </ul>

        <div class="spacer"></div>

        <div class="search_section">
            <img src="/wp-content/themes/football/images/search.png" alt="">
            <form action="">
                <input type="text" placeholder="Введите слово для поиска...">
            </form>
        </div>

    </div>
</div>
<!-- header section end -->

<!-- Main content start -->
<div class="container content">
    <div class="row">

        <!--   Left_sidebar  Start   -->
        <div class="hidden-xs hidden-sm col-md-3 col-lg-3 left_sidebar">

            <div class="left_sidebar_top">
                <ul class="menu_tab">
                    <li class="active">Рубрики</li>
                    <li>Популярное</li>
                </ul>
                <ul class="rubriky">
                    <li>
                        <a href="" class="has_submenu">
                            <span class="link-text">Чемпионаты</span><span class="triangle"></span>
                        </a>
                        <ul class="sub_menu">
                            <li><a href="">Чемпионат Мира</a></li>
                            <li><a href="">Лига Чемпионов</a></li>
                            <li><a href="">Лига Европы</a></li>
                            <li><a href="">Англия</a></li>
                            <li><a href="">Германия</a></li>
                            <li><a href="">Италия</a></li>
                            <li><a href="">Испания</a></li>
                            <li><a href="">Португалия</a></li>
                            <li><a href="">Россия</a></li>
                            <li><a href="">Украина</a></li>
                            <li><a href="">Франция</a></li>
                        </ul>
                    </li>
                    <li><a href=""><span class="link-text">Ставки на спорт</span><span class="triangle"></span></a></li>
                    <li><a href=""><span class="link-text">О букмекерах</span><span class="triangle"></span></a></li>
                    <li><a href=""><span class="link-text">Бонусы и акции</span><span class="triangle"></span></a></li>
                    <li><a href=""><span class="link-text">Стратегии ставок</span><span class="triangle"></span></a>
                    </li>
                    <li><a href=""><span class="link-text">Рейтинг БК</span><span class="triangle"></span></a></li>
                    <li><a href=""><span class="link-text">Обзор БК</span><span class="triangle"></span></a></li>
                    <li><a href=""><span class="link-text">Справочник</span><span class="triangle"></span></a></li>
                </ul>
            </div>

            <div class="left_sidebar_bottom">
                <div class="sidebar_menu_head">
                    <div class="red_div"></div>
                    <div class="text_section">Кто ваш бк ?</div>
                    <div class="red_div"></div>
                </div>
                <div class="sidebar_content">
                    <form action="" class="select_bk_container">
                        <select name="" id="who_is_your_bk">
                            <option selected disabled>Выберите букмекера</option>
                            <option value="">1xStavka</option>
                            <option value="">Leon</option>
                            <option value="">Fonbet</option>
                            <option value="">Liga stavok</option>
                            <option value="">Parimatch</option>
                            <option value="">Bet365</option>
                            <option value="">Marathonbet</option>
                            <option value="">10Bet</option>
                        </select>
                        <button type="button" class="send_bk btn">OK</button>
                    </form>
                    <div class="bk_graph">
                        <div class="lines">
                            <div class="red_hr_lines"></div>
                        </div>
                        <div class="graph_containers">
                            <div class="p1 column_item" style="height: calc(100px*0.5); width: calc(60%/10)"></div>
                            <div class="p2 column_item" style="height: calc(100px*0.25); width: calc(60%/10)"></div>
                            <div class="p3 column_item" style="height: calc(100px*0.12); width: calc(60%/10)"></div>
                            <div class="p4 column_item" style="height: calc(100px*0.08); width: calc(60%/10)"></div>
                            <div class="p5 column_item" style="height: calc(100px*0.05); width: calc(60%/10)"></div>
                            <div class="p6 column_item" style="height: calc(100px*0.02); width: calc(60%/10)"></div>
                            <div class="p7 column_item" style="height: calc(100px*0.02); width: calc(60%/10)"></div>
                            <div class="p8 column_item" style="height: calc(100px*0.01); width: calc(60%/10)"></div>
                            <div class="p9 column_item" style="height: calc(100px*0.01); width: calc(60%/10)"></div>
                            <div class="p10 column_item" style="height: calc(100px*0.01); width: calc(60%/10)"></div>
                        </div>
                    </div>

                </div>
                <div class="sidebar_content_bottom">
                    <div class="bk_list_container">
                        <ul class="bk_list">
                            <li><a href="">
                                    <div class="color_sq p1"></div>
                                    <div class="bk_text">1xStavka</div>
                                    <div class="percents">3.6%</div>
                                </a></li>
                            <li><a href="">
                                    <div class="color_sq p2"></div>
                                    <div class="bk_text">Leon</div>
                                    <div class="percents">3.4%</div>
                                </a></li>
                            <li><a href="">
                                    <div class="color_sq p3"></div>
                                    <div class="bk_text">Fonbet</div>
                                    <div class="percents">1.7%</div>
                                </a></li>
                            <li><a href="">
                                    <div class="color_sq p4"></div>
                                    <div class="bk_text">Liga stavok</div>
                                    <div class="percents">1.6%</div>
                                </a></li>
                            <li><a href="">
                                    <div class="color_sq p5"></div>
                                    <div class="bk_text">Parimatch</div>
                                    <div class="percents">1.5%</div>
                                </a></li>
                            <li><a href="">
                                    <div class="color_sq p6"></div>
                                    <div class="bk_text">Bet365</div>
                                    <div class="percents">1.2%</div>
                                </a></li>
                            <li><a href="">
                                    <div class="color_sq p7"></div>
                                    <div class="bk_text">Marathonbet</div>
                                    <div class="percents">0.8%</div>
                                </a></li>
                            <li><a href="">
                                    <div class="color_sq p8"></div>
                                    <div class="bk_text">10Bet</div>
                                    <div class="percents">0.6%</div>
                                </a></li>
                            <li class="hide_item"><a href="">
                                    <div class="color_sq p9"></div>
                                    <div class="bk_text">Betfair</div>
                                    <div class="percents">0.6%</div>
                                </a></li>
                            <li class="hide_item"><a href="">
                                    <div class="color_sq p10"></div>
                                    <div class="bk_text">William Hill</div>
                                    <div class="percents">0.4%</div>
                                </a></li>
                            <li class="hide_item"><a href="">
                                    <div class="color_sq p11"></div>
                                    <div class="bk_text">MelBet</div>
                                    <div class="percents">0.1%</div>
                                </a></li>
                            <li class="hide_item"><a href="">
                                    <div class="color_sq p12"></div>
                                    <div class="bk_text">Bwin</div>
                                    <div class="percents">0.1%</div>
                                </a></li>
                        </ul>
                    </div>
                    <div class="more_buttons">
                        <div class="grey_div"></div>
                        <div class="more_button_container close_bk_list">+</div>
                        <div class="grey_div"></div>
                    </div>
                    <div class="bk_total">
                        Всего проголосовало <span class="numbers">4512</span>
                    </div>
                </div>
            </div>

        </div>
        <!--   Left_sidebar  Start   -->

        <!--    Center: Content list Start   -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 center_content_list">
            <h1>СТАВКИ НА ФУТБОЛ</h1>
            <a href="" class="article">
                <div class="article_thumbnail">
                    <img src="/wp-content/themes/football/images/article-01.jpg" alt="">
                </div>
                <div class="article_content">
                    <div class="top_content">
                        <div class="article_title">
                            Беспроигрышные ставки или как заработать на футболе?
                        </div>
                        <div class="article_desc">
                            В данной статье я постараюсь доказать, что беспроигрышные ставки на футбол — это не миф, а
                            реальность. Практически все... ...капперы имеют солидный и стабильный заработок за счет
                            ставок на спорт. Одним из самых распространенных...
                        </div>
                    </div>
                    <div class="bottom_content">
                        <div class="views">
                            <img src="/wp-content/themes/football/images/eye.png" alt=""><span class="count">21</span>
                        </div>
                        <div class="comments">
                            <img src="/wp-content/themes/football/images/comment.png" alt=""><span
                                    class="count">43</span>
                        </div>
                    </div>
                </div>
            </a>
            <div class="article">
                <div class="article_thumbnail matches">
                    <img src="/wp-content/themes/football/images/one_vs_one.jpg" alt="">
                </div>
                <div class="article_content">
                    <div class="top_content">
                        <div class="article_title match">
                            <div class="title_text">Манчестер Юнайтед - Реал Сосьедад</div>
                            <div class="date_text">Прогноз на 11 февраля 2018</div>
                        </div>
                        <div class="article_desc">
                            <div class="meta_data">

                                <table>
                                    <tr>
                                        <td class="item_image"><img src="/wp-content/themes/football/images/time.png"
                                                                    alt=""></td>
                                        <td class="item_text">08.02 в 21:45 МСК</td>
                                        <td class="item_image"><img src="/wp-content/themes/football/images/prognoz.png"
                                                                    alt=""></td>
                                        <td class="item_text">Обе забьют</td>
                                    </tr>
                                    <tr>
                                        <td class="item_image"><img src="/wp-content/themes/football/images/tour.png"
                                                                    alt=""></td>
                                        <td class="item_text">АПЛ</td>
                                        <td class="item_image"><img src="/wp-content/themes/football/images/koef.png"
                                                                    alt=""></td>
                                        <td class="item_text">1.91</td>
                                    </tr>
                                </table>

                            </div>
                            <a href="" class="get_more">Подробнее</a>
                        </div>
                    </div>
                    <div class="bottom_content">
                        <div class="count_render">
                            Проголосовало: За (<span class="green">420</span>), Против (<span class="red">108</span>)
                        </div>
                        <div class="views">
                            <img src="/wp-content/themes/football/images/eye.png" alt=""><span class="count">21</span>
                        </div>
                        <div class="comments">
                            <img src="/wp-content/themes/football/images/comment.png" alt=""><span
                                    class="count">43</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    Center: Content list end   -->

        <div class="hidden-xs hidden-sm col-md-3 col-lg-3 right_sidebar">
            <div class="right_sidebar_first">
                <div class="right_sidebar_top">
                    <div class="sidebar_menu_head">
                        <div class="red_div"></div>
                        <div class="text_section">рейтинг БК</div>
                        <div class="red_div"></div>
                    </div>
                </div>
                <div class="bk_list">
                    <ul class="bk_list_items">
                        <li class="bk_item">
                            <div class="content_section">
                                <div class="up_content">
                                    <div class="bk_thumbnail">
                                        <img src="/wp-content/themes/football/images/bk_01.png" alt="">
                                    </div>
                                    <div class="link_to">
                                        <a class="red_button" href="">перейти</a>
                                    </div>
                                </div>
                                <div class="down_content">
                                    <div class="rate">
                                        <div class="rate_content">
                                            <img class="star" src="/wp-content/themes/football/images/star.png" alt="">
                                            <span class="count">97</span>
                                        </div>
                                    </div>
                                    <div class="link_to">
                                        <a class="read_more" href="">читать обзор</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="bk_item">
                            <div class="content_section">
                                <div class="up_content">
                                    <div class="bk_thumbnail">
                                        <img src="/wp-content/themes/football/images/bk_02.png" alt="">
                                    </div>
                                    <div class="link_to">
                                        <a class="red_button" href="">перейти</a>
                                    </div>
                                </div>
                                <div class="down_content">
                                    <div class="rate">
                                        <div class="rate_content">
                                            <img class="star" src="/wp-content/themes/football/images/star.png" alt="">
                                            <span class="count">97</span>
                                        </div>
                                    </div>
                                    <div class="link_to">
                                        <a class="read_more" href="">читать обзор</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="bk_item">
                            <div class="content_section">
                                <div class="up_content">
                                    <div class="bk_thumbnail">
                                        <img src="/wp-content/themes/football/images/bk_03.png" alt="">
                                    </div>
                                    <div class="link_to">
                                        <a class="red_button" href="">перейти</a>
                                    </div>
                                </div>
                                <div class="down_content">
                                    <div class="rate">
                                        <div class="rate_content">
                                            <img class="star" src="/wp-content/themes/football/images/star.png" alt="">
                                            <span class="count">97</span>
                                        </div>
                                    </div>
                                    <div class="link_to">
                                        <a class="read_more" href="">читать обзор</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="bk_item">
                            <div class="content_section">
                                <div class="up_content">
                                    <div class="bk_thumbnail">
                                        <img src="/wp-content/themes/football/images/bk_04.png" alt="">
                                    </div>
                                    <div class="link_to">
                                        <a class="red_button" href="">перейти</a>
                                    </div>
                                </div>
                                <div class="down_content">
                                    <div class="rate">
                                        <div class="rate_content">
                                            <img class="star" src="/wp-content/themes/football/images/star.png" alt="">
                                            <span class="count">97</span>
                                        </div>
                                    </div>
                                    <div class="link_to">
                                        <a class="read_more" href="">читать обзор</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="right_sidebar_bottom">
                    <div class="more_buttons">
                        <div class="grey_div"></div>
                        <div class="more_button_container close_bk_list">+</div>
                        <div class="grey_div"></div>
                    </div>
                    <div class="bk_total">
                        Показать еще <span class="numbers">2</span>
                    </div>
                </div>
            </div>
            <div class="right_sidebar_second">
                <div class="right_sidebar_top">
                    <div class="sidebar_menu_head">
                        <div class="red_div"></div>
                        <div class="text_section">оцените бк</div>
                        <div class="red_div"></div>
                    </div>
                </div>
                <div class="right_sidebar_content">
                    <div class="head_text text-center">
                        Рейтинг букмекеров<br>
                        зависит от Ваших оценок.
                        Пожалуйста, дайте свою оценку:
                    </div>
                    <form id="rate_your_bk" action="">
                        <select name="" id="select_bk">
                            <option selected disabled>Выберите букмекера</option>
                            <option value="">1xStavka</option>
                            <option value="">Leon</option>
                            <option value="">Fonbet</option>
                            <option value="">Liga stavok</option>
                            <option value="">Parimatch</option>
                            <option value="">Bet365</option>
                            <option value="">Marathonbet</option>
                            <option value="">10Bet</option>
                        </select>
                        <input name="name" type="text" placeholder="Ваше имя">
                        <input name="email" type="email" placeholder="Ваш e-mail">

                        <input name="rate" id="bk_rate" type="number">

                        <textarea name="your_comment" id="your_comment" placeholder="Ваш отзыв"></textarea>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Main content end -->

<!--  Footer start  -->

<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 description">
                        <div class="logo">
                            <a class="logo_link" href="#">
                                <img src="/wp-content/themes/football/images/logo.png" alt="">
                            </a>
                            <div class="in_social">
                                Мы в социальных сетях
                            </div>
                            <div class="social_link">
                                <a href=""><img src="/wp-content/themes/football/images/vk.png" alt=""></a>
                                <a href=""><img src="/wp-content/themes/football/images/facebook.png" alt=""></a>
                                <a href=""><img src="/wp-content/themes/football/images/trwitter.png" alt=""></a>
                                <a href=""><img src="/wp-content/themes/football/images/inst.png" alt=""></a>
                                <a href=""><img src="/wp-content/themes/football/images/youtube.png" alt=""></a>
                                <a href=""><img src="/wp-content/themes/football/images/telegr.png" alt=""></a>
                                <a href=""><img src="/wp-content/themes/football/images/google.png" alt=""></a>
                            </div>
                        </div>
                        <div class="about_us">
                            <h3>о нас</h3>
                            <p>Всем, привет друзья!</p>
                            <p>Меня зовут Георгий Молотов. Являюсь автором и создателем этого сайта, посвященного
                                анализу и прогнозам на футбольные матчи. Родился 26 мая, 1990 года в Севастополе.</p>
                            <p>На данный момент я занимаюсь только своим сайтом и углубляюсь в тему бэттинга, пока что
                                получается весьма неплохо. И параллельно делаю ставки, занимаюсь этим уже на протяжении
                                3-х лет.</p>
                            <p>Закончил я Севастопольский Национальный Технический Университет на факультете «Финансы и
                                кредит» и допом еще закончил менеджмент. Работал менеджером в компании по продаже
                                инновационных решений в строительстве, получалось весьма неплохо, но было мало драйва и
                                + еще наступило время кризиса и многие строители заморозили объекты. И я начал
                                увлекаться ставками.</p>
                            <p>С 2015 по 2016 работал спортивным аналитиком на vseprosport.ru. И в итоге решил завести
                                свой портал, хочется поделиться информацией с новичками и конечно пообщаться с профи.
                                Также со мной в команде будут работать два моих друга, жутко фанатеющих по футболу, один
                                ярый фанат англии, а второй спец по Лалиге и Испании. Вместе мы будем анализировать
                                предстоящие матчи и делиться ими с Вами, дорогие друзья!</p>
                        </div>
                    </div>
                    <div class="hidden-xs hidden-sm col-md-3 col-lg-3  col-md-offset-1 col-lg-offset-1 contact_form">
                        <h3>обратная связь</h3>
                        <form action="" >
                            <div class="form-group">
                                <input name="name" type="text" class="form-control" placeholder="Ваше имя">
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control" placeholder="Ваш e-mail">
                            </div>
                            <div class="form-group">
                                <input name="subject" type="text" class="form-control" placeholder="Тема сообщения">
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" placeholder="Текст сообщения"></textarea>
                            </div>
                            <div class="form-group buttons_section">
                                <div class="g-recaptcha" data-sitekey="6LdmAkwUAAAAABOtwVL9k6O5ChKAO6G6xlkJAerF"></div>
                                <button type="submit" class="btn send_msg">отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--  Footer end  -->

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Вывод таблицы профилей сотрудников</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css">
        pre{
            background-color: #282c34;;
            padding: 5px;
            color: #fff;
        }
        span.green{
            color: #688e2f;
        }
        span.orange{
            color: #e48822;
        }
        span.red{
            color: #e0685c;
        }
        img.f_width{
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php

            $header = [
                "first_name"=>"Имя",
                "last_name"=>"Фамилия",
                "born"=>"Год рождения",
                "hired"=>"Принят в штат",
                "job"=>"Должность",
                "salary"=>"Зарплата",
                "experience"=>"Опыт"
            ];

            $staff = [
                [
                    "first_name"=>"Иван",
                    "last_name"=>"Васильев",
                    "born"=>1996,
                    "hired"=>2017,
                    "job"=>"Программист",
                    "salary"=>1500,
                    "experience"=>3,5
                ],
                [
                    "first_name"=>"Артем",
                    "last_name"=>"Васильев",
                    "born"=>1990,
                    "hired"=>2015,
                    "job"=>"Программист",
                    "salary"=>2500,
                    "experience"=>6,5
                ],
                [
                    "first_name"=>"Иллья",
                    "last_name"=>"Моргунов",
                    "born"=>1999,
                    "hired"=>2017,
                    "job"=>"Стажер",
                    "salary"=>200,
                    "experience"=>0,3
                ],
                [
                    "first_name"=>"Александр",
                    "last_name"=>"Мищенко",
                    "born"=>1982,
                    "hired"=>2013,
                    "job"=>"СТО",
                    "salary"=>3500,
                    "experience"=>8
                ],
                [
                    "first_name"=>"Анна",
                    "last_name"=>"Герасимова",
                    "born"=>1978,
                    "hired"=>2013,
                    "job"=>"Бухгалтер",
                    "salary"=>800,
                    "experience"=>12
                ],
                [
                    "first_name"=>"Ирина",
                    "last_name"=>"Фролова",
                    "born"=>1998,
                    "hired"=>2016,
                    "job"=>"Дизайнер",
                    "salary"=>850,
                    "experience"=>2
                ],
                [
                    "first_name"=>"Евдокия",
                    "last_name"=>"Стоянова",
                    "born"=>1965,
                    "hired"=>2014,
                    "job"=>"Уборщица",
                    "salary"=>250,
                    "experience"=>""
                ],
                [
                    "first_name"=>"Игорь",
                    "last_name"=>"Артюхов",
                    "born"=>1980,
                    "hired"=>2013,
                    "job"=>"Директор",
                    "salary"=>3250,
                    "experience"=>10
                ],
            ];
            //Подготавливаем шапку таблицы
            $html = <<<HTML
  <table class="table table-striped">
    <thead>
      <tr>
        <th>{$header['first_name']}</th>
        <th>{$header['last_name']}</th>
        <th>{$header['born']}</th>
        <th>{$header['hired']}</th>
        <th>{$header['job']}</th>
        <th>{$header['salary']}</th>
        <th>{$header['experience']}</th>
      </tr>
    </thead>
    <tbody>
HTML;
            //добавляем тело таблицы с данными персонала
            foreach ($staff as $item){
                $html .= <<<HTML
      <tr>
        <td>{$item['first_name']}</td>
        <td>{$item['last_name']}</td>
        <td>{$item['born']}</td>
        <td>{$item['hired']}</td>
        <td>{$item['job']}</td>
        <td>{$item['salary']}</td>
        <td>{$item['experience']}</td>
      </tr>
HTML;
            }
            //Закрываем теги таблицы
            $html .= "</tbody>\n
    </table>";
            //Выводим в HTML
            echo $html;

            ?>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">

            <?php
            echo "<pre>";
            //            print_r($_GET['search_text']);
            print_r($_GET);
            echo "</pre>";

            $searchTextValue = "";
            if(isset($_GET['search_text'])){
                $searchTextValue =  $_GET['search_text'];
            }
            ?>

            <form action="" method="get">
                <div class="form-group">
                    <label for="searchPerson">Search:</label>
                    <input name="search_text" type="text" class="form-control" id="searchPerson"
                           placeholder="Enter your text" value="<?=$searchTextValue;?>">
                </div>
                <div class="form-group">
                    <label for="searchSalary">Salary:</label>
                    <input name="search_salary" type="text" class="form-control" id="searchSalary" placeholder="Enter salary to find">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
</div>



<?php
/**
<?php get_header(); ?>
<!---->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            --><?php //if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
<!---->
<!--                <h1>--><?php //the_title();?><!--</h1>-->
<!--                <p>--><?php //the_content();?><!--</p>-->
<!---->
<!--            --><?php //endwhile; ?>
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--    </div>-->
<!---->
<?php get_footer(); ?>
 * */
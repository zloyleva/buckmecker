<?php get_header(); ?>

     <div class="container">
         <div class="row">

             <?php

             include_once 'staff_data.php';

             $html =  "<table class='table table-striped'>";
             $html .= " <thead>";
             $html .= "    <tr>";
             $html .= "        <th>{$header['first_name']}</th>";
             $html .= "        <th>{$header['last_name']}</th>";
             $html .= "        <th>{$header['born']}</th>";
             $html .= "        <th>{$header['hired']}</th>";
             $html .= "        <th>{$header['job']}</th>";
             $html .= "        <th>{$header['salary']}</th>";
             $html .= "        <th>{$header['experience']}</th>";
             $html .= "    </tr>";
             $html .= " </thead>";
             $html .= "<tbody>";

             //добавляем тело таблицы с данными персонала
             foreach ($staff as $item){
                 $html .= " <tr>";
                 $html .= "    <td>{$item['first_name']}</td>";
                 $html .= "    <td>{$item['last_name']}</td>";
                 $html .= "    <td>{$item['born']}</td>";
                 $html .= "    <td>{$item['hired']}</td>";
                 $html .= "    <td>{$item['job']}</td>";
                 $html .= "    <td>{$item['salary']}</td>";
                 $html .= "    <td>{$item['experience']}</td>";
                 $html .= " </tr>";
             }
             //Закрываем теги таблицы
             $html .= "    </tbody>\n";
             $html .= "</table>";
             //Выводим в HTML
             echo $html;

             ?>
             
         </div>
     </div>

 <?php get_footer(); ?>


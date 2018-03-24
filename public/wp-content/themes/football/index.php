<?php get_header(); ?>
<!-- First get all Bukmekers and save them -->
<?php
    $championship =  new ChampionshipModel();
    $current_page = $_GET['page']??1;
    $posts = $championship->getPostsWithMetaForPage($current_page);
?>

<!--    <pre>-->
<!--        --><?php
//
//        echo $championship->getTotalPageCount();
//        var_dump($championship->getPostsWithMetaForPage($current_page));
//        ?>
<!--    </pre>-->

    <!-- Main content start -->
    <div class="container content">
        <div class="row">

            <?php get_sidebar( 'left' ); ?>

            <!--    Center: Content list Start   -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 center_content_list">
                <h1>Чемпионаты</h1>

                <?php foreach($posts as $post): ?>
                <div class="article">
                    <div class="article_thumbnail matches">
                        <?php echo get_the_post_thumbnail($post['ID'],"full"); ?>
                    </div>
                    <div class="article_content">
                        <div class="top_content">
                            <div class="article_title match">
                                <div class="title_text"><?= $post['post_title']?></div>
                                <div class="date_text">Прогноз на <?= $post['championships_prognoz_for_date']?></div>
                            </div>
                            <div class="article_desc">
                                <div class="meta_data">

                                    <table>
                                        <tr>
                                            <td class="item_image"><img src="/wp-content/themes/football/images/time.png"
                                                                        alt=""></td>
                                            <td class="item_text"><?= $post['championships_play_time']?></td>
                                            <td class="item_image"><img src="/wp-content/themes/football/images/prognoz.png"
                                                                        alt=""></td>
                                            <td class="item_text"><?= $post['championships_prognoz_time']?></td>
                                        </tr>
                                        <tr>
                                            <td class="item_image"><img src="/wp-content/themes/football/images/tour.png"
                                                                        alt=""></td>
                                            <td class="item_text"><?= $post['championships_tour']?></td>
                                            <td class="item_image"><img src="/wp-content/themes/football/images/koef.png"
                                                                        alt=""></td>
                                            <td class="item_text"><?= $post['championships_koef']?></td>
                                        </tr>
                                    </table>

                                </div>
                                <a href="<?= $post['guid']?>" class="get_more">Подробнее</a>
                            </div>
                        </div>
                        <div class="bottom_content">
                            <div class="count_render">
                                Проголосовало: За (<span class="green"><?php echo $post['championships_prognoz_yes'];?></span>), Против (<span class="red"><?php echo $post['championships_prognoz_no'];?></span>)
                            </div>
                            <div class="views">
                                <img src="/wp-content/themes/football/images/eye.png" alt=""><span class="count"><?php echo $post['championships_prognoz_views'];?></span>
                            </div>
                            <div class="comments">
                                <img src="/wp-content/themes/football/images/comment.png" alt=""><span
                                        class="count"><?php echo wp_count_comments( $post['ID'] )->total_comments?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <!--   Pagination links    -->
                <div class='pagination'>
                    <?php  include_once(locate_template('templates/pagination.php')); ?>
                </div>
                <!--   Pagination links    -->

            </div>
            <!--    Center: Content list End   -->

            <?php get_sidebar( 'right' ); ?>

        </div>
    </div>

<?php get_footer(); ?>
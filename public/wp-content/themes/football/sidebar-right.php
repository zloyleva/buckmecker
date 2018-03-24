<!-- Right sidebar start -->
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 right_sidebar">
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

                <?php

                $html = '';
                $item_counts = 0;
                foreach(Bukmeker::getBuckmekersOrderByRate() as $post){
                    $item_counts++;
                    $add_class = '';
                    if($item_counts>4){
                        $add_class = 'hide_item';
                    }

                    $html .= "<li class='bk_item {$add_class}'>";
                    $html .= "  <div class='content_section'>";
                    $html .= "    <div class='up_content'>";
                    $html .= "        <div class='bk_thumbnail'>";
                    $html .=            '<img src="'.get_the_post_thumbnail_url($post['ID'],"full").'" >';
                    $html .= "        </div>";
                    $html .= "        <div class='link_to'>";
                    $html .= "            <a class='red_button' href='//". $post['bukmekers_review_url'] ."'>перейти</a>";
                    $html .= "        </div>";
                    $html .= "    </div>";
                    $html .= "    <div class='down_content'>";
                    $html .= "        <div class='rate'>";
                    $html .= "            <div class='rate_content'>";
                    $html .= "              <img class='star' src='/wp-content/themes/football/images/star.png' alt=''>";
                    $html .= "              <span class='count'>". $post['bukmekers_rate'] ."</span>";
                    $html .= "            </div>";
                    $html .= "         </div>";
                    $html .= "         <div class='link_to'>";
                    $html .= "            <a class='read_more' href='".$post['guid']."'>читать обзор</a>";
                    $html .= "         </div>";
                    $html .= "    </div>";
                    $html .= "  </div>";
                    $html .= "</li>";
                }

                wp_reset_postdata();

                echo $html;
                ?>

            </ul>
        </div>
        <?php if($item_counts>4):?>
        <div class="right_sidebar_bottom">
            <div class="more_buttons">
                <div class="grey_div"></div>
                <div id="show_bk_list" class="more_button_container close_bk_list">+</div>
                <div class="grey_div"></div>
            </div>
            <div class="bk_total">
                Показать еще
                <span class="numbers">
                    <?php echo $item_counts-4 ?>
                </span>
            </div>
        </div>
        <?php endif ?>
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
                <select name="selct_bk" id="select_bk">
                    <option selected disabled>Выберите букмекера</option>
                    <?php
                        $html = '';
                        foreach(Bukmeker::getBuckmekers() as $post){
                            $html .= '<option value="'.$post['ID'].'">'.$post['post_title'].'</option>';
                        }
                        echo $html;
                    ?>
                </select>
                <input name="name" type="text" placeholder="Ваше имя">
                <input name="email" type="email" placeholder="Ваш e-mail">

                <input name="rate" id="bk_rate" type="number">

                <textarea name="your_comment" id="your_comment" placeholder="Ваш отзыв"></textarea>
            </form>
        </div>
    </div>
</div>
<!-- Right sidebar end -->

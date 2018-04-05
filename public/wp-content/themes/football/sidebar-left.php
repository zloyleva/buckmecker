<!--   Left_sidebar  Start   -->
<div class="hidden-xs hidden-sm col-md-3 col-lg-3 left_sidebar">

    <div class="left_sidebar_top">
        <ul class="menu_tab">
            <li class="active">Рубрики</li>
            <li>Популярное</li>
        </ul>

        <?php
        $args =[
            'theme_location' => 'left_sidebar',
            'menu_class' => 'rubriky',
            'container' => false,
            'walker' => new Left_sidebar_menu
        ];
        ?>
        <?php wp_nav_menu( $args ); ?>

    </div>

    <div class="left_sidebar_bottom">
        <div class="sidebar_menu_head">
            <div class="red_div"></div>
            <div class="text_section">Кто ваш бк ?</div>
            <div class="red_div"></div>
        </div>
        <div class="sidebar_content">
            <form id="who_is_your_bk_form" action="" class="select_bk_container">
                <input id="bk_id" type="hidden" name="bk_id" value="">
                <input id="bk_action" type="hidden" name="action" value="action">
                <select name="who_is_your_bk" id="who_is_your_bk">
                    <option selected disabled>Выберите букмекера</option>
                    <?php
                    $html = '';
                    foreach($bukmeker->getBuckmekers() as $post){
                        $html .= '<option data-value="'.$post['ID'].'">'.$post['post_title'].'</option>';
                    }
                    echo $html;
                    ?>
                </select>
                <button id="who_is_your_bk_button" type="button" class="send_bk btn">OK</button>
            </form>
            <div class="bk_graph">
                <div class="lines">
                    <div class="red_hr_lines"></div>
                </div>
                <div class="graph_containers left">
                    <?php
                    $html = '';
                    $total_subscriptions = $bukmeker->getBukmekersCountOfSubscriptions();
                    $total_bukmekers = $bukmeker->getBukmekersCount();
                    $i = 0;
                    foreach($bukmeker->getBuckmekersOrderByUserCount() as $post){
                        $i++;
                        $html .= "<div class='p{$i} column_item' style='height: calc((100px*{$post['bukmekers_users_count']})/{$total_subscriptions}); width: calc(60%/{$total_bukmekers})'></div>";
                    }
                    echo $html;
                    ?>

                </div>
            </div>

        </div>
        <div class="sidebar_content_bottom">
            <div class="bk_list_container">
                <ul class="bk_list left">
                    <?php
                    $html = '';
                    $i = 0;

                    foreach($bukmeker->getBuckmekersOrderByUserCount() as $post){
                        $i++;
                        $percents = ($post['bukmekers_users_count']>0)?round(100*$post['bukmekers_users_count']/$total_subscriptions, 1):0;
                        $class = ($i > 9)?"hide_item":'';
                        $html .= "<li class='{$class}'><a href='{$post['guid']}'>";
                        $html .= "  <div class='color_sq p{$i}'></div>";
                        $html .= "  <div class='bk_text'>{$post['post_name']}</div>";
                        $html .= "  <div class='percents'>". $percents ."%</div>";
                        $html .= "</a></li>";
                    }
                    echo $html;
                    ?>
                </ul>
            </div>
            <div class="more_buttons">
                <div class="grey_div"></div>
                <div class="more_button_container close_bk_list">+</div>
                <div class="grey_div"></div>
            </div>
            <div class="bk_total">
                Всего проголосовало <span class="numbers left"><?= $total_subscriptions; ?></span>
            </div>
        </div>
    </div>

</div>
<!--   Left_sidebar  Start   -->
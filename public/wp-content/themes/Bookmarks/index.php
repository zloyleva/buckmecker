<?php get_header(); ?>

<?php
require_once 'classes/Bookmark.php';

$bookmark = new Bookmark();
$current_user_id = get_current_user_id();

$bookmark->bookmarkAction($_POST);

?>

<div class="container">
    <div class="row">

        <ul class="cards">

        <?php

        $args =[
            'posts_per_page' => 0,
        ];
        $lastposts = get_posts( $args );

        foreach( $lastposts as $post ){
            setup_postdata($post);

            $button_text = "Bookmark";
            $action = 'set';
            $sign = " <i class='fas fa-bookmark'></i>";
            if($bookmark->isPostBookmarkSetForCurrentUser($post->ID, $current_user_id)){
                $button_text = "UnBookmark";
                $action = 'unset';
                $sign = " <i class='far fa-bookmark'></i>";
            }

            ?>

            <li class="cards__item">
                <div class="card">
                    <div class="card__image card__image--fence" style="background-image: url(<?= get_the_post_thumbnail_url($post->ID,"full"); ?>)"></div>
                    <div class="card__content">
                        <div class="card__title"><?php the_title();?></div>
                        <p class="card__text"><?php echo wp_trim_words(get_the_content(), 20);?></p>

                        <?php if(is_user_logged_in()): ?>
                            <form action="" method="post">
                                <input type="hidden" name="bookmark" value="<?php echo $action; ?>">
                                <input type="hidden" name="post_id" value="<?php echo $post->ID?>">
                                <input type="hidden" name="user_id" value="<?php echo $current_user_id?>">
                                <button class="btn btn--block card__btn" ><?php echo $button_text . $sign; ?></button>
                            </form>
                        <?php endif;?>
                    </div>
                </div>
            </li>

            <?php
        }
        ?>
        </ul>
    </div>
</div>

<?php get_footer(); ?>

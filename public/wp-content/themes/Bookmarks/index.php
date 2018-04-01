<?php get_header(); ?>

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
            ?>

            <li class="cards__item">
                <div class="card">
                    <div class="card__image card__image--fence" style="background-image: url(<?= get_the_post_thumbnail_url($post->ID,"full"); ?>)"></div>
                    <div class="card__content">
                        <?php the_title();?>
                        <p class="card__text"><?php echo wp_trim_words(get_the_content(), 20);?></p>
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

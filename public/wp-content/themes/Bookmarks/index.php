<?php get_header(); ?>

<?php

if( isset($_GET['bookmark']) && isset($_GET['post_id']) && $_GET['bookmark'] == "set" && $_GET['post_id']>0){
    echo "Bookmarks " . $_GET['post_id'];

    get_post_meta($_GET['post_id'], '_bookmarks');
}

?>

    <div class="container">
        <div class="row">

            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
            get_posts();
            ?>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <?php echo get_the_post_thumbnail($post->ID,"full");?>
                    <div class="caption">
                        <h3><?php the_title();?></h3>
                        <p><?php echo wp_trim_words(get_the_content(), 10);?></p>
                        <p>
                            <a href="#" class="btn btn-primary" role="button">Button</a>
                            <?= $post->foo?>
                            <?php if(is_user_logged_in()): ?>
                            <form action="" method="get">
                                <input type="hidden" name="bookmark" value="set">
                                <input type="hidden" name="post_id" value="<?= $post->ID?>">
                                <button class="btn btn-default" >Add to Bookmarks</button>
                            </form>
                            <?php endif;?>
                        </p>
                    </div>
                </div>
            </div>

            <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>

<?php get_footer(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <title></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <script src=" <?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<!-- header section start -->
<div class="container-fluid header">
    <div class="row site_header">

        <div class="main_menu_control">

            <?php the_custom_logo(); ?>

            <!--     Humburger button       -->
            <div class="humberger_menu">
                <img class="open_menu" src="/wp-content/themes/football/images/open-menu.png" alt="">
                <img class="close_menu" src="/wp-content/themes/football/images/close-menu.png" alt="">
            </div>

        </div>

        <?php
        $args =[
            'theme_location'    => 'primary',
            'menu_class'    => 'menu_control',
            'container' => false
        ];
        ?>
        <?php wp_nav_menu( $args ); ?>

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
<?php BukmekerModel::getBuckmekersFromDB(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<header class="container">
    <div class="row">
        <div class="search">
            <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
                    <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" class="form-control" />
                </div>
            </form>
        </div>
        <div class="logo">
            <div class="text-center logo-img">
                <?php the_custom_logo(); ?>
            </div>
            <h3 class="text-center bold"><?php echo get_option('blogdescription');?></h3>
        </div>
        <nav class="navbar navbar-default">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo home_url()?>">Home</a></li>
                </ul>
                <?php if(is_user_logged_in()): ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/bookmarks">My bookmarks</a></li>
                </ul>
                <?php endif;?>

            </div>
        </nav>
    </div>
</header>

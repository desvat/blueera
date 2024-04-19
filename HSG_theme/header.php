<html lang="sk-SK">
  <head>

    <meta charset="utf-8" />

    <meta name="robots"               content="index, follow" />
    <meta name="author"               content="Adrián Jakubča :: jakubca.com" />

    <meta name="theme-color"          content="#D72528" />
    <meta name="viewport"             content="width=device-width, initial-scale = 1, maximum-scale=3.0, minimum-scale=1" />
    <meta name="description"          content="" />
    <meta name="copyright"            content="" />

    <meta property="og:type"          content="website" />
    <meta property="og:url"           content="" />
    <meta property="og:title"         content="" />
    <meta property="og:description"   content="" />
    <meta property="og:image"         content="" />
    <meta property="og:site_name"     content="" />

    <title>HSG  :: <?php the_title(); ?></title>

    <?php wp_head(); ?>

    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/js/jquery-3.6.1.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/js/main.js'; echo "?version=" . rand(); ?>"></script>

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); echo "?version=" . rand(); ?>">

    <link rel='shortcut icon' href="<?php echo get_stylesheet_directory_uri().'/favicon.png'; ?>" />

  </head>

  <body>

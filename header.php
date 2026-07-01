<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
  <div class="container">
    <a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">SIKUMYS<span> INC.</span></a>
    <nav class="site-nav">
      <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'container' => false,
        'fallback_cb' => false,
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      ) );
      ?>
    </nav>
  </div>
</header>

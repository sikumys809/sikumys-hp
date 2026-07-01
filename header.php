<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="hdr">
  <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
    <?php if ( $logo = sk_opt_image( 'logo_header' ) ) : ?>
      <?php sk_img( $logo, get_bloginfo( 'name' ) ); ?>
    <?php else : ?>
      SIKUMYS<b>.</b>
    <?php endif; ?>
  </a>
  <nav>
    <a href="<?php echo esc_url( sk_page_url( 'page-overview.php' ) ); ?>">Overview</a>
    <a href="<?php echo esc_url( sk_page_url( 'page-message.php' ) ); ?>">Message</a>
    <a href="<?php echo esc_url( sk_page_url( 'page-philosophy.php' ) ); ?>">Philosophy</a>
    <a href="<?php echo esc_url( sk_page_url( 'page-service.php' ) ); ?>">Service &amp; Investment</a>
  </nav>
  <button class="burger" id="burger" aria-label="menu"><span></span><span></span><span></span></button>
</header>

<div class="drawer" id="drawer">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="dn">Top</span><span class="dj">トップ</span></a>
  <a href="<?php echo esc_url( sk_page_url( 'page-overview.php' ) ); ?>"><span class="dn">Overview</span><span class="dj">概要</span></a>
  <a href="<?php echo esc_url( sk_page_url( 'page-message.php' ) ); ?>"><span class="dn">Message</span><span class="dj">代表挨拶</span></a>
  <a href="<?php echo esc_url( sk_page_url( 'page-philosophy.php' ) ); ?>"><span class="dn">Philosophy</span><span class="dj">企業理念</span></a>
  <a href="<?php echo esc_url( sk_page_url( 'page-service.php' ) ); ?>"><span class="dn">Service &amp; Investment</span><span class="dj">事業紹介＆投資先</span></a>
</div>

<main>

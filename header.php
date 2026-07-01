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
    <div class="site-brand-wrap">
      <?php if ( sk_has( 'logo_header' ) ) : ?>
        <a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo sk_img( 'logo_header', 'full', array( 'alt' => get_bloginfo( 'name' ) ) ); ?></a>
      <?php elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?><span> INC.</span></a>
      <?php endif; ?>
    </div>

    <nav class="site-nav">
      <?php
      if ( has_nav_menu( 'primary' ) ) {
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'container' => false,
          'fallback_cb' => false,
          'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        ) );
      }
      ?>
    </nav>

    <?php
    $socials = array_filter( array(
      'facebook'  => sk_opt( 'sns_facebook' ),
      'youtube'   => sk_opt( 'sns_youtube' ),
      'instagram' => sk_opt( 'sns_instagram' ),
      'x'         => sk_opt( 'sns_x' ),
    ) );
    if ( $socials ) :
    ?>
      <div class="site-socials">
        <?php foreach ( $socials as $network => $url ) : ?>
          <?php if ( $url ) : ?>
            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( strtoupper( $network ) ); ?></a>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</header>

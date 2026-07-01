<?php get_header(); ?>

<?php if ( $hero_media = sk_opt_image( 'hero_media' ) ) : ?>
  <?php $hero_ext = strtolower( pathinfo( (string) parse_url( $hero_media, PHP_URL_PATH ), PATHINFO_EXTENSION ) ); ?>
  <?php if ( in_array( $hero_ext, array( 'jpg', 'jpeg', 'png', 'gif', 'webp', 'avif', 'svg' ), true ) ) : ?>
    <img class="hero-media" src="<?php echo esc_url( $hero_media ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
  <?php else : ?>
    <video class="hero-media" src="<?php echo esc_url( $hero_media ); ?>" autoplay muted loop playsinline></video>
  <?php endif; ?>
<?php else : ?>
  <canvas id="bg"></canvas>
<?php endif; ?>

<div class="hero" id="hero">
  <div class="hero-inner" id="heroInner">
    <?php if ( $hero_title = sk_opt( 'hero_title' ) ) : ?>
      <h1><?php echo nl2br( esc_html( $hero_title ) ); ?></h1>
    <?php else : ?>
      <h1>CREATING EVERY<br><span class="acc">&quot;HAPPINESS&quot;</span><br>IN THIS WORLD.</h1>
    <?php endif; ?>
    <?php if ( $hero_sub = sk_opt( 'hero_sub' ) ) : ?>
      <p class="sub"><?php echo esc_html( $hero_sub ); ?></p>
    <?php endif; ?>
  </div>
  <div class="cg-tag"><span class="dot"></span>3DCG Hero — Network ／ Scroll-Driven</div>
  <div class="scrollcue">Scroll</div>
</div>

<div class="top-body">

  <?php // VISION ?>
  <?php if ( $vision_heading = sk_opt( 'vision_heading' ) ) : ?>
    <section class="block statement center wrap">
      <span class="eyebrow">Vision</span>
      <h2 class="disp"><?php echo esc_html( $vision_heading ); ?></h2>
      <div class="divider" style="margin:34px auto"></div>
      <?php if ( $vision_body = sk_opt( 'vision_body' ) ) : ?>
        <p class="lead"><?php echo nl2br( esc_html( $vision_body ) ); ?></p>
      <?php endif; ?>
    </section>
    <?php if ( sk_opt( 'vision_infographic_on' ) ) : ?>
      <div class="wrap infographic"><svg id="igA" viewBox="0 0 1040 520"></svg></div>
    <?php endif; ?>
  <?php endif; ?>

  <?php // MISSION ?>
  <?php if ( $mission_heading = sk_opt( 'mission_heading' ) ) : ?>
    <section class="block statement center wrap">
      <span class="eyebrow">Mission</span>
      <h2 class="disp"><?php echo esc_html( $mission_heading ); ?></h2>
      <div class="divider" style="margin:34px auto"></div>
      <?php if ( $mission_body = sk_opt( 'mission_body' ) ) : ?>
        <p class="lead"><?php echo nl2br( esc_html( $mission_body ) ); ?></p>
      <?php endif; ?>
    </section>
  <?php endif; ?>

  <?php // SERVICE ?>
  <?php $svc = sk_query( 'service' ); if ( $svc->have_posts() ) : ?>
    <section class="block wrap center">
      <?php get_template_part( 'template-parts/section-heading', null, array( 'eyebrow' => 'Service', 'title' => '事業紹介' ) ); ?>
      <div class="svc-grid">
        <?php while ( $svc->have_posts() ) : $svc->the_post(); ?>
          <?php get_template_part( 'template-parts/card', 'service' ); ?>
        <?php endwhile; ?>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>

  <?php // INVESTMENT ?>
  <?php $inv = sk_query( 'investment' ); if ( $inv->have_posts() ) : ?>
    <section class="block wrap center">
      <?php get_template_part( 'template-parts/section-heading', null, array( 'eyebrow' => 'Investment', 'title' => '投資先' ) ); ?>
      <div class="inv-grid">
        <?php while ( $inv->have_posts() ) : $inv->the_post(); ?>
          <?php get_template_part( 'template-parts/item', 'investment' ); ?>
        <?php endwhile; ?>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>

</div>

<?php get_footer(); ?>

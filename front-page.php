<?php get_header(); ?>
<main>
  <section class="hero">
    <div class="container">
      <?php if ( sk_has( 'hero_title' ) ) : ?>
        <h1><?php echo nl2br( esc_html( sk_opt( 'hero_title' ) ) ); ?></h1>
      <?php else : ?>
        <h1>CREATING EVERY<br><span>"HAPPINESS"</span><br>IN THIS WORLD.</h1>
      <?php endif; ?>

      <?php if ( sk_has( 'hero_sub' ) ) : ?>
        <p><?php echo esc_html( sk_opt( 'hero_sub' ) ); ?></p>
      <?php else : ?>
        <p>世の中を、もっと豊かで、便利で、楽しく。仕組みを創造して、幸せの連鎖をつくる。</p>
      <?php endif; ?>

      <?php echo sk_opt_image( 'hero_media', 'full', array( 'class' => 'hero-visual', 'alt' => 'Hero image' ) ); ?>
      <div class="cg-tag">3DCG Hero — Network ／ Scroll-Driven</div>
      <div class="scrollcue">Scroll</div>
    </div>
  </section>

  <?php if ( sk_has( 'vision_body' ) || sk_has( 'mission_body' ) ) : ?>
    <section>
      <div class="container">
        <div class="section-heading">
          <?php if ( sk_has( 'vision_body' ) ) : ?>
            <span class="eyebrow">Vision</span>
            <?php if ( sk_has( 'vision_heading' ) ) : ?>
              <h2><?php echo esc_html( sk_opt( 'vision_heading' ) ); ?></h2>
            <?php endif; ?>
            <p><?php echo nl2br( esc_html( sk_opt( 'vision_body' ) ) ); ?></p>
          <?php endif; ?>

          <?php if ( sk_has( 'mission_body' ) ) : ?>
            <span class="eyebrow">Mission</span>
            <?php if ( sk_has( 'mission_heading' ) ) : ?>
              <h2><?php echo esc_html( sk_opt( 'mission_heading' ) ); ?></h2>
            <?php endif; ?>
            <p><?php echo nl2br( esc_html( sk_opt( 'mission_body' ) ) ); ?></p>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
  $services = sk_query( array(
    'post_type' => 'service',
    'posts_per_page' => 4,
    'orderby' => 'menu_order',
    'order'   => 'ASC',
  ) );
  if ( $services->have_posts() ) :
  ?>
    <section>
      <div class="container">
        <div class="section-heading">
          <span class="eyebrow">Service</span>
          <h2>事業紹介</h2>
        </div>
        <div class="card-grid">
          <?php while ( $services->have_posts() ) : $services->the_post(); ?>
            <?php
            $service_image = sk_meta_image( 'service_image', 'large' );
            $service_tag   = rwmb_meta( 'service_tag' );
            $service_lead  = rwmb_meta( 'service_lead' );
            ?>
            <article class="card">
              <?php if ( $service_image ) : ?>
                <a href="<?php the_permalink(); ?>"><?php echo $service_image; ?></a>
              <?php endif; ?>
              <div class="card-body">
                <div class="card-tag"><?php echo esc_html( $service_tag ? $service_tag : __( 'Service', 'sikumys' ) ); ?></div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php if ( $service_lead ) : ?>
                  <p><?php echo esc_html( $service_lead ); ?></p>
                <?php endif; ?>
                <a class="more" href="<?php the_permalink(); ?>">View More</a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>

  <?php
  $investments = sk_query( array(
    'post_type' => 'investment',
    'posts_per_page' => 6,
    'orderby' => 'menu_order',
    'order'   => 'ASC',
  ) );
  if ( $investments->have_posts() ) :
  ?>
    <section>
      <div class="container">
        <div class="section-heading">
          <span class="eyebrow">Investment</span>
          <h2>投資先紹介</h2>
        </div>
        <div class="three-grid">
          <?php while ( $investments->have_posts() ) : $investments->the_post(); ?>
            <?php
            $investment_logo = sk_meta_image( 'investment_logo', 'medium' );
            $investment_url  = rwmb_meta( 'investment_url' );
            ?>
            <article class="mini-card">
              <?php if ( $investment_logo ) : ?>
                <div class="mini-logo"><?php echo $investment_logo; ?></div>
              <?php endif; ?>
              <h3><?php the_title(); ?></h3>
              <?php if ( $investment_url ) : ?>
                <a class="more" href="<?php echo esc_url( $investment_url ); ?>" target="_blank" rel="noopener noreferrer">View More</a>
              <?php endif; ?>
            </article>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>

  <?php if ( sk_has( 'message_lead' ) ) : ?>
    <section>
      <div class="container about-grid">
        <div>
          <span class="eyebrow">Message</span>
          <h2>代表メッセージ</h2>
          <p><?php echo nl2br( esc_html( sk_opt( 'message_lead' ) ) ); ?></p>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>

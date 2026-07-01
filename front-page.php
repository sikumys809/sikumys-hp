<?php get_header(); ?>
<main>
  <section class="hero">
    <div class="container">
      <?php if ( sk_has( 'hero_headline' ) ) : ?>
        <h1><?php echo esc_html( sk_opt( 'hero_headline' ) ); ?></h1>
      <?php else : ?>
        <h1>CREATING EVERY<br><span>"HAPPINESS"</span><br>IN THIS WORLD.</h1>
      <?php endif; ?>

      <?php if ( sk_has( 'hero_subtitle' ) ) : ?>
        <p><?php echo esc_html( sk_opt( 'hero_subtitle' ) ); ?></p>
      <?php else : ?>
        <p>世の中を、もっと豊かで、便利で、楽しく。仕組みを創造して、幸せの連鎖をつくる。</p>
      <?php endif; ?>

      <?php echo sk_opt_image( 'hero_image', 'full', array( 'class' => 'hero-visual', 'alt' => 'Hero image' ) ); ?>
      <div class="cg-tag">3DCG Hero — Network ／ Scroll-Driven</div>
      <div class="scrollcue">Scroll</div>
    </div>
  </section>

  <?php if ( sk_has( 'vision_text' ) || sk_has( 'mission_text' ) ) : ?>
    <section>
      <div class="container">
        <div class="section-heading">
          <?php if ( sk_has( 'vision_text' ) ) : ?>
            <span class="eyebrow">Vision</span>
            <h2><?php echo esc_html( sk_opt( 'vision_text' ) ); ?></h2>
          <?php endif; ?>

          <?php if ( sk_has( 'mission_text' ) ) : ?>
            <span class="eyebrow">Mission</span>
            <p><?php echo esc_html( sk_opt( 'mission_text' ) ); ?></p>
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
            <article class="card">
              <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
              <?php endif; ?>
              <div class="card-body">
                <div class="card-tag"><?php echo esc_html__( 'Service', 'sikumys' ); ?></div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo esc_html( sikumys_excerpt( 24 ) ); ?></p>
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
            <article class="mini-card">
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p><?php echo esc_html( sikumys_excerpt( 16 ) ); ?></p>
            </article>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>

  <?php if ( sk_has( 'overview_text' ) || sk_has( 'message_text' ) ) : ?>
    <section>
      <div class="container about-grid">
        <?php if ( sk_has( 'overview_text' ) ) : ?>
          <div>
            <span class="eyebrow">About</span>
            <h2>会社概要</h2>
            <p><?php echo esc_html( sk_opt( 'overview_text' ) ); ?></p>
          </div>
        <?php endif; ?>
        <?php if ( sk_has( 'message_text' ) ) : ?>
          <div>
            <span class="eyebrow">Message</span>
            <h2>代表メッセージ</h2>
            <p><?php echo esc_html( sk_opt( 'message_text' ) ); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>

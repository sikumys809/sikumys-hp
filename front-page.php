<?php get_header(); ?>
<main>
  <section class="hero">
    <div class="container">
      <h1>CREATING EVERY<br><span>"HAPPINESS"</span><br>IN THIS WORLD.</h1>
      <p>世の中を、もっと豊かで、便利で、楽しく。仕組みを創造して、幸せの連鎖をつくる。</p>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="section-heading">
        <span class="eyebrow">Vision</span>
        <h2>仕組みが、幸せの連鎖をつくる。</h2>
        <p>私たちは、人々の暮らしや社会に新たな価値を生み出す“仕組み”を創造し続けます。ひとつの仕組みが、誰かの笑顔を生み、新しい幸せの連鎖をつくっていく。</p>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="section-heading">
        <span class="eyebrow">Service</span>
        <h2>事業紹介</h2>
      </div>
      <div class="card-grid">
        <?php
        $services = new WP_Query( array(
          'post_type' => 'service',
          'posts_per_page' => 4,
        ) );

        if ( $services->have_posts() ) :
          while ( $services->have_posts() ) : $services->the_post();
            echo '<article class="card">';
            if ( has_post_thumbnail() ) {
              echo '<a href="' . esc_url( get_permalink() ) . '">';
              the_post_thumbnail();
              echo '</a>';
            }
            echo '<div class="card-body">';
            echo '<div class="card-tag">Service</div>';
            echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
            echo '<p>' . esc_html( sikumys_excerpt( 24 ) ) . '</p>';
            echo '<a class="more" href="' . esc_url( get_permalink() ) . '">View More</a>';
            echo '</div></article>';
          endwhile;
          wp_reset_postdata();
        else :
          for ( $i = 0; $i < 4; $i++ ) {
            echo '<article class="card"><div class="card-body"><div class="card-tag">Service</div><h3>事業のご紹介</h3><p>サービス内容は今後追加されます。</p><a class="more" href="#">View More</a></div></article>';
          }
        endif;
        ?>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="section-heading">
        <span class="eyebrow">Investment</span>
        <h2>投資先・パートナー</h2>
      </div>
      <div class="three-grid">
        <?php
        $investments = new WP_Query( array(
          'post_type' => 'investment',
          'posts_per_page' => 6,
        ) );

        if ( $investments->have_posts() ) :
          while ( $investments->have_posts() ) : $investments->the_post();
            echo '<article class="mini-card">';
            echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
            echo '<p>' . esc_html( sikumys_excerpt( 16 ) ) . '</p>';
            echo '</article>';
          endwhile;
          wp_reset_postdata();
        else :
          for ( $i = 0; $i < 6; $i++ ) {
            echo '<article class="mini-card"><h3>投資先紹介</h3><p>今後のコンテンツ追加に合わせて掲載します。</p></article>';
          }
        endif;
        ?>
      </div>
    </div>
  </section>

  <section>
    <div class="container about-grid">
      <div>
        <span class="eyebrow">About</span>
        <h2>会社概要</h2>
        <p>SIKUMYSは、仕組みを創ることで社会や人々の幸福に貢献する企業として活動しています。</p>
        <ul>
          <li>会社名：SIKUMYS, INC.</li>
          <li>所在地：東京都港区</li>
          <li>事業内容：事業開発・投資・コミュニティ運営</li>
        </ul>
      </div>
      <div>
        <span class="eyebrow">Message</span>
        <h2>代表メッセージ</h2>
        <p>私たちは、好奇心と実行力をもって、社会に新しい価値を提供し続けます。日々の小さな仕組みの積み重ねが、やがて大きな変化を生むと信じています。</p>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>

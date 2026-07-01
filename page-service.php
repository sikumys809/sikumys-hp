<?php
/**
 * Template Name: Service & Investment Page
 */
get_header(); ?>

<div class="subpage">
  <div style="height:120px"></div>

  <?php $svc = sk_query( 'service' ); if ( $svc->have_posts() ) : ?>
    <section class="block wrap center">
      <?php get_template_part( 'template-parts/section-heading', null, array( 'eyebrow' => 'Service', 'title' => '事業紹介' ) ); ?>
    </section>
    <section class="wrap">
      <?php while ( $svc->have_posts() ) : $svc->the_post(); ?>
        <?php get_template_part( 'template-parts/card', 'service', array( 'variant' => 'detail' ) ); ?>
      <?php endwhile; ?>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>

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

  <div style="height:40px"></div>
</div>

<?php get_footer(); ?>

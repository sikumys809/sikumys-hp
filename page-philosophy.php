<?php
/**
 * Template Name: Philosophy Page
 */
get_header(); ?>

<div class="subpage">
  <div style="height:120px"></div>

  <?php if ( $philosophy_heading = sk_opt( 'philosophy_heading' ) ) : ?>
    <section class="block wrap center phil-hero">
      <span class="eyebrow">Philosophy</span>
      <h2 class="disp"><?php echo esc_html( $philosophy_heading ); ?></h2>
      <div class="divider" style="margin:34px auto"></div>
      <?php if ( $philosophy_body = sk_opt( 'philosophy_body' ) ) : ?>
        <p class="lead" style="max-width:720px;margin:0 auto"><?php echo nl2br( esc_html( $philosophy_body ) ); ?></p>
      <?php endif; ?>
    </section>
    <?php if ( sk_opt( 'philosophy_infographic_on' ) ) : ?>
      <div class="wrap infographic"><svg id="igB" viewBox="0 0 960 480"></svg></div>
    <?php endif; ?>
  <?php endif; ?>

  <?php
  $mind_en   = sk_opt( 'mind_en' );
  $mind_jp   = sk_opt( 'mind_jp' );
  $mind_body = sk_opt( 'mind_body' );
  $creed     = sk_query( 'creed' );
  ?>
  <?php if ( $mind_en || $mind_jp || $mind_body || $creed->have_posts() ) : ?>
    <section class="block wrap center mind">
      <span class="eyebrow">Mind</span>
      <?php if ( $mind_en ) : ?><div class="en-big"><?php echo esc_html( $mind_en ); ?></div><?php endif; ?>
      <?php if ( $mind_jp ) : ?><div class="jp"><?php echo esc_html( $mind_jp ); ?></div><?php endif; ?>
      <?php if ( $mind_body ) : ?><p><?php echo nl2br( esc_html( $mind_body ) ); ?></p><?php endif; ?>
      <?php if ( $creed->have_posts() ) : ?>
        <div class="creed">
          <?php while ( $creed->have_posts() ) : $creed->the_post(); ?>
            <?php get_template_part( 'template-parts/item', 'creed' ); ?>
          <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </section>
  <?php endif; ?>

  <div style="height:40px"></div>
</div>

<?php get_footer(); ?>

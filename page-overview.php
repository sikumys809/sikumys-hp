<?php
/**
 * Template Name: Overview Page
 */
get_header(); ?>

<div class="subpage">
  <div style="height:120px"></div>

  <section class="block wrap center">
    <span class="eyebrow">Overview</span>
    <h2 class="disp"><?php echo esc_html( get_the_title() ? get_the_title() : '会社概要' ); ?></h2>
  </section>

  <?php if ( $ov_logo = sk_opt_image( 'overview_logo' ) ) : ?>
    <div class="ov-logo"><?php sk_img( $ov_logo, get_bloginfo( 'name' ) ); ?></div>
  <?php endif; ?>

  <?php
  $rows     = sk_opt_group( 'company_info' );
  $has_rows = false;
  foreach ( $rows as $row ) {
    if ( ! empty( $row['label'] ) || ! empty( $row['value'] ) ) {
      $has_rows = true;
      break;
    }
  }
  ?>
  <?php if ( $has_rows ) : ?>
    <section class="block wrap">
      <div class="ov"><dl>
        <?php
        foreach ( $rows as $row ) :
          $label = isset( $row['label'] ) ? $row['label'] : '';
          $value = isset( $row['value'] ) ? $row['value'] : '';
          if ( ! $label && ! $value ) {
            continue;
          }
          ?>
          <dt><?php echo esc_html( $label ); ?></dt>
          <dd><?php echo nl2br( esc_html( $value ) ); ?></dd>
        <?php endforeach; ?>
      </dl></div>
    </section>
  <?php endif; ?>

  <?php $fac = sk_query( 'facility' ); if ( $fac->have_posts() ) : ?>
    <div class="wrap gallery-grid">
      <?php while ( $fac->have_posts() ) : $fac->the_post(); ?>
        <?php get_template_part( 'template-parts/card', 'facility' ); ?>
      <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>

  <div style="height:80px"></div>
</div>

<?php get_footer(); ?>

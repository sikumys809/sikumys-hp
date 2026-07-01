<?php
/**
 * Template Name: Overview Page
 */

get_header();
?>
<main>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="section-heading">
      <div class="container">
        <span class="eyebrow">Overview</span>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile; endif; ?>

  <?php $company_info = sk_opt_group( 'company_info' ); ?>
  <?php if ( $company_info ) : ?>
    <section>
      <div class="container">
        <div class="section-heading">
          <span class="eyebrow">Company</span>
          <h2>会社概要</h2>
        </div>
        <dl class="company-table">
          <?php foreach ( $company_info as $row ) : ?>
            <?php if ( ! empty( $row['label'] ) && ! empty( $row['value'] ) ) : ?>
              <div class="company-row">
                <dt><?php echo esc_html( $row['label'] ); ?></dt>
                <dd><?php echo nl2br( esc_html( $row['value'] ) ); ?></dd>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </dl>
      </div>
    </section>
  <?php endif; ?>

  <?php
  $facilities = sk_query( array(
    'post_type' => 'facility',
    'posts_per_page' => 6,
    'orderby' => 'menu_order',
    'order'   => 'ASC',
  ) );
  if ( $facilities->have_posts() ) :
  ?>
    <section>
      <div class="container">
        <div class="section-heading">
          <span class="eyebrow">Facility</span>
          <h2>事業所ギャラリー</h2>
        </div>
        <div class="card-grid">
          <?php while ( $facilities->have_posts() ) : $facilities->the_post(); ?>
            <?php
            $facility_image   = sk_meta_image( 'facility_image', 'large' );
            $facility_address = function_exists( 'rwmb_meta' ) ? rwmb_meta( 'facility_address' ) : '';
            ?>
            <article class="card">
              <?php if ( $facility_image ) : ?>
                <div class="card-media"><?php echo $facility_image; ?></div>
              <?php endif; ?>
              <div class="card-body">
                <h3><?php the_title(); ?></h3>
                <?php if ( $facility_address ) : ?>
                  <p><?php echo esc_html( $facility_address ); ?></p>
                <?php endif; ?>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
